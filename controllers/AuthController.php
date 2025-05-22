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

    public function login() {
        $input = $_POST['usernameOrEmail'];
        $password = $_POST['password'];
    
        // Cari user berdasarkan username atau email
        $user = User::findByUsernameOrEmail($input);
    
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
    
            if ($user['role'] === 'admin') {
                header('Location: ?route=admin/dashboard');
            } else {
                header('Location: ?route=user/dashboard');
            }
            exit;
        } else {
            echo "<script>
                    alert('Login gagal! Username/email atau password salah.');
                    window.location.href = '?route=auth/login';
                  </script>";
            exit;
        }
    }
    

    public function register() {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Cek apakah username sudah dipakai
        if (User::findByUsername($username)) {
            echo "<script>
                    alert('gagal! Username sudah digunakan.');
                    window.location.href = '?route=auth/login';
                  </script>";
            exit;
        }
    
        // Cek apakah email sudah dipakai (asumsi ada method findByEmail)
        if (User::findByEmail($email)) {
            echo "<script>
                    alert(' gagal! Email sudah digunakan.');
                    window.location.href = '?route=auth/login';
                  </script>";
            exit;
        }
    
        // Buat user baru dengan username, email, dan password
        if (User::create($username, $email, $password)) {
            header('Location: ?route=auth/login');
            exit;
        } else {
            echo "<script>
                    alert(' Registrasi gagal!');
                    window.location.href = '?route=auth/login';
                  </script>";
            exit;
        }
    }
    
    

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . '?route=auth/login');
        exit;
    }
}
