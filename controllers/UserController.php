<?php
require_once __DIR__.'/../routes/Router.php';
include 'controllers/Autenticacao.php';

class Usercontroller

{
    private $pdo;
    public function __construct()
    {
        require_once __DIR__ . '/../includes/db.php';
        $db = new Db();
        
        $this->pdo = $db->getConnection();
    }
    
    // exibe todos os usuarios
    public function index() {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($users)) {
                return json_encode(["message" => "Nenhum usuário encontrado."], JSON_PRETTY_PRINT);
            }

            return json_encode($users, JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao buscar usuários: " . $e->getMessage());
            return json_encode(["error" => "Erro ao buscar usuários."], JSON_PRETTY_PRINT);
        }
    }
    
    // cadastra o usuario
    public function cadastrar($dados)
    {
        
        try {
            // Verifica se o email ja está cadastrado
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$dados['email']]);
            // var_dump($stmt);
            // echo $stmt;
            
            if ($stmt->fetch()) {
                $error = "Email já cadastrado!";
                include __DIR__.'/../views/register.php';
                //return json_encode(["error" => "Email já cadastrado"], JSON_PRETTY_PRINT);
            }
            else{
                // Insere o usuário no banco de dados
                $stmt = $this->pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
                $stmt->execute([$dados['nome'], $dados['email']]);

                return json_encode(["message" => "Usuario cadastrado com sucesso"], JSON_PRETTY_PRINT);
            }
            Autenticao::logar($dados['id'],$dados['name'],$dados['email']);

     

          
        } catch (PDOException $e) {
            // Log de erro e retorno
            error_log("Erro ao cadastrar usuário: " . $e->getMessage());
            return json_encode(["error" => "Erro ao cadastrar usuario.". $e->getMessage()], JSON_PRETTY_PRINT);
        }

    }

    // Exibe um usuário pelo ID
    public function show($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = ?");
            $stmt->execute([$id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return json_encode(["error" => "Usuário não encontrado."], JSON_PRETTY_PRINT);
            }

            return json_encode($user, JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao buscar usuário: " . $e->getMessage());
            return json_encode(["error" => "Erro ao buscar usuário."], JSON_PRETTY_PRINT);
        }
    }


    // deleta o usuario
    public function destroy($id) {
        try {
            // Verificar se o e-mail já está cadastrado
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$id]);

            return json_encode(["message" => "Usuário deletado com sucesso"], JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        // Log de erro e retorno
        error_log("Erro ao deletar usuário: " . $e->getMessage());
        return json_encode(["error" => "Erro ao deletar usuário."], JSON_PRETTY_PRINT);
}
    }
    // Carrega a página para editar os dados do usuário
    public function edit($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = ?");
            $stmt->execute([$id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return "Usuário não encontrado.";
            }

            // Inclui a view para edição
            include __DIR__ . '/../views/edit.php';
        } catch (PDOException $e) {
            error_log("Erro ao carregar dados do usuário: " . $e->getMessage());
            return "Erro ao carregar dados do usuário.";
        }
    }

    // Atualiza os dados do usuário
    public function update($id, $name, $email)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE user SET name = ?, email = ? WHERE id = ?");
            $stmt->execute([$name, $email, $id]);

            return json_encode(["message" => "Usuário atualizado com sucesso."], JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao atualizar usuário: " . $e->getMessage());
            return json_encode(["error" => "Erro ao atualizar usuário."], JSON_PRETTY_PRINT);
        }
    }
}

/*
// Deleção
$response = $controller->destroy(1);
echo $response;

// Mostrar usuário
$response = $controller->show(1);
echo $response;

// Atualizar usuário
$response = $controller->update(1, "Novo Nome", "novoemail@example.com");
echo $response;
*/