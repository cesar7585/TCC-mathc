<?php
session_start();
include('includes/db.php');
$usuario_id = $_SESSION['usuario_id'];

// Buscando os interesses do usuário
$stmt = $pdo->prepare("SELECT * FROM interests WHERE user_id = :id");
$stmt->execute(['id' => $usuario_id]);
$interessesUsuario = $stmt->fetchAll();

// Buscando usuários com interesses semelhantes
$matches = [];
foreach ($interessesUsuario as $interesse) 
{
    $stmt = $pdo->prepare("SELECT * FROM users 
                          WHERE id != :id 
                          AND id IN (SELECT user_id FROM interests WHERE interesse = :interesse)");
    $stmt->execute(['id' => $usuario_id, 'interesse' => $interesse['interesse']]);
    $matches = array_merge($matches, $stmt->fetchAll());
}
?>

<div class="container">
    <h1>Seus Matches</h1>
    <?php if (count($matches) > 0): ?>
        <ul>
            <?php foreach ($matches as $match): ?>
                <li><?php echo htmlspecialchars($match['nome']); ?> - <?php echo htmlspecialchars($match['email']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Não há matches disponíveis no momento.</p>
    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>
