<?php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * AuthenticationFailureListener
 *
 */
class AuthenticationFailureListener
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    /**
     * @param AuthenticationFailureEvent $event
     */
    public function onAuthenticationFailureResponse(AuthenticationFailureEvent $event)
    {
        $message = $this->translator->trans($event->getResponse()->getMessage());
        $status = $event->getResponse()->getStatusCode();

        $response = new JWTAuthenticationFailureResponse($message, $status);

        $event->setResponse($response);
    }
}
