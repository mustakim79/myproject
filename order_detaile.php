<?php
include 'config.php';
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // echo
    $qr = "SELECT * FROM `take_order` WHERE `user_id`=$_SESSION[user_id] AND `status`<>'delivered' AND `status`<>'canceled' AND `take_ord_id`=$id";
    // exit;
    $res = mysqli_query($conn, $qr);
    $data = mysqli_num_rows($res);
    if ($data == 0) {
        header('location:index.php');
    } else {
        $row = mysqli_fetch_assoc($res);
        $arr = json_decode($row['ord_id'], true);

        // echo
        $addr_qr = "SELECT * FROM `address` WHERE `addr_id`=$row[address_id] AND `user_id`=$_SESSION[user_id]";
        // exit;
        $addr_res = mysqli_query($conn, $addr_qr);
        $addr_row = mysqli_fetch_assoc($addr_res);

        include 'header.php';
        include 'prevent.html';
?>
<div class="container text-capitalize">
    <div class="row no-gutters" id="ord_dtl_main">

        <div class="border  my-3 mr-auto col-md-5" id="ch1">
            <div class="text-center font-weight-bold border-bottom pt-3" id="title">Your
                Food
            </div>
            <div class="px-2">
                <!------------ Food ------------->
                <?php
                        foreach ($arr as $arr2) {
                            // echo
                            $ord_qr = "SELECT * FROM `order_detaile` INNER JOIN `food` WHERE `order_detaile`.`user_id`=$_SESSION[user_id] AND `order_detaile`.`ord_id`=$arr2 AND `order_detaile`.`food_id`=`food`.`food_id`";
                            // exit;
                            $ord_res = mysqli_query($conn, $ord_qr);
                            $ord_row = mysqli_fetch_assoc($ord_res);
                            // // echo
                            // $food_qr = "SELECT * FROM `food` WHERE `food_id`=$f_id AND `display_status`=1";
                            // // exit;
                            // $food_res = mysqli_query($conn, $food_qr);
                            // $food_row = mysqli_fetch_assoc($food_res);
                        ?>

                <div class="media mt-4 mb-5">
                    <img src="photos/<?= $ord_row['food_img'] ?>" class="mr-3" style="height:auto;width:140px;"
                        alt="...">
                    <div class="media-body">
                        <h5 class="mt-0"><?= $ord_row['food_name'] ?></h5>
                        <div class=""><?= $ord_row['food_descript'] ?></div>
                        <div class="">Rs.<?= $ord_row['food_rs'] ?></div>
                    </div>
                </div>

                <?php
                        }
                        ?>
            </div>

        </div>
        <!---------------------- Address Form ----------------------->
        <div class="border my-3 col-md-3" id="ch2">
            <div class="text-center pt-3 font-weight-bolder border-bottom" id="title2">Your Order Detaile</div>
            <div class="py-2 px-3">
                <div class="my-3 "><strong>Flat No : </strong><?= $addr_row['flat_no'] ?></div>
                <div class="my-3 "><strong>Street Name : </strong><?= $addr_row['street_name'] ?></div>
                <div class="my-3 "><strong>Area : </strong><?= $addr_row['area'] ?></div>
                <div class="my-2 "><strong>City : </strong><?= $addr_row['city'] ?></div>
            </div>

            <hr>
            <div class="text-center">
                <p class="text-muted my-1">TOTAL</p>
                <h3 class="font-weight-bolder " id="total"><?= $row['amount'] ?></h3>
                <?php
                        if ($row['status'] == "pending") {
                        ?>
                <p class="text-muted px-1 text-capitalize"><?= $row['msg'] ?></p>
                <?php } else { ?>
                <div class="my-3">Status : <?= $row['status'] ?></div>
                <?php } ?>

                <strong>
                    <a onclick="window.open('cancelord.php?ord_id=<?= $row['take_ord_id'] ?>','name','width=600,height=400')"
                        class="text-white btn btn-danger my-3 ord_dtl_a">Cancel Order</a>
                </strong>
            </div>

        </div>


    </div>


</div>
<?php
        include 'footer.php';
    }
}
?>