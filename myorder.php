<?php
session_start();
if ($_SESSION['usnm']) {
    include 'config.php';
    include 'header.php';
    $qr = "SELECT * FROM `take_order` WHERE `user_id`=$_SESSION[user_id] AND `status`='delivered'";
    $res = mysqli_query($conn, $qr);
    $data = mysqli_num_rows($res);
    if ($data > 0) {
?>
<main class="container-fluid">

    <div class="row">
        <div class="col-12 mt-5 overflow-auto">
            <h4 class="mb-3">Cart</h4>
            <style>
            table * {
                white-space: nowrap;
            }
            </style>
            <?php
                    while ($row = mysqli_fetch_assoc($res)) {
                        $i = 1;
                        $arr2 = json_decode($row['ord_id'], true);
                    ?>
            <div class="border rounded p-3 my-4 ">
                <h5 class="text-center">Order No.<?= $row['take_ord_id'] ?>
                </h5>
                <div class="row  pl-2 pr-2 ">
                    <div class="col-12 mb-1">
                        <!-- Check At Here.. -->
                        <div class="row pt-2 pb-2 border rounded mb-3 d-md-flex d-none">
                            <div class="col-md-1 col-2 text-center">
                                No.
                            </div>
                            <div class="col-md-5 col-10 text-md-left text-center mb-md-auto mb-1">
                                Product
                            </div>
                            <div class="d-md-none col-2"></div>
                            <div class="col-md-6 col-10 text-center">
                                <div class="row">
                                    <div class="col-4">Price</div>
                                    <div class="col-4">Quantity</div>
                                    <div class="col-4">Total</div>
                                </div>
                            </div>
                        </div>
                        <?php
                                    foreach ($arr2 as $key => $value) {
                                        # code...
                                        $sl_qr = "SELECT * FROM `order_detaile` `od` INNER JOIN `food` `fd` WHERE `od`.`user_id`=$_SESSION[user_id] AND `od`.`ord_id`=$value AND `od`.`food_id`=`fd`.`food_id`";
                                        $sl_res = mysqli_query($conn, $sl_qr);
                                        $sl_row = mysqli_fetch_assoc($sl_res);
                                    ?>


                        <div class="row pt-3 pb-3 border rounded mb-3">
                            <div class="col-md-1 col-12 mb-md-auto text-md-center">
                                <span class="d-md-none">Sr.</span> <span
                                    class="float-md-none float-right"><?= $i++; ?></span>
                            </div>
                            <div class="col-md-5 col-12 text-md-left text-md-left">
                                <span class="d-md-none">Product</span> <span
                                    class="float-md-none float-right"><?= $sl_row['food_name'] ?></span>
                            </div>
                            <!-- <div class="d-md-none col-2"></div> -->
                            <div class="col-md-6 col-12 text-md-center">
                                <div class="row">
                                    <div class="col-md-4 col-12"><span class="d-md-none">Price</span> <span
                                            class="float-md-none float-right"><?= $sl_row['food_rs'] ?></span></div>
                                    <div class="col-md-4 col-12"><span class="d-md-none">Quantity</span> <span
                                            class="float-md-none float-right"><?= $sl_row['food_qty'] ?></span></div>
                                    <div class="col-md-4 col-12"><span class="d-md-none">Total</span> <span
                                            class="float-md-none float-right"><?= $sl_row['amount'] ?></span></div>

                                </div>
                            </div>
                        </div>
                        <?php
                                    }
                                    ?>
                        <div class="row pt-3 text-capitalize border rounded mb-3">
                            <div class="col-md-12 col-12 text-center">
                                <div class="row">
                                    <div class="col-md-3 col-6">
                                        <h5>Status </h5>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <h5><?= "Delivered" ?></h5>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <h5>Total </h5>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <h5><?= $row['amount'] ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="invoice.php?id=<?= $row['take_ord_id'] ?>" class="btn btn-primary float-right">Print out
                    </a>
                </div>
            </div>

            <?php
                    }
                    ?>
        </div>
    </div>
    <?php
    } else {
        ?>
    <h2 class="h-75 text-center">You Have Not Order Yet Anything</h2>
    <?php
    }
        ?>



</main>
<?php
    include 'footer.php';
} else {
    echo "<script>location.href='index.php'</script>";
}
    ?>