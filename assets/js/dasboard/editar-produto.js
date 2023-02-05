(() =>  {

    const BASE = document.querySelector('base').getAttribute('src');

    const resetarBotoesEstadoOriginal = (buttons) => {
    
        buttons.forEach(el => {
    
            let divPai = el.parentNode.parentNode;
            let id = el.getAttribute('showDiv');
            const MODAIS = document.getElementById(id);
            
            if (!MODAIS.classList.contains('modal-hide')) MODAIS.classList.add('modal-hide');
           
            divPai.classList.remove('active');
            divPai.classList.add('hide');
    
        });
    }
    
    const eventoDeCliqueBotao = () => {
        
        const BUTTONS = document.querySelectorAll('.btn_open_modal');
    
        BUTTONS.forEach(item => {
            
            item.addEventListener('click', (e) => {
                e.preventDefault();
                
                let divPai = item.parentNode.parentNode;
                let id = item.getAttribute('showDiv');
                const MODAL = document.getElementById(id);
        
                if (MODAL.classList.contains('modal-hide')) {
                    
                    resetarBotoesEstadoOriginal(BUTTONS);
    
                    MODAL.classList.remove('modal-hide');
    
                    divPai.classList.add('active');
                    divPai.classList.remove('hide');
        
                }
            });
        
        });
    }
    
    eventoDeCliqueBotao();
    
    const buttonDeleteProduct = () => {
        const BUTTON_DELETE = document.getElementById('deletarProduto');

        BUTTON_DELETE.addEventListener('click', (e) => {
            let condicao = confirm(`Deseja excluir o produto ?`);
            if (!condicao) e.preventDefault();
        });
        
    }

    buttonDeleteProduct();

})();

