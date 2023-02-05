<?php

namespace Controllers\Painel;

use Controllers\PainelController;
use Models\CategoriaModel;
use Models\ProdutoModel;

class InicioPainelSubController extends PainelController implements SubController
{   

    private $categoriaModel;
    private $produtoModel;
    public function __construct()
    {
       $this->categoriaModel = new CategoriaModel;
       $this->produtoModel = new ProdutoModel; 
    }

    private function getProductsAmount() {
        return $this->produtoModel->theAmount();
    }

    private function getCategorysAmount() {
        return $this->categoriaModel->theAmount();
    }

    public function init() 
    {   
        $dados = ['produtos' => $this->getProductsAmount(), 'categorias' => $this->getCategorysAmount()];
        $this->adminPageRender( 'inicio', $dados);
    }
    
}

?>