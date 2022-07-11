<?php
require_once('./mvc/utils/utility.php');
//require models
require_once "./mvc/models/Food.php";
require_once "./mvc/models/Category.php";
require_once "./mvc/models/Bill.php";
require_once('./mvc/config/config.php');

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
        if (!isset($_SESSION['greenfood_user'])) {
            Header('Location: ' . BASE_URL . "auth/login");
        }
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
            "status_code" => '200',
            "desc" => $result['desc'],
            "message" => $result['message']
        ));
    }
    function UpdateOrder()
    {
        $vnpay_response = $_POST['vnpay_response'];
        $bill = new Bill();

        $order = $bill->getOrderById($vnpay_response['orderId']);
        if ($order["totalPrice"] * 100 == $vnpay_response['totalPrice']) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền kiểm tra là đúng. //$order["Amount"] == $vnp_Amount
        {
            if ($order["paymentStatus"] == 0) {
                $paymentStatus = 0;
                if ($vnpay_response['vnp_ResponseCode'] == '00') {
                    $paymentStatus = 1;
                } else {
                    // Trạng thái thanh toán thất bại / lỗi
                }
                //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                //UPDATE `bill` SET `id`='[value-1]' WHERE `id`='[value-1]'

                $query = "UPDATE `bill` SET `paymentStatus`='" . $paymentStatus . "', `paymentMethod`='" . $vnpay_response['vnp_CardType'] . "(" . $vnpay_response['vnp_BankCode'] . ")', `payDate`='" . $vnpay_response['vnp_PayDate'] . "'  WHERE `id`='" . $vnpay_response['orderId'] . "'";
                $bill->updateStatusOrder($query);
                echo json_encode(array(
                    'status' => 'success',
                    'status_code' => '200',
                    'message' => "Update order successfully"
                ));
            } else {
                echo json_encode(array(
                    'status' => 'error',
                    'status_code' => '200',
                    'message' => "Update order error. Order has handled before."
                ));
            }
        }
    }
}
