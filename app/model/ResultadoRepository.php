<?php

class ResultadoRepository implements IResultadoRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function save(array $data) {
        $sql = "INSERT INTO resultados (perfil, titulo) VALUES (:perfil, :titulo)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':perfil', $data['perfil']);
        $stmt->bindValue(':titulo', $data['title']);
        return $stmt->execute();
    }
}
