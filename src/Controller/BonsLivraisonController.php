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
use App\Utils\ErrorRoute;
use App\Utils\Extensions\DocumentLigne;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;


class BonsLivraisonController extends Controller
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
     * BonsLivraisonController constructor.
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
     * Liste d'entêtes de bons livraison pour le client connecté dans un ordre décroissant.
     *
     * @Route(
     *     name = "api_bonslivraison_items_get",
     *     path = "/api/bonslivraison",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste de bons livraison pour le client connecté dans un ordre décroissant",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=BonLivraison::class, groups={"full"}))
     *     )
     * )
     */
    public function bonsLivraisonGetAction(Request $request)
    {
        // S'il n'y a pas de paramétres dans l'url on lance un appel de tout les documents
        if(is_null($request->getQueryString())) {
            $TTRetour = $this->ws_manager->getDocuments(WsParameters::TYPE_PRENDRE_BL, WsParameters::FORMAT_DOCUMENT_VIDE);

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
                            $ligne = new DocumentLigne();
                            $ligne->parseObject($wsLignes[$iL]);
                            $doc->setLignes($ligne);
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
        // S'il y a le paramétre 'd' dans l'url on lance un appel des documents à partir de la date limite
        else if(strpos($request->getQueryString(), 'd=') !== false) {
            return $this->bonslivraisonLimitGetAction($request->get('d'));
        }

        return new JsonResponse(new ErrorRoute('Les paramètres renseignés ne sont pas pris en charge !', 406), 406, array(), true);
    }


    /**
     * Liste de bons livraison pour le client connecté dans une limite de date (sup. au) dans un ordre décroissant.
     *
     * @Route(
     *     name = "api_bonslivraison_limit_items_get",
     *     path = "/api/bonslivraison?date_from={date_from}",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste de bons livraison à partir d'une date pour le client connecté dans un ordre décroissant",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=BonLivraison::class, groups={"full"}))
     *     )
     * )
     */
    public function bonsLivraisonLimitGetAction($date_from)
    {
        try{
            if( !preg_match ( '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/' , $date_from ) )
            {
                return new JsonResponse(new ErrorRoute('La date renseignée est incorecte. (format autorisé yyyy-mm-dd)', 406), 406, array(), true);
            }

            $date = new \DateTime($date_from);

            $TTRetour = $this->ws_manager->getDocumentsByDate($date->format('d-m-Y'), WsParameters::TYPE_PRENDRE_BL, WsParameters::FORMAT_DOCUMENT_VIDE);

            if(!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
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
                            $ligne = new DocumentLigne();
                            $ligne->parseObject($wsLignes[$iL]);
                            $doc->setLignes($ligne);
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
        catch(\Exception $exception)
        {
            return new JsonResponse(new ErrorRoute($exception->getMessage().' Le code source coté serveur est incorrecte.', 502), 502, array(), true);
        }
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