<?php

namespace Controllers\Painel;

use Controllers\PainelController;
use Route;

class CadastroPainelSubController extends PainelController implements SubController
{   
    
    private $dados = [];
    private $sub_pagina;
    private $produto;
    private $categoria;
    
    public function __construct()
    {
        $this->produto = new Produto;
        $this->categoria = new Categoria;
    }

    protected static function generateSlug($str) {
        $str = mb_strtolower($str);
        $str = preg_replace('/(â|á|ã)/', 'a', $str);
        $str = preg_replace('/(ê|é)/', 'e', $str);
        $str = preg_replace('/(í|Í)/', 'i', $str);
        $str = preg_replace('/(ú)/', 'u', $str);
        $str = preg_replace('/(ó|ô|õ|Ô)/', 'o',$str);
        $str = preg_replace('/(_|\/|!|\?|#)/', '',$str);
        $str = preg_replace('/( )/', '-',$str);
        $str = preg_replace('/ç/','c',$str);
        $str = preg_replace('/(-[-]{1,})/','-',$str);
        $str = preg_replace('/(,)/','-',$str);
        $str=strtolower($str);
        return $str;
    }

    protected function checkIfExistAndGetPost($post) {
        return isset( $_POST[$post] ) ? $this->removeItemOfArray($_POST, $post) : null ;
    }

    public function capitalFirstLetter($text) {
        $text = strtolower($text);
        return ucfirst($text);
    }

    protected function removeItemOfArray($arr, $key) {
        unset($arr[$key]);
        return $arr;
    }

    protected function checkIfArrayIsNotEmpty($arr) {
        return empty($arr) ? false : true;
    }

    protected function gerarIdCode() {
        return md5(uniqid(rand(), true));
    }

    private function rota_cadastro() 
    {
        Route::path("painel/cadastro", function($file_name) {

            $this->sub_pagina = $file_name;
            $this->adminPageRender($this->sub_pagina, $this->dados);
        }, 'cadastro');
    }

    private function cadastro_produto() 
    {
        $post = $this->checkIfExistAndGetPost('acao');
            
        if($post) {
           
            $post['files'] = isset($_FILES['image']) ? $_FILES['image'] : [];

            $post = $this->produto->productRegister($post);
            
            if (!$post) $this->dados['inputs'] = $this->produto->getValuesInputs();
            $this->dados['mensagem'] = $this->produto->getAlertMessage();
        }
    }

    private function rota_produto() 
    {
        Route::path("painel/cadastro/produto", function($file_name) {
            
            $categorias = $this->produto->getAllCategorys();
            $this->dados = ['categorias' => $categorias];

            $this->cadastro_produto();

            $this->sub_pagina = $file_name;
            $this->adminPageRender($this->sub_pagina, $this->dados);

        }, 'criar-produto');
    }

    private function cadastro_categoria() {
        $post = $this->checkIfExistAndGetPost('acao');
    
        if ($post) {
            $this->categoria->theCategorySubmitForm($post, 'insert');
            $this->dados = $this->categoria->getAlertMessage();
        }
    }

    private function rota_categoria() 
    {
        Route::path("painel/cadastro/categoria", function() {
             
            $this->cadastro_categoria();
            
            $this->sub_pagina = 'criar-categoria';
            $this->adminPageRender($this->sub_pagina, $this->dados);

        });
    }

    private function routesToPages() 
    {
        $this->rota_cadastro();
        $this->rota_produto();
        $this->rota_categoria();
    }

    public function init() 
    {   
        $this->routesToPages();
    }
    
}

?>