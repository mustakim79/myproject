<?php
include 'php_files/config.php';
session_start();
if (isset($_SESSION['admin'])) {
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        include 'sidebar_nav.php';
        // echo
        $qr = "SELECT * FROM `food` INNER JOIN `category` ON `food`.`category_id`=`category`.`cat_id` WHERE `food_id`=$id AND `food`.`display_status`=1";
        // exit;
        $res = mysqli_query($conn, $qr);
        $row = mysqli_fetch_assoc($res);
        // print_r($row);
        $cat_qr = "SELECT * FROM `category`";
        $cat_res = mysqli_query($conn, $cat_qr);
        if (isset($_POST['update']) && sizeof($_POST) > 0) {
            $cat_id = $_POST['category'];
            $name = mysqli_escape_string($conn, $_POST['title']);
            $descr = mysqli_escape_string($conn, $_POST['descr']);
            $rs = $_POST['price'];
            if ($_FILES["file"]["name"] !== "") {

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
                if ($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/jpg" || $_FILES["file"]["type"] == "image/png") {
                    // echo "<br>file";

                    $path = "../photos/" . $_FILES["file"]["name"];

                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $path)) {
                        if ($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/jpg") {
                            crop_jpeg($path);
                        } else if ($_FILES["file"]["type"] == "image/png") {
                            crop_png($path);
                        }
                        // echo "<br>sub";
                        // Image Crop Code
                        $img = mysqli_escape_string($conn, $_FILES['file']['name']);
                        $update_qr = "UPDATE `food` SET `food_img`='$img',`food_name`='$name',`food_descript`='$descr',`food_rs`='$rs',`category_id`=$cat_id WHERE `food_id`=$id";
                    } else {
                        echo "<script>alert('File could not be uploaded');location.href='manage_product.php';</script>";
                    }
                } else {
                    echo "<script>alert('upload only jpeg,jpg or png');location.href='manage_product.php'</script>";
                }
            } else {
                $update_qr = "UPDATE `food` SET `food_name`='$name',`food_descript`='$descr',`food_rs`='$rs',`category_id`=$cat_id WHERE `food_id`=$id";
            }
            $upd_res = mysqli_query($conn, $update_qr);
            if ($upd_res) {
                echo "<script>location.href='manage_product.php'</script>";
            } else {
                echo "error occured " . mysqli_error($conn);
            }
        }

?>
<main class="container text-capitalize">
    <div class="row">
        <form method="post" enctype="multipart/form-data">
            <div class="col-12 pt-4">
                <div class="card">
                    <div class="card-header bg-primary pt-2 pb-1 text-white">
                        <h6 style="padding: 0%;">Edit Product</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-4">
                                <div class="btn-container">
                                    <img src="../photos/<?= $row['food_img'] ?>" class="w-100" id="product"
                                        alt="Image could not load">
                                </div>
                            </div>
                            <div class="col-lg-10  col-md-9 col-sm-8">
                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-5 my-auto">
                                        <label><b>Product Category :</b></label>
                                    </div>
                                    <div class="col-md-9 col-sm-7 ">
                                        <select name="category" class="form-control text-capitalize" required>
                                            <option value="">SELECT</option>
                                            <?php $i = 1;
                                                    while ($cat_row = mysqli_fetch_assoc($cat_res)) { ?>
                                            <option class="text-capitalize" value="<?= $cat_row['cat_id'] ?>"
                                                <?php echo $i == 1 ? "selected" :  ""; ?>>
                                                <?= $cat_row['category_name'] ?></option>
                                            <?php
                                                        $i++;
                                                    } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-5 my-auto">
                                        <label><b>Product Title :</b></label>
                                    </div>
                                    <div class="col-md-9 col-sm-7">
                                        <input type="text" name="title" class="form-control"
                                            value="<?= $row['food_name'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-5 my-auto">
                                        <label><b>Change Image :</b></label>
                                    </div>
                                    <div class="col-md-9 col-sm-7">
                                        <input type="file" id="img_product" name="file" accept="image/*">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-5 my-auto">
                                        <label><b>Description :</b></label>
                                    </div>
                                    <div class="col-md-9 col-sm-7">
                                        <input type="text" name="descr" class="form-control"
                                            value="<?= $row['food_descript'] ?>" placeholder="Description">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-5 my-auto">
                                        <label><b>Price :</b></label>
                                    </div>
                                    <div class="col-md-9 col-sm-7">
                                        <input type="number" name="price" step="5" min="50" class="form-control"
                                            value="<?= $row['food_rs'] ?>" placeholder="Price">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary btn-sm float-right" name="update"
                            value="Update Product">
                    </div>
                </div>
            </div>
        </form>
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
        header('location:manage_product.php');
    }
} else {
    header('location:login.php');
}