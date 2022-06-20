<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $page_number = $_POST["page_number"];
    echo "so trang: ". $page_number;
}
echo "<div class='row mt-5'>
<div class='col text-center'>
    <div class='block-27'>
        <ul>";

// button for first page
if ($page > 1) {
    echo "<li><a href='".$base_url."product/shop/t=".$tabType."/page=1"."' title='Go to the first page.'>";
    echo "First";
    echo "</a></li>";
}

// calculate total pages
$total_pages = ceil($total_rows[$key_item] / $records_per_page);
// range of links to show
$range = 2;

// display links to 'range of pages' around 'current page'
$initial_num = $page - $range;
$condition_limit_num = ($page + $range)  + 1;

for ($x = $initial_num; $x < $condition_limit_num; $x++) {

    // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
    if (($x > 0) && ($x <= $total_pages)) {

        // current page
        if ($x == $page) {
            echo "<li class='active cursor-pointer'><a href='javascript:void(0)'> $x<span class=\"sr-only\">(current)</span></a></li>";
        }

        // not current page
        else {
            echo "<li class='cursor-pointer'><a href='".$base_url."product/shop/t=".$tabType."/page=".$x."' onclick='handleGetPageNum(".$x.")'>$x</a></li>";
        }
    }
}

// button for last page
if ($page < $total_pages) {
    echo "<li><a href='".$base_url."product/shop/t=".$tabType."/page=".$total_pages."' title='Last page is {$total_pages}.'>";
    echo "Last";
    echo "</a></li>";
}

echo "</ul>
</div>
</div>
</div>";
