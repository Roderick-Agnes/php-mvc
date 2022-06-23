<div class="hero-wrap hero-bread" style="background-image: url('<?php echo $base_url . $assets_url ?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo $base_url ?>">Home</a></span> <span>Cart</span></p>
                <h1 class="mb-0 bread">My Cart</h1>
            </div>
        </div>
    </div>
</div>
<section class='ftco-section ftco-cart'>
    <div class='container'>
        <div id="cartContent" class="cart-content">
            <div class='row' id="cartRow">
                <div class='col-md-12 ftco-animate'>
                    <div class='cart-list'>
                        <table class='table'>
                            <thead class='thead-primary'>
                                <tr class='text-center'>
                                    <th>&nbsp;</th>
                                    <th>Product image</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id='productTable'>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class='row justify-content-end' id='cartBill'>
                <div class='col-lg-6 mt-5 cart-wrap ftco-animate'>
                    <div class='cart-total mb-3'>
                        <h3>Coupon Code</h3>
                        <p>Enter your coupon code if you have one</p>
                        <form action='#' class='info'>
                            <div class='form-group'>
                                <label for=''>Coupon code</label>
                                <input type='text' class='form-control text-left px-3' placeholder=''>
                            </div>
                        </form>
                    </div>
                    <p><a href='checkout.html' class='btn btn-primary py-3 px-4'>Apply Coupon</a></p>
                </div>
                <div class='col-lg-6 mt-5 cart-wrap ftco-animate' id='cart-total'>

                </div>
            </div>
        </div>

    </div>
</section>