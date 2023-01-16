<?php
    
    # para poder criar sessões.
    session_start();
    // session_destroy();

    # url inicial do site para caminho.
    define('PATH_URL', 'http://localhost/Novos%20Projetos/site-linda-morena/');

    # rotas do painel 
    define('PAINEL_ROTAS_PAGINAS', ['inicio','cadastro','gerenciar'] );

    # Constantes de conexão no banco de dados.
    define('HOST','localhost');
    define('DBNAME', 'projeto_site');
    define('ROOT','root');
    define('PASSWORD', '');

    # incluindo classes - com auto load.
    include_once('./app/autoload.php');
?>