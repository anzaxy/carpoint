<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>Bayar Pelunasan - CarPoint</title>
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>">
</head>
<body>

<?php require_once 'views/includes/header.php'; ?>
<?php require_once 'views/includes/sidebar.php'; ?>

<div id="right-panel" class="right-panel">
    <div class="content mt-3">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header"><strong>Bayar Pelunasan</strong></div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong>Pemesanan #<?= $pemesanan->id_pesan ?></strong><br>
                            Pembeli: <?= $pemesanan->nama_pembeli ?><br>
                            Mobil: <?= $pemesanan->merk ?> <?= $pemesanan->model ?><br>
                            Harga: Rp <?= number_format($pemesanan->harga, 0, ',', '.') ?><br>
                            DP Dibayar: Rp <?= number_format($pemesanan->harga * 0.3, 0, ',', '.') ?><br>
                            <hr>
                            <h4>Sisa Pelunasan: Rp <?= number_format($pemesanan->harga * 0.7, 0, ',', '.') ?></h4>
                        </div>

                        <form action="<?= base_url('index.php?page=penjualan/proses-bayar-pelunasan') ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_pesan" value="<?= $pemesanan->id_pesan ?>">
                            <div class="form-group">
                                <label>Metode Pembayaran <span class="text-danger">*</span></label>
                                <select name="metode" id="metode" class="form-control" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="cash">Cash / Tunai</option>
                                    <option value="transfer">Transfer Bank</option>
                                </select>
                            </div>
                            <div class="form-group" id="uploadBukti" style="display:none">
                                <label>Upload Bukti Transfer <span class="text-danger">*</span></label>
                                <input type="file" name="bukti" class="form-control-file" accept="image/*">
                            </div>
                            <div id="alertWarning" class="alert alert-danger" style="display:none">Bukti transfer wajib diupload!</div>
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check"></i> Bayar Pelunasan</button>
                            <a href="<?= base_url('index.php?page=penjualan') ?>" class="btn btn-secondary btn-block">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/includes/footer.php'; ?>
<script>
$('#metode').change(function() {
    $('#uploadBukti').toggle($(this).val() === 'transfer');
});
$('form').on('submit', function(e) {
    if ($('#metode').val() === 'transfer' && $('input[name=bukti]').val() === '') {
        e.preventDefault();
        $('#alertWarning').show();
        return false;
    }
});
</script>
</body>
</html>