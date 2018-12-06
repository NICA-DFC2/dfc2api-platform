<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\Objets\Notif;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\UserService;
use App\Services\WsManager;
use App\Utils\ErrorRoute;
use App\Entity\FactureEnAttente;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;


class FacturesEnAttentesController extends AbstractController
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
     * FacturesEnAttentesController constructor.
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
     * Liste des factures en attentes pour le client connecté dans un ordre décroissant.
     *
     * @Route(
     *     name = "api_factures_en_attentes_items_get",
     *     path = "/api/ws/factures-en-attentes",
     *     methods= "GET"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Retourne une liste de factures en attentes pour le client connecté dans un ordre décroissant",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=FactureEnAttente::class, groups={"full"}))
     *     )
     * )
     */
    public function facturesEnAttentesGetAction(Request $request)
    {
        $user = $this->user_service->getCurrentUser();
        $this->ws_manager->setUser($user);

        $this->ws_manager->setFilter($request->query->all());

        $TTRetour = $this->ws_manager->getFacturesEnAttentes();

        if (!is_null($TTRetour) && $TTRetour instanceof TTRetour) {
            if($TTRetour->containsKey(WsTableNamesRetour::TABLENAME_TT_FACCLIATT)) {
                $TTFacCliAtt = $TTRetour->getTable(WsTableNamesRetour::TABLENAME_TT_FACCLIATT);

                $list_docs = array();
                for ($i = 0; $i < $TTFacCliAtt->countItems(); $i++) {
                    $wsFacCliAtt = $TTFacCliAtt->getItem($i);
                    $doc = new FactureEnAttente();
                    $doc->parseObject($wsFacCliAtt);
                    array_push($list_docs, $doc);
                }

                return $this->json($list_docs);
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