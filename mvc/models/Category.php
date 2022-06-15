<?php
require_once "./mvc/config/dbconnect.php";
require_once "./mvc/config/dbhelper.php";
class Category
{
    private $id;
    private $categoryName;
    private $categoryImage;
    private $createDate;
    private $updateDate;

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getCategoryList($isSingleRecord = false)
    {
        $query = "SELECT * FROM category";
        $data = executeResult($query);
        if ($isSingleRecord) {
            $categoryList = array(
                "categoryLeft" => [],
                "categoryRight" => []
            );
            $dataLength = count($data);

            // add category left into array
            for ($i = 0; $i < $dataLength / 2; $i++) {
                $item = $data[$i];
                array_push($categoryList['categoryLeft'], $item);
            }
            // add category right into array
            for ($i = $dataLength / 2; $i < $dataLength; $i++) {
                $item = $data[$i];
                array_push($categoryList['categoryRight'], $item);
            }
            return $categoryList;
        }
        return $data;
    }
    public function getCategoriesById($id)
    {
        $query = "SELECT * FROM category WHERE id = " . $id;
        return executeResult($query, true);
    }
}
