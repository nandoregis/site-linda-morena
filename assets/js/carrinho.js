(()=> {

    const CARRINHO = document.getElementById('carrinho');
    const CARRINHO_BUTTON = document.getElementById('btn-open-carrinho');
    const EXIT_CARRINHO = document.getElementById('carrinhoExit');
    
    CARRINHO_BUTTON.addEventListener('click', () => {
        CARRINHO.classList.remove('hide');
    });

    EXIT_CARRINHO.addEventListener('click', ()=> {
        CARRINHO.classList.add('hide');
    });



})();
