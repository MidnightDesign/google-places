<?php

namespace Midnight\Google\Places\Result;
/**
 * Class PlacesResult
 * @package Midnight\Google\Places\Result
 */
class PlacesResult extends AbstractResult
{
    /**
     * @return array
     */
    public function getPlaces()
    {
        return $this->getData()['results'];
    }
}
