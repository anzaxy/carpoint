<?php
// controllers/Penjual.php

require_once 'config/database.php';
require_once 'models/PenjualModel.php';

class Penjual {
    private $db;
    private $penjualModel;

    public function __construct() {
        $this->db = getConnection();
        $this->penjualModel = new PenjualModel($this->db);
    }

    // Menampilkan semua data penjual
    public function index() {
        $penjual = $this->penjualModel->getAll();
        require_once 'views/penjual/index.php';
    }

    // Menampilkan form tambah penjual
    public function tambah() {
        require_once 'views/penjual/tambah.php';
    }

    // Proses simpan data penjual
    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'NIK' => $_POST['nik'],
                'nama' => $_POST['nama'],
                'alamat' => $_POST['alamat'],
                'hp' => $_POST['hp'],
                'rek' => $_POST['rek'],
                'bank' => $_POST['bank']
            ];

            if ($this->penjualModel->insert($data)) {
                $_SESSION['success'] = 'Data penjual berhasil ditambahkan!';
            } else {
                $_SESSION['error'] = 'Gagal menambahkan data penjual!';
            }
            header('Location: ' . base_url('index.php?page=penjual'));
            exit;
        }
    }

    // Menampilkan form edit penjual
    public function edit() {
        $id = $_GET['id'] ?? 0;
        $penjual = $this->penjualModel->getById($id);
        
        if (!$penjual) {
            $_SESSION['error'] = 'Data penjual tidak ditemukan!';
            header('Location: ' . base_url('index.php?page=penjual'));
            exit;
        }
        
        require_once 'views/penjual/edit.php';
    }

    // Proses update data penjual
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'NIK' => $_POST['nik'],
                'nama' => $_POST['nama'],
                'alamat' => $_POST['alamat'],
                'hp' => $_POST['hp'],
                'rek' => $_POST['rek'],
                'bank' => $_POST['bank']
            ];

            if ($this->penjualModel->update($id, $data)) {
                $_SESSION['success'] = 'Data penjual berhasil diupdate!';
            } else {
                $_SESSION['error'] = 'Gagal mengupdate data penjual!';
            }
            header('Location: ' . base_url('index.php?page=penjual'));
            exit;
        }
    }

    // Proses hapus data penjual
    public function hapus() {
        $id = $_GET['id'] ?? 0;
        
        if ($this->penjualModel->delete($id)) {
            $_SESSION['success'] = 'Data penjual berhasil dihapus!';
        } else {
            $_SESSION['error'] = 'Gagal menghapus data penjual!';
        }
        header('Location: ' . base_url('index.php?page=penjual'));
        exit;
    }
}
?>