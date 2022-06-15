<?php

// http://localhost/live/Home/Show/1/2

class Home extends Controller
{

    // Must have SayHi()
    function SayHi()
    {
        // $teo = $this->model("SinhVienModel");
        // echo $teo->GetSV();
        echo "DAY LA sayhi ACTION";
        $this->view(
            "layoutRoot",
            [
                "Header" => "header",
                "Navbar" => "navbar",
                "Footer" => "footer"
            ]
        );
    }

    function Index()
    {
        //require models
        require_once "./mvc/models/Food.php";
        require_once "./mvc/models/Category.php";
        //Call Models
        $db = new Database();
        $food = new Food($db);
        $foodList = $food->getFoodList();

        $category = new Category($db);
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
