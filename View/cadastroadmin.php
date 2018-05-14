<?php

session_start();


$results = Admin::GetCountAdmin();
foreach($results as $result){
    if ($result[0] == 0)
        $result = 0;
    else
        $result = 1;

} 
if ($result == 1){
    header("Location: ../");
}


include("Layouts/head2.php");
include("Layouts/headercadastroadmin.php");

?>
<body>
    <div class="this-is-cadastro-passageiro configPadrao backgroundPages">
        <div class="container">
         
        <form class="cadastro" action="cadastraradmin" onsubmit="return validarFormulario()" method="POST"> 
            <h1 class="tituloTelaMain">Cadastro de Administrador</h1> 
            <div class="cadastroDiv">
                <h2>Usuario</h2>
                <input type="text" name="usuario" id="usuario" autocomplete="off">
                <div class="erroDiv" id="erroUsuario">
                    <p class="erroTexto erroUsuarioVazio deixarInvisivel">Preencha este campo</p>
                    <p class="erroTexto erroUsuarioInválido deixarInvisivel">Usuário inválido</p>
                </div>
            </div>
            
            <div class="cadastroDiv">
                <h2>Senha</h2>
                <input type="password" name="senha" id="senha" autocomplete="off">
                <div class="erroDiv" id="erroSenha">
                    <p class="erroTexto erroSenhaVazio deixarInvisivel">Preencha este campo</p>
                    <p class="erroTexto erroSenhaInvalido deixarInvisivel">Senha muito longa</p>
                </div>
            </div> 
            <div class="cadastroDiv">
                <h2>Repetir Senha</h2>
                <input type="password" name="senha2" id="senha2" autocomplete="off">
                <div class="erroDiv" id="erroSenha2">
                    <p class="erroTexto erroSenha2Vazio deixarInvisivel">Preencha este campo</p>
                    <p class="erroTexto erroSenhasDiferentes deixarInvisivel">As senha não são iguais</p>
                </div>
            </div> 
            <div class="cadastroDivBtn">
                <input type="submit" value="Cadastrar">
            </div>
        </form>
        </div>
    </div>
    
    <script type="text/javascript" src="../js/errosinvisiveis.js"></script>
    
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
        
        
        
        //funcao para validar formulario
        function validarFormulario(){
            var usuario = $('#usuario').val();
            var senha = $('#senha').val();
            var senha2 = $('#senha2').val();
            cancelarTimeOut();
            tornarErrosInvisiveis();
            
            if (usuario.trim() == ""){
                $('.erroUsuarioVazio').removeClass('deixarInvisivel');
                timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                return false;
            } else {
                if (usuario.length > 30){
                    $('.erroUsuarioInvalido').removeClass('deixarInvisivel');
                    timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                    return false;
                } else {
                    if (senha.trim() == ""){
                        $('.erroSenhaVazio').removeClass('deixarInvisivel');
                        timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                        return false;
                    } else {
                        if (senha.length > 30){
                            $('.erroSenhaInvalido').removeClass('deixarInvisivel');
                            timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                            return false;
                        } else {
                            if (senha2.trim() == ""){
                                $('.erroSenha2Vazio').removeClass('deixarInvisivel');
                                timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                                return false;
                            } else {
                                if (senha != senha2){
                                    $('.erroSenhasDiferentes').removeClass('deixarInvisivel');
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
        

    </script>
<?php
    
    include("Layouts/footercadastroadmin.php");