<?php

class QuizService {
    private $resultsMap = [
        1 => [
            "title" => "Enfermagem / Saúde",
            "desc" => "Seu perfil é voltado para o cuidado humano e assistência à saúde.",
            "img" => "https://images.unsplash.com/photo-1576765608596-78b53a3b7dc1?q=80&w=800"
        ],
        2 => [
            "title" => "Análise e Desenvolvimento de Sistemas",
            "desc" => "Você tem grande afinidade com lógica, tecnologia e inovação digital.",
            "img" => "https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=800"
        ],
        3 => [
            "title" => "Gestão da Produção Industrial",
            "desc" => "Seu foco está na organização, eficiência de processos e liderança corporativa.",
            "img" => "https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=800"
        ],
        4 => [
            "title" => "Biotecnologia / Análises Clínicas",
            "desc" => "Você demonstra inclinação para o rigor científico, laboratórios e pesquisa.",
            "img" => "https://images.unsplash.com/photo-1579154204601-01588f351e67?q=80&w=800"
        ]
    ];

    public function calcularResultado(array $respostas) {
        if (empty($respostas)) {
            throw new BusinessRuleException("Nenhuma resposta enviada.");
        }

        $counts = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
        foreach ($respostas as $key => $val) {
            if (strpos($key, 'q') === 0 && isset($counts[$val])) {
                $counts[$val]++;
            }
        }

        // Lógica de Desempate (Predominância)
        arsort($counts);
        $top = key($counts);

        return array_merge(['perfil' => $top], $this->resultsMap[$top]);
    }
}
