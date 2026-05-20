<?php

class InscricaoService {
    private $repository;

    // INJEÇÃO DE DEPENDÊNCIA: Recebe a interface no construtor
    public function __construct(IInscricaoRepository $repository) {
        $this->repository = $repository;
    }

    public function registrar(array $data) {
        // Regras de Negócio
        if (empty($data['nome']) || strlen($data['nome']) < 3) {
            throw new BusinessRuleException("O nome deve ter pelo menos 3 caracteres.");
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new BusinessRuleException("E-mail inválido.");
        }

        // Salva via Repositório
        return $this->repository->save($data);
    }
}
