<?php

use Core\controllers\Main;

$router = array();

$router['index'] = [
    'rota' => '/',
    'controller' =>  "Main",
    'action' => "index"
];

$router['novo_cliente'] = [
    'rota' => '/novo_cliente',
    'controller' =>  "Main",
    'action' => "novo_cliente"
];

$router['carrinho'] = [
    'rota' => '/carrinho',
    'controller' =>  "Main",
    'action' => "carrinho"
];

$router['criar_cliente'] = [
    'rota' => '/criar_cliente',
    'controller' =>  "Main",
    'action' => "criar_cliente"
];

$router['loja'] = [
    'rota' => '/loja',
    'controller' =>  "Main",
    'action' => "loja"
];

$router['confirmar_email'] = [
    'rota' => '/confirmar_email',
    'controller' => 'Main',
    'action' => 'confirmar_email'
];


$router['Login'] = [
    'rota' => '/login',
    'controller' => 'Main',
    'action' => 'login'
];

$router['login_submit'] = [
    'rota' => '/login_submit',
    'controller' => 'Main',
    'action' => 'login_submit'
];

$router['conta_confirmada_sucesso'] = [
    'rota' => '/conta_confirmada_sucesso',
    'controller' => 'Main',
    'action' => 'conta_confirmada_sucesso'
];


$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
foreach ($router as $rotas) :
    if ($url === $rotas['rota']) :
        $controlador = 'Core\\controllers\\' . ucfirst($rotas['controller']);
        $metodo = $rotas['action'];

        $ctr = new $controlador();
        $ctr->$metodo();
        return;
    endif;
endforeach;

$ctr = new Main();
$ctr->index();
return;
