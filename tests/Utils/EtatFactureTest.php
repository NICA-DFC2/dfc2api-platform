<?php

namespace App\Tests\Utils\Extensions;

use App\Services\Objets\WsFacCliAtt;
use App\Utils\EtatFacture;
use PHPUnit\Framework\TestCase;

class EtatFactureTest extends TestCase
{
    protected $etat_facture;

    public function setUp()
    {
        $this->etat_facture = new EtatFacture();
    }

    public function testParseObject() {

        // création de l'objet qui va permettre l'hydratation
        $wsFacCliAtt = new WsFacCliAtt();

        // hydratation
        $etat_facture = $this->etat_facture->parseObject($wsFacCliAtt);

        // vérifie si l'instance est du on type
        $this->assertInstanceOf(EtatFacture::class, $etat_facture, "L'objet parsé n'est pas une instance de type EtatFacture:class");
        // vérifie que l'hydration est exécutée
        $this->assertTrue($etat_facture->isFilled(), 'L\'objet $etat_facture a rencontré une erreur à son hydradation');
    }
}