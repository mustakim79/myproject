<?php
include 'config.php';
session_start();
include 'header.php';
include 'prevent.html';
?>
<?php
date_default_timezone_set('Asia/Kolkata');
$currentDateTime = date('Y-m-d H:i:s');
$reg_time = date('Y-m-d H:i:s', strtotime('-45 minute'));
// echo
$has_order = "SELECT * FROM `order_detaile` WHERE user_id=$_SESSION[user_id]  AND `ord_status`='not confirm'";
// exit();
$in_result = mysqli_query($conn, $has_order);
$data = mysqli_num_rows($in_result);
$val = true;
// echo
$total_rs_qr = "SELECT SUM(amount) AS total FROM `order_detaile` WHERE user_id=$_SESSION[user_id] AND `ord_status`='not confirm'";
// exit;
$tot_res = mysqli_query($conn, $total_rs_qr);
$total_rs_qr2 = "SELECT SUM(amount) AS total FROM `order_detaile` WHERE user_id=$_SESSION[user_id] AND `ord_status`='not confirm'";
$tot_res2 = mysqli_query($conn, $total_rs_qr2);
if ($data > 0) {
    # code...
    $val = false;

?>
<div class="container text-capitalize">
    <div class="no-gutters" id="crt_flex">

        <div class="border my-3 " id="ch1">
            <div class="text-center mb-3 font-weight-bold border-bottom pt-3" id="title">Your
                Food
            </div>
            <!-- <div class="border my-3" id="ch1">
            <div class="text-center font-weight-bold border-bottom pt-3" id="title">Your
                Food
            </div> -->
            <div class="px-2">
                <?php
                    while ($row = mysqli_fetch_assoc($in_result)) {
                        // print_r($row);
                        // echo
                        $qr = "select * from food where food_id=$row[food_id]";
                        // exit;
                        $result = mysqli_query($conn, $qr);
                        $row2 = mysqli_fetch_assoc($result);

                    ?>

                <div class="row">
                    <div class="col-md-4 col-sm-4 offset-sm-4  col-4 offset-4 offset-md-0">

                        <img src="photos/<?= $row2['food_img'] ?>" class="mr-3" style="height:auto;width:140px;"
                            alt="...">
                    </div>
                    <div class="col-md-8 col-sm-8 offset-sm-2 offset-md-0 col-8 offset-2 ">

                        <h5 class="mt-0 text-center"><?= $row2['food_name'] ?></h5>
                    </div>
                </div>
                <div class="row">
                    <!----------- Number Spinner ------------>
                    <div class="col-md-3 col-sm-4 offset-sm-4 offset-md-0 text-center mt-2 col-4 offset-4"
                        style="width: 100px;">
                        <input type="number" pattern="[1-9]+" required class="form-control text-center"
                            onchange="update_data(<?= $row2['food_id'] ?>,this.value); get_amount();"
                            onkeydown="get_amount()" onclick="get_amount()" onblur="get_amount()" name="qty"
                            value="<?= $row['food_qty'] ?>" min="1" step="1" id="spinner"
                            onload="update_data(<?= $row2['food_id'] ?>,this.value); get_amount();">
                    </div>

                    <div class="col-md-3 mt-md-3 col-sm-4 offset-sm-4 offset-md-0 mt-sm-2 col-4 offset-4">
                        <div class="mx-3">Rs.<?= $row2['food_rs'] ?></div>

                    </div>
                    <div class="col-md-6 col-sm-4 offset-sm-4 offset-md-0 col-4 offset-4">

                        <span class="mx-3"><a href="order_delete.php?id=<?= $row2['food_id'] ?>"
                                class="btn btn-danger mt-2">DELETE
                                <i class="fa fa-trash" aria-hidden="true"></i></a></span>
                    </div>
                </div>
                <hr>

                <?php
                    }
                    ?>
            </div>
        </div>
        <!---------------------- Address Form ----------------------->

        <div class="border my-3" id="ch2">
            <?php
                // --------------------- FETCH ADDRESS -------------------
                // echo
                $sel_add = "SELECT * FROM `address` WHERE `user_id`=$_SESSION[user_id]";
                // exit;
                $res_add = mysqli_query($conn, $sel_add);
                $addr_row = mysqli_fetch_assoc($res_add);
                $add_data = mysqli_num_rows($res_add);
                if ($add_data == 1) {
                ?>
            <form method="post" action="place_ord.php">

                <div class="text-center pt-3 font-weight-bolder border-bottom" id="title2">Your Order Detaile</div>
                <div class="py-2 px-3">
                    <div class="my-3 "><strong>Flat No : </strong><?php echo $addr_row['flat_no'];
                                                                            ?></div>
                    <div class="my-3 "><strong>Street Name : </strong><?php echo $addr_row['street_name'];
                                                                                ?></div>
                    <div class="my-3 "><strong>Area : </strong><?php echo $addr_row['area'];
                                                                        ?></div>
                    <div class="my-2 "><strong>City : </strong><?php echo $addr_row['city'];
                                                                        ?></div>
                </div>

                <hr>
                <div class="text-center">
                    <p class="text-muted my-1">TOTAL</p>
                    <?php
                            if ($tot_res) {
                                $row4 = mysqli_fetch_assoc($tot_res2);
                            ?>

                    <h3 class="font-weight-bolder m-0" id="total"><?= $row4['total'] ?></h3>
                    <p class="text-muted">Free shiping</p>
                    <?php
                            } ?>
                    <p class="text-muted"><?= $row['msg'] ?></p>
                    <button type="submit" class="btn btn-primary my-3" name="sub">ORDER PLACE</button>

                </div>
            </form>

            <?php
                } else {
                ?>
            <!--------------- INSERTING address ---------------->
            <div class="text-center pt-3 font-weight-bolder">Your Shoping Cart</div>
            <hr>
            <form method="post" action="place_ord.php">
                <div class="p-2">
                    <input class="form-control my-1" required type="text" placeholder="Flat or Building Number"
                        name="flatno">
                    <input class="form-control my-1" required type="text" placeholder="Street Name / No"
                        name="street_name">
                    <input class="form-control my-1" required type="text" placeholder="Area" name="area">
                    <input class="form-control my-1" required type="text" placeholder="City" name="city">
                </div>
                <?php
                        if ($tot_res) {
                            $row3 = mysqli_fetch_assoc($tot_res);
                        ?>
                <hr>
                <div class="text-center">
                    <p class="text-muted">TOTAL</p>
                    <h3 class="font-weight-bolder m-0" id="total"><?= $row3['total'] ?></h3>
                    <p class="text-muted">Free shiping</p>
                    <button type="submit" class="btn btn-primary my-2" name="sub">ORDER PLACE</button>
                </div>
                <?php
                        }
                        ?>
            </form>
            <?php
                } ?>
        </div>

        <?php
    }
        ?>

    </div>
    <?php
        if (isset($_SESSION['thanks'])) {
        ?>
    <div class=" h-75 text-center" style="display:flex;align-items:center;justify-content:center;">

        <h1>
            <?php
                    echo $_SESSION['thanks'];
                    unset($_SESSION['thanks']);

                    ?>
        </h1>
    </div>

    <?php
        } elseif ($val) {
        ?>
    <div class=" h-75 text-center" style="display:flex;align-items:center;justify-content:center;">

        <h1>NO ORDERED YET<br>PLEASE ORDER SOMETHING</h1>
    </div>
    <?php

        }
        ?>

</div>
<script>
function update_data(id, qty) {
    $.ajax({
        method: "GET",
        url: 'update_qty.php',
        data: {
            id: id,
            qty: qty
        },
        success: function(data) {
            console.log(data);

        }
    });


}

function get_amount() {
    $("#total").load('tot_amount.php', function(response, status, xhr) {
        if (status == "error") {
            var msg = "Sorry but there is an error: ";
            console.log(msg);
        }
        console.log(response + "  :  " + status);
    });
}
setInterval(() => {
    get_amount();
}, 500);
</script>

<?php
    include 'footer.php';
    ?>