<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo $base_url ?>admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin <sup>:/</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo $base_url ?>admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Foods -->
    <li class="nav-item">
        <a id="foods" class="nav-link" href="<?php echo $base_url . 'admin/food' ?>">
            <i class="fas fa-fw fa-bacon"></i>
            <span>Foods</span></a>
    </li>
    <!-- Nav Item - Categories -->
    <li class="nav-item">
        <a id="categorys" class="nav-link collapsed" href="<?php echo $base_url . 'admin/category' ?>" data-target="#">
            <i class="fas fa-fw fa-list-ol"></i>
            <span>Category</span></a>
    </li>
    <!-- Nav Item - Order -->
    <li class="nav-item">
        <a id="orders" class="nav-link collapsed" href="<?php echo $base_url . 'admin/order' ?>" data-target="#">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Orders</span></a>
    </li>
    <!-- Nav Item - Account: customer & admin -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Accounts</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Account manager:</h6>
                <a class="collapse-item" href="<?php echo $base_url . 'admin/customer' ?>"><i class="fas fa-fw fa-user"></i>
                    <span>Customer</span>
                </a>
                <a class="collapse-item" href="<?php echo $base_url . 'admin/AdminAccount' ?>"><i class="fas fa-fw fa-user-cog"></i>
                    <span>Admin</span>
                </a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->