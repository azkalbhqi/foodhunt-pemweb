<?php
class Database {
    private static $host = 'localhost';
    private static $db   = 'foodhunt'; // ganti sesuai nama database
    private static $user = 'root';     // ganti jika bukan root
    private static $pass = '';         // ganti jika ada password
    private static $charset = 'utf8mb4';

    public static function getConnection() {
        $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;
        try {
            $pdo = new PDO($dsn, self::$user, self::$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Database Connection Failed: " . $e->getMessage());
        }
    }
}
