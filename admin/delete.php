<?php
include 'php_files/config.php';
session_start();
if (isset($_SESSION['admin'])) {
    if (isset($_GET['food_id'])) {
        $food_id = $_GET['food_id'];
        $qr = "DELETE FROM `food` WHERE `food_id`=$food_id";
        $res = mysqli_query($conn, $qr);
        if ($res) {
            echo "Deleted successfully";
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