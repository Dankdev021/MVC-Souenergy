<?php

use core\classes\Database;
use core\classes\Store;

//Abrir a sesssão
session_start();

//Carrega todas as classes do projeto
require_once('../vendor/autoload.php');

// Carrega o sistema de rotas
require_once('../core/Router.php');



//$bd = new Database();

/*$clientes = $bd->select('SELECT * FROM clientes');
echo '<pre>';
*print_r($clientes);
//echo $clientes[0]->nome;

/**
 * Carregar o config
 * Carregar as classes
 * Carregar o sistema de rotas
 *  -Mostrar a loja
 * -Mostrar o carrinho
 * -Mostrar o backoffice

 */