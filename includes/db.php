<?php
require_once __DIR__ . '/env.php';

class Database {
    private static $connection = null;
    
    public static function getConnection() {
        if (self::$connection === null) {
            $host = Environment::get('DB_HOST', '127.0.0.1');
            $port = Environment::get('DB_PORT', '5432');
            $dbname = Environment::get('DB_NAME', 'php_site');
            $user = Environment::get('DB_USER', 'postgres');
            $password = Environment::get('DB_PASS', '');
            
            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
            
            try {
                self::$connection = new PDO($dsn, $user, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
    
    public static function query($sql, $params = []) {
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
