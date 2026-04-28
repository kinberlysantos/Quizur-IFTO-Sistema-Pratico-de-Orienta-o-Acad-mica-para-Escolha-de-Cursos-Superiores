<?php

class Migration {
    public static function up() {
        try {
            $pdo = new PDO('sqlite:database.sqlite');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "CREATE TABLE IF NOT EXISTS alunos (
                id INTEGER PRIMARY KEY AUTOINCREMENT, 
                nome TEXT, 
                idade INTEGER, 
                curso TEXT
            );";

            $pdo->exec($sql);
            echo "Migração executada com sucesso! Tabela 'alunos' criada.\n";
        } catch (PDOException $e) {
            echo "Erro na migração: " . $e->getMessage() . "\n";
        }
    }
}

Migration::up();
