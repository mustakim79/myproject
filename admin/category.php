<?php
include 'php_files/config.php';
session_start();
if (isset($_SESSION['admin'])) {
    function crop_jpeg($img)
    {
        $path = "../photos/" . $_FILES["file"]["name"];
        $image = imagecreatefromjpeg($img);
        $filename = $path;

        $thumb_width = 1920;
        $thumb_height = 1080;

        $width = imagesx($image);
        $height = imagesy($image);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ($original_aspect >= $thumb_aspect) {
            // If image is wider than thumbnail (in aspect ratio sense)
            $new_height = $thumb_height;
            $new_width = $width / ($height / $thumb_height);
        } else {
            // If the thumbnail is wider than the image
            $new_width = $thumb_width;
            $new_height = $height / ($width / $thumb_width);
        }

        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

        // Resize and crop
        imagecopyresampled(
            $thumb,
            $image,
            0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
            0 - ($new_height - $thumb_height) / 2, // Center the image vertically
            0,
            0,
            $new_width,
            $new_height,
            $width,
            $height
        );
        imagejpeg($thumb, $filename, 80);
    }
    function crop_png($img)
    {
        $path = "../photos/" . $_FILES["file"]["name"];
        $image = imagecreatefrompng($img);
        $filename = $path;

        $thumb_width = 1920;
        $thumb_height = 1080;

        $width = imagesx($image);
        $height = imagesy($image);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ($original_aspect >= $thumb_aspect) {
            // If image is wider than thumbnail (in aspect ratio sense)
            $new_height = $thumb_height;
            $new_width = $width / ($height / $thumb_height);
        } else {
            // If the thumbnail is wider than the image
            $new_width = $thumb_width;
            $new_height = $height / ($width / $thumb_width);
        }

        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

        // Resize and crop
        imagecopyresampled(
            $thumb,
            $image,
            0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
            0 - ($new_height - $thumb_height) / 2, // Center the image vertically
            0,
            0,
            $new_width,
            $new_height,
            $width,
            $height
        );
        imagejpeg($thumb, $filename, 80);
    }
    include 'sidebar_nav.php';
    $qr = "SELECT * FROM `category`";
    $res = mysqli_query($conn, $qr);

    if (isset($_POST['add'])) {
        $cat_name = mysqli_escape_string($conn, $_POST['category']);
        if ($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/jpg" || $_FILES["file"]["type"] == "image/png") {
            // echo "<br>file";
            $path = "../photos/" . $_FILES["file"]["name"];
            $cat_img = mysqli_escape_string($conn, $_FILES["file"]['name']);

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $path)) {
                if ($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/jpg") {
                    crop_jpeg($path);
                } else if ($_FILES["file"]["type"] == "image/png") {
                    crop_png($path);
                }
                $insert_qr = "INSERT INTO `category` (`category_name`, `cat_img`) VALUES('$cat_name','$cat_img')";
                $res = mysqli_query($conn, $insert_qr);
                if ($res) {
                    $_FILES["file"]["name"] = "";
                    echo "<script>location.href='category.php'</script>";
                } else {
                    $_FILES["file"]["name"] = "";
                    echo "error occured " . mysqli_error($conn);
                }
            } else {
                echo "file has not uploaded";
            }
        } else {
            echo "upload only image ";
        }
    }
    if (isset($_GET['disable'])) {
        $disable = $_GET['disable'];
        // echo
        $ds_qr = "UPDATE `category` SET `display_status`=0 WHERE `cat_id`=$disable";
        // exit;
        $ds_res = mysqli_query($conn, $ds_qr);
        if ($ds_res) {
            echo "<script>location.href='category.php'</script>";
        } else {
            echo "error occured " . mysqli_error($conn);
        }
    }
    if (isset($_GET['enable'])) {
        $enable = $_GET['enable'];
        // echo
        $es_qr = "UPDATE `category` SET `display_status`=1 WHERE `cat_id`=$enable";
        // exit;
        $es_res = mysqli_query($conn, $es_qr);
        if ($es_res) {
            echo "<script>location.href='category.php'</script>";
        } else {
            echo "error occured " . mysqli_error($conn);
        }
    }
