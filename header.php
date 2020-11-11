<html>

<head>
    <?php include 'bfile.html'; ?>

    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
    <script>
    $(document).ready(function() {
        $("#tot_item").load('count_item.php');

    })
    </script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">Food ordering system</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="menu.php">Menu</a>
                        </li>
                        <?php
                        if (isset($_SESSION['usnm'])) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="track_order.php">Track Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="myorder.php">My order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Cart <span class="badge badge-pill badge-light"
                                    id="tot_item"></span></a>
                        </li>
                        <?php
                        }
                        ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                My Account
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <?php
                                if (isset($_SESSION['usnm'])) {
                                ?>
                                <a class="dropdown-item" href="profile.php">Profile</a>
                                <a class="dropdown-item" href="setting_prof.php">Setting</a>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                                <?php
                                } else {
                                ?>
                                <a class="dropdown-item" class="login" href="login.php">Sign in</a>
                                <a class="dropdown-item" class="signup" href="signup.php">Sign up</a>
                                <?php
                                }
                                ?>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>