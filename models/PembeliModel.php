<?php
// models/PembeliModel.php

class PembeliModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM pembeli ORDER BY id_pembeli DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($id) {
        $query = "SELECT * FROM pembeli WHERE id_pembeli = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function insert($data) {
        $query = "INSERT INTO pembeli (NIK, nama, alamat, hp, email) 
                  VALUES (:nik, :nama, :alamat, :hp, :email)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nik', $data['NIK']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':alamat', $data['alamat']);
        $stmt->bindParam(':hp', $data['hp']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function update($id, $data) {
        $query = "UPDATE pembeli SET 
                    NIK = :nik, 
                    nama = :nama, 
                    alamat = :alamat, 
                    hp = :hp, 
                    email = :email 
                  WHERE id_pembeli = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nik', $data['NIK']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':alamat', $data['alamat']);
        $stmt->bindParam(':hp', $data['hp']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM pembeli WHERE id_pembeli = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>