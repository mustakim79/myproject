<?php
session_start();
include 'config.php';
include 'header.php';
$qr = "SELECT * FROM `category` WHERE `display_status`=1";
$res = mysqli_query($conn, $qr);

?>
<main class="container-fluid">
    <div class="mn">
        <div class="fm">
            <form class="" id="fm" method="post" action="search.php">
                <p style="color:black"><b>Find your favourite delicious hot food!</b></p>
                <input type="text" class="form-control " id="formGroupExampleInput" name="tsch"
                    placeholder="I want to eat..." />
                <input type="submit" name="bsch" value="search" class="btn btn-primary mt-2" />
            </form>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 my-5">
        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <img src="photos/<?= $row['cat_img'] ?>" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <h5 class="card-title"><?= $row['category_name'] ?></h5>
                </div>
                <div class="card-footer text-center">
                    <a href="index.php?cat_id=<?= $row['cat_id'] ?>" class="btn btn-primary">
                        Click Me
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</main>
<?php
include 'footer.php';

?>