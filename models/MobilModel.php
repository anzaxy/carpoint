<?php
// models/MobilModel.php

class MobilModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua data mobil
    public function getAll() {
        $query = "SELECT * FROM mobil ORDER BY id_mobil DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Ambil data mobil by id
    public function getById($id) {
        $query = "SELECT * FROM mobil WHERE id_mobil = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Insert data mobil
    public function insert($data) {
        $query = "INSERT INTO mobil (merk, model, tahun, warna, harga, plat, status, foto) 
                  VALUES (:merk, :model, :tahun, :warna, :harga, :plat, :status, :foto)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':merk', $data['merk']);
        $stmt->bindParam(':model', $data['model']);
        $stmt->bindParam(':tahun', $data['tahun']);
        $stmt->bindParam(':warna', $data['warna']);
        $stmt->bindParam(':harga', $data['harga']);
        $stmt->bindParam(':plat', $data['plat']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':foto', $data['foto']);
        return $stmt->execute();
    }

    // Update data mobil
    public function update($id, $data) {
        $query = "UPDATE mobil SET 
                    merk = :merk, 
                    model = :model, 
                    tahun = :tahun, 
                    warna = :warna, 
                    harga = :harga, 
                    plat = :plat, 
                    status = :status, 
                    foto = :foto 
                  WHERE id_mobil = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':merk', $data['merk']);
        $stmt->bindParam(':model', $data['model']);
        $stmt->bindParam(':tahun', $data['tahun']);
        $stmt->bindParam(':warna', $data['warna']);
        $stmt->bindParam(':harga', $data['harga']);
        $stmt->bindParam(':plat', $data['plat']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':foto', $data['foto']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Hapus data mobil
    public function delete($id) {
        $query = "DELETE FROM mobil WHERE id_mobil = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    // ========== TAMBAHKAN METHOD INI ==========
    // Update status mobil (untuk mengubah status saat dipesan/terjual)
    public function updateStatus($id, $status) {
        $query = "UPDATE mobil SET status = :status WHERE id_mobil = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    // ==========================================
}
?>