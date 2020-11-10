<?php
include 'config.php';
include 'prevent.html';
session_start();
if (isset($_SESSION['user_id'])) {
    if (isset($_GET['id'])) {
        extract($_GET);
        $qr = "DELETE FROM `order_detaile` WHERE `food_id`=$id AND `user_id`=$_SESSION[user_id] AND `ord_status`='not confirm' ";
        $res = mysqli_query($conn, $qr);
        if ($res) {
?>
            <script>
                alert('This Item Deleted From Your Cart');
                window.location.href = "cart.php";
            </script>
        <?php
        } else {
            # code...
        ?>

            <script>
                alert('Can Not Be Deleted');
                window.location.href = "cart.php";
            </script>
        <?php
        }
    }
    if (isset($_GET['u_id'])) {
        extract($_GET);
        $qr = "DELETE FROM `order_detaile` WHERE `user_id`=$_SESSION[user_id] AND `ord_status`='not confirm' ";
        $res = mysqli_query($conn, $qr);
        if ($res) {
        ?>
            <script>
                alert('All Item Has Deleted From Your Cart');
                window.location.href = "cart.php";
            </script>
<?php

        }
    } else {
        echo "<script>
                alert('Can Not Be Deleted');
                window.location.href = 'cart.php';
            </script>";
    }
} else {
    echo "<script>
        alert('Can Not Be Deleted');
        window.location.href = 'cart.php';
        </script>";
}
?>