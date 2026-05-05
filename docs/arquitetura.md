# Arquitetura do Sistema: Quizur IFTO (MVC Avançado & Repository)

Este documento descreve a arquitetura profissional do projeto, integrando padrões de segurança, desacoplamento e persistência robusta.

---

### 1. Segurança e Configuração (`config.ini` & `Database.php`)
O sistema utiliza um arquivo de configuração isolado para proteger credenciais e caminhos do banco de dados.

*   **Configuração:** O arquivo `config.ini` (ignorado pelo Git) armazena o caminho do SQLite.
*   **Singleton Pattern:** A classe `database.php` garante que exista apenas uma instância da conexão PDO em todo o ciclo de vida da requisição, otimizando recursos.

---

### 2. Abstração de Dados (Repository Pattern)
Separamos completamente a lógica de acesso aos dados (SQL) da lógica de negócio.

*   **Contrato (`iInscricaoRepository.php`):** Define uma interface obrigatória para garantir que qualquer implementação de repositório possua os métodos `save`, `find` e `delete`.
*   **Implementação (`inscricaoRepository.php`):** Único local que contém SQL (PDO). As entidades do sistema não conhecem a estrutura das tabelas.

---

### 3. Camada de Serviço e Injeção de Dependência (DI)
As regras de negócio complexas residem na camada de Serviço, que é desacoplada através de DI.

*   **Service (`inscricaoService.php`):** Recebe a *Interface* do Repositório via construtor. Isso permite trocar o banco de dados (ex: de SQLite para MySQL) sem alterar uma linha de código do serviço.
*   **Exceções Customizadas:** Utiliza `businessRuleException.php` para sinalizar falhas de negócio de forma clara e tratável.

---

### 4. Controlador Enxuto (`inscricaoController.php`)
O Controller atua apenas como coordenador, sem conter lógica de validação ou SQL.

*   **Estrutura:** Recebe o Service via Injeção de Dependência.
*   **Tratamento de Erros:** Utiliza blocos `try-catch` para capturar exceções de negócio e retornar respostas limpas (JSON ou Redirecionamento), ocultando detalhes técnicos (Stack Traces) do usuário final.

---

### 5. Ponto de Entrada e Segurança (`index.php` & `middleware.php`)
O sistema utiliza um Front Controller que gerencia as dependências e protege as entradas.

*   **DI Container:** O `index.php` é responsável por instanciar o Repositório, o Serviço e o Controller, "montando" o sistema antes da execução.
*   **Sanitização (Middleware):** O arquivo `middleware.php` processa todas as entradas via `POST`, aplicando filtros contra XSS (`htmlspecialchars`) e garantindo que os dados cheguem limpos ao serviço.

---

### 6. Fluxo de Execução Recomendado
Para validar a arquitetura:
1.  **Backend:** Inicie o servidor com `php -S localhost:8000`.
2.  **Segurança:** Tente enviar tags `<script>` no formulário; verifique que elas são neutralizadas.
3.  **Erros:** Force uma falha no banco (ex: renomeando a tabela) e observe que o sistema retorna uma mensagem amigável de "Erro Interno" em vez de código PHP.
