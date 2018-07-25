<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getException();

        // Customize your response object to display the exception details
        $response = new Response();

        $message = array(
            'message' => str_replace('"', "'", $exception->getMessage()),
            'code' => $exception->getStatusCode(),
            'file' => str_replace('"', "'", $exception->getFile()),
            'line' => str_replace('"', "'", $exception->getLine()),
            'trace' => $exception->getTrace()
        );

        $response->setContent(json_encode($message));
        $response->setStatusCode($exception->getStatusCode());

        if ($exception instanceof HttpExceptionInterface) {
            $response->headers->replace($exception->getHeaders());

        }
        $response->headers->set('Content-Type', 'application/json', true);

        // sends the modified response object to the event
        $event->setResponse($response);
    }
}