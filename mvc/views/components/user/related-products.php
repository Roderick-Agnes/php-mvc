<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Products</span>
                <h2 class="mb-4">Related Products</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="owl-carousel">
                <?php
                $_SESSION['RelatedFoods'] = $data['RelatedFoods'];
                foreach ($_SESSION['RelatedFoods'] as $key => $item) {
                    require "./mvc/views/components/user/related-item.php";
                }
                ?>

            </div>
        </div>
    </div>
</section>