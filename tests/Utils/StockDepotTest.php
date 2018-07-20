<?php

namespace App\Tests\Utils\Extensions;

use App\Services\Objets\WsStock;
use App\Utils\StockDepot;
use PHPUnit\Framework\TestCase;

class StockDepotTest extends TestCase
{
    protected $stock_depot;

    public function setUp()
    {
        $this->stock_depot = new StockDepot();
    }

    public function testParseObject() {

        // création de l'objet qui va permettre l'hydratation
        $wsStock = new WsStock();

        // hydratation
        $stock_depot = $this->stock_depot->parseObject($wsStock, 'nom_depot');

        // vérifie si l'instance est du on type
        $this->assertInstanceOf(StockDepot::class, $stock_depot, "L'objet parsé n'est pas une instance de type StockDepot:class");
        // vérifie que l'hydration est exécutée
        $this->assertTrue($stock_depot->isFilled(), 'L\'objet $stock_depot a rencontré une erreur à son hydradation');
    }

    public function testParseJson() {

        // création de l'objet qui va permettre l'hydratation
        $wsStock = new WsStock();

        // hydratation
        $stock_depot = $this->stock_depot->parseObject($wsStock, 'nom_depot');

        // vérifie si l'instance est du on type
        $this->assertJson(json_encode($stock_depot->parseString()), "L'objet parsé n'est pas une structure json valide");
    }
}