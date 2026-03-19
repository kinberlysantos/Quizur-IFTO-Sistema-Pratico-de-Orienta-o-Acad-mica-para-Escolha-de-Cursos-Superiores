# Resumo sobre CSS

## 1. Qual é a função do CSS?

O **CSS (Cascading Style Sheets)** é a linguagem responsável por definir **como os elementos de uma página web serão apresentados visualmente**.

Enquanto o **HTML** organiza a estrutura da página — como títulos, parágrafos, imagens e formulários — o **CSS determina a aparência desses elementos**.

Com CSS é possível controlar aspectos como:

- Cor do texto
- Cor de fundo
- Tipografia
- Espaçamentos
- Organização dos elementos na tela
- Estrutura visual da interface

Sem o uso de CSS, um site seria apenas um conjunto de conteúdos estruturados, porém **sem estilo visual ou organização estética adequada**.

### Por que usar um arquivo externo (`style.css`)?

A forma mais recomendada de utilizar CSS é por meio de um **arquivo separado**, normalmente chamado `style.css`, que é conectado ao HTML com a seguinte tag:

```html
<link rel="stylesheet" href="style.css">
```

Esse método é considerado boa prática porque:

* Separa responsabilidades (estrutura no HTML e estilo no CSS)
* Permite reutilizar o mesmo estilo em várias páginas
* Facilita manutenção e alterações no projeto
* Melhora o desempenho, já que o navegador pode armazenar o arquivo em cache

---

## 2. Principais propriedades do CSS

A seguir estão algumas propriedades fundamentais usadas para estilizar páginas web.

*color*

Define a cor do texto exibido em um elemento.

```css
p {
  color: #333333;
}
```

---

*background-color*

Determina a cor de fundo de um elemento.

```css
body {
  background-color: #F4F0EA;
}
```

---

*margin*

Controla o espaçamento externo de um elemento, ou seja, a distância entre ele e outros elementos ao redor.

```css
div {
  margin: 20px;
}
```

---

*padding*

Define o espaço interno de um elemento, que é a distância entre o conteúdo e suas bordas.

```css
div {
  padding: 10px;
}
```

---

*display: flex*

Ativa o Flexbox, um sistema moderno de layout usado para organizar elementos dentro de um container.

```css
.container {
  display: flex;
}
```

O Flexbox facilita o controle de:

* Alinhamento
* Distribuição de espaço
* Posicionamento dos elementos

---

*flex-direction*

Define a orientação dos elementos dentro de um container flexível.

```css
.container {
  display: flex;
  flex-direction: column;
}
```

Valores comuns:

row → elementos alinhados horizontalmente

column → elementos organizados verticalmente

---

*gap*

Define o espaço entre elementos filhos dentro de um layout flexível.

```css
.container {
  display: flex;
  gap: 20px;
}
```

---

*box-sizing*

Controla como o tamanho total de um elemento é calculado.

```css
* {
  box-sizing: border-box;
}
```

Quando border-box é utilizado, padding e bordas são incluídos no cálculo da largura e altura, evitando problemas comuns de layout.


---

*border-collapse*

Utilizado principalmente em tabelas para remover a separação entre bordas das células.

```css
table {
  border-collapse: collapse;
}
```

---

*cursor*

Define qual tipo de cursor do mouse aparece quando ele passa sobre um elemento.

```css
button {
  cursor: pointer;
}
```

---

## 3. O uso de Classes no CSS

No CSS, classes permitem aplicar estilos a elementos específicos ou reutilizar o mesmo estilo em vários elementos.

Uma classe é definida no CSS utilizando . e aplicada no HTML com o atributo class.

Exemplo

CSS:

```css
.botao {
  background-color: blue;
  color: white;
  padding: 10px;
}
```

HTML:

```html
<button class="botao">Enviar</button>
```

Benefícios do uso de classes

* Permitem reaproveitar estilos em diferentes elementos
* Reduzem repetição de código
* Facilitam a manutenção do projeto
* Permitem estilizar partes específicas da interface

Por exemplo, vários botões podem compartilhar o mesmo estilo:

```html
<button class="botao">Salvar</button>
<button class="botao">Enviar</button>
<button class="botao">Cadastrar</button>
```

Todos receberão a mesma formatação definida no CSS.

---

## Conclusão

O CSS é fundamental para transformar uma página HTML simples em uma interface organizada e visualmente agradável.

Por meio de propriedades de estilo, do modelo de caixa (Box Model), do uso de Flexbox e da aplicação de classes, é possível controlar praticamente toda a aparência de um site.

Utilizar arquivos CSS externos é a abordagem mais recomendada, pois melhora a organização, a reutilização de estilos e a manutenção do código em projetos web.
