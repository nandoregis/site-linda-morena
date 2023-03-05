<?php

class Route 
{
   

    public static function path($path, $func, $paramentro = null) {
        
        $codincao = self::checkUrlPathStatus($path);
        if($codincao) $func($paramentro);
        
    }

    private static function checkUrlPathStatus(string $path) 
    {
        $urlPath = self::filterTheUrlPath();
        return $urlPath === $path ? true : false;
    }
    
    private static function filterTheUrlPath() 
    {
        $urlPath = isset($_GET['url']) ? $_GET['url']: '/';
        $urlPath = explode('/', $urlPath);
        
        foreach ($urlPath as $key => $value) 
        { 
            if($value == "") unset($urlPath[$key]); 
        }
        
        $urlPath = implode("/",$urlPath);
        
        return $urlPath;
    }

    public static function get($path, $func, $paramentro = null) {
        
        $condicao = self::checkUrlpathAndParamenter($path);

        if($condicao) {
            if(!$paramentro) $paramentro = $condicao['id'];
            $func($paramentro);
        }
        
    }

    private static function checkUrlpathAndParamenter(string $path) {
        $uri = self::filterTheUrlPath();
        return self::checkParamenterPath($path, $uri);
    }

    private static function checkParamenterPath(string $path, string $uri) {

        $arrPath = explode('/', $path);
        $arrUri = explode('/', $uri);
        $id = '';

        if( count($arrPath) != count($arrUri) ) {
            return false;
        }

        foreach ($arrPath as $key => $value) {
            
            if($value !== $arrUri[$key]) {
                if( $value != ':id') {
                    return false;
                } else {
                    $id = $arrUri[$key];
                }
           
            }
        }
        

        return ['sucess' => true, 'id' => $id];
    }

    private static function redirect($path) {
        header('Location:'.PATH_URL.$path);
        die();
    }

}

?>