<html>

<head>
    <?php include 'bfile.html'; ?>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    function msg() {
        window.location.href = 'index.php';
    }
    </script>

</head>
<?php
session_start();
include("config.php");
/*

Table: user
user_id  fname  lname  email  mobile  pass

*/
if (isset($_POST['login'])) {
    $pass = mysqli_escape_string($conn, $_POST['pass']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    // echo 
    $qr = "SELECT * FROM `users` WHERE `email`='$email'";
    // exit();
    if ($res = mysqli_query($conn, $qr)) {
        // We can Proceess Your Request
        if ($user = mysqli_fetch_array($res)) {
            // User is Exist
            if ($user["pass"] == $pass) {
                // Password Match OK
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['usnm'] = $user['fname'];
                $_SESSION['msg'] = "Login Success";
                $_SESSION['login_status'] = 'Successfully';
                header('location:index.php');
            } else {
                // Wrong Password
                echo "<script>
                $.alert({
                    title: 'Not Log in',
                    content: 'Invalid Login',
                    type: 'red',
                    typeAnimated: true,
                });</script>";
            }
        } else {
            // User is not Exist
            $_SESSION["msg"] = "Email Not Registred";
            header("location:login.php");
        }
    } else {
        // We Can't Process Your Request
        $_SESSION["msg"] = "Sorry, We Cant Procees Your Request";
        header("location:login.php");
    }
}
?>
<?php include("alert_msg.php"); ?>

<body class="bg-primary">
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto mt-5">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Sign In</h5>
                            <form method="post">
                                <div class="form-label-group">

                                    <label for="inputEmail">Email address</label>
                                    <input type="email" name="email" id="inputEmail" class="form-control mb-2 "
                                        placeholder="Email address" required autofocus>
                                </div>
                                <div class="form-label-group">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" id="inputPassword" name="pass" class="form-control mb-2"
                                        placeholder="Password" required>
                                </div>
                                <button class="btn btn-primary btn-block text-uppercase" name="login" type="submit">Sign
                                    in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>