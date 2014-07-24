<?php

namespace Midnight\Google\Places\Result;
use Midnight\Google\Places\Entity\Place;

/**
 * Class PlacesResult
 * @package Midnight\Google\Places\Result
 */
class PlacesResult extends AbstractResult
{
    /**
     * @return Place[]
     */
    public function getPlaces()
    {
        $places = [];
        foreach($this->getData()['results'] as $result) {
            $place = new Place();
            $place->setName($result['name']);
            $place->setId($result['id']);
            $places[] = $place;
        }
        return $places;
    }
}
