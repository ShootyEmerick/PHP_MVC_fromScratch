<?php

/**
 * Main Model Class
 */
class Entity
{
    /**
     * @var $email
     * Contain $params value of the $email
     */
    protected $email;
    /**
     * @var $password
     * Contain $params value of the $password
     */
    protected $password;

    /**
     * @var $db
     * Contain $params value of the $db
     */
    private $db;

    /**
     * Entity constructor.
     * @param $params
     */
    public function __construct($params)
    {
        echo __CLASS__ . " [OK]" . "<br>";
        $this->db = Database::connect();
        foreach ($params as $key => $param) {
            $this->$key = $param;
        }
    }

    /**
     * Entity Destruct
     * Disconnect from Database
     */
    public function __destruct()
    {
        Database::disconnect();
    }
}
