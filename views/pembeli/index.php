<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Pembeli - CarPoint</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/themify-icons/css/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet'>
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
                    <h1>Data Pembeli</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="<?= base_url('index.php?page=admin/dashboard') ?>">Dashboard</a></li>
                        <li class="active">Data Pembeli</li>
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
                            <strong class="card-title">Data Pembeli</strong>
                            <a href="<?= base_url('index.php?page=pembeli/tambah') ?>" class="btn btn-primary btn-sm float-right">
                                <i class="fa fa-plus"></i> Tambah Pembeli
                            </a>
                        </div>
                        <div class="card-body">

                            <?php if (isset($_SESSION['success'])): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa fa-check-circle"></i> <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fa fa-exclamation-circle"></i> <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No. HP</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($pembeli as $p): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($p->NIK) ?></td>
                                        <td><?= htmlspecialchars($p->nama) ?></td>
                                        <td><?= htmlspecialchars($p->alamat) ?></td>
                                        <td><?= htmlspecialchars($p->hp) ?></td>
                                        <td><?= htmlspecialchars($p->email) ?></td>
                                        <td>
                                            <a href="<?= base_url('index.php?page=pembeli/edit&id=' . $p->id_pembeli) ?>" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="<?= base_url('index.php?page=pembeli/hapus&id=' . $p->id_pembeli) ?>" 
                                               class="btn btn-danger btn-sm" title="Hapus"
                                               onclick="return confirm('Yakin hapus data pembeli ini?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/includes/footer.php'; ?>

<script src="<?= base_url('vendors/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?= base_url('vendors/popper.js/dist/umd/popper.min.js') ?>"></script>
<script src="<?= base_url('vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('vendors/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json"
            }
        });
    });
</script>

</body>
</html>