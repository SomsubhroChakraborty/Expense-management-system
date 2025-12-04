<?php

require_once 'config.php';

class DBController extends Config
{
    private $conn;
    public $error = '';

    public function __construct()
    {
        $this->connectDB();
    }

    private function connectDB()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection Failed: " . $this->conn->connect_error);
            $this->conn->close();
        }
    }

    public function executeQuery($sql)
    {
        $result = $this->conn->query($sql);

        if ($result === false) {
            die("Query Error: " . $this->conn->error);
        }

        return $result;
    }
}
