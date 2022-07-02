<?php
require_once "./mvc/config/dbhelper.php";
class Category
{
    private $id;
    private $categoryName;
    private $categoryImage;
    private $createDate;
    private $updateDate;

    private $conn;


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
    public static function getCategoriesById($id)
    {
        $query = "SELECT * FROM category WHERE id = " . $id;
        return executeResult($query, true);
    }
    public function deleteCategoryById($id)
    {
        $query = "DELETE FROM `category` WHERE id = " . $id;
        return execute($query);
    }
    public static function createNewCategory($object)
    {
        if (isset($object)) {
            $query = "INSERT INTO `category`(`categoryName`, `categoryImage`) 
            VALUES ('" . $object['categoryName'] . "','" . $object['image'] . "')";
            execute($query);
            return true;
        }
        return false;
    }
    public function updateCategory($object)
    {
        if (isset($object)) {
            $query = "UPDATE `category` SET `categoryName`='" . $object['categoryName']  . "',`categoryImage`='" . $object['categoryImage'] . "',`updateDate`='" . date("Y-m-d H:i:s") . "' WHERE id = " . $object['categoryId'];
            execute($query);
            return true;
        }
        return false;
    }
}
