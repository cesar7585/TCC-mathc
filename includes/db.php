<?php
  
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'busines_match_system';

try {
    // Cria uma instância PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepara e executa a consulta SQL
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);

    // ... resto do seu código

} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>  





