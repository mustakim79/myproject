<?php
include 'config.php';
session_start();
// include 'prevent.html';
if (isset($_SESSION['user_id'])) {
    if (isset($_POST['sub']) && count($_POST) > 0) {
        extract($_POST);
        // print_r($_POST);
        // flatno ,street_name,area,city
        // echo "sub";
        // --------------------- FETCH ADDRESS -------------------
        $sel_add = "SELECT * FROM `address` WHERE `user_id`=$_SESSION[user_id]";
        $res_add = mysqli_query($conn, $sel_add);
        $add_data = mysqli_num_rows($res_add);
        if ($add_data == 1) {
            $res = 1;
        } else {
            $street_name = mysqli_real_escape_string($conn, $street_name);
            $flatno = mysqli_real_escape_string($conn, $flatno);
            $area = mysqli_real_escape_string($conn, $area);
            $city = mysqli_real_escape_string($conn, $city);
            // echo $area;
            // ----------------------INSERTING ADDRESS------------------------
            // echo
            $qr = "INSERT INTO `address` VALUES(NULL,'$flatno','$street_name','$area','$city',$_SESSION[user_id],NULL)";
            // exit;
            $res = mysqli_query($conn, $qr);
        }
        if ($res) {
            // echo
            $tk_sel_qr = "SELECT * FROM `take_order` WHERE `user_id`=$_SESSION[user_id] AND `status`='pending' OR `status`='processing'";
            // exit;
            $tk_sel_res = mysqli_query($conn, $tk_sel_qr);
            $row3 = mysqli_fetch_assoc($tk_sel_res);
            $data = mysqli_num_rows($tk_sel_res);
            $no_row2 = 0;
            if ($data > 0) {
                $tk_arr = json_decode($row3['ord_id'], true);
                foreach ($tk_arr as $arr3) {
                    $ord_dtl_qr = "SELECT * FROM `order_detaile` WHERE `ord_id`=$arr3 AND `user_id`=$_SESSION[user_id]";
                    $ord_res2 = mysqli_query($conn, $ord_dtl_qr);
                    if ($ord_res2) {
                        $no_row2 += 1;
                    }
                }
            }
            // echo
            $updt_ord2 = "UPDATE `order_detaile` SET `ord_status`='confirm' WHERE `user_id`=$_SESSION[user_id] AND `ord_status`='not confirm'";
            // exit;
            $updt_res2 = mysqli_query($conn, $updt_ord2);
            // echo
            $is_order = "SELECT * FROM `order_detaile` WHERE `user_id`=$_SESSION[user_id]  AND `ord_status`='confirm' OR `ord_status`='processing'";
            // exit;
            $res_order = mysqli_query($conn, $is_order);
            $total = 0;
            while ($row = mysqli_fetch_assoc($res_order)) {
                $total += $row['amount'];
            }
            // echo "" . $total . "<br>";
            // echo
            $qr2 = "SELECT `order_detaile`.`ord_id`,`address`.`addr_id` FROM `order_detaile` INNER JOIN `address` WHERE `order_detaile`.`user_id`=`address`.`user_id` AND `order_detaile`.`ord_status`='confirm' AND `order_detaile`.`user_id`=$_SESSION[user_id] GROUP BY `order_detaile`.`ord_id`";
            // exit;
            $res2 = mysqli_query($conn, $qr2);
            $ord_id = array();
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $ord_id[] = $row2['ord_id'];
                $addr_id = $row2['addr_id'];
            }
            // print_r($ord_id);
            // echo "<br>" . $addr_id;
            // INSERT addr_id and ord_id in below query
            $msg = "waiting for restaurant confirmation";
            $json_ord_id = mysqli_real_escape_string($conn, json_encode($ord_id, true));
            if ($no_row2 > 0) {
                // update
                // echo
                $ord_qr = "UPDATE `take_order` SET `ord_id`='$json_ord_id',`amount`=$total WHERE `user_id`=$_SESSION[user_id] AND `status`='pending' OR `status`='processing'";
                // exit;
            } else {
                // echo
                $ord_qr = "INSERT INTO `take_order` VALUES(NULL,'$json_ord_id',$addr_id,$_SESSION[user_id],'pending',$total,'$msg',NULL)";
                // exit;
            }
            $ord_res = mysqli_query($conn, $ord_qr);
            if ($ord_res) {
                // echo
                // $updt_qr = "UPDATE `order_detaile` SET `ord_status`='confirm' WHERE `user_id`=$_SESSION[user_id] AND `ord_status`='not confirm'";
                // exit;
                // $res_upd = mysqli_query($conn, $updt_qr);
                if ($ord_res) {
                    $_SESSION['thanks'] = "Thank You For Order Your Deliciouse Food";
                    // echo "<script>alert('Order has been taken');window.location.href='cart.php';</script>";
                    header('location:cart.php');
                } else {
                    echo "Something went wrong " . mysqli_error($conn);
                }
            }
        }
    }
} else {
    # code...
    echo "Please Log in";
}
