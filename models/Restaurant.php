<?php
require_once __DIR__ . '/../config/Database.php';

class Restaurant {
    public static function all() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM restaurants");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM restaurants WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO restaurants (name, address, phone, email, description, image_url) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['name'], 
            $data['address'], 
            $data['phone'], 
            $data['email'], 
            $data['description'], 
            $data['image_url']
        ]);
    }

    public static function update($id, $data) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE restaurants SET name=?, address=?, phone=?, email=?, description=?, image_url=? WHERE id=?");
        $stmt->execute([
            $data['name'], 
            $data['address'], 
            $data['phone'], 
            $data['email'], 
            $data['description'], 
            $data['image_url'], 
            $id
        ]);
    }

    public static function delete($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM restaurants WHERE id = ?");
        $stmt->execute([$id]);
    }
}
