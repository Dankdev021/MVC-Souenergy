<?php

namespace Core\Classes;

use Exception;

class Store
{

    // ===========================================================
    public static function Layout($estruturas, $dados = null)
    {

        // verifica se estruturas é um array
        if (!is_array($estruturas)) {
            throw new Exception("Coleção de estruturas inválida");
        }

        // variáveis
        if (!empty($dados) && is_array($dados)) {
            extract($dados);
        }

        // apresentar as views da aplicação
        foreach ($estruturas as $estrutura) {
            include("../Core/Views/$estrutura.php");
        }
    }

    // ===========================================================
    public static function clientelog()
    {

        // verifica se existe um cliente com sessao
        return isset($_SESSION['cliente']);
    }

    // ===========================================================
    public static function criarHash($num_caracteres = 12)
    {

        // criar hashes
        $chars = '01234567890123456789abcdefghijklmnopqrstuwxyzabcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZABCDEFGHIJKLMNOPQRSTUWXYZ';
        return substr(str_shuffle($chars), 0, $num_caracteres);
    }

    // ===========================================================
    public static function redirect($rota = 'inicio.php')
    {

        // faz o redirecionamento para a URL desejada (rota)
        header("Location: " . BASE_URL . "$rota");
    }
}
