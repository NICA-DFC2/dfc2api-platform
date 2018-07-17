<?php

namespace App\Tests\Services\Filter;

use App\Services\Filter\WsFilter;
use App\Services\Objets\CritParam;
use PHPUnit\Framework\TestCase;

class WsFilterTest extends TestCase
{
    protected $filter = array('DateDE' => array('after' => '2018-05-04'), 'IdDocDE' => array('order' => 'ASC'));
    protected $wsFilter;

    public function setUp()
    {
        $this->wsFilter = new WsFilter($this->filter);
    }

    public function testGetCritSel() {
        $critSels = $this->wsFilter->getCritSel();
        $nb = count($critSels);
        $this->assertCount(3, $critSels, "La collection ne contient pas le nombre d'éléments attendu (3 éléments). Il y a $nb élément(s) dans la collection");

        if($nb > 0) {
            $param = $critSels[0];
            $this->assertInstanceOf(CritParam::class, $param, "L'objet à l'index 0 n'est pas une instance de type CritParam:class");
        }
    }

    public function testSetCritSel() {
        $this->wsFilter->setCritSel($this->filter);

        $critSels = $this->wsFilter->getCritSel();
        $nb = count($critSels);
        $this->assertCount(3, $critSels, "La collection ne contient pas le nombre d'éléments attendu (3 éléments). Il y a $nb élément(s) dans la collection");

        if($nb > 0) {
            $param = $critSels[0];
            $this->assertInstanceOf(CritParam::class, $param, "L'objet à l'index 0 n'est pas une instance de type CritParam:class");
        }
    }
}