<?php
namespace App\Tests\EventListener;


use App\EventListener\AuthenticationTokenInvalidListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\InvalidTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class AuthenticationTokenInvalidListenerTest extends WebTestCase
{
    private $translator;

    public function setUp()
    {

        $kernel = static::createKernel();

        $kernel->boot();
        $this->translator =$kernel->getContainer()->get('translator');
    }


    /**
     *
     */
    public function testOnJWTInvalid(){
        $exception = new InvalidTokenException();

        $response = new JWTAuthenticationFailureResponse();
        $response->setStatusCode(401)->setMessage('Invalid JWT Token');
        $event = new JWTInvalidEvent($exception, $response);

        $authenticationTokenInvalidListener = new AuthenticationTokenInvalidListener($this->translator);

        $authenticationTokenInvalidListener->onJWTInvalid($event);
        $this->assertEquals(401, $event->getResponse()->getStatusCode());
        $this->assertEquals("Mauvaise identification (token)", $event->getResponse()->getMessage());
        $this->assertInstanceOf(JWTInvalidEvent::class, $event);
        $this->assertInstanceOf(JWTAuthenticationFailureResponse::class, $event->getResponse());
        $this->assertInstanceOf(InvalidTokenException::class, $event->getException());

    }

}
