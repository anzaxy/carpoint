<!DOCTYPE html>
<html>
<head>
    <title>Surat Jalan - CarPoint</title>
    <style>
        body { font-family: Arial; font-size: 14px; }
        .container { max-width: 800px; margin: auto; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { font-size: 20px; font-weight: bold; text-align: center; margin: 20px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; vertical-align: top; }
        th { background: #f5f5f5; width: 35%; }
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
        SURAT JALAN
    </div>
    
    <table>
        <tr><th>No. Faktur</th><td><?= $data->no_faktur ?></td></tr>
        <tr><th>Tanggal Cetak</th><td><?= date('d/m/Y', strtotime($data->tgl_cetak)) ?></td></tr>
    </table>
    
    <h4>Data Penerima</h4>
    <table>
        <tr><th>Nama Penerima</th><td><?= $data->nama_pembeli ?></td></tr>
        <tr><th>Alamat Tujuan</th><td><?= $data->alamat_tujuan ?></td></tr>
    </table>
    
    <h4>Data Kendaraan</h4>
    <table>
        <tr><th>Merk & Model</th><td><?= $data->merk ?> <?= $data->model ?></td></tr>
        <tr><th>Plat Nomor</th><td><?= $data->plat ?></td></tr>
    </table>
    
    <div class="signature">
        Dikirim oleh,<br><br><br>
        (Admin CarPoint)
    </div>
    
    <div class="signature" style="text-align: left; margin-top: 30px;">
        Diterima oleh,<br><br><br>
        (Pembeli)
    </div>
    
    <div class="footer">
        *Surat jalan ini sebagai bukti serah terima kendaraan*
    </div>
    
    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" class="btn btn-primary">Cetak / Print</button>
        <button onclick="window.close()" class="btn btn-secondary">Tutup</button>
    </div>
</div>
</body>
</html>