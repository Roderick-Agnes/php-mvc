<?php
$object = json_encode($item);
echo "<div class='col-md-6 col-lg-3 ftco-animate'>";
echo "<div class='product'>";
echo "<a href='" . $base_url . "product/detail/" . $item['id'] . "' class='img-prod'><img class='img-fluid' accept='image/*' src='" . $base_url . $assets_url . "images/food/" . $item['foodImage'] . "' alt='Colorlib Template'>";
// echo "<span class='status'>30%</span>";
// echo "<div class='overlay'></div>";
echo "</a>";
echo "<div class='text py-3 pb-4 px-3 text-center'>";
echo "<h3><a href='" . $base_url . "product/detail/" . $item['id'] . "'>" . $item['foodName'] . "</a></h3>";
echo "<div class='d-flex'>";
echo "<div class='pricing'>";
echo "<p class='price'><span class='price-sale'>" . $item['price'] . "<sup>vnd</sup></span></p>";
echo "</div>";
echo "</div>";
echo "<div class='bottom-area d-flex px-3'>";
echo "<div class='m-auto d-flex'>";
// echo "<a href='' class='add-to-cart d-flex justify-content-center align-items-center text-center'>";
// echo "<span><i class='ion-ios-menu'></i></span>";
// echo "</a>";
echo "<a href='javascript:void(0)' onclick='addToCart(" . $object . ")' class='buy-now d-flex justify-content-center align-items-center mx-1'>";
echo "<span><i class='ion-ios-cart'></i></span>";
echo "</a>";
echo "<a href='' class='heart d-flex justify-content-center align-items-center '>";
echo "<span><i class='ion-ios-heart'></i></span>";
echo "</a>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";

// <span class='mr-2 price-dc'>" . $item['price'] . "<sup>vnd</sup></span>