<?php
require_once __DIR__ . '/../config/Database.php';  // koneksi db
class Bundling {
    public static function all() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM bundling ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM bundling WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO bundling (title, description, price, image_url, created_at) VALUES (?, ?, ?, ?, NOW())");
        $result = $stmt->execute([
            $data['title'], $data['description'], $data['price'], $data['image_url']
        ]);
        if ($result) {
            return $db->lastInsertId(); // Kembalikan id bundling yang baru dibuat
        }
        return false;
    }

    public static function update($id, $data) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE bundling SET title=?, description=?, price=?, image_url=? WHERE id=?");
        return $stmt->execute([
            $data['title'], $data['description'], $data['price'], $data['image_url'], $id
        ]);
    }

    public static function delete($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM bundling WHERE id=?");
        return $stmt->execute([$id]);
    }

    public static function getBundleItems($bundle_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            SELECT foods.* FROM bundle_items 
            JOIN foods ON bundle_items.food_id = foods.id
            WHERE bundle_items.bundle_id = ?
        ");
        $stmt->execute([$bundle_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function setBundleItems($bundle_id, $food_ids) {
        $db = Database::getConnection();

        // Hapus item lama
        $stmtDel = $db->prepare("DELETE FROM bundle_items WHERE bundle_id = ?");
        $stmtDel->execute([$bundle_id]);

        // Insert item baru
        $stmtIns = $db->prepare("INSERT INTO bundle_items (bundle_id, food_id) VALUES (?, ?)");
        foreach ($food_ids as $food_id) {
            $stmtIns->execute([$bundle_id, $food_id]);
        }
        return true;
    }
}
