<?php
require_once __DIR__ . '/../includes/db.php';

class matchControler
{
    public function projetos()
    {
        if (isset($_SESSION['user_id'])) {
            header("Location: login");
            exit();
        }
        $pdo = (new db())->getConnection();

        session_start();
        $_SESSION['email'];
        $users_id = $_SESSION['auth']['id'];


        // Buscando os interesses do usuário
        $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = :id");
        $stmt->execute(['id' => $users_id]);

        $interessesUser = $stmt->fetchAll();

        // Buscando usuários com interesses semelhantes
        $matches = [];
        foreach ($interessesUser as $interesse) {
            $stmt = $pdo->prepare("SELECT * FROM users 
                          WHERE id != :id 
                          AND id IN (SELECT users_id FROM projects WHERE title = :interesse)");
            $stmt->execute(['id' => $users_id, 'interesse' => $interesse['interesse']]);
            $matches = array_merge($matches, $stmt->fetchAll());
        }
    }
}
