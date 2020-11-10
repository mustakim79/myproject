<?php
session_start();
if (isset($_SESSION['admin']) && isset($_SESSION['admin_user_id'])) {
    unset($_SESSION['admin']);
    unset($_SESSION['admin_user_id']);
    if (!isset($_SESSION['admin']) && !isset($_SESSION['admin_user_id'])) {
        header('location:login.php');
    } else {
        echo "Not logout something went wrong";
    }
} else {
    echo "Not logout";
}