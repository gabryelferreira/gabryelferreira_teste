$(document).ready(function(){
    
    //clique no botao excluir
    $(document).on ("click", ".btnExcluir", function () {
        $('.popupConfirmar').removeClass('deixarInvisivel');
        id = $(this).attr('id').split("btnExcluir");
    });
    
    //clique no botao cancelar na popup
    $(document).on ("click", ".btnCancelarPopup", function () {
        $('.popupAll').addClass('deixarInvisivel');
    });
    
    //clique no fechar na popup
    $(document).on ("click", ".fecharPopup", function () {
        $('.popupAll').addClass('deixarInvisivel');
    });
    
    //clique no botao para fechar na popup
    $(document).on ("click", ".fecharPopup", function () {
        $('.popupAll').addClass('deixarInvisivel');
    });
    
})
