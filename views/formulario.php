<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeMatch</title>
    <link rel="stylesheet" href="views/assets/css/formulario.css">
</head>

<body>

    <form method="post" action="/cadastrar_Projeto" >

        <label for="text" name="title">titulo do projeto</label>
        <input type="text" id="text" name="title" required>
        
        <label for="text" name="description">descrição do projeto</label>
        <input type="text" name="description" required>
        
        <label for="text" name="languages">Linguagem desejada</label>
        <input type="text" name="languages" required>
        
        <label for="text" name="frameworks">frameworks desejada</label>
        <input type="text" name="framework" required>
        
        <button type="submit">Criar projeto</button>

    </form>
</body>
</html>

