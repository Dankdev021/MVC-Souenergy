<?php

namespace Core\Models;

use Core\Classes\Database;
use Core\Classes\Store;
use Exception;

class Clientes
{

    //==========================================================
    public function verificar_email_existe($email)
    {

        //verifica se ja existe conta com esse email

        $bd = new Database();
        $params = [
            ':email' => strtolower(trim($email))
        ];
        $result = $bd->select("SELECT email FROM clientes WHERE email = :email", $params);

        if (count($result) != 0) {
            return true;
        } else {
            return false;
        }
    }

    //==========================================================

    public function registrar_cliente(string $purl)
    {
        try {
            //registra o novo cliente no banco de dados
            $bd = new Database();

            //cria uma hash pro registro do cliente
            //parametros
            $params = [
                ':email' => strtolower(trim($_POST['text_email'])),
                ':senha' => password_hash(trim($_POST['text_senha_1']), PASSWORD_DEFAULT),
                ':nome_completo' => (trim($_POST['nome_completo'])),
                ':morada' => (trim($_POST['text_morada'])),
                ':cidade' => (trim($_POST['text_cidade'])),
                ':telefone' => (trim($_POST['text_telefone'])),
                ':purl' => $purl,
                ':activo' => 0

            ];
            $bd->insert("INSERT INTO clientes VALUES (0, 
            :email,
            :senha,
            :nome_completo,
            :morada,
            :cidade,
            :telefone,
            :purl,
            :activo,
            NOW(),
            NOW(),
            NULL
            )
            ", $params);

            //retorna o purl criado
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    //=========================================================

    public function validar_email($purl)
    {
        //validar o email do novo cliente 
        $bd = new Database();
        $params = [
            ':purl' => $purl
        ];
        $resultados = $bd->select("SELECT * FROM clientes WHERE purl = :purl", $params);

        //verifica se foi encontrado o cliente
        if (count($resultados) != 1) {
            return false;
        }

        //foi encontrado este cliente com o purl indicado
        $id_cliente = $resultados[0]->id_cliente;

        //atualizar os dados do cliente
        $params = [
            ':id_cliente' => $id_cliente
        ];

        $bd->update("UPDATE clientes SET purl = NULL, activo = 1, update_at = NOW()", $params);

        return true;
    }
    //=========================================================
    public function validar_login($usuario, $senha)
    {

        //Verificar se o login é válido 
        $parametros = [
            ':usuario' => $usuario
        ];
        $bd = new Database();
        $resultado = $bd->select("SELECT * FROM clientes WHERE email = :usuario
        AND activo = 1 AND delete_at IS NULL ", $parametros);

        if (count($resultado) != 1) {
            return false;
        } else {
            //Verificar a senha do usuário
            $usuario = $resultado[0];

            if (!password_verify($senha, $usuario->$senha)) {
                //Senha inválida
                return false;
            } else {
                //login válido. Coloca os dados na sessão
                $_SESSION['cliente'] = $resultado->id_cliente;
                $_SESSION['usuario'] = $resultado->email;
                $_SESSION['nome_cliente'] = $resultado->nome_completo;

                //redirecionar para o inicio da loja
                Store::redirect();
            }
        }
    }
}
