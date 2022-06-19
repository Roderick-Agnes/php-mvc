<?php
require_once "./mvc/utils/Utility.php";
$_SESSION['FoodListByCategoryName'] = $data['FoodListByCategory'];

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set number of records per page
$records_per_page = 8;

$array_url = explode("/", filter_var(trim($_GET["url"], "/")));
$page_url = "";
foreach ($array_url as $key => $value) {
    if ($key !== max(array_keys($array_url))) {
        $page_url .= $array_url[$key] . "/";
    } else {
        $page_url .= $array_url[$key];
    }
}
echo "page = ";
echo  explode("page=", $page_url[max(array_keys($array_url))]);
echo "pagwe: " . $base_url . $page_url;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// retrieve records here
$_SESSION['from_record_num'] = $from_record_num;
$_SESSION['records_per_page'] = $records_per_page;
?>
<div class="hero-wrap hero-bread" style="background-image: url('<?php echo $base_url . $assets_url ?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo $base_url ?>">Home</a></span> <span>Products</span></p>
                <h1 class="mb-0 bread">Products</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category nav nav-pills justify-content-center" role="tablist">
                    <?php

                    foreach ($_SESSION['FoodListByCategoryName']['categoryName'] as $key => $categoryName) {
                        if ($key == 0) {
                            $acticeState = "show active";
                        } else {
                            $acticeState = " ";
                        }
                        echo "<li role='presentation'><a id='" . $key . "' class='" . $acticeState . "' href='#tab-" . $key . "' aria-controls='#tab-" . $key . "' role='tab' data-toggle='tab'>" . $categoryName . "</a></li>";
                    }
                    ?>
                </ul>
            </div>

        </div>

        <!-- Tab panes -->
        <div class="tab-content">
            <?php $acticeState;
            $total_rows = array();
            foreach ($_SESSION['FoodListByCategoryName']['foodData'] as $key => $foodData) {
                if ($key == 0) {
                    $acticeState = "active";
                } else {
                    $acticeState = " ";
                }
                echo "<div role='tabpanel' class='tab-pane " . $acticeState . " ' id='tab-" . $key . "'>";
                echo "<div class='row'>";
                $datas = array_slice($foodData, $_SESSION['from_record_num'], $_SESSION['records_per_page']);
                $total_rows[$key] = count($foodData); //edit
                foreach ($datas as $item) {
                    require "./mvc/views/components/food-item.php";
                }
                echo "</div>";

                // the page where this paging is used

                // count all products in the database to calculate total pages
                //echo $total_rows;
                $key_item = $key;
                require "./mvc/views/components/paging.php";

                echo "</div>";
            }

            ?>

        </div>

    </div>
</section>