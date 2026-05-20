<?php

class InscricaoController {
    private $service;

    // INJEÇÃO DE DEPENDÊNCIA: Recebe o Service no construtor
    public function __construct(InscricaoService $service) {
        $this->service = $service;
    }

    public function store() {
        try {
            // O Middleware já deve ter sanitizado os dados em $_POST
            $this->service->registrar($_POST);
            
            // Sucesso: Redireciona ou retorna JSON
            if ($_SERVER['HTTP_ACCEPT'] === 'application/json') {
                echo json_encode(['status' => 'success', 'message' => 'Inscrição realizada com sucesso!']);
            } else {
                header('Location: index.php?status=success');
            }
        } catch (BusinessRuleException $e) {
            // Erro de Regra de Negócio: Capturado e tratado
            if ($_SERVER['HTTP_ACCEPT'] === 'application/json') {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            } else {
                header('Location: index.php?status=error&message=' . urlencode($e->getMessage()));
            }
        } catch (Exception $e) {
            // Erro Genérico/Banco: Não mostra Stack Trace para o usuário
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Ocorreu um erro interno no servidor.']);
        }
    }
}
