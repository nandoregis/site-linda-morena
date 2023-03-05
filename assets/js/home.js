(()=> {

    const CATEGORIA = document.querySelectorAll('.produtos--nav li');
    const BASE = document.querySelector('base').getAttribute('href');
    const DIV_PRODUTO_WRAPER = document.querySelector('.produtos--wraper');
    const PAGINACAO = document.querySelector('.produtos--paginacao ul');

    CATEGORIA.forEach( item => {
        item.addEventListener('click', () => {
            adicionaClasseERemove(item);
            verificarCategoriaEscolhida();
            DIV_PRODUTO_WRAPER.innerHTML = "";
            PAGINACAO.innerHTML = "";
            DIV_PRODUTO_WRAPER.style = '';
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
            this.pages;
        }

        criarBox() {
            this.box = document.createElement('div');
            this.box.className = 'produtos--itens';
            return this.box;
        }

        criarPaginas() {
            let pages = this.pages;

            for(let i = 0; i < pages; i++) {
                let li = document.createElement('li');
                
                li.addEventListener('click', () => {
                    this.eventoPagina(li, i);
                });

                if(i === 0) li.className = 'selected';

                li.innerText = i + 1;

                PAGINACAO.append(li);
            };

        }

        eventoPagina(el, position) {
            let scrollLeft = position * 100;
            DIV_PRODUTO_WRAPER.style.transition = '0.6s';
            DIV_PRODUTO_WRAPER.style.marginLeft = `-${scrollLeft}%`;
            
            for(let i = 0; i < PAGINACAO.children.length; i++) 
                PAGINACAO.children[i].classList.remove('selected');
          
            el.classList.add('selected');
        }


        getDadosOrganizados() {

            let pages = this.quantidade_produto / this.limiteProdutos;
            this.pages = Math.ceil(pages);
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

            return caixa;
        }

        incluirHTML() {

            this.caixa = this.getDadosOrganizados();
            this.criarPaginas();
            this.caixa.forEach(item => {
  
               let div = this.criarBox();

                item.forEach(el => {
                    const {nome, preco_atacado, preco_varejo, id_code, slug} = el;
                    let img = el.images[0].url_path

                    let produto = new Produto(nome, img, preco_varejo, preco_atacado, id_code, slug );
                    produto = produto.criarHTMLProduto();

                    div.append(produto);
                });

                DIV_PRODUTO_WRAPER.append(div);
                this.larguraDivProdutoWraper();
            });
            
        }

        larguraDivProdutoWraper() {
        
            let width = 100 * this.pages;
            DIV_PRODUTO_WRAPER.style.width = `${width}%`;
        }

        render() {
            this.incluirHTML();
        }

    }

    class Produto {
        constructor(nome, img, varejo, atacado, idCode, slug) {
            this.nome = nome;
            this.imgSrc = img;
            this.varejo = varejo;
            this.atacado = atacado;
            this.slug = slug;
            this.id_code = idCode;
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
            this.eventoClick();

            return this.item;
        }

        eventoClick() {
            this.item.addEventListener('click', () => {
                location.href = BASE + 'produto/' + this.slug+'?id='+this.id_code;
            });
        }
    }


})();
