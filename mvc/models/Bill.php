<?php
include_once('./core/Database.php');
class Bill extends Database
{
    private $id;
    private $foodList;
    private $totalPrice;
    private $paymentStatus = false;

    private $customerName;
    private $customerPhone;
    private $customerAddress;

    private $createDate;
    private $updateDate;

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getAllOrder()
    {
        $stmt = $this->conn->prepare("SELECT * FROM bill");
        $stmt->execute();

        return $stmt;
    }
    public function getOrderById()
    {
        return 0;
    }
}
