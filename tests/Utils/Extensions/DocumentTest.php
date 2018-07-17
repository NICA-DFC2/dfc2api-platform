<?php

namespace App\Tests\Utils\Extensions;

use App\Services\Objets\WsDocumEnt;
use App\Utils\Edition;
use App\Utils\Extensions\Document;
use App\Utils\Ligne;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
    protected $document;

    public function setUp()
    {
        $this->document = new Document();

        // on ajoute 2 lignes dans la collection pour les tests
        $ligne = new Ligne();
        $this->document->setLignes($ligne);
        $this->document->setLignes($ligne);

        $edition = new Edition();
        $this->document->setEdition($edition);
    }
    
    public function testGetLignes()
    {
        $lignes = $this->document->getLignes();
        $nb = count($lignes);

        // On vérifie que la collection contient bien les 2 éléments ajoutés
        $this->assertCount(2, $lignes, "La collection ne contient pas le nombre d'éléments attendu (2 éléments). Il y a $nb élément(s) dans la collection");
    }

    public function testGetEdition()
    {
        // On vérifie que la collection contient bien les 2 éléments ajoutés
        $this->assertInstanceOf(Edition::class, $this->document->getEdition(), "L'objet parsé n'est pas une instance de type Edition:class");
    }

    public function testGetLigne()
    {
        // On vérifie que la collection contient bien une instance de Ligne à l'index 0
        $this->assertInstanceOf(Ligne::class, $this->document->getLigne(0), "La collection ne contient pas d'instance de type Ligne::class à l'index 0");
    }

    public function testSetDateDE() {

        $now = new \DateTime('now');
        $this->document->setDateDE($now);

        // vérifie que l'hydration est exécutée
        $this->assertEquals($now, $this->document->getDateDE(), "La DateDE retourné n'est pas la valeur souhaitée");
    }

    public function testParseObject() {

        // création de l'objet qui va permettre l'hydratation
        $wsDocumEnt = new WsDocumEnt();

        // hydratation
        $document = $this->document->parseObject($wsDocumEnt);

        // vérifie si l'instance est du on type
        $this->assertInstanceOf(Document::class, $document, "L'objet parsé n'est pas une instance de type Document:class");
        // vérifie que l'hydration est exécutée
        $this->assertTrue($document->isFilled(), 'L\'objet $document a rencontré une erreur à son hydradation');
    }

    public function testParseObjectWithDateDE() {

        // création de l'objet qui va permettre l'hydratation
        $wsDocumEnt = new WsDocumEnt();
        $now = new \DateTime('now');
        $wsDocumEnt->setDateDE($now);

        // hydratation
        $document = $this->document->parseObject($wsDocumEnt);

        // vérifie si l'instance est du on type
        $this->assertInstanceOf(Document::class, $document, "L'objet parsé n'est pas une instance de type Document:class");
        // vérifie que l'hydration est exécutée
        $this->assertTrue($document->isFilled(), 'L\'objet $document a rencontré une erreur à son hydradation');
        // vérifie que l'hydration est exécutée
        $this->assertEquals($now, $this->document->getDateDE(), "La DateDE retourné n'est pas la valeur souhaitée");
    }


}