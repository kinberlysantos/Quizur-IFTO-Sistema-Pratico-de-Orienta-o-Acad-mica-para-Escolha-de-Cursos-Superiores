# Atividades: Desenvolvimento de Sistema de Matrícula (MVC)

### Passo 1: Preparando o Terreno (Migration)
Nos seus projetos, criem o arquivo `migration.php`. A responsabilidade deste arquivo é rodar as configurações iniciais do banco de dados.

* A classe `Migration` deve usar o **PDO** para criar um arquivo `database.sqlite` (caso não exista).
* Executar o comando SQL de criação da tabela: 
    ```sql
    CREATE TABLE IF NOT EXISTS alunos (
        id INTEGER PRIMARY KEY AUTOINCREMENT, 
        nome TEXT, 
        idade INTEGER, 
        curso TEXT
    );
    ```
* **Atenção:** Os alunos deverão executar esse arquivo uma única vez antes de testarem a aplicação completa.

---

### Passo 2: A Base de Dados (Model)
Criem o arquivo `model.php` contendo a classe `AlunoModel`. Este é o único local do sistema que vai se comunicar com a tabela de alunos.

* **Regra de Ouro (POO):** A classe deve ter propriedades privadas (`nome`, `idade`, `curso`) e métodos públicos (**Getters e Setters**).
* O método `save()` deve instanciar uma conexão PDO com o arquivo `database.sqlite` e usar um `INSERT INTO` (com **Prepared Statements** para evitar SQL Injection) para salvar os dados do objeto na tabela.

---

### Passo 3: Regras Complexas e Especializadas (Service)
Criem o arquivo `service.php` com a classe `MatriculaService`. O Serviço não lida com requisições HTTP nem com comandos SQL, ele apenas resolve regras de negócio.

* Este serviço deve receber os dados do aluno e simular uma regra avançada (ex: verificar idade mínima ou lógica de bolsa).
* Retorna os dados processados ou lança uma exceção (`Exception`) caso a regra falhe.

---

### Passo 4: O Maestro e a Interface (Controller e View)
Criem o arquivo `controller.php` contendo a classe `MatriculaController`. Este é o gerente do processo.

* O método `processarMatricula()` deve:
    1. Receber os dados da requisição.
    2. Chamar o `MatriculaService` para aplicar as regras.
    3. Se aprovado, instanciar o `AlunoModel` para salvar no SQLite.
    4. Decidir a resposta para o usuário (sucesso ou erro).

**Interface (`view.php`):**
* Um formulário HTML contendo **Nome, Idade e Curso**.
* Configurado para enviar os dados via método **POST**.

---

### Passo 5: A Porta de Entrada, Rotas e Segurança (Index, Router e Middleware)
Vamos conectar as requisições:

* **index.php:** O Front Controller. Ponto de entrada único que aciona o `router.php`.
* **router.php:** A classe `Router` avalia a URL e o método. Requisições `GET` chamam a exibição do `view.php`; requisições `POST` acionam o `Controller`.
* **middleware.php:** Atua como segurança antes do Controller. Verifica se todos os campos foram preenchidos e se a idade é um número. Se falhar, o processo é encerrado imediatamente.

---

### Passo 6: Mão na Massa e Servidor Built-in
1.  **Migração:** No terminal, rode `php migration.php` para criar o SQLite.
2.  **Servidor:** Inicie com `php -S localhost:8000`.
3.  **Testes:**
    * Envie formulário vazio (testar `middleware.php`).
    * Quebre regras de negócio (testar `service.php`).
    * Envie dados válidos e verifique o `database.sqlite` (usando extensões como SQLite Viewer) para confirmar o salvamento via `model.php`.