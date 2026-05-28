<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bukti Pemesanan - CarPoint</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .container { max-width: 800px; margin: 0 auto; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header img { max-width: 150px; }
        .title { font-size: 20px; font-weight: bold; text-align: center; margin: 20px 0; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .info-table th, .info-table td { border: 1px solid #ddd; padding: 8px; vertical-align: top; }
        .info-table th { background: #f5f5f5; width: 35%; }
        .footer { text-align: center; margin-top: 50px; font-size: 12px; color: #999; }
        .signature { margin-top: 50px; text-align: right; }
        @media print {
            .no-print { display: none; }
            body { margin: 0; padding: 0; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="<?= base_url('images/logo.png') ?>" alt="Logo">
        <h2>CarPoint - Jual Beli Mobil Bekas</h2>
        <p>Jl. Raya No. 123, Kota Contoh, Telp: (021) 1234567</p>
    </div>
    
    <div class="title">
        BUKTI PEMESANAN (BOOKING)
    </div>
    
    <table class="info-table">
        <tr><th>No. Pemesanan</th><td>#<?= $pemesanan->id_pesan ?></td></tr>
        <tr><th>Tanggal Pemesanan</th><td><?= date('d/m/Y H:i:s', strtotime($pemesanan->tgl_psn)) ?></td></tr>
        <tr><th>Status</th><td><?= strtoupper($pemesanan->status_psn) ?></td></tr>
    </table>
    
    <h4>Data Pembeli</h4>
    <table class="info-table">
        <tr><th>Nama</th><td><?= htmlspecialchars($pemesanan->nama_pembeli) ?></td></tr>
        <tr><th>NIK</th><td><?= htmlspecialchars($pemesanan->NIK) ?></td></tr>
        <tr><th>Alamat</th><td><?= htmlspecialchars($pemesanan->alamat) ?></td></tr>
        <tr><th>No. HP</th><td><?= htmlspecialchars($pemesanan->hp) ?></td></tr>
    </table>
    
    <h4>Data Mobil</h4>
    <table class="info-table">
        <tr><th>Merk & Model</th><td><?= htmlspecialchars($pemesanan->merk) ?> <?= htmlspecialchars($pemesanan->model) ?></td></tr>
        <tr><th>Tahun</th><td><?= $pemesanan->tahun ?></td></tr>
        <tr><th>Warna</th><td><?= htmlspecialchars($pemesanan->warna) ?></td></tr>
        <tr><th>Plat Nomor</th><td><?= htmlspecialchars($pemesanan->plat) ?></td></tr>
        <tr><th>Harga</th><td><strong>Rp <?= number_format($pemesanan->harga, 0, ',', '.') ?></strong></td></tr>
    </table>
    
    <h4>Informasi Pembayaran</h4>
    <table class="info-table">
        <tr><th>Uang Booking</th><td>Rp 500.000</td></tr>
        <tr><th>DP (30%)</th><td>Rp <?= number_format($pemesanan->harga * 0.3, 0, ',', '.') ?></td></tr>
        <tr><th>Sisa Pelunasan</th><td>Rp <?= number_format($pemesanan->harga * 0.7, 0, ',', '.') ?></td></tr>
        <tr><th>Batas Pembayaran DP</th><td><?= date('d/m/Y', strtotime($pemesanan->batas)) ?></td></tr>
    </table>
    
    <div class="alert alert-warning" style="background: #fff3cd; padding: 10px; border-left: 4px solid #ffc107;">
        <strong>⚠️ Ketentuan:</strong><br>
        - Uang booking Rp 500.000 akan dikembalikan jika pembatalan dalam waktu 1 minggu<br>
        - Jika melebihi 1 minggu, uang booking HANGUS dan pemesanan dibatalkan<br>
        - DP 30% harus dibayar maksimal tanggal <?= date('d/m/Y', strtotime($pemesanan->batas)) ?>
    </div>
    
    <div class="signature">
        Hormat kami,<br><br><br>
        (Admin CarPoint)
    </div>
    
    <div class="footer">
        *Terima kasih telah mempercayakan pembelian mobil kepada CarPoint*
    </div>
    
    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> Cetak / Print</button>
        <button onclick="window.close()" class="btn btn-secondary">Tutup</button>
    </div>
</div>
</body>
</html>