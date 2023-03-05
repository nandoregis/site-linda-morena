<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= PATH_URL?>assets/css/index.css">
    <link rel="stylesheet" href="<?= PATH_URL?>assets/css/site/style.css">
    <title>Inicio</title>
</head>
<?php
    $outros = $dados['outros'];
    $dados = $dados['produto'];
?>

<body>
    <?php 
        include_once('./app/Views/pages/components/header.php');
    ?>
    
    <section class="produto-single">

        <div class="container">

            <div class="produto-single--nome">
                <h1><?= $dados['nome']?></h1>
            </div>
            <div class="produto-single--box">

                <div class="produto-single--img">
                    <img src="<?= $dados['images'][0]['url_path']?>" alt="<?= $dados['nome']?>" srcset="">
                </div>
    
                <div class="produto-single--info">
                    <div class="referencia">
                        <h3>REFERÊNCIA</h3>
                        <p><?= $dados['referencia']?></p>
                    </div>
    
                    <div class="tamanhos">
                        <h3>TAMANHOS</h3>
                        <p> 
                            <?php
                                $qnt = count($dados['tamanhos']);
                                for ($i=0; $i < $qnt; $i++): 
                            ?>
                                <?= $dados['tamanhos'][$i]?>
                                <?= $i < $qnt - 1 ? ' - ' : '' ?> 
                            <?php endfor;?>
                        </p>
                    </div>
    
                    <div class="valores">
                        <div class="valores--atacado">
                            <h3>ATACADO</h3>
                            <p class="preco-pd"><?= 'R$ '.$dados['preco_atacado'].',00'?></p>
                        </div>
                        <div class="valores--varejo">
                            <h3>VAREJO</h3>
                            <p class="preco-pd"><?= 'R$ '.$dados['preco_varejo'].',00'?></p>
                        </div>
                    </div>
                    
                    <div class="carrinho-btn_add">
                        <div class="carrinho-btn_add--button">
                           
                            <svg width="25" height="20" viewBox="0 0 38 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.3899 8.42499H26.596C33.7767 8.42499 34.4947 11.0485 34.9805 14.2495L36.8812 26.6245C37.4937 30.6835 35.8886 34 28.4968 34H9.51026C2.09728 34 0.49219 30.6835 1.12578 26.6245L3.02654 14.2495C3.49117 11.0485 4.20924 8.42499 11.3899 8.42499Z" stroke="#2D2D2D" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10.5451 10.9V5.125C10.5451 2.65 12.6571 1 15.825 1H22.1609C25.3288 1 27.4408 2.65 27.4408 5.125V10.9M36.7545 25.7995H10.5451" stroke="#2D2D2D" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>    
                            <span>Adicionar a o pedido</span>
                            
                        </div>
                    </div>
    
                </div>
            </div>

            <div class="produto-single--imagens">
                <?php
                    foreach ($dados['images'] as $key => $value):
                ?>
                    <img src="<?= $value['url_path']?>" alt="<?= $dados['nome']?>">
                <?php endforeach;?>
            </div>
        </div><!--container-->
    </section>

    <section class="outros-produtos">
        <div class="container">
        <div class="outros-produtos--title">
            <h2>Outros produtos</h2>
        </div>
      

            <div class="outros-produtos--box">
                
                <?php
                
                    foreach ($outros as $key => $value) :
                ?>
                    <div class="card">
                        <a href="#">
                            <div class="card--img">
                                <img src="<?=$value['images'][0]['url_path']?>" alt="">
                            </div>
                            <div class="card--info">
                                <h3><?= $value['nome']?></h3>
                                <p><?= $value['referencia']?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach;?>
            </div>
        </div><!--container-->
    </section>
    <?php 
        include_once('./app/Views/pages/components/carrinho.php');
        include_once('./app/Views/pages/components/footer.php');
    ?>
</body>
</html>