<?php
// controllers/Auth.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/database.php';
require_once 'models/User.php';
require_once 'helpers/function.php';

class Auth {
    private $db;
    private $userModel;

    public function __construct() {
        $this->db = getConnection();
        $this->userModel = new User($this->db);
    }

    public function login() {
        require_once 'views/login.php';
    }

    public function prosesLogin() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->cekLogin($username, $password);

        if ($user) {
            $this->userModel->updateLastLogin($user['id']);
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nama'] = $user['username'];

            if ($user['role'] === 'admin') {
                header('Location: ' . base_url('index.php?page=admin/dashboard'));
                exit;
            } else {
                header('Location: ' . base_url('index.php?page=owner/dashboard'));
                exit;
            }
        } else {
            $_SESSION['error'] = 'Username atau password salah!';
            header('Location: ' . base_url('index.php?page=login'));
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . base_url('index.php?page=login'));
        exit;
    }
}
?>