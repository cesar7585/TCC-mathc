<?php
require_once __DIR__. '/../includes/db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

session_start();
var_dump($_SESSION['email']);
$users_id = $_SESSION['auth']['id'];
var_dump($users_id);

// Buscando os interesses do usuário
$stmt = $pdo->prepare("SELECT * FROM projects WHERE user_id = :id");
$stmt->execute(['id' => $users_id]);
$interessesUser = $stmt->fetchAll();

// Buscando usuários com interesses semelhantes
$matches = [];
foreach ($interessesUser as $interesse) 
{
    $stmt = $pdo->prepare("SELECT * FROM users 
                          WHERE id != :id 
                          AND id IN (SELECT user_id FROM projects WHERE interesse = :interesse)");
    $stmt->execute(['id' => $users_id, 'interesse' => $interesse['interesse']]);
    $matches = array_merge($matches, $stmt->fetchAll());
}
?>