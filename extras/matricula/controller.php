<?php
require_once 'model.php';
require_once 'service.php';

class MatriculaController {
    public function processarMatricula($dados) {
        try {
            $service = new MatriculaService();
            $dadosProcessados = $service->validarMatricula($dados);

            $aluno = new AlunoModel();
            $aluno->setNome($dadosProcessados['nome']);
            $aluno->setIdade($dadosProcessados['idade']);
            $aluno->setCurso($dadosProcessados['curso']);

            if ($aluno->save()) {
                echo "<!DOCTYPE html><html lang='pt-br'><head><meta charset='UTF-8'><link rel='stylesheet' href='style.css'></head><body>";
                echo "<div class='container'>";
                echo "<div class='message success'>";
                echo "<h2>Matrícula realizada!</h2>";
                echo "<p>Bem-vindo, <strong>" . htmlspecialchars($aluno->getNome()) . "</strong> ao curso de " . htmlspecialchars($aluno->getCurso()) . ".</p>";
                echo "</div>";
                echo "<a href='/'>Voltar ao início</a>";
                echo "</div></body></html>";
            }
        } catch (Exception $e) {
            echo "<!DOCTYPE html><html lang='pt-br'><head><meta charset='UTF-8'><link rel='stylesheet' href='style.css'></head><body>";
            echo "<div class='container'>";
            echo "<div class='message error'>";
            echo "<h2>Ops! Erro na matrícula</h2>";
            echo "<p>" . $e->getMessage() . "</p>";
            echo "</div>";
            echo "<a href='/'>Tentar novamente</a>";
            echo "</div></body></html>";
        }
    }
}
