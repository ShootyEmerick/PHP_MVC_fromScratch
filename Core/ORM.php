<?php

/**
 * ORM class
 * Last gateway with Database
 */
class ORM extends Database
{
    /**
     * @var $db
     * Contain value of the Database::connect() actually
     */
    private $db;

    /**
     * ORM constructor
     * Initialize Connection with Database
     */
    public function __construct()
    {
        echo __CLASS__ . " [OK]" . "<br>";
        $this->db = Database::connect();
    }

    /**
     * @param $table string
     * @param $fields
     * Check if the email exist before create new enter in bdd
     * @return int $result id of the lastInsertInBdd
     */
    public function create($table, $fields)
    {
        $params = array(
            "WHERE" => "email",
            "=" => "'" . $fields['email'] . "'"
        );
        $found = $this->find($table, $params);
        if (empty($found)) {
            $query = "INSERT INTO " . $table . " VALUES (null, ";

            foreach ($fields as $key => $value) {
                $query .= ":" . $key . ", ";
            }
            $query = rtrim(trim($query), ",");
            $query .= ")";
            $statement = $this->db->prepare($query);
            foreach ($fields as $key => $value) {
                if (is_int($value)) {
                    $statement->bindValue(':' . $key, $value, PDO::PARAM_INT);
                } else {
                    $statement->bindValue(':' . $key, $value, PDO::PARAM_STR);
                }
            }
            $statement->execute();
            return $this->db->lastInsertId();
        } else {
            echo "<h3>Cette adresse mail existe déjà.</h3>";
        }
    }

    /**
     * @param string $table
     * @param int $id
     * @return array saved data
     */
    public function read($table, $id)
    {
        $statement = $this->db->prepare("SELECT * FROM " . $table . " WHERE id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @param $table
     * @param $id
     * @param $fields
     * @return boolean
     */
    public function update($table, $id, $fields)
    {

        $query = "UPDATE " . $table . " SET";

        foreach ($fields as $key => $value) {
            $query .= " " . $key . " = :" . $key . ", ";
        }
        $query = rtrim(trim($query), ",");
        $query .= " WHERE " . $table . ".id = :id";
        var_dump("QUERYUPDATE", $query, PHP_EOL);
        $statement = $this->db->prepare($query);
        foreach ($fields as $key => $value) {
            if (is_int($value)) {
                $statement->bindValue(':' . $key, $value, PDO::PARAM_INT);
            } elseif (is_string($value)) {
                $statement->bindValue(':' . $key, $value, PDO::PARAM_STR);
            } else {
                $statement->bindValue(':' . $key, $value, PDO::PARAM_STR);
            }
        }
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $result = $statement->execute();
        return $result;
    }

    /**
     * @param $table
     * @param $id
     */
    public function delete($table, $id)
    {
        $statement = $this->db->prepare("DELETE FROM " . $table . " WHERE " . $table . ".id = :id");
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->execute();
        return $statement;
    }

    /**
     * @param string $table
     * @param array $params
     */
    public function find($table, $params = array(
        'WHERE' => '1',
        'ORDER BY' => 'id ASC',
        'LIMIT' => ''
    ))
    {
        $query = "SELECT * FROM " . $table;
        foreach ($params as $key => $value) {
            $query .= " " . $key . " " . $value;
        }
        $statement = $this->db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Disconnect with the bdd
     */
    public function __destruct()
    {
        Database::disconnect();
    }
}
