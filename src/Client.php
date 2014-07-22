<?php

namespace Midnight\Google\Places;

use Midnight\Google\Places\Request\RequestInterface;
use Midnight\Google\Places\Request\ResultClassAwareInterface;
use Midnight\Google\Places\Result\GenericResult;
use Midnight\Google\Places\Result\ResultInterface;
use Zend\Http\Client as HttpClient;
use Zend\Http\Client\Adapter\Curl;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Stdlib\Parameters;
use Zend\Stdlib\ParametersInterface;
use Zend\Uri\Http;

/**
 * Class Client
 * @package Midnight\Google\Places
 */
class Client implements ClientInterface
{
    /**
     * @var HttpClient
     */
    private $httpClient;
    /**
     * @var string
     */
    private $endpoint = 'https://maps.googleapis.com/maps/api/place/';
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param RequestInterface $request
     * @return ResultInterface
     */
    public function call(RequestInterface $request)
    {
        $httpResponse = $this->getHttpClient()->send($this->buildHttpRequest($request));
        if ($request instanceof ResultClassAwareInterface) {
            $className = $request->getResultClass();
            $result    = new $className();
        } else {
            $result = new GenericResult();
        }
        $result->setData(json_decode($httpResponse->getBody(), true));
        return $result;
    }

    /**
     * @return HttpClient
     */
    private function getHttpClient()
    {
        if (!$this->httpClient) {
            // @codeCoverageIgnoreStart
            $client = new HttpClient(null, [
                'adapter' => Curl::class,
                'curloptions' => [
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_SSL_VERIFYPEER => false
                ],
            ]);
            $this->setHttpClient($client);
            // @codeCoverageIgnoreEnd
        }
        return $this->httpClient;
    }

    /**
     * @param RequestInterface $request
     * @return Request
     */
    private function buildHttpRequest(RequestInterface $request)
    {
        $httpRequest = new Request();
        $httpRequest->setUri($this->buildUri($request));
        $httpRequest->setQuery($this->buildQuery($request));
        return $httpRequest;
    }

    /**
     * @param RequestInterface $request
     * @return Http
     */
    private function buildUri(RequestInterface $request)
    {
        $uri = new Http($this->endpoint);
        $uri->setPath($uri->getPath() . $request->getPathSuffix() . '/json');
        return $uri;
    }

    /**
     * @param RequestInterface $request
     * @return ParametersInterface
     */
    private function buildQuery(RequestInterface $request)
    {
        $uri = new Parameters($request->getParams());
        $uri->set('key', $this->apiKey);
        return $uri;
    }

    /**
     * @param HttpClient $client
     */
    public function setHttpClient(HttpClient $client)
    {
        $this->httpClient = $client;
    }
}
