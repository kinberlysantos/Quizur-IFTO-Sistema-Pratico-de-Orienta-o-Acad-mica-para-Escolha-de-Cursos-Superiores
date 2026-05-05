<?php

require_once 'database.php';

class ResultadoRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->createTable();
    }

    private function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS resultados (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            perfil INTEGER,
            titulo TEXT,
            timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $this->db->exec($sql);
    }

    public function save(array $data) {
        $sql = "INSERT INTO resultados (perfil, titulo) VALUES (:perfil, :titulo)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':perfil', $data['perfil']);
        $stmt->bindValue(':titulo', $data['title']);
        return $stmt->execute();
    }
}
