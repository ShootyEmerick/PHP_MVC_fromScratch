<?php

class TestModel extends Entity
{
    /**
     * @var $test
     */
    protected $test;
    /**
     * @var array
     */
    private static $relation = [];

    /**
     * @return mixed
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * TestModel constructor.
     * @param $params
     */
    public function __construct($params)
    {
        echo __CLASS__ . " [OK]" . PHP_EOL;
        parent::__construct($params);
    }
}
