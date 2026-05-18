# Atividades

## Passo 1: Definição de Entidades e Atributos
Antes de abrir a ferramenta, cada grupo deve listar as entidades do seu projeto (ex: `users`, `orders`, `products`).

Definam o que é essencial: Quais campos não podem ser nulos (`not null`)? Quais campos devem ser únicos (`unique`)?

## Passo 2: O Ambiente dbdiagram.io
Acessem o [dbdiagram.io](https://dbdiagram.io).

Explorem a interface: à esquerda o código DBML, à direita a visualização gráfica em tempo real.

Apaguem o exemplo padrão e preparem-se para transcrever a lógica do projeto.

## Passo 3: Codificando o Esquema (Sintaxe DBML)
Comecem a traduzir as entidades para blocos de código.

```dbml
Table usuarios { 
  id integer [primary key]
  nome varchar
  email varchar [unique]
  criado_em timestamp
}
```

> **Desafio:** Apliquem tipos de dados condizentes com o que discutimos em aula sobre performance.

## Passo 4: Estabelecendo Vínculos (Relacionamentos)
Conectem as tabelas. No DBML, isso é feito de forma muito intuitiva:

Utilizem o operador `>` para muitos-para-um, `<` para um-para-muitos e `-` para um-para-um.

*Exemplo:* `Ref: pedidos.usuario_id > usuarios.id` (Muitos pedidos pertencem a um usuário).

## Passo 5: Refatoração do Modelo (Peer Review)
Troquem de lugar com outro grupo. Analisem o diagrama do colega:

* Faltou algum relacionamento?
* Existe algum dado repetido que poderia virar uma nova tabela (Normalização)?
* O modelo atende aos requisitos do "Service" e "Repository" criados na aula passada?

## Passo 6: Exportação e Documentação
O diagrama não deve ficar apenas na ferramenta.

1. **Exportem** o projeto em formato PDF ou PNG para incluir na documentação do projeto.
2. **Exportem** o código SQL (MySQL ou PostgreSQL) gerado automaticamente pela ferramenta para uso futuro.

---

## Entrega e Versionamento
* **Criação do arquivo:** Na raiz do projeto autoral, criem uma pasta chamada `docs/database`.
* **Arquivo DBML:** Salvem o código gerado no dbdiagram em um arquivo chamado `schema.dbml`.
* **Commit Semântico:**
  ```bash
  git add docs/database
  git commit -m "docs: modelagem do banco de dados e diagrama ER em DBML"
  git push origin main
  ```
* **Critério de Sucesso:** O link do GitHub deve conter a pasta `docs` com o arquivo `.dbml`.
