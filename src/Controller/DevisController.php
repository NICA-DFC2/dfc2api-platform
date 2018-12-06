<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsParameters;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\UserService;
use App\Services\WsManager;
use App\Entity\Devis;
use App\Utils\Edition;
use App\Utils\ErrorRoute;
use App\Utils\Ligne;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\Serializer\Serializer;


class DevisController extends AbstractController
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
     * @param WsManager $wsManager
     * @param UserService $userService
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

    /**
     * Liste d'entêtes de devis pour le client connecté dans un ordre décroissant.
     *
     * @Route(
     *     name = "api_devis_items_get",
     *     path = "/api/ws/devis",
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
    public function devisGetAction(Request $request)
    {
        $user = $this->user_service->getCurrentUser();
        $this->ws_manager->setUser($user);

        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getDocuments(WsParameters::TYPE_PRENDRE_DEVIS, WsParameters::FORMAT_DOCUMENT_VIDE);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_DOCUM_ENT) && $TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_DOCUM_LIG)) {
                $TTParamEnt = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DOCUM_ENT);
                $TTParamLig = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DOCUM_LIG);

                $list_docs = array();
                for ($i = 0; $i < $TTParamEnt->countItems(); $i++) {
                    $wsDocs = $TTParamEnt->getItem($i);
                    $doc = new Devis();
                    $doc->parseObject($wsDocs);

                    $wsLignes = $TTParamLig->getItemsByFilter('IdDocDE', $wsDocs->getIdDocDE());
                    for ($iL = 0; $iL < count($wsLignes); $iL++) {
                        $ligne = new Ligne();
                        $ligne->parseObject($wsLignes[$iL]);
                        $doc->setLignes($ligne);
                    }

                    $doc->setLienEdition('api/ws/devis/'.$wsDocs->getIdDocDE().'/edition');

                    array_push($list_docs, $doc);
                }

                return $this->json($list_docs);
            }
            else {
                return $this->json(array());
            }
        }
        else if(!is_null($TTRetour) && $TTRetour instanceof Notif) {
            return new JsonResponse(new ErrorRoute($TTRetour->getTexte(), 400), 400, array(), true);
        }
    }

    /**
     * Liste d'entêtes de devis pour le client dans un ordre décroissant.
     *
     * @Route(
     *     name = "api_devis_items_get",
     *     path = "/api/ws/devis/{id_cli}/client",
     *     methods= "GET",
     *     requirements={"id_cli"="\d+"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste de devis pour le client dans un ordre décroissant",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Devis::class, groups={"full"}))
     *     )
     * )
     */
    public function devisClientGetAction($id_cli, Request $request)
    {
        $user = $this->user_service->getCurrentUser();
        $this->ws_manager->setUser($user);

        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getDocumentsWithClient($id_cli,WsParameters::TYPE_PRENDRE_DEVIS, WsParameters::FORMAT_DOCUMENT_VIDE);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_DOCUM_ENT) && $TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_DOCUM_LIG)) {
                $TTParamEnt = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DOCUM_ENT);
                $TTParamLig = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DOCUM_LIG);

                $list_docs = array();
                for ($i = 0; $i < $TTParamEnt->countItems(); $i++) {
                    $wsDocs = $TTParamEnt->getItem($i);
                    $doc = new Devis();
                    $doc->parseObject($wsDocs);

                    $wsLignes = $TTParamLig->getItemsByFilter('IdDocDE', $wsDocs->getIdDocDE());
                    for ($iL = 0; $iL < count($wsLignes); $iL++) {
                        $ligne = new Ligne();
                        $ligne->parseObject($wsLignes[$iL]);
                        $doc->setLignes($ligne);
                    }

                    $doc->setLienEdition('api/ws/devis/'.$wsDocs->getIdDocDE().'/edition');

                    array_push($list_docs, $doc);
                }

                return $this->json($list_docs);
            }
            else {
                return $this->json(array());
            }
        }
        else if(!is_null($TTRetour) && $TTRetour instanceof Notif) {
            return new JsonResponse(new ErrorRoute($TTRetour->getTexte(), 400), 400, array(), true);
        }
    }

    /**
     * Liste d'entêtes de devis état en cours pour le client dans un ordre décroissant.
     *
     * @Route(
     *     name = "api_devis_current_items_get",
     *     path = "/api/ws/devis/{id_cli}/client/current",
     *     methods= "GET",
     *     requirements={"id_cli"="\d+"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste de devis état en cours pour le client dans un ordre décroissant",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Devis::class, groups={"full"}))
     *     )
     * )
     */
    public function devisCurrentClientGetAction($id_cli, Request $request)
    {
        $user = $this->user_service->getCurrentUser();
        $this->ws_manager->setUser($user);

        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getDocumentsCurrentWithClient($id_cli,WsParameters::TYPE_PRENDRE_DEVIS, WsParameters::FORMAT_DOCUMENT_VIDE);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_DOCUM_ENT) && $TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_DOCUM_LIG)) {
                $TTParamEnt = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DOCUM_ENT);
                $TTParamLig = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DOCUM_LIG);

                $list_docs = array();
                for ($i = 0; $i < $TTParamEnt->countItems(); $i++) {
                    $wsDocs = $TTParamEnt->getItem($i);
                    $doc = new Devis();
                    $doc->parseObject($wsDocs);

                    $wsLignes = $TTParamLig->getItemsByFilter('IdDocDE', $wsDocs->getIdDocDE());
                    for ($iL = 0; $iL < count($wsLignes); $iL++) {
                        $ligne = new Ligne();
                        $ligne->parseObject($wsLignes[$iL]);
                        $doc->setLignes($ligne);
                    }

                    $doc->setLienEdition('api/ws/devis/'.$wsDocs->getIdDocDE().'/edition');

                    array_push($list_docs, $doc);
                }

                return $this->json($list_docs);
            }
            else {
                return $this->json(array());
            }
        }
        else if(!is_null($TTRetour) && $TTRetour instanceof Notif) {
            return new JsonResponse(new ErrorRoute($TTRetour->getTexte(), 400), 400, array(), true);
        }
    }

    /**
     * Retourne l'édition d'un devis pour le client connecté.
     *
     * @Route(
     *     name = "api_devis_edition_item_get",
     *     path = "/api/ws/devis/{id}/edition",
     *     methods= "GET",
     *     requirements={"id"="\d+"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne l'édition d'un devis pour le client connecté",
     *     @SWG\Schema(
     *         type="",
     *         @SWG\Items(ref=@Model(type=Edition::class, groups={"full"}))
     *     )
     * )
     */
    public function editionsDevisGetAction($id)
    {
        $user = $this->user_service->getCurrentUser();
        $this->ws_manager->setUser($user);

        $TTRetour = $this->ws_manager->getEdition($id, WsParameters::TYPE_PRENDRE_EDITION_DEVIS, WsParameters::FORMAT_EDITION_BLOB);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_EDITION)) {
                $TTEdition = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_EDITION);

                $list_docs = array();
                for ($i = 0; $i < $TTEdition->countItems(); $i++) {
                    $wsEdition = $TTEdition->getItem($i);
                    $doc = new Edition();
                    $doc->parseObject($wsEdition);
                    array_push($list_docs, $doc);
                }

                return $this->json($list_docs);
            }
            else {
                return $this->json(array());
            }
        }
        else if(!is_null($TTRetour) && $TTRetour instanceof Notif) {
            return new JsonResponse(new ErrorRoute($TTRetour->getTexte(), 400), 400, array(), true);
        }

        return new JsonResponse(new ErrorRoute('Les paramètres renseignés ne sont pas pris en charge !', 406), 406, array(), true);
    }
}
