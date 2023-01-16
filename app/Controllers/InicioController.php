<?php

namespace Controllers;

use Controllers\Controller;
use Views\View;

class InicioController implements Controller
{   

    public function __construct()
    {
        $this->view = new View('home');
    }
    
    private function inicio() {

        $content = file_get_contents('https://dolarhoje.com/');
        preg_match('/<input type="text" id="nacional" value="(.*?)"\/>/s', $content, $matches);
        $dolar_vs_real = $matches[1];
        
        $this->view->render();       
    }

    public function executar() 
    {
        $this->inicio();
    }
    
}

?>