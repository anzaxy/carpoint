<?php
// controllers/Penjualan.php

require_once 'config/database.php';
require_once 'models/PenjualanModel.php';
require_once 'models/PemesananModel.php';
require_once 'models/MobilModel.php';

class Penjualan {
    private $db;
    private $penjualanModel;
    private $pemesananModel;
    private $mobilModel;

    public function __construct() {
        $this->db = getConnection();
        $this->penjualanModel = new PenjualanModel($this->db);
        $this->pemesananModel = new PemesananModel($this->db);
        $this->mobilModel = new MobilModel($this->db);
    }

    // Halaman utama transaksi penjualan
    public function index() {
        $pesananAktif = $this->penjualanModel->getPesananAktif();
        require_once 'views/penjualan/index.php';
    }

    // Form bayar DP
    public function bayarDp() {
        $id_pesan = $_GET['id'] ?? 0;
        $pemesanan = $this->pemesananModel->getDetailById($id_pesan);
        
        if (!$pemesanan || $pemesanan->status_psn != 'booking_dibayar') {
            $_SESSION['error'] = 'Pemesanan tidak valid!';
            header('Location: ' . base_url('index.php?page=penjualan'));
            exit;
        }
        
        // Cek batas waktu
        $batas_dp = strtotime($pemesanan->batas);
        if (time() > $batas_dp) {
            $_SESSION['error'] = 'Batas waktu DP sudah lewat! Pesanan akan dibatalkan.';
            header('Location: ' . base_url('index.php?page=pemesanan/batal&id=' . $id_pesan));
            exit;
        }
        
        require_once 'views/penjualan/bayar_dp.php';
    }

    // Proses bayar DP (dengan upload KTP)
    public function prosesBayarDp() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_pesan = $_POST['id_pesan'];
            $metode = $_POST['metode'];
            
            $pemesanan = $this->pemesananModel->getDetailById($id_pesan);
            $dp_amount = $pemesanan->harga * 0.3;
            
            // Upload bukti transfer (jika transfer)
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
            
            // Upload KTP (WAJIB)
            $ktp = '';
            if (!isset($_FILES['ktp']) || $_FILES['ktp']['error'] !== 0) {
                $_SESSION['error'] = 'Upload KTP wajib diisi!';
                header('Location: ' . base_url('index.php?page=penjualan/bayar-dp&id=' . $id_pesan));
                exit;
            }
            
            $targetDir = 'uploads/ktp/';
            if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
            $ext = pathinfo($_FILES['ktp']['name'], PATHINFO_EXTENSION);
            $namaFile = time() . '_' . uniqid() . '.' . $ext;
            move_uploaded_file($_FILES['ktp']['tmp_name'], $targetDir . $namaFile);
            $ktp = $targetDir . $namaFile;
            
            // Simpan pembayaran DP ke menu_pembayaran
            $dataBayar = [
                'id_pesan' => $id_pesan,
                'tgl_bayar' => date('Y-m-d'),
                'jml_bayar' => $dp_amount,
                'metode_bayar' => $metode,
                'jenis_bayar' => 'dp',
                'status' => ($metode == 'cash') ? 'valid' : 'pending',
                'bukti_tf' => $bukti
            ];
            $this->penjualanModel->insertPembayaran($dataBayar);
            
            // Update status pemesanan
            $this->pemesananModel->updateStatus($id_pesan, 'dp_lunas');
            
            // Catat transaksi penjualan dengan foto KTP
            $dataPenjualan = [
                'id_pesan' => $id_pesan,
                'no_faktur' => 'INV-' . date('Ymd') . '-' . $id_pesan,
                'tgl_penjualan' => date('Y-m-d'),
                'harga_jual' => $pemesanan->harga,
                'dp_dibayar' => $dp_amount,
                'sisa_pembayaran' => $pemesanan->harga - $dp_amount,
                'status_penjualan' => 'dp_lunas',
                'foto_ktp' => $ktp
            ];
            $this->penjualanModel->insertPenjualan($dataPenjualan);
            
            $_SESSION['success'] = 'DP 30% berhasil dibayar! KTP telah diupload. Silakan lanjutkan pengurusan surat.';
            header('Location: ' . base_url('index.php?page=penjualan'));
            exit;
        }
    }

    // Form bayar pelunasan
    public function bayarPelunasan() {
        $id_pesan = $_GET['id'] ?? 0;
        $pemesanan = $this->pemesananModel->getDetailById($id_pesan);
        $penjualan = $this->penjualanModel->getPenjualanByPesan($id_pesan);
        
        if (!$pemesanan || $pemesanan->status_psn != 'dp_lunas') {
            $_SESSION['error'] = 'Pemesanan tidak valid untuk pelunasan!';
            header('Location: ' . base_url('index.php?page=penjualan'));
            exit;
        }
        
        require_once 'views/penjualan/bayar_pelunasan.php';
    }

    // Proses bayar pelunasan
    public function prosesBayarPelunasan() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_pesan = $_POST['id_pesan'];
            $metode = $_POST['metode'];
            
            $pemesanan = $this->pemesananModel->getDetailById($id_pesan);
            $penjualan = $this->penjualanModel->getPenjualanByPesan($id_pesan);
            $sisa = $penjualan->sisa_pembayaran;
            
            // Upload bukti transfer jika transfer
            $bukti = '';
            if ($metode == 'transfer') {
                if (!isset($_FILES['bukti']) || $_FILES['bukti']['error'] !== 0) {
                    $_SESSION['error'] = 'Bukti transfer wajib diupload!';
                    header('Location: ' . base_url('index.php?page=penjualan/bayar-pelunasan&id=' . $id_pesan));
                    exit;
                }
                
                $targetDir = 'uploads/bukti_tf/';
                if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
                $ext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
                $namaFile = time() . '_' . uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['bukti']['tmp_name'], $targetDir . $namaFile);
                $bukti = $targetDir . $namaFile;
            }
            
            // Simpan pembayaran pelunasan
            $dataBayar = [
                'id_pesan' => $id_pesan,
                'tgl_bayar' => date('Y-m-d'),
                'jml_bayar' => $sisa,
                'metode_bayar' => $metode,
                'jenis_bayar' => 'pelunasan',
                'status' => ($metode == 'cash') ? 'valid' : 'pending',
                'bukti_tf' => $bukti
            ];
            $this->penjualanModel->insertPembayaran($dataBayar);
            
            // Update status pemesanan dan penjualan
            $this->pemesananModel->updateStatus($id_pesan, 'lunas');
            $this->penjualanModel->updateStatusPenjualan($id_pesan, 'lunas', 0);
            
            // Update status mobil menjadi terjual
            $this->mobilModel->updateStatus($pemesanan->id_mobil, 'terjual');
            
            $_SESSION['success'] = 'Pelunasan berhasil! Kwitansi telah dicetak.';
            header('Location: ' . base_url('index.php?page=penjualan/cetak-kwitansi&id=' . $id_pesan));
            exit;
        }
    }

    // Cetak kwitansi
    public function cetakKwitansi() {
        $id_pesan = $_GET['id'] ?? 0;
        $data = $this->penjualanModel->getDataKwitansi($id_pesan);
        
        if (!$data) {
            echo "Data tidak ditemukan!";
            exit;
        }
        
        require_once 'views/penjualan/cetak_kwitansi.php';
    }
}
?>