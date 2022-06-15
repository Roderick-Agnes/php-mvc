<?php
$i = 0;
$marginBottom = "mb-4";
$marginTop = "";
foreach ($data['CategoryList'][$categoryType] as $item) {
    if ($i == 0) {
        $marginTop = "mt-4";
    } else {
        $marginTop = "";
    }
    if ($i == count($data['CategoryList'][$categoryType]) - 1) {
        $marginBottom = "";
    }
    echo "<div class='category-wrap ftco-animate img " . $marginTop . " " . $marginBottom . " d-flex align-items-end' style='background-image: url(" . $base_url . $assets_url . "images/category/" . $item['categoryImage'] . ");'>";
    echo "<div class='text px-3 py-1'>";
    echo "<h2 class='mb-0'><a href='#'>" . $item['categoryName'] . "</a></h2>";
    echo "</div>";
    echo "</div>";
    $i++;
}
