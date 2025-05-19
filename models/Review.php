<?php

require_once __DIR__ . '/../config/database.php';

class Review {
    public static function add($user_id, $food_id, $comment) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO reviews (user_id, food_id, comment) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $food_id, $comment]);
    }

    public static function getAll($food_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT r.*, u.username FROM reviews r JOIN users u ON r.user_id = u.id WHERE food_id = ? ORDER BY r.created_at DESC");
        $stmt->execute([$food_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
