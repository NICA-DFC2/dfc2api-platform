<?php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Component\Translation\TranslatorInterface;


/**
 * AuthenticationTokenExpiredListener
 *
 */
class AuthenticationTokenExpiredListener
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    /**
     * @param JWTExpiredEvent  $event
     */
    public function onJWTExpired(JWTExpiredEvent $event)
    {
        $message = $this->translator->trans($event->getResponse()->getMessage());
        $status = $event->getResponse()->getStatusCode();

        $response = new JWTAuthenticationFailureResponse($message, $status);
        //$response = new JWTAuthenticationFailureResponse('Votre token a expiré. Veuillez vous reconnecter !', 403);

        $event->setResponse($response);
    }
}
