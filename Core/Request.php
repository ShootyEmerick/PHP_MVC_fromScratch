<?php

class Request
{

    /**
     * Request constructor.
     */
    public function __construct()
    {
        echo __CLASS__ . " [OK]" . PHP_EOL;
    }

    /**
     * @param $data
     * @return string
     */
    public function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * Use checkGet() and checkPost()
     * @return mixed
     */
    public function getQueryParams()
    {
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            if (!empty($_GET)) {
                $this->checkGet();
                return $_GET;
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->checkPost();
            return $_POST;
        }
        return $_GET;
    }

    /**
     * Method used for check data $_GET
     */
    private function checkGet()
    {
        foreach ($_GET as $key => $value) {
            if (is_int($key)) {
                $key = $this->testInput($key);
                intval($key);
            } else {
                $key = $this->testInput($key);
            }
            if (is_int($value)) {
                $value = $this->testInput($value);
                intval($value);
            } else {
                $value = $this->testInput($value);
            }
        }
    }

    /**
     * Method used for check data $_POST
     */
    private function checkPost()
    {
        foreach ($_POST as $key => $value) {
            if (is_int($key)) {
                $key = $this->testInput($key);
                intval($key);
            } else {
                $key = $this->testInput($key);
            }
            if (is_int($value)) {
                $value = $this->testInput($value);
                intval($value);
            } else {
                $value = $this->testInput($value);
            }
        }
    }
}
