(()=> {

    const CATEGORIA = document.querySelectorAll('.produtos--nav li');
    const BASE = document.querySelector('base').getAttribute('href');
    const DIV_PRODUTO_WRAPER = document.querySelector('.produtos--wraper');

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

            } else chave = key;
            
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

    class Box {

        constructor(dados) {
            this.produtos = dados;
            this.limiteProdutos = 8;
            this.quantidade_produto = dados.length;
            this.caixas;
        }

        criarBox() {
            this.box = document.createElement('div');
            this.box.className = 'produtos--itens';
            return this.box;
        }

        criarPaginas() {

        }

        teste() {
            let pages = this.quantidade_produto / this.limiteProdutos;
            pages = Math.ceil(pages);
            let caixa = [];
            let contador = 0;
            let key = 0;

            for (let i = 0; i < pages; i++) {
                let obj = { produtos: [] }
                caixa.push([]);
            }

            
            for (let i = 0; i < this.quantidade_produto; i++) {
                
                if( contador === this.limiteProdutos ) {
                    contador = 0;
                    key++;
                }

                contador++;
                
                let prod = { id : i, images : [this.produtos[i]] };

                caixa[key].push(prod);
                
            }

            
            this.caixas = caixa;

            caixa.forEach(item => {
               console.log(item);
               let div = this.criarBox();
               
                item.forEach(el => {
                    console.log(' id : ' + el.id)
                    let p = document.createElement('p');
                    p.innerText = el.id;
                    div.append(p);
                });

                DIV_PRODUTO_WRAPER.append(div);

            });
        }

        render() {
            this.teste();
            
            
            let div = this.criarBox();
            
        }

    }



    let box = new Box([1,1,1,1,1,1,1,1,0]);

    box.render();



})();
