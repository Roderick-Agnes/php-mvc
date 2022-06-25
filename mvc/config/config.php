<?php
define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'greenfood');

define('MD5_PRIVATE_KEY', '2342kuhskdfsd23(&kusdhfjsgJYGJGsfdf384');

date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['SERVER_NAME'] . "/" . "php-mvc/";
define('VNP_HASHSECRET', 'GKALXHZKMGCMOMLEKNCZJXMIYXCEXXDC');
define('VNP_TMNCODE', 'NQSZKL54');
define('VNP_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html');
define('VNP_RETURNURL', "http://localhost/php-mvc/mvc/vnpay_php/vnpay_return.php");
define('VNP_APIURL', 'http://sandbox.vnpayment.vn/merchant_webapi/merchant.html');
//Config input format
//Expire
$startTime = date("YmdHis");
define('EXPIRE', date('YmdHis', strtotime('+15 minutes', strtotime($startTime))));
