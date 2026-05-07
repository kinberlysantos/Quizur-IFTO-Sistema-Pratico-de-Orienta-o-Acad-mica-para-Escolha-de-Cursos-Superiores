# Checkpoint: Arquitetura e Defesa Técnica - Quizur IFTO

Este documento detalha o funcionamento da arquitetura implementada, justificando as escolhas técnicas e os padrões de projeto adotados para garantir um sistema escalável, seguro e de fácil manutenção.

---

## 1. Funcionamento dos Artefatos (MVC Avançado)

A arquitetura foi dividida em camadas de responsabilidade única, seguindo os princípios do SOLID:

*   **View (`view.php` e `assets/`):** Camada de apresentação. Não contém lógica de decisão ou acesso a dados, apenas renderiza as informações processadas pelo Controller e recebe entradas do usuário.
*   **Controller (`src/controllers/`):** Atua como o coordenador. Sua única responsabilidade é receber a requisição, chamar o Service adequado dentro de um bloco `try-catch` e decidir qual resposta enviar (JSON ou Renderização). **Não contém SQL nem regras de negócio.**
*   **Service (`src/services/`):** O "coração" da aplicação. Aqui residem as regras de negócio complexas (cálculo de perfil, validações específicas). Ele utiliza abstrações (Interfaces) para persistir dados, garantindo que a lógica de negócio não dependa de um banco de dados específico.
*   **Repository (`src/repositories/`):** Camada de persistência. Único local onde o SQL (PDO) é permitido. Ele implementa uma Interface, permitindo que a tecnologia de banco de dados seja trocada sem impactar o restante do sistema.
*   **Interface (`src/interfaces/`):** Contratos que definem o que um componente deve fazer, mas não como. É a base do desacoplamento.
*   **Model/Entity:** No contexto deste projeto, são os arrays de dados ou objetos simples que trafegam entre as camadas.

---

## 2. Defesa Técnica: Desacoplamento e Injeção de Dependência (DI)

### Por que usar Injeção de Dependência?
Em vez de um Service instanciar seu próprio Repositório (`new Repository()`), ele o recebe via construtor.
**Benefícios:**
1.  **Testabilidade:** Podemos injetar um "Mock" (repositório falso) para testar o Service sem tocar no banco de dados.
2.  **Flexibilidade:** Se decidirmos trocar o SQLite por MySQL, criamos um `MysqlRepository` que implementa a mesma Interface e o injetamos no `index.php`. O Service permanece intocado.

### O papel das Interfaces
As Interfaces permitem que o Service dependa de uma **abstração** e não de uma **implementação concreta**. Isso remove o acoplamento rígido entre a lógica de negócio e a infraestrutura.

---

## 3. Diagnóstico de Responsabilidades

Para garantir a pureza da arquitetura, monitoramos os seguintes "vazamentos":
*   **Regras de Negócio no Controller:** Evitamos `if/else` complexos no Controller. Se uma validação falha, o Service lança uma `BusinessRuleException` e o Controller apenas captura e exibe a mensagem.
*   **SQL no Service:** Nenhuma query SQL existe no Service. O Service apenas diz `$this->repository->save($dados)`. A complexidade do SQL está escondida no Repositório.

---

## 4. Blindagem e Segurança

A aplicação é protegida em múltiplas camadas:
1.  **Sanitização (Middleware):** Todo dado vindo via `POST` passa pelo `middleware.php`, onde é limpo com `strip_tags` e `htmlspecialchars` para impedir ataques de XSS (Cross-Site Scripting).
2.  **Tratamento de Erros:** O uso de exceções customizadas (`BusinessRuleException`) permite separar erros amigáveis de usuário de erros técnicos críticos. Erros de banco de dados são capturados genericamente para ocultar o *Stack Trace* (caminhos de arquivos e senhas) do usuário final.
3.  **Configuração Protegida:** O `config.ini` guarda credenciais sensíveis e é ignorado pelo Git via `.gitignore`, seguindo as melhores práticas de segurança de ambiente.

---

## 5. Integridade e Versionamento

*   **Migrations:** O uso de um `MigrationManager` garante que qualquer desenvolvedor que clone o projeto tenha a mesma estrutura de banco de dados automaticamente. O histórico de alterações no banco é versionado via arquivos `.sql`.
*   **Git Semântico:** Commits claros (ex: `refactor: implementa repository pattern`) facilitam o rastreio de mudanças e a colaboração em equipe.
