<?php
namespace App\EventListener;

use App\Services\Objets\CntxAdmin;
use App\Services\Objets\TTRetour;
use App\Services\Parameters\WsAlgorithmOpenSSL;
use App\Services\Parameters\WsTableNamesRetour;
use App\Services\UserService;
use App\Services\WsManager;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use JMS\Serializer\SerializerBuilder;

/**
 * AuthenticationSuccessListener
 *
 */
class AuthenticationSuccessListener
{
    /**
     * @var WsManager
     */
    private $ws_manager;

    /**
     * @var UserService
     */
    private $user_service;

    /**
     * @param WsManager $manager
     * @param UserService $userService
     */
    public function __construct(WsManager $manager, UserService $userService)
    {
        $this->ws_manager = $manager;
        $this->user_service = $userService;
    }

    /**
     * Add public data to the authentication response
     *
     * @param AuthenticationSuccessEvent $event
     * @return mixed
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        // hydratation des propriétés de l'utilisateur via les webservice GIMEL
        $user = $this->user_service->getCurrentUser();

        $userInfos = $this->user_service->getUserInfos();
        $code = $event->getResponse()->getStatusCode();
        $token = $event->getData()['token'];
        $message = "Connexion réussie.";

        if(!$userInfos['cntx_valid']) {
            $message = "Connexion réussie mais sans les informations WS du client. Plus d'informations dans la propriété 'erreur' de l'objet user.";
            $userInfos = null;
            $token = null;
            $code = 403;
        }

        $event->setData([
            'code' => $code,
            'message' => $message,
            'user' => $userInfos,
            'token' => $token
        ]);
    }
}
