<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include('./includes/db.php');

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Verificando se o formulário de envio de mensagem foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Formulário enviado!"; // Verifica se o código do formulário está sendo executado
    $mensagem = $_POST['mensagem'];
    $destinatario_id = $_POST['destinatario_id'];

    // Inserindo a nova mensagem no banco de dados
    $stmt = $pdo->prepare("INSERT INTO messages (remetente_id, destinatario_id, mensagem) VALUES (:remetente_id, :destinatario_id, :mensagem)");
    $stmt->execute(['remetente_id' => $usuario_id, 'destinatario_id' => $destinatario_id, 'mensagem' => $mensagem]);

    header("Location: messages.php");
    exit();
}

// Buscando mensagens do usuário
$stmt = $pdo->prepare("SELECT m.*, u1.nome AS remetente_nome, u2.nome AS destinatario_nome 
                        FROM messages m 
                        JOIN users u1 ON m.remetente_id = u1.id 
                        JOIN users u2 ON m.destinatario_id = u2.id 
                        WHERE m.remetente_id = :usuario_id OR m.destinatario_id = :usuario_id 
                        ORDER BY m.created_at DESC");
$stmt->execute(['usuario_id' => $usuario_id]);
$mensagens = $stmt->fetchAll();
var_dump($mensagens); // Para verificar se as mensagens estão sendo recuperadas
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeMatch - Mensagens</title>
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
            background-color: #fafafa;
            /* Fundo claro */
            color: #333;
            /* Texto escuro */
            line-height: 1.6;
        }

        /* Estilo do container das mensagens */
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        /* Cabeçalho da página */
        h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Estilo das mensagens */
        ul {
            list-style: none;
            padding: 0;
            margin-bottom: 60px;
            /* Espaço para a área de envio de mensagem */
        }

        /* Cada mensagem (balão) */
        li {
            display: flex;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 15px;
            align-items: center;
            max-width: 75%;
            word-wrap: break-word;
            line-height: 1.4;
        }

        li em {
            font-size: 0.9rem;
            color: #999;
            margin-left: 5px;
        }

        /* Estilo do remetente */
        li strong {
            font-weight: 600;
            color: #3e3e3e;
        }

        /* Estilo do remetente quando é o usuário logado (mensagens enviadas pelo usuário) */
        li.sent {
            background-color: #daf8cb;
            /* Cor de fundo verde claro para mensagens enviadas */
            align-self: flex-end;
            margin-left: auto;
        }

        /* Estilo do destinatário */
        li.received {
            background-color: #f0f0f0;
            /* Cor de fundo cinza claro para mensagens recebidas */
            align-self: flex-start;
        }

        /* Formulário de envio de mensagem */
        form {
            position: absolute;
            bottom: 0;
            width: 100%;
            display: flex;
            padding: 15px;
            background-color: #fff;
            border-top: 1px solid #ddd;
            box-shadow: 0 -3px 6px rgba(0, 0, 0, 0.1);
        }

        /* Campo de texto da mensagem */
        textarea {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            resize: none;
            font-size: 1rem;
            margin-right: 10px;
            background-color: #f9f9f9;
            color: #333;
        }

        textarea:focus {
            outline: none;
            border-color: #6A4C91;
            /* Cor do foco */
        }

        /* Botão de envio */
        button {
            padding: 12px 20px;
            background-color: #6A4C91;
            /* Roxo do Instagram */
            color: #fff;
            font-weight: bold;
            font-size: 1rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
        }

        button:hover {
            background-color: #5a3c7f;
            /* Cor de hover */
        }

        button:focus {
            outline: none;
        }

        /* Estilo para o campo de seleção de destinatário */
        select {
            width: 100%;
            padding: 12px;
            border-radius: 25px;
            border: 1px solid #ccc;
            background-color: #fafafa;
            font-size: 1rem;
            margin-bottom: 20px;
            color: #333;
        }

        select:focus {
            outline: none;
            border-color: #6A4C91;
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 10px;
            }

            form {
                padding: 10px;
            }

            textarea {
                width: 70%;
            }

            button {
                padding: 10px 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Mensagens</h1>

        <h2>Enviar Mensagem</h2>
        <form method="POST">
            <label for="destinatario_id">Destinatário:</label>
            <select name="destinatario_id" required>
                <?php
                // Buscando todos os usuários para selecionar o destinatário
                $stmt = $pdo->query("SELECT id, nome FROM users WHERE id != :usuario_id");
                $stmt->execute(['usuario_id' => $usuario_id]);
                $usuarios = $stmt->fetchAll();
                foreach ($usuarios as $usuario) {
                    echo "<option value='{$usuario['id']}'>{$usuario['nome']}</option>";
                }
                ?>
            </select>

            <label for="mensagem">Mensagem:</label>
            <textarea name="mensagem" required></textarea>

            <button type="submit">Enviar</button>
        </form>

        <h2>Suas Mensagens</h2>
        <ul>
            <?php
            var_dump($mensagens); // Verifica se a variável $mensagens contém dados
            foreach ($mensagens as $mensagem):
            ?>
                <li class="<?php echo $mensagem['remetente_id'] == $usuario_id ? 'sent' : 'received'; ?>">
                    <strong><?php echo htmlspecialchars($mensagem['remetente_nome']); ?>:</strong>
                    <?php echo htmlspecialchars($mensagem['mensagem']); ?>
                    <em>(Para: <?php echo htmlspecialchars($mensagem['destinatario_nome']); ?>)</em>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>

</body>

</html>