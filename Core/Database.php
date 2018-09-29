<?php


class Database
{
    /**
     * @var $dbHost
     * use getConfig() for take information dynamically
     */
    private static $dbHost;

    /**
     * @var $dbName
     * use getConfig() for take information dynamically
     */
    private static $dbName;

    /**
     * @var $dbUser
     * use getConfig() for take information dynamically
     */
    private static $dbUser;

    /**
     * @var $dbUserPassword
     * use getConfig() for take information dynamically
     */
    private static $dbUserPassword;

    /**
     * @var $connection null at the base
     * Modified by connect() and disconnect()
     * Connection information
     */
    private static $connection = null;

    /**
     * getConfig take data from config.json file
     * change database information in config.json
     */
    private static function getConfig()
    {
        $content = file_get_contents("config.json");
        $content = json_decode($content);
        self::$dbHost = $content->host;
        self::$dbName = $content->name;
        self::$dbUser = $content->user;
        self::$dbUserPassword = $content->password;
    }

    /**
     * @return null|PDO
     * Contain the connection status by change $connection
     */
    public static function connect()
    {
        echo __CLASS__ . " [OK]" . PHP_EOL;
        self::getConfig();
        try {
            self::$connection = new PDO(
                "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,
                self::$dbUser,
                self::$dbUserPassword,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return self::$connection;
    }

    /**
     * Disconnect from the bdd, set $connection to null
     */
    public static function disconnect()
    {
        self::$connection = null;
    }
}
