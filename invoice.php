<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <?php include 'bfile.html'; ?>
    <link href="css3/print.css" rel="stylesheet" media="print">
</head>

<body>
    <?php
    include 'config.php';
    session_start();
    if (isset($_GET['id'])) {
        extract($_GET);
        // echo $id;
        $qr = "SELECT * FROM `take_order` WHERE `user_id`=$_SESSION[user_id] AND `status`='delivered' AND `take_ord_id`=$id ";
        $res = mysqli_query($conn, $qr);
        $no_rows = mysqli_num_rows($res);
        if ($no_rows > 0) {
            $row = mysqli_fetch_assoc($res);
            $arr = json_decode($row['ord_id'], true);
            $i = 1;
    ?>

    <div class="container text-capitalize">
        <div class="col-md-10 col-lg-9 col mx-auto">

            <table class="table table-hover text-center table-bordered mt-3">

                <thead>
                    <tr>

                        <th colspan="6">
                            <h3 class="inv_capt">Your Order Detaile</h3>
                        </th>

                    </tr>
                    <tr>
                        <th>No.</th>
                        <th>Food</th>
                        <th>Food Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <?php
                        foreach ($arr as $arr2) {
                            // echo
                            $ord_qr = "SELECT * FROM `order_detaile` INNER JOIN `food` WHERE `order_detaile`.`user_id`=$_SESSION[user_id] AND `order_detaile`.`ord_id`=$arr2 AND `order_detaile`.`food_id`=`food`.`food_id`";
                            // exit;
                            $ord_res = mysqli_query($conn, $ord_qr);
                            $ord_row = mysqli_fetch_assoc($ord_res);
                        ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><img src="photos/<?= $ord_row['food_img'] ?>" alt="img" class="inv_img"></td>
                    <td><?= $ord_row['food_name'] ?></td>
                    <td><?= $ord_row['food_qty'] ?></td>
                    <td><?= $ord_row['food_rs'] ?></td>
                    <td><?= $ord_row['time'] ?></td>
                </tr>
                <?php
                        }
                        ?>
                <tr>
                    <td colspan="5">Grand Total</td>
                    <td><?= $row['amount'] ?></td>
                </tr>
            </table>
            <button class="btn btn-secondary mb-4 float-right" id="print" onclick="window.print()">Print</button>
        </div>
    </div>
</body>
<?php
        }
    } else {
        # code...
        echo "Something Wrong " . mysqli_error($conn);
    }

?>

</html>