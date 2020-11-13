<?php
include 'php_files/config.php';
session_start();
if (isset($_SESSION['admin'])) {
    if (isset($_GET['disable'])) {
        $food_id = $_GET['disable'];
        // echo
        $qr = "UPDATE `food` SET `display_status`=0 WHERE `food_id`=$food_id";
        // exit;
        $res = mysqli_query($conn, $qr);
        if ($res) {
            header('location:manage_product.php');
            echo "Disabled successfully";
        } else {
            echo "erro occured " . mysqli_error($conn);
        }
    } else if (isset($_GET['enable'])) {
        $enable_f_id = $_GET['enable'];
        $qr = "UPDATE `food` SET `display_status`=1 WHERE `food_id`=$enable_f_id";
        $res = mysqli_query($conn, $qr);
        if ($res) {
            echo "Enabled successfully";
            header('location:manage_product.php');
        } else {
            echo "erro occured " . mysqli_error($conn);
        }
    }
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        $qr = "DELETE FROM `users` WHERE `user_id`=$user_id";
        $res = mysqli_query($conn, $qr);
        if ($res) {
            echo "<script>location.href='manage_user.php';</script>";
        } else {
            echo "error occured " . mysqli_error($conn);
        }
    }
} else {
    // echo "please login";
    header('location:login.php');
}