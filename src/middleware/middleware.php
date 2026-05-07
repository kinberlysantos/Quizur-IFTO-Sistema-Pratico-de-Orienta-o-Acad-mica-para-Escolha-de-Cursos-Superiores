<?php

function sanitizeInput() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitização global do array $_POST
        foreach ($_POST as $key => $value) {
            if (is_string($value)) {
                // Remove tags e converte caracteres especiais
                $sanitized = strip_tags($value);
                $_POST[$key] = htmlspecialchars(trim($sanitized), ENT_QUOTES, 'UTF-8');
            }
        }
        
        // Validação de segurança adicional para campos críticos
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        
        if ($nome) $_POST['nome'] = $nome;
        if ($email) $_POST['email'] = $email;

        // Validação básica de campos obrigatórios (na rota de inscrição)
        if (isset($_POST['email']) && (empty($_POST['nome']) || empty($_POST['email']))) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Campos obrigatórios ausentes.']);
            exit;
        }
    }
}
