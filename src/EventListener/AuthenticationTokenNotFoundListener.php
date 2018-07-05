<?php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Translation\TranslatorInterface;


/**
 * AuthenticationTokenNotFoundListener
 *
 */
class AuthenticationTokenNotFoundListener
{
    private $translator;
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    /**
     * @param JWTNotFoundEvent $event
     */
    public function onJWTNotFound(JWTNotFoundEvent $event)
    {
        $message = $this->translator->trans($event->getResponse()->getMessage());
        $status = $event->getResponse()->getStatusCode();

        $response = new JWTAuthenticationFailureResponse($message, $status);

        $event->setResponse($response);
    }
}
