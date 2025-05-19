<?php

require_once __DIR__ . '/../config/database.php';

class Rating {
    public static function set($user_id, $food_id, $rating) {
        $db = Database::getConnection();
        $stmt = $db->prepare("REPLACE INTO ratings (user_id, food_id, rating) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $food_id, $rating]);
    }

    public static function getAverage($food_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT AVG(rating) as avg_rating FROM ratings WHERE food_id = ?");
        $stmt->execute([$food_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['avg_rating'];
    }

    public static function getAverageByFoodId($food_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT AVG(rating) AS average FROM ratings WHERE food_id = ?");
        $stmt->execute([$food_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['average'] ?? 0; // Mengembalikan 0 jika tidak ada rating
    }

    public static function getUserRating($user_id, $food_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT rating FROM ratings WHERE user_id = ? AND food_id = ?");
        $stmt->execute([$user_id, $food_id]);
        return $stmt->fetchColumn();
    }

    public static function getByUser($user_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM ratings WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
