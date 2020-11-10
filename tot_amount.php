<?php
include 'config.php';
session_start();
$qr = "SELECT SUM(amount) AS tot FROM `order_detaile` WHERE user_id=$_SESSION[user_id] AND `ord_status`='not confirm'  ";
$res = mysqli_query($conn, $qr);
$row = mysqli_fetch_assoc($res);
echo $row['tot'];
