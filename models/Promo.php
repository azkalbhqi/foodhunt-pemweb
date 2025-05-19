<?php
require_once __DIR__ . '/../config/Database.php';

class Promo {
    public static function all() {
        $db = Database::getConnection();
        $stmt = $db->query("
            SELECT p.*, r.name AS restaurant_name 
            FROM promos p
            LEFT JOIN restaurants r ON p.restaurant_id = r.id
            ORDER BY p.start_date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM promos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO promos (title, description, category, restaurant_id, start_date, end_date, voucher_code) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['title'], 
            $data['description'], 
            $data['category'], 
            $data['restaurant_id'], 
            $data['start_date'], 
            $data['end_date'], 
            $data['voucher_code']
        ]);
    }

    public static function update($id, $data) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE promos SET title=?, description=?, category=?, restaurant_id=?, start_date=?, end_date=?, voucher_code=? WHERE id=?");
        $stmt->execute([
            $data['title'], 
            $data['description'], 
            $data['category'], 
            $data['restaurant_id'], 
            $data['start_date'], 
            $data['end_date'], 
            $data['voucher_code'], 
            $id
        ]);
    }

    public static function delete($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM promos WHERE id = ?");
        $stmt->execute([$id]);
    }

    
}
