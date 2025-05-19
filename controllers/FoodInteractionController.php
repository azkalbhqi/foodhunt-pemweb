<?php

require_once __DIR__ . '/../models/Wishlist.php';
require_once __DIR__ . '/../models/Rating.php';
require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../models/Food.php';

class FoodInteraction {
    public function userIndex() {
        $foods = Food::all();
        $user_id = $_SESSION['user_id'];
    
        // Ambil semua wishlist user
        $wishlist_items = Wishlist::getByUser($user_id);
        $wishlist_ids = array_column($wishlist_items, 'food_id');
        // Ambil rating user untuk tiap makanan (opsional)
        $average_rating = [];
       
        // Ambil komentar untuk semua makanan
        $comments = [];
        foreach ($foods as &$food) {
            // Asumsi ada method getAverageByFoodId di model Rating
            $average_ratings[$food['id']] = Rating::getAverageByFoodId($food['id']);
            $food['comments'] = Review::getAll($food['id']);
        }
    
        include __DIR__ . '/../views/user/food/index.php';
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
    
}
