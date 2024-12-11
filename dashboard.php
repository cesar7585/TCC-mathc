<?php
session_start();
include('includes/header.php');
include('includes/db.php');

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Pegando os dados do usuário
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $usuario_id]);
$usuario = $stmt->fetch();

// Pegando os interesses do usuário
$stmt = $pdo->prepare("SELECT * FROM interests WHERE user_id = :id");
$stmt->execute(['id' => $usuario_id]);
$interesses = $stmt->fetchAll();
?>

<div class="container">
    <h1>Bem-vindo, <?php echo htmlspecialchars($usuario['nome']); ?>!</h1>
    
    <h2>Seu Perfil</h2>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>

    <h2>Seus Interesses</h2>
    <ul>
        <?php foreach ($interesses as $interesse) { ?>
            <li><?php echo htmlspecialchars($interesse['interesse']); ?></li>
        <?php } ?>
    </ul>

    <h2>Adicionar Interesses</h2>
    <form method="POST" action="add_interests.php">
        <input type="text" name="interesse" required placeholder="Novo Interesse">
        <button type="submit">Adicionar</button>
    </form>

    <a href="match.php">Ver Matches</a> | <a href="messages.php">Mensagens</a> | <a href="logout.php">Sair</a>
</div>

<?php include('includes/footer.php'); ?>
