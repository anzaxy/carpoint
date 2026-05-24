<?php
// controllers/Admin.php

class Admin {
    
    public function dashboard() {
        require_once 'views/admin/dashboard.php';
    }
    
    public function mobil() {
        echo "Halaman Data Mobil - Admin";
    }
    
    public function pembeli() {
        echo "Halaman Data Pembeli - Admin";
    }
    
    // tambahkan method lain sesuai menu
}
?>