
const MODAL_EDIT = document.querySelector('.categorias--modal_edit');

const getIdCategoria = () => {
    let categorias = document.querySelectorAll('.item_categ--config .edit');
    let inputName = document.getElementById('categoriaEditar');
    let inputHidden = document.getElementById('categoriaId');


    categorias.forEach( item => {
        item.addEventListener('click', () => {
            inputName.value = item.dataset.categoria;
            inputHidden.value = item.dataset.id;
            MODAL_EDIT.classList.remove('hide');
        });
    });
}

const fecharModalEditCategoria = () => {
    let btnExitModal = document.querySelector('.modal_edit--exit');
    
    btnExitModal.addEventListener('click', () => {
        MODAL_EDIT.classList.add('hide');
    });
}

const confirmacaoDeletarCategoria = () => {
    let btnDeletar = document.querySelectorAll('.item_categ--config .delete a');

    btnDeletar.forEach( item => {
        item.addEventListener('click', (e) => {
            let condicao = confirm(`Deletando a categoria vai deletar todos os produtos com essa categoria, deseja excluir ?`);
            if (!condicao) e.preventDefault();
        });
    });
}

getIdCategoria();
fecharModalEditCategoria();
confirmacaoDeletarCategoria();
