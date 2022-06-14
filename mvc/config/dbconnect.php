<?php
class Database
{
    private $servername = "localhost";
    // private $username = "id19032662_greenstoresui";
    // private $password = "Oj#Um[@bLu4OiRrz";
    // private $dbname = "id19032662_greenfooddb";
    private $username = "root";
    private $password = "";
    private $dbname = "greenfood";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname . "", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            // set the PDO error mode to exception
            //$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully\n";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }
}
