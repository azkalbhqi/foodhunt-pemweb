<?php
require_once __DIR__ . '/../models/Wishlist.php';
require_once __DIR__ . '/../models/Food.php'; // Pastikan model Food juga di-require

class WishlistList { // Nama class yang lebih deskriptif

    protected $wishlistModel;
    protected $foodModel;

    public function __construct()
    {
        $this->wishlistModel = new Wishlist(); // Inisialisasi model Wishlist
        $this->foodModel = new Food(); // Inisialisasi model Food
    }

    public function index()
    {
        // Pastikan sesi sudah dimulai di bagian atas file yang memanggil controller ini
        if (!isset($_SESSION['user_id'])) {
            // Handle jika user belum login, misalnya redirect ke halaman login
            header('Location: ?route=auth/login');
            exit;
        }

        $userId = $_SESSION['user_id'];

        // 1. Dapatkan ID makanan dari wishlist user
        $wishlistItemIds = $this->wishlistModel->getUserWishlistIds($userId);

        $wishlistFoods = [];
        if (!empty($wishlistItemIds)) {
            // 2. Gunakan model Food untuk mendapatkan detail makanan berdasarkan ID
            $wishlistFoods = $this->foodModel->getFoodsByIds($wishlistItemIds);
        }

        include __DIR__ . '/../views/user/wishlist/index.php';
    }

    public function remove()
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: ?route=auth/login');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['food_id'])) {
        $userId = $_SESSION['user_id'];
        $foodId = $_POST['food_id'];
        $this->wishlistModel->removeFromWishlist($userId, $foodId);
    }

    // Redirect back to wishlist page
    header('Location: ?route=user/wishlist');
    exit;
}

}