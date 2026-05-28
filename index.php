<?php
// index.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once 'helpers/function.php';

$page = $_GET['page'] ?? 'login';

// =============================================
// ROUTE LOGIN & LOGOUT
// =============================================

if ($page === 'login') {
    require_once 'controllers/Auth.php';
    $auth = new Auth();
    $auth->login();
    exit;
}

if ($page === 'login/proses') {
    require_once 'controllers/Auth.php';
    $auth = new Auth();
    $auth->prosesLogin();
    exit;
}

if ($page === 'logout') {
    require_once 'controllers/Auth.php';
    $auth = new Auth();
    $auth->logout();
    exit;
}

// =============================================
// CEK LOGIN UNTUK SEMUA HALAMAN LAIN
// =============================================

if (!is_logged_in()) {
    redirect('login');
}

// =============================================
// ROUTE DASHBOARD
// =============================================

if ($page === 'admin/dashboard') {
    require_once 'controllers/Admin.php';
    $controller = new Admin();
    $controller->dashboard();
    exit;
}

if ($page === 'owner/dashboard') {
    require_once 'controllers/Owner.php';
    $controller = new Owner();
    $controller->dashboard();
    exit;
}

// =============================================
// ROUTE MODUL PENJUAL
// =============================================

if ($page === 'penjual') {
    require_once 'controllers/Penjual.php';
    $controller = new Penjual();
    $controller->index();
    exit;
}

if ($page === 'penjual/tambah') {
    require_once 'controllers/Penjual.php';
    $controller = new Penjual();
    $controller->tambah();
    exit;
}

if ($page === 'penjual/simpan') {
    require_once 'controllers/Penjual.php';
    $controller = new Penjual();
    $controller->simpan();
    exit;
}

if ($page === 'penjual/edit') {
    require_once 'controllers/Penjual.php';
    $controller = new Penjual();
    $controller->edit();
    exit;
}

if ($page === 'penjual/update') {
    require_once 'controllers/Penjual.php';
    $controller = new Penjual();
    $controller->update();
    exit;
}

if ($page === 'penjual/hapus') {
    require_once 'controllers/Penjual.php';
    $controller = new Penjual();
    $controller->hapus();
    exit;
}

// =============================================
// ROUTE MODUL PEMBELI (LENGKAP)
// =============================================

if ($page === 'pembeli') {
    require_once 'controllers/Pembeli.php';
    $controller = new Pembeli();
    $controller->index();
    exit;
}

if ($page === 'pembeli/tambah') {
    require_once 'controllers/Pembeli.php';
    $controller = new Pembeli();
    $controller->tambah();
    exit;
}

if ($page === 'pembeli/simpan') {
    require_once 'controllers/Pembeli.php';
    $controller = new Pembeli();
    $controller->simpan();
    exit;
}

if ($page === 'pembeli/edit') {
    require_once 'controllers/Pembeli.php';
    $controller = new Pembeli();
    $controller->edit();
    exit;
}

if ($page === 'pembeli/update') {
    require_once 'controllers/Pembeli.php';
    $controller = new Pembeli();
    $controller->update();
    exit;
}

if ($page === 'pembeli/hapus') {
    require_once 'controllers/Pembeli.php';
    $controller = new Pembeli();
    $controller->hapus();
    exit;
}

// =============================================
// ROUTE MODUL MOBIL
// =============================================

if ($page === 'mobil') {
    require_once 'controllers/Mobil.php';
    $controller = new Mobil();
    $controller->index();
    exit;
}

if ($page === 'mobil/tambah') {
    require_once 'controllers/Mobil.php';
    $controller = new Mobil();
    $controller->tambah();
    exit;
}

if ($page === 'mobil/simpan') {
    require_once 'controllers/Mobil.php';
    $controller = new Mobil();
    $controller->simpan();
    exit;
}

if ($page === 'mobil/edit') {
    require_once 'controllers/Mobil.php';
    $controller = new Mobil();
    $controller->edit();
    exit;
}

if ($page === 'mobil/update') {
    require_once 'controllers/Mobil.php';
    $controller = new Mobil();
    $controller->update();
    exit;
}

if ($page === 'mobil/hapus') {
    require_once 'controllers/Mobil.php';
    $controller = new Mobil();
    $controller->hapus();
    exit;
}

if ($page === 'mobil/detail') {
    require_once 'controllers/Mobil.php';
    $controller = new Mobil();
    $controller->detail();
    exit;
}

