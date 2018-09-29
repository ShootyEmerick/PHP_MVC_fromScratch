<?php

/**
 * Class UserModel
 */
class UserModel extends Entity
{
//    /**
//     * @var $email
//     */
//    private $email;
//    /**
//     * @var $password
//     */
//    private $password;

    /**
     * @var
     */
    public $id;
    /**
     * @var array
     */
    private static $relation = [];

    /**
     * UserModel constructor.
     * @param $params
     */
    public function __construct($params)
    {
        echo __CLASS__ . " [OK]" . "<br>";
        parent::__construct($params);
    }


    /**
     * Ajoute un enregistrement en BDD avec les attributs du Model
     */
    public function save()
    {
        var_dump("emailSEND", $this->email);
        var_dump("passSEND", $this->password);
        $orm = new ORM;
        $id = $orm->create("users", array(
            'email' => $this->email,
            'password' => $this->password
        ));
        var_dump("IDID", $id);
        $this->id = $id;
        $_SESSION['id'] = $this->id;
        var_dump("THIS IDID", $this->id);
        var_dump($_SESSION);
        echo "ID (METHOD SAVE du USERMODEL : " . $id;
    }


    /**
     * @param $fields
     * @return int $result
     */
    public function create($fields)
    {
        var_dump("FIELDSUSERMODEL", $fields);
        $orm = new ORM;
        $result = $orm->create("users", $fields);
        return $result;
    }


    /**
     * @param $id
     * @return array $result
     */
    public function read($id)
    {
        $orm = new ORM;
        $result = $orm->read("users", $id);
        return $result;
    }


    /**
     * @param $id
     * @param $fields
     * @return bool $result
     */
    public function update($id, $fields)
    {
        $orm = new ORM;
        $result = $orm->update("users", $id, $fields);
        return $result;
    }


    /**
     * @param $id
     * @return bool|PDOStatement $result
     */
    public function delete($id)
    {
        $orm = new ORM;
        $result = $orm->delete("users", $id);
        return $result;
    }


    /**
     * @return array $result
     */
    public function read_all()
    {
        $orm = new ORM;
        $result = $orm->find("users");
        return $result;
    }

    /**
     * Disconnect from the Database
     */
    public function __destruct()
    {
        Database::disconnect();
    }
}
