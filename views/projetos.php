<?php
// Inclui o controller
require_once 'controllers/ProjetoController.php';

// Instancia o controller
$projetoController = new ProjetoController();


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeMatch</title>
    <link rel="stylesheet" href="views/assets/css/mostrarpj.css">
</head>
<body>
    <h1>Seus Projetos</h1>
    <ul>
       <?php 
       // Verifica se há projetos do usuário
       if (!empty($projetos_usuario)): 
           foreach ($projetos_usuario as $projeto): ?>               
               <li><?php echo htmlspecialchars($projeto['name']); ?></li>
           <?php endforeach; 
       else: ?>
           <li>Nenhum projeto encontrado.</li>
       <?php endif; ?>
    </ul>

    <h1>Seus Projetos</h1>
    <ul>
        <?php if (!empty($projetos_terceiros)): ?>
            <?php foreach ($projetos_terceiros as $projeto): ?>
                <li><?php echo htmlspecialchars($projeto['name']); ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Nenhum projeto de terceiros encontrado.</li>
        <?php endif; ?>
    </ul>

    <a href="formulario">Criar projeto</a>
</body>
</html>
