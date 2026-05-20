<?php

class Router {
    private $quizController;
    private $inscricaoController;

    public function __construct($quizController, $inscricaoController) {
        $this->quizController = $quizController;
        $this->inscricaoController = $inscricaoController;
    }

    public function route($uri, $method) {
        if ($method === 'POST') {
            if (strpos($uri, 'finalizar') !== false) {
                return $this->quizController->processar();
            }
            if (strpos($uri, 'registrar') !== false) {
                $this->inscricaoController->store();
                exit;
            }
        }
        return null;
    }
}
