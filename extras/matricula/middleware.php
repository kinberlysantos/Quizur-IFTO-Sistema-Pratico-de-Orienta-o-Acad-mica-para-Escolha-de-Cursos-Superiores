<?php

class Middleware {
    public static function validarCampos($dados) {
        if (empty($dados['nome']) || empty($dados['idade']) || empty($dados['curso'])) {
            die("Erro: Todos os campos devem ser preenchidos.");
        }

        if (!is_numeric($dados['idade'])) {
            die("Erro: A idade deve ser um número.");
        }
    }
}
