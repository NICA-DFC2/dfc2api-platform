<?php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
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

        $data = [
            'status' => $status,
            'message' => $message,
        ];

        $response = new JsonResponse($data, 403);

        $event->setResponse($response);
    }
}
