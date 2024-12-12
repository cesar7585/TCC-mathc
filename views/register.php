

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);  // Criptografa a senha

    // Verificando se o e-mail já existe
    function verificarDominioEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "E-mail inválido!";
        }

        $dominio = substr(strrchr($email, "@"), 1);

        // Verifica se o domínio possui um registro MX válido
        if (checkdnsrr($dominio, 'MX')) {
            return "O domínio do e-mail é válido!";
        } else {
            return "O domínio do e-mail não é válido!";
        }
    }

    // Verificando o domínio do e-mail
    $emailMensagem = verificarDominioEmail($email);
    echo $emailMensagem;

    // Verificando se o e-mail já está cadastrado
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $usuarioExistente = $stmt->fetch();

    if ($usuarioExistente) {
        echo "<p class='erro'>Esse e-mail já está cadastrado. Tente outro.</p>";
    } else {
        // Inserindo o novo usuário no banco de dados
        $stmt = $pdo->prepare("INSERT INTO users (nome, email, senha) VALUES (:nome, :email, :senha)");
        $stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $senha]);

        echo "<p>Cadastro realizado com sucesso! <a href='login.php'>Clique aqui para entrar.</a></p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>Cadastro - CodeMatch</title>
    <!-- Estilos CSS -->
<style>
    /* Resetando estilos básicos */
   
</style>
</head>
<body>
   <!-- Cabeçalho com Dropdown -->
 <header>
        <h1>CodeMatch</h1>
        <nav>
            <a href="index.php">Início</a>
            <a href="about.php">Sobre</a>
            <a href="messages.php">Mensagens</a>
            <a href="match.php">Match</a>
            <a href="logout.php">Deslogar</a>
            <div class="dropdown">
                <div class="dropdown-content">
                </div>
            </div>
            </nav>
    </header>

    <!-- Conteúdo Principal (Formulário de Cadastro) -->
    <div class="container">
        <h1>Cadastro</h1>
        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>

            <label for="email">E-mail:</label>
            <input type="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" required>

            <button type="submit">Cadastrar</button>
        </form>
    </div>

    <!-- Rodapé -->
    <footer>
        <p>&copy; 2024 CodeMatch. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
