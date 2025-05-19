<?php
require_once __DIR__ . '/../config/Database.php';

class ForumMessage {
    public static function all() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM forum_messages ORDER BY created_at ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO forum_messages (user_name, message) VALUES (:user_name, :message)");
        $stmt->execute([
            ':user_name' => $data['user_name'],
            ':message' => $data['message'],
        ]);
        return $db->lastInsertId();
    }

    public static function delete($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM forum_messages WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
