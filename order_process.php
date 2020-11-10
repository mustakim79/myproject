<?php
include 'config.php';
session_start();
date_default_timezone_set('Asia/Kolkata');
$currentDateTime = date('Y-m-d H:i:s');
$reg_time = date('Y-m-d H:i:s', strtotime('-45 minute'));
if (isset($_SESSION['user_id'])) {
    if (isset($_GET['id']) && isset($_POST['qty'])) {
        // print_r($_POST);
        $food_id = $_GET['id'];
        // echo $food_id;
        // echo $_SESSION['user_id'];
        $qty = $_POST['qty'];
        $selected_item_qr = "SELECT `food_id`,`food_rs` FROM `food` WHERE `food_id`=$food_id";
        $result = mysqli_query($conn, $selected_item_qr);
        $f_row = mysqli_fetch_assoc($result);
        $amount = $f_row['food_rs'] * $qty;
        // echo
        $is_order = "SELECT * FROM `order_detaile` WHERE `user_id`=$_SESSION[user_id] AND `food_id`=$food_id  AND `ord_status`<>'delivered' AND `ord_status`<>'canceled' AND `ord_status`<>'delivering'";
        // exit;
        $chk_result = mysqli_query($conn, $is_order);
        $row = mysqli_fetch_assoc($chk_result);
        $data = mysqli_num_rows($chk_result);
        if ($data == 0) {
            // echo
            $insert_prod = "INSERT INTO `order_detaile` (`ord_id`, `user_id`, `food_id`, `food_rs`, `food_qty`, `amount`, `time`) VALUES(NULL,$_SESSION[user_id],$food_id,$f_row[food_rs],$qty,$amount,NULL)";
            // exit;
            $in_result = mysqli_query($conn, $insert_prod);
            if ($in_result) {
                // echo "Done";
                echo "Food has added to your cart";
            } else {
                echo "CAN'T" . mysqli_error($conn);
            }
            //  echo "yes";

        } else {
            // $_SESSION['al_msg'] = "This item already added into your cart";
            echo 'This food already added into your cart';
        }
    } else {
        echo "something wron " . mysqli_error($conn);
    }
} else {
    # code...
    echo 'please login';
}