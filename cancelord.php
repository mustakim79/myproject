<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'bfile.html'; ?>


    <?php
    include 'config.php';
    session_start();
    if (isset($_SESSION['user_id'])) {
        if (isset($_GET['ord_id'])) {
            extract($_GET);
            // echo
            $sel_qr = "SELECT * FROM `take_order` WHERE `user_id`=$_SESSION[user_id] AND `take_ord_id`=$ord_id  AND `status`<>'canceled'";
            // exit;
            $sel_res = mysqli_query($conn, $sel_qr);
            $data = mysqli_num_rows($sel_res);
            $row = mysqli_fetch_assoc($sel_res);
            $arr = json_decode($row['ord_id'], true);
            if (isset($_POST['s'])) {
                $reasion = mysqli_real_escape_string($conn, $_POST['rsn']);
                $canc_qr = "INSERT INTO `canceled_order` VALUES(NULL,$ord_id,$_SESSION[user_id],'$reasion',NULL)";
                $canc_res = mysqli_query($conn, $canc_qr);
                if ($canc_res) {
                    if ($data == 1) {
                        // echo
                        $tk_ord_qr = "UPDATE `take_order` SET `status`='canceled' WHERE `user_id`=$_SESSION[user_id] AND `take_ord_id`=$ord_id";
                        // exit;
                        $tk_ord_res = mysqli_query($conn, $tk_ord_qr);
                        $ord_qr = "UPDATE `order_detaile` SET `ord_status`='canceled' WHERE `user_id`=$_SESSION[user_id]";
                        $ord_res = mysqli_query($conn, $ord_qr);
                        if ($tk_ord_res && $ord_res) {
    ?>
    <script>
    window.close('index.php', 'name', 'width=600,height=400');
    </script>
    <?php
                        }
                    }
                }
            }
        }
    }
    ?>

</head>

<body>
    <div class="container">

        <table class="table table-bordered table-hover text-center mt-2">
            <thead>
                <tr>
                    <th colspan="2">Cancel Order</th>
                </tr>
                <tr>
                    <th>Order Number</th>
                    <th>Current Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $row['take_ord_id'] ?></td>
                    <td><?= $row['status'] ?></td>
                </tr>
            </tbody>
        </table>
        <form method="post" action="">
            <div class="form-group">
                <label for="my-textarea">Reasion For Cancel</label>
                <textarea id="my-textarea" required class="form-control" name="rsn" rows="3"></textarea>
                <input class="btn btn-primary mt-2" type="submit" name="s">
            </div>
        </form>
    </div>
</body>

</html>