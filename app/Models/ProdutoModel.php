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
        (id, id_code, id_categoria, nome , referencia, peso, quantidade, preco_atacado, preco_varejo, tamanhos, disponivel, slug, id_order)
        VALUES(null,?,?,?,?,?,?,?,?,?,?,?,?)");

        return $this->sql->execute($dados);
    }

    public function delete($productIdCode) {
        return $this->db->connect()->prepare("DELETE FROM `tb_produtos` WHERE id_code = ?")->execute([$productIdCode]);
    }

    public function addImage($dados) {
        $this->sql =  $this->db->connect()->prepare("INSERT INTO `tb_imagens` ( id, id_produto, nome, url_path ) VALUES(null, ?,?,?)");
        return $this->sql->execute($dados);
    }

    public function checkProductInDatabase($parameter, $value, $value_two = null) 
    {   
        if (!$value_two) {
            $query = "SELECT * FROM `tb_produtos` WHERE $parameter = ?";
            $arr = [$value];
        }else {
            $query = "SELECT * FROM `tb_produtos` WHERE $parameter = ? AND id_code != ?";
            $arr = [$value, $value_two];
        }
        
        $this->sql = $this->db->connect()->prepare($query);
        $this->sql->execute($arr);
        return $this->sql->rowCount() === 0 ? false : true;
        
    }

    public function select($parameter, $value) 
    {
        $this->sql = $this->db->connect()->prepare("SELECT * FROM `tb_produtos` WHERE $parameter = ?");
        $this->sql->execute(array($value));
        $product = $this->sql->fetch(PDO::FETCH_ASSOC);

        if( !$product ) return false;

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

    public function selectAllByParamenter($parameter, $value) {
        $this->sql = $this->db->connect()->prepare("SELECT * FROM `tb_produtos` WHERE $parameter = ?");
        $this->sql->execute([$value]);
        return $this->sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectProductImages($idProduto) 
    {
        $this->sql = $this->db->connect()->prepare("SELECT * FROM `tb_imagens` WHERE id_produto = ?");
        $this->sql->execute(array($idProduto));
        return $this->sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectImage($id) 
    {
        $this->sql = $this->db->connect()->prepare("SELECT * FROM `tb_imagens` WHERE id = ?");
        $this->sql->execute([$id]);
        return $this->sql->fetch(PDO::FETCH_ASSOC);
    }

    public function theAmount() 
    {
        $this->sql = $this->db->connect()->prepare("SELECT * FROM `tb_produtos`");
        $this->sql->execute();
        return $this->sql->rowCount();
    }

    public function updateDados($dados) 
    {
        $this->sql = $this->db->connect()->prepare("UPDATE `tb_produtos` SET 
        id_categoria=?,nome=?,referencia=?,peso=?,tamanhos=?,preco_atacado=?,preco_varejo=?,slug=? WHERE id_code = ?");
        return $this->sql->execute($dados);
    }

    public function updateStock($dados) {
        return $this->db->connect()->prepare("UPDATE `tb_produtos` SET quantidade = ?, disponivel = ? WHERE id_code = ?")->execute($dados);
    }
    
    public function deleteImageOfDatabase($parameter, $idImage) {
        return $this->db->connect()->prepare("DELETE FROM `tb_imagens` WHERE $parameter=?")->execute([$idImage]);
    }
}


?>