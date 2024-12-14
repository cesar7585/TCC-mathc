<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeMatch</title>
    <link rel="stylesheet" href="views/assets/css/formulario.css">
</head>

<body>
    <form method="post" action="controllers/ProjetoController.php" >

        <label for="text" name="titulo">titulo do projeto</label>
        <input type="text" id="text" name="titulo" required>
        
        <label for="text" name="descricao">descrição do projeto</label>
        <input type="text" name="descricao" required>
        
        <label for="text" name="linguagem">Linguagem desejada</label>
        <input type="text" name="linguagem" required>
        
        <label for="text" name="frameworks">frameworks desejada</label>
        <input type="text" name="frameworks" required>
        
        <button type="submit">Criar projeto</button>

    </form>
</body>
</html>

