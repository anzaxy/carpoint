<?php
// controllers/Surat.php

require_once 'config/database.php';
require_once 'models/PenjualanModel.php';
require_once 'models/SuratModel.php';

class Surat {
    private $db;
    private $penjualanModel;
    private $suratModel;

    public function __construct() {
        $this->db = getConnection();
        $this->penjualanModel = new PenjualanModel($this->db);
        $this->suratModel = new SuratModel($this->db);
    }

    // Halaman utama pengurusan surat
    public function index() {
        // Ambil penjualan yang sudah DP lunas tapi belum urus surat
        $penjualan = $this->penjualanModel->getPenjualanForSurat();
        require_once 'views/surat/index.php';
    }

    // Proses pengurusan surat (STNK/BPKB)
    public function proses() {
        $id_pj_mobil = $_GET['id'] ?? 0;
        $jenis = $_GET['jenis'] ?? 'stnk';
        
        $tgl_urus = date('Y-m-d');
        $tgl_estimasi = ($jenis == 'stnk') 
            ? date('Y-m-d', strtotime('+14 days'))  // STNK 2 minggu
            : date('Y-m-d', strtotime('+60 days')); // BPKB 2 bulan
        
        $data = [
            'id_pj_mobil' => $id_pj_mobil,
            'tgl_urus' => $tgl_urus,
            'tgl_estimasi' => $tgl_estimasi,
            'status' => 'proses',
            'jenis' => $jenis
        ];
        
        $this->suratModel->insert($data);
        
        // Update status penjualan
        if ($jenis == 'stnk') {
            $this->penjualanModel->updateStatusPenjualanById($id_pj_mobil, 'proses_stnk');
        } else {
            $this->penjualanModel->updateStatusPenjualanById($id_pj_mobil, 'proses_bpkb');
        }
        
        $_SESSION['success'] = 'Pengurusan ' . strtoupper($jenis) . ' dimulai!';
        header('Location: ' . base_url('index.php?page=surat'));
        exit;
    }
}
?>