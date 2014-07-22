<?php

namespace MidnightTest\Google\Places;

use Midnight\Google\Places\Client;
use Midnight\Google\Places\Request\RequestInterface;
use Midnight\Google\Places\Request\TextSearch;
use Midnight\Google\Places\Result\GenericResult;
use Midnight\Google\Places\Result\PlacesResult;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use Zend\Http\Client as HttpClient;
use Zend\Http\Response;

class ClientTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $apiKey;
    /**
     * @var HttpClient|PHPUnit_Framework_MockObject_MockObject
     */
    private $httpClient;
    /**
     * @var RequestInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private $request;
    /**
     * @var Response|PHPUnit_Framework_MockObject_MockObject
     */
    private $response;

    public function setUp()
    {
        $this->apiKey     = 'MyApiKey';
        $this->client     = new Client($this->apiKey);
        $this->httpClient = $this->getMock(HttpClient::class);
        $this->request    = $this->getMock(RequestInterface::class);
        $this->response   = $this->getMock(Response::class);
        $this->client->setHttpClient($this->httpClient);
        $this->response
            ->expects($this->any())
            ->method('getBody')
            ->will($this->returnValue('{"test": "Foo"}'));
        $this->httpClient
            ->expects($this->any())
            ->method('send')
            ->will($this->returnValue($this->response));
    }

    public function testCall()
    {
        $result = $this->client->call($this->request);
        $this->assertInstanceOf(GenericResult::class, $result);
        $this->assertEquals('Foo', $result->get('test'));
    }

    public function testCallRespectsResultClassAwareInterface()
    {
        $this->request = $this->getMock(TextSearch::class);
        $this->request
            ->expects($this->any())
            ->method('getResultClass')
            ->will($this->returnValue(PlacesResult::class));
        $result = $this->client->call($this->request);
        $this->assertInstanceOf(PlacesResult::class, $result);
    }
}
