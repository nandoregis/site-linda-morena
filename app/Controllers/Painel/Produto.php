<?php

namespace Controllers\Painel;
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
        'success',
        'message',
    ];
    private $inputsValues = [];

    public function __construct()
    {
        $this->categorias = new CategoriaModel;
        $this->produto = new ProdutoModel;
    }

    public function getAllCategorys() {
        return $this->categorias->getAll();
    }
    
    public function productRegister($post)
    {
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

    private function setValuesInputs($post) { $this->inputsValues = $post; }
    
    public function getValuesInputs() { return $this->inputsValues; }
    
    private function setAlertMessage(bool $result, string $mensagem) { $this->alertMessage = ['success' => $result, 'message' => $mensagem]; }
    
    public function getAlertMessage() { return $this->alertMessage; }

    private function validateProductInputs($post) 
    {
        $check = $this->checkIfExistEmptyInputs($post);
        
        if( $check ) {

            $post['tamanhos'] = isset($post['tamanhos']) ? $post['tamanhos'] : [];

            $form = $this->allFormInputs($post);
            $checkInputsResults = $this->checkAllFormInputs($form);

            if (!$checkInputsResults) return false;
         
            $checkInputsResults = $this->validateFilesInput($post['files']);

            $check =  $checkInputsResults;
        }
        
        return $check;
    }

    private function allFormInputs($post) 
    {
        return [
            $this->validateNameInput($post['nome']),
            $this->validateReferenceInput($post['referencia']),
            $this->validateWeightInput($post['peso']),
            $this->validateCountInput($post['quantidade']),
            $this->validateWholesaleInput($post['atacado']),
            $this->validateRetailInput($post['varejo']),
            $this->validateSizesInput($post['tamanhos'])
        ];
        
    }

    private function validateNameInput($nome) {
        $nome = $this->regexProductsInputs('nome', $nome);
        if ( !$nome ) $this->setAlertMessage(false,"Nome do produto não poder ter numeros e nem caracteres especiais.");
        
        return $nome;
    }

    private function checkIfExistReferenceInDatabase($ref, $id_code = null) {
        return $id_code === null ? $this->produto->checkProductInDatabase('referencia',$ref) : 
        $this->produto->checkProductInDatabase('referencia',$ref, $id_code);
    }

    private function validateReferenceInput($ref, $id_code = null) {
        $validateRef = true;
        
        $checkRef = $this->regexProductsInputs('referencia', $ref);

        if ( $checkRef ) {

            $checkRef = $id_code === null ? $this->checkIfExistReferenceInDatabase($ref) : 
            $this->checkIfExistReferenceInDatabase($ref, $id_code);
            // $checkRef = $this->checkIfExistReferenceInDatabase($ref);
            
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

    private function validateSizesInput($tamanhos){
        if ( !$this->checkIfArrayIsNotEmpty($tamanhos) ) {
            $this->setAlertMessage(false,'Não pode colocar o produto sem nenhum tamanho!');
            return false;
        }

        return true;
    }

    private function validateCountInput($quantidade) {
        $quantidade = $this->regexProductsInputs('quantidade', $quantidade);
        if (!$quantidade) $this->setAlertMessage(false, 'Quantidade do não pode ter letra ou caracteres especiais');
        return $quantidade;
    }

    private function validateWholesaleInput($atacado) {
        $atacado = $this->regexProductsInputs('atacado', $atacado);
        if (!$atacado) $this->setAlertMessage(false, 'Preço atacado não pode ter letra ou caracteres especiais');
        return $atacado;
    }

    private function validateRetailInput($varejo) {
        $varejo = $this->regexProductsInputs('varejo', $varejo);
        if (!$varejo) $this->setAlertMessage(false, 'Preço varejo não pode ter letra ou caracteres especiais');
        return $varejo;
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

    private function checkAllFormInputs( array $arr ) {
        foreach ($arr as $key => $value) {
            if(!$value) return false;
        };
        return true;
    }

    private function validateFilesInput($files) {
        $checkFiles = $this->checkIfArrayIsNotEmpty($files);

        if (!$checkFiles) {
            $this->setAlertMessage(false,'Precisa ter imagem do produto para poder fazer o cadastro.');
            return false;
        }

        $checkFilesTypes = $this->checkTypeFiles($files['type']);
   
        if ( !$checkFilesTypes ) {
            $this->setAlertMessage(false,'Formato da imagem não suportada, formatos aceitos - png,jpg e jpeg');
            $checkFiles = $checkFilesTypes;
        }
        
        return $checkFiles;
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

    private function checkIfExistEmptyInputs($post) 
    {
        $check = true;

        foreach ($post as $key => $value) {
            if($value === "") {
                $this->setAlertMessage(false,"Campos vazios não são permitidos!");
                return false;
            }
        }

        return $check;
    }

    private function insertProductAtTheDatabase( array $dados) 
    {
        // ---> id_code, id_categoria, nome, referencia, peso, quantidade, atacado, varejo, tamanhos, disponivel, slug e id_order.
        $idCode = $this->gerarIdCode();
        $nome = $this->capitalFirstLetter($dados['nome']);
        $slug = self::generateSlug($dados['nome']);
        $idOrder = $this->produto->theAmount() + 1;
        $peso = $this->convertKiloToGrams(intval($dados['peso']));
        $tamanhos = $this->convertArrayToJson($dados['tamanhos']);
        $disponivel = intval($dados['quantidade']) > 0 ? 1 : 0;

        $sendData = 
        [ 
            $idCode, $dados['categoria'], $nome, intval($dados['referencia']),
            $peso, intval($dados['quantidade']), intval($dados['atacado']),
            intval($dados['varejo']), $tamanhos, $disponivel, $slug, $idOrder 
        ];

        $checkProduto = $this->produto->add($sendData);
        $checkImages = $this->insertImagesAtTheDatabase($dados['files'], $idCode);
        
        if ($checkImages === false || !$checkProduto) return false;

        return true;
    }

    private function convertKiloToGrams($gramas) {
        $kilo = 1000;
        return $gramas / $kilo;
    }

    private function convertArrayToJson(array $arr) {
        //convert array to json
        return json_encode($arr);
    }

    private function insertImagesAtTheDatabase( array $files, $idProdutoCode) 
    {
        // upload da imagem e add no banco de dados com id_code do produto
        $check = true;

        $names = $this->changeFilesNameAndComeBack($files['name']);
        $upload = $this->uploadFiles($files, $names);

        if ( $upload ) {
            
            foreach ($names as $key => $value) {
                // id_produto , nome , url_path
                $url_path = PATH_URL.'assets/upload/'.$value;
                $check = $this->produto->addImage([$idProdutoCode, $value, $url_path]);
                
                if(!$check) {
                    return  $check;
                }
            }

        } else $check = false;

        return $check;
    }

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

    private function uploadFiles( array $files, array $names ) 
    {
        if(!is_array($files) && !is_array($names)) return false;
        
        foreach ($files['tmp_name'] as $key => $value) {
            $this->uploadFile($value, $names[$key]);
        }

        return true;
    }
    
    private function uploadFile($tmp_name, $file_name) 
    {
        // diretorio EXE: --> assets/upload/arquivo.jpg
        $upload = move_uploaded_file($tmp_name, 'assets/upload/'.$file_name);
        if($upload) {
            return $file_name;
        } else  return false;
    }

    /**     
    *      -> Update do dados do produto.
    */

    public function updateProductData($post) 
    {
        
        $check = $this->checkInformationUpdateData($post);
        if ($check) {

            if (!$this->updateDataOfDatabase($post)) {
                $this->setAlertMessage(false, "Não foi possivel editar, tente mais tarde ou entre em contato com o desenvolvedor!");
                return false;
            }

            $this->setAlertMessage(true, "As informações do produto foram editados com sucesso!");
            return true;

        } else return false;
    }

    private function checkInformationUpdateData($post) 
    {
        $check = $this->checkIfArrayIsNotEmpty($post);

        if(!$check) {
            $this->setAlertMessage(false, "Adicione informações nos inputs!");
            return false;
        }
        
        $check = $this->validateUpdateProductData($post);
        if(!$check) return false;   
        
        return true;

    }

    private function validateUpdateProductData($post) 
    {
            // pode executar o codigo..
        $post['tamanhos'] = isset($post['tamanhos']) ? $post['tamanhos'] : [];
        $form = $this->allFormInputsUpdate($post);
        $check = $this->checkAllFormInputs($form);

        if(!$check)  return false;
    
        return $check;
    }

    private function allFormInputsUpdate($post) 
    {
        return [
            $this->validateNameInput($post['nome']),
            $this->validateReferenceInput($post['referencia'], $this->getUrlProductIdCode()),
            $this->validateWeightInput($post['peso']),
            $this->validateSizesInput($post['tamanhos']),
            $this->validateWholesaleInput($post['atacado']),
            $this->validateRetailInput($post['varejo']),
        ];
        
    }

    private function updateDataOfDatabase ($post) 
    {
        // id_categoria, nome, referencia, peso, tamanhos, preco_atacado, preco_varejo, slug - where : id_code do produto
        $nome = $this->capitalFirstLetter($post['nome']);
        $slug = self::generateSlug($post['nome']);
        $tamanhos = $this->convertArrayToJson($post['tamanhos']);
        $peso = $this->convertKiloToGrams(intval($post['peso']));
        $idCodeProduto = $this->getUrlProductIdCode();

        $dados = [$post['categoria'], $nome, intval($post['referencia']), $peso,
        $tamanhos, intval($post['atacado']), intval($post['varejo']), $slug, $idCodeProduto];

        return $this->produto->updateDados($dados);
    }

    private function getUrlProductIdCode() {
        if(!isset($_GET['code'])) return false;
        return $_GET['code'];
    }

    /**     
    *      -> Update do estoque do produto
    */

    public function updateProductStock($post) 
    {
        $check = $this->checkInformationUpdateEstoque($post);
        if ($check) {
        
            if (!$this->updateStockOfDatabase($post)) {
                $this->setAlertMessage(false, "Não foi possivel editar, tente mais tarde ou entre em contato com o desenvolvedor!");
                return false;
            }

            $this->setAlertMessage(true, "Estoque editado com sucesso!");
            return true;
            
        }else return false;
    }

    private function checkInformationUpdateEstoque($post) {
        $check = $this->checkIfArrayIsNotEmpty($post);
        if(!$check) {
            $this->setAlertMessage(false, "Adicione informações nos inputs!");
            return false;
        }

        $quant = $this->validateCountInput($post['quantidade']);
        if(!$quant) return false;
        return true;
    }

    private function updateStockOfDatabase($post) 
    {
        // quantidade - id_code 
        $quantidade = intval($post['quantidade']);
        $disponivel = $quantidade > 0 ? 1 : 0;
        $idCode = $this->getUrlProductIdCode();

        return $this->produto->updateStock([$quantidade, $disponivel ,$idCode]);
    }

    # -> Adiciona mais imagens para o produto.

    public function updateImages(array $files, string $idProductCode) {
        $check = $this->insertImagesAtTheDatabase($files, $idProductCode);

        $check === true 
        ? $this->setAlertMessage(true,'Adicionado com sucesso!') 
        : $this->setAlertMessage(false,'Ocorreu um erro');

        return $check;
    }

    /**
     *    -> Metodos para deletar imagem.
    */

    public function deleteImage( int $idImage, string $idProduto) 
    {

        $imageData = $this->produto->selectImage( intval($idImage) );
        
        if ($imageData) 
        {
            $imageCount = $this->checkTheAmountImagesProduct($idProduto);

            if (!$imageCount) {
                $this->setAlertMessage(false,'O produto não pode ficar sem imagem!');
                return false;
            }

            $imageName = $imageData['nome'];
            $imageId = intval($imageData['id']);

            if( $this->produto->deleteImageOfDatabase('id',$imageId) ) {
                $this->deleteFileInDir( $imageName );
                $this->setAlertMessage(true,'Imagem deletada com Sucesso!');
                return true;
            }

            $this->setAlertMessage(false,'Houve um problema para apagar a imagem!');
            
        } else $this->setAlertMessage(false,'Não existe essa imagem!');
        
        return false;
    }

    private function checkTheAmountImagesProduct(string $id) 
    {
        $amout = $this->getAllImagesProduct($id);
        $amout = count($amout);
        return $amout > 1 ? true : false; 
    }

    private function getAllImagesProduct(string $idProduto) {
        return $this->produto->selectProductImages($idProduto);
    }

    private function deleteFileInDir(string $file) {
        @unlink('assets/upload/'.$file);
    }
    
    public function deleteDatabaseProduct($productIdCode) 
    {   
        $images = $this->getAllImagesProduct($productIdCode);
        $this->deleteAllProductImgTheDir($images); 
        $this->deleteAllDatabaseProductImgs($productIdCode);
        $this->produto->delete($productIdCode);
    }  
    
    private function deleteAllProductImgTheDir(array $imgs) {
        foreach ($imgs as $key => $value) $this->deleteFileInDir($value['nome']);
    }

    private function deleteAllDatabaseProductImgs(string $productIdCode) {
        $this->produto->deleteImageOfDatabase('id_produto', $productIdCode);
    }

} # class Produto

?>