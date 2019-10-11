<?php

require 'router.php';

//$url = $_SERVER['REQUEST_URI']; 

$routes = array(
    '/test/' => function()
    {
        return 'Index page';
    },
    '/test/movies' => function()
    {
        return 'Movies';
    },
    '/test/users' => function() 
    {
        return 'The users collection page';
    },
    '/test/404' => function() 
    {
        return '404';
    }
);

$router = new Router($routes);
$router->route();