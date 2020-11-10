<?php
include 'config.php';
session_start();
if (isset($_SESSION['usnm'])) {
    // echo
    $qr = "SELECT COUNT(food_id) as tot_item FROM `order_detaile` WHERE `user_id`=$_SESSION[user_id] AND `ord_status`='not confirm'";
    // exit;
    $res = mysqli_query($conn, $qr);
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        if ($row['tot_item'] > 0) {
            echo $row['tot_item'];
        } else {
            echo '';
        }
    }
}
