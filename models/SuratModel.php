<?php
// models/SuratModel.php

class SuratModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua pengurusan surat
    public function getAll() {
        $query = "SELECT s.*, pj.no_faktur, p.harga, pb.nama as nama_pembeli, m.merk, m.model
                  FROM surat s
                  JOIN penjualan_mobil pj ON s.id_pj_mobil = pj.id_pj_mobil
                  JOIN pemesanan p ON pj.id_pesan = p.id_pesan
                  JOIN pembeli pb ON p.id_pembeli = pb.id_pembeli
                  JOIN mobil m ON p.id_mobil = m.id_mobil
                  ORDER BY s.tgl_urus DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Insert pengurusan surat
    public function insert($data) {
        $query = "INSERT INTO surat (id_pj_mobil, tgl_urus, tgl_selesai, status, jenis) 
                  VALUES (:id_pj_mobil, :tgl_urus, :tgl_estimasi, :status, :jenis)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pj_mobil', $data['id_pj_mobil']);
        $stmt->bindParam(':tgl_urus', $data['tgl_urus']);
        $stmt->bindParam(':tgl_estimasi', $data['tgl_estimasi']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':jenis', $data['jenis']);
        return $stmt->execute();
    }

    // Update status selesai
    public function updateSelesai($id, $tgl_selesai) {
        $query = "UPDATE surat SET status = 'selesai', tgl_selesai = :tgl_selesai WHERE id_surat = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tgl_selesai', $tgl_selesai);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>