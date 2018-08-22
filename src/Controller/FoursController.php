<?php

namespace App\Controller;

use App\Entity\Four;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\UserService;
use App\Services\WsManager;
use App\Utils\ErrorRoute;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;


class FoursController extends Controller
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
     * FoursController constructor.
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
     * Liste des categories par les webservices.
     *
     * @Route(
     *     name = "api_ws_fours_items_get",
     *     path = "/api/ws/fournisseurs",
     *     methods= "GET"
     * )
    * @SWG\Response(
    *     response=200,
    *     description="Retourne une liste des fournisseurs par les webservices.",
    *     @SWG\Schema(
    *         type="array",
    *         @SWG\Items(ref=@Model(type=Four::class, groups={"full"}))
    *     )
    * )
     */
    public function callWebserviceFoursGetAction(Request $request) {
        // set the query parameters for create filter
        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getFournisseurs();

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_FOUR)) {
                $TTFour = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_FOUR);

                $list_four = array();
                $nb = $TTFour->countItems();
                for ($i = 0; $i < $nb; $i++) {
                    $wsFour = $TTFour->getItem($i);
                    if(!is_null($wsFour)) {
                        $four = new Four();
                        $four->parseObject($wsFour);

                        array_push($list_four, $four);
                    }
                }

                return $this->json($list_four);
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