<?php
require_once __DIR__ . '/../config/Database.php';

class Food {
    public static function all() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM foods ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM foods WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO foods (name, description, price, image_url) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['name'], $data['description'], $data['price'], $data['image_url']
        ]);
    }

    public static function update($id, $data) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE foods SET name = ?, description = ?, price = ?, image_url = ? WHERE id = ?");
        return $stmt->execute([
            $data['name'], $data['description'], $data['price'], $data['image_url'], $id
        ]);
    }

    public static function delete($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM foods WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function getFoodsByIds(array $ids) {
        if (empty($ids)) {
            return [];
        }

        $db = Database::getConnection();
        // Membuat placeholder sebanyak jumlah ID
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $stmt = $db->prepare("SELECT * FROM foods WHERE id IN ($placeholders)");
        $stmt->execute($ids);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
