<?php
session_start();
if (isset($_SESSION['usuario'])){
    header("Location: cadastro");
}

include("Layouts/head.php");

?>
<body id="this-is-login-body">
    <div class="this-is-login">
        <img src="https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/user_male2-512.png">
        <h1>Login</h1>  
        
        <form class="login" action="fazerlogin" onsubmit="return validarFormulario()" method="POST"> 
        
            <tr>
                
                <td><h2>Nome de usuário</h2></td>
                
                <td><input type="text" name="usuario" id="usuario" autocomplete="off"></td>
                <?php
                    if (isset($_GET["erro"]) && $_GET["erro"] == 'usuario') {
                        echo '<div class="erroDadosIncorretos backImageRed">
                            <h1>Usuário incorreto</h1>
                            <p class="btnFecharErroDados">X</p>
                        </div>';
                    }
                ?>
                
                <div class="erroDiv" id="erroUsuario">
                    <p class="erroTexto erroUsuarioVazio deixarInvisivel">Campo obrigatório</p>
                </div>
            </tr>
            <tr>
                
                <td><h2 class="marginTop20">Senha</h2></td>
                <td><input type="password" name="senha" id="senha"></td>
                <?php
                    if (isset($_GET["erro"]) && $_GET["erro"] == 'senha') {
                        echo '<div class="erroDadosIncorretos backImageRed">
                            <h1>Senha incorreta</h1>
                            <p class="btnFecharErroDados">X</p>
                        </div>';
                    }
                ?>
                <div class="erroDiv" id="erroSenha">
                    <p class="erroTexto erroSenhaVazio deixarInvisivel">Campo obrigatório</p>
                </div>
            </tr>
            <tr>
                <td><input type="submit" class="marginTop20" id="btnEntrar" value="Entrar"></td> 
            </tr>
            
        </form>
        
        <?php
        $results = Admin::GetCountAdmin();
        foreach($results as $result){
            if ($result[0] == 0)
                $result = 0;
            else
                $result = 1;
            
        } 
        if ($result == 0){
            echo '<div class="cadastroForm"> 
                <h2>Não possui uma conta?</h2>
                <a href="cadastro/admin"><input type="submit" id="btnCadastrar" class="backImageLinearBlue" value="Cadastre-se"></a> 
        </div>';
        }
        ?>
        
    </div>
    <script>
        
        
        var timeOut;
        var tempoTimeout = 4000;
        
        
        
        setTimeout(tornarErroDadosInvisiveis, 5000);
        
        //funcao que torna os erros de usuário e senha invisíveis
        function tornarErroDadosInvisiveis(){
            $('.erroDadosIncorretos').addClass('deixarInvisivel');
        }
        
        //funcao que torna os erros invisíveis
        function tornarErrosInvisiveis(){
            $('.erroTexto').addClass('deixarInvisivel');
        }
        
        //funcao de cancelarTimeout de tornar o erros erros invisiveis
        function cancelarTimeOut() {
            clearTimeout(timeOut);
        }
        
        //funcao que valida o formulario e retorna um boolean
        function validarFormulario(){
            var usuario = $('#usuario').val();
            var senha = $('#senha').val();
            $('.erroTexto').addClass('deixarInvisivel');
            cancelarTimeOut();
            tornarErroDadosInvisiveis();
            
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
                        return true;
                    }
                }
            }
        }//function
        
        //funcao que fecha os erros de usuário e senha
        $(document).ready(function(){
            $(document).on('click', '.btnFecharErroDados', function(){
                $('.erroDadosIncorretos').addClass('deixarInvisivel');
            })
        })
        
    
    </script>
</body>
</html>