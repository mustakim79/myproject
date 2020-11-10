<?php
session_start();
include 'config.php';
include 'header.php';
// echo
$ord_q = "SELECT * FROM `take_order` WHERE `user_id`=$_SESSION[user_id] AND `status`<>'delivered' AND `status`<>'canceled'";
// exit;
$res_ord3 = mysqli_query($conn, $ord_q);
$ord_row = mysqli_fetch_assoc($res_ord3);
$data = mysqli_num_rows($res_ord3);
if ($data > 0) {
?>
<div class="back"></div>
<div class="text-capitalize " id="flex">
    <div class="border my-md-5 pt-3 pb-4 px-2" id="ord_ch1">

        <div class="media">
            <img src="photos/order_img.jpg" class="mr-3" alt="" height="80" width="80">
            <div class="media-body">
                <h5 class="mt-0">Order # <?= $ord_row['take_ord_id']; ?></h5>
                <strong>Order Date :</strong><?= $ord_row['date_time'] ?><br>
                <i class="fa fa-check"></i> <small class="text-muted"><?= $ord_row['msg'] ?> </small><br>
                <a href="#"><i class="fas fa-motorcycle text-dark"> </i> Track Order</a>
            </div>
        </div>
    </div>
    <div class="text-center my-5 p-5 border" id="ord_ch2">
        <a class="btn btn-primary" href="order_detaile.php?id=<?= $ord_row['take_ord_id'] ?>">View Detaile</a>
    </div>
</div>
<?php
} else {
    // header('location:index.php');
    echo "<h1 class='h-75 text-center'>You Have Not Order Yet</h1>";
}
include 'footer.php';
?>