<?php
    if(count($dados) > 0 && isset($dados['success']) ) {
        $this->viewBoxAlert($dados['success'], $dados['message']);
    }
?>
<div class="contents">
    <h3>
        <div class="breadcrumbs">
            <a class="link path-1" href="<?= PATH_URL?>painel/cadastro">
                <svg width="8" height="16" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.99984 16.9201L1.47984 10.4001C0.709844 9.63008 0.709844 8.37008 1.47984 7.60008L7.99984 1.08008" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Voltar</span>
            </a>
        </div>
    </h3>
</div>
<div class="criar_categoria">
    <div class="contents">
        <h3 class="titulo_principal">Cadastrar Categoria</h3>
        
        <form method="POST">
            <div class="input_box">
                <label class="description">Nome para o categoria*</label>
                <input class="input" type="text" name="nome" placeholder="Nome...">
            </div>

            <div class="input_box">
                <input class="submit" type="submit" name="acao" value="Cadastrar categoria">
            </div>
        </form>

    </div>
</div>