<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Article;
use App\Entity\User;
use App\Services\Objets\Notif;
use App\Services\Objets\WsArticle;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\UserService;
use App\Services\WsManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class TransformResponseSubscriber implements EventSubscriberInterface
{
    /**
     * @SWG\Property(
     *     name="ws_manager",
     *     type="WsManager",
     *     description="Service qui permet de faire des appels aux services web GIMEL")
     */
    private $ws_manager;

    /**
     * @SWG\Property(
     *     name="user_service",
     *     type="UserService",
     *     description="Service qui permet de récupérer le client connecté par son token")
     */
    private $user_service;


    /**
     * TransformResponseListener constructor.
     * @param $wsManager
     * @param $userService
     */
    public function __construct(WsManager $wsManager, UserService $userService)
    {
        if (!$wsManager instanceof WsManager) {
            throw new \InvalidArgumentException(sprintf('The wsManager must implement the %s.', WsManager::class));
        }
        else if (!$userService instanceof UserService) {
            throw new \InvalidArgumentException(sprintf('The userService must implement the %s.', UserService::class));
        }

        $this->ws_manager = $wsManager;
        $this->user_service = $userService;
    }


    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['transformResult', EventPriorities::POST_SERIALIZE],
            KernelEvents::RESPONSE => ['transformResponse'],
        ];
    }

    /**
     * Fonction qui permet de choisir l'hydration selon le controller appelé
     * @param GetResponseForControllerResultEvent $event
     *
     */
    public function transformResult(GetResponseForControllerResultEvent $event)
    {
        $pathInfo = $event->getRequest()->getPathInfo();
        $method = $event->getRequest()->getMethod();
        $result = $event->getControllerResult();
        $result = json_decode($result, true);

        if (Request::METHOD_GET === $method && strpos($pathInfo, '/articles') !== false) {
            $result = $this->transformResultArticles($result, $event->getRequest()->getRequestUri());
        }


        $event->setControllerResult(json_encode($result));
    }

    /**
     * Fonction qui permet de transformer la réponse avec des données complémentaires
     * @param FilterResponseEvent $event
     *
     */
    public function transformResponse(FilterResponseEvent $event)
    {
        $pathInfo = $event->getRequest()->getPathInfo();
        $method = $event->getRequest()->getMethod();
        $response = $event->getResponse();

        if($response instanceof JsonResponse) {
            $response_decode = json_decode($response->getContent(), true);

            if (Request::METHOD_GET === $method && strpos($pathInfo, '/statistiques/client/article') !== false) {
                $depots = array();

                $parseUrl = parse_url($event->getRequest()->getRequestUri());
                if (array_key_exists('query', $parseUrl)) {
                    parse_str($parseUrl['query'], $arrayQuery);

                    if (array_key_exists('depots', $arrayQuery)) {
                        $depots = $arrayQuery['depots'];
                        if (is_array(json_decode($depots))) {
                            $depots = json_decode($depots);
                        } else {
                            $depots = array($depots);
                        }
                    }
                }

                $list_items = array();
                foreach ($response_decode as $item) {
                    // Appel service web d'un article par son identifiant technique IdArt
                    $TTRetour = $this->ws_manager->getArticleByIdArt($item['IdArt'], false, $depots);

                    if (!is_null($TTRetour)) {
                        if (!$TTRetour instanceof Notif) {
                            $TTParam = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

                            if (!is_null($TTParam) && $TTParam->countItems() > 0) {

                                $wsArticle = $TTParam->getItemByFilter('IdArt', $item['IdArt']);

                                $art = new Article();
                                $art->parseObject($wsArticle);
                                $item["Article"] = json_decode($art->__shortToString(), false);
                                array_push($list_items, $item);
                            }
                        }
                    }
                }

                $event->getResponse()->setContent(json_encode($list_items));
            }
        }
    }

    /**
     * Fonction qui permet l'hydration de la collection d'articles
     * @param $result
     * @param $uri
     * @return mixed
     */
    private function transformResultArticles($result, $uri) {

        if(array_key_exists('hydra:member', $result)) {
            $depots = array();
            $array_idarts = array();

            $parseUrl = parse_url($uri);
            if (array_key_exists('query', $parseUrl)) {
                parse_str($parseUrl['query'], $arrayQuery);

                if (array_key_exists('depots', $arrayQuery)) {
                    $depots = $arrayQuery['depots'];
                    if (is_array(json_decode($depots))) {
                        $depots = json_decode($depots);
                    } else {
                        $depots = array($depots);
                    }
                }
            }

            // Lecture du user connecté
            $user = $this->user_service->getCurrentUser();

            // si user connecté et de type User
            if ($user instanceof User) {
                foreach ($result['hydra:member'] as $item) {
                    if (!in_array($item['IdArtEvoAD'], $array_idarts)) {
                        array_push($array_idarts, $item['IdArtEvoAD']);
                    }
                }
                // instancie la propriété user du manager des services web gimel
                $this->ws_manager->setUser($user);

                // Appel service web d'un article par son identifiant technique IdArt et calcul du prix net si client connecté
                $TTRetour = $this->ws_manager->getArticlesByArray($array_idarts, !in_array('ROLE_COMMERCIAL', $user->getRoles()), $depots);
            } else {
                // Appel service web d'un article par son identifiant technique IdArt
                $TTRetour = $this->ws_manager->getArticlesByArray($array_idarts, false, $depots);
            }

            if (!is_null($TTRetour)) {
                if(!$TTRetour instanceof Notif) {
                    $TTParam = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

                    if (!is_null($TTParam) && $TTParam->countItems() > 0) {

                        for ($i = 0; $i < count($result['hydra:member']); $i++) {
                            $item = $result['hydra:member'][$i];
                            /** @var WsArticle $wsArticle */
                            $wsArticle = $TTParam->getItemByFilter('IdArt', $item['IdArtEvoAD']);

                            $item["IdADWS"] = $wsArticle->getIdAD();
                            $item["CodADFWS"] = $wsArticle->getCodADF();
                            $item["DesiAutoADWS"] = $wsArticle->getDesiAutoAD();
                            $item["UVteADWS"] = $wsArticle->getUVteArt();
                            $item["UStoADWS"] = $wsArticle->getUStoArt();
                            $item["PrixPubADWS"] = $wsArticle->getPrixPubAD();
                            $item["PrixNetCliADWS"] = $wsArticle->getPrixNet();

                            $item["IdDepWS"] = $wsArticle->getIdDep();
                            $item["CodADWS"] = $wsArticle->getCodAD();
                            $item["StkReelADWS"] = $wsArticle->getStkReelAD();
                            $item["StkResADWS"] = $wsArticle->getStkResAD();
                            $item["StkCmdeADWS"] = $wsArticle->getStkCmdeAD();
                            $item["StockDisponibleWS"] = $wsArticle->getStockDisponible();
                            $item["StockDisponibleSocWS"] = $wsArticle->getStockDisponibleSoc();
                            $item["StockPratiqueWS"] = $wsArticle->getStockPratique();
                            $item["StkReelPlat1WS"] = $wsArticle->getStkReelPlat1();
                            $item["UVteArtWS"] = $wsArticle->getUVteArt();
                            $item["UStoArtWS"] = $wsArticle->getUStoArt();
                            $item["PrixPubUCondVteWS"] = $wsArticle->getPrixPubUCondVte();
                            $item["PrixNetUCondVteWS"] = $wsArticle->getPrixNetUCondVte();

                            $item["LongADWS"] = $wsArticle->getLongAD();
                            $item["LargADWS"] = $wsArticle->getLargAD();
                            $item["EpaisADWS"] = $wsArticle->getEpaisAD();
                            $item["CondVteADWS"] = $wsArticle->getCondVteAD();
                            $item["FlgDecondADWS"] = $wsArticle->getFlgDecondAD();
                            $item["Desi2ArtWS"] = $wsArticle->getDesi2Art();
                            $item["IdFourWS"] = $wsArticle->getIdFour();
                            $item["NomDepWS"] = $wsArticle->getNomDep();
                            $item["CodSuspADWS"] = $wsArticle->getCodSuspAD();
                            $item["GenCodADWS"] = $wsArticle->getGenCodAD();
                            $item["CodADFWS"] = $wsArticle->getCodADF();
                            $item["GenCod1ADFWS"] = $wsArticle->getGenCod1ADF();
                            $item["GenCod2ADFWS"] = $wsArticle->getGenCod2ADF();

                            $item["PrixNetWS"] = $wsArticle->getPrixNet();
                            $item["PrixPubCliWS"] = $wsArticle->getPrixPubCli();
                            $item["PrixRevConvADWS"] = $wsArticle->getPrixRevConvAD();
                            $item["CoefPRCADWS"] = $wsArticle->getCoefPRCAD();
                            $item["MargeConvADWS"] = $wsArticle->getMargeConvAD();
                            $item["Stocks"] = $wsArticle->getStocks();
                            $result['hydra:member'][$i] = $item;
                        }
                    }
                }
            }
        }
        else {
            $depots = array();
            $array_idarts = array();

            $parseUrl = parse_url($uri);
            if (array_key_exists('query', $parseUrl)) {
                parse_str($parseUrl['query'], $arrayQuery);

                if (array_key_exists('depots', $arrayQuery)) {
                    $depots = $arrayQuery['depots'];
                    if (is_array(json_decode($depots))) {
                        $depots = json_decode($depots);
                    } else {
                        $depots = array($depots);
                    }
                }
            }

            // Lecture du user connecté
            $user = $this->user_service->getCurrentUser();

            // si user connecté et de type User
            if ($user instanceof User) {
                array_push($array_idarts, $result['IdArtEvoAD']);

                // instancie la propriété user du manager des services web gimel
                $this->ws_manager->setUser($user);

                // Appel service web d'un article par son identifiant technique IdArt et calcul du prix net si client connecté
                $TTRetour = $this->ws_manager->getArticlesByArray($array_idarts, !in_array('ROLE_COMMERCIAL', $user->getRoles()), $depots);
            } else {
                // Appel service web d'un article par son identifiant technique IdArt
                array_push($array_idarts, $result['IdArtEvoAD']);
                $TTRetour = $this->ws_manager->getArticlesByArray($array_idarts, false, $depots);
            }

            if (!is_null($TTRetour)) {
                if(!$TTRetour instanceof Notif) {
                    $TTParam = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

                    if (!is_null($TTParam) && $TTParam->countItems() > 0) {

                            /** @var WsArticle $wsArticle */
                            $wsArticle = $TTParam->getItemByFilter('IdArt', $result['IdArtEvoAD']);

                            $item["IdADWS"] = $wsArticle->getIdAD();
                            $item["CodADFWS"] = $wsArticle->getCodADF();
                            $item["DesiAutoADWS"] = $wsArticle->getDesiAutoAD();
                            $item["UVteADWS"] = $wsArticle->getUVteArt();
                            $item["UStoADWS"] = $wsArticle->getUStoArt();
                            $item["PrixPubADWS"] = $wsArticle->getPrixPubAD();
                            $item["PrixNetCliADWS"] = $wsArticle->getPrixNet();

                            $item["IdDepWS"] = $wsArticle->getIdDep();
                            $item["CodADWS"] = $wsArticle->getCodAD();
                            $item["StkReelADWS"] = $wsArticle->getStkReelAD();
                            $item["StkResADWS"] = $wsArticle->getStkResAD();
                            $item["StkCmdeADWS"] = $wsArticle->getStkCmdeAD();
                            $item["StockDisponibleWS"] = $wsArticle->getStockDisponible();
                            $item["StockDisponibleSocWS"] = $wsArticle->getStockDisponibleSoc();
                            $item["StockPratiqueWS"] = $wsArticle->getStockPratique();
                            $item["StkReelPlat1WS"] = $wsArticle->getStkReelPlat1();
                            $item["UVteArtWS"] = $wsArticle->getUVteArt();
                            $item["UStoArtWS"] = $wsArticle->getUStoArt();
                            $item["PrixPubUCondVteWS"] = $wsArticle->getPrixPubUCondVte();
                            $item["PrixNetUCondVteWS"] = $wsArticle->getPrixNetUCondVte();

                            $item["LongADWS"] = $wsArticle->getLongAD();
                            $item["LargADWS"] = $wsArticle->getLargAD();
                            $item["EpaisADWS"] = $wsArticle->getEpaisAD();
                            $item["CondVteADWS"] = $wsArticle->getCondVteAD();
                            $item["FlgDecondADWS"] = $wsArticle->getFlgDecondAD();
                            $item["Desi2ArtWS"] = $wsArticle->getDesi2Art();
                            $item["IdFourWS"] = $wsArticle->getIdFour();
                            $item["NomDepWS"] = $wsArticle->getNomDep();
                            $item["CodSuspADWS"] = $wsArticle->getCodSuspAD();
                            $item["GenCodADWS"] = $wsArticle->getGenCodAD();
                            $item["CodADFWS"] = $wsArticle->getCodADF();
                            $item["GenCod1ADFWS"] = $wsArticle->getGenCod1ADF();
                            $item["GenCod2ADFWS"] = $wsArticle->getGenCod2ADF();

                            $item["PrixNetWS"] = $wsArticle->getPrixNet();
                            $item["PrixPubCliWS"] = $wsArticle->getPrixPubCli();
                            $item["PrixRevConvADWS"] = $wsArticle->getPrixRevConvAD();
                            $item["CoefPRCADWS"] = $wsArticle->getCoefPRCAD();
                            $item["MargeConvADWS"] = $wsArticle->getMargeConvAD();
                            $item["Stocks"] = $wsArticle->getStocks();
                            $result = $item;
                    }
                }
            }
        }
        return $result;
    }
}