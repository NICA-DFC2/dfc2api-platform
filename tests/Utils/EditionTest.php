<?php

namespace App\Tests\Utils\Extensions;

use App\Services\Objets\WsEdition;
use App\Utils\Edition;
use PHPUnit\Framework\TestCase;

class EditionTest extends TestCase
{
    protected $edition;

    public function setUp()
    {
        $this->edition = new Edition();
    }

    public function testParseObject() {

        // création de l'objet qui va permettre l'hydratation
        $wsEdition = new WsEdition();

        // hydratation
        $edition = $this->edition->parseObject($wsEdition);

        // vérifie si l'instance est du on type
        $this->assertInstanceOf(Edition::class, $edition, "L'objet parsé n'est pas une instance de type Edition:class");
        // vérifie que l'hydration est exécutée
        $this->assertTrue($edition->isFilled(), 'L\'objet $edition a rencontré une erreur à son hydradation');
    }

}