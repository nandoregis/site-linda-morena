<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= PATH_URL?>assets/css/dasboard/style.css">
    <title>Administrativo</title>
</head>
<body>
    
    <section id="admin">
       
        <!--------- INCLUIDO O menu ---------------->
        <?php
            include_once('./app/Views/painel-pages/components/menu.php');
            include_once('./app/Views/painel-pages/components/sair.php');
        ?>
        
        <!------ INCLUIDO SUB PAGINAS EXE: INICIO,CADASTRO ETC --------->
        <div id="main" class="main">
            <?php
                include_once('./app/Views/painel-pages/sub-pages/'.$subPageName.'.php');
            ?>
        </div>
        
    </section>

    <script src="<?= PATH_URL?>assets/js/dasboard/box-alert.js"></script>
</body>
</html>