<?php
// models/PemesananModel.php

class PemesananModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua pemesanan
    public function getAll() {
        $query = "SELECT p.*, pb.nama as nama_pembeli, m.merk, m.model, m.harga 
                  FROM pemesanan p
                  LEFT JOIN pembeli pb ON p.id_pembeli = pb.id_pembeli
                  LEFT JOIN mobil m ON p.id_mobil = m.id_mobil
                  ORDER BY p.id_pesan DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Ambil pemesanan by id
    public function getById($id) {
        $query = "SELECT * FROM pemesanan WHERE id_pesan = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Ambil detail pemesanan lengkap
    public function getDetailById($id) {
        $query = "SELECT p.*, pb.nama as nama_pembeli, pb.NIK, pb.alamat, pb.hp, pb.email,
                  m.merk, m.model, m.tahun, m.warna, m.harga, m.plat, m.foto
                  FROM pemesanan p
                  LEFT JOIN pembeli pb ON p.id_pembeli = pb.id_pembeli
                  LEFT JOIN mobil m ON p.id_mobil = m.id_mobil
                  WHERE p.id_pesan = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Insert pemesanan
    public function insert($data) {
        $query = "INSERT INTO pemesanan (id_pembeli, id_mobil, tgl_psn, batas, status_psn) 
                  VALUES (:id_pembeli, :id_mobil, :tgl_psn, :batas, :status_psn)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pembeli', $data['id_pembeli']);
        $stmt->bindParam(':id_mobil', $data['id_mobil']);
        $stmt->bindParam(':tgl_psn', $data['tgl_psn']);
        $stmt->bindParam(':batas', $data['batas']);
        $stmt->bindParam(':status_psn', $data['status_psn']);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    // Update status pemesanan
    public function updateStatus($id, $status) {
        $query = "UPDATE pemesanan SET status_psn = :status WHERE id_pesan = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Insert pembayaran
    public function insertPembayaran($data) {
        $query = "INSERT INTO menu_pembayaran (id_pesan, tgl_bayar, jml_bayar, metode_bayar, jenis_bayar, status, bukti_tf) 
                  VALUES (:id_pesan, :tgl_bayar, :jml_bayar, :metode_bayar, :jenis_bayar, :status, :bukti_tf)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pesan', $data['id_pesan']);
        $stmt->bindParam(':tgl_bayar', $data['tgl_bayar']);
        $stmt->bindParam(':jml_bayar', $data['jml_bayar']);
        $stmt->bindParam(':metode_bayar', $data['metode_bayar']);
        $stmt->bindParam(':jenis_bayar', $data['jenis_bayar']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':bukti_tf', $data['bukti_tf']);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }
}
?>