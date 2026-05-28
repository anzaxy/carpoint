<?php
// controllers/Pemesanan.php

require_once 'config/database.php';
require_once 'models/PemesananModel.php';
require_once 'models/MobilModel.php';
require_once 'models/PembeliModel.php';

class Pemesanan {
    private $db;
    private $pemesananModel;
    private $mobilModel;
    private $pembeliModel;

    public function __construct() {
        $this->db = getConnection();
        $this->pemesananModel = new PemesananModel($this->db);
        $this->mobilModel = new MobilModel($this->db);
        $this->pembeliModel = new PembeliModel($this->db);
    }

    // Halaman utama data pemesanan
    public function index() {
        $pemesanan = $this->pemesananModel->getAll();
        require_once 'views/pemesanan/index.php';
    }

    // Form tambah pemesanan
    public function tambah() {
        $mobil = $this->mobilModel->getAll();
        $pembeli = $this->pembeliModel->getAll();
        $selected_pembeli = $_GET['id_pembeli'] ?? 0;
        require_once 'views/pemesanan/tambah.php';
    }

    // Proses simpan pemesanan + bayar booking
    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // DEBUG: lihat data yang dikirim
            error_log("=== DATA POST ===");
            error_log(print_r($_POST, true));
            error_log("=== DATA FILES ===");
            error_log(print_r($_FILES, true));
            
            $id_pembeli = $_POST['id_pembeli'] ?? 0;
            $id_mobil = $_POST['id_mobil'] ?? 0;
            $metode_booking = $_POST['metode_booking'] ?? '';
            
            // Validasi
            if ($id_pembeli == 0) {
                $_SESSION['error'] = 'Pilih pembeli terlebih dahulu!';
                header('Location: ' . base_url('index.php?page=pemesanan/tambah'));
                exit;
            }
            
            if ($id_mobil == 0) {
                $_SESSION['error'] = 'Pilih mobil terlebih dahulu!';
                header('Location: ' . base_url('index.php?page=pemesanan/tambah'));
                exit;
            }
            
            if ($metode_booking == '') {
                $_SESSION['error'] = 'Pilih metode pembayaran booking!';
                header('Location: ' . base_url('index.php?page=pemesanan/tambah'));
                exit;
            }
            
            // Cek mobil masih tersedia
            $mobil = $this->mobilModel->getById($id_mobil);
            if ($mobil->status != 'tersedia') {
                $_SESSION['error'] = 'Mobil sudah tidak tersedia!';
                header('Location: ' . base_url('index.php?page=pemesanan/tambah'));
                exit;
            }
            
            // Update status mobil menjadi dipesan
            $this->mobilModel->updateStatus($id_mobil, 'dipesan');
            
            // Hitung batas DP (7 hari)
            $batas_dp = date('Y-m-d', strtotime('+7 days'));
            
            // Data pemesanan
            $dataPesan = [
                'id_pembeli' => $id_pembeli,
                'id_mobil' => $id_mobil,
                'tgl_psn' => date('Y-m-d'),
                'batas' => $batas_dp,
                'status_psn' => 'booking_dibayar'
            ];
            
            // Insert pemesanan
            $id_pesan = $this->pemesananModel->insert($dataPesan);
            
