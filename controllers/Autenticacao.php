<?php
require __DIR__.'/../includes/db.php';

class Autenticacao
{
    

    public static function logar($email,$senha)
    {
        session_start();

        $pdo = (new DB())->getConnection();
        var_dump($pdo);  

            
            // Prepare a consulta SQL para evitar SQL Injection
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);

            // Obtém o resultado
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica se o usuário foi encontrado e se a senha está correta
            var_dump($user['password']);
            if ($senha == $user['password']) {
                // Se o usuário foi encontrado, inicia a sessão
                $_SESSION['auth'] = [
                    'id'=> $user['id'],
                    'email' => $email
                    
                ];
                
                //$_SESSION['email'] = $email;
                //$_SESSION['id']= $user['id'];
                echo "Login bem-sucedido! Bem-vindo, " . htmlspecialchars($email) . ".";

                // Redirecionar para o match
                header("Location: outros_projetos");
                exit();
            } else {
                // Usuário não encontrado ou senha inválida
                echo "Email ou senha inválidos.";
            }

            // Fecha a declaração
            $stmt->closeCursor();
        

        // Fechar a conexão com o banco de dados
        $pdo = null; // Para fechar a conexão PDO

    }
    public static function deslogar()
    {
        session_start();
        session_unset();
        session_destroy();

        if (!empty($_COOKIE)) {
            foreach ($_COOKIE as $key => $value) {
                // Deletar o cookie, definindo um valor vazio e uma data de expiração no passado
                setcookie($key, '', time() - 3600, '/');
            }
        }
    }

    public static function autentificar($email, $senha)
    {
        // Incluindo o arquivo de conexão com o banco de dados
        include 'includes/db.php';

        // Prepara a consulta SQL
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $senha);

        // Executa a consulta
        $stmt->execute();

        // Obtém os resultados
        $result = $stmt->get_result();

        // Verifica se o usuário foi encontrado 
        if ($result->num_rows > 0) {
            // Usuário encontrado, obtém os dados
            $user = $result->fetch_assoc();
            // Chama o método logar com os dados do usuário
            self::logar($user['id'], $user['name'], $user['email'], $user['password'], $user['image_url'], $user['celular']);
            return true; // Login bem-sucedido
        } else {
            return false; // Login falhou
        }

        // Fecha a declaração
        $stmt->close();
        // Fecha a conexão
        $conn->close();
    }
}
