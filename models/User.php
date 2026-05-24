<?php
// models/User.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function cekLogin($username, $password) {
        $query = "SELECT * FROM `user` WHERE username = :username AND password = MD5(:password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function updateLastLogin($id) {
        $query = "UPDATE `user` SET last_login = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>