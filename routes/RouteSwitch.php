<?php
require_once __DIR__."/../controllers/UserController.php";
abstract class RouteSwitch
{
    protected function home()
    {
        
        require __DIR__ . '/../views/home.php';
    }

    protected function messages()
    {
        require __DIR__ . '/../views/messages.php';
    }

    protected function contact()
    {
        require __DIR__ . '/pages/contact.html';
    }
    protected function register(){

        require __DIR__ . '/../views/register.php';
    }
    protected function user_register_store(){

    }
    protected function login(){

        require __DIR__. '/../views/login.php';
    }
   

    
    public function __call($name, $arguments)
    {
        http_response_code(404);
        // PAGINA ERRO 404
        echo $_SERVER['REQUEST_URI'];
        //require __DIR__ . '/../views/error404.php';

    }
}