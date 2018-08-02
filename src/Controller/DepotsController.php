<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\UserService;
use App\Services\WsManager;
use App\Entity\Depot;
use App\Utils\ErrorRoute;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class DepotsController extends Controller
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
     * DepotsController constructor.
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

        $user = $this->user_service->getCurrentUser();
        $this->ws_manager->setUser($user);
    }

    /**
     * Retourne un depot.
     *
     * @Route(
     *     name = "api_depots_item_get",
     *     path = "/api/ws/depots/{id}",
     *     methods= "GET",
     *     requirements={"id"="\d+"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne un depot",
     *     @SWG\Schema(
     *         type="",
     *         @SWG\Items(ref=@Model(type=Depot::class, groups={"full"}))
     *     )
     * )
     */
    public function depotGetAction(Request $request, $id)
    {
        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getDepot($id);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_DEPOT)) {
                $TTDepot = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DEPOT);

                $depot = new Depot();
                for ($i = 0; $i < $TTDepot->countItems(); $i++) {
                    $wsDepot = $TTDepot->getItem($i);
                    $depot->parseObject($wsDepot);
                }

                return $this->json($depot);
            }

            return $this->json(new Depot());
        }
        else if(!is_null($TTRetour) && $TTRetour instanceof Notif) {
            return new JsonResponse(new ErrorRoute($TTRetour->getTexte(), 400), 400, array(), true);
        }

        return new JsonResponse(new ErrorRoute('Les paramètres renseignés ne sont pas pris en charge !', 406), 406, array(), true);
    }

    /**
     * Retourne la liste des dépots.
     *
     * @Route(
     *     name = "api_depots_items_get",
     *     path = "/api/ws/depots",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne la liste des dépots",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Depot::class, groups={"full"}))
     *     )
     * )
     */
    public function depotsGetAction(Request $request)
    {
        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getDepots();

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_DEPOT)) {
                $TTDepot = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DEPOT);

                $list_depots = array();
                for ($i = 0; $i < $TTDepot->countItems(); $i++) {
                    $wsDepot = $TTDepot->getItem($i);
                    $depot = new Depot();
                    $depot->parseObject($wsDepot);
                    array_push($list_depots, $depot);
                }

                return $this->json($list_depots);
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