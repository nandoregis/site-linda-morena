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

}

?>