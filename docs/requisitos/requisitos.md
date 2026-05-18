# Quizur IFTO: Sistema Prático de Orientação Acadêmica

**Documento:** DRF-IFTO-001 | **Versão:** 1.0 | **Status:** Especificação Inicial | **Autor:** Analista de Requisitos (AI)

---

## 1. Contexto

### 1.1 Problema
Incerteza e falta de informação dos estudantes do IFTO Campus Araguaína na transição para o ensino superior, resultando em possíveis escolhas equivocadas e evasão escolar.

### 1.2 Usuários
*   **Estudantes (Egresso/Candidato):** Realizam o quiz de forma anônima para descobrir sua vocação.
*   **Administrador (Autor):** Responsável pela configuração da lógica de perguntas e resultados na plataforma Quizur.

### 1.3 Valor
Redução da evasão acadêmica e auxílio na tomada de decisão consciente através de uma interface interativa e visual.

---

## 2. Requisitos Funcionais (RF)

### RF01 - Questionário de Perfil Vocacional
*   **Descrição:** O sistema deve apresentar 10 perguntas de múltipla escolha focadas em comportamento e interesses.
*   **Regras:**
    *   Cada alternativa deve estar vinculada internamente a um ou mais cursos.
    *   A participação deve ser 100% anônima (limitação da plataforma).
*   **Critérios de Aceite:**
    *   [x] O usuário deve conseguir responder todas as questões sem necessidade de login.
    *   [x] O sistema deve processar a resposta predominante para gerar o resultado.

### RF02 - Recomendação de Curso
*   **Descrição:** Após a última pergunta, o sistema deve exibir o curso mais compatível com as respostas.
*   **Regras:**
    *   O resultado deve exibir o nome do curso (Farmácia, GPI, ADS, Enfermagem ou Análises Clínicas).
    *   Deve apresentar as características do curso (duração, turno, áreas de atuação).
*   **Critérios de Aceite:**
    *   [x] Exibir foto real do campus/laboratório correspondente ao curso sugerido.
    *   [x] Mostrar texto descritivo sobre o curso com efeito visual.

### RF03 - Encaminhamento Institucional
*   **Descrição:** O sistema deve oferecer um direcionamento para a conversão do interesse em inscrição.
*   **Regras:**
    *   Deve haver um link funcional para o portal oficial do IFTO.
*   **Critérios de Aceite:**
    *   [x] O botão de link deve abrir em uma nova aba/janela.

---

## 3. Regras de Negócio (RN)

| ID | Regra | Descrição |
| :--- | :--- | :--- |
| **RN01** | Lógica de Desempate | Caso haja empate entre dois perfis de curso, a plataforma aplicará seu critério interno de priorização (geralmente a primeira opção associada). |
| **RN02** | Abrangência | O quiz deve contemplar obrigatoriamente os cursos Superiores (Farmácia, GPI, ADS) e Subsequentes (Enfermagem, Análises Clínicas). |
| **RN03** | Temporalidade | O projeto terá validade de um ano, não prevendo atualizações de grade ou inclusão de novos cursos neste ciclo. |

---

## 4. Requisitos Não-Funcionais (RNF)

*   **Usabilidade:** A interface deve ser responsiva (compatível com dispositivos móveis) e oferecer feedback visual imediato (animações, transições).
*   **Disponibilidade:** O sistema depende da infraestrutura da plataforma Quizur (SaaS).
*   **Segurança/Privacidade:** Conformidade com a LGPD por não coletar dados sensíveis ou identificáveis (anonimato garantido).
*   **Acessibilidade Visual:** Uso de fotos reais e suporte a navegação via teclado para facilitar a identificação e inclusão.
