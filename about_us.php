<?php
session_start();
include 'header.php';
?>
<main>
    <div class="container">
        <h1 class="text-center my-3"><b>About Us</b></h1>
        <div class="card-deck my-3">
            <div class="card shadow">
                <img src="photos/chef1.jpg" style="object-fit:cover;    height: 210px;object-position: top;"
                    class="card-img-top" alt="..." style="height:150px;">
                <div class="card-body text-center">
                    <h5>Chef</h5><br>
                    <b>
                        <h3>Edward Robinson</h3>
                    </b>
                </div>
            </div>
            <div class="card shadow">
                <img src="photos/chef woman.jpg" style="object-fit:cover;height: 210px;object-position: top;"
                    class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <h5>Chef</h5><br>
                    <b>
                        <h3>Amanda Stark</h3>
                    </b>
                </div>
            </div>
            <div class="card shadow">
                <img src="photos/chef3.jpg" style="object-fit:cover;    height: 210px;object-position: top;" alt="..."
                    class="card-img-top">
                <div class="card-body text-center">
                    <h5>Chef</h5><br>
                    <b>
                        <h3>Ryan Ricks</h3>
                    </b>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include 'footer.php';
?>