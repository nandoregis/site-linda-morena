<?php

namespace Controllers\Painel;
use Models\CategoriaModel;
use Models\ProdutoModel;

/**
 * 
 *  TODO -- Falta fazer sistema de update.
 */

class Categoria extends CadastroPainelSubController
{   
    private $categoria;
    private $produtoModel;
    private $produto;
    private $alertMessage = [
        'success',
        'message',
    ];
    private $database;

    public function __construct()
    {
        $this->categoria = new CategoriaModel;
        $this->produtoModel = new ProdutoModel;
        $this->produto = new Produto;
    }

    /**
    *  -> Metodos para cadastrar categorias &
    *  -> Metodos para editar categorias
    */

    private function checkIfExistCategory($check_value, $value) {
        return $this->categoria->checkInTheDatabase($check_value, $value);
    }

    private function insertCategoryAtTheDataBase($dados_post) {
        $nome = $this->capitalFirstLetter($dados_post['nome']); 
        $id_code = $this->gerarIdCode();
        return $this->categoria->add([$id_code,$nome]);   
    }

    private function setAlertMessage(bool $result, string $mensagem) {
        $this->alertMessage = ['success' => $result, 'message' => $mensagem];
    }
    
    public function getAlertMessage() {
        return $this->alertMessage;
    }

    private function setDados($arr) {
        $this->database = $arr;
    }
    private function getDados() {
        return $this->database;
    }
    
    private function regexNameCategory($nome) {
        // '/^[a-z\t-]{4,}$/',
        $pattern = "/^[a-zA-Z\s-]{4,}$/";
        return preg_match($pattern, $nome);
    }

    private function validateNameCategory($nome) {
        $regex = $this->regexNameCategory($nome);
        $condiction = true;

        if( $nome === "" || !$regex ) { 
            $condiction = false;
            $this->setAlertMessage(false,'Campos vazios ou incorretos!');

        }else {
           
            $checkName = $this->checkIfExistCategory('nome', $nome);
            if($checkName) {
                // existe no banco de dados n??o pode cadastrar
                $condiction = false;
                $this->setAlertMessage(false,'J?? existe uma categoria com esse nome!');
            }
        }
        
        return $condiction;
    }
   
    private function checkInformationForm($post) 
    {
        
        $condiction = $this->checkIfArrayIsNotEmpty($post);

        if($condiction) {
            $condiction = $this->validateNameCategory($post['nome']);
            $this->setDados($post);
        }
        
        return $condiction;
    }

    private function categoryRegister($post) {
        
        $infoForm = $this->checkInformationForm($post);
        
        if( $infoForm ) {
            $infoForm = $this->insertCategoryAtTheDataBase($this->getDados());
            
            $infoForm === true 
            ? $this->setAlertMessage(true,'Cadastro efetuado com sucesso')
            : $this->setAlertMessage(false,'O correu um erro ao cadastrar!');
        }

        return $infoForm;
    }

    public function updateCategory($post) {
        $checkCategory = $this->checkInformationForm($post);
        
        if ( $checkCategory ) {
            $checkCategory = $this->updateCategoryAtTheDataBase($post);
           
            $this->setAlertMessage(true,'Categoria editada com sucesso!');

            $checkCategory === true 
            ? $this->setAlertMessage(true,'Categoria editada com sucesso!')
            : $this->setAlertMessage(false,'O correu um erro ao editar!');
        } 

        return $checkCategory;
    }

    private function updateCategoryAtTheDataBase($dados_post) {
        $nome = $this->capitalFirstLetter($dados_post['nome']); 
        $id = intval($dados_post['id-categoria']);
        return $this->categoria->update([$nome, $id]);
    }

    public function theCategorySubmitForm( array $dadosArr, string $insertOrUpdate )
    {   

        switch ($insertOrUpdate) {
            case 'insert':
                return $this->categoryRegister($dadosArr);
                break;

            case 'update':
            
                break;
            
            default:
                # code...
                break;
        }

    }

    public function deleteCategory($id) {
        // para deletar categoria devo deletar o produto que contem a categoria
        $categoria = $this->categoria->get('id', $id);
        $produtos = $this->produtoModel->selectAllByParamenter('id_categoria',$categoria['id_code']);

        foreach ($produtos as $key => $value) {
            $this->produto->deleteDatabaseProduct($value['id_code']);
        }

        $this->categoria->delete($id);
        self::urlRedirectPath('gerenciar/categorias/');
    }

}

?>