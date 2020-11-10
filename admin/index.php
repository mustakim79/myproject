<?php
session_start();
if (isset($_SESSION['admin'])) {
    include 'sidebar_nav.php';
?>
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row text-uppercase">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-header">
                            <h4>Total Orders</h4>
                        </div>
                        <div class="card-body">
                            <h2 id="del_ord"><?php echo $tot_ord == 0 ? "0" : $tot_ord; ?></h2>
                            <small class='text-capitalize'>Total orders</small>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="total_order.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-header">
                            <h4>New Orders</h4>
                        </div>
                        <div class="card-body">
                            <h2><?php echo $new_ord == 0 ? "0" : $new_ord; ?></h2>
                            <small class='text-capitalize'>New orders</small>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-header">
                            <h4>Food Being Prepared</h4>
                        </div>
                        <div class="card-body">
                            <h2><?php echo $proc_ord == 0 ? "0" : $proc_ord; ?></h2>
                            <small class='text-capitalize'>Food Being Prepared</small>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-header">
                            <h4>canceled orders</h4>
                        </div>
                        <div class="card-body">
                            <h2><?php echo $can_ord == 0 ? "0" : $can_ord; ?></h2>
                            <small class='text-capitalize'>canceled orders</small>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-header">
                            <h4>total delivered order</h4>
                        </div>
                        <div class="card-body">
                            <h2 id="tot_ord"><?php echo $del_ord == 0 ? "0" : $del_ord; ?></h2>
                            <small class='text-capitalize'>Total delivered orders</small>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-header">
                            <h4>Total register user</h4>
                        </div>
                        <div class="card-body">
                            <h2 id="del_ord"><?php echo $tot_user == 0 ? "0" : $tot_user; ?></h2>
                            <small class='text-capitalize'>Total register user</small>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area mr-1"></i>
                            Area Chart Example
                        </div>
                        <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar mr-1"></i>
                            Bar Chart Example
                        </div>
                        <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
            </div> -->

        </div>
    </main>
<?php include 'footer.php';
} else {
    header('location:login.php');
}
?>