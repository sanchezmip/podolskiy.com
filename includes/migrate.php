<?php
require_once __DIR__ . '/db.php';

class Migration {
    private $db;
    
    public function __construct() {
        $this->db = Database::getConnection();
        $this->ensureMigrationsTable();
    }
    
    private function ensureMigrationsTable() {
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS migrations (
                id SERIAL PRIMARY KEY,
                migration_name VARCHAR(255) NOT NULL UNIQUE,
                applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");
    }
    
    public function run() {
        $files = glob(__DIR__ . '/../migrations/*.sql');
        sort($files);
        
        $stmt = $this->db->query("SELECT migration_name FROM migrations");
        $applied = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        foreach ($files as $file) {
            $name = basename($file);
            if (!in_array($name, $applied)) {
                echo "Applying: $name\n";
                $sql = file_get_contents($file);
                $this->db->exec($sql);
                $stmt = $this->db->prepare("INSERT INTO migrations (migration_name) VALUES (?)");
                $stmt->execute([$name]);
                echo "✓ Applied\n";
            }
        }
    }
}

$migration = new Migration();
$migration->run();
