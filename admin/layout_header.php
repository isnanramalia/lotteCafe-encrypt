<?php
$nm_karyawan = $_SESSION['nm_karyawan'];
?>
<!DOCTYPE html>
<html>

<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="../assets/images/cafe/coffee.ico">
    <!-- Bootstrap Core CSS -->
    <link href="../assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="../assets/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="../assets/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="../assets/DataTables/datatables.min.css" />

    <link rel="stylesheet" type="text/css" href="../assets/login/fonts/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="assets/login/css/sb-admin-2.min.css">

</head>

<body class="fix-header">
    <!-- <?php if ($title == 'Dashboard') { ?>
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>
    <?php } ?> -->

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header bg-primary">
                <div class="top-left-part">
                    <a class="logo" href="index.php">
                        <!-- Logo icon image, you can use font-icon also -->
                        <b>
                            <img src="../assets/images/cafe/coffee.svg" alt='image' width="40">
                        </b>
                        <!-- Logo text image you can use text also -->
                        <span class="hidden-xs text-dark">
                            Lottie café
                        </span>
                    </a>
                </div>

                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <!-- <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg" href="javascript:void(0)"><i class="fa fa-bars"></i></a> -->
                    </li>
                    <li>
                        <a class="profile-pic">
                            <b><?= $nm_karyawan; ?></b>
                            <img src="../assets/images/user/user.svg" alt="avatar" width="36" class="img-circle">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                        <a href="index.php" class="waves-effect 
                        <?php if ($title == 'Dashboard') {
                            echo 'active';
                        } ?>">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="transaksi.php" class="waves-effect 
                        <?php if ($title == 'Transaksi') {
                            echo 'active';
                        } ?>">
                            <i class="fas fa-file-invoice"></i> Transaksi
                        </a>
                    </li>
                    <li>
                        <a href="menu.php" class="waves-effect 
                        <?php if ($title == 'Menu') {
                            echo 'active';
                        } ?>">
                            <i class="fas fa-book-open"></i> Menu
                        </a>
                    </li>
                    <li>
                        <a href="karyawan.php" class="waves-effect 
                        <?php if ($title == 'Karyawan') {
                            echo 'active';
                        } ?>">
                            <i class="fas fa-user"></i> Karyawan
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <a href="" data-toggle="modal" data-target="#logoutModal" class="text-dark p-20">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>

        <div id="page-wrapper">