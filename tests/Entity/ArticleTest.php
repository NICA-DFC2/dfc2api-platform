<?php

namespace App\Tests;

use App\Entity\Article;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ArticleTest extends TestCase
{

    private $classToTest;

    public function setup(){
        $this->classToTest = Article::class;
    }

    public function testAllSettersAreDefined()
    {
        $methods = get_class_methods($this->classToTest);

        $class = new ReflectionClass($this->classToTest);

        $setters = [];
        foreach ($methods as $method) {

            $pos = strpos($method, 'set');

            if ($pos === 0) {
                $setters[] = $method;
            }
        }
        foreach ($class->getProperties() as $property) {
            $property = $property->name;
            $expectedSetter = 'set' . $property;
            $this->assertTrue(in_array($expectedSetter, $setters), 'La propriété ' . $property . ' de la classe ' . $class->getName(). ' ne possède pas de Setter');
        }
    }

    public function testAllGettersAreDefined()
    {
        $methods = get_class_methods($this->classToTest);

        $class = new ReflectionClass($this->classToTest);

        $getters = [];
        foreach ($methods as $method) {

            $pos = strpos($method, 'get');

            if ($pos === 0) {
                $getters[] = $method;
            }
        }
        foreach ($class->getProperties() as $property) {
            $property = $property->name;
            $expectedGetter = 'get' . $property;
            $this->assertTrue(in_array($expectedGetter, $getters), 'La propriété ' . $property . ' de la classe ' . $class->getName(). ' ne possède pas de Getter');
        }
    }
}
