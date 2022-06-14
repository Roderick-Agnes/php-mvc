<?php
require_once "./mvc/config/dbconnect.php";
require_once "./mvc/config/dbhelper.php";
class Food
{
    private $id;
    private $foodName;
    private $categoryId;
    private $price;
    private $foodDescription;
    private $foodImage;
    private $createDate;
    private $updateDate;
    public  $conn;

    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }
    public function getFoodList()
    {
        $query = "SELECT * FROM food";
        $data = executeResult($query);
        return $data;
    }
    public function getFoodById($id)
    {
        $query = "SELECT * FROM food WHERE id = " . $id;
        $stmt = $this->conn->prepare($query);
        //$stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }
    public function getFoodByCategoryId($categoryId)
    {
        $query = "SELECT * FROM food WHERE categoryId = " . $categoryId;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
