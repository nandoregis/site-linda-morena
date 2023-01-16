<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= PATH_URL?>assets/css/dasboard/style.css">
    <title>Administrativo</title>
</head>
<body>
    
    <section id="admin">
       
        <!--------- INCLUIDO O menu ---------------->
        <?php
            include_once('./app/Views/painel-pages/components/menu.php');
        ?>
        
        <!------ INCLUIDO SUB PAGINAS EXE: INICIO,CADASTRO ETC --------->
        <div id="main" class="main">
            <?php
                include_once('./app/Views/painel-pages/sub-pages/'.$subPageName.'.php');
            ?>
        </div>
        
    </section>

</body>
</html>