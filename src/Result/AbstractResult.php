<?php

namespace Midnight\Google\Places\Result;

/**
 * Class AbstractResult
 * @package Midnight\Google\Places\Result
 */
abstract class AbstractResult implements ResultInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param array $data
     * @return void
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    protected function getData()
    {
        return $this->data;
    }
} 
