<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsParameters;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\UserService;
use App\Services\WsManager;
use App\Utils\Edition;
use App\Utils\ErrorRoute;
use App\Utils\EtatFacture;
use App\Entity\Facture;
use App\Utils\Ligne;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class FacturesController extends Controller
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
     * FactureController constructor.
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
     * Liste d'entêtes de facture pour le client connecté dans un ordre décroissant.
     *
     * @Route(
     *     name = "api_factures_items_get",
     *     path = "/api/factures",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste de factures pour le client connecté dans un ordre décroissant",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Facture::class, groups={"full"}))
     *     )
     * )
     */
    public function facturesGetAction(Request $request)
    {
        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getDocuments(WsParameters::TYPE_PRENDRE_FACCLI, WsParameters::FORMAT_DOCUMENT_VIDE);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_DOCUM_ENT) && $TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_DOCUM_LIG)) {
                $TTParamEnt = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DOCUM_ENT);
                $TTParamLig = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DOCUM_LIG);

                $list_docs = array();
                for ($i = 0; $i < $TTParamEnt->countItems(); $i++) {
                    $wsDocs = $TTParamEnt->getItem($i);
                    $doc = new Facture();
                    $doc->parseObject($wsDocs);

                    $wsLignes = $TTParamLig->getItemsByFilter('IdDocDE', $wsDocs->getIdDocDE());
                    for ($iL = 0; $iL < count($wsLignes); $iL++) {
                        $ligne = new Ligne();
                        $ligne->parseObject($wsLignes[$iL]);
                        $doc->setLignes($ligne);
                    }

                    // Etat de la facture
                    $TTRetourFacCliAtt = $this->ws_manager->getFactureEnAttente($doc->getIdDocDE());

                    if (!is_null($TTRetourFacCliAtt) && $TTRetourFacCliAtt instanceof TTRetour) {
                        if($TTRetourFacCliAtt->containsKey(WsTableNamesRetour::TABLENAME_TT_FACCLIATT)) {
                            $TTFacCliAtt = $TTRetourFacCliAtt->getTable(WsTableNamesRetour::TABLENAME_TT_FACCLIATT);

                            for ($i = 0; $i < $TTFacCliAtt->countItems(); $i++) {
                                $wsFacCliAtt = $TTFacCliAtt->getItem($i);
                                $etat = new EtatFacture();
                                $etat->parseObject($wsFacCliAtt);
                                $doc->setEtatFacDE($etat);
                            }
                        }
                    }

                    array_push($list_docs, $doc);
                }

                return $this->json($list_docs);
            }
            else {
                return $this->json(array());
            }
        }
    }

    /**
     * Retourne l'édition d'une facture pour le client connecté.
     *
     * @Route(
     *     name = "api_factures_edition_item_get",
     *     path = "/api/factures/{id}/edition",
     *     methods= "GET",
     *     requirements={"id"="\d+"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne l'édition d'une facture pour le client connecté",
     *     @SWG\Schema(
     *         type="",
     *         @SWG\Items(ref=@Model(type=Edition::class, groups={"full"}))
     *     )
     * )
     */
    public function editionsFactureGetAction($id)
    {
        $TTRetour = $this->ws_manager->getEdition($id, WsParameters::TYPE_PRENDRE_EDITION_FACCLI, WsParameters::FORMAT_EDITION_BLOB);

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