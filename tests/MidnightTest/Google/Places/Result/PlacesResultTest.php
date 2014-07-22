<?php

namespace MidnightTest\Google\Places\Result;

use Midnight\Google\Places\Result\PlacesResult;

class PlacesResultTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPlaces()
    {
        $result = new PlacesResult();
        $result->setData(['results' => []]);
        $this->assertInternalType('array', $result->getPlaces());
    }
}
