<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Contact;
use App\Entity\User;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\UserService;
use App\Services\WsManager;
use App\Utils\ErrorRoute;
use Doctrine\Common\Collections\ArrayCollection;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;


class ClientsController extends AbstractController
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
     * ClientsController constructor.
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
     * Retourne les infos du client connecté par les webservices.
     *
     * @Route(
     *     name = "api_ws_client_item_current_get",
     *     path = "/api/ws/client/current",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne les infos du client connecté par les webservices.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Client::class, groups={"full"}))
     *     )
     * )
     */
    public function callWebserviceClientCurrentGetAction(Request $request) {
        $user = $this->user_service->getCurrentUser();
        $this->ws_manager->setUser($user);

        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getClient();

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_CLI)) {
                $TTCli = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_CLI);

                $list_cli = array();
                for ($i = 0; $i < $TTCli->countItems(); $i++) {
                    $wsClient = $TTCli->getItem($i);

                    $client = new Client();
                    $client->parseObject($wsClient);

                    $client->setLienContacts('api/ws/contacts/'.$client->getIdCli().'/client');

                    $client->setLienDevis('api/ws/devis/'.$client->getIdCli().'/client');
                    $client->setLienCommandes('api/ws/commandes/'.$client->getIdCli().'/client');
                    $client->setLienBL('api/ws/bonslivraison/'.$client->getIdCli().'/client');
                    $client->setLienFactures('api/ws/factures/'.$client->getIdCli().'/client');

                    $client->setLienNbDevisEtatE('api/ws/devis/'.$client->getIdCli().'/client/current');
                    $client->setLienNbCommandesEtatE('api/ws/commandes/'.$client->getIdCli().'/client/current');
                    $client->setLienNbBLEtatE('api/ws/bonslivraison/'.$client->getIdCli().'/client/current');
                    $client->setLienNbFacturesEtatE('api/ws/factures/'.$client->getIdCli().'/client/current');

                    array_push($list_cli, $client);
                }

                return $this->json($list_cli);
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

    /**
     * Liste de clients par les webservices pour un représentant.
     *
     * @Route(
     *     name = "api_ws_clients_items_rep_get",
     *     path = "/api/ws/clients",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste de clients par les webservices pour un représentant.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Client::class, groups={"full"}))
     *     )
     * )
     */
    public function callWebserviceClientsForRepGetAction(Request $request) {
        $user = $this->user_service->getCurrentUser();
        $this->ws_manager->setUser($user);

        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getClientsWithRep();

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_CLI)) {
                $TTCli = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_CLI);

                $list_cli = array();
                for ($i = 0; $i < $TTCli->countItems(); $i++) {
                    $wsClient = $TTCli->getItem($i);

                    $client = new Client();
                    $client->parseObject($wsClient);

                    $client->setLienContacts('api/ws/contacts/'.$client->getIdCli().'/client');

                    $client->setLienDevis('api/ws/devis/'.$client->getIdCli().'/client');
                    $client->setLienCommandes('api/ws/commandes/'.$client->getIdCli().'/client');
                    $client->setLienBL('api/ws/bonslivraison/'.$client->getIdCli().'/client');
                    $client->setLienFactures('api/ws/factures/'.$client->getIdCli().'/client');

                    $client->setLienNbDevisEtatE('api/ws/devis/'.$client->getIdCli().'/client/current');
                    $client->setLienNbCommandesEtatE('api/ws/commandes/'.$client->getIdCli().'/client/current');
                    $client->setLienNbBLEtatE('api/ws/bonslivraison/'.$client->getIdCli().'/client/current');
                    $client->setLienNbFacturesEtatE('api/ws/factures/'.$client->getIdCli().'/client/current');

                    array_push($list_cli, $client);
                }

                return $this->json($list_cli);
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

    /**
     * Retourne le client par un identifiant unique.
     *
     * @Route(
     *     name = "api_ws_clients_items_idcli_get",
     *     path = "/api/ws/clients/{id_cli}/idcli",
     *     methods= "GET",
     *     requirements={"id_cli"="\d+"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne le client par un identifiant unique.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Client::class, groups={"full"}))
     *     )
     * )
     */
    public function callWebserviceClientsByIdCliGetAction($id_cli, Request $request) {
        // set the query parameters for create filter
        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getClientByIdCli($id_cli);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_CLI)) {
                $TTCli = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_CLI);

                $list_cli = array();
                for ($i = 0; $i < $TTCli->countItems(); $i++) {
                    $wsClient = $TTCli->getItem($i);

                    $client = new Client();
                    $client->parseObject($wsClient);

                    $client->setLienContacts('api/ws/contacts/'.$client->getIdCli().'/client');

                    $client->setLienDevis('api/ws/devis/'.$client->getIdCli().'/client');
                    $client->setLienCommandes('api/ws/commandes/'.$client->getIdCli().'/client');
                    $client->setLienBL('api/ws/bonslivraison/'.$client->getIdCli().'/client');
                    $client->setLienFactures('api/ws/factures/'.$client->getIdCli().'/client');

                    $client->setLienNbDevisEtatE('api/ws/devis/'.$client->getIdCli().'/client/current');
                    $client->setLienNbCommandesEtatE('api/ws/commandes/'.$client->getIdCli().'/client/current');
                    $client->setLienNbBLEtatE('api/ws/bonslivraison/'.$client->getIdCli().'/client/current');
                    $client->setLienNbFacturesEtatE('api/ws/factures/'.$client->getIdCli().'/client/current');

                    array_push($list_cli, $client);
                }

                return $this->json($list_cli);
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

    /**
     * Retourne le client par un numéro unique.
     *
     * @Route(
     *     name = "api_ws_clients_items_nocli_get",
     *     path = "/api/ws/clients/{no_cli}/nocli",
     *     methods= "GET",
     *     requirements={"no_cli"="\d+"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne le client par un numero unique.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Client::class, groups={"full"}))
     *     )
     * )
     */
    public function callWebserviceClientsByNoCliGetAction($no_cli, Request $request) {
        // set the query parameters for create filter
        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getClientByNoCli($no_cli);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_CLI)) {
                $TTCli = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_CLI);

                $list_cli = array();
                for ($i = 0; $i < $TTCli->countItems(); $i++) {
                    $wsClient = $TTCli->getItem($i);

                    $client = new Client();
                    $client->parseObject($wsClient);

                    $client->setLienContacts('api/ws/contacts/'.$client->getIdCli().'/client');

                    $client->setLienDevis('api/ws/devis/'.$client->getIdCli().'/client');
                    $client->setLienCommandes('api/ws/commandes/'.$client->getIdCli().'/client');
                    $client->setLienBL('api/ws/bonslivraison/'.$client->getIdCli().'/client');
                    $client->setLienFactures('api/ws/factures/'.$client->getIdCli().'/client');

                    $client->setLienNbDevisEtatE('api/ws/devis/'.$client->getIdCli().'/client/current');
                    $client->setLienNbCommandesEtatE('api/ws/commandes/'.$client->getIdCli().'/client/current');
                    $client->setLienNbBLEtatE('api/ws/bonslivraison/'.$client->getIdCli().'/client/current');
                    $client->setLienNbFacturesEtatE('api/ws/factures/'.$client->getIdCli().'/client/current');

                    array_push($list_cli, $client);
                }

                return $this->json($list_cli);
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

    /**
     * Retourne le client par un code client.
     *
     * @Route(
     *     name = "api_ws_clients_items_codcli_get",
     *     path = "/api/ws/clients/{cod_cli}/codcli",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne le client par un code client.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Client::class, groups={"full"}))
     *     )
     * )
     */
    public function callWebserviceClientsByCodCliGetAction($cod_cli, Request $request) {
        // set the query parameters for create filter
        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getClientByCodCli($cod_cli);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_CLI)) {
                $TTCli = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_CLI);

                $list_cli = array();
                for ($i = 0; $i < $TTCli->countItems(); $i++) {
                    $wsClient = $TTCli->getItem($i);

                    $client = new Client();
                    $client->parseObject($wsClient);

                    $client->setLienContacts('api/ws/contacts/'.$client->getIdCli().'/client');

                    $client->setLienDevis('api/ws/devis/'.$client->getIdCli().'/client');
                    $client->setLienCommandes('api/ws/commandes/'.$client->getIdCli().'/client');
                    $client->setLienBL('api/ws/bonslivraison/'.$client->getIdCli().'/client');
                    $client->setLienFactures('api/ws/factures/'.$client->getIdCli().'/client');

                    $client->setLienNbDevisEtatE('api/ws/devis/'.$client->getIdCli().'/client/current');
                    $client->setLienNbCommandesEtatE('api/ws/commandes/'.$client->getIdCli().'/client/current');
                    $client->setLienNbBLEtatE('api/ws/bonslivraison/'.$client->getIdCli().'/client/current');
                    $client->setLienNbFacturesEtatE('api/ws/factures/'.$client->getIdCli().'/client/current');

                    array_push($list_cli, $client);
                }

                return $this->json($list_cli);
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