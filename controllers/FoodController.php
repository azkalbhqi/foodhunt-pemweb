<?php
require_once __DIR__ . '/../models/Food.php';

class FoodController {
    private function IsAdmin() {
        session_start(); // pastikan session aktif
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            die('Akses ditolak. Halaman ini hanya untuk admin.');
        }
    }
    
    public function index() {
        $foods = Food::all();
        include __DIR__ . '/../views/admin/food/index.php';
    }

    public function create() {
        $this->IsAdmin();
        include __DIR__ . '/../views/admin/food/create.php';
    }

    public function store() {
        $this->IsAdmin();
        $imagePath = null;
    
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/food/';
            $imageName = basename($_FILES['image']['name']);
            $targetFile = $uploadDir . $imageName;
    
            // Pastikan folder ada
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $imagePath = '' . $imageName; // disimpan relatif ke public/
            } else {
                die('Gagal mengunggah gambar.');
            }
        }
    
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'image_url' => $imagePath,
        ];
    
        Food::create($data);
        header('Location: ?route=admin/food');
        exit;
    }

    public function edit($id) {
        $this->IsAdmin();
        $food = Food::find($id);
        include __DIR__ . '/../views/admin/food/edit.php';
    }
    
    public function update($id) {
        $this->IsAdmin();
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'image_url' => $_POST['image_url']
        ];
    
        Food::update($id, $data);
        header('Location: ?route=admin/food');
        exit;
    }
    
    public function delete($id) {
        $this->IsAdmin();
        Food::delete($id);
        header('Location: ?route=admin/food');
        exit;
    }
    
}
