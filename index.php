<?php

require_once 'middleware.php';
require_once 'database.php';
require_once 'businessRuleException.php';

// Repositories
require_once 'inscricaoRepository.php';
require_once 'resultadoRepository.php';

// Services
require_once 'inscricaoService.php';
require_once 'quizService.php';

// Controllers
require_once 'inscricaoController.php';
require_once 'quizController.php';

// Routing
require_once 'router.php';

// --- CONTAINER DE INJEÇÃO DE DEPENDÊNCIA (Manual) ---
$inscricaoRepo = new InscricaoRepository();
$inscricaoService = new InscricaoService($inscricaoRepo);
$inscricaoController = new InscricaoController($inscricaoService);

$quizRepo = new ResultadoRepository();
$quizService = new QuizService();
$quizController = new QuizController($quizService, $quizRepo);

$router = new Router($quizController, $inscricaoController);

// --- ROTEAMENTO ---
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Middleware Global
if ($method === 'POST') {
    sanitizeInput();
}

$resultado = $router->route($uri, $method);

// --- RENDERIZAÇÃO DA VIEW ---
include 'view.php';
