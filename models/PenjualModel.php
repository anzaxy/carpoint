<?php
// models/PenjualModel.php

class PenjualModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua data penjual
    public function getAll() {
        $query = "SELECT * FROM penjual ORDER BY id_penjual DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Ambil data penjual by id
    public function getById($id) {
        $query = "SELECT * FROM penjual WHERE id_penjual = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Insert data penjual
    public function insert($data) {
        $query = "INSERT INTO penjual (NIK, nama, alamat, hp, rek, bank) 
                  VALUES (:nik, :nama, :alamat, :hp, :rek, :bank)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nik', $data['NIK']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':alamat', $data['alamat']);
        $stmt->bindParam(':hp', $data['hp']);
        $stmt->bindParam(':rek', $data['rek']);
        $stmt->bindParam(':bank', $data['bank']);
        return $stmt->execute();
    }

    // Update data penjual
    public function update($id, $data) {
        $query = "UPDATE penjual SET 
                    NIK = :nik, 
                    nama = :nama, 
                    alamat = :alamat, 
                    hp = :hp, 
                    rek = :rek, 
                    bank = :bank 
                  WHERE id_penjual = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nik', $data['NIK']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':alamat', $data['alamat']);
        $stmt->bindParam(':hp', $data['hp']);
        $stmt->bindParam(':rek', $data['rek']);
        $stmt->bindParam(':bank', $data['bank']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Hapus data penjual
    public function delete($id) {
        $query = "DELETE FROM penjual WHERE id_penjual = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>