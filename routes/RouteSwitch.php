<?php

require_once __DIR__ . "/../controllers/UserController.php";
require_once __DIR__ . "/../controllers/ProjetoController.php";
require_once __DIR__ . "/../controllers/Autenticacao.php";

abstract class RouteSwitch
{
    public function __construct()
    {
        //session_start(); // Inicia a sessão uma vez no construtor
    }

    protected function home()
    {
        require __DIR__ . '/../views/home.php';
    }

    protected function register()
    {
        require __DIR__ . '/../views/register.php';
    }

    protected function user_register_store()
    {
        // Implementar lógica de registro de usuário
    }

    protected function login()
    {
        require __DIR__ . '/../views/login.php';
    }
    protected function logout(){
        
        (new Autenticacao())->deslogar();

    }

    protected function cadastrar_user()
    {
        $user = new UserController();
        $response = $user->cadastrar($_POST);
        echo $response;
    }

    protected function formulario()
    {
        require __DIR__ . '/../views/formulario.php';
    }

    protected function Cadastrar_projeto()
    {
        // Verifica se o usuário está autenticado
        if (!isset($_SESSION['auth']['id'])) {
            // Redireciona para a página de login
            (new Router())->redirecionar('login');
            exit();
        }


        // Cria uma instância do ProjetoController
        $projetoController = new ProjetoController();

        // Chama o método cadastrar e passa os dados do formulário
        $response = $projetoController->cadastrar($_POST); // Passa os dados do formulário
        echo $response;
    }

    protected function meusprojetos()
    {
        if (!isset($_SESSION['auth'])) {
            header("Location: login");
            exit();
        }

        $projectController = new ProjetoController();
        $projects = $projectController->meusProjetos(); // Agora retorna os projetos

        require __DIR__ . '/../views/meusprojetos.php'; // Exibe a visualização dos projetos
    }


    protected function pagina_sobre()
    {
        require __DIR__ . '/../views/sobre.php';
    }

    protected function outros_projetos()
    {
        if(!isset($_SESSION['auth'])){
            header("Location: login");
            exit();
        }
        $teste = new ProjetoController();
        $teste->todosProjetos();
        
        require __DIR__ . '/../views/match.php';
        
    }
 

    protected function logar()
    {
        $auth = new Autenticacao();
        $auth->logar($_POST['email'], $_POST['senha']);
    }

    public function __call($name, $arguments)
    {
        // Definir o código de resposta HTTP para 404
        http_response_code(404);
        echo "Não existe essa rota: " . $_SERVER['REQUEST_URI'] . ", seu maluco!";
        // Exibir a URI solicitada, caso queira debugar
       
    }
}
