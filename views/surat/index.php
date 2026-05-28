<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>Pengurusan Surat - CarPoint</title>
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        .card-surat {
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 25px;
            background: white;
            transition: transform 0.3s;
        }
        .card-surat:hover { transform: translateY(-5px); }
        .card-header-custom { background: #f8f9fa; padding: 12px 15px; border-bottom: 2px solid #20a8d8; border-radius: 12px 12px 0 0; }
        .status-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; }
        .status-dp_lunas { background: #ffc107; color: #333; }
        .status-proses_stnk { background: #17a2b8; color: white; }
        .status-proses_bpkb { background: #fd7e14; color: white; }
        .status-lunas { background: #28a745; color: white; }
        .btn-group-card { display: flex; gap: 8px; margin-top: 15px; }
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
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Pengurusan Surat (STNK & BPKB)</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ($penjualan as $p): ?>
            <div class="col-md-4">
                <div class="card-surat">
                    <div class="card-header-custom">
                        <strong><i class="fa fa-file-text"></i> <?= $p->no_faktur ?></strong>
                    </div>
                    <div class="card-body">
                        <p><strong><i class="fa fa-user"></i> <?= $p->nama_pembeli ?></strong></p>
                        <p><i class="fa fa-car"></i> <?= $p->merk ?> <?= $p->model ?></p>
                        <p><i class="fa fa-money"></i> Rp <?= number_format($p->harga_jual, 0, ',', '.') ?></p>
                        <p>
                            <span class="status-badge status-<?= $p->status_penjualan ?>">
                                <?php if ($p->status_penjualan == 'dp_lunas'): ?>
                                    <i class="fa fa-clock-o"></i> Menunggu STNK
                                <?php elseif ($p->status_penjualan == 'proses_stnk'): ?>
                                    <i class="fa fa-spinner"></i> Proses STNK
                                <?php elseif ($p->status_penjualan == 'proses_bpkb'): ?>
                                    <i class="fa fa-spinner"></i> Proses BPKB
                                <?php else: ?>
                                    <i class="fa fa-check"></i> Selesai
                                <?php endif; ?>
                            </span>
                        </p>
                        <div class="btn-group-card">
                            <?php if ($p->status_penjualan == 'dp_lunas'): ?>
                                <a href="<?= base_url('index.php?page=surat/proses&id=' . $p->id_pj_mobil . '&jenis=stnk') ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-file"></i> Urus STNK
                                </a>
                            <?php elseif ($p->status_penjualan == 'proses_stnk'): ?>
                                <button class="btn btn-secondary btn-sm" disabled><i class="fa fa-spinner"></i> STNK Diproses</button>
                                <a href="<?= base_url('index.php?page=surat/proses&id=' . $p->id_pj_mobil . '&jenis=bpkb') ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-file"></i> Urus BPKB
                                </a>
                            <?php elseif ($p->status_penjualan == 'proses_bpkb'): ?>
                                <button class="btn btn-secondary btn-sm" disabled><i class="fa fa-spinner"></i> BPKB Diproses</button>
                            <?php else: ?>
                                <button class="btn btn-success btn-sm" disabled><i class="fa fa-check"></i> Selesai</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
            <?php if (count($penjualan) == 0): ?>
            <div class="col-md-12">
                <div class="alert alert-info">Tidak ada penjualan yang memerlukan pengurusan surat.</div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once 'views/includes/footer.php'; ?>
</body>
</html>