<?php
// controllers/Mobil.php

require_once 'config/database.php';
require_once 'models/MobilModel.php';

class Mobil {
    private $db;
    private $mobilModel;

    public function __construct() {
        $this->db = getConnection();
        $this->mobilModel = new MobilModel($this->db);
    }

    // Menampilkan semua data mobil
    public function index() {
        $mobil = $this->mobilModel->getAll();
        require_once 'views/mobil/index.php';
    }

    // Menampilkan form tambah mobil
    public function tambah() {
        require_once 'views/mobil/tambah.php';
    }

    // Proses simpan data mobil dengan upload foto
    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Proses upload foto
            $foto = '';
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                $targetDir = 'uploads/mobil/';
                
                // Buat folder jika belum ada
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                
                // Generate nama file unik
                $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                $namaFile = time() . '_' . uniqid() . '.' . $ext;
                $targetFile = $targetDir . $namaFile;
                
                // Upload file
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {
                    $foto = $targetFile;
                }
            }

            $data = [
                'merk' => $_POST['merk'],
                'model' => $_POST['model'],
                'tahun' => $_POST['tahun'],
                'warna' => $_POST['warna'],
                'harga' => $_POST['harga'],
                'plat' => $_POST['plat'],
                'status' => $_POST['status'],
                'foto' => $foto
            ];

            if ($this->mobilModel->insert($data)) {
                $_SESSION['success'] = 'Data mobil berhasil ditambahkan!';
            } else {
                $_SESSION['error'] = 'Gagal menambahkan data mobil!';
            }
            header('Location: ' . base_url('index.php?page=mobil'));
            exit;
        }
    }

    // Menampilkan form edit mobil
    public function edit() {
        $id = $_GET['id'] ?? 0;
        $mobil = $this->mobilModel->getById($id);
        
        if (!$mobil) {
            $_SESSION['error'] = 'Data mobil tidak ditemukan!';
            header('Location: ' . base_url('index.php?page=mobil'));
            exit;
        }
        
        require_once 'views/mobil/edit.php';
    }

    // Proses update data mobil dengan upload foto baru
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            
            // Ambil data lama
            $oldData = $this->mobilModel->getById($id);
            $foto = $oldData->foto;
            
            // Proses upload foto baru jika ada
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                $targetDir = 'uploads/mobil/';
                
                // Buat folder jika belum ada
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                
                // Hapus foto lama
                if ($foto && file_exists($foto)) {
                    unlink($foto);
                }
                
                // Generate nama file unik
                $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                $namaFile = time() . '_' . uniqid() . '.' . $ext;
                $targetFile = $targetDir . $namaFile;
                
                // Upload file baru
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {
                    $foto = $targetFile;
                }
            }
            
            $data = [
                'merk' => $_POST['merk'],
                'model' => $_POST['model'],
                'tahun' => $_POST['tahun'],
                'warna' => $_POST['warna'],
                'harga' => $_POST['harga'],
                'plat' => $_POST['plat'],
                'status' => $_POST['status'],
                'foto' => $foto
            ];

            if ($this->mobilModel->update($id, $data)) {
                $_SESSION['success'] = 'Data mobil berhasil diupdate!';
            } else {
                $_SESSION['error'] = 'Gagal mengupdate data mobil!';
            }
            header('Location: ' . base_url('index.php?page=mobil'));
            exit;
        }
    }

    // Proses hapus data mobil
    public function hapus() {
        $id = $_GET['id'] ?? 0;
        
        // Hapus file foto
        $mobil = $this->mobilModel->getById($id);
        if ($mobil && $mobil->foto && file_exists($mobil->foto)) {
            unlink($mobil->foto);
        }
        
        if ($this->mobilModel->delete($id)) {
            $_SESSION['success'] = 'Data mobil berhasil dihapus!';
        } else {
            $_SESSION['error'] = 'Gagal menghapus data mobil!';
        }
        header('Location: ' . base_url('index.php?page=mobil'));
        exit;
    }
    
    // Detail mobil
    public function detail() {
        $id = $_GET['id'] ?? 0;
        $mobil = $this->mobilModel->getById($id);
        
        if (!$mobil) {
            $_SESSION['error'] = 'Data mobil tidak ditemukan!';
            header('Location: ' . base_url('index.php?page=mobil'));
            exit;
        }
        
        require_once 'views/mobil/detail.php';
    }
}
?>