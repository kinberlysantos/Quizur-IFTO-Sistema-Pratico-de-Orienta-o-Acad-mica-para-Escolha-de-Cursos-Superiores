<?php

class QuizController {
    private $service;
    private $repository;

    public function __construct(QuizService $service, ResultadoRepository $repository) {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function processar() {
        try {
            // Processa o resultado baseado no POST
            $resultado = $this->service->calcularResultado($_POST);
            
            // Salva no Banco (Model)
            $this->repository->save($resultado);
            
            // Retorna o resultado para a View
            return $resultado;
        } catch (BusinessRuleException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
