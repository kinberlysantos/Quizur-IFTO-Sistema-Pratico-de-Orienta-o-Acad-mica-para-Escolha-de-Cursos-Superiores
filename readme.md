# Quizur IFTO - Sistema de Orientação Acadêmica

Este projeto é uma ferramenta interativa desenvolvida para auxiliar estudantes e candidatos a descobrirem qual curso do **IFTO Campus Araguaína** melhor se adapta ao seu perfil vocacional.

## 🚀 Arquitetura Profissional (Backend PHP)

O sistema foi refatorado para seguir os mais altos padrões de engenharia de software, garantindo segurança, escalabilidade e facilidade de manutenção.

### Destaques Arquiteturais:
*   **MVC + Repository Pattern:** Separação total entre Interface (HTML/JS), Controle (PHP), Regras de Negócio (Service) e Persistência (SQL).
*   **Dependency Injection (DI):** Componentes desacoplados que recebem suas dependências via construtor, facilitando testes e trocas de tecnologia.
*   **Segurança Robusta:** Middleware de sanitização contra XSS e uso de Prepared Statements (PDO) para prevenir SQL Injection.
*   **Singleton Pattern:** Gerenciamento eficiente de conexões com o banco de dados.

## 📖 Documentação Detalhada

Para informações técnicas aprofundadas, consulte os arquivos na pasta `docs/`:

*   [**Arquitetura do Sistema (V2)**](docs/arquitetura.md): Detalhamento dos padrões Repository, DI e Segurança.
*   [**Design System**](docs/design-system.md): Guia de estilos, cores e componentes.
*   [**Requisitos**](docs/requisitos.md): Especificação funcional e regras de negócio.

## 🛠️ Como Executar

O projeto agora requer um ambiente PHP para o funcionamento do backend de inscrições.

1.  **Pré-requisitos:** Ter o PHP (versão 7.4 ou superior) instalado em sua máquina.
2.  **Configuração Inicial:**
    *   O arquivo `config.ini` já está configurado para usar SQLite (`database.sqlite`).
    *   O banco de dados será criado automaticamente na primeira submissão de formulário.
3.  **Iniciar Servidor:**
    Abra o terminal na raiz do projeto e execute:
    ```bash
    php -S localhost:8000
    ```
4.  **Acesse:** Abra `http://localhost:8000` no seu navegador.

---
© 2026 - Instituto Federal do Tocantins - Campus Araguaína
