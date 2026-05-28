<?php
// models/PengirimanModel.php

class PengirimanModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Insert pengiriman
    public function insert($data) {
        $query = "INSERT INTO opsi_pengiriman (id_pj_mobil, jenis, status) 
                  VALUES (:id_pj_mobil, :jenis, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pj_mobil', $data['id_pj_mobil']);
        $stmt->bindParam(':jenis', $data['jenis']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    // Insert surat jalan
    public function insertSuratJalan($id_pengiriman, $alamat) {
        $query = "INSERT INTO surat_jalan (id_pengiriman, tgl_cetak, alamat_tujuan) 
                  VALUES (:id_pengiriman, :tgl_cetak, :alamat_tujuan)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pengiriman', $id_pengiriman);
        $tgl_cetak = date('Y-m-d');
        $stmt->bindParam(':tgl_cetak', $tgl_cetak);
        $stmt->bindParam(':alamat_tujuan', $alamat);
        return $stmt->execute();
    }

    // Get surat jalan
    public function getSuratJalan($id_pengiriman) {
        $query = "SELECT sj.*, pj.no_faktur, pb.nama as nama_pembeli, pb.alamat, m.merk, m.model, m.plat
                  FROM surat_jalan sj
                  JOIN opsi_pengiriman op ON sj.id_pengiriman = op.id_pengiriman
                  JOIN penjualan_mobil pj ON op.id_pj_mobil = pj.id_pj_mobil
                  JOIN pemesanan p ON pj.id_pesan = p.id_pesan
                  JOIN pembeli pb ON p.id_pembeli = pb.id_pembeli
                  JOIN mobil m ON p.id_mobil = m.id_mobil
                  WHERE sj.id_pengiriman = :id_pengiriman";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pengiriman', $id_pengiriman);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
?>