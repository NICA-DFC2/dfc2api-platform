<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsParameters;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\UserService;
use App\Services\WsManager;
use App\Utils\Devis;
use App\Utils\Extensions\DocumentLigne;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;


class DevisController extends Controller
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
     * DevisController constructor.
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
        $this->setCurrentUser();
    }

    /**
     * Liste d'entêtes de devis pour le client connecté dans un ordre décroissant.
     *
     * @Route(
     *     name = "api_devis_items_get",
     *     path = "/api/devis",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste de devis pour le client connecté dans un ordre décroissant",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Devis::class, groups={"full"}))
     *     )
     * )
     */
    public function devisGetAction()
    {
        $TTRetour = $this->ws_manager->getDevis(WsParameters::FORMAT_DOCUMENT_VIDE);

        if(!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            $TTParamEnt = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DOCUM_ENT);
            $TTParamLig = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DOCUM_LIG);

            $list_devis = array();
            for ($i = 0; $i < $TTParamEnt->countItems(); $i++) {
                $wsDevis = $TTParamEnt->getItem($i);
                $devis = new Devis();
                $devis->parseObject($wsDevis);

                $wsLignes = $TTParamLig->getItemsByFilter('IdDocDE', $wsDevis->getIdDocDE());
                for ($iL = 0; $iL < count($wsLignes); $iL++) {
                    $ligne = new DocumentLigne();
                    $ligne->parseObject($wsLignes[$iL]);
                    $devis->setLignes($ligne);
                }
                array_push($list_devis, $devis);
            }

            return $this->json($list_devis);
        }

        return $this->json('Failed: '.sprintf('Il y a une erreur:  %s.', $TTRetour->__toString()));
    }


    /**
     * Liste de devis pour le client connecté dans une limite de date (sup. au) dans un ordre décroissant.
     *
     * @Route(
     *     name = "api_devis_limit_items_get",
     *     path = "/api/devis/{jour}/{mois}/{annee}",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste de devis à partir d'une date pour le client connecté dans un ordre décroissant",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Devis::class, groups={"full"}))
     *     )
     * )
     */
    public function devisLimitGetAction($jour, $mois, $annee)
    {
        $TTRetour = $this->ws_manager->getDevisByDate($jour, $mois, $annee, WsParameters::FORMAT_DOCUMENT_VIDE);

        if(!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            $TTParamEnt = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DOCUM_ENT);
            $TTParamLig = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DOCUM_LIG);

            $list_devis = array();
            for ($i = 0; $i < $TTParamEnt->countItems(); $i++) {
                $wsDevis = $TTParamEnt->getItem($i);
                $devis = new Devis();
                $devis->parseObject($wsDevis);

                $wsLignes = $TTParamLig->getItemsByFilter('IdDocDE', $wsDevis->getIdDocDE());
                for ($iL = 0; $iL < count($wsLignes); $iL++) {
                    $ligne = new DocumentLigne();
                    $ligne->parseObject($wsLignes[$iL]);
                    $devis->setLignes($ligne);
                }
                array_push($list_devis, $devis);
            }

            return $this->json($list_devis);
        }

        return $this->json('Failed: '.sprintf('Il y a une erreur:  %s.', $TTRetour->__toString()));
    }


    private function setCurrentUser()
    {
        $user_data = $this->user_service->getCurrentUser();
        // Appel service web d'un client par son code client (CodCli)
        $TTRetour = $this->ws_manager->getClientByCodCli($user_data->getCode());

        // si le retour est de type Notif
        // Message d'erreur retourné par les webservices
        if($TTRetour instanceof Notif) {
            //throw new \ErrorException(sprintf('Il y a une erreur:  %s.', $TTRetour->__toString()), 401 ,1, __FILE__);
        }

        if(!is_null($TTRetour)) {
            $TTParam = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_CLI);
            $wsClient = $TTParam->getItem(0);

            if(!is_null($wsClient)) {
                $user_data->setIdCli($wsClient->getIdCli());
                $user_data->setNoCli($wsClient->getNoCli());
                $user_data->setIdDepotCli($wsClient->getIdDep());
                $user_data->setNomDepotCli($wsClient->getNomDep());
            }
        }

        // si user connecté et de type User
        if($user_data instanceof User) {
            // instancie la propriété user du manager des services web gimel
            $this->ws_manager->setUser($user_data);
        }
    }
}