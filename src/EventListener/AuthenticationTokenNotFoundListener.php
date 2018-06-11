<?php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * AuthenticationTokenNotFoundListener
 *
 */
class AuthenticationTokenNotFoundListener
{
    /**
     * @param JWTNotFoundEvent $event
     */
    public function onJWTNotFound(JWTNotFoundEvent $event)
    {
        $data = [
            'status' => '403 Interdit',
            'message' => 'Le token n\'est pas renseigné',
        ];

        $response = new JsonResponse($data, 403);

        $event->setResponse($response);
    }
}