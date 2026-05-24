<?php
// controllers/Owner.php

class Owner {
    
    public function dashboard() {
        require_once 'views/owner/dashboard.php';
    }
    
    public function laporan() {
        $jenis = $_GET['sub'] ?? 'penjualan';
        if ($jenis === 'penjualan') {
            require_once 'views/owner/laporan/penjualan.php';
        } elseif ($jenis === 'pembelian') {
            require_once 'views/owner/laporan/pembelian.php';
        } else {
            require_once 'views/owner/laporan/stok.php';
        }
    }
}
?>