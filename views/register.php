<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeMatch</title>
    <link rel="stylesheet" href="views/assets/css/register.css">
</head>

<body>
    <!-- Cabeçalho com Dropdown -->
    <?php include 'components/header.php'; ?>

    <!-- Conteúdo Principal (Formulário de Cadastro) -->
    <div class="container">
        <h1>Cadastro</h1>
        <!-- localhost:8000/register -->
        <form method="POST" action="/cadastrar_user">
            <label for="name">Nome:</label>
            <input type="text" name="name" required>

            <label for="email">E-mail:</label>
            <input type="email" name="email" required>
            <?php
            if (isset($error)) {
                echo $error;
            }
            ?>
            <label for="password">Senha:</label>
            <input type="password" name="password" required>

            <label for="celular">telefone</label>
            <input type="telephone" name="celular" required>
            </br>

            <button type="submit">Cadastrar</button>
        </form>
    </div>

    <!-- Rodapé -->
    <footer>
        <p>&copy; 2024 CodeMatch. Todos os direitos reservados.</p>
    </footer>

</body>

</html>