<?php
include 'php_files/config.php';
session_start();
if (isset($_SESSION['admin'])) {
    include 'sidebar_nav.php';
    // echo
    $qr = "SELECT * FROM `take_order` INNER JOIN `users` WHERE `take_order`.`user_id`=`users`.`user_id` GROUP BY (take_ord_id)";
    // exit;
    $res = mysqli_query($conn, $qr);

?>
<main class="container-fluid">
    <div class="card mb-4 my-3">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Users
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-capitalize">
                            <th>order id</th>
                            <th>Food Name</th>
                            <th>user Name</th>
                            <th>status</th>
                            <th>amount</th>
                            <th>time</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                        <tr>
                            <td><?= $row['take_ord_id'] ?></td>
                            <td class="text-capitalize">
                                <?php
                                        $arr2 = json_decode($row['ord_id']);
                                        foreach ($arr2 as $arr3) {
                                            // echo
                                            $qr_sel = "SELECT * FROM `order_detaile` INNER JOIN `food` WHERE `ord_id`=$arr3 AND `food`.`food_id`=`order_detaile`.`food_id`";
                                            // exit;
                                            $res_sel = mysqli_query($conn, $qr_sel);
                                            $name = mysqli_fetch_assoc($res_sel);
                                            echo $name['food_name'] . ".<br> ";
                                        } ?></td>
                            <td><?= $row['fname'] ?></td>
                            <td><?= $row['status'] ?></td>
                            <td><?= $row['amount'] ?></td>
                            <td><?= $row['date_time'] ?></td>
                            <td>
                                <a href="view_order.php?id=<?= $row['take_ord_id'] ?>" class="btn btn-primary"
                                    role="button">View</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr class="text-capitalize">
                            <th>order id</th>
                            <th>Food Name</th>
                            <th>user Name</th>
                            <th>status</th>
                            <th>amount</th>
                            <th>time</th>
                            <th>View</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</main>
<?php
    include 'footer.php';
} else {
    header('location:login.php');
}

?>