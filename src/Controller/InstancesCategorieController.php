<?php

namespace App\Controller;

use App\Entity\InstCat;
use App\Services\Objets\Notif;
use App\Services\Objets\TTParam;
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


class InstancesCategorieController extends Controller
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
    private $instances_categories;

    /**
     * InstancesCategorieController constructor.
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

        $this->getDemarre();
    }

    /**
     * Liste des categories par les webservices.
     *
     * @Route(
     *     name = "api_ws_instscats_items_get",
     *     path = "/api/ws/instances-categories",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste des categories par les webservices.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=InstCat::class, groups={"full"}))
     *     )
     * )
     */
    public function callWebserviceInstancesCategoriesGetAction(Request $request) {
        // set the query parameters for create filter
        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getInstsCats();

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_INSTCAT)) {
                $this->instances_categories = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_INSTCAT);

                $list_instcat = array();
                $nb = $this->instances_categories->countItems();
                for ($i = 0; $i < $nb; $i++) {
                    $wsInstCat = $this->instances_categories->getItem($i);
                    if(!is_null($wsInstCat)) {
                        $instCat = new InstCat();
                        $instCat->parseObject($wsInstCat);
                        $instCat = $this->getEnfants($instCat);

                        array_push($list_instcat, $instCat);
                        $nb = $this->instances_categories->countItems();
                    }
                }

                return $this->json($list_instcat);
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

    private function getEnfants(InstCat $instCat) {
        $enfants = $this->instances_categories->getItemsByFilterInArrayCollection('IdICP', $instCat->getIdIC());
        $i=0;
        foreach ($enfants as $wsInstCat) {
            $instCatE = new InstCat();
            $instCatE->parseObject($wsInstCat);
            $this->instances_categories->removeItem($wsInstCat);
            $instCatE = $this->getEnfants($instCatE);
            $enfants->set($i, $instCatE);
            $i++;
        }

        $instCat->setEnfants($enfants);

        return $instCat;
    }
}