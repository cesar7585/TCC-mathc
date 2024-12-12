<?php

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
    protected function endereco(){
        
    }
    
    public function __call($name, $arguments)
    {
        http_response_code(404);
        // PAGINA ERRO 404
        echo $_SERVER['REQUEST_URI'];
        //require __DIR__ . '/../views/error404.php';

    }
}