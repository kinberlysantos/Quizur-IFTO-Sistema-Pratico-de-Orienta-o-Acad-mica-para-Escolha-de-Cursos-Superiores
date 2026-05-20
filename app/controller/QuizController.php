<?php

class QuizController {
    private $service;

    public function __construct(QuizService $service) {
        $this->service = $service;
    }

    public function processar() {
        try {
            // O Service agora cuida do cálculo e da persistência
            return $this->service->calcularResultado($_POST);
        } catch (BusinessRuleException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
