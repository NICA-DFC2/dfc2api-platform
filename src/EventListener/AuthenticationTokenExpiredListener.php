<?php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;


/**
 * AuthenticationTokenExpiredListener
 *
 */
class AuthenticationTokenExpiredListener
{
    /**
     * @param JWTExpiredEvent  $event
     */
    public function onJWTExpired(JWTExpiredEvent $event)
    {
        $response = new JWTAuthenticationFailureResponse('Votre token a expiré. Veuillez vous reconnecter !', 403);

        $event->setResponse($response);
    }
}