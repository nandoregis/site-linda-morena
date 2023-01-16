<?php

namespace Controllers\Sub;
use Models\CategoriaModel;
use Models\ProdutoModel;

/**
 *  TODO -- criar todo sistema de cadastro do produto de nomes... até imagens.
 */

class Produto extends CadastroPainelSubController
{   

    private $categorias;
    private $produto;
    private $alertMessage = [
        'sucess',
        'message',
    ];
    private $inputsValues = [];

    public function __construct()
    {
        $this->categorias = new CategoriaModel;
        $this->produto = new ProdutoModel;
    }
    
    private function convertKiloToGrams($gramas) {
        $kilo = 1000;
        return $gramas / $kilo;
    }

    private function insertProductAtTheDatabase( array $dados) 
    {
        // ---> id_code, id_categoria, nome, referencia, peso, quantidade, atacado, varejo, disponivel, slug e id_order.
        $idCode = $this->gerarIdCode();
        $slug = self::generateSlug($dados['nome']);
        $idOrder = $this->produto->theAmount() + 1;
        $peso = $this->convertKiloToGrams(intval($dados['peso']));
        $disponivel = intval($dados['quantidade']) > 0 ? 1 : 0;

        $sendData = [ $idCode, $dados['categoria'], $dados['nome'], intval($dados['referencia']),
        $peso, intval($dados['quantidade']), intval($dados['atacado']), intval($dados['varejo']), $disponivel, $slug, $idOrder ];

        $checkProduto = $this->produto->add($sendData);
        $checkImages = $this->insertImagesAtTheDatabase($dados['files'], $idCode);
        
        if ($checkImages === false ) return false;

        return true;
    }

    private function insertImagesAtTheDatabase( array $files, $idProduto) 
    {
        // upload da imagem e add no banco de dados com id od produto
        $check = true;

        $names = $this->changeFilesNameAndComeBack($files['name']);
        $upload = $this->uploadFiles($files, $names);

        if ( $upload ) {
            
            foreach ($names as $key => $value) {
                // id_produto , nome , url_path
                $url_path = PATH_URL.'assets/upload/'.$value;
                $check = $this->produto->addImage([$idProduto, $value, $url_path]);
                
                if(!$check) {
                    return  $check;
                }
            }

        }

        return $check;
    }

    public function getAllCategorys() {
        return $this->categorias->getAll();
    }

    private function setAlertMessage(bool $result, string $mensagem) {
        $this->alertMessage = ['success' => $result, 'message' => $mensagem];
    }
    
    public function getAlertMessage() {return $this->alertMessage;}

    private function setValuesInputs($post) {$this->inputsValues = $post;}
    public function getValuesInputs() {return $this->inputsValues;}

    private function checkIfExistEmptyInputs($post) 
    {
        $check = true;

        foreach ($post as $key => $value) {
            if($value === "") {
                $check = false;
                $this->setAlertMessage(false,"Campos vazios não são permitidos!");
            }
        }

        return $check;
    }

    private function checkFilesInput($files) {
        $codiction = $this->checkIfArrayIsNotEmpty($files);
        
    }

    private function regexProductsInputs($key, $input) {
        $regexs = [ 
            'nome' => "/^[A-Za-z\s-]{4,}$/",
            'referencia' => "/^[0-9]{1,}$/",
            'peso' => "/^[0-9]{1,}$/",
            'quantidade' => "/^[0-9]{1,}$/",
            'atacado' => "/^[0-9]{1,}$/",
            'varejo' => "/^[0-9]{1,}$/",
        ];

        return preg_match($regexs[$key], $input);
    }

    private function validateNameInput($nome) {
        $nome = $this->regexProductsInputs('nome', $nome);
        if ( !$nome ) $this->setAlertMessage(false,"Nome do produto não poder ter numeros e nem caracteres especiais.");
        
        return $nome;
    }

    private function checkIfExistReferenceInDatabase($ref) {
        return $this->produto->checkProductInDatabase('referencia',$ref);
    }

    private function validateReferenceInput($ref) {
        $validateRef = true;
        
        $checkRef = $this->regexProductsInputs('referencia', $ref);

        if ( $checkRef ) {
            $checkRef = $this->checkIfExistReferenceInDatabase($ref);
            
            if ($checkRef) {
                // sendo true significa que existe um produto com essa referência.
                $validateRef = false;
                $this->setAlertMessage(false,"Já existe um produto com essa referência");
            }
            
        }else {
            $validateRef = false;
            $this->setAlertMessage(false,"Referência do produto só pode ser numeros.");
        }

        return $validateRef;
    }

    private function validateWeightInput($peso) {
        $peso = $this->regexProductsInputs('peso', $peso);
        if(!$peso) $this->setAlertMessage(false, 'Peso do não pode ter letra ou caracteres especiais');
        return $peso;
    }

