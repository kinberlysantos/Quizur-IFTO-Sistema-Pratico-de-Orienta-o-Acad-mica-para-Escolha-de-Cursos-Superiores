<?php

class MatriculaService {
    public function validarMatricula($dados) {
        $idadeMinima = 16;

        if ($dados['idade'] < $idadeMinima) {
            throw new Exception("A idade mínima para matrícula é de $idadeMinima anos.");
        }

        // Simulação de regra de bolsa
        if ($dados['idade'] > 60) {
            $dados['curso'] .= " (Bolsa Sênior Aplicada)";
        }

        return $dados;
    }
}
