<div class="py-1 bg-primary">
  <div class="container">
    <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
      <div class="col-lg-12 d-block">
        <div class="row d-flex">
          <div class="col-md pr-4 d-flex topper align-items-center">
            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
            <span class="text">+ 0965 123 465</span>
          </div>
          <div class="col-md pr-4 d-flex topper align-items-center">
            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
            <span class="text">greenfood@email.com</span>
          </div>
          <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
            <span class="text">Liên hệ với chúng tôi</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a class="navbar-brand" href="<?php echo $base_url; ?>">GreenFood</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>

    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active"><a href="<?php echo $base_url; ?>" class="nav-link">Trang chủ</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
            <a class="dropdown-item" href="<?php echo $base_url . 'product/shop/t=' . rand(0, count($_SESSION['CategoryList'])) . '/page=1' ?>">Cửa hàng</a>
            <a class="dropdown-item" href="<?php echo $base_url . 'cart' ?>">Giỏ hàng</a>
          </div>

        </li>
        <li class="nav-item"><a href="#gioiThieu" class="nav-link">Giới thiệu</a></li>
        <li class="nav-item"><a href="#phanHoi" class="nav-link">Phản hồi</a></li>
        <li class="nav-item cta cta-colored"><a href="<?php echo $base_url . 'cart' ?>" id="totalItem" class="nav-link"></a></li>
        <?php
        if (isset($_SESSION['greenfood_user'])) {
          $user = $_SESSION['greenfood_user'];
        } else {
          $user = null;
        }
        if ($user == '' || $user == null) {
          echo "<li class='nav-item'><a href='javascript:void(0)' onclick='handleLogin()' class='nav-link'><i class='fa fa-sign-in'></i>Login</a></li>";
        } else {
          $user = json_decode($user, true);
          echo "
          <li class='nav-item dropdown'>
          <a class='nav-link dropdown-toggle' href='#' id='dropdown05' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Hi. " . $user['firstname'] . "</a>
          <div class='dropdown-menu' aria-labelledby='dropdown05'>
            <a class='dropdown-item' onclick='handleLogout()' href='#'><i class='fa fa-sign-out' aria-hidden='true'></i> Log out</a>
          </div>
        </li>
          ";
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
<!-- END nav -->