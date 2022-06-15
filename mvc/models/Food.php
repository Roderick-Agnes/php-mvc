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
        return executeResult($query);
    }
    public function getFoodById($id)
    {
        $query = "SELECT * FROM food WHERE id = " . $id;
        return executeResult($query, true);
    }
    // edit more...
    public function getFoodByCategoryId($categoryId)
    {
        $query = "SELECT * FROM food WHERE categoryId = " . $categoryId;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
