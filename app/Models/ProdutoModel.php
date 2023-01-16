<?php

namespace Models;
use PDO;


class ProdutoModel
{
    private $db;
    private $sql;
    
    public function __construct()
    {
        $this->db = new Data;
    }
    
    public function add($dados) 
    {
        $this->sql = $this->db->connect()->prepare("INSERT INTO `tb_produtos`
        (id, id_code, id_categoria, nome , referencia, peso, quantidade, preco_atacado, preco_varejo, disponivel, slug, id_order)
        VALUES(null,?,?,?,?,?,?,?,?,?,?,?)");

        return $this->sql->execute($dados);
    }

    public function addImage($dados) {
        $this->sql =  $this->db->connect()->prepare("INSERT INTO `tb_imagens` ( id, id_produto, nome, url_path ) VALUES(null, ?,?,?)");
        return $this->sql->execute($dados);
    }

    public function checkProductInDatabase($parameter, $value) 
    {
        $this->sql = $this->db->connect()->prepare("SELECT * FROM `tb_produtos` WHERE $parameter = ?");
        $this->sql->execute(array($value));
        $product = $this->sql->fetch(PDO::FETCH_ASSOC);

        $images = $this->selectProductImages($product['id_code']);
        $product['images'] = $images;
        return $product;
    }

    public function selectAll() 
    {
        $this->sql = $this->db->connect()->prepare("SELECT * FROM `tb_produtos`");
        $this->sql->execute();
        $products = $this->sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $key => $value) {
            $images = $this->selectProductImages($value['id_code']);
            $products[$key]['images'] = $images;
        }

        return $products;
    }

    public function selectProductImages($idProduto) {
        $this->sql = $this->db->connect()->prepare("SELECT * FROM `tb_imagens` WHERE id_produto = ?");
        $this->sql->execute(array($idProduto));
        return $this->sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function theAmount() 
    {
        $this->sql = $this->db->connect()->prepare("SELECT * FROM `tb_produtos`");
        $this->sql->execute();
        return $this->sql->rowCount();
    }


}


?>