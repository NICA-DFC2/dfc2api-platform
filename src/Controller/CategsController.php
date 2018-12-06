<?php

namespace App\Controller;

use App\Entity\Categ;
use App\Services\Objets\Notif;
use App\Services\Objets\TTParam;
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


class CategsController extends AbstractController
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
     * @var TTParam
     */
    private $categories;

    /**
     * CategsController constructor.
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
     *     name = "api_ws_categs_items_get",
     *     path = "/api/ws/categories",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste des categories par les webservices.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Categ::class, groups={"full"}))
     *     )
     * )
     */
    public function callWebserviceCategsGetAction(Request $request) {
        // set the query parameters for create filter
        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getCategories();

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_CATEG)) {
                $this->categories = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_CATEG);

                $list_cat = array();
                $nb = $this->categories->countItems();
                for ($i = 0; $i < $nb; $i++) {
                    $wsCateg = $this->categories->getItem($i);
                    if(!is_null($wsCateg)) {
                        $categ = new Categ();
                        $categ->parseObject($wsCateg);

                        array_push($list_cat, $categ);
                    }
                }

                return $this->json($list_cat);
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