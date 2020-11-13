<?php
session_start();
include 'config.php';

date_default_timezone_set('Asia/Kolkata');
if (isset($_GET['cat_id'])) {
    $id = $_GET['cat_id'];
    $qr = "SELECT * FROM `food` WHERE `category_id`=$id AND `display_status`=1";
} else if (isset($_POST['bsch'])) {
    $fnm = mysqli_escape_string($conn, $_POST['tsch']);
    $qr = "SELECT * FROM `food` WHERE `food_name` LIKE '%$fnm%' AND `display_status`=1";
} else {
    $qr = "SELECT * FROM `food` WHERE `display_status`=1";
}
$res = mysqli_query($conn, $qr);
$rows = mysqli_num_rows($res);
include("header.php");
$shop_qr = "SELECT * FROM `shop_close`";
$shop_res = mysqli_query($conn, $shop_qr);
$shop_data = mysqli_fetch_assoc($shop_res);
$time = date('H:i:s', time());
include 'alert_msg.php';
?>
<main>
    <div class="mn">
        <div class="fm">
            <form method="post">
                <p style="color:black"><b>Find your favourite delicious hot food!</b></p>
                <input type="text" class="form-control " id="formGroupExampleInput" name="tsch"
                    placeholder="I want to eat..." />
                <input type="submit" name="bsch" value="search" class="btn btn-primary mt-2" />
            </form>
        </div>
    </div>
    <div class="text-capitalize">
        <div class="row no-gutters hd">
            <div class="container-fluid">
                <div class="col-12 mt-4 mb-3 text-center">
                    <div class="type-div">
                        <h1 class="type"></h1>
                    </div>
                    <?php if ($rows > 0) { ?>
                    <div class="row row-cols-1 row-cols-md-3">
                        <?php
                            $i = 1;
                            while ($row = mysqli_fetch_row($res)) {
                                $i++;
                            ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <img src="photos/<?php echo $row[1]; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row[2]; ?></h5>
                                    <p class="card-text" style="height:fit-content;"><?php echo $row[3]; ?></p>
                                </div>
                                <div class="card-footer bg-white border-0">
                                    <form id="myform" name="myform" method="post">

                                        <div>
                                            <div class="mb-1">
                                                <b><b><?php echo "Rs. " . $row[4]; ?></b></b>
                                            </div>
                                            <?php
                                                    // echo "time = " . $time;
                                                    if (($shop_data['status'] == 0) || ((($time > $shop_data['end_shop'])) && ($time < ($shop_data['start_shop'])))) {
                                                    ?>
                                            <div>
                                                <p class="text-danger"><?= $shop_data['msg'] ?></p>
                                            </div>
                                            <?php
                                                    } else {


                                                    ?>
                                            <div class="text-center mb-3" style="max-width:250px;margin:auto;">
                                                <input type="number" pattern="[1-9]" required name="qty" value="1"
                                                    min="1" step="1" id="spinner<?= $row[0] ?>">
                                            </div>
                                            <div>
                                                <input id="sub" name="sub" type="button"
                                                    class="btn btn-primary text-white" value="Order Now"
                                                    data-qty="#spinner<?= $row[0] ?>"
                                                    onclick="insert(<?= $row[0] ?>,$($(this).attr('data-qty')).val()) ">
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                            ?>
                    </div>
                    <script>
                    $('input[type=number]').inputSpinner();
                    </script>

                    <?php
                    } else {
                        echo "<h4><strong>No such product available</strong></h4>";
                    ?>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script>
                    window.aaalt = function() {
                        var a = swal("Good job!", "You clicked the button!", "success");
                        // location.href = "/";
                    }
                    </script>
                    <?php
                        // echo "<script>aaalt()</script>";
                    } ?>
                </div>
            </div>

        </div>
    </div>
</main>
<script src="scripts/insert_data.js"></script>
<script src="type js file/typed.js"></script>
<script type='text/javascript'>
var typed = new Typed('.type', {
    strings: ["Welcome To Our Website", "Populer This Month In Your City", "Order Your Delicious Food"],
    typeSpeed: 30,
    backSpeed: 30,
    loop: true,
    backDelay: 500,
});
</script>
<?php include("footer.php"); ?>