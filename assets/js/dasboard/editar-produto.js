
//btn_open_modal



const resetarItensEstadoOriginal = (buttons) => {

    buttons.forEach(el => {

        let divPai = el.parentNode.parentNode;
        let id = el.getAttribute('showDiv');
        const MODAIS = document.getElementById(id);
        
        if (!MODAIS.classList.contains('modal-hide')) MODAIS.classList.add('modal-hide');
       
        divPai.classList.remove('active');
        divPai.classList.add('hide');

    });
}

const eventoDeCliqueNavecao = () => {
    
    const BUTTONS = document.querySelectorAll('.btn_open_modal');

    BUTTONS.forEach(item => {
        
        item.addEventListener('click', (e) => {
            e.preventDefault();
            
            let divPai = item.parentNode.parentNode;
            let id = item.getAttribute('showDiv');
            const MODAL = document.getElementById(id);
    
            if (MODAL.classList.contains('modal-hide')) {
                
                resetarItensEstadoOriginal(BUTTONS);

                MODAL.classList.remove('modal-hide');

                divPai.classList.add('active');
                divPai.classList.remove('hide');
    
            }
        });
    
    });
}

eventoDeCliqueNavecao();