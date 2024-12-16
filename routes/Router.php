<?php

require_once __DIR__ . '/RouteSwitch.php';

class Router extends RouteSwitch
{
   
    public function  redirecionar($nomeRota){
        $this->$nomeRota();
    }
    public function run(string $requestUri)
    {
        
        $route = substr($requestUri, 1);

        if ($route === '') {
            $this->home();
        } else {
            $this->$route();
        }
    }
}