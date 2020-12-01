<?php
include 'config.php';
session_start();
if (isset($_GET['id']) && isset($_GET['qty'])) {
    extract($_GET);
    // echo $qt;
    // print_r($_GET);
    // echo
    $qr2 = "SELECT * from `food` WHERE `food_id`=$id";
    // exit;
    $res2 = mysqli_query($conn, $qr2);
    $row = mysqli_fetch_assoc($res2);
    // echo
    // "food rs  ===  " . $row['food_rs'] . "qty   ==  " . $qty;
    $tot_amount = $row['food_rs'] * $qty;
    $qr = "UPDATE order_detaile SET food_qty=$qty, amount=$tot_amount WHERE user_id=$_SESSION[user_id] AND food_id=$id";
    // exit;
    $res = mysqli_query($conn, $qr);
    if ($res) {
        echo "Updated";
    } else {
        # code...
        echo "Not Updated";
    }
} else {
    echo "Not Set Id" . mysqli_error($conn);
}