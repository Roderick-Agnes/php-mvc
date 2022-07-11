<?php
$email = $firstname = $lastname = $address = $phone = '';
if (isset($user['email']) || isset($user['firstname']) || isset($user['lastname']) || isset($user['address']) || isset($user['phone'])) {
    $email = $user['email'];
    $address = $user['address'];
    $firstname = $user['firstname'];
    $lastname = $user['lastname'];
    $phone = $user['phone'];
}
?>
<form id="buyerInfo" method="POST" class="billing-form">
    <h3 class="mb-4 billing-heading">Billing Details</h3>
    <div class="row align-items-end">
        <div class="col-md-6">
            <div class="form-group">
                <label for="firstname">Firt Name</label>
                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="" value="<?php echo $firstname ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="" value="<?php echo $lastname ?>">
            </div>
        </div>
        <div class="w-100"></div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="country">State / Country</label>
                <div class="select-wrap">
                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                    <select name="country" id="country" class="form-control">
                        <option value="vn" selected>Viet Nam</option>
                        <option value="en">England</option>
                        <!-- <php $api_url = file_get_contents('https://api.first.org/data/v1/countries');
                        $data = json_decode($api_url, true);
                        foreach ($data['data'] as $key => $value) {
                            echo "<option value='" . $value['country'] . "'>" . $value['country'] . "</option>";
                        }
                        ?> -->
                    </select>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="towncity">Town / City</label>
                <input type="text" name="city" id="city" class="form-control" placeholder="" value=' ' required>
            </div>
        </div>
        <div class="w-100"></div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="streetaddress">Street Address</label>
                <input type="text" name="address" id="address" value="<?php echo $address ?>" class="form-control" placeholder="House number and street name">
            </div>
        </div>

        <div class="w-100"></div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="<?php echo $phone ?>" class="form-control" placeholder="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="emailaddress">Email Address</label>
                <input type="text" name="email" id="email" value="<?php echo $email ?>" class="form-control" placeholder="">
            </div>
        </div>
        <div class="w-100"></div>
        <div class="col-md-12">
            <div class="form-group mt-4">
                <div class="radio">
                    <!-- <label class="mr-3"><input type="radio" name="optradio"> Create an Account? </label>
                    <label><input type="radio" name="optradio"> Ship to different address</label> -->
                </div>
            </div>
        </div>
    </div>
</form><!-- END -->