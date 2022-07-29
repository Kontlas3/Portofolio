<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">

</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown nav-link-lg nav-link-user">
                            <div class="d-sm-none d-lg-inline-block">Hi , <?= $_SESSION['nama_user']; ?></div>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.php">Dukcapil Kab. Luwu</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.php">DKL</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="nav-item dropdown active">
                            <a href="index.php" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
                        </li>
                        <li class="menu-header">Starter</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Master Data</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="akta.php">Data Akta Kelahiran</a></li>
                                <li><a class="nav-link" href="pernikahan.php">Data Akta Pernikahan</a></li>
                                <li><a class="nav-link" href="kematian.php">Data Akta Kematian</a></li>
                                <li><a class="nav-link" href="pengeluaran.php">Data Pengeluaran <?= date('Y'); ?></a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="user.php" class="nav-link"><i class="fas fa-user"></i><span>User</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="team.php" class="nav-link"><i class="fas fa-user-friends"></i><span>Team</span></a>
                        </li>
                        <?php if ($_SESSION['level'] != 3) : ?>
                            <li class="nav-item">
                                <a href="panduan.php" class="nav-link"><i class="fas fa-book"></i><span>Panduan Aplikasi</span></a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="aplikasi.php" class="nav-link"><i class="fas fa-rocket"></i><span>Tentang Aplikasi</span></a>
                        </li>
                        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                            <a href="logout.php" class="btn btn-primary btn-block btn-icon-split">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                </aside>
            </div>