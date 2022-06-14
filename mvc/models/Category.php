<?php
include_once('./core/DB.php');
class Category
{
    private $id;
    private $categoryName;
    private $createDate;
    private $updateDate;

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getCategoryList()
    {
        $stmt = $this->conn->prepare("SELECT * FROM category");
        $stmt->execute();
        return $stmt;
    }
    public function getCategoriesById($id)
    {
        $query = "SELECT * FROM category WHERE id = " . $id;
        $stmt = $this->conn->prepare($query);
        //$stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }
}
