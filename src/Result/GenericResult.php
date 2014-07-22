<?php

namespace Midnight\Google\Places\Result;
/**
 * Class GenericResult
 * @package Midnight\Google\Places\Result
 */
class GenericResult extends AbstractResult
{
    /**
     * @param string $key
     * @return mixed
     */
    public function get($key) {
        return $this->getData()[$key];
    }
}
