<?php

namespace MidnightTest\Google\Places\Result;

use Midnight\Google\Places\Result\PlacesResult;
use PHPUnit_Framework_TestCase;

class PlacesResultTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PlacesResult
     */
    private $result;

    public function setUp()
    {
        $this->result = new PlacesResult();
    }

    public function testGetPlaces()
    {
        $this->result->setData(['results' => []]);
        $this->assertInternalType('array', $this->result->getPlaces());
    }

    public function testPlacesArePopulatedAndOrderIsKept()
    {
        $data = ['results' => [
            ['name' => 'Foo', 'id' => 'abc'],
            ['name' => 'Bar', 'id' => 'def'],
        ]];
        $this->result->setData($data);
        $places = $this->result->getPlaces();
        $this->assertEquals('Foo', $places[0]->getName());
        $this->assertEquals('abc', $places[0]->getId());
        $this->assertEquals('Bar', $places[1]->getName());
        $this->assertEquals('def', $places[1]->getId());
    }
}
