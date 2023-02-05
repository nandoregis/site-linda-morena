<?php

namespace Controllers\Painel;

use Controllers\PainelController;
use Models\CategoriaModel;
use Models\ProdutoModel;
use Route;

class GerenciarPainelSubController extends PainelController implements SubController
{   
    private $dados = array();
    private $sub_pagina;
    private $produtoModel;
    private $categoriaModel;
    private $produto;
    private $categoria;

    public function __construct(){
        $this->produtoModel = new ProdutoModel;
        $this->categoriaModel = new CategoriaModel;
        $this->produto = new Produto;
        $this->categoria = new Categoria;
    }

    public function init() 
    {   
        $this->routesToPages();
    }

    private function routesToPages() 
    {
        $this->rota_gerenciar();
        $this->rota_produto();
        $this->rota_categoria();
    }

    private function rota_gerenciar() 
    {
        Route::path("painel/gerenciar", function($file_name) {
            $this->sub_pagina = $file_name;
            $this->adminPageRender($this->sub_pagina, $this->dados);

        }, 'gerenciar');
    }

    private function rota_produto() 
    {
        Route::path("painel/gerenciar/produtos", function($file_name) {

            $this->dados = $this->produtoModel->selectAll();
            $this->sub_pagina = $file_name;
            $this->adminPageRender($this->sub_pagina, $this->dados);

        }, 'produtos');

        Route::path("painel/gerenciar/produto", function($file_name) {
            
            $this->updatePost('acao-dados');
            $this->updatePost('acao-estoque');
            $this->updatePost('img-delete');
            $this->updatePostImage('acao-imagens');

            $this->addProductInfoInpage();
            $this->deleteProduct();

            $this->sub_pagina = $file_name;
            $this->adminPageRender($this->sub_pagina, $this->dados);

        }, 'editar-produto');

    }

    private function addProductInfoInPage() 
    {
        $check = $this->checkIfProductExistInUrl() ;

        if ( $check ) 
        {
            $categorias = $this->categoriaModel->getAll();
            $produto = $this->produtoModel->select('id_code', $_GET['code']);

            if (!$produto) $check = false;

            $this->dados['produto'] = $produto;
            $this->dados['categorias'] = $categorias;
        }

        if(!$check) {
            self::urlRedirectPath('gerenciar/produtos');
        }
        
    }

    private function checkIfProductExistInUrl() {
        if (!isset($_GET['code'])) return false;
        return true;
    }

    private function deleteProduct() {
        
        if ( $this->verificDeleteProduct() ) 
        {   
            $idCode = $_GET['code'];
            $this->produto->deleteDatabaseProduct($idCode);
            self::urlRedirectPath('gerenciar/produtos');
        }
    }   
    
    private function verificDeleteProduct() {
        $checkId = false;

        if(isset($_GET['delete-produto']) && isset($_GET['id'])) $checkId = $this->checkProductId(intval($_GET['id']));
        
        return $checkId;
    }

    private function checkProductId($id) {
        return $this->produtoModel->checkProductInDatabase('id', $id);
    }

    private function rota_categoria() 
    {
        Route::path("painel/gerenciar/categorias", function($file_name) {
            
            $this->updatePost('editar-categoria');

            $categorias = $this->categoriaModel->getAll();
            $this->dados['categorias'] = $categorias;
            $this->deleteCategoryById();

            $this->sub_pagina = $file_name;
            $this->adminPageRender($this->sub_pagina, $this->dados);
        }, 'categorias');
    }

    private function deleteCategoryById() {
        if (isset($_GET['delete-categoria'])) {
            $id = intval($_GET['delete-categoria']);
            $this->categoria->deleteCategory($id);
        }
    }

    private function updatePost($namePost) {
        $post = $this->checkIfExistAndGetPost($namePost);

        if ($post) $this->checkPostSubmitName($namePost, $post);
    }

    private function updatePostImage($postName) {
        if( isset($_POST[$postName])) {
            $files = $_FILES['image'];
            $this->checkPostSubmitName($postName, $files);
        }
    }
    
    private function checkPostSubmitName($postName, $post) {
        // name submit é acao-dados, acao-estoque, acao-imagens e img-delete.
        
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
                $this->insertMoreImages($post);
                $this->dados['mensagem'] = $this->produto->getAlertMessage();
                break;

            case 'img-delete':
                $this->deleteImageTheProduct($post);
                $this->dados['mensagem'] = $this->produto->getAlertMessage();
                break;
            case 'editar-categoria':
                $this->categoria->updateCategory($post);
                $this->dados['mensagem'] = $this->categoria->getAlertMessage();
                break;
            
            default:
                # code...
                break;
        }

    }

    private function insertMoreImages($files) {
        $idProdutoCode = $_GET['code'];
        return $this->produto->updateImages($files, $idProdutoCode);
    }

    private function deleteImageTheProduct($post) {
        $idImg = intval($post['img-id']);
        $idProdutoCode = $_GET['code'];
        $this->produto->deleteImage($idImg, $idProdutoCode);
    }

    protected function checkIfExistAndGetPost($post) {
        return isset( $_POST[$post] ) ? $this->removeItemOfArray($_POST, $post) : null ;
    }

    protected function removeItemOfArray($arr, $key) {
        unset($arr[$key]);
        return $arr;
    }
    
}

?>