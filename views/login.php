<?php 
require_once __DIR__.'/../views/components/header.php';
?>



   
    <link rel="stylesheet" href="/../views/assets/css/login.css">


<body>
    <h2>Login</h2>
    <form method="post" action="logar">
        <label for="email">Email:</label><br>
        <input type="email" name="email" required><br>
        <br>
        <label for="password">Senha:</label><br>
        <input type="password" name="senha" required><br>
        <br>
        <input type="submit" value="Entrar">
    </form>

</body>

</html>