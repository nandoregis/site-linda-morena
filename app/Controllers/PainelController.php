<?php

namespace Controllers;

use Controllers\Painel\GerenciarPainelSubController;
use Controllers\Painel\CadastroPainelSubController;
use Controllers\Painel\InicioPainelSubController;
use Models\AdminModel;
use Views\ViewPainel;
use Exception;

class PainelController
{   

    private $admin;
    private $paginaInicio;
    private $paginaCadastro;
    private $paginaGerenciar;
    private $viewPainel;

    public function __construct()
    {
        $this->admin = new AdminModel;
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

    private function verificationTheLoginToken() 
    {   

        if( !isset($_SESSION['ACCESS_ADMIN_TOKEN']) ) return false;

        $token = $_SESSION['ACCESS_ADMIN_TOKEN'];
        $validationToken = $this->admin->verificAdminLoginToken($token);
        
        if(!$validationToken) {
            $this->sessionsDestroy();
            return false;
        } else return true;
        
    }
    private function sessionsDestroy() {
        session_destroy();
        self::urlRedirectPath();
    }

    private function validationAdminlogin() 
    {
        try {

            if ( isset($_POST['action']) ) 
            {   

                $user = $_POST['user'];
                $password = $_POST['password'];

                $loginSuccess = $this->admin->connectAdmin($user, $password);
    
                if (!$loginSuccess) {
                    throw new Exception('Conta não existe');

                } else {
                    $loginSuccess = count($loginSuccess) > 0 ? 
                    $this->generateAdminLoginToken($loginSuccess) : false;
                    
                    return $loginSuccess;
                }
        
            }

        } catch (Exception $e) {
            return false;
        }     

    }

    private function generateLoginSessions(array $usuario) {

        return [
            'session_nome' => $_SESSION['NOME_ADMIN'] = $usuario['nome'],
            'session_token' => $_SESSION['ACCESS_ADMIN_TOKEN'] = uniqid('', true)
        ];
    }

    private function generateAdminLoginToken(array $usuario)
    {   
        $token = $this->generateLoginSessions($usuario)['session_token'];
        $this->admin->updateAdminLoginToken($token, $usuario['id']);
        return $token;
    }

    /**     
     *  - Funções de quando o usuario estiver logado no painel administrativo. 
     */

    private function checkAdminLoggout() {
        if(isset($_GET['loggout'])) {
            $this->sessionsDestroy();
        }
    }

    private function adminPagesInit()
    {
        if (!$this->adminPagesRoutes() ) self::urlRedirectPath('inicio');
    }
    
    protected static function urlRedirectPath( string $path = null) 
    {   
        $uri = PATH_URL.'painel/';

        if($path) $uri = PATH_URL.'painel/'.$path;

        echo "<script>location.href='$uri';</script>";
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

    /* --- METODOS DAS ROTAS --- */
    private function paginaAdminInicio() {  $this->paginaInicio->init(); }
    private function paginaAdminCadastro() { $this->paginaCadastro->init(); }
    private function paginaAdminGerenciar() { $this->paginaGerenciar->init(); }
    /*--------------------------*/
    public function executar() 
    {   
        
        $this->checkAdminLoggout();
        
        if ($this->accessOfAdminLogin() ) {
            # - pagina do adm
            $this->adminPagesInit();
        } else {
            $this->loginPageRender();
        }
    }
    
}

?>