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
         
        <form class="cadastro" action="cadastrarpassageiro" onsubmit="return validarFormulario()" method="POST"> 
            <h1 class="tituloTelaMain">Cadastro de passageiros</h1> 
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
                    <p class="erroTexto erroCPFInvalido deixarInvisivel">CPF Inválido</p>
                </div>
            </div>
            
            <div class="cadastroDiv">
                <h2>Sexo</h2>
                <select id="sexo" name="sexo">
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
    
    <script type="text/javascript" src="../js/validarformulariousuario.js"></script>
    <script type="text/javascript" src="../js/errosinvisiveis.js"></script>
    
<?php
    
include("Layouts/footer2.php");
    
?>