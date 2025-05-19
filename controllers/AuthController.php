<?php
require_once __DIR__ . '/../models/User.php';

define('BASE_URL', dirname($_SERVER['PHP_SELF']));

class AuthController {
    public function showLogin() {
        include __DIR__ . '/../views/auth/login.php';
    }

    public function showRegister() {
        include __DIR__ . '/../views/auth/register.php';
    }

    public function login()
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Misal pakai User::findByUsername
    $user = User::findByUsername($username);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role']; // <-- penting untuk routing admin

        if ($user['role'] === 'admin') {
            header('Location: ?route=admin/dashboard');
        } else {
            header('Location: ?route=user/dashboard');
        }
        exit;
    } else {
        echo "Login gagal!";
    }
}

    public function register() {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        if (User::findByUsername($username)) {
            // Username sudah dipakai, tampil pesan dan tombol kembali
            echo "<p>Username sudah digunakan.</p>";
            echo '<button onclick="window.history.back()">Kembali</button>';
            return;
        }
    
        if (User::create($username, $password)) {
            // Registrasi sukses, redirect ke login
            header('Location: ?route=auth/login');
            exit;
        } else {
            echo "<p>Registrasi gagal.</p>";
            echo '<button onclick="window.history.back()">Kembali</button>';
        }
    }
    

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . '?route=auth/login');
        exit;
    }
}
