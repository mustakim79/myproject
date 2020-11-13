<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <script type="text/javascript">
    function chk() {
        alert("The food has been added");
        window.location.href = "addproduct.php";
    }

    function vali() {
        alert('Upload only image');
        window.location.href = 'addproduct.php';

    }
    </script>

</body>

</html>
<?php
include 'php_files/config.php';
session_start();

if ($_SESSION['admin']) {
	if (isset($_POST['sub'])) {
		// echo $_FILES["file"]['type'] . "<br>";
		if ($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/jpg" || $_FILES["file"]["type"] == "image/png") {
			// echo "<br>file";
			$path = "../photos/" . $_FILES["file"]["name"];

			if (move_uploaded_file($_FILES["file"]["tmp_name"], $path)) {
				// echo "<br>sub";
				// Image Crop Code
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
				if ($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/jpg") {
					crop_jpeg($path);
				} else if ($_FILES["file"]["type"] == "image/png") {
					crop_png($path);
				}
				$fnm = $_FILES["file"]["name"];
				$food_name = mysqli_escape_string($conn, $_POST['food_name']);
				$food_desc = mysqli_escape_string($conn, $_POST['food_desc']);
				$food_price = mysqli_escape_string($conn, $_POST['food_price']);
				$cat = mysqli_escape_string($conn, $_POST['category']);
				// echo
				$qr = "INSERT INTO `food` () VALUES('$fnm','$food_name','$food_desc','$food_price',$cat)";
				// exit();
				$res = mysqli_query($conn, $qr);
				if ($res) {
					echo "<script>chk()</script>";
				} else {
					echo mysqli_error($conn);
				}
			}
		} else {

			echo mysqli_error($conn);
			// echo "<script>vali()</script>";
			echo "upload only image";
		}
	}
} else {
	header('location:login.php');
}
?>
