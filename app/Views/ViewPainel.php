<?php

namespace Views;

class ViewPainel
{
    private $page;

    public function __construct($pagina)
    {
        $this->page = $pagina;
    }

    public function render( array $dados = [], string $subPageName = '' ) 
    {   
        require_once("./app/Views/painel-pages/".$this->page.".php");
    }

    public function viewBoxAlert( bool $result, string $mensagem) {
        if ($result) {
            echo "
                <div class='box_alert success'>
                <p>$mensagem</p>
                </div>
            ";
        }else {
            echo "
                <div class='box_alert erro'>
                <p>$mensagem</p>
                </div>
            ";
        }
    }

}


?>