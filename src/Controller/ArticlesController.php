<?php

namespace App\Controller;

use App\Entity\Article;
use App\Services\Objets\Notif;
use App\Services\Objets\TTParam;
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
     * @var TTParam
     * @SWG\Property(
     *     name="depots",
     *     type="TTParam",
     *     description="Liste des dépots disponibles")
     */
    private $depots;

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
        $this->getDepots();
    }


    /**
     * Liste d'articles par les webservices.
     *
     * @Route(
     *     name = "api_ws_articles_items_get",
     *     path = "/api/ws/articles",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste d'articles par les webservices",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class, groups={"full"}))
     *     )
     * )
     */
    public function callWebserviceArticlesGetAction(Request $request) {
        // set the query parameters for create filter
        $this->ws_manager->setFilter($request->query->all());

        $depots = array();
        $parseUrl = parse_url($request->getUri());
        if(array_key_exists('query', $parseUrl)){
            parse_str($parseUrl['query'], $arrayQuery);

            if(array_key_exists('depots', $arrayQuery)){
                $depots = $arrayQuery['depots'];
                if(is_array(json_decode($depots))){
                    $depots = json_decode($depots);
                }
                else {
                    $depots = array($depots);
                }
            }
        }

        $TTRetour = $this->ws_manager->getArticles($depots);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_ARTDET)) {
                $TTArtDet = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

                $list_arts = array();
                for ($i = 0; $i < $TTArtDet->countItems(); $i++) {
                    $wsArtDet = $TTArtDet->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArtDet->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($i = 0; $i < count($stocks); $i++) {
                            $wsStock = $stocks[$i];
                            $wsDepot = $this->getDepot($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, $wsDepot->getNomDep());
                            $arrayStocks[$wsDepot->getNomDepLower()] = $stockDepot->parseString();
                        }
                        $wsArtDet->setStocks($arrayStocks);
                    }

                    array_push($list_arts, $wsArtDet);
                }

                return $this->json($TTArtDet);
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
     * Liste d'articles par les webservices pour un client.
     *
     * @Route(
     *     name = "api_ws_articles_items_client_get",
     *     path = "/api/ws/articles/{id_cli}/client",
     *     methods= "GET",
     *     requirements={"id_cli"="\d+"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste d'articles par les webservices pour un client",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class, groups={"full"}))
     *     )
     * )
     */
    public function callWebserviceArticlesWithClientGetAction($id_cli, Request $request) {
        // set the query parameters for create filter
        $this->ws_manager->setFilter($request->query->all());

        $depots = array();
        $parseUrl = parse_url($request->getUri());
        if(array_key_exists('query', $parseUrl)){
            parse_str($parseUrl['query'], $arrayQuery);

            if(array_key_exists('depots', $arrayQuery)){
                $depots = $arrayQuery['depots'];
                if(is_array(json_decode($depots))){
                    $depots = json_decode($depots);
                }
                else {
                    $depots = array($depots);
                }
            }
        }

        $TTRetour = $this->ws_manager->getArticlesWithClient($id_cli, $depots);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_ARTDET)) {
                $TTArtDet = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

                $list_arts = array();
                for ($i = 0; $i < $TTArtDet->countItems(); $i++) {
                    $wsArtDet = $TTArtDet->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArtDet->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($i = 0; $i < count($stocks); $i++) {
                            $wsStock = $stocks[$i];
                            $wsDepot = $this->getDepot($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, $wsDepot->getNomDep());
                            $arrayStocks[$wsDepot->getNomDepLower()] = $stockDepot->parseString();
                        }
                        $wsArtDet->setStocks($arrayStocks);
                    }

                    array_push($list_arts, $wsArtDet);
                }

                return $this->json($TTArtDet);
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
     * Liste d'articles par les webservices pour un client et un numéro d'article.
     *
     * @Route(
     *     name = "api_ws_article_item_client_noad_get",
     *     path = "/api/ws/articles/{no_ad}/noad/{id_cli}/client",
     *     methods= "GET",
     *     requirements={"id_cli"="\d+", "no_ad"="\d+"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste d'articles par les webservices pour un client et un numéro d'article",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class, groups={"full"}))
     *     )
     * )
     */
    public function callWebserviceArticleWithClientByNoADGetAction($id_cli, $no_ad, Request $request) {
        // set the query parameters for create filter
        $this->ws_manager->setFilter($request->query->all());

        $depots = array();
        $parseUrl = parse_url($request->getUri());

        if(array_key_exists('query', $parseUrl)){
            parse_str($parseUrl['query'], $arrayQuery);

            if(array_key_exists('depots', $arrayQuery)){
                $depots = $arrayQuery['depots'];
                if(is_array(json_decode($depots))){
                    $depots = json_decode($depots);
                }
                else {
                    $depots = array($depots);
                }
            }
        }

        $TTRetour = $this->ws_manager->getArticleWithClientByNoAD($id_cli, $no_ad, $depots);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_ARTDET)) {
                $TTArtDet = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

                $list_arts = array();
                for ($i = 0; $i < $TTArtDet->countItems(); $i++) {
                    $wsArtDet = $TTArtDet->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArtDet->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($i = 0; $i < count($stocks); $i++) {
                            $wsStock = $stocks[$i];
                            $wsDepot = $this->getDepot($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, $wsDepot->getNomDep());
                            $arrayStocks[$wsDepot->getNomDepLower()] = $stockDepot->parseString();
                        }
                        $wsArtDet->setStocks($arrayStocks);
                    }

                    array_push($list_arts, $wsArtDet);
                }

                return $this->json($TTArtDet);
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
     * Liste d'articles par les webservices pour un client et un identifiant unique d'article.
     *
     * @Route(
     *     name = "api_ws_article_item_client_idad_get",
     *     path = "/api/ws/articles/{id_ad}/idad/{id_cli}/client",
     *     methods= "GET",
     *     requirements={"id_cli"="\d+", "id_ad"="\d+"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste d'articles par les webservices pour un client et un identifiant unique d'article.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class, groups={"full"}))
     *     )
     * )
     */
    public function callWebserviceArticleWithClientByIdADGetAction($id_cli, $id_ad, Request $request) {
        // set the query parameters for create filter
        $this->ws_manager->setFilter($request->query->all());

        $depots = array();
        $parseUrl = parse_url($request->getUri());

        if(array_key_exists('query', $parseUrl)){
            parse_str($parseUrl['query'], $arrayQuery);

            if(array_key_exists('depots', $arrayQuery)){
                $depots = $arrayQuery['depots'];
                if(is_array(json_decode($depots))){
                    $depots = json_decode($depots);
                }
                else {
                    $depots = array($depots);
                }
            }
        }

        $TTRetour = $this->ws_manager->getArticleWithClientByIdAD($id_cli, $id_ad, $depots);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_ARTDET)) {
                $TTArtDet = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

                $list_arts = array();
                for ($i = 0; $i < $TTArtDet->countItems(); $i++) {
                    $wsArtDet = $TTArtDet->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArtDet->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($i = 0; $i < count($stocks); $i++) {
                            $wsStock = $stocks[$i];
                            $wsDepot = $this->getDepot($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, $wsDepot->getNomDep());
                            $arrayStocks[$wsDepot->getNomDepLower()] = $stockDepot->parseString();
                        }
                        $wsArtDet->setStocks($arrayStocks);
                    }

                    array_push($list_arts, $wsArtDet);
                }

                return $this->json($TTArtDet);
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
     * Liste d'articles par les webservices pour un client et un identifiant unique d'article.
     *
     * @Route(
     *     name = "api_ws_article_item_client_codad_get",
     *     path = "/api/ws/articles/{cod_ad}/codad/{id_cli}/client",
     *     methods= "GET",
     *     requirements={"id_cli"="\d+"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste d'articles par les webservices pour un client et un identifiant unique d'article.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class, groups={"full"}))
     *     )
     * )
     */
    public function callWebserviceArticleWithClientByCodADGetAction($id_cli, $cod_ad, Request $request) {
        // set the query parameters for create filter
        $this->ws_manager->setFilter($request->query->all());

        $depots = array();
        $parseUrl = parse_url($request->getUri());

        if(array_key_exists('query', $parseUrl)){
            parse_str($parseUrl['query'], $arrayQuery);

            if(array_key_exists('depots', $arrayQuery)){
                $depots = $arrayQuery['depots'];
                if(is_array(json_decode($depots))){
                    $depots = json_decode($depots);
                }
                else {
                    $depots = array($depots);
                }
            }
        }

        $TTRetour = $this->ws_manager->getArticleWithClientByCodAD($id_cli, $cod_ad, $depots);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_ARTDET)) {
                $TTArtDet = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

                $list_arts = array();
                for ($i = 0; $i < $TTArtDet->countItems(); $i++) {
                    $wsArtDet = $TTArtDet->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArtDet->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($i = 0; $i < count($stocks); $i++) {
                            $wsStock = $stocks[$i];
                            $wsDepot = $this->getDepot($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, $wsDepot->getNomDep());
                            $arrayStocks[$wsDepot->getNomDepLower()] = $stockDepot->parseString();
                        }
                        $wsArtDet->setStocks($arrayStocks);
                    }

                    array_push($list_arts, $wsArtDet);
                }

                return $this->json($TTArtDet);
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
     * Liste d'articles par les webservices pour un client et un identifiant unique d'article.
     *
     * @Route(
     *     name = "api_ws_article_item_client_idart_get",
     *     path = "/api/ws/articles/{id_art}/idart/{id_cli}/client",
     *     methods= "GET",
     *     requirements={"id_cli"="\d+", "id_art"="\d+"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste d'articles par les webservices pour un client et un identifiant unique d'article.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class, groups={"full"}))
     *     )
     * )
     */
    public function callWebserviceArticleWithClientByIdArtGetAction($id_cli, $id_art, Request $request) {
        // set the query parameters for create filter
        $this->ws_manager->setFilter($request->query->all());

        $depots = array();
        $parseUrl = parse_url($request->getUri());

        if(array_key_exists('query', $parseUrl)){
            parse_str($parseUrl['query'], $arrayQuery);

            if(array_key_exists('depots', $arrayQuery)){
                $depots = $arrayQuery['depots'];
                if(is_array(json_decode($depots))){
                    $depots = json_decode($depots);
                }
                else {
                    $depots = array($depots);
                }
            }
        }

        $TTRetour = $this->ws_manager->getArticleWithClientByIdArt($id_cli, $id_art, $depots);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_ARTDET)) {
                $TTArtDet = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_ARTDET);

                $list_arts = array();
                for ($i = 0; $i < $TTArtDet->countItems(); $i++) {
                    $wsArtDet = $TTArtDet->getItem($i);

                    // Lecture du tableau des stocks
                    // Le retour est complexe on doit créer un tableau simplifié
                    $stocks = $wsArtDet->getStocks();

                    $arrayStocks = array();
                    if (!is_null($stocks) && count($stocks) > 0) {
                        // Création d'un tableau des stocks simplifié
                        for ($i = 0; $i < count($stocks); $i++) {
                            $wsStock = $stocks[$i];
                            $wsDepot = $this->getDepot($wsStock->getIdDep());

                            $stockDepot = new StockDepot();
                            $stockDepot->parseObject($wsStock, $wsDepot->getNomDep());
                            $arrayStocks[$wsDepot->getNomDepLower()] = $stockDepot->parseString();
                        }
                        $wsArtDet->setStocks($arrayStocks);
                    }

                    array_push($list_arts, $wsArtDet);
                }

                return $this->json($TTArtDet);
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
     * @return TTParam|mixed
     */
    private function getDepots(){
        $TTDepotRetour = $this->ws_manager->getDepots();
        if(!is_null($TTDepotRetour) && $TTDepotRetour instanceof TTRetour) {
            $this->depots = $TTDepotRetour->getTable(WsTableNamesRetour::TABLENAME_TT_DEPOT);
            return $this->depots;

        }
        return new TTParam();
    }

    /**
     * @param $id_depot
     * @return mixed
     */
    private function getDepot($id_depot){
        return $this->depots->getItemByFilter('IdDep', $id_depot);
    }

    /**
     * Démarrage du webservice gimel avec le compte ADMIN
     */
    private function getDemarre() {
        $this->ws_manager->getDemarre();
    }
}