<?php
session_start();
include 'php_files/config.php';
if (isset($_SESSION['admin'])) {
    include 'sidebar_nav.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // echo
        $qr = "SELECT * FROM `take_order` WHERE `take_ord_id`=$id";
        // exit;
        $res = mysqli_query($conn, $qr);
        $data = mysqli_num_rows($res);
        $row = mysqli_fetch_assoc($res);
        if (isset($_POST['submit'])) {
            $status = $_POST['status'];
            // echo
            $qr = "UPDATE `take_order` SET `status`='$status' WHERE `take_ord_id`=$id";
            // exit();
            $arr3 = json_decode($row['ord_id'], true);
            foreach ($arr3 as $ids) {
                $u_qr = "UPDATE `order_detaile` SET `ord_status`='$status' WHERE `ord_id`=$ids";
                $u_res = mysqli_query($conn, $u_qr);
            }
            $res = mysqli_query($conn, $qr);
            if ($res && $u_res) {
                echo "<script>location.href='view_order.php'</script>";
            } else {
                echo "error occured : " . mysqli_error($conn);
            }
        }
        if ($data == 1) {
            $arr = json_decode($row['ord_id'], true);
            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";
            // echo
            $qr2 = "SELECT * FROM `users` INNER JOIN `address` ON `users`.`user_id`=`address`.`user_id`";
            // exit;
            $res2 = mysqli_query($conn, $qr2);
            $row2 = mysqli_fetch_assoc($res2);
            $i = 1;
?>

            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Order Detaile Of #<?= $row['take_ord_id'] ?></li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-12">
                            <table class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th colspan="2">User Detaile</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-capitalize"><b>Order Number</b></td>
                                        <td><?= $row['take_ord_id'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"><b>First Name</b></td>
                                        <td><?= $row2['fname'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"><b>Last Name</b></td>
                                        <td><?= $row2['lname'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"><b>Email</b></td>
                                        <td><?= $row2['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"><b>Mobile Number</b></td>
                                        <td><?= $row2['mobile'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"><b>Flat no/Building no</b></td>
                                        <td><?= $row2['flat_no'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"><b>Street Name</b></td>
                                        <td><?= $row2['street_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"><b>Area</b></td>
                                        <td><?= $row2['area'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"><b>City</b></td>
                                        <td><?= $row2['city'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"><b>Order Date</b></td>
                                        <!-- <td><?php echo date("d-m-Y h:i:a", $row['date_time']); ?></td> -->
                                        <td><?php echo $row['date_time']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"><b>Order Status</b></td>
                                        <td><?= $row['status'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12">
                            <table class="table table-bordered table-hover text-capitalize">
                                <thead>
                                    <tr class="text-center">
                                        <th colspan="5">
                                            Order Detaile
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>Food</th>
                                        <th>Food Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // print_r($arr);
                                    foreach ($arr as $arr2) {
                                        // echo
                                        $qr3 = "SELECT * FROM `order_detaile` INNER JOIN `food` ON `food`.`food_id`=`order_detaile`.`food_id` WHERE `order_detaile`.`ord_id`=$arr2";
                                        // exit;
                                        $res3 = mysqli_query($conn, $qr3);
                                        $row3 = mysqli_fetch_assoc($res3);
                                    ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><img src="../photos/<?= $row3['food_img'] ?>" alter="can't be loaded" height="60px" width="auto">
                                            </td>
                                            <td><?= $row3['food_name'] ?></td>
                                            <td><?= $row3['food_qty'] ?></td>
                                            <td><?= $row3['amount'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?> <tr>
                                        <td class="text-center" colspan="4">Grand Total</td>
                                        <td><?= $row['amount'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-10 col-sm-12 offset-md-1">

                            <form method="post" action="">
                                <select id="my-input2" name="status" class="form-control mb-3">
                                    <option value="confirm">Order confirmed</option>
                                    <option value="processing">Food Being Preparing</option>
                                    <option value="delivering">Food Delivering</option>
                                    <option value="delivered">Food Delivered</option>
                                    <option value="canceled">Order Canceled</option>
                                </select>
                                <div class="col-4 ml-auto">
                                    <button type="submit" name="submit" class="btn btn-primary btn-sm-block mb-2 btn-block">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
<?php

        } else {
            echo "no such order";
        }
    } else {
        echo "<script>location.href='index.php'</script>";
    }
    include 'footer.php';
} else {
    header("location:login.php");
}
?>
</body>

</html>