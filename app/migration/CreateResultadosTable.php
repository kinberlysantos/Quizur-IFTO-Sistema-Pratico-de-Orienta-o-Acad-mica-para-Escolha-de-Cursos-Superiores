<?php

require_once 'MigrationInterface.php';

class CreateResultadosTable implements MigrationInterface {
    public function up(PDO $pdo): void {
        $pdo->exec("CREATE TABLE IF NOT EXISTS resultados (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            perfil INTEGER,
            titulo TEXT,
            timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
    }

    public function down(PDO $pdo): void {
        $pdo->exec("DROP TABLE IF EXISTS resultados");
    }
}
