<?php

use core\Classes\Store;

?>
<div class="container-fluid navegacao">
    <div class="row">
        <div class="col-6 p-3">
            <a href="/inicio">
                <h1> <i class="fab fa-php"></i> </h1>
            </a>
        </div>
        <div class="col-6 text-end p-3">
            <a href="/inicio" class="nav-item">Inicio</a>
            <a href="/loja" class="nav-item">Loja</a>

            <!--Verifica se existe cliente na sessão-->
            <?php if (Store::clientelog()) : ?>

                <!-- <a href="?a=minha_conta" class="nav-item"> -->
                <!-- </a> -->

                <i class="fas fa-user "></i> <?= $_SESSION['usuario'] ?>
                <a href="/logout" class="nav-item"><i class="fas fa-sign-out-alt"></i></a>

            <?php else : ?>

                <a href="/login" class="nav-item">Login</a>
                <a href="/novo_cliente" class="nav-item">Criar conta</a>

            <?php endif; ?>
            <a href="/carrinho"> <i class="fas fa-shopping-cart"> </i> </a>
            <span class="badge bg-warning"></span>
        </div>
    </div>

</div>