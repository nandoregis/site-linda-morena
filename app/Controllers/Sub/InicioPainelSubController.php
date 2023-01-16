<?php

namespace Controllers\Sub;

use Controllers\PainelController;

class InicioPainelSubController extends PainelController implements SubController
{   

    public function __construct()
    {
        
    }

    public function init() 
    {   
        // echo $url = $_GET['url'];
        $dados = ['titulo' => 'Inicio do local',  'sub' => 'Sou muito bom cara kkkskfsjakfjdsalkfks'];
        $this->adminPageRender( 'inicio', $dados);
    }
    
}

?>