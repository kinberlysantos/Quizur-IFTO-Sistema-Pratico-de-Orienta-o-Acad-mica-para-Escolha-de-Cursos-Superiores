<?php

require_once 'CreateInscricoesTable.php';
require_once 'CreateResultadosTable.php';

class MigrationManager {
    private $pdo;
    private $migrations = [
        'CreateInscricoesTable' => '001_create_inscricoes_table',
        'CreateResultadosTable' => '002_create_resultados_table'
    ];

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
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

        foreach ($this->migrations as $className => $name) {
            if (!in_array($name, $executedMigrations)) {
                $migration = new $className();
                $migration->up($this->pdo);
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
