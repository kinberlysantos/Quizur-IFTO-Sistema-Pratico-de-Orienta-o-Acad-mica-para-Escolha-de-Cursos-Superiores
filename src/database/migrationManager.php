<?php

namespace App\Database;

use PDO;
use Exception;

class MigrationManager {
    private $pdo;
    private $migrationsPath;

    public function __construct(PDO $pdo, string $migrationsPath) {
        $this->pdo = $pdo;
        $this->migrationsPath = $migrationsPath;
        $this->createMigrationsTable();
    }

    private function createMigrationsTable() {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            migration_name TEXT NOT NULL,
            executed_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
    }

    public function migrate() {
        $executedMigrations = $this->getExecutedMigrations();
        $files = glob($this->migrationsPath . "/*.sql");
        sort($files);

        foreach ($files as $file) {
            $name = basename($file);
            if (!in_array($name, $executedMigrations)) {
                $sql = file_get_contents($file);
                $this->pdo->exec($sql);
                $this->saveMigration($name);
            }
        }
    }

    private function getExecutedMigrations() {
        $stmt = $this->pdo->query("SELECT migration_name FROM migrations");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    private function saveMigration($name) {
        $stmt = $this->pdo->prepare("INSERT INTO migrations (migration_name) VALUES (:name)");
        $stmt->execute(['name' => $name]);
    }
}