// =============================================
// ROUTE MODUL PEMESANAN
// =============================================

if ($page === 'pemesanan') {
    require_once 'controllers/Pemesanan.php';
    $controller = new Pemesanan();
    $controller->index();
    exit;
}

if ($page === 'pemesanan/tambah') {
    require_once 'controllers/Pemesanan.php';
    $controller = new Pemesanan();
    $controller->tambah();
    exit;
}

if ($page === 'pemesanan/simpan') {
    require_once 'controllers/Pemesanan.php';
    $controller = new Pemesanan();
    $controller->simpan();
    exit;
}

if ($page === 'pemesanan/detail') {
    require_once 'controllers/Pemesanan.php';
    $controller = new Pemesanan();
    $controller->detail();
    exit;
}

if ($page === 'pemesanan/cetak') {
    require_once 'controllers/Pemesanan.php';
    $controller = new Pemesanan();
    $controller->cetak();
    exit;
}

// =============================================
// ROUTE MODUL PENJUALAN
// =============================================

// Penjualan
if ($page === 'penjualan') {
    require_once 'controllers/Penjualan.php';
    $controller = new Penjualan();
    $controller->index();
    exit;
}

if ($page === 'penjualan/bayar-dp') {
    require_once 'controllers/Penjualan.php';
    $controller = new Penjualan();
    $controller->bayarDp();
    exit;
}

if ($page === 'penjualan/proses-bayar-dp') {
    require_once 'controllers/Penjualan.php';
    $controller = new Penjualan();
    $controller->prosesBayarDp();
    exit;
}

if ($page === 'penjualan/bayar-pelunasan') {
    require_once 'controllers/Penjualan.php';
    $controller = new Penjualan();
    $controller->bayarPelunasan();
    exit;
}

if ($page === 'penjualan/proses-bayar-pelunasan') {
    require_once 'controllers/Penjualan.php';
    $controller = new Penjualan();
    $controller->prosesBayarPelunasan();
    exit;
}

if ($page === 'penjualan/cetak-kwitansi') {
    require_once 'controllers/Penjualan.php';
    $controller = new Penjualan();
    $controller->cetakKwitansi();
    exit;
}

// =============================================
// ROUTE MODUL SURAT (LENGKAP)
// =============================================

if ($page === 'surat') {
    require_once 'controllers/Surat.php';
    $controller = new Surat();
    $controller->index();
    exit;
}

if ($page === 'surat/jalan') {
    require_once 'controllers/Surat.php';
    $controller = new Surat();
    $controller->suratJalan();
    exit;
}

if ($page === 'surat/cetak') {
    require_once 'controllers/Surat.php';
    $controller = new Surat();
    $controller->cetak();
    exit;
}

// =============================================
// ROUTE MODUL LAPORAN (LENGKAP)
// =============================================

if ($page === 'laporan/penjualan') {
    require_once 'controllers/Laporan.php';
    $controller = new Laporan();
    $controller->penjualan();
    exit;
}

if ($page === 'laporan/pembelian') {
    require_once 'controllers/Laporan.php';
    $controller = new Laporan();
    $controller->pembelian();
    exit;
}

if ($page === 'laporan/stok') {
    require_once 'controllers/Laporan.php';
    $controller = new Laporan();
    $controller->stok();
    exit;
}

// =============================================
// ROUTE MODUL SURAT
// =============================================

if ($page === 'surat') {
    require_once 'controllers/Surat.php';
    $controller = new Surat();
    $controller->index();
    exit;
}

if ($page === 'surat/proses') {
    require_once 'controllers/Surat.php';
    $controller = new Surat();
    $controller->proses();
    exit;
}

// =============================================
// ROUTE MODUL PENGIRIMAN
// =============================================

if ($page === 'pengiriman') {
    require_once 'controllers/Pengiriman.php';
    $controller = new Pengiriman();
    $controller->index();
    exit;
}

if ($page === 'pengiriman/proses') {
    require_once 'controllers/Pengiriman.php';
    $controller = new Pengiriman();
    $controller->proses();
    exit;
}

if ($page === 'pengiriman/cetak-surat-jalan') {
    require_once 'controllers/Pengiriman.php';
    $controller = new Pengiriman();
    $controller->cetakSuratJalan();
    exit;
}

// =============================================
// HALAMAN TIDAK DITEMUKAN
// =============================================

die("Halaman tidak ditemukan!");
?>