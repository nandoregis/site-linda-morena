<?php

namespace Views;

class View
{
    private $page;
    public function __construct($pagina)
    {
        $this->page = $pagina;
    }

    public function render($dados = []) 
    {
        require_once("./app/Views/pages/".$this->page.".php"); 
    }

}


?>