<?php
class Router 
{
    public $currentRoute = '/';
    private $routes;
    
    public function __construct($routes)
    {
        $this->routes = $routes;
        $this->getCurrentRoute();
    }
    public function getCurrentRoute()
    {
        if(isset($_SERVER['REQUEST_URI'])) {
            $this->currentRoute = $_SERVER['REQUEST_URI'];
        }
    }
    public function route()
    {
        $route = $this->currentRoute;

        if (!isset($this->routes[$route])) {
            $route = '/404';
        }

        if (is_callable($this->routes[$route])) 
        {
            echo $this->routes[$route]();  
        }    
    }
}