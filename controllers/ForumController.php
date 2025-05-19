<?php
require_once __DIR__ . '/../models/ForumMessage.php';

class ForumController {
    // Halaman untuk user (tidak ada tombol hapus)
    public function userIndex() {
        $messages = ForumMessage::all();
        include __DIR__ . '/../views/user/forum/index.php';
    }

    // Halaman admin (ada tombol hapus)
    public function adminIndex() {
        $messages = ForumMessage::all();
        include __DIR__ . '/../views/admin/forum/index.php';
    }

    public function store() {
        $user_name = $_POST['user_name'] ?? '';
        $message = $_POST['message'] ?? '';

        if (empty($user_name) || empty($message)) {
            die('Nama dan pesan wajib diisi.');
        }

        ForumMessage::create([
            'user_name' => $user_name,
            'message' => $message,
        ]);

        // Redirect tergantung role, contoh cek session
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            header('Location: ?route=admin/forum');
        } else {
            header('Location: ?route=user/forum');
        }
        exit;
    }

    public function delete($id) {
        // Pastikan hanya admin yang bisa hapus
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            die('Akses ditolak.');
        }

        ForumMessage::delete($id);
        header('Location: ?route=forum/admin');
        exit;
    }
}
