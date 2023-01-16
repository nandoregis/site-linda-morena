<?php

namespace Controllers\Sub;

use Controllers\PainelController;
use Models\ProdutoModel;
use Route;

class GerenciarPainelSubController extends PainelController implements SubController
{   
    private $dados = array();
    private $sub_pagina;
    private $produtos;

    public function __construct(){
        $this->produtos = new ProdutoModel;
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

            $this->dados = $this->produtos->selectAll();
            $this->sub_pagina = $file_name;
            $this->adminPageRender($this->sub_pagina, $this->dados);

        }, 'produtos');

        Route::path("painel/gerenciar/produto", function($file_name) {

            // fazer essa condição.
            if(isset($_GET['code'])) {
             
                $produto = $this->produtos->checkProductInDatabase('id_code', $_GET['code']);

            }else {
                self::urlRedirectPath('painel/gerenciar/produtos');
            }
            /*-----------------------------*/

            $this->dados = $produto;
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