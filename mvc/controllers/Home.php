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
        require_once "./mvc/models/food.php";
        //Call Models
        $db = new Database();
        $food = new Food($db);
        $foodList = $food->getFoodList();

        //$foodList = $this->model("Food");

        // Call Views
        $this->view("layoutRoot", [
            "Page" => "index",
            "FoodList" => $foodList
        ]);
    }
}
