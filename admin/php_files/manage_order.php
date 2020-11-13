<?php
include 'config.php';
session_start();
if (isset($_SESSION['admin'])) {
    if (isset($_POST['submit']) && sizeof($_POST) > 0 && $_GET['ord_id']) {
        $status = mysqli_escape_string($conn, $_POST['status']);
        $ord_id = $_GET['ord_id'];

        // print_r($_POST);
        $qr = "UPDATE `take_order` SET `status`='$status' WHERE `take_ord_id`=$ord_id";
        $res = mysqli_query($conn, $qr);
        if ($res) {
            echo "Status has been updated";
        } else {
            echo "Error : " . mysqli_error($conn);
        }
    } else {
        echo "something wrong";
    }
} else {
    // echo "login please";
    header('location:login.php');
}