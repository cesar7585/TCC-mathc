<?php

require_once __DIR__."/../controllers/UserController.php";
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
        // var_dump($_SESSION['usuarioAutenticado']);
    }
    protected function register(){

        require __DIR__ . '/../views/register.php';
    }
    protected function user_register_store(){

    }
    protected function login(){

        require __DIR__. '/../views/login.php';
    }
    protected function cadastrar_usuario(){
        // Certifique-se de chamar os métodos corretamente com os parâmetros necessários
        $user = new UserController();
        // Cadastro
        $response = $user->cadastrar($_POST);
        echo $response;
    }

    protected function formulario(){

        require __DIR__.'/../views/formulariopj.php';
    }
    protected function projetos(){
        require __DIR__.'/../views/projetos.php';

    }

    protected function pagina_sobre(){
        require __DIR__.'/../views/sobre.php';

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