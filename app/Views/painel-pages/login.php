<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login do painel administrativo </title>
    
    <link rel="stylesheet" href="<?= PATH_URL?>assets/css/index.css">
    <link rel="stylesheet" href="<?= PATH_URL?>assets/css/dasboard/style.css">
</head>
<body>
    <div class="login">
        <div class="login--container">
            <div class="login--wraper">
                <h3>Efetuar login</h3>
                <div class="login--form">
                    <form method="POST">
                        <input type="text" name="user" placeholder="User...">
                        <input type="password" name="password" placeholder="Passoword...">
                        <input type="submit" name="action" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>