<?php
namespace App\Tests\EventListener;

use App\EventListener\AuthenticationTokenExpiredListener;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\ExpiredTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class AuthenticationTokenExpiredListenerTest extends WebTestCase
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
    public function testOnJWTExpired(){
        $exception = new ExpiredTokenException();
        $response = new JWTAuthenticationFailureResponse();
        $response->setStatusCode(401)->setMessage('Expired JWT Token');
        $event = new JWTExpiredEvent($exception, $response);


        $authenticationTokenExpiredListener = new AuthenticationTokenExpiredListener($this->translator);

        $authenticationTokenExpiredListener->onJWTExpired($event);
        $this->assertEquals(401, $event->getResponse()->getStatusCode());
        $this->assertEquals("Votre connexion a expirée, veuillez vous reconnecter", $event->getResponse()->getMessage());
        $this->assertInstanceOf(JWTExpiredEvent::class, $event);
        $this->assertInstanceOf(JWTAuthenticationFailureResponse::class, $event->getResponse());
        $this->assertInstanceOf(ExpiredTokenException::class, $event->getException());

    }

}
