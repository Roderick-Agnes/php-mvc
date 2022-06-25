<!DOCTYPE html>
<html lang="en">
<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['SERVER_NAME'] . "/" . "php-mvc/";
$assets_url = "public/assets/";

$css_url = "public/assets/css/";
$main_css_url = $base_url . $css_url;

$js_url = "public/assets/js/";
$main_js_url = $base_url . $js_url;

$_SESSION['Cart'] = null;
?>

<head>
    <title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet" type="text/css" media="all">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo $main_css_url ?>open-iconic-bootstrap.min.css" type=" text/css" media="all">

    <link rel="stylesheet" href="<?php echo $main_css_url ?>animate.css" type=" text/css" media="all">
    <link rel="stylesheet" href="<?php echo $main_css_url ?>owl.carousel.min.css" type=" text/css" media="all">
    <link rel="stylesheet" href="<?php echo $main_css_url ?>owl.theme.default.min.css" type=" text/css" media="all">
    <link rel="stylesheet" href="<?php echo $main_css_url ?>magnific-popup.css" type=" text/css" media="all">
    <link rel="stylesheet" href="<?php echo $main_css_url ?>aos.css" type=" text/css" media="all">
    <link rel="stylesheet" href="<?php echo $main_css_url ?>ionicons.min.css" type=" text/css" media="all">
    <link rel="stylesheet" href="<?php echo $main_css_url ?>bootstrap-datepicker.css" type=" text/css" media="all">
    <link rel="stylesheet" href="<?php echo $main_css_url ?>jquery.timepicker.css" type=" text/css" media="all">
    <link rel="stylesheet" href="<?php echo $main_css_url ?>flaticon.css" type=" text/css" media="all">
    <link rel="stylesheet" href="<?php echo $main_css_url ?>icomoon.css" type=" text/css" media="all">
    <link rel="stylesheet" href="<?php echo $main_css_url ?>style.css" type=" text/css" media="all">
    <!-- ====== Fontawesome CDN Link ====== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo $main_css_url ?>tata.css" type=" text/css" media="all">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>

</head>