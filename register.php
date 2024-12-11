

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
    <title>Cadastro - CodeMatch</title>
    <!-- Estilos CSS -->
<style>
    /* Resetando estilos básicos */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Corpo da página */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #F9F5FB; /* Cor clara suave de fundo (roxo claro) */
        color: #4B2F6C; /* Texto em roxo escuro e elegante */
        line-height: 1.6;
        padding: 0px 0px;
    }

    /* Cabeçalho */
    header {
        background-color: #6A4C91; /* Roxo profundo e sofisticado */
        color: #EDE1F5; /* Cor clara suave para o texto */
        padding: 20px 0;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    header h1 {
        font-size: 2.5rem;
        font-weight: bold;
    }

    header a {
        color: #EDE1F5; /* Cor clara */
        text-decoration: none;
        margin: 0 15px;
        font-weight: 600;
        font-size: 1.1rem;
    }

    header a:hover {
        color: #C0A1D9; /* Roxo mais claro no hover */
        text-decoration: underline;
    }

    /* Container principal */
    .container {
        max-width: 960px;
        margin: 60px auto;
        text-align: center;
        background-color: #FFFFFF; /* Fundo branco para destacar o conteúdo */
        padding: 50px 30px;
        border-radius: 15px;
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
    }

    .container h1 {
        color: #6A4C91; /* Roxo profundo */
        font-size: 3.5rem;
        font-weight: bold;
        margin-bottom: 25px;
    }

    .container p {
        font-size: 1.2rem;
        color: #6A4C91; /* Roxo suave para o texto */
        margin-bottom: 35px;
        font-weight: 400;
    }

    .erro {
        color: red;
        margin-top: 20px;
        font-size: 1.1rem;
    }

    .container input[type="email"],
    .container input[type="password"],
    .container input[type="text"] {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 2px solid #C0A1D9; /* Roxo suave nas bordas */
        border-radius: 8px;
        background-color: #F2E6FF; /* Fundo suave no campo de input */
        font-size: 1rem;
    }

    .container input[type="email"]:focus,
    .container input[type="password"]:focus,
    .container input[type="text"]:focus {
        border-color: #6A4C91; /* Roxo profundo ao focar no campo */
        outline: none;
    }

    .container button {
        width: 100%;
        padding: 12px;
        background-color: #6A4C91; /* Roxo profundo */
        color: #EDE1F5; /* Texto claro */
        font-size: 1.2rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .container button:hover {
        background-color: #C0A1D9; /* Roxo mais claro no hover */
        transform: translateY(-2px);
    }

    .container button:active {
        transform: translateY(0);
    }

    /* Rodapé */
    footer {
        background-color: #6A4C91; /* Roxo profundo */
        color: #EDE1F5; /* Texto claro */
        text-align: center;
        padding: 20px 0;
        position: relative;
        bottom: 0;
        width: 100%;
        font-size: 0.9rem;
    }

    footer a {
        color: #EDE1F5;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    footer a:hover {
        color: #C0A1D9; /* Roxo mais claro no hover */
    }

    /* Estilos Responsivos */
    @media (max-width: 768px) {
        header h1 {
            font-size: 2rem;
        }

        .container h1 {
            font-size: 2.2rem;
        }

        .container p {
            font-size: 1rem;
        }

        .container a {
            font-size: 1rem;
            padding: 8px 20px;
        }

        .container input[type="email"],
        .container input[type="password"],
        .container input[type="text"] {
            padding: 10px;
            font-size: 1rem;
        }

        .container button {
            font-size: 1rem;
        }
    }
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
