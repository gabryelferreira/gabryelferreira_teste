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


include("Layouts/head.php");
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
    <script>
        
        //funcao para validar formulario
        function validarFormulario(){
            var usuario = $('#usuario').val();
            var senha = $('#senha').val();
            var senha2 = $('#senha2').val();
            
            if (usuario.trim() == ""){
                $('.erroUsuarioVazio').removeClass('deixarInvisivel');
                return false;
            } else {
                $('.erroUsuarioVazio').addClass('deixarInvisivel');
                if (usuario.length > 30){
                    $('.erroUsuarioInvalido').removeClass('deixarInvisivel');
                    return false;
                } else {
                    $('.erroUsuarioInvalido').addClass('deixarInvisivel');
                    if (senha.trim() == ""){
                        $('.erroSenhaVazio').removeClass('deixarInvisivel');
                        return false;
                    } else {
                        $('.erroSenhaVazio').addClass('deixarInvisivel');
                        if (senha.length > 30){
                            $('.erroSenhaInvalido').removeClass('deixarInvisivel');
                            return false;
                        } else {
                            $('.erroSenhaInvalido').addClass('deixarInvisivel');
                            if (senha2.trim() == ""){
                                $('.erroSenha2Vazio').removeClass('deixarInvisivel');
                                return false;
                            } else {
                                $('.erroSenha2Vazio').addClass('deixarInvisivel');
                                if (senha != senha2){
                                    $('.erroSenhasDiferentes').removeClass('deixarInvisivel');
                                    return false;
                                } else {
                                    $('.erroSenhasDiferentes').addClass('deixarInvisivel');
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
                    


            
        }//function
        

    </script>
</body>
</html>