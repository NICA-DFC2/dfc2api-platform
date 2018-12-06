<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\UserService;
use App\Services\WsManager;
use App\Utils\ErrorRoute;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;


class ContactsController extends AbstractController
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
     * ContactsController constructor.
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
     * Liste de contacts par les webservices pour un client.
     *
     * @Route(
     *     name = "api_ws_contacts_items_cli_get",
     *     path = "/api/ws/contacts/{id_cli}/client",
     *     methods= "GET",
     *     requirements={"id_cli"="\d+"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste de contacts par les webservices pour un client.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Contact::class, groups={"full"}))
     *     )
     * )
     */
    public function callWebserviceContactsForClientGetAction($id_cli, Request $request) {
        // set the query parameters for create filter
        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getContacts($id_cli);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_CONTACT)) {
                $TTContacts = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_CONTACT);

                $list_contacts = array();
                for ($iCt = 0; $iCt < $TTContacts->countItems(); $iCt++) {
                    $wsContact = $TTContacts->getItem($iCt);

                    $contact = new Contact();
                    $contact->parseObject($wsContact);

                    array_push($list_contacts, $contact);
                }

                return $this->json($list_contacts);
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