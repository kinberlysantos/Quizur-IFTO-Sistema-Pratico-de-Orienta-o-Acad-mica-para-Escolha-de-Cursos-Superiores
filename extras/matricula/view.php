<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Matrícula</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Matrícula</h1>
        <form action="/" method="POST">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required placeholder="Digite seu nome">
            </div>
            <div>
                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" required placeholder="Digite sua idade">
            </div>
            <div>
                <label for="curso">Curso:</label>
                <input type="text" id="curso" name="curso" required placeholder="Ex: Engenharia">
            </div>
            <button type="submit">Realizar Matrícula</button>
        </form>
    </div>
</body>
</html>
