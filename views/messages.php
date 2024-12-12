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
    <link rel="stylesheet" href="css/menssages.css">
    <title>CodeMatch - Mensagens</title>
    <link>
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