<?php
include 'php_files/config.php';
session_start();
if (isset($_SESSION['admin'])) {
    include 'sidebar_nav.php';
    $qr = "SELECT * FROM `users`";
    $res = mysqli_query($conn, $qr);

?>
<main class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <?php
        if (isset($_GET['u_id'])) {
            $id = $_GET['u_id'];
            $s_qr2 = "SELECT * FROM `users` WHERE `user_id`=$id";
            $s_res = mysqli_query($conn, $s_qr2);
            $s_row = mysqli_fetch_assoc($s_res);
            if (isset($_POST['sub'])) {
                $lname = mysqli_escape_string($conn, $_POST['lname']);
                $fname = mysqli_escape_string($conn, $_POST['fname']);
                $email = mysqli_escape_string($conn, $_POST['email']);
                $mob = mysqli_escape_string($conn, $_POST['mob']);
                $u_qr = "UPDATE `users` SET `fname`='$fname',`lname`='$lname',`email`='$email',`mobile`='$mob' WHERE `user_id`=$id";
                $u_res = mysqli_query($conn, $u_qr);
                if ($u_res) {
        ?>
    <script>
    $.alert({
        title: 'Successfully',
        content: 'User Data Updated Successfully',
        type: 'green',
        typeAnimated: true,
        animation: 'opacity',
        closeAnimation: 'rotateX',
    });
    // window.location.href = "manage_user.php";
    </script>
    <?php
                } else {
                    echo "error " . mysqli_error($conn);
                }
            }
            ?>
    <form method="post">
        <div class="card">
            <div class="text-center card-header ">
                Edit User
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="my-input">First Name </label>
                    <input id="my-input" class="form-control" type="text" required name="fname"
                        value="<?= $s_row['fname'] ?>">
                </div>
                <div class="form-group">
                    <label for="my-input2">Last Name</label>
                    <input id="my-input2" class="form-control" required type="text" name="lname"
                        value="<?= $s_row['lname'] ?>">
                </div>
                <div class="form-group">
                    <label for="my-input3">Email </label>
                    <input id="my-input3" class="form-control" required type="email" name="email"
                        value="<?= $s_row['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="my-input4">Mobile </label>
                    <input id="my-input4" class="form-control" pattern="[0-9]{10}" required type="tel" name="mob"
                        value="<?= $s_row['mobile'] ?>">
                </div>
            </div>
            <div class="card-footer">
                <input class="btn btn-primary float-right" type="submit" name="sub" value="Update">
            </div>
        </div>

    </form>
    <?php
        } else {
        ?>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Users
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-capitalize">

                            <th>Id</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>mobile</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                        <tr>
                            <td><?= $row['user_id'] ?></td>
                            <td class="text-capitalize">
                                <?php
                                            echo $row['fname'] . " ";
                                            echo $row['lname'];
                                            ?>
                            </td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['mobile'] ?></td>
                            <td><a href="manage_user.php?u_id=<?= $row['user_id'] ?>" class="btn btn-primary"
                                    role="button">Edit</a></td>
                            <td><a href="delete.php?user_id=<?= $row['user_id'] ?>" class="btn btn-danger btn-sm">
                                    Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr class="text-capitalize">

                            <th>Id</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>mobile</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <?php } ?>
</main>
<?php

    include 'footer.php';
} else {
    header('login.php');
}
?>