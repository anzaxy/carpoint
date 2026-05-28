<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>Pemesanan Baru - CarPoint</title>
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

<?php require_once 'views/includes/header.php'; ?>
<?php require_once 'views/includes/sidebar.php'; ?>

<div id="right-panel" class="right-panel">
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Pemesanan Baru</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="<?= base_url('index.php?page=admin/dashboard') ?>">Dashboard</a></li>
                        <li><a href="<?= base_url('index.php?page=pemesanan') ?>">Pemesanan</a></li>
                        <li class="active">Pemesanan Baru</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <strong>Form Pemesanan Mobil</strong>
                    </div>
                    <div class="card-body">
                        
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('index.php?page=pemesanan/simpan') ?>" method="post" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label>Pilih Pembeli</label>
                                <select name="id_pembeli" class="form-control" required>
                                    <option value="">-- Pilih Pembeli --</option>
                                    <?php foreach ($pembeli as $pb): ?>
                                    <option value="<?= $pb->id_pembeli ?>" <?= ($selected_pembeli == $pb->id_pembeli) ? 'selected' : '' ?>>
                                        <?= $pb->nama ?> - <?= $pb->NIK ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <small><a href="<?= base_url('index.php?page=pembeli/tambah') ?>" target="_blank">+ Tambah pembeli baru</a></small>
                            </div>

                            <div class="form-group">
                                <label>Pilih Mobil</label>
                                <select name="id_mobil" id="id_mobil" class="form-control" required>
                                    <option value="">-- Pilih Mobil --</option>
                                    <?php foreach ($mobil as $m): ?>
                                        <?php if ($m->status == 'tersedia'): ?>
                                        <option value="<?= $m->id_mobil ?>" data-harga="<?= $m->harga ?>">
                                            <?= $m->merk ?> <?= $m->model ?> - <?= $m->tahun ?> - Rp <?= number_format($m->harga, 0, ',', '.') ?>
                                        </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div id="infoHarga" style="display:none; background:#f0f9ff; padding:15px; border-radius:8px; margin-bottom:15px;">
                                <strong>Harga Mobil:</strong> Rp <span id="displayHarga">0</span><br>
                                <strong>DP 30%:</strong> Rp <span id="displayDp">0</span>
                            </div>

                            <div class="alert alert-info">
                                <strong>Uang Booking: Rp 500.000</strong> (dibayar sekarang)
                            </div>

                            <div class="form-group">
                                <label>Metode Pembayaran Booking</label>
                                <select name="metode_booking" id="metode_booking" class="form-control" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="cash">Cash / Tunai</option>
                                    <option value="transfer">Transfer Bank</option>
                                </select>
                            </div>

                            <div id="uploadBukti" style="display:none;">
                                <div class="form-group">
                                    <label>Upload Bukti Transfer</label>
                                    <input type="file" name="bukti_booking" class="form-control-file" accept="image/*">
                                </div>
                            </div>

                            <div class="alert alert-warning">
                                <small>⚠️ Batas pembayaran DP: 1 minggu setelah pemesanan. Jika lewat, pesanan batal dan uang booking hangus.</small>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Proses Pemesanan</button>
                            <a href="<?= base_url('index.php?page=pemesanan') ?>" class="btn btn-secondary btn-block">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/includes/footer.php'; ?>

<script>
    $('#id_mobil').change(function() {
        var harga = $(this).find(':selected').data('harga');
        if (harga) {
            $('#displayHarga').text(Number(harga).toLocaleString('id-ID'));
            $('#displayDp').text(Number(harga * 0.3).toLocaleString('id-ID'));
            $('#infoHarga').show();
        } else {
            $('#infoHarga').hide();
        }
    });
    
    $('#metode_booking').change(function() {
        $('#uploadBukti').toggle($(this).val() === 'transfer');
    });
</script>
</body>
</html>