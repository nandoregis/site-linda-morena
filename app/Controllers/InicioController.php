<?php

namespace Controllers;

use Controllers\Controller;
use Models\CategoriaModel;
use Views\View;

class InicioController implements Controller
{   
    private $view;
    private $categoriaModel;
    public function __construct()
    {   
        $this->categoriaModel = new CategoriaModel;
        $this->view = new View('home');
    }
    
    private function inicio() {

        $categorias = $this->categoriaModel->getAll();
        $this->view->render($categorias);       
    }

    public function executar() 
    {
        $this->inicio();
    }
    
}

?>