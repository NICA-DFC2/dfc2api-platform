<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\UserService;
use App\Services\WsManager;
use App\Entity\Libelle;
use App\Utils\ErrorRoute;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class LibellesController extends Controller
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
     * LibellesController constructor.
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
        $this->setCurrentUser();
    }

    /**
     * Retourne une liste de libellés.
     *
     * @Route(
     *     name = "api_libelles_item_get",
     *     path = "/api/libelles",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste de libellés",
     *     @SWG\Schema(
     *         type="",
     *         @SWG\Items(ref=@Model(type=Libelle::class, groups={"full"}))
     *     )
     * )
     */
    public function libellesGetAction(Request $request)
    {
        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getLibelles();

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_LIB)) {
                $TTLib = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_LIB);

                $list_libelles = array();
                for ($i = 0; $i < $TTLib->countItems(); $i++) {
                    $wsLib = $TTLib->getItem($i);
                    $libelle = new Libelle();
                    $libelle->parseObject($wsLib);
                    array_push($list_libelles, $libelle);
                }

                return $this->json($list_libelles);
            }

            return $this->json(new Libelle());
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
            return new JsonResponse(new ErrorRoute($TTRetour->getTexte(), 400), 400, array(), true);
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