<?php
include 'php_files/config.php';
session_start();
if (isset($_SESSION['admin'])) {
    include 'sidebar_nav.php';
    // echo 
    $qr = "SELECT * FROM `food` INNER JOIN `category` ON `food`.`category_id`=`category`.`cat_id`";
    $res = mysqli_query($conn, $qr);
    // exit;
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div id="form">
            <?php while ($row2 = mysqli_fetch_assoc($res)) { ?>
            <div class="col-12 pt-4">
                <div class="card text-capitalize">
                    <div class="card-header bg-primary pt-2 pb-1 text-white">
                        <h6 style="padding: 0%;">Product id - <?= $row2['food_id'] ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="btn-container">
                                    <img src="../photos/<?= $row2['food_img'] ?>" class="w-100" id="product">
                                </div>
                            </div>
                            <div class="col-lg-10  col-md-9 col-sm-8">
                                <div class="row">
                                    <div class="col-md-3 col-sm-5 mt-1">
                                        <b>Product Title :</b>
                                    </div>
                                    <div class="col-md-9 col-sm-7">
                                        <?= $row2['food_name'] ?> </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-5 mt-1">
                                        <b>Product Category :</b>
                                    </div>
                                    <div class="col-md-9 col-sm-7">
                                        <?= $row2['category_name'] ?> </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-5 mt-1">
                                        <b>Product Description :</b>
                                    </div>
                                    <div class="col-md-9 col-sm-7">
                                        <?= $row2['food_descript'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-5 mt-1">
                                        <b>Product Price:</b>
                                    </div>
                                    <div class="col-md-9 col-sm-7">
                                        <div class="row">
                                            <div class="col-4">1 piece</div>
                                            <div class="col-8"><?= $row2['food_rs'] ?></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12 col-12 text-right">
                                <a href="update_product.php?edit=<?= $row2['food_id'] ?>"
                                    class="btn btn-success btn-sm mr-3">Edit</a>
                                <?php
                                        $ch_qr = "SELECT * FROM `food` WHERE `display_status`=1 AND `food_id`=$row2[food_id]";
                                        $ch_res = mysqli_query($conn, $ch_qr);
                                        $data = mysqli_num_rows($ch_res);
                                        if ($data == 1) {
                                        ?>
                                <a href="delete.php?disable=<?= $row2['food_id'] ?>" class="btn btn-sm btn-danger"
                                    role="button">Disable</a>
                                <?php  } else {
                                        ?>

                                <a href="delete.php?enable=<?= $row2['food_id'] ?>" class="btn btn-sm btn-primary"
                                    role="button">Enable</a>
                                <?php

                                        } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
                ?>
        </div>
    </div>
</main>
<?php include 'footer.php'; ?>
</div>
</div>
<script src="js/delete.js"></script>
<?php
} else {
    echo "<script>location.href='login.php'</script>";
}
?>

</body>

</html>