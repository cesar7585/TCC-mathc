<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeMatch</title>
    <link rel="stylesheet" href="views/assets/css/formulario.css">
</head>

<body>
    <form method="post" action="/Cadastrar_projeto">

        <label for="text" name="titulo">titulo do projeto</label>
        <input type="text" id="text" name="titulo" required>

        <label for="text" name="description">descrição do projeto</label>
        <input type="text" name="description" required>

        <label for="text" name="languages">Linguagem desejada</label>
        <input type="text" name="languages" required>

        <label for="text" name="frameworks">frameworks desejada</label>
        <input type="text" name="frameworks" required>

        <fieldset>
            <legend>Escolha a Linguagem que você deseja trabalhar:</legend>

            <div>
                <input type="checkbox" id="csharp" name="languages[]" value="C#" checked />
                <label for="csharp">C#</label>
            </div>

            <div>
                <input type="checkbox" id="cpp" name="languages[]" value="C/C++" />
                <label for="cpp">C/C++</label>
            </div>

            <div>
                <input type="checkbox" id="javascript" name="languages[]" value="Javascript" />
                <label for="javascript">JavaScript</label>
            </div>

            <div>
                <input type="checkbox" id="java" name="languages[]" value="Java" />
                <label for="java">Java</label>
            </div>

            <div>
                <input type="checkbox" id="html" name="languages[]" value="HTML" />
                <label for="html">HTML</label>
            </div>

            <div>
                <input type="checkbox" id="php" name="languages[]" value="PHP" />
                <label for="php">PHP</label>
            </div>

            <div>
                <input type="checkbox" id="python" name="languages[]" value="Python" />
                <label for="python">Python</label>
            </div>

        </fieldset>

        <button type="submit">Criar projeto</button>

    </form>
</body>

</html>