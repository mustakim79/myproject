<?php
if (isset($_SESSION['admin'])) {
    function total_order()
    {
        include 'config.php';
        // $qr = "SELECT COUNT(`take_ord_id`) AS total_order FROM `take_order` WHERE `status`<>'canceled' OR `status`<>'delivered' OR `status`<>'delivering'";
        $qr = "SELECT COUNT(`take_ord_id`) AS total_order FROM `take_order` WHERE `status`<>'not confirm'";
        $result = mysqli_query($conn, $qr);
        $row = mysqli_fetch_assoc($result);
        return $row['total_order'];
    }
    function new_order()
    {
        include 'config.php';
        $qr = "SELECT COUNT(`take_ord_id`) AS total_not_confirmed  FROM `take_order` WHERE `status`='pending'";
        $result = mysqli_query($conn, $qr);
        $row = mysqli_fetch_assoc($result);
        return $row['total_not_confirmed'];
    }
    function confirm()
    {
        include 'config.php';
        $qr = "SELECT COUNT(`take_ord_id`) AS total_comf_order  FROM `take_order` WHERE `status`='processing'";
        $result = mysqli_query($conn, $qr);
        $row = mysqli_fetch_assoc($result);
        return $row['total_comf_order'];
    }
    function processing_order()
    {
        include 'config.php';
        $qr = "SELECT COUNT(`take_ord_id`) AS total_proc_order FROM `take_order` WHERE `status`='delivering'";
        $result = mysqli_query($conn, $qr);
        $row = mysqli_fetch_assoc($result);
        return $row['total_proc_order'];
    }
    function delivered_order()
    {
        include 'config.php';
        $qr = "SELECT COUNT(`take_ord_id`) AS total_delivered_order FROM `take_order` WHERE `status`='delivered'";
        $result = mysqli_query($conn, $qr);
        $row = mysqli_fetch_assoc($result);
        return $row['total_delivered_order'];
    }
    function canceled_order()
    {
        include 'config.php';
        $qr = "SELECT COUNT(`take_ord_id`) AS tot_canc_ord FROM `take_order` WHERE `status`='canceled'";
        $result = mysqli_query($conn, $qr);
        $row = mysqli_fetch_assoc($result);
        return $row['tot_canc_ord'];
    }
    function total_user()
    {
        include 'config.php';
        $qr = "SELECT COUNT(`user_id`) AS total_user FROM `users`";
        $result = mysqli_query($conn, $qr);
        $row = mysqli_fetch_assoc($result);
        return $row['total_user'];
    }
    $tot_ord = total_order();
    $new_ord = new_order();
    $comf = confirm();
    $proc_ord = processing_order();
    $del_ord = delivered_order();
    $can_ord = canceled_order();
    $tot_user = total_user();
}