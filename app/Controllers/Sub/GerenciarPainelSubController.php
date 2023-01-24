<?php

namespace Controllers\Sub;

use Controllers\PainelController;
use Models\CategoriaModel;
use Models\ProdutoModel;
use Route;

class GerenciarPainelSubController extends PainelController implements SubController
{   
    private $dados = array();
    private $sub_pagina;
    private $produtos;
    private $categorias;
    private $produto;

    public function __construct(){
        $this->produtos = new ProdutoModel;
        $this->categorias = new CategoriaModel;
        $this->produto = new Produto;
    }
    
    private function rota_gerenciar() 
    {
        Route::path("painel/gerenciar", function($file_name) {
            $this->sub_pagina = $file_name;
            $this->adminPageRender($this->sub_pagina, $this->dados);

        }, 'gerenciar');
    }


    private function checkIfProductExistInUrl() {
        if (!isset($_GET['code'])) return false;
        return true;
    }

    /** 
     *  - Esta feito sistema de update dos dados do produto.
     * 
     *  # TODO : {
     *         - Falta fazer update do estoque e o insert de mais imagens e delete de imagem.
     *         - Falta fazer o delete do produto e tudo que ela tem no banco de dados de informação e excluir da pasta upload.
     *     }    
     */
    
    private function deleteImg() {
        if(isset($_GET['img-delete'])) {
            $idImg = intval($_GET['img-delete']);

            
        }
    }

    private function updatePost($namePost) {
        $post = $this->checkIfExistAndGetPost($namePost);
        
        if ($post) $this->checkPostSubmitName($namePost, $post);
    }
    
    private function checkPostSubmitName($postName, $post) {
        // name submit é acao-dados, acao-estoque e acao-imagens.
        
        switch ($postName) {
            case 'acao-dados':
                $this->produto->updateProductData($post); 
                $this->dados['mensagem'] = $this->produto->getAlertMessage();
                break;

            case 'acao-estoque':
                $this->produto->updateProductStock($post); 
                $this->dados['mensagem'] = $this->produto->getAlertMessage();
                break;

            case 'acao-imagens':
                # code...
                break;
            
            default:
                # code...
                break;
        }


    }

    protected function checkIfExistAndGetPost($post) {
        return isset( $_POST[$post] ) ? $this->removeItemOfArray($_POST, $post) : null ;
    }

    protected function removeItemOfArray($arr, $key) {
        unset($arr[$key]);
        return $arr;
    }
    
    private function addProductInfoInPage() {
        $check = true;

        if ( $this->checkIfProductExistInUrl() ) 
        {
            $categorias = $this->categorias->getAll();
            $produto = $this->produtos->select('id_code', $_GET['code']);

            if (!$produto) $check = false;

            $this->dados['produto'] = $produto;
            $this->dados['categorias'] = $categorias;
        }

        if(!$check) {
            self::urlRedirectPath('gerenciar/produtos');
        }
        
    }

    private function rota_produto() 
    {
        Route::path("painel/gerenciar/produtos", function($file_name) {

            $this->dados = $this->produtos->selectAll();
            $this->sub_pagina = $file_name;
            $this->adminPageRender($this->sub_pagina, $this->dados);

        }, 'produtos');

        Route::path("painel/gerenciar/produto", function($file_name) {
            
            $this->updatePost('acao-dados');
            $this->updatePost('acao-estoque');
            $this->updatePost('acao-imagens');
            /*-----------------------------*/
            $this->addProductInfoInpage();

            $this->sub_pagina = $file_name;
            $this->adminPageRender($this->sub_pagina, $this->dados);

        }, 'editar-produto');
    }

    private function rota_categoria() {
        
        Route::path("painel/gerenciar/categorias", function($file_name) {
            $this->dados = ['titulo' => 'Minhas categorias'];
            $this->sub_pagina = $file_name;
            $this->adminPageRender($this->sub_pagina, $this->dados);
        }, 'categorias');
    }
    
    private function routesToPages() 
    {
        $this->rota_gerenciar();
        $this->rota_produto();
        $this->rota_categoria();
    }

    public function init() 
    {   
        $this->routesToPages();
    }
    
}

?>