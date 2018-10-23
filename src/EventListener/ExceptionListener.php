<?php

namespace App\EventListener;

use Symfony\Component\Debug\Exception\UndefinedMethodException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Unirest;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getException();

        // Customize your response object to display the exception details
        $response = new Response();

        if ($exception instanceof Unirest\Exception) {
            $message = array(
                'message' => str_replace('"', "'", $exception->getMessage()),
                'code' => 504,
                'file' => str_replace('"', "'", $exception->getFile()),
                'line' => str_replace('"', "'", $exception->getLine()),
                'trace' => $exception->getTrace()
            );
            $response->setStatusCode('504');
        }
        else if($exception instanceof UndefinedMethodException) {
            $message = array(
                'message' => str_replace('"', "'", $exception->getMessage()),
                'code' => 500,
                'file' => str_replace('"', "'", $exception->getFile()),
                'line' => str_replace('"', "'", $exception->getLine()),
                'trace' => $exception->getTrace()
            );
            $response->setStatusCode('500');
        }
        else if($exception instanceof \RuntimeException) {
            $message = array(
                'message' => str_replace('"', "'", $exception->getMessage()),
                'code' => 500,
                'file' => str_replace('"', "'", $exception->getFile()),
                'line' => str_replace('"', "'", $exception->getLine()),
                'trace' => $exception->getTrace()
            );
            $response->setStatusCode('500');
        }
        else if($exception instanceof \Exception) {
            $message = array(
                'message' => str_replace('"', "'", $exception->getMessage()),
                'code' => 500,
                'file' => str_replace('"', "'", $exception->getFile()),
                'line' => str_replace('"', "'", $exception->getLine()),
                'trace' => $exception->getTrace()
            );
            $response->setStatusCode('500');
        }
        else {
            $message = array(
                'message' => str_replace('"', "'", $exception->getMessage()),
                'code' => $exception->getStatusCode(),
                'file' => str_replace('"', "'", $exception->getFile()),
                'line' => str_replace('"', "'", $exception->getLine()),
                'trace' => $exception->getTrace()
            );
            $response->setStatusCode($exception->getStatusCode());
        }

        $response->setContent(json_encode($message));

        if ($exception instanceof HttpExceptionInterface) {
            $response->headers->replace($exception->getHeaders());
        }

        $response->headers->set('Content-Type', 'application/json', true);

        // sends the modified response object to the event
        $event->setResponse($response);
    }
}