function validarFormulario(){
    var nome = $('#nome').val();
    var dtNasc = $('#dtNasc').val();
    var cpf = $('#cpf').val();
    cancelarTimeOut();
    $('.erroTexto').addClass('deixarInvisivel');

    if (nome.trim() == ""){
        $('.erroNomeVazio').removeClass('deixarInvisivel');
        timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
        return false;
    } else {
        if (nome.length > 50){
            $('.erroNomeInvalido').removeClass('deixarInvisivel');
            timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
            return false;
        } else {
            if (dtNasc == ""){
                    $('.erroDtNascVazio').removeClass('deixarInvisivel');
                    timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                    return false;
            } else {
                if (cpf.trim() == ""){
                    $('.erroCPFVazio').removeClass('deixarInvisivel');
                    timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                    return false;
                } else {
                    if (cpf.length != 11){
                        $('.erroCPFInvalido').removeClass('deixarInvisivel');
                        timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                        return false;
                    } else {
                        if (validarCPF(cpf) == false){
                            $('.erroCPFInvalido').removeClass('deixarInvisivel');
                            timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                            return false;
                        } else {
                            return true;
                        }
                    }
                }
            }
        }

    }
}


function validarCPF(cpf){
    var cpfValido = true;
    var soma = 0;
    var resto = 0;
    var numerosIguais = 0;
    var primeiroNumero = cpf[0];



    for (i = 0; i < 11; i++){
        if (cpf[i] == primeiroNumero){
            numerosIguais += 1;
        }
    }
    if (numerosIguais == 11){
        return false;
    }

    for (i = 0; i < 9; i++)
    {
        soma += parseInt(cpf[i]) * (10 - i);
    }

    resto = (soma * 10) % 11;
    if (resto == parseInt(cpf[9]))
    {

        soma = 0;
        resto = 0;

        for (i = 0; i < 10; i++)
        {
            soma += parseInt(cpf[i]) * (11 - i);
        }

        resto = (soma * 10) % 11;


        if (resto == parseInt(cpf[10])){
            cpfValido = true;
        } else {
            cpfValido = false;
        }


    }
    else
    {
        cpfValido = false;
    }
    return cpfValido;
}//function cpf