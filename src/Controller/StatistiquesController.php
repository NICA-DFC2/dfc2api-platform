<?php

namespace App\Controller;

use App\Entity\StatClient;
use App\Entity\StatClientArt;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsParameters;
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

class StatistiquesController extends Controller
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
    }

    /**
     * Retourne les statistiques du client connecté.
     *
     * @Route(
     *     name = "api_stats_client_items_get",
     *     path = "/api/ws/statistiques/client",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne les statistiques du client connecté",
     *     @SWG\Schema(
     *         type="",
     *         @SWG\Items(ref=@Model(type=StatClient::class, groups={"full"}))
     *     )
     * )
     */
    public function statistiquesClientGetAction(Request $request)
    {
        $user = $this->user_service->getCurrentUser();
        $this->ws_manager->setUser($user);

        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getStatistiquesClient();

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_STAT)) {
                $TTStat = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_STAT);

                $list_stats = array();
                for ($i = 0; $i < $TTStat->countItems(); $i++) {
                    $wsStat = $TTStat->getItem($i);
                    $stat = new StatClient();
                    $stat->parseObject($wsStat);
                    array_push($list_stats, $stat);
                }

                return $this->json($list_stats);
            }

            return $this->json(new StatClient());
        }
        else if(!is_null($TTRetour) && $TTRetour instanceof Notif) {
            return new JsonResponse(new ErrorRoute($TTRetour->getTexte(), 400), 400, array(), true);
        }

        return new JsonResponse(new ErrorRoute('Les paramètres renseignés ne sont pas pris en charge !', 406), 406, array(), true);
    }

    /**
     * Retourne les statistiques du client connecté.
     *
     * @Route(
     *     name = "api_stats_client_article_items_get",
     *     path = "/api/ws/statistiques/client/article",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne les statistiques du client connecté",
     *     @SWG\Schema(
     *         type="",
     *         @SWG\Items(ref=@Model(type=StatClientArt::class, groups={"full"}))
     *     )
     * )
     */
    public function statistiquesClientArticleGetAction(Request $request)
    {
        $user = $this->user_service->getCurrentUser();
        $this->ws_manager->setUser($user);

        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getStatistiquesClient(WsParameters::TYPE_DONNEE_STAT_CLI_ART);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_STAT)) {
                $TTStat = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_STAT);

                $list_stats = array();
                for ($i = 0; $i < $TTStat->countItems(); $i++) {
                    $wsStat = $TTStat->getItem($i);
                    $stat = new StatClientArt();
                    $stat->parseObject($wsStat);
                    array_push($list_stats, $stat);
                }

                return $this->json($list_stats);
            }

            return $this->json(new StatClientArt());
        }
        else if(!is_null($TTRetour) && $TTRetour instanceof Notif) {
            return new JsonResponse(new ErrorRoute($TTRetour->getTexte(), 400), 400, array(), true);
        }

        return new JsonResponse(new ErrorRoute('Les paramètres renseignés ne sont pas pris en charge !', 406), 406, array(), true);
    }

    /**
     * Retourne les statistiques du client connecté.
     *
     * @Route(
     *     name = "api_stats_client_rep_items_get",
     *     path = "/api/ws/statistiques/client/representant",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne les statistiques du client connecté",
     *     @SWG\Schema(
     *         type="",
     *         @SWG\Items(ref=@Model(type=StatClient::class, groups={"full"}))
     *     )
     * )
     */
    public function statistiquesClientRepGetAction(Request $request)
    {
        $user = $this->user_service->getCurrentUser();
        $this->ws_manager->setUser($user);

        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getStatistiquesClient(WsParameters::TYPE_DONNEE_STAT_REP_CLI);

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_STAT)) {
                $TTStat = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_STAT);

                $list_stats = array();
                for ($i = 0; $i < $TTStat->countItems(); $i++) {
                    $wsStat = $TTStat->getItem($i);
                    $stat = new StatClient();
                    $stat->parseObject($wsStat);
                    array_push($list_stats, $stat);
                }

                return $this->json($list_stats);
            }

            return $this->json(new StatClient());
        }
        else if(!is_null($TTRetour) && $TTRetour instanceof Notif) {
            return new JsonResponse(new ErrorRoute($TTRetour->getTexte(), 400), 400, array(), true);
        }

        return new JsonResponse(new ErrorRoute('Les paramètres renseignés ne sont pas pris en charge !', 406), 406, array(), true);
    }
}