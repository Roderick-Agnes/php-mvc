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
    public function getFoodListByCategoryId($categoryId, $isArrayMultiple = false)
    {
        if ($isArrayMultiple) {
            $query_get_all_category = "SELECT * FROM category";
            $array_id_category = executeResult($query_get_all_category);
            $multiCategories = array();
            $multiCategories['categoryName'] = array();
            $multiCategories['foodData'] = array();
            foreach ($array_id_category as $category) {
                array_push($multiCategories['categoryName'], $category['categoryName']);
                $query = "SELECT * FROM food WHERE categoryId = " . $category['id'];
                array_push($multiCategories['foodData'], executeResult($query));
            }
            return $multiCategories;
        }
        $query = "SELECT * FROM food WHERE categoryId = " . $categoryId . " ORDER BY categoryId DESC LIMIT 7";
        return executeResult($query); // return single category
    }
}
