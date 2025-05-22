<?php
require_once __DIR__ . '/../models/User.php';

class ProfileController {
    public function show() {
        if (!isset($_SESSION['user'])) {
            header('Location: ?route=auth/login');
            exit;
        }

        $user = User::findByUsername($_SESSION['user']);
        include __DIR__ . '/../views/user/profile/index.php';
    }

    public function update() {
        if (!isset($_SESSION['user'])) {
            header('Location: ?route=auth/login');
            exit;
        }

        $userData = User::findByUsername($_SESSION['user']);
        $id = $userData['id'];

        $username = $_POST['username'];
        $password = $_POST['password'];

        $data = ['username' => $username];

        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if (User::update($id, $data)) {
            $_SESSION['success'] = 'Profil berhasil diperbarui.';
        } else {
            $_SESSION['error'] = 'Gagal memperbarui profil.';
        }

        header('Location: ?route=user/profile');
    }
}
