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
    <base href="<?=PATH_URL?>">
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
              
                </div>
            </div><!--produtos--box-->

            <div class="produtos--paginacao">
                <ul>
                    <li class="selected">1</li>
                    <li>2</li>
                    <li>3</li>
                </ul>
            </div>

        </div>
    </section>

    <?php 
        include_once('./app/Views/pages/components/footer.php');
    ?>

    <script src="<?= PATH_URL?>assets/js/home.js"></script>
</body>
</html>