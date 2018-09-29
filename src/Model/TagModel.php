<?php

/**
 * Class TagModel
 */
class TagModel extends Entity
{

    /**
     * @var int $id
     */
    public $id;
    /**
     * @var array
     */
    private static $relation = [];

    /**
     * TagModel constructor.
     * @param $params
     */
    public function __construct($params)
    {
        parent::__construct($params);
        echo __CLASS__ . " [OK]" . PHP_EOL;
    }
}
