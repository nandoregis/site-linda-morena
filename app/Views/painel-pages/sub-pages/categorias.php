<?php


    if( isset($dados['mensagem']) ) {
        $mensagem = $dados['mensagem'];
        $this->viewBoxAlert($mensagem['success'], $mensagem['message']);
    }
    
?>
<div class="contents">
    <h3>
        <div class="breadcrumbs">
            <a class="link path-1" href="<?= PATH_URL?>painel/gerenciar">
                <svg width="8" height="16" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.99984 16.9201L1.47984 10.4001C0.709844 9.63008 0.709844 8.37008 1.47984 7.60008L7.99984 1.08008" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Voltar</span>
            </a>
        </div>
    </h3>
</div>

<div class="categorias">
    <div class="contents">
        <h2 class="titulo_principal">Todas as categorias</h2>

        <header class="categorias--header">
           <p><i class="fas fa-table"></i> Categorias cadastradas</p>
        </header>

        <div class="categorias--itens">
            <ul>
                <?php
                    $categorias = $dados['categorias'];
                    foreach ($categorias as $key => $value) :
                ?>
                    <li class="item_categ">
                        <div class="item_categ--info">
                            <span class="categ"><i class="fas fa-info-circle"></i></span>
                            <span><?=$value['nome']?></span>
                        </div>
                        <div class="item_categ--config">
                            <span data-categoria="<?=$value['nome']?>" data-id='<?=$value['id']?>' class="categ edit"><i class="fas fa-pencil"></i></span>
                            <span class="categ delete">
                                <a href="<?= PATH_URL?>painel/gerenciar/categorias?delete-categoria=<?=$value['id']?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </span>
                        </div>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
        
        <div class="categorias--modal_edit hide">
            <div class="contents">
                <div class="modal_edit--exit">
                    <i class="fas fa-times"></i>
                </div>
                <form method="POST">
                    <div class="input_box">
                        <label class="description">Nome da categoria</label>
                        <input id="categoriaEditar" type="text" name="nome" required>
                        <input id="categoriaId" type="hidden" name="id-categoria">
                    </div>
                    <div class="input_box">
                        <input class="submit" type="submit" value="Editar" name="editar-categoria">
                    </div>
                </form>
            </div>
        </div>

    </div>

    </div><!--categorias-->

    <script src="<?= PATH_URL?>assets/js/dasboard/editar-categoria.js"></script>
