<?php
require __DIR__.'/../includes/db.php';
require_once __DIR__.'/../routes/RouteSwitch.php';

class Autenticacao
{
    public static function logar($email, $senha)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email, password = :password";

        $pdo = (new DB())->getConnection();

        // Prepare a consulta SQL para evitar SQL Injection
        $stmt = $pdo->prepare("SELECT * FROM users where email =:email");
        $stmt->execute([':email' => $email]); 

        // Obtém o resultado
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verifica se o usuário foi encontrado e se a senha está correta
        if ($user) {
            
            
            // Verifica a senha
            if (password_verify($senha, $user['password'])) {
                // Se o usuário foi encontrado, inicia a sessão
                $_SESSION['auth']=['id' => $user['id'],'email' => $email,'password'=> $senha ];
                
                echo "Login bem-sucedido! Bem-vindo, " . htmlspecialchars($email) . ".";

                // Redirecionar para o match
                header("Location: outros_projetos");
                exit(); // Certifique-se de que não há mais código após o redirecionamento
            } else {
                // Senha inválida
                echo "Senha incorreta.";
            }
        } else {
            // Usuário não encontrado
            echo "Usuário não encontrado.";
        }
        // Fecha a declaração
        $stmt->closeCursor();
        $pdo = null; // Para fechar a conexão PDO
    }

    public static function deslogar()
    {
        // session_start();
        session_unset();
        session_destroy();

        if (!empty($_COOKIE)) {
            foreach ($_COOKIE as $key => $value) {
                // Deletar o cookie, definindo um valor vazio e uma data de expiração no passado
                setcookie($key, '', time() - 3600, '/');
                
            }
        }
        (new Router())->redirecionar("home");
    }

    public static function autentificar($email, $senha)
    {
        // Incluindo o arquivo de conexão com o banco de dados
        $pdo = (new DB())->getConnection(); // Use a conexão correta

        // Prepara a consulta SQL
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        // Obtém os resultados
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário foi encontrado 
        if ($user) {
            // Verifica a senha
            if (password_verify($senha, $user['password'])) {
                // Chama o método logar com os dados do usuário
                self::logar($user['email'], $senha);
                return true; // Login bem-sucedido
            } else {
                echo "Senha incorreta."; // Senha inválida
                return false; // Senha incorreta
            }
        } else {
            echo "Usuário não encontrado."; // Usuário não encontrado
            return false; // Usuário não encontrado
        }
        
        if ($stmt) {
            $stmt->closeCursor();
        }
        
        // Fecha a conexão
        $pdo = null;
    }
}