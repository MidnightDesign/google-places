<?php

namespace Midnight\Google\Places\Request;

use InvalidArgumentException;
use Midnight\Google\Places\Result\PlacesResult;
use RuntimeException;

/**
 * Class TextSearch
 * @package Midnight\Google\Places\Request
 */
class TextSearch implements RequestInterface, ResultClassAwareInterface
{
    const QUERY = 'query';
    /**
     * @var array
     */
    private $params;

    /**
     * @param string|null $query
     */
    public function __construct($query = null)
    {
        if (null !== $query) {
            $this->setQuery($query);
        }
    }

    /**
     * Returns an array of query parameters
     *
     * @throws RuntimeException
     * @return array
     */
    public function getParams()
    {
        if (!isset($this->params[self::QUERY])) {
            throw new RuntimeException('"query" parameter missing.');
        }
        return $this->params;
    }

    /**
     * Returns the request's URI suffix
     *
     * For a Text Search request, this would be "textsearch", as in /maps/api/place/textsearch/json
     *
     * @return string
     */
    public function getPathSuffix()
    {
        return 'textsearch';
    }

    /**
     * @param string $query
     * @throws InvalidArgumentException
     */
    public function setQuery($query)
    {
        if (!is_string($query)) {
            throw new InvalidArgumentException('The argument must be a string.');
        }
        $this->params[self::QUERY] = $query;
    }

    /**
     * Returns the class name of the result
     *
     * @return string
     */
    public function getResultClass()
    {
        return PlacesResult::class;
    }

    /**
     * Sets the latitude/longitude around which to retrieve place information
     *
     * The second argument $radius defines the distance (in meters) within which to bias place results.
     *
     * @param string $location
     * @param int    $radius
     */
    public function setLocation($location, $radius)
    {
        $this->params['location'] = $location;
        $this->params['radius'] = $radius;
    }
}
