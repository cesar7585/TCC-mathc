<?php 
include_once __DIR__ . '/../controllers/ProjetoController.php'; 
include_once __DIR__ . '/../includes/db.php'; 
?> 
<link rel="icon" href="/../views/assets/images/logo.png" type="image/png">
    <title>CodeMatch</title>
    <link rel="stylesheet" href="views/assets/css/mostrarpj.css">
   
<body>
    <?php include_once __DIR__ . "/components/header.php"; ?>
    
    <h1>Seus Projetos</h1>
    
    <div class="projeto-container">
        <ul>
            <?php 
            if (!empty($_SESSION['meusProjetos'])) {
                foreach ($_SESSION['meusProjetos'] as $index => $projeto) {
                    echo '<li>';
                    echo '<div class="projeto-titulo" onclick="mostrarDescricao(' . $index . ')">' 
                        . htmlspecialchars($projeto['title']) 
                        . '</div>';
                    if (!empty($projeto['description'])) {
                        echo '<div class="descricao" id="descricao-' . $index . '">'
                            . htmlspecialchars($projeto['description']) 
                            . '</div>';
                    }
                    echo '</li>';
                }
            } else {
                echo '<li>Nenhum projeto encontrado.</li>';
            }
            ?>
        </ul>
    </div>

    <a href="formulario" class="criar-projeto">Criar projeto</a>

    <?php include_once __DIR__ . "/components/footer.php"; ?>

    <script>
        function mostrarDescricao(index) {
            const descricao = document.getElementById('descricao-' + index);
            if (descricao.style.display === 'none' || descricao.style.display === '') {
                descricao.style.display = 'block'; 
            } else {
                descricao.style.display = 'none'; 
            }
        }
    </script>
</body>
</html>
