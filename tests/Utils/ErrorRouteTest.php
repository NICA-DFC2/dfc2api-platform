<?php

namespace App\Tests\Utils\Extensions;

use App\Utils\ErrorRoute;
use PHPUnit\Framework\TestCase;

class ErrorRouteTest extends TestCase
{
    protected $error;

    public function setUp()
    {
        $this->error = new ErrorRoute('Error message', 401);
    }

    public function testConstructorCallsInternalMethods()
    {
        // vérifie que l'hydration du message est exécutée
        $message = $this->error->getError();
        $this->assertEquals('Error message', $this->error->getError(), "Le message retourné ($message) n'est pas la valeur souhaitée (Error message)");
        // vérifie que l'hydration du code est exécutée
        $code = $this->error->getStatusCode();
        $this->assertEquals(401, $code, "Le status code retourné ($code) n'est pas la valeur souhaitée (401)");
    }

    public function testToString()
    {
        $this->assertJson($this->error->__toString(), "La structure retournée n'est pas un json valide");
    }
}