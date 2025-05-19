<?php
require_once __DIR__ . '/../config/Database.php';

class Event {
    public static function all() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM events ORDER BY event_date ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO events (title, event_date, location, description) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['title'], $data['event_date'], $data['location'], $data['description']
        ]);
    }

    public static function update($id, $data) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE events SET title=?, event_date=?, location=?, description=? WHERE id=?");
        return $stmt->execute([
            $data['title'], $data['event_date'], $data['location'], $data['description'], $id
        ]);
    }

    public static function delete($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM events WHERE id=?");
        return $stmt->execute([$id]);
    }
}
