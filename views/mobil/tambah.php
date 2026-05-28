<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tambah Mobil - CarPoint</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        .form-group {
            margin-bottom: 1rem;
        }
        .card-header {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

<?php require_once 'views/includes/header.php'; ?>
<?php require_once 'views/includes/sidebar.php'; ?>

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
                    <h1>Tambah Mobil</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="<?= base_url('index.php?page=admin/dashboard') ?>">Dashboard</a></li>
                        <li><a href="<?= base_url('index.php?page=mobil') ?>">Data Mobil</a></li>
                        <li class="active">Tambah Mobil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong><i class="fa fa-plus-circle"></i> Form Tambah Mobil</strong>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('index.php?page=mobil/simpan') ?>" method="post" enctype="multipart/form-data">
                                
                                <!-- Baris 1: Merk dan Model -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i class="fa fa-car"></i> Merk <span class="text-danger">*</span></label>
                                            <input type="text" name="merk" class="form-control" placeholder="Contoh: Toyota, Honda, Suzuki" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i class="fa fa-tag"></i> Model <span class="text-danger">*</span></label>
                                            <input type="text" name="model" class="form-control" placeholder="Contoh: Avanza, Civic, Ertiga" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 2: Tahun dan Warna -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i class="fa fa-calendar"></i> Tahun <span class="text-danger">*</span></label>
                                            <input type="number" name="tahun" class="form-control" placeholder="Contoh: 2020" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i class="fa fa-paint-brush"></i> Warna <span class="text-danger">*</span></label>
                                            <input type="text" name="warna" class="form-control" placeholder="Contoh: Hitam, Putih, Merah" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 3: Harga dan Plat -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i class="fa fa-money"></i> Harga <span class="text-danger">*</span></label>
                                            <input type="number" name="harga" class="form-control" placeholder="Contoh: 150000000" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i class="fa fa-credit-card"></i> Plat Nomor <span class="text-danger">*</span></label>
                                            <input type="text" name="plat" class="form-control" placeholder="Contoh: B 1234 ABC" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 4: Status -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i class="fa fa-info-circle"></i> Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control" required>
                                                <option value="tersedia">Tersedia</option>
                                                <option value="dipesan">Dipesan</option>
                                                <option value="terjual">Terjual</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i class="fa fa-image"></i> Foto Mobil</label>
                                            <input type="file" name="foto" class="form-control-file" accept="image/jpeg,image/png,image/jpg">
                                            <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <!-- Tombol -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Simpan
                                    </button>
                                    <a href="<?= base_url('index.php?page=mobil') ?>" class="btn btn-secondary">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                    <button type="reset" class="btn btn-danger">
                                        <i class="fa fa-refresh"></i> Reset
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/includes/footer.php'; ?>
</body>
</html>