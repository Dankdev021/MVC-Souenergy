<?php

namespace Core\Controller;

use Core\Classes\Database;
use Core\Classes\EnviarEmail;
use Core\Classes\Store;
use Core\Models\Clientes;

class Main
{
    //==========================================================
    //Apresenta a pagina index
    public function index()
    {

        /*
        1. Carregar e tratar dados (cálculos) e (Base de dados)
        2. Apresentar o layout (Views)
        */

        Store::layout([
            'Layout/Html_Header',
            'Layout/Header',    //Header que contém a navegação do header
            'inicio',
            'Layout/Footer',
            'Layout/Html_Footer',
        ]);
    }

    //==========================================================
    //Apresenta a pagina da loja 
    public function loja()
    {
        Store::layout([
            'Layout/Html_Header',
            'Layout/Header',    //Header que contém a navegação do header
            'Loja',
            'Layout/Footer',
            'Layout/Html_Footer',
        ]);
    }

    //==========================================================
    //Apresneta a tela de novo cliente
    public function novo_cliente()
    {
        //Verifica se já existe uma sessão iniciada
        if (Store::clientelog()) {
            $this->index();
            return;
        }

        Store::layout([
            'Layout/Html_Header',
            'Layout/Header',    //Header que contém a navegação do header
            'criar_cliente',
            'Layout/Footer',
            'Layout/Html_Footer',
        ]);
    }


    public function criar_cliente()
    {
        //Verifica se já existe sessao
        if (Store::clientelog()) {
            $this->index();
            return;
        }

        //Verifica se existe uma ação de submit
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        //Criar novo cliente
        //Verificação de senha (Senha 1 = Senha2)
        if ($_POST['text_senha_1'] !== $_POST['text_senha_2']) {

            //Senhas diferentes
            $_SESSION['erro'] = 'As senhas estão diferentes, verifique novamente';
            $this->novo_cliente();
            return;
        }

        //Base de dados Verificar se não já  existe um cliente com o mesmo email 

        $cliente = new Clientes();

        /* if ($cliente->verificar_email_existe($_POST['text_email'])) {

             $_SESSION['error'] = 'Já existe um email cadastrado';
             $this->novo_cliente();
             return;
         }
        */

        //inserir novo cliente na base de dados e devolver o purl
        $email_cliente = strtolower(trim($_POST['text_email']));
        $purl = Store::criarhash();

        //enviar do email para o cliente
        $email = new EnviarEmail();
        $resultado = $email->enviar_email_confirmacao_novo_cliente($email_cliente, $purl);
        if ($resultado == true) {
            $cliente->registrar_cliente($purl);
        }

        if ($resultado == true) {
            Store::layout([
                'Layout/Html_Header',
                'Layout/Header',    
                'criar_cliente_sucesso',
                'Layout/Footer',
                'Layout/Html_Footer',
            ]);
            return;
            
        } else {
            echo 'Aconteceu um erro';
        }


        //Criar o link purl
        $link_purl = "http://localhost/PHPSTORE/public/?a=confirmar_email&purl=$purl";
    }

    public function confirmar_email()
    {

        //verificar se já existe sessão
        if (Store::clientelog()) {
            $this->index();
            return;
        }

        //verificar se existe na query string um purl
        if (!isset($_GET['purl'])) {
            $this->index();
            return;
        }

        $purl = $_GET['purl'];

        //verifica se o purl é válido
        if (strlen($purl) != 12) {
            $this->index();
            return;
        }

        $cliente = new Clientes();
        $resultado = $cliente->validar_email($purl);

        if ($resultado) {


            Store::layout([
                'Layout/Html_Header',
                'Layout/Header',
                'criar_cliente_sucesso',
                'Layout/Footer',
                'Layout/Html_Footer',
            ]);
        } else {
            //redirecionar para a página inicial
            Store::redirect();
        }
    }





    public function login()
    {

        //Verifica se já existe um usuário logado
        if (Store::clientelog()) {
            Store::redirect();
            return;
        }

        //Apresentação do formulário de login
        Store::layout([
            'Layout/Html_Header',
            'Layout/Header',
            'Login',
            'Layout/Footer',
            'Layout/Html_Footer',
        ]);
    }


    public function Login_Submit()
    {
        //Verifica se já existe um usuário logado
        if (Store::clientelog()) {
            Store::redirect();
            return;
        }
        //Verifica se foi efetuado o Post de Login
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }
        //Valida se os campos estão corretos
        //Buscar informações no banco (ver o Login)

        if (
            !isset($_POST['text_usuario']) ||
            !isset($_POST['text_password']) ||
            !filter_var(trim($_POST['text_usuario']), FILTER_SANITIZE_EMAIL)
        ) {
            //Erro ao preencher o formulário
            $_SESSION['erro'] = 'Erro de preenchimento de formulário';
            Store::redirect();
            return;
        }
    }

    //==========================================================
    //Apresenta a pagina do carrinho
    public function carrinho()
    {
        Store::layout([
            'Layout/Html_Header',
            'Layout/Header',    //Header que contém a navegação do header
            'carrinho',
            'Layout/Footer',
            'Layout/Html_Footer',
        ]);
    }
}
