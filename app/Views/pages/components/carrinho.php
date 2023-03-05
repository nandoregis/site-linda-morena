<section id="carrinho" class="container--carrinho hide">
    <div class="carrinho">
        <h2>Seus produtos</h2>
    
        <div class="carrinho--detalhes">
            <p>3 itens</p>
            <p id="carrinhoLimpar">Limpar carrinho</p>
        </div>
    
        <div class="carrinho--aviso">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit aliquid sit modi obcaecati eos consectetur ratione, commodi voluptatum nulla quisquam quos provident magni architecto assumenda non aut cupiditate libero quis?
            </p>    
        </div>
    
        <div class="carrinho--produto">
            <div class="carrinho--produto__img">
                <img src="http://localhost/Novos%20Projetos/site-linda-morena/assets/upload/img63dfcc7fc9167.jpg" alt="">
            </div>
    
            <div id="carrinhoExit" class="carrinho--exit">
                <svg width="12" height="12" viewBox="0 0 136 136" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M93.2119 67.5894L131.642 29.1594C136.358 24.4435 136.358 16.7975 131.642 12.0778L123.101 3.53692C118.385 -1.17897 110.739 -1.17897 106.019 3.53692L67.5894 41.9669L29.1594 3.53692C24.4435 -1.17897 16.7975 -1.17897 12.0778 3.53692L3.53692 12.0778C-1.17897 16.7937 -1.17897 24.4397 3.53692 29.1594L41.9669 67.5894L3.53692 106.019C-1.17897 110.735 -1.17897 118.381 3.53692 123.101L12.0778 131.642C16.7937 136.358 24.4435 136.358 29.1594 131.642L67.5894 93.2119L106.019 131.642C110.735 136.358 118.385 136.358 123.101 131.642L131.642 123.101C136.358 118.385 136.358 110.739 131.642 106.019L93.2119 67.5894Z" fill="#505050"/>
                </svg>
            </div>
    
            <div class="carrinho--produto__info">
                
                <div class="car-info--pt1">
                    <h3>Nome do produto</h3>
                    <p>Valor do produto: R$ <span>30</span>,00 </p>
                    <p class="car-info--pt1__aviso">
                        A imagem e representativa, não garatimos cores.
                    </p>
    
                    <div class="button-remover-produto">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.6875 5.75009C18.709 5.38864 14.7065 5.20244 10.7161 5.20244C8.35043 5.20244 5.98481 5.31197 3.61919 5.53103L1.18188 5.75009M7.75305 4.64385L8.0159 3.20903C8.20706 2.16852 8.35043 1.39087 10.3696 1.39087H13.4998C15.519 1.39087 15.6743 2.21233 15.8535 3.21999L16.1164 4.64385M20.1188 9.21117L19.3422 20.2406C19.2108 21.9602 19.1033 23.2965 15.7699 23.2965H8.09953C4.76616 23.2965 4.65863 21.9602 4.52721 20.2406L3.75061 9.21117M9.93946 17.2724H13.918M8.94781 12.8913H14.9216" stroke="#505050" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
    
                <div class="car-info--pt2">
                    <div class="car-info--pt2__preco-total">
                        <h3>R$ <span>20</span>,00</h3>
                    </div>
    
                    <div class="car-info--pt2__add">
                        
                            <div class="diminuir">-</div>
                            <div class="mostrar">
                                <input type="number" value="1">
                            </div>
                            <div class="adicinar">+</div>
                    </div>
                </div>
            </div>
        </div><!--carrinho--produto-->
    
        <script src="<?= PATH_URL?>assets/js/carrinho.js"></script>
    </div>
</section>
