<?php

require_once __DIR__ . '/../routes/Router.php';
require_once __DIR__ . '/../controllers/Autenticacao.php';

class UserController
{
    private $pdo;

    public function __construct()
    {
        require_once __DIR__ . '/../includes/db.php';
        $db = new Db();
        $this->pdo = $db->getConnection();
    }

    // Exibe todos os usuários
    public function index()
    {
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

    // Cadastra o usuário
    public function cadastrar($dados)
    {
        try {
            // Verifica se o email já está cadastrado
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$dados['email']]);

            if ($stmt->fetch()) {
                $error = "Email já cadastrado!";
                include __DIR__ . '/../views/register.php';
                return;
            }

            // Insere o usuário no banco de dados
          
            $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, celular) VALUES (?, ?, ?, ?)");
            $stmt->execute([$dados['name'], $dados['email'], password_hash($dados['password'],PASSWORD_DEFAULT),$dados['celular']]);

            // Login automático após cadastro
            $lastId = $this->pdo->lastInsertId();
            Autenticacao::logar($dados['email'], $dados['password'], $dados['celular']);

            return json_encode(["message" => "Usuário cadastrado com sucesso"], JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar usuário: " . $e->getMessage());
            return json_encode(["error" => "Erro ao cadastrar usuário."], JSON_PRETTY_PRINT);
           
        }
    }

    // Exibe um usuário pelo ID
    public function show($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
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

    // Deleta o usuário
    public function destroy($id)
    {
        try {
            // Verifica se o usuário existe
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$id]);

            if (!$stmt->fetch()) {
                return json_encode(["error" => "Usuário não encontrado."], JSON_PRETTY_PRINT);
            }

            // Deleta o usuário
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$id]);

            return json_encode(["message" => "Usuário deletado com sucesso"], JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao deletar usuário: " . $e->getMessage());
            return json_encode(["error" => "Erro ao deletar usuário."], JSON_PRETTY_PRINT);
        }
    }

    // Carrega a página para editar os dados do usuário
    public function edit($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
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
    public function update($id, $name, $email, $image_url)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE users SET name = ?, email = ?, image_url = ? WHERE id = ?");
            $stmt->execute([$name, $email, $image_url, $id]);

            return json_encode(["message" => "Usuário atualizado com sucesso."], JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao atualizar usuário: " . $e->getMessage());
            return json_encode(["error" => "Erro ao atualizar usuário."], JSON_PRETTY_PRINT);
        }
    }

    // Atualiza os dados de contato
    public function updateContacts($id, $whatsapp, $instagram)
    {
        try {
            // Verifica se o usuário existe
            $stmt = $this->pdo->prepare("SELECT * FROM contacts WHERE user_id = ?");
            $stmt->execute([$id]);

            if ($stmt->fetch()) {
                // Atualiza os contatos existentes
                $stmt = $this->pdo->prepare("UPDATE contacts SET whatsapp = ?, instagram = ? WHERE user_id = ?");
                $stmt->execute([$whatsapp, $instagram, $id]);
            } else {
                // Insere novos contatos
                $stmt = $this->pdo->prepare("INSERT INTO contacts (whatsapp, instagram, user_id) VALUES (?, ?, ?)");
                $stmt->execute([$whatsapp, $instagram, $id]);
            }

            return json_encode(["message" => "Contatos atualizados com sucesso."], JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao atualizar contatos: " . $e->getMessage());
            return json_encode(["error" => "Erro ao atualizar contatos."], JSON_PRETTY_PRINT);
        }
    }

    // Adiciona um novo projeto
    public function addProject($userId, $title, $description, $languages, $framework = null)
    {
        try {
            // Insere o novo projeto no banco
            $stmt = $this->pdo->prepare("INSERT INTO projects (users_id, title, description, languages, framework) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$userId, $title, $description, $languages, $framework]);

            return json_encode(["message" => "Projeto adicionado com sucesso."], JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao adicionar projeto: " . $e->getMessage());
            return json_encode(["error" => "Erro ao adicionar projeto."], JSON_PRETTY_PRINT);
        }
    }

    // Atualiza os dados de um projeto
    public function updateProject($projectId, $title, $description, $languages, $framework = null)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE projects SET title = ?, description = ?, languages = ?, framework = ? WHERE id = ?");
            $stmt->execute([$title, $description, $languages, $framework, $projectId]);

            return json_encode(["message" => "Projeto atualizado com sucesso."], JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao atualizar projeto: " . $e->getMessage());
            return json_encode(["error" => "Erro ao atualizar projeto."], JSON_PRETTY_PRINT);
        }
    }
}
