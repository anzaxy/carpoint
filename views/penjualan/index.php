<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>Transaksi Penjualan - CarPoint</title>
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        .card-pesan {
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 25px;
            background: white;
            transition: transform 0.3s;
        }
        .card-pesan:hover { transform: translateY(-5px); }
        .card-header-custom { background: #f8f9fa; padding: 12px 15px; border-bottom: 2px solid #20a8d8; border-radius: 12px 12px 0 0; }
        .status { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; }
        .status-booking_dibayar { background: #17a2b8; color: white; }
        .status-dp_lunas { background: #28a745; color: white; }
        .btn-group-card { display: flex; gap: 8px; margin-top: 10px; }
        .btn-group-card .btn { flex: 1; font-size: 12px; }
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
        <div class="col-sm-4"><div class="page-header float-left"><div class="page-title"><h1>Transaksi Penjualan</h1></div></div></div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="<?= base_url('index.php?page=admin/dashboard') ?>">Dashboard</a></li>
                        <li class="active">Transaksi Penjualan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($pesananAktif as $p): ?>
            <div class="col-md-4">
                <div class="card-pesan">
                    <div class="card-header-custom">
                        <strong>#<?= $p->id_pesan ?></strong>
                        <span class="float-right"><?= date('d/m/Y', strtotime($p->tgl_psn)) ?></span>
                    </div>
                    <div class="card-body">
                        <p><strong><i class="fa fa-user"></i> <?= htmlspecialchars($p->nama_pembeli) ?></strong></p>
                        <p><i class="fa fa-car"></i> <?= $p->merk ?> <?= $p->model ?> (<?= $p->tahun ?>)</p>
                        <p><i class="fa fa-money"></i> <strong>Rp <?= number_format($p->harga, 0, ',', '.') ?></strong></p>
                        <p><i class="fa fa-clock-o"></i> Batas DP: <?= date('d/m/Y', strtotime($p->batas)) ?>
                        <?php if (strtotime($p->batas) < time() && $p->status_psn == 'booking_dibayar'): ?>
                            <span class="text-danger">(Kadaluarsa!)</span>
                        <?php endif; ?>
                        </p>
                        <p><span class="status status-<?= $p->status_psn ?>">
                            <?= $p->status_psn == 'booking_dibayar' ? 'Menunggu DP 30%' : 'Menunggu Pelunasan' ?>
                        </span></p>
                        <div class="btn-group-card">
                            <?php if ($p->status_psn == 'booking_dibayar'): ?>
                                <a href="<?= base_url('index.php?page=penjualan/bayar-dp&id=' . $p->id_pesan) ?>" class="btn btn-warning btn-sm">
                                    <i class="fa fa-credit-card"></i> Bayar DP 30%
                                </a>
                            <?php elseif ($p->status_psn == 'dp_lunas'): ?>
                                <a href="<?= base_url('index.php?page=penjualan/bayar-pelunasan&id=' . $p->id_pesan) ?>" class="btn btn-success btn-sm">
                                    <i class="fa fa-money"></i> Bayar Pelunasan
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
            <?php if (count($pesananAktif) == 0): ?>
            <div class="col-md-12">
                <div class="alert alert-info">Tidak ada pesanan aktif. Silakan buat pemesanan baru terlebih dahulu.</div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once 'views/includes/footer.php'; ?>
</body>
</html>