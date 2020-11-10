<?php
include 'php_files/config.php';
session_start();
date_default_timezone_set('Asia/Kolkata');
if (isset($_SESSION['admin'])) {

    $shop_qr = "SELECT * FROM `shop_close`";
    $shop_res = mysqli_query($conn, $shop_qr);
    $shop_data = mysqli_fetch_assoc($shop_res);
    $time = date('H:i:s', time());
    if ((isset($_POST['save'])) && (sizeof($_POST) > 0)) {
        if ($_POST['message'] == "")
            $_POST['message'] = "shop has been closed";
        $msg = mysqli_escape_string($conn, $_POST['message']);
        $start = $_POST['start'];
        $end = $_POST['end'];
        isset($_POST['shop']) ? $status = 1 : $status = 0;
        if (($time > $shop_data['end_shop'])) {
            $uqr = "UPDATE `shop_close` SET `status`=0 ";
            // echo "$time --- $shop_data[end_shop] --- $shop_data[start_shop]";
            $ures = mysqli_query($conn, $uqr);
            // echo "<script>console.log('current =-->  $time, endtime =--> $shop_data[end_shop] start=--> $shop_data[start_shop]')</script>";
        }
        // echo 
        $qr = "UPDATE `shop_close` SET `status`=$status,`msg`='$msg',`start_shop`='$start',`end_shop`='$end'";
        // exit;
        $res = mysqli_query($conn, $qr);

        if ($res) {
            echo "updated successfully ";
            header('location:' . $_SERVER['PHP_SELF']);
        } else {
            echo "error = " . mysqli_error($conn);
        }
    }
    include 'sidebar_nav.php';


    $sqr = "SELECT * FROM `shop_close`";
    $sres = mysqli_query($conn, $sqr);
    $row = mysqli_fetch_assoc($sres);
?>
    <main class="container-fluid">

        <div class="mt-5">
            <div class="col-md-6 offset-md-3 col-sm-6 offset-sm-3 pt-4 mb-5">
                <form method="POST">
                    <div class="card">
                        <div class="card-header text-center">
                            <div>Shop Close</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <label>Start Time</label>
                                </div>
                                <div class="col-6">
                                    <label>End Time</label>
                                </div>
                            </div>
                            <div class="form control row">
                                <div class="col-6">
                                    <input name="start" type="time" class="form-control" required value="<?= $row['start_shop'] ?>">
                                </div>
                                <div class="col-6">
                                    <input name="end" type="time" class="form-control" required value="<?= $row['end_shop'] ?>">
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" checked class="custom-control-input" id="switch1" name="shop">
                                    <label class="custom-control-label" for="switch1">Shop</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="msg">Custom Message if Shop is Closed</label>
                                <div>
                                    <input type="text" id="msg" class="form-control" name="message" value="">
                                </div>
                            </div>
                            <input type="submit" name="save" value="Save" class="btn btn-primary float-right">

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </main>

<?php
    include 'footer.php';
} else {
    header('location:login.php');
}
?>