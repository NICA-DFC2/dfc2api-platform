<?php

namespace App\Controller;

use App\Entity\Article;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\UserService;
use App\Services\WsManager;
use App\Utils\ErrorRoute;
use App\Utils\StockDepot;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;


class ArticlesController extends Controller
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
    }


//    /**
//     * Liste d'articles pour le client connecté.
//     *
//     * @Route(
//     *     name = "api_articles_list_items_get",
//     *     path = "/api/articles/list",
//     *     methods= "GET"
//     * )
//     * @SWG\Response(
//     *     response=200,
//     *     description="Retourne une liste d'articles pour le client connecté",
//     *     @SWG\Schema(
//     *         type="array",
//     *         @SWG\Items(ref=@Model(type=Article::class, groups={"full"}))
//     *     )
//     * )
//     */
//    public function articlesListGetAction(Request $request)
//    {
//        $this->ws_manager->setFilter($request->query->all());
//
//        $TTRetour = $this->ws_manager->getArticles();
//
//        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
//            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_ARTDET)) {
//                $TTArtDet = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);
//
//                $list_arts = array();
//                for ($i = 0; $i < $TTArtDet->countItems(); $i++) {
//                    $wsArtDet = $TTArtDet->getItem($i);
//
//                    // Lecture du tableau des stocks
//                    // Le retour est complexe on doit créer un tableau simplifié
//                    $stocks = $wsArtDet->getStocks();
//
//                    $arrayStocks = array();
//                    if (!is_null($stocks) && count($stocks) > 0) {
//                        // Création d'un tableau des stocks simplifié
//                        for ($i = 0; $i < count($stocks); $i++) {
//                            $wsStock = $stocks[$i];
//
//                            $TTDepotRetour = $this->ws_manager->getDepot($wsStock->getIdDep());
//                            if(!is_null($TTDepotRetour) && $TTDepotRetour instanceof TTRetour) {
//                                $TTDepot = $TTDepotRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DEPOT);
//                                $wsDepot = $TTDepot->getItem(0);
//
//                                $stockDepot = new StockDepot();
//                                $stockDepot->parseObject($wsStock, $wsDepot->getNomDep());
//                                $arrayStocks[$wsDepot->getNomDepLower()] = $stockDepot->parseString();
//                            }
//                        }
//                        $wsArtDet->setStocks($arrayStocks);
//                    }
//
//                    array_push($list_arts, $wsArtDet);
//                }
//
//                return $this->json($TTArtDet);
//            }
//            else {
//                return $this->json(array());
//            }
//        }
//        else if(!is_null($TTRetour) && $TTRetour instanceof Notif) {
//            return new JsonResponse(new ErrorRoute($TTRetour->getTexte(), 400), 400, array(), true);
//        }
//
//        return new JsonResponse(new ErrorRoute('Les paramètres renseignés ne sont pas pris en charge !', 406), 406, array(), true);
//    }
}