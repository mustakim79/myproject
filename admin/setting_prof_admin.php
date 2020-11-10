<?php
include 'config.php';
session_start();
include 'sidebar_nav.php';
if (isset($_SESSION['admin'])) {
    if (isset($_POST['sub']) && sizeof($_POST) > 0) {
        extract($_POST);
        // echo
        $sl_qr = "SELECT * FROM `users` WHERE `pass`='$crt_pass' && `id`=$_SESSION[admin_user_id]";
        // exit;
        $sl_res = mysqli_query($conn, $sl_qr);
        $data = mysqli_num_rows($sl_res);
        if ($data == 1) {
            if ($new_pass == $rpt_pass) {
                $qr = "UPDATE `users` SET `pass`='$new_pass' where `id`=" . $_SESSION['admin_user_id'];
                $res = mysqli_query($conn, $qr);
                if ($res) {
?>
                    <script>
                        alert('Password has been updated');
                        window.location.href = 'index.php';
                    </script>
    <?php
                } else {
                    # code...
                    $_SESSION['msg'] = "Password has not been updated";
                }
            } else {
                # code...
                $_SESSION['msg'] = "Repeat password does not match";
            }
        } else {
            # code...
            $_SESSION['msg'] = "Current password does not matched";
        }
    }
    ?>
    <div class="container">
        <h1 class="text-center">Change Your Password</h1>


        <div class="col-5 mx-auto">
            <form method="post" action="">
                <div class="form-group">
                    <label for="my-input">Current Password</label>
                    <input id="my-input" class="form-control" type="text" name="crt_pass" required>
                </div>
                <div class="form-group">
                    <label for="my-input2">New Password</label>
                    <input id="my-input2" class="form-control" type="text" name="new_pass" required>
                </div>
                <div class="form-group">
                    <label for="my-input3">Reapead Password</label>
                    <input id="my-input3" class="form-control" type="text" name="rpt_pass" required>
                </div>
                <input class="btn btn-primary" type="submit" value="Submit" name="sub">
            </form>

        </div>
    </div>
<?php
    include 'footer.php';
} else {
    header('location:login.php');
}
?>