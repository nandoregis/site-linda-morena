<?php

    if( isset($dados['mensagem']) ) {
        $mensagem = $dados['mensagem'];
        $this->viewBoxAlert($mensagem['success'], $mensagem['message']);
    }
    
?>

<div class="contents">
    <h3>
        <div class="breadcrumbs">
            <a class="link path-1" href="<?= PATH_URL?>painel/gerenciar/produtos">
                <svg width="8" height="16" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.99984 16.9201L1.47984 10.4001C0.709844 9.63008 0.709844 8.37008 1.47984 7.60008L7.99984 1.08008" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Voltar</span>
            </a>
        </div>
    </h3>
</div>

<base src='<?= PATH_URL?>'/>

<header class="editar_produto">
    <nav class="editar_produto--nav">

        <div class="contents wd20 ">
            <div class="send_to_page">
                <a showDiv='dadosProduto' class="btn_open_modal" href="#">
                    <div class="send_to_page--wraper">
                        <h3>Editar dados</h3>
                        <div class="send_to_page--icon">
                            <svg width="62" height="62" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 11C17 10.4696 17.2107 9.96086 17.5858 9.58579C17.9609 9.21071 18.4696 9 19 9C19.5304 9 20.0391 9.21071 20.4142 9.58579C20.7893 9.96086 21 10.4696 21 11C21 11.5304 20.7893 12.0391 20.4142 12.4142C20.0391 12.7893 19.5304 13 19 13C18.4696 13 17.9609 12.7893 17.5858 12.4142C17.2107 12.0391 17 11.5304 17 11ZM17 11H5M5 11C5 11.5304 4.78929 12.0391 4.41421 12.4142C4.03914 12.7893 3.53043 13 3 13C2.46957 13 1.96086 12.7893 1.58579 12.4142C1.21071 12.0391 1 11.5304 1 11C1 10.4696 1.21071 9.96086 1.58579 9.58579C1.96086 9.21071 2.46957 9 3 9C3.53043 9 4.03914 9.21071 4.41421 9.58579C4.78929 9.96086 5 10.4696 5 11ZM19 5C19.5304 5 20.0391 4.78929 20.4142 4.41421C20.7893 4.03914 21 3.53043 21 3C21 2.46957 20.7893 1.96086 20.4142 1.58579C20.0391 1.21071 19.5304 1 19 1C18.4696 1 17.9609 1.21071 17.5858 1.58579C17.2107 1.96086 17 2.46957 17 3C17 3.53043 17.2107 4.03914 17.5858 4.41421C17.9609 4.78929 18.4696 5 19 5ZM19 21C19.5304 21 20.0391 20.7893 20.4142 20.4142C20.7893 20.0391 21 19.5304 21 19C21 18.4696 20.7893 17.9609 20.4142 17.5858C20.0391 17.2107 19.5304 17 19 17C18.4696 17 17.9609 17.2107 17.5858 17.5858C17.2107 17.9609 17 18.4696 17 19C17 19.5304 17.2107 20.0391 17.5858 20.4142C17.9609 20.7893 18.4696 21 19 21Z" stroke="#505050" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17 3H13C11 3 10 4 10 6V16C10 18 11 19 13 19H17" stroke="#505050" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div><!--send_to_page--wraper-->
                </a>
            </div><!--send_to_page-->
        </div><!--contents-->

        <div class="contents wd20 ">
            <div class="send_to_page">
                <a showDiv='estoqueProduto' class="btn_open_modal" href="#">
                    <div class="send_to_page--wraper">
                        <h3>Editar estoque</h3>
                        <div class="send_to_page--icon">
                            <svg width="62" height="62" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.17004 6.43994L11 11.5499L19.77 6.46994M11 20.6099V11.5399" stroke="#505050" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.93001 1.48L3.59001 4.45C2.38001 5.12 1.39001 6.8 1.39001 8.18V13.83C1.39001 15.21 2.38001 16.89 3.59001 17.56L8.93001 20.53C10.07 21.16 11.94 21.16 13.08 20.53L18.42 17.56C19.63 16.89 20.62 15.21 20.62 13.83V8.18C20.62 6.8 19.63 5.12 18.42 4.45L13.08 1.48C11.93 0.84 10.07 0.84 8.93001 1.48Z" stroke="#505050" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 12.2401V8.5801L6.51001 3.1001" stroke="#505050" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div><!--send_to_page--wraper-->
                </a>
            </div><!--send_to_page-->
        </div><!--contents-->

        <div class="contents wd20 ">
            <div class="send_to_page">
                <a showDiv='imagensProduto' class="btn_open_modal" href="#">
                    <div class="send_to_page--wraper">
                        <h3>Editar imagens</h3>
                        <div class="send_to_page--icon">
                            <svg width="62" height="62" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.68 15.96L17.55 8.65C16.49 6.17 14.54 6.07 13.23 8.43L11.34 11.84C10.38 13.57 8.59005 13.72 7.35005 12.17L7.13005 11.89C5.84005 10.27 4.02005 10.47 3.09005 12.32L1.37005 15.77C0.160048 18.17 1.91005 21 4.59005 21H17.35C19.95 21 21.7 18.35 20.68 15.96ZM5.97005 7C6.7657 7 7.52876 6.68393 8.09137 6.12132C8.65398 5.55871 8.97005 4.79565 8.97005 4C8.97005 3.20435 8.65398 2.44129 8.09137 1.87868C7.52876 1.31607 6.7657 1 5.97005 1C5.1744 1 4.41134 1.31607 3.84873 1.87868C3.28612 2.44129 2.97005 3.20435 2.97005 4C2.97005 4.79565 3.28612 5.55871 3.84873 6.12132C4.41134 6.68393 5.1744 7 5.97005 7Z" stroke="#505050" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div><!--send_to_page--wraper-->
                </a>
            </div><!--send_to_page-->
        </div><!--contents-->

        <div class="contents wd20 ">
            <div class="send_to_page">
                <a showDiv='configProduto' class="btn_open_modal" href="#">
                    <div class="send_to_page--wraper">
                        <h3>Configuração</h3>
                        <div class="send_to_page--icon">
                            <svg width="62" height="62" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.89015 16.4901L8.19015 18.7901M18.7901 13.9301C17.8136 14.9041 16.5897 15.5931 15.2504 15.9227C13.911 16.2522 12.5072 16.2098 11.1901 15.8001L6.48015 20.5001C6.14015 20.8501 5.47015 21.0601 4.99015 20.9901L2.81015 20.6901C2.09015 20.5901 1.42015 19.9101 1.31015 19.1901L1.01015 17.0101C0.940146 16.5301 1.17015 15.8601 1.50015 15.5201L6.20015 10.8201C5.40015 8.22007 6.02015 5.27007 8.08015 3.22007C11.0301 0.270068 15.8201 0.270068 18.7801 3.22007C21.7401 6.17007 21.7401 10.9801 18.7901 13.9301Z" stroke="#505050" stroke-width="1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.5 10C13.8978 10 14.2794 9.84196 14.5607 9.56066C14.842 9.27936 15 8.89782 15 8.5C15 8.10218 14.842 7.72064 14.5607 7.43934C14.2794 7.15804 13.8978 7 13.5 7C13.1022 7 12.7206 7.15804 12.4393 7.43934C12.158 7.72064 12 8.10218 12 8.5C12 8.89782 12.158 9.27936 12.4393 9.56066C12.7206 9.84196 13.1022 10 13.5 10Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div><!--send_to_page--wraper-->
                </a>
            </div><!--send_to_page-->
        </div><!--contents-->

    </nav>
