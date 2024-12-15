<?php
session_start();
include('components/header.php');
include('includes/db.php');

if (!isset($_SESSION['users_idd'])) {
    header("Location: login.php");
    exit();
}

$users_id = $_SESSION['users_id'];

// Pegando os dados do usuário
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $users_id]);
$users_id = $stmt->fetch();

// Pegando os interesses do usuário
$stmt = $pdo->prepare("SELECT * FROM interests WHERE user_id = :id");
$stmt->execute(['id' => $users_id]);
$interesses = $stmt->fetchAll();
?>

<div class="container">
    <h1>Bem-vindo, <?php echo htmlspecialchars($user['name']); ?>!</h1>
    
    <h2>Seu Perfil</h2>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>

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

    <a href="match">Ver Matches</a> | <a href="messages">Mensagens</a> | <a href="logout">Sair</a>
</div>

<?php include('components/footer.php'); ?>
