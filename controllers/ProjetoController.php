<?php
require_once __DIR__ . '/../routes/Router.php';

class Usercontroller
{
    private $pdo;
    public function __construct()
    {
        require_once __DIR__ . '/../includes/db.php';
        $db = new Db();

        $this->pdo = $db->getConnection();
    }

    // Exibe todos os projetos
    public function index()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM projetos");
            $stmt->execute();
            $projetos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($projetos)) {
                return json_encode(["message" => "Nenhum projeto encontrado."], JSON_PRETTY_PRINT);
            }

            return json_encode($projetos, JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao buscar projetos: " . $e->getMessage());
            return json_encode(["error" => "Erro ao buscar projetos."], JSON_PRETTY_PRINT);
        }
    }

    // Cadastra um projeto
    public function cadastrar($dados)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO projetos (titulo, descricao) VALUES (?, ?)");
            $stmt->execute([$dados['titulo'], $dados['descricao']]);

            return json_encode(["message" => "Projeto cadastrado com sucesso"], JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar projeto: " . $e->getMessage());
            return json_encode(["error" => "Erro ao cadastrar projeto."], JSON_PRETTY_PRINT);
        }
    }

    // Exibe um projeto pelo ID
    public function show($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM projetos WHERE id = ?");
            $stmt->execute([$id]);
            $projeto = $stmt->fetch(PDO::FETCH_ASSOC);

            if (empty($projeto)) {
                return json_encode(["message" => ""], JSON_PRETTY_PRINT);
            }

            return json_encode($projeto, JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao buscar projeto: " . $e->getMessage());
            return json_encode(["error" => "Erro ao buscar projeto."], JSON_PRETTY_PRINT);
        }
    }

    // Deleta um projeto
    public function destroy($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM projetos WHERE id = ?");
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
            $stmt = $this->pdo->prepare("SELECT * FROM projetos WHERE id = ?");
            $stmt->execute([$id]);
            $projeto = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$projeto) {
                return "Projeto não encontrado.";
            }

            include __DIR__ . '/../views/edit_projeto.php';
        } catch (PDOException $e) {
            error_log("Erro ao carregar dados do projeto: " . $e->getMessage());
            return "Erro ao carregar dados do projeto.";
        }
    }
    
    // Atualiza os dados de um projeto
    public function update($id, $titulo, $descricao)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE projetos SET titulo = ?, descricao = ? WHERE id = ?");
            $stmt->execute([$titulo, $descricao, $id]);

            return json_encode(["message" => "Projeto atualizado com sucesso."], JSON_PRETTY_PRINT);
        } catch (PDOException $e) {
            error_log("Erro ao atualizar projeto: " . $e->getMessage());
            return json_encode(["error" => "Erro ao atualizar projeto."], JSON_PRETTY_PRINT);
        }
    }
}
