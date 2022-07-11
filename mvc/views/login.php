<!doctype html>
<html lang="en">
<?php
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['SERVER_NAME'] . "/" . "php-mvc/";
$assets_url = "public/assets/";
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
?>

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo $base_url . $assets_url ?>login_assets/css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">
                        <div class="img" style="background-image: url(<?php echo $base_url . $assets_url ?>images/bg_1.jpg);"></div>
                        <div class="login-wrap p-4 p-md-5" id='wrap-singin'>
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class=" mb-4" data-toggle="tab" href='#signin'>Sign In</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>
                            <form method="post" class="signin-form">
                                <div class="form-group mt-3">
                                    <input id="username-field" type="text" name="username" class="form-control" required>
                                    <label class="form-control-placeholder" for="username">Username</label>
                                </div>
                                <div class="form-group">
                                    <input id="password-field" name="password" type="password" class="form-control" required>
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button type="button" onclick="handleLogin()" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                                    <div id="message"></div>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-md-left">
                                        <a href="#">Forgot Password</a>
                                    </div>
                                    <div class="w-50 text-right">
                                        <p class="">Not a member? <a href="javascript:void(0)" onclick="showTabSignup()" data-toggle="tab" style='color:#20c997'>Sign Up</a></p>
                                    </div>

                                </div>
                            </form>

                        </div>
                        <div class="login-wrap p-4 p-md-5  tab-pane" style='display:none' id='wrap-singup'>
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class=" mb-4">Sign Up</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>

                            <form id="signupForm" method="post" class="signup-form row">
                                <div class="form-group  col-sm-6">
                                    <input id="firstname" type="text" name="firstname" class="form-control" required>
                                    <label class="form-control-placeholder" for="username">Firstname</label>
                                </div>
                                <div class="form-group  col-sm-6">
                                    <input id="lastname" type="text" name="lastname" class="form-control" required>
                                    <label class="form-control-placeholder" for="username">Lastname</label>
                                </div>
                                <div class="form-group  col-sm-12">
                                    <input id="email" type="email" name="email" class="form-control" required>
                                    <label class="form-control-placeholder" for="username">Email</label>
                                </div>

                                <div class="form-group col-sm-12">
                                    <input id="address" type="text" name="address" class="form-control" required>
                                    <label class="form-control-placeholder" for="username">Address</label>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input id="phone" type="text" maxlength="10" name="phone" class="form-control" required>
                                    <label class="form-control-placeholder" for="username">Phone</label>
                                </div>
                                <div class="form-group col-sm-6">
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="0" selected>Male</option>
                                        <option value="1">Female</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-12">
                                    <input id="username" type="text" name="username" class="form-control" required>
                                    <label class="form-control-placeholder" for="username">Username</label>
                                </div>
                                <div class="form-group col-sm-12">
                                    <input id="password" name="password" type="password" class="form-control" required>
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group col-sm-12">
                                    <button type="button" onclick="handleCreateAccount()" class="form-control btn btn-primary rounded submit px-3">Sign Up</button>
                                    <div id="messageSignup"></div>
                                </div>
                                <div class="form-group d-md-flex col-sm-12">
                                    <div class="w-50 text-md-left ">
                                        <a href="#">Forgot Password</a>
                                    </div>
                                    <div class="w-50 text-right">
                                        <p class="">Have a account? <a href="javascript:void(0)" onclick="showTabSignin()" style='color:#20c997'>Sign In</a></p>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo $base_url . $assets_url ?>login_assets/js/popper.js"></script>
    <script src="<?php echo $base_url . $assets_url ?>login_assets/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url . $assets_url ?>login_assets/js/main.js"></script>
    <script type="text/javascript">
        // Set a Cookie
        function setCookie(cName, cValue, expDays) {
            let date = new Date();
            date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
            const expires = "expires=" + date.toUTCString();
            document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
        }


        function getCookie(cName) {
            const name = cName + "=";
            const cDecoded = decodeURIComponent(document.cookie); //to be careful
            const cArr = cDecoded.split('; ');
            let res;
            cArr.forEach(val => {
                if (val.indexOf(name) === 0) res = val.substring(name.length);
            })
            return res;
        }

        const handleLogin = () => {
            const username = document.getElementById('username-field');
            const password = document.getElementById('password-field');
            const message = document.getElementById('message');

            $.ajax({
                type: "POST",
                url: "<?php echo $base_url ?>" + "Auth/handleLogin",
                data: {
                    username: username.value,
                    password: password.value
                },
                cache: false,
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.status_code == 200) {
                        console.log('login ok' + res.data);
                        // Apply setCookie
                        // setCookie('greenfood_user', res.token, 3);
                        sessionStorage.setItem("greenfood_user", res.data);
                        message.innerHTML = `
                            <div id="main-message">` + res.message + `</div>
                        `;
                        window.history.go(-1);


                    } else {
                        console.log('login fail');
                        message.innerHTML = `
                            <div id="main-message" class="text-danger">` + res.message + `</div>
                        `;
                    }
                },

            });
        }
    </script>
    <script type="text/javascript">
        const showTabSignup = () => {
            const wrapSignin = document.getElementById('wrap-singin');
            const wrapSignup = document.getElementById('wrap-singup');
            wrapSignup.style.display = '';
            wrapSignin.style.display = 'none';

        }
        const showTabSignin = () => {
            const wrapSignin = document.getElementById('wrap-singin');
            const wrapSignup = document.getElementById('wrap-singup');
            wrapSignin.style.display = '';
            wrapSignup.style.display = 'none';

        }
    </script>
    <script>
        const validateSignupForm = () => {
            const firstname = document.getElementById('firstname');
            const lastname = document.getElementById('lastname');
            const email = document.getElementById('email');
            const address = document.getElementById('address');
            const phone = document.getElementById('phone');
            const password = document.getElementById('password');
            const username = document.getElementById('username');
            if (firstname.value == '') {
                message = 'firstname not empty';
                return message;
            } else if (lastname.value == '') {
                message = 'lastname not empty';
                return message;
            } else if (email.value == '') {
                message = 'email not empty';
                return message;
            } else if (address.value == '') {
                message = 'address not empty';
                return message;
            } else if (phone.value == '') {
                message = 'phone not empty';
                return message;
            } else if (username.value == '') {
                message = 'username not empty';
                return message;
            } else if (password.value == '') {
                message = 'password not empty';
                return message;
            } else {
                message = '';
                return message;
            }

        }
        const handleCreateAccount = () => {
            const signupForm = document.getElementById('signupForm');
            const message = document.getElementById('messageSignup');
            const validate = validateSignupForm();
            if (validate != '') {
                message.innerHTML = `<div id="main-messageSignup" class="text-danger">` + validate + `</div>`;
            } else {
                console.log('Sign');

                $.ajax({
                    type: 'POST',
                    url: '<?php echo $base_url ?>Auth/createAccount',
                    data: {
                        firstname: $("#firstname").val(),
                        lastname: $("#lastname").val(),
                        email: $("#email").val(),
                        address: $("#address").val(),
                        phone: $("#phone").val(),
                        gender: $("#gender").val(),
                        username: $("#username").val(),
                        password: $("#password").val(),
                    },
                    success: function(response) {
                        const res = JSON.parse(response);
                        if (res.status_code == 409) {
                            console.log("message: " + res.message);
                            message.innerHTML = `<div id="main-messageSignup" class="text-danger">` + res.message + `</div>`;
                        } else if (res.status_code == 200) {
                            window.location.href = "<?php echo $base_url ?>" + "auth/login";
                        }
                    }
                });
            }

        }
    </script>
</body>

</html>