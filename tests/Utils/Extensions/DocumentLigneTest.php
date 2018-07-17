<?php

namespace App\Tests\Utils\Extensions;

use App\Services\Objets\WsDocumLig;
use App\Utils\Extensions\DocumentLigne;
use PHPUnit\Framework\TestCase;

class DocumentLigneTest extends TestCase
{
    protected $document_ligne;

    public function setUp()
    {
        $this->document_ligne = new DocumentLigne();
    }

    public function testParseObject() {

        // création de l'objet qui va permettre l'hydratation
        $wsDocumLig = new WsDocumLig();

        // hydratation
        $document_ligne = $this->document_ligne->parseObject($wsDocumLig);

        // vérifie si l'instance est du on type
        $this->assertInstanceOf(DocumentLigne::class, $document_ligne, "L'objet parsé n'est pas une instance de type DocumentLigne:class");
        // vérifie que l'hydration est exécutée
        $this->assertTrue($document_ligne->isFilled(), 'L\'objet $document_ligne a rencontré une erreur à son hydradation');
    }
}