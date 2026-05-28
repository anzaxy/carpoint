<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Pembeli - CarPoint</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
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
                    <h1>Edit Pembeli</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="<?= base_url('index.php?page=admin/dashboard') ?>">Dashboard</a></li>
                        <li><a href="<?= base_url('index.php?page=pembeli') ?>">Data Pembeli</a></li>
                        <li class="active">Edit Pembeli</li>
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
                            <strong>Form Edit Pembeli</strong>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('index.php?page=pembeli/update') ?>" method="post">
                                <input type="hidden" name="id" value="<?= $pembeli->id_pembeli ?>">
                                
                                <div class="form-group">
                                    <label>NIK <span class="text-danger">*</span></label>
                                    <input type="text" name="nik" class="form-control" value="<?= $pembeli->NIK ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control" value="<?= $pembeli->nama ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat <span class="text-danger">*</span></label>
                                    <textarea name="alamat" class="form-control" rows="3" required><?= $pembeli->alamat ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>No. HP <span class="text-danger">*</span></label>
                                    <input type="text" name="hp" class="form-control" value="<?= $pembeli->hp ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?= $pembeli->email ?>">
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Update
                                </button>
                                <a href="<?= base_url('index.php?page=pembeli') ?>" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left"></i> Kembali
                                </a>
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