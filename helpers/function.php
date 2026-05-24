<?php
// helpers/function.php

function base_url($path = '') {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $folder = '/carpoint';
    
    return $protocol . '://' . $host . $folder . '/' . ltrim($path, '/');
}

function site_url($path = '') {
    return base_url('index.php?page=' . ltrim($path, '/'));
}

function redirect($url) {
    header('Location: ' . base_url($url));
    exit;
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function is_owner() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'owner';
}
?>