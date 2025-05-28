<?php

require_once __DIR__ . '/../models/Wishlist.php';
require_once __DIR__ . '/../models/Rating.php';
require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../models/Food.php';

class FoodInteraction {

    private function IsAdmin() {
        session_start(); // pastikan session aktif
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            die('Akses ditolak. Halaman ini hanya untuk admin.');
        }
    }
    
    public function userIndex() {
        $foods = Food::all();
        $user_id = $_SESSION['user_id'];
    
        // Ambil semua wishlist user
        $wishlist_items = Wishlist::getByUser($user_id);
        $wishlist_ids = array_column($wishlist_items, 'food_id');
    
        // Ambil rating dan komentar
        $average_ratings = [];
    
        foreach ($foods as &$food) {
            $average_ratings[$food['id']] = Rating::getAverageByFoodId($food['id']);
            $food['comments'] = Review::getAll($food['id']);
        }
        unset($food); // penting saat foreach pakai referensi
    
        include __DIR__ . '/../views/user/food/index.php';
    }

    public function adminIndex(){
        $foods = Food::all();
        $user_id = $_SESSION['user_id'];
    
        // Ambil semua wishlist user
        $wishlist_items = Wishlist::getByUser($user_id);
        $wishlist_ids = array_column($wishlist_items, 'food_id');
    
        // Ambil rating dan komentar
        $average_ratings = [];
    
        foreach ($foods as &$food) {
            $average_ratings[$food['id']] = Rating::getAverageByFoodId($food['id']);
            $food['comments'] = Review::getAll($food['id']);
        }
        unset($food); // penting saat foreach pakai referensi
    
        include __DIR__ . '/../views/admin/food/index.php';
    
    }
    

    public function toggleWishlist() {
        $user_id = $_SESSION['user_id'];
        $food_id = $_POST['food_id'];

        if (Wishlist::exists($user_id, $food_id)) {
            Wishlist::remove($user_id, $food_id);
        } else {
            Wishlist::add($user_id, $food_id);
        }

        header('Location: ?route=user/food/show/' . $food_id);
        exit;
    }

    public function rate() {
        $user_id = $_SESSION['user_id'];
        $food_id = $_POST['food_id'];
        $rating = $_POST['rating'];

        Rating::set($user_id, $food_id, $rating);
        header('Location: ?route=user/food/show/' . $food_id);
        exit;
    }

    public function comment() {
        $user_id = $_SESSION['user_id'];
        $food_id = $_POST['food_id'];
        $comment = $_POST['comment'];

        Review::add($user_id, $food_id, $comment);
        header('Location: ?route=user/food/show/' . $food_id);
        exit;
    }

    public function userShow($id) {
        $food = Food::find($id);
        $user_id = $_SESSION['user_id'];
    
        $is_wishlisted = Wishlist::exists($user_id, $id);
        $average_rating = Rating::getAverage($id);
        $user_rating = Rating::getUserRating($user_id, $id);
        $reviews = Review::getAll($id);
    
        include __DIR__ . '/../views/user/food/show.php';
    }

    public function edit($id) {
        $this->IsAdmin();
    
        $food = Food::find($id);
    
        // Ambil semua review makanan
        $reviews = Review::getAll($id);
    
        // Ambil semua wishlist yang mengandung makanan ini
        $wishlists = Wishlist::getByFoodId($id); // Pastikan fungsi ini ada di model Wishlist
    
        include __DIR__ . '/../views/admin/food/edit.php';
    }

    public function deleteReview() {
        if (!isset($_POST['review_id'])) {
            die('ID review tidak valid');
        }

        $review_id = $_POST['review_id'];
        $redirect_id = $_POST['redirect_food_id'] ?? null;

        Review::deleteById($review_id);

        if ($redirect_id) {
            header("Location: ?route=admin/food/edit/$redirect_id");
        } else {
            header("Location: ?route=admin/food");
        }
        exit;
    }

    public function deleteWishlist() {
        if (!isset($_POST['wishlist_id'])) {
            die('ID wishlist tidak valid');
        }

        $wishlist_id = $_POST['wishlist_id'];
        $redirect_id = $_POST['redirect_food_id'] ?? null;

        Wishlist::deleteById($wishlist_id);

        if ($redirect_id) {
            header("Location: ?route=admin/food/edit/$redirect_id");
        } else {
            header("Location: ?route=admin/food");
        }
        exit;
    }
    
    
}
