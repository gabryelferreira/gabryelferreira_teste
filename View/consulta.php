<?php

session_start();


if(!isset($_SESSION['usuario'])){
    header("Location: /corridas/");
}


include("Layouts/head.php");
include("Layouts/header.php");

?>
<body id="this-is-body-default">
    <div class="this-is-cadastro backgroundPages">
        <div class="container">
            <h1>O que deseja consultar?</h1>
            <div class="opcoesCadastro">
                <div class="opcaoCadastro">
                    <img src="https://barbabatomerodas.com.br/wp-content/uploads/2017/10/129837-x-boas-praticas-no-transito-que-todo-motorista-deveria-seguir-750x410.jpg">

                <a href="consulta/motorista">
                    <input class="backImageBlue robotoC" type="button" value="Consultar motoristas">
                </a>
                </div>
                <div class="opcaoCadastro">
                
                    <img src="https://1.bp.blogspot.com/-ImaVFwTVLws/V4aCmHN0B_I/AAAAAAAADWQ/oaPN27mEZzQGPBCQBK5L6EX43vl9HYkAACLcB/s1600/uber-rider.jpg">

                <a href="consulta/passageiro">
                    <input class="backImageGreen robotoC" type="button" value="Consultar passageiros">
                </a>
                </div>
                <div class="opcaoCadastro">
                    <img src="https://www.telegraph.co.uk/content/dam/films/2017/04/12/307773_Film-Stills_Film-The-Fast-And-The-Furious_trans_NvBQzQNjv4BqA7N2CxnJWnYI3tCbVBgu9WnOw0CSrB2VYh28D261x60.jpg?imwidth=450">

                <a href="consulta/corrida">
                    <input class="backImageRed robotoC" type="button" value="Consultar corridas">
                </a>
                </div>
            </div>
        </div>
    </div>
<?php

include("Layouts/footer.php");

?>