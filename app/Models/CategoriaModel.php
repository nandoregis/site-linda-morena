<?php

namespace Models;
use PDO;


class CategoriaModel
{
    private $db;
    private $sql;
    
    public function __construct()
    {
        $this->db = new Data;
    }
    
    public function add($arr) {
        $this->sql = $this->db->connect()->prepare("INSERT INTO `tb_categorias` (id, id_code, nome)VALUES(null,?,?)");
        return $this->sql->execute($arr);
    }

    public function getAll() {
        $this->sql = $this->db->connect()->prepare("SELECT * FROM `tb_categorias`");
        $this->sql->execute();
        return $this->sql->fetchAll(PDO::FETCH_ASSOC);

    }

    public function get(string $param, $value) {
        $this->sql = $this->db->connect()->prepare("SELECT * FROM `tb_categorias` WHERE $param = ?");
        $this->sql->execute([$value]);
        return $this->sql->fetch(PDO::FETCH_ASSOC);
    }
    // check in the database
    public function checkInTheDatabase($paramentro, $valor) {
        $this->sql = $this->db->connect()->prepare("SELECT * FROM `tb_categorias` WHERE $paramentro = ?");
        $this->sql->execute(array($valor));
        return $this->sql->fetch(PDO::FETCH_ASSOC);

    }

    public function update($arr) {
        return $this->db->connect()->prepare("UPDATE `tb_categorias` SET nome = ? WHERE id = ?")->execute($arr);
    }

    public function delete($id) {
        return $this->db->connect()->prepare("DELETE FROM `tb_categorias` WHERE id = ?")->execute([$id]);
    }

    public function theAmount() 
    {
        $this->sql = $this->db->connect()->prepare("SELECT * FROM `tb_categorias`");
        $this->sql->execute();
        return $this->sql->rowCount();
    }
}


?>