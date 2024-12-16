<?php
require_once __DIR__.'/../controllers/matchControler.php';
require_once __DIR__.'/../views/components/header.php';
require_once __DIR__.'/../controllers/ProjetoController.php';
$projects=(new ProjetoController())->todosProjetos();

if (isset($_COOKIE['allProjects'])) {
    $projects = $_COOKIE['allProjects'];
 
    $project= $_COOKIE['allProjects'];
    // foreach ($project as $projects){
        // }
    
}

?>
<div class="container">
    <h1>Seus projetos</h1>
    <a href="formulario">Criar projeto</a>
    <?php if (count($projects) > 0): ?>
        <ul>
            <?php foreach ($projects as $match): ?>
                <li>
                    <?php echo htmlspecialchars($match['name']); ?> - <?php echo htmlspecialchars($match['email']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Não há projetos disponíveis no momento.</p>
    <?php endif; ?>
</div>
