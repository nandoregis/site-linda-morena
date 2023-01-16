<?php

namespace Controllers;

use Controllers\Sub\GerenciarPainelSubController;
use Controllers\Sub\CadastroPainelSubController;
use Controllers\Sub\InicioPainelSubController;
use Models\AdminModel;
use Views\ViewPainel;
use Exception;

class PainelController
{   

    private $loginOfAdmin;
    private $paginaInicio;
    private $paginaCadastro;
    private $paginaGerenciar;
    private $viewPainel;

    public function __construct()
    {
        $this->loginOfAdmin = new AdminModel;
        $this->paginaInicio = new InicioPainelSubController;
        $this->paginaCadastro = new CadastroPainelSubController;
        $this->paginaGerenciar = new GerenciarPainelSubController;
        
    }

    private function includePage( string $pageName) 
    {   
        return $this->viewPainel = new ViewPainel($pageName);
    }
    
    private function loginPageRender() {$this->includePage('login')->render();}

    protected function adminPageRender(string $subPageName, array $dados = []) 
    {   
        if( !is_array($dados)) return false;
        $this->includePage('admin')->render($dados, $subPageName); 
    }
    
    private function validationAdminlogin() 
    {
        try {

            if ( isset($_POST['action']) ) 
            {   

                $user = $_POST['user'];
                $password = $_POST['password'];

                $loginSuccess = $this->loginOfAdmin->connectAdmin($user, $password);
    
                if (!$loginSuccess) {
                    throw new Exception('Conta não existe');

                } else {
                    $loginSuccess = count($loginSuccess) > 0 ? 
                    $this->generateAdminLoginToken($loginSuccess['id']) : false;

                    return $loginSuccess;
                }
        
            }

        } catch (Exception $e) {
            return false;
        }     

    }
    
    private function generateAdminLoginToken($id)
    {   
        $token = $_SESSION['ACCESS_ADMIN_TOKEN'] = uniqid('', true);
        $this->loginOfAdmin->updateAdminLoginToken($token, $id);
        return $token;
    }
  
    private function verificationTheLoginToken() 
    {   
        /**
         *  TODO: fazer requisição no banco de dados para ver se token ainda é valido
         */
        return isset($_SESSION['ACCESS_ADMIN_TOKEN']);
    }
 
    private function accessOfAdminLogin()
    {

        $verificationTokenExists = $this->verificationTheLoginToken();

        switch ($verificationTokenExists) {
            case true:
                return true;
                break;
            default:
                return $this->validationAdminlogin();
                break;
        }
    }

    /**     
     *  - Funções de quando o usuario estiver logado no painel administrativo. 
     */

    private function adminPagesInit()
    {
        if (!$this->adminPagesRoutes() ) self::urlRedirectPath('inicio');
    }

    protected static function urlRedirectPath( string $path) 
    {
        header('Location:'.PATH_URL.'painel/'.$path);
        die();
    }

    private function adminPagesRoutes() 
    {
      
        $url = isset($_GET['url']) ? explode('/',$_GET['url']): '';
        $url = count($url) > 1 && $url[1] != "" ? $url[1] : '';

        
        $rotas = PAINEL_ROTAS_PAGINAS;
        
        $liberarRota = $this->verficPagesRoutes($rotas, $url);

        if ( $liberarRota ) { 
           $liberarRota = $this->getTheAdminPages($url);
        }
        
        return $liberarRota;
    
    }

    private function verficPagesRoutes(array $routes, $path) 
    {   
        $confirmedRoute = false;
        foreach ($routes as $key => $value) {
            if($path === $value) {
                $confirmedRoute = true;
            }
        }

        return $confirmedRoute;
    }

    private function getTheAdminPages($url) 
    {   
        $metodoName = 'paginaAdmin'.ucfirst($url);
        $func = '$this->'.$metodoName.'();';
        
        if ( method_exists( $this, $metodoName ) ) {
            eval($func);
            return true;
        } else return false;
    }

    private function paginaAdminInicio() {  $this->paginaInicio->init(); }
    private function paginaAdminCadastro() { $this->paginaCadastro->init(); }
    private function paginaAdminGerenciar() { $this->paginaGerenciar->init(); }

    public function executar() 
    {   

       if ($this->accessOfAdminLogin() ) {
            # - pagina do adm
            $this->adminPagesInit();
        } else {
            $this->loginPageRender();
        }
    }
    
}

?>