<?php
$default_number = 8;
$_SESSION['FoodList'] = array_slice($data['FoodList'], 0, $default_number);
$_SESSION['CategoryList'] = $data['CategoryList'];
?>
<?php require_once "./mvc/views/components/user/slider.php" ?>
<?php require_once "./mvc/views/components/user/category.php" ?>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Sản phẩm nổi bật</span>
                <h2 class="mb-4">Sản phẩm của chúng tôi</h2>
                <p>Sản phẩm tươi ngon từ các trang trại đảm bảo chất lượng sản phẩm đạt chuẩn quốc tế</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <?php
            foreach ($_SESSION['FoodList'] as $item) {
                require "./mvc/views/components/user/food-item.php";
            }
            ?>

        </div>
        <div class="load-more ftco-animate">
            <div class="text text-center">
                <button class="btn btn-primary" onclick="window.location.href='<?php echo $base_url . 'product/shop/t=' . rand(0, count($_SESSION['CategoryList'])) . '/page=1' ?>'">Xem thêm</button>
            </div>
        </div>
    </div>


    <section class="ftco-section testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <span class="subheading">Phản hồi</span>
                    <h2 class="mb-4">Phản hồi từ khách hàng</h2>
                    <p>Sản phẩm tốt chất lượng cao Sản phẩm tốt chất lượng cao Sản phẩm tốt chất lượng cao
                        Sản phẩm tốt chất lượng cao Sản phẩm tốt chất lượng cao</p>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="owl-carousel">
                        <div class="slider-card">
                            <div class="testimony-wrap p-4 pb-5">
                                <div class="user-img mb-5" style="background-image: url(public/assets/images/nhon.jpg)">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <em class="icon-quote-left"></em>
                                    </span>
                                </div>
                                <div class="text text-center">
                                    <p class="mb-5 pl-4 line">Sản phẩm tốt chất lượng cao Sản phẩm tốt chất lượng cao
                                        Sản phẩm tốt chất lượng cao </p>
                                    <p class="name">Thanh Nhon</p>
                                    <span class="position">Developer-Frontend</span>
                                </div>
                            </div>
                        </div>
                        <div class="slider-card">
                            <div class="testimony-wrap p-4 pb-5">
                                <div class="user-img mb-5" style="background-image: url(public/assets/images/nhon.jpg)">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <em class="icon-quote-left"></em>
                                    </span>
                                </div>
                                <div class="text text-center">
                                    <p class="mb-5 pl-4 line">Sản phẩm tốt chất lượng cao Sản phẩm tốt chất lượng cao
                                        Sản phẩm tốt chất lượng cao </p>
                                    <p class="name">Thanh Nhon</p>
                                    <span class="position">Developer-Frontend</span>
                                </div>
                            </div>
                        </div>
                        <div class="slider-card">
                            <div class="testimony-wrap p-4 pb-5">
                                <div class="user-img mb-5" style="background-image: url(public/assets/images/nhon.jpg)">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <em class="icon-quote-left"></em>
                                    </span>
                                </div>
                                <div class="text text-center">
                                    <p class="mb-5 pl-4 line">Sản phẩm tốt chất lượng cao Sản phẩm tốt chất lượng cao
                                        Sản phẩm tốt chất lượng cao </p>
                                    <p class="name">Thanh Nhon</p>
                                    <span class="position">Developer-Frontend</span>
                                </div>
                            </div>
                        </div>
                        <div class="slider-card">
                            <div class="testimony-wrap p-4 pb-5">
                                <div class="user-img mb-5" style="background-image: url(public/assets/images/nhon.jpg)">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <em class="icon-quote-left"></em>
                                    </span>
                                </div>
                                <div class="text text-center">
                                    <p class="mb-5 pl-4 line">Sản phẩm tốt chất lượng cao Sản phẩm tốt chất lượng cao
                                        Sản phẩm tốt chất lượng cao </p>
                                    <p class="name">Thanh Nhon</p>
                                    <span class="position">Developer-Frontend</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr>