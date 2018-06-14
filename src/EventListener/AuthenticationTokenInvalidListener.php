<?php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * AuthenticationTokenInvalidListener
 *
 */
class AuthenticationTokenInvalidListener
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param JWTInvalidEvent $event
     */
    public function onJWTInvalid(JWTInvalidEvent $event)
    {
        $message = $this->translator->trans($event->getResponse()->getMessage());
        $status = $event->getResponse()->getStatusCode();


        $response = new JWTAuthenticationFailureResponse($message, $status);

        $event->setResponse($response);
    }
}
