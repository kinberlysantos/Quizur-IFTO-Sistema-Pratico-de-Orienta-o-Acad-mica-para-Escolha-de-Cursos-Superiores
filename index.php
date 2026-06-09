<?php
require_once 'config.php';
require_once 'autoload.php';

// --- CONTAINER DE INJEÇÃO DE DEPENDÊNCIA (Manual) ---
$pdo = Database::getInstance();

// Executar Migrations
$migrationManager = new MigrationManager($pdo);
$migrationManager->migrate();

$inscricaoRepo = new InscricaoRepository($pdo);
$quizRepo = new ResultadoRepository($pdo);

$inscricaoService = new InscricaoService($inscricaoRepo);
$quizService = new QuizService($quizRepo);

$inscricaoController = new InscricaoController($inscricaoService);
$quizController = new QuizController($quizService);

$router = new Router($quizController, $inscricaoController);

// --- ROTEAMENTO ---
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Middleware Global
if ($method === 'POST') {
    require_once 'app/middleware/Middleware.php';
    sanitizeInput();
}

$resultado = $router->route($uri, $method);

// --- RENDERIZAÇÃO DA VIEW ---
include VIEW_PATH . '/view.php';
