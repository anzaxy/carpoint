<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tambah Pembeli - CarPoint</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        .card-header-custom {
            background: linear-gradient(135deg, #20a8d8, #1985ac);
            color: white;
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
                    <h1>Tambah Pembeli</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="<?= base_url('index.php?page=admin/dashboard') ?>">Dashboard</a></li>
                        <li><a href="<?= base_url('index.php?page=pembeli') ?>">Data Pembeli</a></li>
                        <li class="active">Tambah Pembeli</li>
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
                        <div class="card-header card-header-custom">
                            <strong><i class="fa fa-plus-circle"></i> Form Tambah Pembeli</strong>
                        </div>
                        <div class="card-body">
                            
                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <i class="fa fa-exclamation-circle"></i> <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url('index.php?page=pembeli/simpan') ?>" method="post" id="formPembeli">
                                <div class="form-group">
                                    <label>NIK <span class="text-danger">*</span></label>
                                    <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat <span class="text-danger">*</span></label>
                                    <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Masukkan alamat" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>No. HP <span class="text-danger">*</span></label>
                                    <input type="text" name="hp" id="hp" class="form-control" placeholder="Masukkan nomor telepon" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email (opsional)">
                                </div>
                                <hr>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" name="action" value="simpan" class="btn btn-primary btn-block">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" name="action" value="pesan" class="btn btn-success btn-block">
                                            <i class="fa fa-shopping-cart"></i> Simpan & Lanjut Pemesanan
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <a href="<?= base_url('index.php?page=pembeli') ?>" class="btn btn-secondary btn-block">
                                            <i class="fa fa-arrow-left"></i> Kembali
                                        </a>
                                    </div>
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

<script src="<?= base_url('vendors/jquery/dist/jquery.min.js') ?>"></script>
<script>
$(document).ready(function() {
    $('#formPembeli').on('submit', function(e) {
        if ($('#nik').val() === '') {
            e.preventDefault();
            alert('NIK wajib diisi!');
            return false;
        }
        if ($('#nama').val() === '') {
            e.preventDefault();
            alert('Nama wajib diisi!');
            return false;
        }
        if ($('#alamat').val() === '') {
            e.preventDefault();
            alert('Alamat wajib diisi!');
            return false;
        }
        if ($('#hp').val() === '') {
            e.preventDefault();
            alert('No HP wajib diisi!');
            return false;
        }
        return true;
    });
});
</script>
</body>
</html>