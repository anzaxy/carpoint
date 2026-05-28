<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <title>Bayar DP - CarPoint</title>
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
                    <div class="card-header"><strong>Bayar DP 30%</strong></div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong>Pemesanan #<?= $pemesanan->id_pesan ?></strong><br>
                            Pembeli: <?= $pemesanan->nama_pembeli ?><br>
                            Mobil: <?= $pemesanan->merk ?> <?= $pemesanan->model ?><br>
                            Harga: Rp <?= number_format($pemesanan->harga, 0, ',', '.') ?><br>
                            <hr>
                            <h4>DP 30%: Rp <?= number_format($pemesanan->harga * 0.3, 0, ',', '.') ?></h4>
                            Batas waktu: <strong class="text-danger"><?= date('d/m/Y', strtotime($pemesanan->batas)) ?></strong>
                        </div>

                        <form id="formBayarDp" action="<?= base_url('index.php?page=pemesanan/proses-bayar-dp') ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_pesan" value="<?= $pemesanan->id_pesan ?>">
                            
                            <div class="form-group">
                                <label>Metode Pembayaran <span class="text-danger">*</span></label>
                                <select name="metode_dp" id="metode_dp" class="form-control" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="cash">Cash / Tunai</option>
                                    <option value="transfer">Transfer Bank</option>
                                </select>
                            </div>

                            <div class="form-group" id="uploadBukti" style="display: none;">
                                <label>Upload Bukti Transfer <span class="text-danger">*</span></label>
                                <input type="file" name="bukti_dp" id="bukti_dp" class="form-control-file" accept="image/jpeg,image/png,image/jpg">
                                <small class="text-muted">Upload bukti transfer (foto/scan struk). Wajib diisi jika pilih Transfer.</small>
                            </div>

                            <div id="alertWarning" class="alert alert-danger" style="display: none;">
                                <i class="fa fa-warning"></i> Bukti transfer wajib diupload!
                            </div>

                            <button type="submit" id="btnSubmit" class="btn btn-success btn-block">
                                <i class="fa fa-check"></i> Bayar DP Sekarang
                            </button>
                            <a href="<?= base_url('index.php?page=pemesanan') ?>" class="btn btn-secondary btn-block">Kembali</a>
                        </form>
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
    // Tampilkan/sembunyikan upload bukti
    $('#metode_dp').change(function() {
        if ($(this).val() === 'transfer') {
            $('#uploadBukti').show();
            $('#bukti_dp').prop('required', true);
        } else {
            $('#uploadBukti').hide();
            $('#bukti_dp').prop('required', false);
        }
        $('#alertWarning').hide();
    });
    
    // Validasi sebelum submit
    $('#formBayarDp').on('submit', function(e) {
        if ($('#metode_dp').val() === 'transfer') {
            var bukti = $('#bukti_dp').val();
            if (bukti === '') {
                e.preventDefault();
                $('#alertWarning').show();
                $('html, body').animate({ scrollTop: 0 }, 500);
                return false;
            }
        }
        return true;
    });
});
</script>
</body>
</html>