<?php
// config/database.php

class Database {
    private $host = "localhost";
    private $dbname = "db_apsi";      // ← nama database
    private $username = "root";        // ← user MySQL
    private $password = "";            // ← password MySQL (kosong jika XAMPP)
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
        return $this->conn;
    }
}

function getConnection() {
    $database = new Database();
    return $database->getConnection();
}
?>