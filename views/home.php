<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeMatch</title>
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
            background-color: #F9F5FB;
            /* Cor clara suave de fundo (roxo claro) */
            color: #4B2F6C;
            /* Texto em roxo escuro e elegante */
            line-height: 1.6;
            padding: 0px 0px;
        }

        /* Cabeçalho */
        header {
            background-color: #6A4C91;
            /* Roxo profundo e sofisticado */
            color: #EDE1F5;
            /* Cor clara suave para o texto */
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
/* salvre */
        header a {
            color: #EDE1F5;
            /* Cor clara */
            text-decoration: none;
            margin: 0 15px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        header a:hover {
            color: #C0A1D9;
            /* Roxo mais claro no hover */
            text-decoration: underline;
        }

        /* Container principal */
        .container {
            max-width: 960px;
            margin: 60px auto;
            text-align: center;
            background-color: #FFFFFF;
            /* Fundo branco para destacar o conteúdo */
            padding: 50px 30px;
            border-radius: 15px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            color: #6A4C91;
            /* Roxo profundo */
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .container p {
            font-size: 1.2rem;
            color: #6A4C91;
            /* Roxo suave para o texto */
            margin-bottom: 35px;
            font-weight: 400;
        }

        .container a {
            text-decoration: none;
            color: #6A4C91;
            /* Roxo suave */
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0 15px;
            padding: 10px 25px;
            background-color: #C0A1D9;
            /* Roxo suave de fundo */
            border-radius: 50px;
            border: 2px solid #6A4C91;
            transition: all 0.3s ease-in-out;
        }

        .container a:hover {
            background-color: #6A4C91;
            color: #EDE1F5;
            transform: translateY(-2px);
        }

        .container a:active {
            transform: translateY(0);
        }

        /* Rodapé */
        footer {
            background-color: #6A4C91;
            /* Roxo profundo */
            color: #EDE1F5;
            /* Texto claro */
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
            color: #C0A1D9;
            /* Roxo mais claro no hover */
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
        }
    </style>
</head>

<body>
    <!-- Cabeçalho com Dropdown -->
    <header>
        <h1>CodeMatch</h1>
        <img src="logo.png" /> <!-- A imagem ao lado do nome -->
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

    <!-- Conteúdo Principal -->
    <div class="container">
        <h1>Bem-vindo ao Sistema de Match para seu negócio!</h1>
        <p>Encontre parceiros ideais para o seu negócio e expanda suas oportunidades.</p>

        <!-- Botão de Login -->
        <a href="register.php">Crie sua conta</a>
    </div>
    <!-- Rodapé -->
    <footer>
        <p>&copy; 2024 CodeMatch. Todos os direitos reservados.</p>
    </footer>

</body>

</html>