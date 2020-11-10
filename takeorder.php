<script>
    function msg() {
        alert('Your food has added');
        window.location.href = 'index.php';
    }

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    function is_login() {
        alert('You must be login first')
        window.location.href = 'index.php';
    }
</script>
<?php
session_start();
include 'config.php';
if (isset($_GET['id']) && isset($_SESSION['id'])) {
    $id = $_GET['id'];
    // echo
    $sq = "select * from food where fid=$id";
    // exit();
    $rsq = mysqli_query($conn, $sq);

    $frs = mysqli_fetch_array($rsq);
    // echo 
    $qr = "insert into tmp_order values(NULL,'$frs[fname]',$frs[rs],$_SESSION[id])";
    // exit();

    $res = mysqli_query($conn, $qr);
    if ($res) {
        echo "<script>msg()</script>";
    }
} else {
    echo "<script>is_login()</script>";
}

?>