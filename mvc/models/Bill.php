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
                'id' => $item['product']['id'],
                'foodName' => $item['product']['foodName'],
                'price' => $item['product']['price'],
                'quantity' => $item['quantity'],
                'totalPrice'  => (int)($item['product']['price'] * $item['quantity'])
            );

            array_push($array_food, $new_info);
            $foodList .= '<p>' . (int)($key + 1) . ' - ' . 'id: ' . $item['product']['id'] . ' - ' . $item['product']['foodName'] . ', price: ' .
                number_format((int)($item['product']['price']), 0, '', ',') . ' vnd, quantity: ' . (int)($item['quantity']) . ', priceTotal: ' . (int)($item['product']['price'] * $item['quantity']) . '</p>';
        }
        $paymentStatus = 0;
        $paymentMethod = $order['paymentMethod'] == 'vnpay' ? 'home' : $order['paymentMethod']; // custom
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
    public function deleteOrderById($id)
    {
        $query = "DELETE FROM `bill` WHERE id = " . $id;
        return execute($query);
    }
    public function changeStatusOrderById($id)
    {
        $status = 0;
        $order = self::getOrderById($id);
        if (count($order) > 0) {
            if ($order['paymentStatus'] == 0) {
                $status = 1;
            } else {
                $status = 0;
            }
            $sql = "UPDATE `bill` SET `paymentStatus`='" . $status . "', `updateDate`='" . date('Y-m-d H:i:s') . "' WHERE id = " . $id;
            return [
                'status' => 'Ok',
                'status_code' => '200',
                'data' => execute($sql),
                'message' => 'Ok',
                'statusOrder' => $status
            ];
        } else {
            return [
                'status' => 'Fail',
                'status_code' => '404',
                'data' => '',
                'message' => 'Order not found'
            ];
        }
    }
    public function totalEarningMonthly()
    {
        $sql = "SELECT * FROM `bill`";
        return executeResult($sql);
    }
}
// $date1 = date("Y-m-d", strtotime($_POST['date1']));
        // $date2 = date("Y-m-d", strtotime($_POST['date2']));
        // $sql = "SELECT * FROM `bill` WHERE `date_submit` BETWEEN '$date1' AND '$date2'";
        // $sql = "SELECT * FROM `bill` WHERE EXTRACT(MONTH FROM '" . date('Y/m/d') . "') = EXTRACT(MONTH FROM 'createDate')";