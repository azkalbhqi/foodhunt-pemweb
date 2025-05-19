<?php
require_once __DIR__ . '/../models/Bundling.php';
require_once __DIR__ . '/../models/Food.php'; // model makanan


class BundlingController {
    private function IsAdmin() {
        session_start(); 
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            die('Akses ditolak. Halaman ini hanya untuk admin.');
        }
    }

    public function index() {
        $bundles = Bundling::all();
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
            
            include __DIR__ . '/../views/user/bundling/index.php';
        }else{
            
            include __DIR__ . '/../views/admin/bundling/index.php';
        }
    }

    public function create() {
        $this->IsAdmin();
        $foods = Food::all(); // ambil daftar makanan untuk dipilih
        include __DIR__ . '/../views/admin/bundling/create.php';
    }

    public function store() {
        $this->IsAdmin();
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $food_ids = $_POST['food_ids'] ?? [];
    
        // Upload gambar
        $image_url = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/uploads/';
    
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
    
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = basename($_FILES['image']['name']);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
            $allowedExts = ['jpg', 'jpeg', 'png'];
            if (!in_array($fileExt, $allowedExts)) {
                die('Format file tidak diperbolehkan. Hanya jpg, jpeg, png.');
            }
    
            $newFileName = uniqid('bundle_', true) . '.' . $fileExt;
            $destPath = $uploadDir . $newFileName;
    
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $image_url = '' . $newFileName;
            } else {
                die('Gagal meng-upload gambar.');
            }
        } else {
            die('Gambar wajib diupload.');
        }
    
        // **Tangkap return dari create() yang berisi lastInsertId**
        $last_id = Bundling::create(compact('title', 'description', 'price', 'image_url'));
    
        if (!$last_id) {
            die('Gagal menyimpan paket bundling.');
        }
    
        Bundling::setBundleItems($last_id, $food_ids);
    
        header('Location: ?route=admin/bundling');
        exit;
    }
    

    public function edit($id) {
        $this->IsAdmin();
        $bundle = Bundling::find($id);
        $foods = Food::all();
        $bundleItems = Bundling::getBundleItems($id);
        $bundleItemIds = array_column($bundleItems, 'id');
        include __DIR__ . '/../views/admin/bundling/edit.php';
    }

    public function update($id) {
        $this->IsAdmin();
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image_url = $_POST['image_url'];

        $food_ids = $_POST['food_ids'] ?? [];

        Bundling::update($id, compact('title', 'description', 'price', 'image_url'));
        Bundling::setBundleItems($id, $food_ids);

        header('Location: ?route=admin/bundling');
        exit;
    }

    public function delete($id) {
        $this->IsAdmin();
        Bundling::delete($id);
        header('Location: ?route=admin/bundling');
        exit;
    }

    private function getLastInsertId() {
        $db = Database::getConnection();
        return $db->lastInsertId();
    }

    // Untuk user bisa lihat daftar paket
    public function userIndex() {
        $bundles = Bundling::all();
        include __DIR__ . '/../views/user/bundling/index.php';
    }

    // User lihat detail paket
    public function userShow($id) {
        $bundle = Bundling::find($id);
        $items = Bundling::getBundleItems($id);
        include __DIR__ . '/../views/user/bundling/show.php';
    }
}
