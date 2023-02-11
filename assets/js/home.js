(()=> {

    const CATEGORIA = document.querySelectorAll('.produtos--nav li');

    CATEGORIA.forEach( item => {
        item.addEventListener('click', () => {
            alert(item.innerText);
        });
    });

    const getProdutos = async () => {
        const req = await fetch();
    }
    
})();

/**
 * pelas categorias pegar um atributo com identificação do id_code da categoria
 * com uma requisição pegar produtos com essa categoria.
 */