?>
<main>
    <div class="container-fluid text-capitalize">

        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <div class="row">
            <div class="col-12 mb-5">
                <form method="post" enctype="multipart/form-data">
                    <!--------  Update category  -------->
                    <div class="card text-center">
                        <?php
                            if (isset($_GET['edit'])) {
                                $id = $_GET['edit'];
                                $qr2 = "SELECT * FROM `category` WHERE `cat_id`=$id";
                                $res2 = mysqli_query($conn, $qr2);
                                $row2 = mysqli_fetch_assoc($res2);
                                if (isset($_POST['update'])) {
                                    $cat_name = mysqli_escape_string($conn, $_POST['category']);
                                    if ($_FILES["file"]["name"] !== "") {

                                        if ($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/jpg" || $_FILES["file"]["type"] == "image/png") {
                                            $path = "../photos/" . $_FILES["file"]["name"];
                                            $cat_img = mysqli_escape_string($conn, $_FILES["file"]['name']);
                                            if (move_uploaded_file($_FILES["file"]["tmp_name"], $path)) {
                                                $img = mysqli_escape_string($conn, $_FILES["file"]["name"]);
                                                if ($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/jpg") {
                                                    crop_jpeg($path);
                                                } else if ($_FILES["file"]["type"] == "image/png") {
                                                    crop_png($path);
                                                }
                                                // echo
                                                $update_qr = "UPDATE `category` SET `category_name`='$cat_name',`cat_img`='$img' WHERE `cat_id`=$id";
                                                // exit;
                                            }
                                        }
                                    } else {
                                        // echo
                                        $update_qr = "UPDATE `category` SET `category_name`='$cat_name' WHERE `cat_id`=$id";
                                        // exit;
                                    }
                                    $update_res = mysqli_query($conn, $update_qr);
                                    if ($update_res) {
                                        echo "<script>location.href='category.php'</script>";
                                        // echo "updated";
                                    } else {
                                        echo "error occured  " . mysqli_error($conn);
                                    }
                                }
                                $var = 0;
                            ?>
                        <div class="card-header text-white bg-primary">
                            Update Category
                        </div>
                        <div class="card-body">
                            <div class="text-center btn-container">
                                <span id="cat_sp">
                                    <img src="../photos/<?= $row2['cat_img'] ?>" id="cat_img" alt="category image">
                                    <button class="btn btn-success btn-sm" id="img_upd" type="button">Select</button>
                                </span>
                                <input type="file" id="img_product" name="file" accept="image/*" hidden>
                            </div>

                            <div class="form-group row my-3">
                                <div class="col-md-3 col-sm-5 my-auto">
                                    <label for="my-input">Category : </label>
                                </div>
                                <div class="col-md-9 col-sm-7">
                                    <input type="text" id="my-input" class="form-control"
                                        value="<?= $row2['category_name'] ?>" name="category" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary float-right" name="update">Update category</button>
                        </div>
                        <?php
                            } else {
                                $var = 1;
                            ?>
                        <!--------  Add category  --------->
                        <div class="card-header text-white bg-primary">
                            Add new category
                        </div>
                        <div class="card-body">
                            <div class="form-group row my-3">
                                <div class="col-md-3 col-sm-5 my-auto">
                                    <label for="my-input">Category : </label>
                                </div>
                                <div class="col-md-9 col-sm-7">
                                    <input type="text" id="my-input" class="form-control" name="category" required>
                                </div>
                            </div>
                            <div class="form-group row my-3">
                                <div class="col-md-3 col-sm-5 my-auto">
                                    <label for="my-input2">Add Image : </label>
                                </div>
                                <div class="col-md-9 col-sm-7">
                                    <input type="file" id="my-input2" name="file" accept="image/*" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary " name="add">Add Category</button>
                        </div>

                        <?php
                            }
                            ?>
                    </div>



                </form>
                <?php if ($var) {
                    ?>

                <div class="card my-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Category
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-center" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr class="text-capitalize">

                                        <th>Id</th>
                                        <th>Category Name</th>
                                        <th>Image</th>
                                        <th>Edit</th>
                                        <th>Disable</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                                    <tr>
                                        <td><?= $row['cat_id'] ?></td>
                                        <td><?= $row['category_name'] ?></td>
                                        <td><img src="../photos/<?= $row['cat_img'] ?>" alt="category image"
                                                height="50">
                                        </td>
                                        <td><a href="category.php?edit=<?= $row['cat_id'] ?>" class="btn btn-primary"
                                                role="button">Edit</a></td>
                                        <?php
                                                    $ch_qr = "SELECT * FROM `category` WHERE `display_status`=1 AND `cat_id`=$row[cat_id]";
                                                    $ch_res = mysqli_query($conn, $ch_qr);
                                                    $data = mysqli_num_rows($ch_res);
                                                    if ($data == 1) {
                                                    ?>
                                        <td><a href="category.php?disable=<?= $row['cat_id'] ?>" class="btn btn-danger"
                                                role="button">Disable</a></td>
                                        <?php  } else {
                                                    ?>

                                        <td><a href="category.php?enable=<?= $row['cat_id'] ?>" class="btn btn-success"
                                                role="button">Enable</a></td>
                                        <?php

                                                    } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-capitalize">
                                        <th>Id</th>
                                        <th>Category Name</th>
                                        <th>Image</th>
                                        <th>Edit</th>
                                        <th>Disable</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                    } ?>
            </div>
        </div>
    </div>
</main>
<script>
$(document).ready(function() {
    function showImage(src, target) {
        var fr = new FileReader();
        // when image is loaded, set the src of the image where you want to display it
        fr.onload = function(e) {
            target.src = this.result;
        };
        src.addEventListener("change", function() {
            // fill fr with image data    
            fr.readAsDataURL(src.files[0]);
        });
    }
    var src = document.getElementById("img_product");
    var target = document.getElementById("product");
    showImage(src, target);
    $("#img_upd").click(function() {
        $("#img_product").click();
    });
});
</script>
<?php
    include 'footer.php';
} else {
    header('location:login.php');
}