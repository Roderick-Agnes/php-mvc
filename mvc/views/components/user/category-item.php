<?php
$i = 0;
$marginBottom = "mb-4";
$marginTop = "";
foreach ($data['CategoryList'][$categoryType] as $key => $item) {
    if ($i == 0) {
        $marginTop = "mt-4";
    } else {
        $marginTop = "";
    }
    if ($i == count($data['CategoryList'][$categoryType]) - 1) {
        $marginBottom = "";
    }
    $tabType = $item['id']>(0)?($item['id']-1):$item['id'];
    echo "<div class='category-wrap ftco-animate img " . $marginTop . " " . $marginBottom . " d-flex align-items-end' style='background-image: url(" . $base_url . $assets_url . "images/category/" . $item['categoryImage'] . ");'>";
    echo "<div class='text px-3 py-1'>";
    echo "<h2 class='mb-0'><a href='".$base_url."product/shop/t=".$tabType."/page=1"."' >" . $item['categoryName'] . "</a></h2>";
    echo "</div>";
    echo "</div>";
    $i++;
}
