<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>Pengiriman Mobil - CarPoint</title>
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        .card-pengiriman {
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 25px;
            background: white;
            transition: transform 0.3s;
        }
        .card-pengiriman:hover { transform: translateY(-5px); }
        .card-header-custom { background: #f8f9fa; padding: 12px 15px; border-bottom: 2px solid #28a745; border-radius: 12px 12px 0 0; }
        .btn-group-card { display: flex; gap: 8px; margin-top: 15px; }
        .btn-group-card .btn { flex: 1; font-size: 12px; }
        .info-status { background: #e8f5e9; padding: 10px; border-radius: 8px; margin-top: 10px; }
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
                    <h1>Pengiriman Mobil</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <div class="row">
            <?php if (isset($penjualan) && count($penjualan) > 0): ?>
                <?php foreach ($penjualan as $p): ?>
                <div class="col-md-4">
                    <div class="card-pengiriman">
                        <div class="card-header-custom">
                            <strong><i class="fa fa-truck"></i> <?= isset($p->no_faktur) ? $p->no_faktur : '-' ?></strong>
                        </div>
                        <div class="card-body">
                            <p><strong><i class="fa fa-user"></i> <?= isset($p->nama_pembeli) ? $p->nama_pembeli : '-' ?></strong></p>
                            <p><i class="fa fa-car"></i> <?= isset($p->merk) ? $p->merk : '-' ?> <?= isset($p->model) ? $p->model : '-' ?></p>
                            <p><i class="fa fa-credit-card"></i> Plat: <?= isset($p->plat) ? $p->plat : '-' ?></p>
                            
                            <?php if (!isset($p->id_pengiriman) || !$p->id_pengiriman): ?>
                            <form action="<?= base_url('index.php?page=pengiriman/proses&id=' . ($p->id_pj_mobil ?? 0)) ?>" method="post">
                                <div class="form-group">
                                    <select name="jenis" class="form-control" required>
                                        <option value="">-- Pilih Opsi Pengiriman --</option>
                                        <option value="diambil">Ambil ke Showroom</option>
                                        <option value="diantar">Diantar ke Rumah</option>
                                    </select>
                                </div>
                                <div class="alamatGroup" style="display:none;">
                                    <div class="form-group mt-2">
                                        <label>Alamat Tujuan</label>
                                        <textarea name="alamat" class="form-control" rows="2" placeholder="Masukkan alamat lengkap"><?= isset($p->alamat_pembeli) ? $p->alamat_pembeli : '' ?></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fa fa-check"></i> Proses Pengiriman
                                </button>
                            </form>
                            <?php else: ?>
                                <div class="info-status">
                                    <i class="fa fa-info-circle"></i> 
                                    <strong>Opsi:</strong> <?= (isset($p->jenis_pengiriman) && $p->jenis_pengiriman == 'diantar') ? 'Diantar ke Rumah' : 'Ambil ke Showroom' ?><br>
                                    <?php if (isset($p->jenis_pengiriman) && $p->jenis_pengiriman == 'diantar' && isset($p->alamat_tujuan)): ?>
                                    <i class="fa fa-map-marker"></i> <strong>Alamat:</strong> <?= $p->alamat_tujuan ?>
                                    <?php endif; ?>
                                </div>
                                <div class="btn-group-card">
                                    <?php if (isset($p->jenis_pengiriman) && $p->jenis_pengiriman == 'diantar'): ?>
                                    <a href="<?= base_url('index.php?page=pengiriman/cetak-surat-jalan&id=' . $p->id_pengiriman) ?>" class="btn btn-secondary btn-sm" target="_blank">
                                        <i class="fa fa-print"></i> Cetak Surat Jalan
                                    </a>
                                    <?php endif; ?>
                                    <button class="btn btn-success btn-sm" disabled>
                                        <i class="fa fa-check"></i> Selesai
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-md-12">
                    <div class="alert alert-info">Tidak ada penjualan yang siap dikirim.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once 'views/includes/footer.php'; ?>

<script src="<?= base_url('vendors/jquery/dist/jquery.min.js') ?>"></script>
<script>
$(document).ready(function() {
    $('select[name=jenis]').change(function() {
        var alamatGroup = $(this).closest('form').find('.alamatGroup');
        if ($(this).val() === 'diantar') {
            alamatGroup.show();
        } else {
            alamatGroup.hide();
        }
    });
});
</script>
</body>
</html>