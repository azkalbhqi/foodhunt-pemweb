<?php
require_once __DIR__ . '/../config/Database.php';

class User {
    public static function findByUsername($username) {
        $pdo = Database::getConnection(); // GANTI DARI: global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($username, $password, $role = 'user') {
        $pdo = Database::getConnection(); // GANTI DARI: global $pdo;
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $hash, $role]);
    }
}
