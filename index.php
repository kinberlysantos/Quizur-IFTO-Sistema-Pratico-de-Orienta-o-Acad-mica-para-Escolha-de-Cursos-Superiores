<?php

require_once 'middleware.php';
require_once 'inscricaoRepository.php';
require_once 'inscricaoService.php';
require_once 'inscricaoController.php';

// --- CONTAINER DE INJEÇÃO DE DEPENDÊNCIA (Manual) ---
$repository = new InscricaoRepository();
$service = new InscricaoService($repository);
$controller = new InscricaoController($service);

// --- ROTEAMENTO SIMPLIFICADO ---
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if ($method === 'POST' && strpos($uri, 'registrar') !== false) {
    sanitizeInput(); // Middleware de Segurança
    $controller->store();
} else {
    // Serve a View (HTML)
    include 'index.html';
}