    private function validateCountInput($quantidade) {
        $quantidade = $this->regexProductsInputs('quantidade', $quantidade);
        if (!$quantidade) $this->setAlertMessage(false, 'Peso do não pode ter letra ou caracteres especiais');
        return $quantidade;
    }

    private function validateWholesaleInput($atacado) {
        $atacado = $this->regexProductsInputs('atacado', $atacado);
        if (!$atacado) $this->setAlertMessage(false, 'Peso do não pode ter letra ou caracteres especiais');
        return $atacado;
    }

    private function validateRetailInput($varejo) {
        $varejo = $this->regexProductsInputs('varejo', $varejo);
        if (!$varejo) $this->setAlertMessage(false, 'Peso do não pode ter letra ou caracteres especiais');
        return $varejo;
    }

    private function typesFiles($type)
    {
        // png - jpg - jpge.
        $formats = ['png', 'jpg', 'jpeg'];
        
        $type = explode('/',$type);
        $type = $type[count($type) - 1];

        foreach ($formats as $key => $value) {
            if( $type === $value ) {
                return true;
            }
        }

        return false;
    }

    private function checkTypeFiles(array $types) {

        foreach ($types as $key => $value) {
            // echo $value;
            $type = $this->typesFiles($value);
            if(!$type) {
                return false;
            }
        }

        return true;
    }

    # metodos para upload de imagens.

    private function changeFilesNameAndComeBack(array $nomes) :array
    {      
        $newNames = [];
        foreach ($nomes as $key => $value) {
            $nome = explode('.', $value);
            $newName = uniqid('img').'.'.$nome[ count($nome) - 1];
            $newNames[$key] = $newName; 
        }
        return $newNames;
    }

    private function uploadFile($tmp_name, $file_name) 
    {
        // diretorio EXE: --> assets/upload/arquivo.jpg
        $upload = move_uploaded_file($tmp_name, 'assets/upload/'.$file_name);
        if($upload) {
            return $file_name;
        } else  return false;
    }
    
    private function uploadFiles( array $files, array $names ) 
    {
        if(!is_array($files) && !is_array($names)) return false;
        
        foreach ($files['tmp_name'] as $key => $value) {
            $this->uploadFile($value, $names[$key]);
        }

        return true;
    }
    
    private function validateFilesInput($files) {
        $checkFiles = $this->checkIfArrayIsNotEmpty($files);

        if (!$checkFiles) {
            $this->setAlertMessage(false,'Precisa tem imagem do produto para poder fazer o cadastro.');
            return false;
        }

        $checkFilesTypes = $this->checkTypeFiles($files['type']);
   
        if ( !$checkFilesTypes ) {
            $this->setAlertMessage(false,'Formato da imagem não suportada, formatos aceitos - png,jpg e jpeg');
            $checkFiles = $checkFilesTypes;
        }
        
        return $checkFiles;
    }

    // db produtos.
    private function checkAllFormInputs( array $arr ) {
        foreach ($arr as $key => $value) {
            if(!$value) return false;
        };
        return true;
    }
    
    private function allFormInputs($post) 
    {
        return [
            $this->validateNameInput($post['nome']),
            $this->validateReferenceInput($post['referencia']),
            $this->validateWeightInput($post['peso']),
            $this->validateCountInput($post['quantidade']),
            $this->validateWholesaleInput($post['atacado']),
            $this->validateRetailInput($post['varejo'])
        ];
        
    }

    private function validateProductInputs($post) 
    {
        $check = $this->checkIfExistEmptyInputs($post);
        
        if( $check ) {

            $form = $this->allFormInputs($post);
            $checkInputsResults = $this->checkAllFormInputs($form);

            if (!$checkInputsResults) return false;
         
            $checkInputsResults = $this->validateFilesInput($post['files']);

            $check =  $checkInputsResults;
        }
        
        return $check;
    }
    
    private function checkInformationForm($post) 
    {
        $condiction = $this->checkIfArrayIsNotEmpty($post);
        $this->setValuesInputs($post);

        if (!$condiction) {
            $this->setAlertMessage(false, 'Campos vazios não são permitidos!');
            return false;
        }

        $condiction = $this->validateProductInputs($post);

        return $condiction;
    }

    private function productRegister($post) {
       
       $form = $this->checkInformationForm($post);

       if ($form) {
        
            $form = $this->insertProductAtTheDatabase($post);
            if($form){
                $this->setAlertMessage(true,'Produto cadastrado com sucesso!');
            }else {
                $this->setAlertMessage(false,'Erro a o cadastrar!');
            }
       }

       return $form;
    }

     /**----------------------- */

    public function theProductFilesSubmitForm(array $files) {

    }
    public function theProductSubmitForm(array $post, $insertOrUpdate) {
        
        switch ($insertOrUpdate) {
            case 'insert':
                    return $this->productRegister($post);
                break;

            case 'update':
                # code...
                break;
            
            default:
                # code... erro --- 
                break;
        }

    }


}

?>