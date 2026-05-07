<?php

require_once 'iInscricaoRepository.php';
require_once 'database.php';

class InscricaoRepository implements IInscricaoRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function save(array $data) {
        $sql = "INSERT INTO inscricoes (nome, email, curso) VALUES (:nome, :email, :curso)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $data['nome']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':curso', $data['curso'] ?? null);
        return $stmt->execute();
    }

    public function find(int $id) {
        $stmt = $this->db->prepare("SELECT * FROM inscricoes WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete(int $id) {
        $stmt = $this->db->prepare("DELETE FROM inscricoes WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function findAll() {
        return $this->db->query("SELECT * FROM inscricoes ORDER BY timestamp DESC")->fetchAll(PDO::FETCH_ASSOC);
    }
}
