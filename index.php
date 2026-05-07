<?php
// Configuração de caminhos e autoload simples
require_once 'src/middleware/middleware.php';
require_once 'src/database/database.php';
require_once 'src/database/migrationManager.php';
require_once 'src/exceptions/businessRuleException.php';

// Interfaces
require_once 'src/interfaces/iInscricaoRepository.php';
require_once 'src/interfaces/iResultadoRepository.php';

// Repositories
require_once 'src/repositories/inscricaoRepository.php';
require_once 'src/repositories/resultadoRepository.php';

// Services
require_once 'src/services/inscricaoService.php';
require_once 'src/services/quizService.php';

// Controllers
require_once 'src/controllers/inscricaoController.php';
require_once 'src/controllers/quizController.php';

// Routing
require_once 'src/routes/router.php';

// --- CONTAINER DE INJEÇÃO DE DEPENDÊNCIA (Manual) ---
$pdo = Database::getInstance();

// Executar Migrations
$migrationManager = new \App\Database\MigrationManager($pdo, 'src/migrations');
$migrationManager->migrate();

$inscricaoRepo = new InscricaoRepository($pdo);
...
$inscricaoService = new InscricaoService($inscricaoRepo);
$inscricaoController = new InscricaoController($inscricaoService);

$quizRepo = new ResultadoRepository($pdo);
$quizService = new QuizService($quizRepo);
$quizController = new QuizController($quizService);

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
