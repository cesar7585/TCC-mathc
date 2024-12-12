<?php
session_start();
include('includes/db.php');

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $interesse = $_POST['interesse'];
    $usuario_id = $_SESSION['usuario_id'];

    // Inserindo o interesse no banco de dados
    $stmt = $pdo->prepare("INSERT INTO interests (user_id, interesse) VALUES (:user_id, :interesse)");
    $stmt->execute(['user_id' => $usuario_id, 'interesse' => $interesse]);

    header("Location: dashboard.php");
    exit();
}
