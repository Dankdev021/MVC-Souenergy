<?php // $produto = $produtos[0]; ?>

<div class="container espaco-fundo">

    <!-- titulo da página -->
    <div class="row">
        <div class="col-12 text-center my-4">
            <a href="?a=loja&c=todos" class="btn btn-primary">Todos</a>
            <a href="?a=loja&c=homem" class="btn btn-primary">Homem</a>
            <a href="?a=loja&c=mulher" class="btn btn-primary">Mulher</a>
        </div>
    </div>

    <!-- produtos -->
    <div class="row">


        <?php foreach($produtos as $produto):?>
        <div class="col-sm-4 col-6 p-2">

            <div class="text-center p-3 box-produto">
                <img src="assets/images/produtos/<?= $produto->imagem ?>" class="img-fluid">
                <h3><?= $produto->nome_produto ?></h3>
                <h2><?= $produto->preco ?></h2>
                <div>
                    <button>Adicionar ao carrinho</button>
                </div>
            </div>    
            
        </div>
        <?php endforeach; ?>

    </div>
</div>

<!-- 

[id_produto] => 1
[categoria] => homem
[nome_produto] => Tshirt Vermelha
[descricao] => Ab laborum, commodi aspernatur, quas distinctio cum quae omnis autem ea, odit sint quisquam similique! Labore aliquam amet veniam ad fugiat optio.
[imagem] => tshirt_vermelha.png
[preco] => 45.70
[stock] => 100
[visivel] => 1
[created_at] => 2021-02-06 19:45:18
[updated_at] => 2021-02-06 19:45:25
[deleted_at] => 

 -->