/**
 * service.js - Camada de Regras de Negócio
 * O Serviço não lida com o DOM nem com o Banco de Dados diretamente.
 * Ele processa os dados brutos e retorna o resultado baseado nas regras do quiz.
 */

export const QuizService = {
  /**
   * Calcula o resultado predominante com base nas respostas.
   * @param {FormData|Object} respostas - Coleção de respostas do usuário.
   * @returns {Object} O objeto contendo o título, descrição e imagem do curso sugerido.
   * @throws {Error} Se os dados forem inválidos ou insuficientes.
   */
  processarResultado(respostas) {
    let counts = { 1: 0, 2: 0, 3: 0, 4: 0 };
    
    // Suporta tanto FormData quanto Objeto simples
    const values = respostas instanceof FormData ? Array.from(respostas.values()) : Object.values(respostas);
    
    if (values.length === 0) {
      throw new Error("Dados insuficientes para processar o resultado.");
    }

    values.forEach(val => {
      if (counts.hasOwnProperty(val)) counts[val]++;
    });

    // Lógica de Decisão (Regra de Negócio)
    const top = Object.keys(counts).reduce((a, b) => counts[a] > counts[b] ? a : b);
    
    const resultsMap = {
      1: { 
        title: "Enfermagem / Saúde", 
        desc: "Seu perfil é voltado para o cuidado humano e assistência à saúde.", 
        img: "https://images.unsplash.com/photo-1576765608596-78b53a3b7dc1?q=80&w=800" 
      },
      2: { 
        title: "Análise e Desenvolvimento de Sistemas", 
        desc: "Você tem grande afinidade com lógica, tecnologia e inovação digital.", 
        img: "https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=800" 
      },
      3: { 
        title: "Gestão da Produção Industrial", 
        desc: "Seu foco está na organização, eficiência de processos e liderança corporativa.", 
        img: "https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=800" 
      },
      4: { 
        title: "Biotecnologia / Análises Clínicas", 
        desc: "Você demonstra inclinação para o rigor científico, laboratórios e pesquisa.", 
        img: "https://images.unsplash.com/photo-1579154204601-01588f351e67?q=80&w=800" 
      }
    };

    return { 
      perfil: top, 
      ...resultsMap[top] 
    };
  }
};
