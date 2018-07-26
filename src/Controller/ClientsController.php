<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Contact;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\UserService;
use App\Services\WsManager;
use App\Utils\ErrorRoute;
use Doctrine\Common\Collections\ArrayCollection;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;


class ClientsController extends Controller
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
     * ArticlesController constructor.
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

        $this->getDemarre();
    }




    /**
     * Liste de clients par les webservices pour un représentant.
     *
     * @Route(
     *     name = "api_ws_clients_items_idrep_get",
     *     path = "/api/ws/clients/{id_rep}/representant",
     *     methods= "GET",
     *     requirements={"id_rep"="\d+"}
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
    public function callWebserviceClientsWithRepGetAction($id_rep, Request $request) {
        // set the query parameters for create filter
        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getClientsWithRep($id_rep);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_CLI)) {
                $TTCli = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_CLI);

                $list_cli = array();
                for ($i = 0; $i < $TTCli->countItems(); $i++) {
                    $wsClient = $TTCli->getItem($i);

                    $client = new Client();
                    $client->parseObject($wsClient);

                    /**
                     * TODO: L'appel webservice pour lire les contacts ne retourne pas d'enregistrements. A VERIFIER AVEC GIMEL
                     *
                     */
//                    $TTRetourCt = $this->ws_manager->getContacts($client->getIdCli());
//                    if (!is_null($TTRetourCt) && $TTRetourCt instanceof TTRetour) {
//                        if($TTRetourCt->containsKey(WsTableNamesRetour::TABLENAME_TT_CONTACT)) {
//                            $TTContacts = $TTRetourCt->getTable(WsTableNamesRetour::TABLENAME_TT_CONTACT);
//
//                            $list_contacts = new ArrayCollection();
//                            for ($iCt = 0; $iCt < $TTContacts->countItems(); $iCt++) {
//                                $wsContact = $TTContacts->getItem($iCt);
//
//                                $contact = new Contact();
//                                $contact->parseObject($wsContact);
//
//                                $list_contacts->add($contact);
//                            }
//                            $client->setContacts($list_contacts);
//                        }
//                    }

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

                    /**
                     * TODO: L'appel webservice pour lire les contacts ne retourne pas d'enregistrements. A VERIFIER AVEC GIMEL
                     *
                     */
//                    $TTRetourCt = $this->ws_manager->getContacts($client->getIdCli());
//                    if (!is_null($TTRetourCt) && $TTRetourCt instanceof TTRetour) {
//                        if($TTRetourCt->containsKey(WsTableNamesRetour::TABLENAME_TT_CONTACT)) {
//                            $TTContacts = $TTRetourCt->getTable(WsTableNamesRetour::TABLENAME_TT_CONTACT);
//
//                            $list_contacts = new ArrayCollection();
//                            for ($iCt = 0; $iCt < $TTContacts->countItems(); $iCt++) {
//                                $wsContact = $TTContacts->getItem($iCt);
//
//                                $contact = new Contact();
//                                $contact->parseObject($wsContact);
//
//                                $list_contacts->add($contact);
//                            }
//                            $client->setContacts($list_contacts);
//                        }
//                    }

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

                    /**
                     * TODO: L'appel webservice pour lire les contacts ne retourne pas d'enregistrements. A VERIFIER AVEC GIMEL
                     *
                     */
//                    $TTRetourCt = $this->ws_manager->getContacts($client->getIdCli());
//                    if (!is_null($TTRetourCt) && $TTRetourCt instanceof TTRetour) {
//                        if($TTRetourCt->containsKey(WsTableNamesRetour::TABLENAME_TT_CONTACT)) {
//                            $TTContacts = $TTRetourCt->getTable(WsTableNamesRetour::TABLENAME_TT_CONTACT);
//
//                            $list_contacts = new ArrayCollection();
//                            for ($iCt = 0; $iCt < $TTContacts->countItems(); $iCt++) {
//                                $wsContact = $TTContacts->getItem($iCt);
//
//                                $contact = new Contact();
//                                $contact->parseObject($wsContact);
//
//                                $list_contacts->add($contact);
//                            }
//                            $client->setContacts($list_contacts);
//                        }
//                    }

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

                    /**
                     * TODO: L'appel webservice pour lire les contacts ne retourne pas d'enregistrements. A VERIFIER AVEC GIMEL
                     *
                     */
//                    $TTRetourCt = $this->ws_manager->getContacts($client->getIdCli());
//                    if (!is_null($TTRetourCt) && $TTRetourCt instanceof TTRetour) {
//                        if($TTRetourCt->containsKey(WsTableNamesRetour::TABLENAME_TT_CONTACT)) {
//                            $TTContacts = $TTRetourCt->getTable(WsTableNamesRetour::TABLENAME_TT_CONTACT);
//
//                            $list_contacts = new ArrayCollection();
//                            for ($iCt = 0; $iCt < $TTContacts->countItems(); $iCt++) {
//                                $wsContact = $TTContacts->getItem($iCt);
//
//                                $contact = new Contact();
//                                $contact->parseObject($wsContact);
//
//                                $list_contacts->add($contact);
//                            }
//                            $client->setContacts($list_contacts);
//                        }
//                    }

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
     * Démarrage du webservice gimel avec le compte ADMIN
     */
    private function getDemarre() {
        $this->ws_manager->getDemarre();
    }
}