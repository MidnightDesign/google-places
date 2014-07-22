<?php

namespace Midnight\Google\Places\Request;

use Midnight\Google\Places\Result\ResultInterface;

/**
 * Interface RequestInterface
 * @package Midnight\Google\Places\Request
 */
interface RequestInterface
{
    /**
     * Returns an array of query parameters
     *
     * @return array
     */
    public function getParams();

    /**
     * Returns the request's URI suffix
     *
     * For a Text Search request, this would be "textsearch", as in /maps/api/place/textsearch/json
     *
     * @return string
     */
    public function getPathSuffix();
}
