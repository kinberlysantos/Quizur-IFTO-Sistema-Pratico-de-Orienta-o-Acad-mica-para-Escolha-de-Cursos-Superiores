<?php

function sanitizeInput() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($_POST as $key => $value) {
            // Sanitização contra XSS e espaços extras
            $_POST[$key] = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
        }
        
        // Validação básica de campos obrigatórios
        if (empty($_POST['nome']) || empty($_POST['email'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Campos obrigatórios ausentes.']);
            exit;
        }
    }
}
