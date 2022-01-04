<?php

namespace Core\models;

use Core\classes\Database;
use Core\classes\Store;

class Produtos
{
    // ===========================================================
    public function lista_produtos_disponiveis($categoria)
    {
        // buscar todas as informações dos produtos da base de dados
        $bd = new Database();

        $sql = "SELECT * FROM produtos ";
        $sql .= "WHERE visivel = 1 ";

        if ($categoria == 'homem' || $categoria == 'mulher') {
            $sql .= "AND categoria = '$categoria'";
        }

        $produtos = $bd->select($sql);
        return $produtos;
    }
}
