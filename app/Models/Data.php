<?php

namespace Models;

use Exception;
use PDO;

class Data
{
    
    private static $pdo;
    public function connect() 
    {   

        try {
            if(!self::$pdo) {
                self::$pdo = new PDO("mysql:host=".HOST.";dbname=".DBNAME ,ROOT, PASSWORD);
                // self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

        } catch(Exception $e) {
            die('Erro de conexão com banco de dados!');
        }

        return self::$pdo;
    }

}


?>