<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'dashboard_files/headers_files.html';
    ?>
    <link rel="stylesheet" href="style.css">
</head>

<body class="sb-nav-fixed">
    <?php
    include 'php_files/total_detaile.php';
    include 'php_files/config.php';
    // echo
    $qr = "SELECT * FROM `take_order` INNER JOIN `users` WHERE `users`.`user_id`=`take_order`.`user_id` AND `status`='pending'";
    // exit;
    $res = mysqli_query($conn, $qr);
    $no_rows = mysqli_num_rows($res);
    ?>
    <!----- Navbar ----->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Admin</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <!-- <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search"
                    aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div> -->
        </form>
        <ul class="navbar-nav ml-auto ml-md-0">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php echo ($no_rows == 0) ? "disabled" : "enabled"; ?>"
                    id="userDropdown2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><i class="fa fa-bell" aria-hidden="true"></i><sup
                        class="badge badge-pill badge-dark"><?= $no_rows ?></sup></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown2">
                    <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                    <a class="dropdown-item"
                        href="view_order.php?id=<?= $row['take_ord_id'] ?>">#<?= $row['take_ord_id'] ?>
                        Received Order from <?= $row['fname'] ?></a>
                    <?php
                    } ?>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="change_passsword.php">Change Passsword</a>
                    <a class="dropdown-item" href="#">Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <!-------- Sidebar -------->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="shop_close.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                            Shop Close
                        </a>
                        <div class="sb-sidenav-menu-heading">Manage</div>

                        <a class="nav-link" href="addproduct.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-upload"></i>
                            </div>
                            Add Product
                        </a>
                        <a class="nav-link" href="manage_product.php">
                            <div class="sb-nav-link-icon">
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                            </div>
                            Manage Product
                        </a>
                        <a class="nav-link" href="category.php">
                            <div class="sb-nav-link-icon">
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                            </div>
                            Category

                        </a>
                        <a class="nav-link" href="manage_user.php">
                            <div class="sb-nav-link-icon">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div> Manage Users
                        </a>
                        <a class="nav-link" href="manage_order.php">
                            <div class="sb-nav-link-icon">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </div> Manage Order
                        </a>

                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">