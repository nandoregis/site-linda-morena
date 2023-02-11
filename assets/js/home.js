(()=> {

    const CATEGORIA = document.querySelectorAll('.produtos--nav li');
    const BASE = document.querySelector('base').getAttribute('href');
    
    

    CATEGORIA.forEach( item => {
        item.addEventListener('click', () => {
            adicionaClasseERemove(item);
            verificarCategoriaEscolhida();
        });
    });

    const adicionaClasseERemove = (item) => {
        CATEGORIA.forEach(el => {
            el.classList.remove('select');
        });

        item.classList.add('select');
    }

    const verificarCategoriaEscolhida = async () => {
        let idCode;
        let liberar = true;
        let contador = CATEGORIA.length;
        let chave;

        CATEGORIA.forEach( (item, key ) => {
            if(!item.classList.contains('select') ) {
                contador--;

            } else {
                console.log('dsadfsa');
                chave = key;
            }

            
        });


        if(contador > 0) {
            // existe classe
            liberar = false;
            idCode = CATEGORIA[chave].dataset.code;
        }

        if(liberar) {
            CATEGORIA[0].classList.add('select');
            idCode = CATEGORIA[0].dataset.code;
        }

        const PRODUTOS = await getProdutos(idCode);
        console.log(PRODUTOS);
    }

    const getProdutos = async (id) => {
        let uri = `api/v1/produtos/${id}`;
        const req = await fetch(BASE+uri);
        const json = await req.json();
        return json;
    }
    
    verificarCategoriaEscolhida();


})();

/**
 * pelas categorias pegar um atributo com identificação do id_code da categoria
 * com uma requisição pegar produtos com essa categoria.
 */