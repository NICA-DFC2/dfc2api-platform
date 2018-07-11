<?php
namespace App\Tests\EventListener;


use App\EventListener\AuthenticationTokenNotFoundListener;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\MissingTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthenticationTokenNotFoundListenerTest extends WebTestCase
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
        $exception = new MissingTokenException();

        $response = new JWTAuthenticationFailureResponse();
        $response->setStatusCode(401)->setMessage('JWT Token not found');
        $event = new JWTNotFoundEvent($exception, $response);

        $authenticationTokenInvalidListener = new AuthenticationTokenNotFoundListener($this->translator);

        $authenticationTokenInvalidListener->onJWTNotFound($event);
        $this->assertEquals(401, $event->getResponse()->getStatusCode());
        $this->assertEquals("Le Token n'a pas été trouvé", $event->getResponse()->getMessage());
        $this->assertInstanceOf(JWTNotFoundEvent::class, $event);
        $this->assertInstanceOf(JWTAuthenticationFailureResponse::class, $event->getResponse());
        $this->assertInstanceOf(MissingTokenException::class, $event->getException());

    }

}
