<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../");
}

include("Layouts/head.php");
include("Layouts/header2.php");

?> 
<body>
    <div class="this-is-cadastro-motorista configPadrao backgroundPages">
        <div class="container">
         
        <form class="cadastro" action="cadastrarmotorista" onsubmit="return validarFormularioMotorista()" method="POST"> 
            <h1 class="tituloTelaMain">Cadastro de motoristas</h1> 
            <div class="cadastroDiv">
                <h2>Nome completo</h2>
                <input type="text" name="nome" id="nome" autocomplete="off">
                <div class="erroDiv" id="erroNome">
                    <p class="erroTexto erroNomeVazio deixarInvisivel">Preencha este campo</p>
                    <p class="erroTexto erroNomeInvalido deixarInvisivel">Nome inválido</p>
                </div>
            </div>
            <div class="cadastroDiv">
                <h2>Data de Nascimento</h2>
                <input type="date" name="dtNasc" id="dtNasc" autocomplete="off">
                <div class="erroDiv" id="erroDtNasc">
                    <p class="erroTexto erroDtNascVazio deixarInvisivel">Preencha este campo</p>
                </div>
            </div>
            
            <div class="cadastroDiv">
                <h2>CPF</h2>
                <input type="number" name="cpf" id="cpf" autocomplete="off">
                <div class="erroDiv" id="erroCPF">
                    <p class="erroTexto erroCPFVazio deixarInvisivel">Preencha este campo</p>
                    <p class="erroTexto erroCPFInvalido deixarInvisivel">CPF Invalido</p>
                </div>
            </div>
            
            <div class="cadastroDiv">
                <h2>Modelo do carro</h2>
                <input maxlength="30" type="text" name="modeloCarro" id="modeloCarro" autocomplete="off">
                <div class="erroDiv" id="erroModeloCarro">
                    <p class="erroTexto erroModeloCarroVazio deixarInvisivel">Preencha este campo</p>
                    <p class="erroTexto erroModeloCarroInvalido deixarInvisivel">Modelo de carro extenso</p>
                </div>
            </div>
            
            <div class="cadastroDiv">
                <h2>Status</h2>
                <select name="status" id="status">
                    <option value="true">Ativo</option>
                    <option value="false">Inativo</option>
                </select>
            </div>
            
            <div class="cadastroDiv">
                <h2>Sexo</h2>
                <select name="sexo" id="sexo">
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>
            
            <div class="cadastroDivBtn">
                <input type="submit" value="Cadastrar">
            </div>
        </form>
        </div>
    </div>
    
    <script>
        var timeOut;
        var tempoTimeout = 4000;
        
        //funcao para tornar os erros de campos vazios/inválidos invisíveis
        function tornarErrosInvisiveis(){
            $('.erroTexto').addClass('deixarInvisivel');
        }
        
        //funcao para cancelar timeout de deixar os erros invisíveis
        function cancelarTimeOut() {
            clearTimeout(timeOut);
        }
        
        //funcao para validar uma parte do formulario
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
                    


            
        }//function
        
        //função para validar o formulario todo. Chama a funcao validarFormulario que valida outras informações.
        function validarFormularioMotorista(){
            var modeloCarro = $('#modeloCarro').val();
            cancelarTimeOut();
            if (validarFormulario()){
                if (modeloCarro.trim() == ""){
                    $('.erroModeloCarroVazio').removeClass('deixarInvisivel'); 
                    timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                    return false;
                } else {
                    if (modeloCarro.length > 30){
                        $('.erroModeloCarroInvalido').removeClass('deixarInvisivel');
                        timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                        return false;
                    } else {
                        return true;
                    }
                }
            } else {
                return false;
            }
            
            
        }//function
        
        
        //funcao para validar o CPF
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
        
    </script>
<?php
    
include("Layouts/footer2.php");
    
?>