# Blueprint de Design System: Quizur IFTO

Este documento serve como guia de referência de UI/UX para a interface do projeto Quizur IFTO. O design é focado em acessibilidade, clareza institucional e engajamento do estudante.

---

## 1. Design Tokens (Variáveis de Estilo)

### 1.1 Paleta de Cores
* **Primary (Verde Institucional):** `#009432` (Usado em CTAs, ícones de destaque e progresso).
* **Background Light:** `#F8F9FA` (Fundo principal da página em modo claro).
* **Background Dark:** `#0F2316` (Fundo principal em modo escuro).
* **Neutral Gray:** `#374151` (Cor principal para textos de perguntas e subtítulos).
* **Surface Light:** `#FFFFFF` (Fundo de cards e containers em modo claro).
* **Surface Dark:** `#0F172A` (Fundo de cards em modo escuro/Slate-900).
* **Borders:** `#E2E8F0` (Bordas leves para separação de elementos).

### 1.2 Tipografia
* **Fonte Principal:** 'Manrope', sans-serif.
* **Pesos Utilizados:** 400 (Regular), 500 (Medium), 700 (Bold), 800 (ExtraBold).
* **Escala Visual:**
    * Títulos: `1.5rem` (24px) a `1.25rem` (20px).
    * Corpo/Respostas: `1rem` (16px).
    * Labels/Meta: `0.75rem` (12px).

### 1.3 Bordas e Sombras
* **Border Radius:** * Cards e Botões: `0.75rem` (12px) a `1rem` (16px).
    * Elementos de Status: `9999px` (Full rounded).
* **Sombras (Box-Shadow):** Suaves e difusas em tons de cinza ou azulado para elevar o card principal sobre o fundo.

---

## 2. Arquitetura da Página (Layout)

### 2.1 Header Persistente (Sticky)
* **Comportamento:** Fixado no topo com fundo semitransparente ou sólido e sombra leve.
* **Conteúdo:** Logotipo à esquerda, indicador numérico de progresso (ex: Questão X/10) à direita.
* **Barra de Progresso:** Uma linha horizontal de 8px de altura logo abaixo do conteúdo do header. O preenchimento é feito com a cor `primary` via transição suave de largura.

### 2.2 Container Principal
* **Largura Máxima:** `42rem` (672px) para garantir legibilidade no desktop e foco centralizado.
* **Alinhamento:** Centralizado vertical e horizontalmente na viewport.

---

## 3. Componentes Específicos

### 3.1 Card de Pergunta
* **Imagem de Contexto:** Localizada no topo do card, altura fixa de `12rem` (192px), com um gradiente de sobreposição na base para suavizar a transição com o texto.
* **Área de Texto:** Título da categoria em letras maiúsculas (uppercase) seguido pela pergunta principal em destaque.

### 3.2 Opções de Resposta (Selectable Cards)
* **Estrutura:** Um container flexível que envolve um rádio button invisível.
* **Estado Padrão:** Borda de 2px sólida e clara, fundo branco/escuro, transição de 0.2s.
* **Estado Hover:** Mudança sutil na cor da borda para verde claro e fundo com opacidade reduzida da cor primária.
* **Estado Selecionado (Checked):** Borda assume a cor `primary` (#009432), o fundo ganha um leve tingimento esverdeado e um ícone de "check" aparece à direita da opção.
* **Identificador de Opção:** Um pequeno quadrado com bordas arredondadas contendo a letra da alternativa (A, B, C, D) à esquerda do texto da resposta.

### 3.3 Botões de Navegação
* **Botão Anterior:** Estilo "Outline" (apenas bordas), texto em cinza, foco em voltar.
* **Botão Próximo:** Estilo "Contained" (fundo sólido `primary`), texto em branco, sombra projetada para indicar ação principal.

---

## 4. Comportamento Responsivo e Acessibilidade
* **Mobile:** O layout deve ocupar quase toda a largura da tela (padding lateral de 1rem).
* **Interatividade:** Todos os elementos clicáveis devem ter uma área mínima de toque de 44x44px.
* **Feedback Visual:** Uso de `transition-all` com duração de 300ms-500ms para movimentos de barra de progresso e trocas de estado.