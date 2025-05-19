<?php
require_once __DIR__ . '/../models/Promo.php';
require_once __DIR__ . '/../models/Restaurant.php'; // untuk daftar restoran

class PromoController {
    private function IsAdmin() {
        session_start(); // pastikan session aktif
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            die('Akses ditolak. Halaman ini hanya untuk admin.');
        }
    }
    public static function all() {
        $db = Database::getInstance();
        $stmt = $db->query("
            SELECT p.*, r.name AS restaurant_name 
            FROM promos p
            LEFT JOIN restaurants r ON p.restaurant_id = r.id
            ORDER BY p.start_date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function index() {
         function all() {
            $db = Database::getInstance();
            $stmt = $db->query("
                SELECT p.*, r.name AS restaurant_name 
                FROM promos p
                LEFT JOIN restaurants r ON p.restaurant_id = r.id
                ORDER BY p.start_date DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        // Ambil semua promo beserta nama restoran dari model Promo
        $promos = Promo::all();
        
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            include __DIR__ . '/../views/user/promo/index.php';
        }else{

            include __DIR__ . '/../views/admin/promo/index.php';
        }
        // Tampilkan view index promo dan kirim data promo ke view
    }

    public function create() {
        $this->IsAdmin();
        $restaurants = Restaurant::all();
        include __DIR__ . '/../views/admin/promo/create.php';
    }

    public function store() {
        $this->IsAdmin();
        $data = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'category' => $_POST['category'] ?? '',
            'restaurant_id' => $_POST['restaurant_id'] ?? '',
            'start_date' => $_POST['start_date'] ?? '',
            'end_date' => $_POST['end_date'] ?? '',
            'voucher_code' => $_POST['voucher_code'] ?? null,
        ];

        foreach (['title', 'description', 'category', 'restaurant_id', 'start_date', 'end_date'] as $field) {
            if (empty($data[$field])) {
                die("Field $field wajib diisi.");
            }
        }

        Promo::create($data);
        header('Location: ?route=admin/promo');
        exit;
    }

    public function edit($id) {
        $this->IsAdmin();
        $promo = Promo::find($id);
        $restaurants = Restaurant::all();
        include __DIR__ . '/../views/admin/promo/edit.php';
    }

    public function update($id) {
        $this->IsAdmin();
        $data = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'category' => $_POST['category'] ?? '',
            'restaurant_id' => $_POST['restaurant_id'] ?? '',
            'start_date' => $_POST['start_date'] ?? '',
            'end_date' => $_POST['end_date'] ?? '',
            'voucher_code' => $_POST['voucher_code'] ?? null,
        ];

        foreach (['title', 'description', 'category', 'restaurant_id', 'start_date', 'end_date'] as $field) {
            if (empty($data[$field])) {
                die("Field $field wajib diisi.");
            }
        }

        Promo::update($id, $data);
        header('Location: ?route=admin/promo');
        exit;
    }

    public function delete($id) {
        $this->IsAdmin();
        Promo::delete($id);
        header('Location: ?route=admin/promo');
        exit;
    }

}
