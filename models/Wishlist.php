<?php

require_once __DIR__ . '/../config/database.php';

class Wishlist {
    public static function add($user_id, $food_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO wishlists (user_id, food_id) VALUES (?, ?)");
        return $stmt->execute([$user_id, $food_id]);
    }

    public static function remove($user_id, $food_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM wishlists WHERE user_id = ? AND food_id = ?");
        return $stmt->execute([$user_id, $food_id]);
    }

    public static function exists($user_id, $food_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM wishlists WHERE user_id = ? AND food_id = ?");
        $stmt->execute([$user_id, $food_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByUser($user_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            SELECT f.*
            FROM wishlists w
            JOIN foods f ON w.food_id = f.id
            WHERE w.user_id = ?
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getUserWishlistIds($user_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT food_id FROM wishlists WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'food_id');
    }

    public function removeFromWishlist($userId, $foodId)
{
    $db = Database::getConnection();
    $stmt = $db->prepare("DELETE FROM wishlists WHERE user_id = ? AND food_id = ?");
    return $stmt->execute([$userId, $foodId]);
}

    
    
}
