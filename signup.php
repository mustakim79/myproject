<?php
include 'config.php';
if (isset($_POST["submit"])) {
    extract($_POST);
    $eml = mysqli_escape_string($conn, $eml);
    // echo
    $chk = "SELECT * FROM `users` WHERE `email`='$eml' OR `mobile`=$mob";
    // exit;
    $chk_rs = mysqli_query($conn, $chk);
    $data = mysqli_num_rows($chk_rs);
    if ($data == 0) {
        // echo
        $qr = "INSERT INTO `users` VALUES(NULL,'$fnm','$lnm','$eml',$mob,'$pass',NULL)";
        // exit;
        $res = mysqli_query($conn, $qr);
        if ($res) {
            // header("location:signup.php");
            echo "<script>alert('Registered Successfully');</script>";
        }
    } else {
        echo "<script>alert('Email id or Mobile Number has already exist try different');</script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1 class="text-center">Sign up Form</h1>
        <div class="col-5 mx-auto">
            <form method="post">
                <div class="form-group">
                    <label for="my-input">FirsName</label>
                    <input required id="my-input" class="form-control" type="text" name="fnm">
                </div>
                <div class="form-group">
                    <label for="my-input2">Lastname</label>
                    <input required id="my-input2" class="form-control" type="text" name="lnm">
                </div>
                <div class="form-group">
                    <label for="my-input3">Email</label>
                    <input required id="my-input3" class="form-control" type="text" name="eml">
                </div>
                <div class="form-group">
                    <label for="my-input4">Mobile</label>
                    <input required id="my-input4" class="form-control" type="text" name="mob">
                </div>
                <div class="form-group">
                    <label for="my-input5">Password:</label>
                    <input required id="my-input5" class="form-control" type="text" name="pass">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>