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
<body>
    <?php 
        include_once('./app/Views/pages/components/header.php');
    ?>
    <section class="banner">
        <div class="banner--overlay"></div>
    </section>

    
    <section class="produtos">
        <div id="produto" class="container">
            <nav class="produtos--nav">
                <ul>
                    <?php
                        foreach ($dados as $key => $value) :
                    ?>
                        <li data-code="<?=$value['id_code']?>"><?= $value['nome']?></li>
                    <?php endforeach;?>
                </ul>
            </nav>

            <div class="produtos--box">
                <div class="produtos--wraper">
                    
                        <div class="produtos--itens">
                            <?php
                                for($i = 0; $i < 8; $i++):
                            ?>
                            <div class="item">
                                <img src="http://localhost/Novos%20Projetos/site-linda-morena/assets/upload/img63dfcc7fc9167.jpg" alt="">
                                <div class="item--info">
                                    <p class="item--nome">Nome do produto</p>
                                    <p>Preço varejo 25,00</p>
                                    <p>Preço atacado 20,00</p>
                                </div>
                            </div>
                            <?php endfor;?>
                        </div>
                    
                </div>
            </div><!--produtos--box-->

            <div class="produtos--paginacao">
                
            </div>

        </div>
    </section>

    <script src="<?= PATH_URL?>assets/js/home.js"></script>
</body>
</html>