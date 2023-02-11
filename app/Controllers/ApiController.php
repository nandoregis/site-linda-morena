<?php

namespace Controllers;

use Models\ProdutoModel;
use Route;

class ApiController
{   
  
  private $produtoModel;
  private $categoria;

  public function __construct()
  {
    $this->produtoModel = new ProdutoModel;
  }

  public function executar() 
  {

    $this->routeApiGetProduto();

  }
  
  private function routeApiGetProduto() 
  {

    Route::get('api/v1/produtos', function ($id) {
      # pegar todos os produtos
      $arr = $this->produtoModel->selectAll();
      $arr[0]['tamanhos'] = json_decode( $arr[0]['tamanhos']);
      print_r(json_encode($arr));
     
    });

    Route::get('api/v1/produtos/:id', function ($id) {
      $produtos = $this->produtoModel->selectAll('id_categoria', $id);

      if($produtos) {
        $produtos[0]['tamanhos'] = json_decode($produtos[0]['tamanhos']);
      }
      
      print_r(json_encode($produtos));
    });
    

  }


}

?>