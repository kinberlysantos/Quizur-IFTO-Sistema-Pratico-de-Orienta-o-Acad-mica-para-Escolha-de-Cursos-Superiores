<?php

interface IInscricaoRepository {
    public function save(array $data);
    public function find(int $id);
    public function delete(int $id);
    public function findAll();
}
