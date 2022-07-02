<?php
require_once "./mvc/config/dbhelper.php";
class Food
{
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
    public function deleteFoodById($id)
    {
        $query = "DELETE FROM `food` WHERE id = " . $id;
        return execute($query);
    }
    public static function createNewFood($object)
    {
        if (isset($object)) {
            $query = "INSERT INTO `food`(`foodName`, `categoryId`, `price`, `foodDescription`, `foodImage`) 
            VALUES ('" . $object['foodName'] . "','" . $object['categoryId'] . "','" . $object['price'] . "','" . $object['description'] . "','" . $object['image'] . "')";
            execute($query);
            return true;
        }
        return false;
    }
    public static function updateFood($object)
    {
        if (isset($object)) {
            $query = "UPDATE `food` SET `foodName`='" . $object['foodName'] . "',`categoryId`='" . $object['categoryId'] . "',`price`='" . $object['price'] . "',`foodDescription`='" . $object['description'] . "',`foodImage`='" . $object['image'] . "',`updateDate`='" . date("Y-m-d H:i:s") . "' WHERE id = " . $object['foodId'];
            execute($query);
            return true;
        }
        return false;
    }
}
