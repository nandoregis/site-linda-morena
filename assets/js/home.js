(()=> {

    const CATEGORIA = document.querySelectorAll('.produtos--nav li');
    const BASE = document.querySelector('base').getAttribute('href');
    const DIV_PRODUTO_WRAPER = document.querySelector('.produtos--wraper');

    CATEGORIA.forEach( item => {
        item.addEventListener('click', () => {
            adicionaClasseERemove(item);
            verificarCategoriaEscolhida();
            DIV_PRODUTO_WRAPER.innerHTML = "";
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
        // console.log(PRODUTOS);

        let box = new Box(PRODUTOS);
        box.render();
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

                caixa[key].push(this.produtos[i]);
                
            }
            
            this.caixas = caixa;

            caixa.forEach(item => {
            //    console.log(item);
               let div = this.criarBox();
               
                item.forEach(el => {
                    
                    const {nome, preco_atacado, preco_varejo} = el;
                    let img = el.images[0].url_path
                    let produto = new Produto(nome, img, preco_varejo, preco_atacado );
                    produto = produto.criarHTMLProduto();
                    div.append(produto);
                });

                DIV_PRODUTO_WRAPER.append(div);

            });
        }

        render() {
            this.teste();
            
        }

    }

    class Produto {
        constructor(nome,img,varejo,atacado) {
            this.nome = nome;
            this.imgSrc = img;
            this.varejo = varejo;
            this.atacado = atacado;
        }

        criarHTMLProduto() {
            this.item = document.createElement('div');
            this.item.className = 'item';

            let img = document.createElement('img');
            img.src = this.imgSrc;

            let info = document.createElement('div');
            info.className = 'item--info';

            let nome = document.createElement('p');
            nome.className = 'item--nome';
            nome.innerText = this.nome;

            let varejo = document.createElement('p');
            varejo.innerText = 'Varejo R$ '+this.varejo+',00';

            let atacado = document.createElement('p');
            atacado.innerText = 'Atacado R$ '+this.atacado+',00';

            info.append(nome);
            info.append(varejo);
            info.append(atacado);

            this.item.append(img);
            this.item.append(info);

            return this.item;
        }
    }


})();
