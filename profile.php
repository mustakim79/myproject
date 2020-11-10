<?php
session_start();
include 'config.php';
// echo
$sel_qr = "SELECT * FROM `users` WHERE `user_id`=$_SESSION[user_id]";
// exit;
$res = mysqli_query($conn, $sel_qr);
$row = mysqli_fetch_assoc($res);
if (isset($_POST['submit']) && sizeof($_POST) > 0) {
    extract($_POST);
    // echo
    $updt_qr = "UPDATE `users` SET `fname`='$fnm',`lname`='$lnm',`email`='$eml',`mobile`='$mob' WHERE `user_id`=" . $_SESSION['user_id'];
    // exit;
    $res = mysqli_query($conn, $updt_qr);
    if ($res) {
        // header('location:index.php');
?>
<script>
alert('Profile has been updated');
window.location.href = 'index.php';
</script>
<?php

    } else {
    ?>
<script>
alert('Not Updated');
window.location.href = 'profile.php';
</script>";
<?php
    }
}
include 'header.php';
include 'prevent.html';
?>
<div class="col-5 mx-auto">

    <form method="post" action="">
        <div class="form-group">
            <label for="my-input">FirsName</label>
            <input required id="my-input" class="form-control" type="text" value="<?= $row['fname'] ?>" name="fnm">
        </div>
        <div class="form-group">
            <label for="my-input2">Lastname</label>
            <input required id="my-input2" class="form-control" type="text" value="<?= $row['lname'] ?>" name="lnm">
        </div>
        <div class="form-group">
            <label for="my-input3">Email</label>
            <input required id="my-input3" class="form-control" type="text" value="<?= $row['email'] ?>" name="eml">
        </div>
        <div class="form-group">
            <label for="my-input4">Mobile</label>
            <input required id="my-input4" class="form-control" type="text" value="<?= $row['mobile'] ?>" name="mob">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>
</div>

<?php include 'footer.php'; ?>