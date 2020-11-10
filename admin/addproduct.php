<?php
session_start();
if ($_SESSION['admin']) {
    include 'sidebar_nav.php';
    $qr = "SELECT * FROM `category`";
    $res = mysqli_query($conn, $qr);

?>
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="card mb-4 text-capitalize">
                    <div class="card-header bg-primary pt-2 pb-1 text-white text-center">
                        <h6>Add new Product</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-10 offset-md-1  col-md-9 col-sm-8">
                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-5 my-auto">
                                        <label for="f"><b>Upload File :</b></label>
                                    </div>
                                    <div class="col-md-9 col-sm-7">
                                        <input accept="image/*" type="file" id="f" name="file" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-5 my-auto">
                                        <label><b>Product Category:</b></label>
                                    </div>
                                    <div class="col-md-9 col-sm-7">
                                        <select name="category" required class="form-control text-capitalize">
                                            <option value="">SELECT</option>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($res)) {
                                            ?>
                                                <option value=" <?= $row['cat_id'] ?>"><?= $row['category_name'] ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-5 my-auto">
                                        <label for="basic-url"><b>Product Title :</b></label>
                                    </div>
                                    <div class="col-md-9 col-sm-7">
                                        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="food_name" placeholder="Enter name of food" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-5 my-auto">
                                        <label for="basic-url2"><b>Product description:</b></label>
                                    </div>
                                    <div class="col-md-9 col-sm-7">
                                        <input type="text" class="form-control" id="basic-url2" aria-describedby="basic-addon3" name="food_desc" placeholder="Enter food description" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-5 my-auto">
                                        <label for="i4"><b>Product Price :</b></label>
                                    </div>
                                    <div class="col-md-9 col-sm-7">
                                        <input type="number" pattern="[0-9]{1,}" min="50" class="form-control" id="i4" aria-describedby="basic-addon3" name="food_price" placeholder="Enter food price" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" name="sub" value="Upload" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </main>
<?php include 'footer.php';
} else {
    header('location:login.php');
}
?>
</body>

</html>