</header>

<div class="editar_produto--modal">

    <div id="dadosProduto" class="dados_produto modal-hide ">
        <div class="contents">
            <h2 class="titulo_principal">Editar dados do produto</h2>
                </br>       
            <form  method="POST">
                <div class="input_box">
                    <label class="description">Escolher categoria</label>
                    <select name="categoria" id="" required>
                       <?php
                            $produto = $dados['produto'];                          
                            foreach($dados['categorias'] as $key => $value):
                       ?>
                        <option value="<?= $value['id_code']?>" <?= $value['id_code'] === $produto['id_categoria'] ? 'selected' : ''?> >
                            <?= $value['nome']?>
                        </option>
                       <?php endforeach;?>
                    </select>
                </div>
        
                <div class="input_box">
                    <label class="description">Editar nome para o produto*</label>
                    <input class="input" type="text" name="nome" placeholder="Nome..." value="<?= @$produto['nome']?>" required>
                </div>
        
                <div class="input_box">
                    <label class="description">Editar referência para o produto*</label>
                    <input class="input" type="number" name="referencia" placeholder="Referência..." value="<?= @$produto['referencia']?>" required>
                </div>
        
                <div class="input_box">
                    <label class="description">Editar peso do produto <small>*em gramas*</small> </label>
                    <input class="input" type="number" name="peso" placeholder="EXE: 400g, 1000g e só é necessario apenas os numeros..." value="<?= @$produto['peso'] * 1000?>" required>
                </div>
                
                <div class="input_box_check">
                    <fieldset>
                        <legend>Editar tamanhos do produto</legend>
                        <?php
                            $tamanhos = json_decode($produto['tamanhos']);
                            foreach ($tamanhos as $key => $value) :
                        ?>
                            <div class="check">
                                <input class="input" type="checkbox" name='tamanhos[]' value="<?=$value?>" checked>
                                <label class="description"><?=$value?></label>
                            </div>
                        <?php endforeach;?>
                      
                    </fieldset>
                </div>
        
                <div class="gp_input_box">
        
                    <div class="input_box">
                        <label class="description">Preço de atacado</label>
                        <input class="input" type="number" name="atacado" placeholder="Preço do produto em atacado..." value="<?= @$produto['preco_atacado']?>" required>
                    </div>
        
                    <div class="input_box">
                        <label class="description">Preço de varejo</label>
                        <input class="input" type="number" name="varejo" placeholder="Preço do produto em varejo..." value="<?= @$produto['preco_varejo']?>" required>
                    </div>
        
                </div><!--gp_input_box-->
    
                <div class="input_box">
                    <input class="submit" type="submit" name="acao-dados" value="Editar dados">
                </div>

            </form>

        </div><!--contents-->
    </div>

    <div id="estoqueProduto" class="estoque_produto modal-hide ">
        <div class="contents">
            <h2 class="titulo_principal">Estoque do produto</h2>
            <br>
            <form method="POST">
                <div class="input_box">
                    <label class="description">Quantidade do produto</label>
                    <input class="input" type="number" name="quantidade" placeholder="Inserir numeros inteiros..." value="<?= @$produto['quantidade']?>" required>
                </div>

                <div class="input_box">
                    <input class="submit" type="submit" name="acao-estoque" value="Editar estoque">
                </div>
            </form>
        </div>
    </div>

    <div id="imagensProduto" class="imagens_produto modal-hide">

        <div class="contents">
            <h2 class="titulo_principal">Imagens do produto</h2>
            <br>
            <div class="all_img">
                <?php
                    foreach ($produto['images'] as $key => $value):
                ?>  
                    <div class="img_box">
                        <form method='POST'>
                            <input type="hidden" name="img-id" value="<?=$value['id']?>">
                            <label for="sub-<?=$value['id']?>" class="img_box--delete">
                                <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 4.98C15.67 4.65 12.32 4.48 8.98 4.48C7 4.48 5.02 4.58 3.04 4.78L1 4.98M6.5 3.97L6.72 2.66C6.88 1.71 7 1 8.69 1H11.31C13 1 13.13 1.75 13.28 2.67L13.5 3.97M16.85 8.14L16.2 18.21C16.09 19.78 16 21 13.21 21H6.79C4 21 3.91 19.78 3.8 18.21L3.15 8.14M8.33 15.5H11.66M7.5 11.5H12.5" stroke="#202020" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </label>
                        
                            <input id="sub-<?=$value['id']?>" type="submit" name="img-delete" value="" style="display: none;">
                        </form>
                        <img src="<?= $value['url_path']?>" alt="" srcset="">
                    </div>
                <?php endforeach;?>
            </div>
        </div>

        <div class="contents">
            <h3 class="titulo_principal">Escolher mais imagens para o produto</h3>
            <br>
            <form method="POST" enctype="multipart/form-data">
                <div class="input_box">
                    <label class="description">Escolher imagens</label>
                    <input class="input" type="file" name="image[]" multiple="multiple" placeholder="Escolher imagens..." required>
                </div>

                <div class="input_box">
                    <input class="submit" type="submit" name="acao-imagens" value="Adicionar mais imagens">
                </div>
            </form>
        </div>

    </div>

    <div id="configProduto" class="config_produto modal-hide">
        <div class="contents">
            <h2 class="titulo_principal">Configuração</h2>
            <br>
            <div class="config_produto--excluir">
                <a id="deletarProduto" href="<?= PATH_URL?>/painel/gerenciar/produto/?code=<?=$dados['produto']['id_code'].'&id='.$dados['produto']['id'].'&delete-produto=true'?>">Excluir produto</a>
            </div>
        </div>
    </div>

</div>

<script src="<?= PATH_URL.'assets/js/dasboard/editar-produto.js'?>"></script>