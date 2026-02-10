Quizur IFTO: Sistema Prático de Orientação Acadêmica
Documento: DRF-IFTO-001 Versão: 1.0 Status: Especificação Inicial Autor: Analista de Requisitos (AI)

1. Contexto
Problema: Incerteza e falta de informação dos estudantes do IFTO Campus Araguaína na transição para o ensino superior, resultando em possíveis escolhas equivocadas e evasão escolar.

Usuários: * Estudantes (Egresso/Candidato): Realizam o quiz de forma anônima para descobrir sua vocação.
Quizur IFTO: Sistema Prático de Orientação Acadêmica
Documento: DRF-IFTO-001 Versão: 1.0 Status: Especificação Inicial Autor: Analista de Requisitos (AI)

1. Contexto
Problema: Incerteza e falta de informação dos estudantes do IFTO Campus Araguaína na transição para o ensino superior, resultando em possíveis escolhas equivocadas e evasão escolar.

Usuários: * Estudantes (Egresso/Candidato): Realizam o quiz de forma anônima para descobrir sua vocação.

Administrador (Autor): Responsável pela configuração da lógica de perguntas e resultados na plataforma Quizur.

Valor: Redução da evasão acadêmica e auxílio na tomada de decisão consciente através de uma interface interativa e visual.

2. Requisitos Funcionais (RF)
RF01 - Questionário de Perfil Vocacional
Descrição: O sistema deve apresentar 10 perguntas de múltipla escolha focadas em comportamento e interesses. Regras:

Cada alternativa deve estar vinculada internamente a um ou mais cursos.

A participação deve ser 100% anônima (limitação da plataforma). Critério de Aceite:

[ ] O usuário deve conseguir responder todas as questões sem necessidade de login.

[ ] O sistema deve processar a resposta predominante para gerar o resultado.

RF02 - Recomendação de Curso
Descrição: Após a última pergunta, o sistema deve exibir o curso mais compatível com as respostas. Regras:

O resultado deve exibir o nome do curso (Farmácia, GPI, ADS, Enfermagem ou Análises Clínicas).

Deve apresentar as características do curso (duração, turno, áreas de atuação). Critério de Aceite:

[ ] Exibir foto real do campus/laboratório correspondente ao curso sugerido.

[ ] Mostrar texto descritivo sobre o curso.

RF03 - Encaminhamento Institucional
Descrição: O sistema deve oferecer um direcionamento para a conversão do interesse em inscrição. Regras:

Deve haver um link funcional para o portal oficial do IFTO. Critério de Aceite:

[ ] O botão de link deve abrir em uma nova aba/janela.

3. Regras de Negócio (RN)
RN01 - Lógica de Desempate: Caso haja empate entre dois perfis de curso, a plataforma Quizur aplicará seu critério interno de priorização (geralmente a primeira opção de resposta associada).

RN02 - Abrangência de Cursos: O quiz deve contemplar obrigatoriamente os cursos Superiores (Farmácia, GPI, ADS) e Subsequentes (Enfermagem, Análises Clínicas) do Campus Araguaína.

RN03 - Temporalidade: O projeto terá validade de um ano, não prevendo atualizações de grade ou inclusão de novos cursos neste ciclo.

4. Requisitos Não-Funcionais (RNF)
Usabilidade: A interface deve ser responsiva (compatível com dispositivos móveis), visto que o acesso será via QR Code em ambiente físico.

Disponibilidade: O sistema depende da infraestrutura da plataforma Quizur (SaaS).

Segurança/Privacidade: Por ser anônimo, o sistema está em conformidade com a LGPD por não coletar dados sensíveis ou identificáveis.

Acessibilidade Visual: Uso de fotos reais para facilitar a identificação e contextualização do ambiente acadêmico.
Administrador (Autor): Responsável pela configuração da lógica de perguntas e resultados na plataforma Quizur.

Valor: Redução da evasão acadêmica e auxílio na tomada de decisão consciente através de uma interface interativa e visual.

2. Requisitos Funcionais (RF)
RF01 - Questionário de Perfil Vocacional
Descrição: O sistema deve apresentar 10 perguntas de múltipla escolha focadas em comportamento e interesses. Regras:

Cada alternativa deve estar vinculada internamente a um ou mais cursos.

A participação deve ser 100% anônima (limitação da plataforma). Critério de Aceite:

[ ] O usuário deve conseguir responder todas as questões sem necessidade de login.

[ ] O sistema deve processar a resposta predominante para gerar o resultado.

RF02 - Recomendação de Curso
Descrição: Após a última pergunta, o sistema deve exibir o curso mais compatível com as respostas. Regras:

O resultado deve exibir o nome do curso (Farmácia, GPI, ADS, Enfermagem ou Análises Clínicas).

Deve apresentar as características do curso (duração, turno, áreas de atuação). Critério de Aceite:

[ ] Exibir foto real do campus/laboratório correspondente ao curso sugerido.

[ ] Mostrar texto descritivo sobre o curso.

RF03 - Encaminhamento Institucional
Descrição: O sistema deve oferecer um direcionamento para a conversão do interesse em inscrição. Regras:

Deve haver um link funcional para o portal oficial do IFTO. Critério de Aceite:

[ ] O botão de link deve abrir em uma nova aba/janela.

3. Regras de Negócio (RN)
RN01 - Lógica de Desempate: Caso haja empate entre dois perfis de curso, a plataforma Quizur aplicará seu critério interno de priorização (geralmente a primeira opção de resposta associada).

RN02 - Abrangência de Cursos: O quiz deve contemplar obrigatoriamente os cursos Superiores (Farmácia, GPI, ADS) e Subsequentes (Enfermagem, Análises Clínicas) do Campus Araguaína.

RN03 - Temporalidade: O projeto terá validade de um ano, não prevendo atualizações de grade ou inclusão de novos cursos neste ciclo.

4. Requisitos Não-Funcionais (RNF)
Usabilidade: A interface deve ser responsiva (compatível com dispositivos móveis), visto que o acesso será via QR Code em ambiente físico.

Disponibilidade: O sistema depende da infraestrutura da plataforma Quizur (SaaS).

Segurança/Privacidade: Por ser anônimo, o sistema está em conformidade com a LGPD por não coletar dados sensíveis ou identificáveis.

Acessibilidade Visual: Uso de fotos reais para facilitar a identificação e contextualização do ambiente acadêmico.
