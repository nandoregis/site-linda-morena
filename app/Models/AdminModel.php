<?php

namespace Models;

use PDO;

class AdminModel
{
    private $db;
    private $sql;

    public function __construct()
    {
        $this->db = new Data;
    }

    public function connectAdmin($user, $password) 
    {
        $this->sql = $this->db->connect()->prepare("SELECT * FROM `tb_admin.login` WHERE usuario = ? AND senha = ?");
        $this->sql->execute(array($user,$password));
        
        if ($this->sql->rowCount() === 1) {
            return $this->sql->fetch(PDO::FETCH_ASSOC);
        } else return false;
    }

    public function updateAdminLoginToken($token, $id) 
    {
        $this->sql = $this->db->connect()->prepare("UPDATE `tb_admin.login` SET token = ? WHERE id = ?");
        if ( $this->sql->execute( array( $token, $id )) ) {
            return true;
        } else return false;
        
    }

}


?>