<?php

session_start();


if(!isset($_SESSION['usuario'])){
    header("Location: ../");
}

include("Layouts/head2.php");
include("Layouts/header2.php");

?>
<body id="this-is-body-default">
    
    <div class="this-is-consulta configPadrao backgroundPages">
        <div class="consultaTituloPrincipal">
            <h1 class="tituloTelaMain">Passageiros</h1>
            <div class="pagination-select"></div>
        </div>
        
        <div class="consulta">
            <div class="consultaTitulo">
                <div class="width45 campoTitulo">
                    <h1>Nome</h1>
                </div>
                <div class="width15 campoTitulo">
                    <h1>Data de Nascimento</h1>
                </div>
                <div class="width15 campoTitulo">
                    <h1>CPF</h1>
                </div>
                <div class="width15 campoTitulo">
                    <h1>Sexo</h1>
                </div>
                <div class="width10 campoTitulo">
                    <h1>Ações</h1>
                </div>
            </div>
            <div class="loading"></div>
            <?php
            $results = ConsultaPassageiroController::GetPassageiros();
            foreach($results as $result){
                echo '<div id="consultaCampos'.$result[0].'" class="consultaCampos pagination-data deixarInvisivel">
                <div class="width45 campoConsulta">
                    <h1>'.$result[1].'</h1>
                </div>
                <div class="width15 campoConsulta">
                    <h1 class="backImageGreen colorWhite">'.$result[2].'</h1>
                </div>
                <div class="width15 campoConsulta">
                    <h1 class="azulh1">'.$result[3].'</h1>
                </div>
                <div class="width15 campoConsulta">
                    <h1>'.$result[4].'</h1>
                </div>
                <div class="width10 campoConsulta">
                    <input id="btnExcluir'.$result[0].'" class="btnExcluir backImageLinearRed" type="button" value="&#10006;">
                </div>
            </div>';
            }
            ?>
        </div>
        <div class="pagination">
        </div>
    </div>
    
    <div class="popupConfirmar popupAll deixarInvisivel">

        <div class="popupInside">
            <div class="popupTitle">

                <h1>Confirmação</h1>
                <input type="button" class="fecharPopup" value="X">
            </div>
            <div class="popupMessage">
                <h1>Tem certeza que deseja excluir o passageiro?</h1>
                <h2>Todas as corridas cadastradas com o usuário serão deletadas.</h2>
                <div class="btnsPopup">

                    <input type="button" class="btnConfirmarPopup backImageGreen colorWhite" value="Confirmar">
                    <input type="button" class="btnCancelarPopup transparent colorGray" value="Cancelar">
                </div>
            </div>

        </div>

    </div>
    
    <div class="popupErro popupAll deixarInvisivel">
        <div class="popupInside">
            <div class="popupTitle">

                <h1>Erro</h1>
                <input type="button" class="fecharPopup" value="X">
            </div>
            <div class="popupMessage">
                <h1>Erro de conexão.</h1>
                <div class="btnsPopup">

                    <input type="button" class="btnTentarNovamentePopup backImageRed colorWhite" value="Tentar novamente">
                    <input type="button" class="btnCancelarPopup transparent colorGray" value="Cancelar">
                </div>
            </div>

        </div>
    </div>
        <script type="text/javascript" src="../js/loading.js"></script>
        <script type="text/javascript" src="../js/pagination.js"></script>
        <script type="text/javascript" src="../js/consultamain.js"></script>
        
        <script>
            
            window.addEventListener("load", function(){
                $(loading).css('display', 'none');
            })
            
             
            var id;
            
            $(document).ready ( function () {
                

                //clique no botao de tentar novamente
                $(document).on ("click", ".btnTentarNovamentePopup", function () {
                    $('.popupAll').addClass('deixarInvisivel');
                    deletarPassageiro();
                });
                
                
                
                


                //clique no botao confirmar
                $(document).on ("click", ".btnConfirmarPopup", function () {
                    $('.popupAll').addClass('deixarInvisivel');
                    deletarPassageiro();
                });
                
                //funcao para deletar o passageiro
                function deletarPassageiro(){
                    $.ajax({
                        url: '../deletarpassageiro',
                        type: 'POST',
                        data: {
                            id: id[1]
                        },
                        success: function(data){
                            if (data == 1){
                                $('#consultaCampos' + id[1]).remove();
                                updatePagination();
                            } else {
                                $('.popupErro').removeClass('deixarInvisivel');
                            }
                            
                        }
                    })
                }

            
            
            });
    </script>
<?php
    
include("Layouts/footer2.php");
    
?>