<?php
$title = 'Dashboard Owner';
$active_menu = 'dashboard';
require_once 'views/includes/header.php';
?>

<!-- Sidebar khusus Owner -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="<?= base_url('index.php?page=owner/dashboard') ?>">
                <img src="<?= base_url('images/logo.png') ?>" alt="Logo">
            </a>
        </div>
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="<?= base_url('index.php?page=owner/dashboard') ?>"> 
                        <i class="menu-icon fa fa-dashboard"></i> Dashboard 
                    </a>
                </li>
                <h3 class="menu-title">Laporan</h3>
                <li>
                    <a href="<?= base_url('index.php?page=owner/laporan&sub=penjualan') ?>"> 
                        <i class="menu-icon fa fa-line-chart"></i> Laporan Penjualan
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('index.php?page=owner/laporan&sub=pembelian') ?>"> 
                        <i class="menu-icon fa fa-exchange"></i> Laporan Pembelian
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('index.php?page=owner/laporan&sub=stok') ?>"> 
                        <i class="menu-icon fa fa-car"></i> Laporan Stok
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('logout') ?>"> 
                        <i class="menu-icon fa fa-power-off"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</aside>

<div id="right-panel" class="right-panel">
    <header id="header" class="header">
        <div class="header-menu">
            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            </div>
            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img class="user-avatar rounded-circle" src="<?= base_url('images/admin.jpg') ?>" alt="User Avatar">
                    </a>
                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="<?= site_url('logout') ?>"><i class="fa fa-power-off"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard Owner</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="col-sm-12">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                Selamat datang, <strong><?= $_SESSION['nama'] ?? $_SESSION['username'] ?></strong>! Anda login sebagai <?= $_SESSION['role'] ?>.
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/includes/footer.php'; ?>