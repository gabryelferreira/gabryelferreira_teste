var timeOut;
    var tempoTimeout = 4000;

    //funcao para tornar erros invisiveis
    function tornarErrosInvisiveis(){
        $('.erroTexto').addClass('deixarInvisivel');
    }

    //funcao para cancelar o timeout de deixar os erros invisíveis
    function cancelarTimeOut() {
        clearTimeout(timeOut);
    }