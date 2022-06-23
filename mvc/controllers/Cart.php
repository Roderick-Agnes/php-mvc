<?php
require_once('./mvc/utils/utility.php');
//require models
require_once "./mvc/models/Food.php";
require_once "./mvc/models/Category.php";
require_once "./mvc/models/Bill.php";


class Cart extends Controller
{
    function Index()
    {
        // Call Views
        $this->view("layoutRoot", [
            "Page" => "cart"
        ]);
    }
    function Checkout()
    {
        // Call Views
        $this->view("layoutRoot", [
            "Page" => "checkout"
        ]);
    }
    function handleSaveOrder()
    {
        $order = $_POST['order'];

        //Call Models
        $db = new Database();
        $bill = new Bill($db);

        $result = $bill->saveOrder($order);


        echo json_encode(array(
            "status" => 'success',
            "status-code" => '200',
            "message" => $result
        ));
    }
}
