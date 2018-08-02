<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use App\Services\Objets\CntxAdmin;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsAlgorithmOpenSSL;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\UserService;
use App\Services\WsManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

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
            KernelEvents::VIEW => ['transformResult', EventPriorities::POST_SERIALIZE]
        ];
    }

    /**
     * Fonction qui permet de choisir l'hydration selon le controller appelé
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
     * Fonction qui permet l'hydration de la collection d'articles
     *
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
                $TTParam = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

                if (!is_null($TTParam) && $TTParam->countItems() > 0) {

                    for ($i = 0; $i < count($result['hydra:member']); $i++) {
                        $item = $result['hydra:member'][$i];
                        $wsArticle = $TTParam->getItemByFilter('IdArt', $item['IdArtEvoAD']);

                        $item["IdADWS"] = $wsArticle->getIdAD();
                        $item["NoADWS"] = $wsArticle->getNoAD();
                        $item["CodADFWS"] = $wsArticle->getCodADF();
                        $item["DesiAutoADWS"] = $wsArticle->getDesiAutoAD();
                        $item["CodADWS"] = $wsArticle->getCodAD();
                        $item["UVteADWS"] = $wsArticle->getUVteArt();
                        $item["UStoADWS"] = $wsArticle->getUStoArt();
                        $item["PrixPubADWS"] = $wsArticle->getPrixPubAD();
                        $item["PrixNetCliADWS"] = $wsArticle->getPrixNet();

                        $item["IdDepWS"] = $wsArticle->getIdDep();
                        $item["NoADWS"] = $wsArticle->getNoAD();
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
                        $item["PrixPubADWS"] = $wsArticle->getPrixPubAD();
                        $item["PrixRevConvADWS"] = $wsArticle->getPrixRevConvAD();
                        $item["CoefPRCADWS"] = $wsArticle->getCoefPRCAD();
                        $item["MargeConvADWS"] = $wsArticle->getMargeConvAD();
                        $item["Stocks"] = $wsArticle->getStocks();
                        $result['hydra:member'][$i] = $item;
                    }
                }
            }
        }
        return $result;
    }
}