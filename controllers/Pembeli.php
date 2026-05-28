<?php
// controllers/Pembeli.php

require_once 'config/database.php';
require_once 'models/PembeliModel.php';

class Pembeli {
    private $db;
    private $pembeliModel;

    public function __construct() {
        $this->db = getConnection();
        $this->pembeliModel = new PembeliModel($this->db);
    }

    public function index() {
        $pembeli = $this->pembeliModel->getAll();
        require_once 'views/pembeli/index.php';
    }

    public function tambah() {
        require_once 'views/pembeli/tambah.php';
    }

    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = [
                'NIK' => $_POST['nik'],
                'nama' => $_POST['nama'],
                'alamat' => $_POST['alamat'],
                'hp' => $_POST['hp'],
                'email' => $_POST['email'] ?? ''
            ];

            $id_pembeli = $this->pembeliModel->insert($data);
            
            if ($id_pembeli) {
                $_SESSION['success'] = 'Data pembeli berhasil ditambahkan!';
                
                // CEK TOMBOL YANG DITEKAN
                $action = $_POST['action'] ?? 'simpan';
                
                if ($action == 'pesan') {
                    // Redirect ke halaman PEMESANAN dengan id pembeli baru
                    header('Location: ' . base_url('index.php?page=pemesanan/tambah&id_pembeli=' . $id_pembeli));
                } else {
                    // Redirect ke halaman PEMBELI
                    header('Location: ' . base_url('index.php?page=pembeli'));
                }
            } else {
                $_SESSION['error'] = 'Gagal menambahkan data pembeli!';
                header('Location: ' . base_url('index.php?page=pembeli/tambah'));
            }
            exit;
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        $pembeli = $this->pembeliModel->getById($id);
        
        if (!$pembeli) {
            $_SESSION['error'] = 'Data pembeli tidak ditemukan!';
            header('Location: ' . base_url('index.php?page=pembeli'));
            exit;
        }
        
        require_once 'views/pembeli/edit.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'NIK' => $_POST['nik'],
                'nama' => $_POST['nama'],
                'alamat' => $_POST['alamat'],
                'hp' => $_POST['hp'],
                'email' => $_POST['email'] ?? ''
            ];

            if ($this->pembeliModel->update($id, $data)) {
                $_SESSION['success'] = 'Data pembeli berhasil diupdate!';
            } else {
                $_SESSION['error'] = 'Gagal mengupdate data pembeli!';
            }
            header('Location: ' . base_url('index.php?page=pembeli'));
            exit;
        }
    }

    public function hapus() {
        $id = $_GET['id'] ?? 0;
        
        if ($this->pembeliModel->delete($id)) {
            $_SESSION['success'] = 'Data pembeli berhasil dihapus!';
        } else {
            $_SESSION['error'] = 'Gagal menghapus data pembeli!';
        }
        header('Location: ' . base_url('index.php?page=pembeli'));
        exit;
    }
}
?>