<?php

require_once __DIR__."/../controllers/UserController.php";
require_once __DIR__."/../controllers/ProjetoController.php";
require_once __DIR__."/../controllers/Autenticacao.php";
// require_once __DIR__."/../controllers/Autenticacao.php";
abstract class RouteSwitch
{
    protected function home()
    {
        session_start();
        $_SESSION['name']= 'henderson';

        //var_dump($_SESSION['name']);
        // Autenticacao::logar(1,'henderson','henderson@gmail.com');

        require __DIR__ . '/../views/home.php';
        // var_dump($_SESSION['userAutenticado']);
    }
    protected function register(){

        require __DIR__ . '/../views/register.php';
    }
    protected function user_register_store(){

    }
    protected function login(){

        require __DIR__. '/../views/login.php';
    }
    protected function cadastrar_user(){
        // Certifique-se de chamar os métodos corretamente com os parâmetros necessários
        $user = new UserController();
        // Cadastro
        $response = $user->cadastrar($_POST);
        echo $response;
        
    }

    protected function formulario(){

        require __DIR__.'/../views/formulario.php';
    }
    protected function Cadastrar_projeto(){
        session_start();
        
        if(session_status()){
            
            $user= new ProjetoController();

            $response=$user->cadastrar($_POST);
            echo $response;
        
        }
        

    }
    protected function meus_projetos(){
        
        if(session_status() != 2){
            session_start();
        }
       
        if(!isset($_SESSION['auth'])){

            header('login');
        }

        $project = (new ProjetoController())->meusProjetos();
        //require __DIR__.'/../views/meusprojetos.php';

    }

    protected function pagina_sobre(){
        require __DIR__.'/../views/sobre.php';

    }
    protected function outros_projetos(){
        require __DIR__.'/../views/match.php';
    }
    protected function logar(){
        
        $auth = new Autenticacao();
        
        $auth->logar($_POST['email'],$_POST['senha']);
    }

    



    public function __call($name, $arguments)
    {
        // Definir o código de resposta HTTP para 404
        http_response_code(404);

        // Exibir a URI solicitada, caso queira debugar
        echo "Não existe essa rota :". $_SERVER['REQUEST_URI'].", seu maluco!";

        // Incluir uma página de erro personalizada
        // require __DIR__ . '/../views/error404.php';
   
    }
}