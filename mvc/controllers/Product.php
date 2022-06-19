<?php
require_once('./mvc/utils/utility.php');
//require models
require_once "./mvc/models/Food.php";
require_once "./mvc/models/Category.php";


class Product extends Controller
{
    function Detail($id)
    {
        //Call Models
        $db = new Database();
        $food = new Food($db);
        $f = $food->getFoodById($id);

        $relatedFoods = $food->getFoodListByCategoryId($f['categoryId']);

        // Call Views
        $this->view("layoutRoot", [
            "Page" => "detail",
            "Food" => $f,
            "RelatedFoods" => $relatedFoods
        ]);
    }
    function Shop()
    {
        //Call Models
        $db = new Database();
        $food = new Food($db);
        $listFoodsByCategory = $food->getFoodListByCategoryId(-1, true);

        // Call Views
        $this->view("layoutRoot", [
            "Page" => "shop",
            "FoodListByCategory" => $listFoodsByCategory
        ]);
    }
}
