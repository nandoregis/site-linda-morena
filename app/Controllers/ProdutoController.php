<?php

namespace Controllers;

use Models\ProdutoModel;
use Route;
use Views\View;

class ProdutoController
{   
    
    private $view;
    private $produtoModel;

    public function __construct()
    {
        $this->view = new View('produto');
        $this->produtoModel = new ProdutoModel;
    }

    public function executar() 
    {
      
        Route::get('produto/:id', function($id) {
            $id = $this->getProductIdToUri();
            $produto = $this->produtoModel->select('id_code', $id);
            $produto['tamanhos'] = json_decode($produto['tamanhos']);

            $outrosProdutos = $this->produtoModel->selectAll('id_categoria', $produto['id_categoria']);

            $outrosProdutos = $this->randomProductsAndLimitade($outrosProdutos);
            $dados = ['produto' => $produto, 'outros' => $outrosProdutos];

            $this->view->render($dados);  
        });

        Route::get('produto', function() {
            self::redirect('inicio');
        });

        

    }

    private function getProductIdToUri() {
        $uri = $_GET['id'];
        return $uri;
    }

    private function  randomProductsAndLimitade(array $matriz) {
      
        $novo_arr = [];
        if (count($matriz) > 4) {
            shuffle($matriz);
            for( $i = 0; $i < 4; $i++) {
                array_push($novo_arr,$matriz[$i]);
            }

            $matriz = $novo_arr;
        }

        shuffle($matriz);
        return $matriz;
    }

    private static function redirect( string $path = null) 
    {   
        $uri = PATH_URL;

        if($path) $uri = $uri.$path;

        echo "<script>location.href='$uri';</script>";
        die();
    }

    
}

?>