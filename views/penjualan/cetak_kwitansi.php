<!DOCTYPE html>
<html>
<head>
    <title>Kwitansi Penjualan - CarPoint</title>
    <style>
        body { font-family: Arial; font-size: 14px; }
        .container { max-width: 800px; margin: auto; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { font-size: 24px; font-weight: bold; text-align: center; margin: 20px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; vertical-align: top; }
        th { background: #f5f5f5; width: 35%; }
        .total { font-size: 18px; font-weight: bold; color: green; }
        .footer { text-align: center; margin-top: 50px; font-size: 12px; }
        .signature { margin-top: 50px; text-align: right; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>CarPoint - Jual Beli Mobil Bekas</h2>
        <p>Jl. Raya No. 123, Kota Contoh | Telp: (021) 1234567</p>
    </div>
    
    <div class="title">
        KUITANSI PENJUALAN
    </div>
    
    <table>
        <tr><th>No. Faktur</th><td><?= $data->no_faktur ?></td></tr>
        <tr><th>Tanggal</th><td><?= date('d/m/Y', strtotime($data->tgl_pj_mobil)) ?></td></tr>
        <tr><th>Kode Pemesanan</th><td>#<?= $data->id_pesan ?></td></tr>
    </table>
    
    <h4>Data Pembeli</h4>
    <table>
        <tr><th>Nama</th><td><?= htmlspecialchars($data->nama_pembeli) ?></td></tr>
        <tr><th>NIK</th><td><?= htmlspecialchars($data->NIK) ?></td></tr>
        <tr><th>Alamat</th><td><?= htmlspecialchars($data->alamat) ?></td></tr>
        <tr><th>No. HP</th><td><?= htmlspecialchars($data->hp) ?></td></tr>
    </table>
    
    <h4>Data Mobil</h4>
    <table>
        <tr><th>Merk & Model</th><td><?= $data->merk ?> <?= $data->model ?></td></tr>
        <tr><th>Tahun</th><td><?= $data->tahun ?></td></tr>
        <tr><th>Warna</th><td><?= $data->warna ?></td></tr>
        <tr><th>Plat Nomor</th><td><?= $data->plat ?></td></tr>
    </table>
    
    <h4>Detail Pembayaran</h4>
    <table>
        <tr><th>Harga Mobil</th><td>Rp <?= number_format($data->harga_jual, 0, ',', '.') ?></td></tr>
        <tr><th>DP 30% (Dibayar tgl <?= date('d/m/Y', strtotime($data->tgl_dp)) ?>)</th><td>Rp <?= number_format($data->dp_dibayar, 0, ',', '.') ?></td></tr>
        <tr><th>Pelunasan (Dibayar tgl <?= date('d/m/Y', strtotime($data->tgl_pelunasan)) ?>)</th><td>Rp <?= number_format($data->sisa_pembayaran, 0, ',', '.') ?></td></tr>
        <tr style="background: #e8f5e9;"><th class="total">TOTAL</th><td class="total">Rp <?= number_format($data->harga_jual, 0, ',', '.') ?></td></tr>
    </table>
    
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