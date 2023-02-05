<?php
    
    # para poder criar sessões.
    session_start();

    # url inicial do site para caminho.
    define('PATH_URL', 'http://localhost/Novos%20Projetos/site-linda-morena/');

    # tamanhos do produto.

    define('TAMANHOS_PRODUTO', ['02','04','06','08','10','12','14','16','PP','P','M',
    'G','GG','G1','G2','G3']);

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