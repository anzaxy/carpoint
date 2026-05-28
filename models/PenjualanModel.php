<?php
// models/PenjualanModel.php

class PenjualanModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil pesanan aktif (booking_dibayar dan dp_lunas)
    public function getPesananAktif() {
        $query = "SELECT p.*, pb.nama as nama_pembeli, pb.NIK, pb.alamat, pb.hp,
                  m.merk, m.model, m.tahun, m.warna, m.harga, m.plat,
                  (SELECT SUM(jml_bayar) FROM menu_pembayaran WHERE id_pesan = p.id_pesan AND jenis_bayar = 'dp') as dp_terbayar
                  FROM pemesanan p
                  JOIN pembeli pb ON p.id_pembeli = pb.id_pembeli
                  JOIN mobil m ON p.id_mobil = m.id_mobil
                  WHERE p.status_psn IN ('booking_dibayar', 'dp_lunas')
                  ORDER BY p.tgl_psn ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
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
        return $stmt->execute();
    }

    // Insert penjualan
    public function insertPenjualan($data) {
        $query = "INSERT INTO penjualan_mobil (id_pesan, no_faktur, tgl_pj_mobil, harga_jual, dp_dibayar, sisa_pembayaran, status_penjualan) 
                  VALUES (:id_pesan, :no_faktur, :tgl_penjualan, :harga_jual, :dp_dibayar, :sisa_pembayaran, :status_penjualan)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pesan', $data['id_pesan']);
        $stmt->bindParam(':no_faktur', $data['no_faktur']);
        $stmt->bindParam(':tgl_penjualan', $data['tgl_penjualan']);
        $stmt->bindParam(':harga_jual', $data['harga_jual']);
        $stmt->bindParam(':dp_dibayar', $data['dp_dibayar']);
        $stmt->bindParam(':sisa_pembayaran', $data['sisa_pembayaran']);
        $stmt->bindParam(':status_penjualan', $data['status_penjualan']);
        return $stmt->execute();
    }

    // Get penjualan by id_pesan
    public function getPenjualanByPesan($id_pesan) {
        $query = "SELECT * FROM penjualan_mobil WHERE id_pesan = :id_pesan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pesan', $id_pesan);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Update status penjualan
    public function updateStatusPenjualan($id_pesan, $status, $sisa = 0) {
        $query = "UPDATE penjualan_mobil SET status_penjualan = :status, sisa_pembayaran = :sisa WHERE id_pesan = :id_pesan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':sisa', $sisa);
        $stmt->bindParam(':id_pesan', $id_pesan);
        return $stmt->execute();
    }

    // Get data untuk kwitansi
    public function getDataKwitansi($id_pesan) {
        $query = "SELECT 
                    p.*, 
                    pb.nama as nama_pembeli, pb.NIK, pb.alamat, pb.hp,
                    m.merk, m.model, m.tahun, m.warna, m.harga, m.plat,
                    pj.no_faktur, pj.tgl_pj_mobil, pj.harga_jual, pj.dp_dibayar, pj.sisa_pembayaran,
                    (SELECT tgl_bayar FROM menu_pembayaran WHERE id_pesan = p.id_pesan AND jenis_bayar = 'dp' ORDER BY id_bayar DESC LIMIT 1) as tgl_dp,
                    (SELECT tgl_bayar FROM menu_pembayaran WHERE id_pesan = p.id_pesan AND jenis_bayar = 'pelunasan' ORDER BY id_bayar DESC LIMIT 1) as tgl_pelunasan
                  FROM pemesanan p
                  JOIN pembeli pb ON p.id_pembeli = pb.id_pembeli
                  JOIN mobil m ON p.id_mobil = m.id_mobil
                  JOIN penjualan_mobil pj ON p.id_pesan = pj.id_pesan
                  WHERE p.id_pesan = :id_pesan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pesan', $id_pesan);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Ambil penjualan untuk pengurusan surat
public function getPenjualanForSurat() {
    $query = "SELECT pj.*, pb.nama as nama_pembeli, m.merk, m.model
              FROM penjualan_mobil pj
              JOIN pemesanan p ON pj.id_pesan = p.id_pesan
              JOIN pembeli pb ON p.id_pembeli = pb.id_pembeli
              JOIN mobil m ON p.id_mobil = m.id_mobil
              WHERE pj.status_penjualan IN ('dp_lunas', 'proses_stnk', 'proses_bpkb')
              ORDER BY pj.tgl_pj_mobil DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

// Ambil penjualan untuk pengiriman
public function getPenjualanForPengiriman() {
    $query = "SELECT pj.*, pb.nama as nama_pembeli, pb.alamat as alamat_pembeli, m.merk, m.model, m.plat,
              op.id_pengiriman, op.jenis as jenis_pengiriman
              FROM penjualan_mobil pj
              JOIN pemesanan p ON pj.id_pesan = p.id_pesan
              JOIN pembeli pb ON p.id_pembeli = pb.id_pembeli
              JOIN mobil m ON p.id_mobil = m.id_mobil
              LEFT JOIN opsi_pengiriman op ON pj.id_pj_mobil = op.id_pj_mobil
              WHERE pj.status_penjualan = 'lunas'
              ORDER BY pj.tgl_pj_mobil DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

// Update status penjualan by id_pj_mobil
public function updateStatusPenjualanById($id_pj_mobil, $status) {
    $query = "UPDATE penjualan_mobil SET status_penjualan = :status WHERE id_pj_mobil = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id_pj_mobil);
    return $stmt->execute();
}
}
?>