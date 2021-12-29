<?php

use Core\Controller\Main;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$router = array();

$router['index'] = [
    'rota' => '/',
    'controller' =>  "Main",
    'action' => "index"
];

$router['novo_cliente'] = [
    'rota' => '/novo-cliente',
    'controller' =>  "Main",
    'action' => "novo_cliente"
];

$router['carrinho'] = [
    'rota' => '/carrinho',
    'controller' =>  "Main",
    'action' => "carrinho"
];

$router['criar_cliente'] = [
    'rota' => '/criar-cliente',
    'controller' =>  "Main",
    'action' => "criar_cliente"
];

$router['loja'] = [
    'rota' => '/',
    'controller' =>  "Main",
    'action' => "loja"
];

$router['confirmar_email'] = [
    'rota' => '/confirmar_email',
    'controller' => 'Main',
    'action' => 'confirmar_email'
];


$router['Login'] = [
    'rota' => '/Login',
    'controller' => 'Main',
    'action' => 'Login'
];

$router['Login_Submit'] = [
    'rota' => '/Login_Submit',
    'controller' => 'Main',
    'action' => 'Login_Submit'
];

$router['Contaconf'] = [
    'rota' => '/Contaconf',
    'controller' => 'Main',
    'action' => 'Contaconf'
];

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
foreach ($router as $rotas) :
    if ($url === $rotas['rota']) :
        $controlador = 'Core\\Controller\\' . ucfirst($rotas['controller']);
        $metodo = $rotas['action'];

        $ctr = new $controlador();
        $ctr->$metodo();
        return;
    endif;
endforeach;
$key = "Dankdev021";
$payload = array(
    "iss" => "http://example.org",
    "aud" => "http://localhost:8000",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

$ctr = new Main();
$ctr->index();
return;
