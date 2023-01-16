<?php

namespace Views;

class View
{

    public function __construct($pagina)
    {
        $this->page = $pagina;
    }

    public function render() 
    {
        require_once("./app/Views/pages/".$this->page.".php"); 
    }

}


?>