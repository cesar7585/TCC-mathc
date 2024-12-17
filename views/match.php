
    <title>CodeMatch</title>
    <link rel="icon" href="/../views/assets/images/logo.png" type="image/png">
    <link rel="stylesheet" href="views/assets/css/match.css">


<body>
    <?php
    
    require_once __DIR__ . '/../views/components/header.php';

    // Verifica se a variável de sessão existe
    $_SESSION['outros_projetos'];
   
    $projects = $_SESSION['outros_projetos'] ?? [];


    $url = urlencode("Ola tudo bem ? como voce vai").$_SESSION['auth']['celular']
    ?>

<!--    LINK PARA ENTRAR EM CONTATO COM O USUÁRIO -->
    <a href="https://wa.me/5511946800914?text=sadasfdsg"<?php echo $url?> target="_blank"> PARTICIPAR </a>
    <div class="container">
        <h1>Outros projetos</h1>
        <a href="formulario">Adicionar Projeto</a>
        <?php if (count($projects) > 0): ?>
            <ul>
                <?php foreach ($projects as $match): ?>
                    <li>
                        
                        <?php echo htmlspecialchars($match['title'] ?? 'Título indisponível'); ?> -
                        <?php echo htmlspecialchars($match['description'] ?? 'Descrição indisponível'); ?>
                        
                    </li>
                    <a>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Não há projetos disponíveis no momento.</p>
        <?php endif; ?>
    </div>
</body>

</html>