<div class="hero-wrap hero-bread" style="background-image: url('<?php echo $base_url . $assets_url ?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="">Home</a></span> <span class="mr-2"><a href="">Product</a></span> <span>Product Single</span></p>
                <h1 class="mb-0 bread">Product Single</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="" class="image-popup"><img width="100%" height="auto" src="<?php echo $base_url . $assets_url . 'images/food/' . $data['Food']['foodImage'] ?>" class="img-fluid" alt="<?php echo $data['Food']['foodName'] ?>"></a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3><?php echo $data['Food']['foodName'] ?></h3>
                <div class="rating d-flex">
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2">5.0</a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                    </p>
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
                    </p>
                    <p class="text-left">
                        <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
                    </p>
                </div>
                <hr />

                <p class="price"><span><?php echo $data['Food']['price'] ?><sup>vnd</sup></span></p>
                <p><?php echo $data['Food']['foodDescription'] ?></p>
                <div class="row mt-4">

                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <!-- <p style="color: #000;">600 kg available</p> -->
                    </div>
                </div>
                <?php $object = json_encode($data['Food']);
                echo "<p><a href='javascript:void(0)' onclick='addToCart(" . $object . ")' class='btn btn-outline-success py-3 px-5'>Add to Cart</a></p>"
                ?>

            </div>
        </div>
    </div>
</section>

<?php require_once "./mvc/views/components/related-products.php" ?>