<?php
// include '../../config.php';
// echo
$qr = "SELECT * FROM `take_order` INNER JOIN `users` WHERE `users`.`user_id`=`take_order`.`user_id` AND `status`='pending'";
// exit;
$res = mysqli_query($conn, $qr);
$no_rows = mysqli_num_rows($res);
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="../index.php">Start Bootstrap</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell" aria-hidden="true"></i><sup class="badge badge-pill badge-dark"><?= $no_rows ?></sup></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown2">
                <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                    <a class="dropdown-item" href="php_files/view_order.php?id=<?= $row['take_ord_id'] ?>">#<?= $row['take_ord_id'] ?>
                        Received Order from <?= $row['fname'] ?></a>
                <?php
                } ?>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../admin_login/logout.php">Logout</a>
            </div>
        </li>
    </ul>
</nav>