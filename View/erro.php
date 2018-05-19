<?php

session_start();


if(!isset($_SESSION['usuario'])){
    header("Location: ./");
}

include("Layouts/head.php");
include("Layouts/header.php");

?>
<body id="this-is-body-default">
    <div class="this-is-error configPadrao backgroundPages">
        <div class="container">
            <h1 class="robotoC">Ocorreu um erro</h1>
            <h2 class="robotoC">Tente novamente</h2>
            <div class="imagemErro">
                <img src="http://icons.iconarchive.com/icons/paomedia/small-n-flat/1024/sign-warning-icon.png">
            </div>
            
            <input type="button" class="opcaoErro" onclick="voltarPaginaAnterior()" value="Voltar para página anterior">
            <a class="dotErro">&middot;</a>
            <a class="opcaoErro" href="/corridas">Ir para página principal</a>
        </div>
    </div>
    <script>
        function voltarPaginaAnterior() {
            window.history.back();
        }
    </script>
<?php
    
include("Layouts/footer.php");
    
?>