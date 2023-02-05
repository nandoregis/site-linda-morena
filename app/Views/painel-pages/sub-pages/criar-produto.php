<?php

    if( isset($dados['mensagem']) ) {
        $mensagem = $dados['mensagem'];
        $this->viewBoxAlert($mensagem['success'], $mensagem['message']);
    }

    if( isset($dados['inputs']) ) $input = $dados['inputs'];
    
    
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

<div class="criar_produto">
    <div class="contents">
        <h3 class="titulo_principal">Cadastro do produto</h3>
        
        <form method="POST" enctype="multipart/form-data">

            <div class="input_box">
                <label class="description">Escolher categoria</label>
                <select name="categoria" id="" required>
                    
                    <?php
                        foreach ($dados['categorias'] as $key => $value):
                    ?>
                    <option <?php if($value['id_code'] === @$input['categoria']) {echo 'selected';}?> value="<?= $value['id_code']?>"><?= $value['nome']?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="input_box">
                <label class="description">Nome para o produto*</label>
                <input class="input" type="text" name="nome" placeholder="Nome..." value="<?= @$input['nome']?>" required>
            </div>

            <div class="input_box">
                <label class="description">Referência para o produto*</label>
                <input class="input" type="number" name="referencia" placeholder="Referência..." value="<?= @$input['referencia']?>" required>
            </div>

            <div class="input_box">
                <label class="description">Peso do produto <small>*em gramas*</small> </label>
                <input class="input" type="number" name="peso" placeholder="EXE: 400g, 1000g e só é necessario apenas os numeros..." value="<?= @$input['peso']?>" required>
            </div>

            <div class="input_box_check">
                <fieldset>
                    <legend>Escolher tamanhos do produto</legend>
                    <?php
                        $tamanhos = TAMANHOS_PRODUTO;
                        foreach ($tamanhos as $key => $value) :
                    ?>
                        <div class="check">
                            <input class="input" type="checkbox" name='tamanhos[]' value="<?= $value?>">
                            <label class="description"><?= $value?></label>
                        </div>
                    <?php endforeach;?>
                    
                </fieldset>
            </div>

            <div class="input_box">
                <label class="description">Quantidade do produto</label>
                <input class="input" type="number" name="quantidade" placeholder="Inserir numeros inteiros..." value="<?= @$input['quantidade']?>" required>
            </div>

            <div class="gp_input_box">

                <div class="input_box">
                    <label class="description">Preço de atacado</label>
                    <input class="input" type="number" name="atacado" placeholder="Preço do produto em atacado..." value="<?= @$input['atacado']?>" required>
                </div>

                <div class="input_box">
                    <label class="description">Preço de varejo</label>
                    <input class="input" type="number" name="varejo" placeholder="Preço do produto em varejo..." value="<?= @$input['varejo']?>" required>
                </div>

            </div>

            <div class="input_box">
                <label class="description">Escolher imagens</label>
                <input id="criar_produto_img" class="input" type="file" name="image[]" multiple="multiple" placeholder="Escolher imagens..." required>
            </div>


            <div class="input_box">
                <input class="submit" type="submit" name="acao" value="Cadastrar produto">
            </div>

        </form>
    </div>
</div><!--criar_produto-->