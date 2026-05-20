# Atividade: Reestruturação do Projeto (MVC/Services)

## Passo 1: O Grande "Move" (Criação de Pastas)
Abram o terminal no diretório do projeto e criem a estrutura hierárquica baseada no diagrama:

1.  Criem a pasta `app/` e, dentro dela, as subpastas: `controller/`, `model/`, `middleware/`, `services/`, `migration/` e `router/`.
2.  Criem a pasta `view/` para os arquivos de interface.
3.  Mantenham na raiz apenas o `index.php`, `config.php` e `autoload.php`.

## Passo 2: Isolando o Banco de Dados
Movam o seu arquivo de banco de dados (ex: `banco.sqlite`) para a pasta de destino correta conforme o diagrama.

> **Atenção:** Atualizem o caminho da conexão no seu `config.php` ou `Database.php` para apontar para o novo local.

## Passo 3: Organizando o Front-end
Movam todos os seus arquivos `.html`, `.css` e `.js` para dentro da pasta `view/`.

*   **Dica Profissional:** Se o projeto for crescer, dentro de `view/` criem subpastas `css/` e `js/`.
*   Ajustem os links de importação nos arquivos HTML para refletir o novo caminho relativo.

## Passo 4: Implementando o `autoload.php`
Criem um arquivo `autoload.php` na raiz. Ele deve ser responsável por registrar a função `spl_autoload_register`.

O objetivo é que, ao instanciar `new UsuarioController()`, o PHP procure automaticamente em `app/controller/UsuarioController.php`.

## Passo 5: Refatoração do Ponto de Entrada (`index.php`)
O `index.php` agora deve ser "limpo". Sua única função é:
1. Incluir o `config.php`.
2. Incluir o `autoload.php`.
3. Chamar o router para decidir qual controller deve ser executado.

## Passo 6: Validação da Estrutura
Após a movimentação dos arquivos, o sistema provavelmente "quebrará" (erros de caminhos e includes).

**Tarefa:** Corrijam todos os caminhos (paths) até que a aplicação volte a funcionar perfeitamente sob a nova estrutura.
*   Usem o `var_dump(__DIR__)` para ajudar a rastrear onde os caminhos estão se perdendo.

---

## Entrega e Versionamento Direto
O commit deve ser feito apenas após a confirmação de que o sistema está rodando.

1.  **Teste de Fogo:** Abram o navegador e tentem realizar um ciclo completo (Cadastro -> Listagem -> Login).
2.  **Stage Total:** `git add .`
3.  **Commit Único e Descritivo:** `git commit -m "feat: reestruturação completa de pastas conforme padrão MVC/Services"`
4.  **Push:** `git push origin main`

> **Aviso de Peer:** "Sem branch, o cuidado dobra". Antes de dar o `git add .`, certifique-se de que não esqueceu nenhum arquivo temporário ou de teste solto na raiz.