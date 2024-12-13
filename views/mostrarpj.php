

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Projetos</title>
</head>
<body>
    <h1>Meus Projetos</h1>
    <ul>
        <?php while ($projeto = $result_usuario->fetch_assoc()): ?>
            <li><?php echo htmlspecialchars($projeto['name']); ?></li>
        <?php endwhile; ?>
    </ul>

    <h1>Projetos de Terceiros</h1>
    <ul>
        <?php while ($projeto = $result_terceiros->fetch_assoc()): ?>
            <li><?php echo htmlspecialchars($projeto['name']); ?></li>
        <?php endwhile; ?>
    </ul>

    <a href="formulario">Criar projeto</a>

    <?php
    // Fechar a conexão
    $stmt_usuario->close();
    $stmt_terceiros->close();
    $conn->close();
    ?>
</body>
</html>
