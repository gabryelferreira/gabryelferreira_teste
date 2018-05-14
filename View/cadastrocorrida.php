<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../");
}

include("Layouts/head2.php");
include("Layouts/header2.php");

?>
<body>
    <div class="this-is-cadastro-passageiro configPadrao backgroundPages">
        <div class="container">
        <h1 class="tituloTelaMain">Registrar corridas</h1>
        <form class="cadastro" action="cadastrarcorrida" onsubmit="return validarFormulario()" method="POST"> 
            
            <div class="cadastroDiv">
                <h2>Motorista</h2>
                <select id="motorista" name="motorista">
                    <?php
                    $results = CadastroCorridaController::GetMotoristasAtivos();
                    foreach ($results as $result){
                        echo '<option value="'.$result[0].'">'.$result[1].'</option>';
                    }
                        
                    ?>
                </select>
                <div class="erroDiv" id="erroValorCorrida">
                    <p class="erroTexto erroMotoristaVazio deixarInvisivel">Selecione um motorista</p>
                </div>
            </div>
            
            
            
            <div class="cadastroDiv">
                <h2>Passageiro</h2>
                <select id="passageiro" name="passageiro">
                    <?php
                        $results = CadastroCorridaController::GetPassageiros();
                        foreach ($results as $result){
                            echo '<option value="'.$result[0].'">'.$result[1].'</option>';
                        }
                    ?>
                </select>
                <div class="erroDiv" id="erroValorCorrida">
                    <p class="erroTexto erroPassageiroVazio deixarInvisivel">Selecione um motorista</p>
                </div>
            </div>
            <div class="cadastroDiv">
                <h2>Valor da corrida</h2>
                <input type="text" name="valorCorrida" id="valorCorrida" autocomplete="off">
                <span class="unidade">R$</span>
                <div class="erroDiv" id="erroValorCorrida">
                    <p class="erroTexto erroValorCorridaVazio deixarInvisivel">Preencha este campo</p>
                </div>
            </div>
            
            
            <div class="cadastroDivBtn">
                <input type="submit" value="Registrar">
            </div>
        </form>
        </div>
    </div>
    
    <script type="text/javascript" src="../js/errosinvisiveis.js"></script>
    
    <script>
        
        
        
        
        $(document).ready(function(){
            //funcao keypress no input valor corrida para só aceitar números e . e ,
            $('#valorCorrida').keypress(function(e){
                var aceitar = false;
                var campo = $('#valorCorrida').val();
                var digitado = String.fromCharCode(e.which);
                var aceito = "0123456789,.";
                
                if (campo.length >= 7){
                    e.preventDefault();
                }
                
                for (i = 0; i < campo.length; i++){
                    if ((campo[i] == ",") || (campo[i] == ".")){
                        if (campo.length - i > 2){
                            e.preventDefault();
                        }
                        break;
                    }
                }
                for (i = 0; i < aceito.length; i++){
                    if (digitado == aceito[i]){
                        aceitar = true;
                        if ((digitado == ",") || (digitado == ".")){
                            for (i = 0; i < campo.length; i++){
                                if ((campo[i] == ",") || (campo[i] == ".")){
                                    aceitar = false;
                                    break;
                                }
                            }
                        }
                        
                        break;
                    }
                    
                    
                }
                if (!aceitar){
                    e.preventDefault();
                }
                
            })
        })
        
        //funcao para validar formulario
        function validarFormulario(){
            var motorista = $('#motorista').val();
            var passageiro = $('#motorista').val();
            var valorCorrida = $('#valorCorrida').val();
            cancelarTimeOut();
            $('.erroTexto').addClass('deixarInvisivel');
            
            if (motorista == null){
                $('.erroMotoristaVazio').removeClass('deixarInvisivel');
                timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                return false;
            } else {
                if (passageiro == null){
                    $('.erroPassageiroVazio').removeClass('deixarInvisivel');
                    timeOut = setTimeout(tornarErrosInvisiveis, tempoTimeout);
                    return false;
                } else {
                    if ((valorCorrida == ",") || (valorCorrida == ".") || (valorCorrida == "")){
                        $('.erroValorCorridaVazio').removeClass('deixarInvisivel');
                        return false;
                    } else {
                        $('.erroValorCorridaVazio').addClass('deixarInvisivel');
                        return true;
                    }
                }
                
            }
            
        }
        
    </script>
<?php
    
include("Layouts/footer2.php");
    
?>