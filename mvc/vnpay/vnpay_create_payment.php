<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

/**
 * Description of vnpay_ajax
 *
 * @author xonv
 */
require_once("./config.php");
$order = $_POST['order'];

$vnp_TxnRef = $order['orderId']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
$vnp_OrderInfo = "Order with id: " . $order['orderId']; //$_POST['desc']; // description order
$vnp_OrderType = 'billpayment'; //$_POST['order_type'];
$vnp_Amount = $order['moneyTotal'] * 100; //$_POST['amount'] * 100;
$vnp_Locale = 'vn'; //$_POST['language'];
$vnp_BankCode = ''; //$_POST['bank_code'];
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Add Params of 2.0.1 Version
$vnp_ExpireDate = $expire; //$_POST['txtexpire'];

//Billing
$vnp_Bill_Mobile = $order['buyer']['phone']; //$_POST['txt_billing_mobile'];
$vnp_Bill_Email = $order['buyer']['email']; //$_POST['txt_billing_email'];
$fullName = trim($order['buyer']['firstname'] . ' ' . $order['buyer']['lastname']); //trim($_POST['txt_billing_fullname']);

if (isset($fullName) && trim($fullName) != '') {
    $name = explode(' ', $fullName);
    $vnp_Bill_FirstName = array_shift($name);
    $vnp_Bill_LastName = array_pop($name);
}
$vnp_Bill_Address = $order['buyer']['address']; //$_POST['txt_inv_addr1'];
$vnp_Bill_City = $order['buyer']['city']; //$_POST['txt_bill_city'];
$vnp_Bill_Country = $order['buyer']['country']; //$_POST['txt_bill_country']; //VN
$vnp_Bill_State = ''; //$_POST['txt_bill_state'];
// Invoice
// $vnp_Inv_Phone = $order['buyer']['phone']; //$_POST['txt_inv_mobile']; //EDIT CONTINUE
// $vnp_Inv_Email = $order['buyer']['email']; //$_POST['txt_inv_email'];
// $vnp_Inv_Customer = $fullName; //$_POST['txt_inv_customer'];
// $vnp_Inv_Address = $order['buyer']['address']; //$_POST['txt_inv_addr1'];
// $vnp_Inv_Company = 'Công ty Cổ phần giải pháp Thanh toán Việt Nam'; //$_POST['txt_inv_company'];
// $vnp_Inv_Taxcode = '0102182292'; //$_POST['txt_inv_taxcode'];
// $vnp_Inv_Type = 'I'; //O//$_POST['cbo_inv_type'];
$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_ExpireDate" => $vnp_ExpireDate,
    "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
    "vnp_Bill_Email" => $vnp_Bill_Email,
    "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
    "vnp_Bill_LastName" => $vnp_Bill_LastName,
    "vnp_Bill_Address" => $vnp_Bill_Address,
    "vnp_Bill_City" => $vnp_Bill_City,
    "vnp_Bill_Country" => $vnp_Bill_Country
    // "vnp_Inv_Phone" => $vnp_Inv_Phone,
    // "vnp_Inv_Email" => $vnp_Inv_Email,
    // "vnp_Inv_Customer" => $vnp_Inv_Customer,
    // "vnp_Inv_Address" => $vnp_Inv_Address,
    // "vnp_Inv_Company" => $vnp_Inv_Company,
    // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
    // "vnp_Inv_Type" => $vnp_Inv_Type
);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}
if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
}

ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}
$returnData = array(
    'code' => '00', 'message' => 'success', 'data' => $vnp_Url
);
if (isset($_POST['redirect'])) {
    header('Location: ' . $vnp_Url);
    die();
} else {
    echo json_encode($returnData);
}
