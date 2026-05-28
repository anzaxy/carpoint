<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>Bayar DP - CarPoint</title>
    <link rel="stylesheet" href="<?= base_url('vendors/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('vendors/font-awesome/css/font-awesome.min.css') ?>">
    <style>
        .card { border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
        .card-header { background: #20a8d8; color: white; border-radius: 12px 12px 0 0; }
    </style>
</head>
<body>

<?php require_once 'views/includes/header.php'; ?>
<?php require_once 'views/includes/sidebar.php'; ?>

<div id="right-panel" class="right-panel">
    <div class="content mt-3">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <strong><i class="fa fa-credit-card"></i> Bayar DP 30%</strong>
                    </div>
                    <div class="card-body">
                        
                        <?php if (!isset($pemesanan)): ?>
                            <div class="alert alert-danger">Data pemesanan tidak ditemukan!</div>
                            <a href="<?= base_url('index.php?page=penjualan') ?>" class="btn btn-secondary btn-block">Kembali</a>
                        <?php else: ?>
                        
                        <div class="alert alert-info">
                            <strong>Pemesanan #<?= $pemesanan->id_pesan ?></strong><br>
                            Pembeli: <?= $pemesanan->nama_pembeli ?><br>
                            Mobil: <?= $pemesanan->merk ?> <?= $pemesanan->model ?><br>
                            Harga: Rp <?= number_format($pemesanan->harga, 0, ',', '.') ?><br>
                            <hr>
                            <h4>DP 30%: Rp <?= number_format($pemesanan->harga * 0.3, 0, ',', '.') ?></h4>
                            Batas waktu: <strong class="text-danger"><?= date('d/m/Y', strtotime($pemesanan->batas)) ?></strong>
                        </div>

                        <form action="<?= base_url('index.php?page=penjualan/proses-bayar-dp') ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_pesan" value="<?= $pemesanan->id_pesan ?>">
                            
                            <div class="form-group">
                                <label>Metode Pembayaran <span class="text-danger">*</span></label>
                                <select name="metode" id="metode" class="form-control" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="cash">Cash / Tunai</option>
                                    <option value="transfer">Transfer Bank</option>
                                </select>
                            </div>

                            <div class="form-group" id="uploadBukti" style="display: none;">
                                <label>Upload Bukti Transfer <span class="text-danger">*</span></label>
                                <input type="file" name="bukti" class="form-control-file" accept="image/*">
                                <small class="text-muted">Upload bukti transfer (foto/scan struk)</small>
                            </div>

                            <div class="form-group">
                                <label>Upload Fotocopy KTP <span class="text-danger">*</span></label>
                                <input type="file" name="ktp" class="form-control-file" accept="image/*" required>
                                <small class="text-muted">Upload foto/scan KTP pembeli</small>
                            </div>

                            <div id="alertWarning" class="alert alert-danger" style="display: none;">
                                <i class="fa fa-warning"></i> Bukti transfer wajib diupload!
                            </div>

                            <hr>
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fa fa-check"></i> Bayar DP Sekarang
                            </button>
                            <a href="<?= base_url('index.php?page=penjualan') ?>" class="btn btn-secondary btn-block">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </form>
                        
                        <?php endif; ?>
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
    $('#metode').change(function() {
        if ($(this).val() === 'transfer') {
            $('#uploadBukti').show();
        } else {
            $('#uploadBukti').hide();
        }
        $('#alertWarning').hide();
    });
    
    $('form').on('submit', function(e) {
        if ($('#metode').val() === 'transfer') {
            var bukti = $('input[name=bukti]').val();
            if (bukti === '') {
                e.preventDefault();
                $('#alertWarning').show();
                return false;
            }
        }
        
        var ktp = $('input[name=ktp]').val();
        if (ktp === '') {
            e.preventDefault();
            alert('Upload KTP wajib diisi!');
            return false;
        }
        
        return true;
    });
});
</script>
</body>
</html>