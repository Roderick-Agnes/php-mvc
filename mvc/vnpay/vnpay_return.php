<!DOCTYPE html>
<html lang="en">
<?php
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['SERVER_NAME'] . "/" . "php-mvc/";
$assets_url = "public/assets/";

$css_url = "public/assets/";
$main_css_url = $base_url . $css_url;

$js_url = "public/assets/";
$main_js_url = $base_url . $js_url;
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo $main_css_url ?>bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?php echo $main_css_url ?>jumbotron-narrow.css" rel="stylesheet">
    <style>
        body {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }

        h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }

        p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size: 20px;
            margin: 0;
        }

        i {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }

        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
    </style>
    <script src="<?php echo $main_js_url ?>jquery-1.11.3.min.js"></script>
</head>

<body>
    <?php

    require_once("./config.php");

    $branch = isset($_GET['payAtHome']) ? 0 : 1;
    if ($branch == 0) {
    ?>
        <div class="card">
            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                <i class="checkmark">✓</i>
            </div>
            <h1>Success</h1>
            <p>Your order create successfully.</p><br /> Please check your email or phone within the next 2 days!<br />
            Back to index after
            <span id='countDown2'></span>...
        </div>
    <?php
    } else {
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

    ?>
        <div class="card">
            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                <i class="checkmark">✓</i>
            </div>
            <h1>Success</h1>
            <p>Your order create successfully.</p>;<br /> Please check your email or phone within the next 2 days!</p>
            <!-- <p><progress class="progress bg-primary" value="0" max="10" id="countDown"></progress></p> -->
            <h4>Back to index after <span id='countDown2'></span>...</h4>
        </div>

    <?php }
    $returnUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url = explode('?', $returnUrl);
    ?>
    <!--Begin display -->









    <script type="text/javascript">
        const countDown = (time) => {
            var timeleft = time;
            var downloadTimer = setInterval(function() {
                if (timeleft <= 0) {
                    clearInterval(downloadTimer);
                }
                // document.getElementById("countDown").value = 10 - timeleft;
                document.getElementById("countDown2").innerHTML = timeleft + 's';
                timeleft -= 1;
                if (timeleft == 0) {
                    setTimeout(function() {
                        console.log('complete countdown');
                        localStorage.clear();
                        window.location.href = '<?php echo $base_url ?>';
                    }, 2000); // 5 seconds
                }
            }, 1000);

        }
        const currentUrl = '<?php echo $base_url . "mvc/vnpay/vnpay_return.php"; ?>'; //http://localhost/php-mvc/mvc/vnpay/vnpay_return.php
        const branch = <?php echo $branch ?>;
        console.log("branch = " + branch);
        if (branch == 0) {
            countDown(10);
        } else {
            if (currentUrl == '<?php echo $url[0] ?>' && branch != 0) {
                vnpay_response = {
                    'orderId': '<?php echo isset($_GET['vnp_TxnRef']) ? $_GET['vnp_TxnRef'] : '' ?>',
                    'totalPrice': '<?php echo isset($_GET['vnp_Amount']) ? $_GET['vnp_Amount'] : '' ?>',
                    'orderInfo': '<?php echo isset($_GET['vnp_OrderInfo']) ? $_GET['vnp_OrderInfo'] : '' ?>',
                    'vnp_ResponseCode': '<?php echo isset($_GET['vnp_ResponseCode']) ? $_GET['vnp_ResponseCode'] : '' ?>',
                    'vnp_TransactionNo': '<?php echo isset($_GET['vnp_TransactionNo']) ? $_GET['vnp_TransactionNo'] : '' ?>',
                    'vnp_BankCode': '<?php echo isset($_GET['vnp_BankCode']) ? $_GET['vnp_BankCode'] : '' ?>',
                    'vnp_CardType': '<?php echo isset($_GET['vnp_CardType']) ?  $_GET['vnp_CardType'] : '' ?>',
                    'vnp_PayDate': '<?php echo isset($_GET['vnp_PayDate']) ? $_GET['vnp_PayDate'] : '' ?>'
                };
                $.ajax({
                    type: "POST",
                    url: "<?php echo $base_url ?>cart/UpdateOrder",
                    data: {
                        vnpay_response: vnpay_response
                    },
                    cache: false,
                    success: function(data) {
                        const rs = JSON.parse(data);
                        console.log(rs.message);
                        countDown(10);
                    }
                });
            }
        }
    </script>

</body>

</html>