<?php
require_once('./mvc/utils/utility.php');

class Home extends Controller
{
    function Index()
    {
        //require models
        require_once "./mvc/models/Food.php";
        require_once "./mvc/models/Category.php";
        //Call Models
        $food = new Food();

        $foodList = $food->getFoodList();

        $category = new Category();
        $categoryList = $category->getCategoryList(true);

        //$foodList = $this->model("Food");

        // Call Views
        $this->view("layoutRoot", [
            "CategoryList" => $categoryList,
            "Page" => "index",
            "FoodList" => $foodList
        ]);
    }
}
