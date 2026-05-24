<?php
// debug_login.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>DEBUG LOGIN</h1>";

// Cek koneksi database
require_once 'config/database.php';
$db = getConnection();

if ($db) {
    echo "✅ Koneksi database BERHASIL<br><br>";
} else {
    echo "❌ Koneksi database GAGAL<br>";
    exit;
}

// Cek tabel users
$query = "SHOW TABLES LIKE 'users'";
$stmt = $db->prepare($query);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "✅ Tabel 'users' DITEMUKAN<br><br>";
} else {
    echo "❌ Tabel 'users' TIDAK DITEMUKAN!<br>";
    echo "Harap buat tabel users terlebih dahulu.<br>";
    exit;
}

// Cek data di tabel users
$query = "SELECT * FROM users";
$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h3>Data di tabel users:</h3>";
if (count($users) > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Username</th><th>Password (MD5)</th><th>Role</th><th>Nama Lengkap</th></tr>";
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . $user['id'] . "</td>";
        echo "<td>" . $user['username'] . "</td>";
        echo "<td>" . $user['password'] . "</td>";
        echo "<td>" . $user['role'] . "</td>";
        echo "<td>" . $user['nama_lengkap'] . "</td>";
        echo "</tr>";
    }
    echo "</table><br>";
} else {
    echo "❌ Tabel users KOSONG!<br>";
    exit;
}

// Test login dengan MD5
echo "<h3>Test Login dengan MD5:</h3>";

$testUsername = 'admin';
$testPassword = 'admin123';

$hashedPassword = md5($testPassword);
echo "Password '$testPassword' jika di-MD5: <code>$hashedPassword</code><br>";

$query = "SELECT * FROM users WHERE username = :username AND password = MD5(:password)";
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $testUsername);
$stmt->bindParam(':password', $testPassword);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "✅ Login BERHASIL dengan username '$testUsername' dan password '$testPassword'<br>";
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($user);
    echo "</pre>";
} else {
    echo "❌ Login GAGAL dengan username '$testUsername' dan password '$testPassword'<br>";
    
    // Coba cek langsung tanpa MD5
    $query2 = "SELECT * FROM users WHERE username = :username";
    $stmt2 = $db->prepare($query2);
    $stmt2->bindParam(':username', $testUsername);
    $stmt2->execute();
    
    if ($stmt2->rowCount() > 0) {
        $user2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        echo "Username ditemukan, tapi password di database: <code>" . $user2['password'] . "</code><br>";
        echo "Password yang dimasukkan setelah MD5: <code>$hashedPassword</code><br>";
        
        if ($user2['password'] === $hashedPassword) {
            echo "✅ Password SAMA! Harusnya bisa login.<br>";
        } else {
            echo "❌ Password BERBEDA!<br>";
        }
    } else {
        echo "❌ Username '$testUsername' TIDAK DITEMUKAN di database!<br>";
    }
}

// Test User Model
echo "<h3>Test User Model:</h3>";
require_once 'models/User.php';
$userModel = new User($db);
$result = $userModel->cekLogin('admin', 'admin123');

if ($result) {
    echo "✅ User Model BERHASIL<br>";
} else {
    echo "❌ User Model GAGAL<br>";
}
?>