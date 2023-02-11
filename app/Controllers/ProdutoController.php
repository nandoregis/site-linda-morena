<?php

namespace Controllers;

use Route;
use Views\View;

class ProdutoController
{   
    
    private $view;
    public function __construct()
    {
        $this->view = new View('produto');
    }

    public function executar() 
    {
      
        Route::get('produto/:id', function() {
            $this->view->render();  
        });

        Route::get('produto', function() {
            self::redirect('inicio');
        });

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