            if ($id_pesan) {
                // Upload bukti transfer jika transfer
                $bukti_booking = '';
                if ($metode_booking == 'transfer') {
                    if (isset($_FILES['bukti_booking']) && $_FILES['bukti_booking']['error'] === 0) {
                        $targetDir = 'uploads/bukti_tf/';
                        if (!file_exists($targetDir)) {
                            mkdir($targetDir, 0777, true);
                        }
                        $ext = pathinfo($_FILES['bukti_booking']['name'], PATHINFO_EXTENSION);
                        $namaFile = time() . '_' . uniqid() . '.' . $ext;
                        $targetFile = $targetDir . $namaFile;
                        if (move_uploaded_file($_FILES['bukti_booking']['tmp_name'], $targetFile)) {
                            $bukti_booking = $targetFile;
                        }
                    }
                }
                
                // Simpan pembayaran booking
                $dataBayar = [
                    'id_pesan' => $id_pesan,
                    'tgl_bayar' => date('Y-m-d'),
                    'jml_bayar' => 500000,
                    'metode_bayar' => $metode_booking,
                    'jenis_bayar' => 'booking',
                    'status' => ($metode_booking == 'cash') ? 'valid' : 'pending',
                    'bukti_tf' => $bukti_booking
                ];
                $this->pemesananModel->insertPembayaran($dataBayar);
                
                $_SESSION['success'] = 'Pemesanan berhasil! Uang booking Rp 500.000 telah dibayar.';
                header('Location: ' . base_url('index.php?page=pemesanan'));
            } else {
                $_SESSION['error'] = 'Gagal menyimpan pemesanan!';
                header('Location: ' . base_url('index.php?page=pemesanan/tambah'));
            }
            exit;
        }
    }

    // Bayar DP
    public function bayarDp() {
        $id_pesan = $_GET['id'] ?? 0;
        $pemesanan = $this->pemesananModel->getDetailById($id_pesan);
        
        if (!$pemesanan || $pemesanan->status_psn != 'booking_dibayar') {
            $_SESSION['error'] = 'Pemesanan tidak valid!';
            header('Location: ' . base_url('index.php?page=penjualan'));
            exit;
        }
        
        $batas_dp = strtotime($pemesanan->batas);
        if (time() > $batas_dp) {
            $_SESSION['error'] = 'Batas waktu DP sudah lewat!';
            header('Location: ' . base_url('index.php?page=pemesanan/batal&id=' . $id_pesan));
            exit;
        }
        
        require_once 'views/penjualan/bayar_dp.php';
    }

    // Proses bayar DP
    public function prosesBayarDp() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_pesan = $_POST['id_pesan'];
            $metode = $_POST['metode'];
            
            $pemesanan = $this->pemesananModel->getDetailById($id_pesan);
            $dp_amount = $pemesanan->harga * 0.3;
            
            // Upload bukti transfer
            $bukti = '';
            if ($metode == 'transfer') {
                if (!isset($_FILES['bukti']) || $_FILES['bukti']['error'] !== 0) {
                    $_SESSION['error'] = 'Bukti transfer wajib diupload!';
                    header('Location: ' . base_url('index.php?page=penjualan/bayar-dp&id=' . $id_pesan));
                    exit;
                }
                
                $targetDir = 'uploads/bukti_tf/';
                if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
                $ext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
                $namaFile = time() . '_' . uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['bukti']['tmp_name'], $targetDir . $namaFile);
                $bukti = $targetDir . $namaFile;
            }
            
            // Simpan pembayaran DP
            $dataBayar = [
                'id_pesan' => $id_pesan,
                'tgl_bayar' => date('Y-m-d'),
                'jml_bayar' => $dp_amount,
                'metode_bayar' => $metode,
                'jenis_bayar' => 'dp',
                'status' => ($metode == 'cash') ? 'valid' : 'pending',
                'bukti_tf' => $bukti
            ];
            $this->pemesananModel->insertPembayaran($dataBayar);
            
            // Update status pemesanan
            $this->pemesananModel->updateStatus($id_pesan, 'dp_lunas');
            
            $_SESSION['success'] = 'DP 30% berhasil dibayar!';
            header('Location: ' . base_url('index.php?page=penjualan'));
            exit;
        }
    }

    // Batal pemesanan
    public function batal() {
        $id_pesan = $_GET['id'] ?? 0;
        $pemesanan = $this->pemesananModel->getById($id_pesan);
        
        if ($pemesanan) {
            $this->pemesananModel->updateStatus($id_pesan, 'batal');
            $this->mobilModel->updateStatus($pemesanan->id_mobil, 'tersedia');
            $_SESSION['success'] = 'Pemesanan dibatalkan!';
        }
        
        header('Location: ' . base_url('index.php?page=pemesanan'));
        exit;
    }

    // Cetak bukti
    public function cetak() {
        $id_pesan = $_GET['id'] ?? 0;
        $pemesanan = $this->pemesananModel->getDetailById($id_pesan);
        if (!$pemesanan) {
            echo "Data tidak ditemukan!";
            exit;
        }
        require_once 'views/pemesanan/cetak.php';
    }
}
?>