<?php
namespace App\Tests\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use App\EventListener\AuthenticationFailureListener;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Exception\AuthenticationException;


class AuthenticationFailureListenerTest extends WebTestCase
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
    public function testAuthenticationFailureListener(){
        $exception = new AuthenticationException();
        $response = new JWTAuthenticationFailureResponse();
        $event = new AuthenticationFailureEvent($exception, $response);

        $authenticationFailureListener = new AuthenticationFailureListener($this->translator);
        $authenticationFailureListener->onAuthenticationFailureResponse($event);
        $this->assertEquals(401, $event->getResponse()->getStatusCode());
        $this->assertEquals("Mauvaise identification, vérifier s'il vous plaît que username/password sont correctement renseignés", $event->getResponse()->getMessage());
        $this->assertInstanceOf(AuthenticationFailureEvent::class, $event);
        $this->assertInstanceOf(JWTAuthenticationFailureResponse::class, $event->getResponse());
        $this->assertInstanceOf(AuthenticationException::class, $event->getException());

    }

}
