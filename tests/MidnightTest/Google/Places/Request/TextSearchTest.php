<?php

namespace MidnightTest\Google\Places\Request;

use InvalidArgumentException;
use Midnight\Google\Places\Request\TextSearch;
use RuntimeException;

class TextSearchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TextSearch
     */
    private $request;

    public function setUp()
    {
        $this->request = new TextSearch();
    }

    public function testSetQueryViaConstructor()
    {
        $query   = 'Foo';
        $request = new TextSearch($query);
        $this->assertEquals($request->getParams()['query'], $query);
    }

    /**
     * @expectedException RuntimeException
     */
    public function testGetParamsThrowsExceptionIfNoQueryIsSet()
    {
        $this->request->getParams();
    }

    public function testPathSuffixIsCorrect()
    {
        $this->assertEquals('textsearch', $this->request->getPathSuffix());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetQueryThrowsExceptionIfArgumentIsNotAString()
    {
        $this->request->setQuery(23);
    }
}
