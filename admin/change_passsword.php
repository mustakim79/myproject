<?php
include 'php_files/config.php';
session_start();
if (isset($_SESSION['admin'])) {
    if (isset($_POST['btn_pass_change']) && sizeof($_POST) > 0) {
        extract($_POST);
        function msg($alt_msg2)
        {
            echo "<script>alert('$alt_msg2')</script>";
            // echo $alt_msg2;
        }
        // echo
        $sl_qr = "SELECT * FROM `admin` WHERE `password`='$crt_pass' AND `id`=$_SESSION[admin_user_id]";
        // exit;
        $sl_res = mysqli_query($conn, $sl_qr);
        $data = mysqli_num_rows($sl_res);
        if ($data == 1) {
            if ($new_pass == $rpt_pass) {
                $qr = "UPDATE `admin` SET `password`='$new_pass' where `id`=$_SESSION[admin_user_id]";
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
                    $alt_msg = "Password has not been updated" . mysqli_error($conn);
                    // echo $alt_msg;
                    msg($alt_msg);
                }
            } else {
                # code...
                $alt_msg = "Repeat password does not match";
                // echo $alt_msg;
                msg($alt_msg);
            }
        } else {
            # code...
            $alt_msg = "Current password does not matched";
            // echo $alt_msg;
            msg($alt_msg);
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Page Title - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Password Change</h3>
                                </div>
                                <div class="card-body">
                                    <div class="small mb-3 text-muted">Enter previous password and change your
                                        password.</div>
                                    <form method="POST">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Last Password</label>
                                            <input class="form-control py-4" id="inputEmailAddress" type="text"
                                                placeholder="Enter last passsword" name="crt_pass" />
                                        </div>

                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress2">New Password</label>
                                            <input class="form-control py-4" id="inputEmailAddress2" type="text"
                                                placeholder="Enter new password" name="new_pass" />
                                        </div>

                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress3">Repeat Password</label>
                                            <input class="form-control py-4" id="inputEmailAddress3" type="text"
                                                placeholder="Enter new password again" name="rpt_pass" />
                                        </div>
                                        <div
                                            class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="index.php">Return to home</a>
                                            <button class="btn btn-primary" name="btn_pass_change">Change
                                                Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Food Ordering System 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>

</html>

<?php
} else {
    header('location:login.php');
}
?>