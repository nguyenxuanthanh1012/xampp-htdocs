<?php
class Database {
    private static $pdo;

    public static function connect($host, $dbname, $username, $password){
        try {
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            die("Database connection failed: " . $e->getMessage());
        }
    }
        public static function close() {
            self::$pdo = null;
        }

        public static function getPDO() {
            return self::$pdo;
        }
    
}
?>