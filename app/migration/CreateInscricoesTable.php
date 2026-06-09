<?php

require_once 'MigrationInterface.php';

class CreateInscricoesTable implements MigrationInterface {
    public function up(PDO $pdo): void {
        $pdo->exec("CREATE TABLE IF NOT EXISTS inscricoes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT NOT NULL,
            email TEXT NOT NULL,
            curso TEXT,
            timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
    }

    public function down(PDO $pdo): void {
        $pdo->exec("DROP TABLE IF EXISTS inscricoes");
    }
}
