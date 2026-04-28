<?php
require_once 'controller.php';
require_once 'middleware.php';

class Router {
    public function handle() {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            include 'view.php';
        } elseif ($method === 'POST') {
            Middleware::validarCampos($_POST);
            $controller = new MatriculaController();
            $controller->processarMatricula($_POST);
        } else {
            http_response_code(405);
            echo "Método não permitido.";
        }
    }
}
