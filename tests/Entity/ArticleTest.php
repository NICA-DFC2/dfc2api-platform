<?php

namespace App\Tests;

use App\Entity\Article;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

class ArticleTest extends TestCase
{
    private $article = NULL;

    public function setUp()
    {
        $this->article = new Article();
    }

    public function testGetIdAD()
    {
        $this->article->setIdAD(0);
        $this->assertEquals(0, $this->article->getIdAD());
    }

    public function testGetIdArtEvoAD()
    {
        $this->article->setIdArtEvoAD(0);
        $this->assertEquals(0, $this->article->getIdArtEvoAD());
    }

    public function testGetDesiAD()
    {
        $this->article->setDesiAD('test');
        $this->assertEquals('test', $this->article->getDesiAD());
    }

    public function testGetDesiPrincAD()
    {
        $this->article->setDesiPrincAD('test');
        $this->assertEquals('test', $this->article->getDesiPrincAD());
    }

    public function testGetDescriWebAD()
    {
        $this->article->setDescriWebAD('test');
        $this->assertEquals('test', $this->article->getDescriWebAD());
    }

    public function testGetDescriCatalogAD()
    {
        $this->article->setDescriCatalogAD('test');
        $this->assertEquals('test', $this->article->getDescriCatalogAD());
    }

    public function testGetMediasAD()
    {
        $this->article->setMediasAD('test');
        $this->assertEquals('test', $this->article->getMediasAD());
    }

    public function testGetPlusAD()
    {
        $this->article->setPlusAD('test');
        $this->assertEquals('test', $this->article->getPlusAD());
    }

    public function testGetMotsClesAD()
    {
        $this->article->setMotsClesAD('test');
        $this->assertEquals('test', $this->article->getMotsClesAD());
    }

    public function testGetOrdreAD()
    {
        $this->article->setOrdreAD(0);
        $this->assertEquals(0, $this->article->getOrdreAD());
    }

    public function testGetNumDecliAD()
    {
        $this->article->setNumDecliAD(0);
        $this->assertEquals(0, $this->article->getNumDecliAD());
    }

    public function testGetFlgAncAD()
    {
        $this->article->setFlgAncAD(true);
        $this->assertEquals(true, $this->article->getFlgAncAD());
    }

    public function testGetFlgCatalogAD()
    {
        $this->article->setFlgCatalogAD(true);
        $this->assertEquals(true, $this->article->getFlgCatalogAD());
    }

    public function testGetFlgPrincAD()
    {
        $this->article->setFlgPrincAD(true);
        $this->assertEquals(true, $this->article->getFlgPrincAD());
    }

    public function testGetFlgDestockAD()
    {
        $this->article->setFlgDestockAD(true);
        $this->assertEquals(true, $this->article->getFlgDestockAD());
    }

    public function testGetFlgHorsMarqueAD()
    {
        $this->article->setFlgHorsMarqueAD(true);
        $this->assertEquals(true, $this->article->getFlgHorsMarqueAD());
    }

    public function testGetFlgNouvAD()
    {
        $this->article->setFlgNouvAD(true);
        $this->assertEquals(true, $this->article->getFlgNouvAD());
    }

    public function testGetFlgPromoAD()
    {
        $this->article->setFlgPromoAD(true);
        $this->assertEquals(true, $this->article->getFlgPromoAD());
    }

    public function testGetFlgVisibleAD()
    {
        $this->article->setFlgVisibleAD(true);
        $this->assertEquals(true, $this->article->getFlgVisibleAD());
    }

    public function testGetFlgEclBleuAD()
    {
        $this->article->setFlgEclBleuAD(true);
        $this->assertEquals(true, $this->article->getFlgEclBleuAD());
    }

    public function testGetFlgEclRoseAD()
    {
        $this->article->setFlgEclRoseAD(true);
        $this->assertEquals(true, $this->article->getFlgEclRoseAD());
    }

    public function testGetFlgEclVertAD()
    {
        $this->article->setFlgEclVertAD(true);
        $this->assertEquals(true, $this->article->getFlgEclVertAD());
    }

    public function testGetFlgEclOrangeAD()
    {
        $this->article->setFlgEclOrangeAD(true);
        $this->assertEquals(true, $this->article->getFlgEclOrangeAD());
    }

    public function testGetIdFourAD()
    {
        $this->article->setIdFourAD(0);
        $this->assertEquals(0, $this->article->getIdFourAD());
    }

    public function testGetDateCreAD()
    {
        $now = new \DateTime('now');
        $this->article->setDateCreAD($now);
        $this->assertEquals($now, $this->article->getDateCreAD());
    }

    public function testGetDateModAD()
    {
        $now = new \DateTime('now');
        $this->article->setDateModAD($now);
        $this->assertEquals($now, $this->article->getDateModAD());
    }

    public function testGetUCreAD()
    {
        $this->article->setUCreAD('test');
        $this->assertEquals('test', $this->article->getUCreAD());
    }

    public function testGetUModAD()
    {
        $this->article->setUModAD('test');
        $this->assertEquals('test', $this->article->getUModAD());
    }

    public function testGetIdADWS()
    {
        $this->article->setIdADWS(0);
        $this->assertEquals(0, $this->article->getIdADWS());
    }

    public function testGetNoAD()
    {
        $this->article->setNoAD(0);
        $this->assertEquals(0, $this->article->getNoAD());
    }

    public function testGetCodADFWS()
    {
        $this->article->setCodADFWS('test');
        $this->assertEquals('test', $this->article->getCodADFWS());
    }

    public function testGetDesiADWS()
    {
        $this->article->setDesiADWS('test');
        $this->assertEquals('test', $this->article->getDesiADWS());
    }

    public function testGetCodAD()
    {
        $this->article->setCodAD('test');
        $this->assertEquals('test', $this->article->getCodAD());
    }

    public function testGetUVteADWS()
    {
        $this->article->setUVteADWS('test');
        $this->assertEquals('test', $this->article->getUVteADWS());
    }

    public function testGetUStoADWS()
    {
        $this->article->setUStoADWS('test');
        $this->assertEquals('test', $this->article->getUStoADWS());
    }

    public function testGetPrixPubAD()
    {
        $this->article->setPrixPubAD(0.0);
        $this->assertEquals(0.0, $this->article->getPrixPubAD());
    }

    public function testGetPrixNetCliADWS()
    {
        $this->article->setPrixNetCliADWS(0.0);
        $this->assertEquals(0.0, $this->article->getPrixNetCliADWS());
    }

    public function testGetStocks()
    {
        $this->article->setStocks(array('test'=>'test'));
        $this->assertEquals(array('test'=>'test'), $this->article->getStocks());
    }
}
