<?php
// Conexão com o banco de dados (ajuste as informações)
$servername = 'srv950.hstgr.io,';
$username = 'u895973460_tcc';
$password = "tcc-Cesar-Yasmin123";
$dbname = 'u895973460_Match,';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $userId = $_GET['id']; 

    // Preparar a consulta SQL
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");

    // Executar a consulta
    $stmt->execute(['id' => $userId]);

    echo "Usuário excluído com sucesso!";
} catch(PDOException $e) {
    echo "Erro ao excluir usuário: " . $e->getMessage();
}
?>