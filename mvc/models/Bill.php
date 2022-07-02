<?php
require_once "./mvc/config/dbconnect.php";
require_once "./mvc/config/dbhelper.php";
class Bill
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

    public $conn;

    public function __construct()
    {
    }
    public function getOrderList()
    {
        $query = "SELECT * FROM bill";
        return executeResult($query);
    }
    public function getOrderById($id)
    {
        $query = "SELECT * FROM bill WHERE `id` = '" . $id . "'";
        return executeResult($query, true);
    }
    public function saveOrder($order)
    {
        $priceTotal = $order['moneyTotal'];
        $foodList = '';
        $array_food = array();

        foreach ($order['data'] as $key => $item) {
            $new_info = array(
                'key' => $key,
                'foodName' => $item['product']['foodName'],
                'price' => $item['product']['price'],
                'quantity' => $item['quantity'],
                'totalPrice'  => (int)($item['product']['price'] * $item['quantity'])
            );

            array_push($array_food, $new_info);
            $foodList .= '<p>' . (int)($key + 1) . ' - ' . $item['product']['foodName'] . ', price: ' .
                number_format((int)($item['product']['price']), 0, '', ',') . ' vnd, quantity: ' . (int)($item['quantity']) . ', priceTotal: ' . (int)($item['product']['price'] * $item['quantity']) . '</p>';
        }
        $paymentStatus = 0;
        $paymentMethod = $order['paymentMethod'];
        $customerName = $order['buyer']['firstname'] . ' ' . $order['buyer']['lastname'];
        $customerPhone = $order['buyer']['phone'];
        $customerAddress = $order['buyer']['address'];
        $customerEmail = $order['buyer']['email'];
        $customerCountry = $order['buyer']['country'];
        $customerCity = $order['buyer']['city'];
        $orderId = $order['orderId'];

        // complete foodList properties

        $query = "INSERT INTO bill (`id`,`foodList`, `totalPrice`, `paymentStatus`, `paymentMethod`, `customerName`, `customerPhone`, `customerAddress`, `customerEmail`, `customerCountry`, `customerCity`, `payDate`) VALUES" . "('" . $orderId . "', '" . json_encode($array_food, JSON_UNESCAPED_UNICODE) . "', '" . $priceTotal . "', '" . $paymentStatus . "', '" . $paymentMethod . "', '" . $customerName . "', '" . $customerPhone . "', '" . $customerAddress . "', '" . $customerEmail . "', '" . $customerCountry . "', '" . $customerCity . "', '')";
        execute($query);
        return array(
            "desc" => $foodList,
            "message" => 'Order saved successfully'
        );
    }
    public function updateStatusOrder($query)
    {
        execute($query);
    }
}
