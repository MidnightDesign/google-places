<?php

namespace Midnight\Google\Places\Request;

/**
 * Interface ResultClassAwareInterface
 * @package Midnight\Google\Places\Request
 */
interface ResultClassAwareInterface
{
    /**
     * Returns the class name of the result
     *
     * @return string
     */
    public function getResultClass();
} 
