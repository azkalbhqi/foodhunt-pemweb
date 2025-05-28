<?php
require_once __DIR__ . '/../models/Promo.php';
require_once __DIR__ . '/../models/Restaurant.php'; // untuk daftar restoran

class PromoController {

    // Fungsi untuk cek apakah user adalah admin
    private function IsAdmin() {
        if(session_status() === PHP_SESSION_NONE) {
            session_start(); // pastikan session aktif
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            die('Akses ditolak. Halaman ini hanya untuk admin.');
        }
    }

    // Menampilkan daftar promo (admin dan user berbeda view)
    public function index() {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Ambil semua promo beserta nama restoran
        $promos = Promo::all();

        // Jika user admin tampilkan view admin, selain itu user biasa
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $headTitles = "Promo";
            include __DIR__ . '/../views/user/promo/index.php';
        } else {
            $headTitles = "Admin Promo";
            include __DIR__ . '/../views/admin/promo/index.php';
        }
    }

    // Menampilkan form buat promo baru (admin only)
    public function create() {
        $this->IsAdmin();
        $restaurants = Restaurant::all();
        $headTitles = "Tambah Promo";
        include __DIR__ . '/../views/admin/promo/create.php';
    }

    // Menyimpan data promo baru (admin only)
    public function store() {
        $this->IsAdmin();

        // Ambil data dari form POST
        $data = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'category' => $_POST['category'] ?? '',
            'restaurant_id' => $_POST['restaurant_id'] ?? '',
            'start_date' => $_POST['start_date'] ?? '',
            'end_date' => $_POST['end_date'] ?? '',
            'voucher_code' => $_POST['voucher_code'] ?? null,
        ];

        // Validasi wajib isi field
        foreach (['title', 'description', 'category', 'restaurant_id', 'start_date', 'end_date'] as $field) {
            if (empty($data[$field])) {
                die("Field $field wajib diisi.");
            }
        }

        // Simpan promo ke database lewat model
        Promo::create($data);

        // Redirect ke daftar promo admin
        header('Location: ?route=admin/promo');
        exit;
    }

    // Menampilkan form edit promo (admin only)
    public function edit($id) {
        $this->IsAdmin();

        // Cari promo berdasar id
        $promo = Promo::find($id);
        $restaurants = Restaurant::all();
        $headTitles = "Edit Promo";
        include __DIR__ . '/../views/admin/promo/edit.php';
    }

    // Update data promo (admin only)
    public function update($id) {
        $this->IsAdmin();

        // Ambil data dari form POST
        $data = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'category' => $_POST['category'] ?? '',
            'restaurant_id' => $_POST['restaurant_id'] ?? '',
            'start_date' => $_POST['start_date'] ?? '',
            'end_date' => $_POST['end_date'] ?? '',
            'voucher_code' => $_POST['voucher_code'] ?? null,
        ];

        // Validasi wajib isi field
        foreach (['title', 'description', 'category', 'restaurant_id', 'start_date', 'end_date'] as $field) {
            if (empty($data[$field])) {
                die("Field $field wajib diisi.");
            }
        }

        // Update promo lewat model
        Promo::update($id, $data);

        // Redirect ke daftar promo admin
        header('Location: ?route=admin/promo');
        exit;
    }

    // Hapus promo (admin only)
    public function delete($id) {
        $this->IsAdmin();

        Promo::delete($id);

        header('Location: ?route=admin/promo');
        exit;
    }
}
