<?php
// controllers/Pengiriman.php

require_once 'config/database.php';
require_once 'models/PenjualanModel.php';
require_once 'models/PengirimanModel.php';

class Pengiriman {
    private $db;
    private $penjualanModel;
    private $pengirimanModel;

    public function __construct() {
        $this->db = getConnection();
        $this->penjualanModel = new PenjualanModel($this->db);
        $this->pengirimanModel = new PengirimanModel($this->db);
    }

    // Halaman utama pengiriman
    public function index() {
        $penjualan = $this->penjualanModel->getPenjualanForPengiriman();
        require_once 'views/pengiriman/index.php';
    }

    // Proses pengiriman (pilih jenis)
    public function proses() {
        $id_pj_mobil = $_GET['id'] ?? 0;
        $jenis = $_POST['jenis'] ?? 'diambil';
        $alamat = $_POST['alamat'] ?? '';
        
        $data = [
            'id_pj_mobil' => $id_pj_mobil,
            'jenis' => $jenis,
            'status' => 'proses'
        ];
        
        $id_pengiriman = $this->pengirimanModel->insert($data);
        
        if ($jenis == 'diantar') {
            // Generate surat jalan
            $this->pengirimanModel->insertSuratJalan($id_pengiriman, $alamat);
            $_SESSION['success'] = 'Mobil akan diantar ke alamat tujuan. Surat jalan telah dicetak.';
        } else {
            $_SESSION['success'] = 'Mobil siap diambil di showroom.';
        }
        
        header('Location: ' . base_url('index.php?page=pengiriman'));
        exit;
    }
    
    // Cetak surat jalan
    public function cetakSuratJalan() {
        $id_pengiriman = $_GET['id'] ?? 0;
        $data = $this->pengirimanModel->getSuratJalan($id_pengiriman);
        
        if (!$data) {
            echo "Data tidak ditemukan!";
            exit;
        }
        
        require_once 'views/pengiriman/cetak_surat_jalan.php';
    }
}
?>