<?php
session_start();
require_once __DIR__ . '/../routes/Router.php';
require_once __DIR__ . '/../controllers/Autenticacao.php';
require_once __DIR__ . '/../includes/db.php';

class ProjetoController
{
    private $pdo;

    public function __construct()
    {

        $db = new Db();
        $this->pdo = $db->getConnection();
    }


    public function todosProjetos()
    {
        //try {
            $stmt = $this->pdo->query("SELECT * FROM projects WHERE users_id != ".$_SESSION['auth']['id']);
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['outros_projetos'] = $projects;            

       /*     
        } catch (PDOException $e) {
            
            return json_encode(["error" => "Erro ao buscar projetos."], JSON_PRETTY_PRINT);
        }
            */
    }
    public function meusProjetos()
    {
        $query = null;

        if (isset($_SESSION['auth'])) {
            $auth = $_SESSION['auth'];

            $query = $this->pdo->query("SELECT * FROM projects WHERE users_id = " . (int)$_SESSION['auth']['id']);
        } else {
            $auth = null;
        }

        if ($query) {
            $projects = $query->fetchAll(PDO::FETCH_ASSOC);


            $_SESSION['meusProjetos'] = $projects;


            return $projects;
        }

        return [];
    }



    // Cadastra um projeto
    public function cadastrar($dados)
    {

        if (!isset($_SESSION['auth'])) {
            return json_encode(["error" => "Usuário não autenticado."], JSON_PRETTY_PRINT);
        }

        try {
            $title = isset($dados['title']) ? $dados['title'] : null;
            $description = isset($dados['description']) ? $dados['description'] : null;
            $languages = isset($dados['languages']) ? implode(',', $dados['languages']) : null; // Converte o array em string
            $framework = isset($dados['framework']) ? $dados['framework'] : null;

            $stmt = $this->pdo->prepare("INSERT INTO projects (users_id, title, description, languages, framework) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$_SESSION['auth']['id'], $title, $description, $languages, $framework]);


            return json_encode(["message" => "Projeto cadastrado com sucesso"], JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar projeto: " . $e->getMessage());
            return json_encode(["error" => "Erro ao cadastrar projeto.", "message" => $e->getMessage()], JSON_PRETTY_PRINT);
        }
    }

    // Exibe um projeto pelo ID
    public function show($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM projects WHERE id = ?");
            $stmt->execute([$id]);
            $project = $stmt->fetch(PDO::FETCH_ASSOC);

            if (empty($project)) {
                return json_encode(["message" => "Projeto não encontrado."], JSON_PRETTY_PRINT);
            }

            return json_encode($project, JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao buscar projeto: " . $e->getMessage());
            return json_encode(["error" => "Erro ao buscar projeto."], JSON_PRETTY_PRINT);
        }
    }

    // Deleta um projeto
    public function destroy($id)
    {
        (new Autenticacao())->deslogar();
        try {
            $stmt = $this->pdo->prepare("DELETE FROM projects WHERE id = ?");
            $stmt->execute([$id]);

            return json_encode(["message" => "Projeto deletado com sucesso"], JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao deletar projeto: " . $e->getMessage());
            return json_encode(["error" => "Erro ao deletar projeto."], JSON_PRETTY_PRINT);
        }
    }

    // Carregar a página para editar os dados do projeto
    public function edit($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM projects WHERE id = ?");
            $stmt->execute([$id]);
            $project = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$project) {
                return "Projeto não encontrado.";
            }

            include __DIR__ . '/../views/edit_projeto.php';
        } catch (PDOException $e) {
            error_log("Erro ao carregar dados do projeto: " . $e->getMessage());
            return "Erro ao carregar dados do projeto.";
        }
    }

    // Atualiza os dados de um projeto
    public function update($id, $title, $description, $languages, $framework)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE projects SET title = ?, description = ?, languages = ?, framework = ? 
                WHERE id = ?
            ");
            $stmt->execute([$title, $description, $languages, $framework, $id]);

            return json_encode(["message" => "Projeto atualizado com sucesso."], JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao atualizar projeto: " . $e->getMessage());
            return json_encode(["error" => "Erro ao atualizar projeto."], JSON_PRETTY_PRINT);
        }
    }
}
