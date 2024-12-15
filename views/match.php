<?php
require_once __DIR__.'/../controllers/matchControler.php';

$projects = $_COOKIE['allProjects'];

foreach ($projects as $project){
    $project['titl7e'];

}
?>

<div class="container">
    <h1>Outros projetos</h1>
    <a href="formulario">Criar projeto</a>
    <?php if (count($matches) > 0): ?>
        <ul>
            <?php foreach ($matches as $match): ?>
                <li><?php echo htmlspecialchars($match['name']); ?> - <?php echo htmlspecialchars($match['email']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Não há rpojetos disponíveis no momento.</p>
    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>
