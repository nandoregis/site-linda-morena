<?php

use Controllers\PainelController;

    class Application
    {   
        private $formatoArquivo;
        private $nomeController;

        public function auto(string $url) 
        {
            $this->formatoArquivo = ucfirst($url);
            $this->nomeController = $this->formatoArquivo.'Controller';

            try {
                if (
                    file_exists('./app/Controllers/'.$this->nomeController.'.php')
                ) {
                    $nomeClasse = 'Controllers\\'.$this->nomeController;
                    $controller = new $nomeClasse;

                    $controller->executar();
                    

                } else throw new Exception('Não existe esse Controller');

            }catch(Exception $e) {

                die( 'Erro: ' . $e->getMessage() );
                $this->nomeController = new PainelController;
            }

        }
    }

?>