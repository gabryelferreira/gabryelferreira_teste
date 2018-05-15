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
            <h1 class="tituloTelaMain">Corridas</h1>
            <div class="pagination-select"></div>
        </div>
        <div class="consulta">
            <div class="consultaTitulo">
                <div class="width35 campoTitulo">
                    <h1>Nome motorista</h1>
                </div>
                <div class="width35 campoTitulo">
                    <h1>Nome passageiro</h1>
                </div>
                <div class="width20 campoTitulo">
                    <h1>Valor corrida</h1>
                </div>
                <div class="width10 campoTitulo">
                    <h1>Ações</h1>
                </div>
            </div>

            <?php
            $results = ConsultaCorridaController::GetCorridas();
            foreach($results as $result){
                echo '<div id="consultaCampos'.$result[0].'" class="consultaCampos pagination-data deixarInvisivel">
                <div class="width35 campoConsulta">
                    <h1 class="azulh1">'.$result[1].'</h1>
                </div>
                <div class="width35 campoConsulta">
                    <h1 class="backImageGreen colorWhite">'.$result[2].'</h1>
                </div>
                <div class="width20 campoConsulta">
                    <h1 class="backImageRed colorWhite">R$ '.$result[3].'</h1>
                </div>
                <div class="width10 campoConsulta">
                    <input id="btnExcluir'.$result[0].'" class="btnExcluir backImageLinearRed" type="button" value="&#10006;">
                </div>
            </div>';
            }
            ?>
        </div>
        <div class="pagination"></div>
    </div>
    <div class="popupConfirmar popupAll deixarInvisivel">

        <div class="popupInside">
            <div class="popupTitle">

                <h1>Confirmação</h1>
                <input type="button" class="fecharPopup" value="X">
            </div>
            <div class="popupMessage">
                <h1>Tem certeza que deseja excluir a corrida?</h1>
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
    
    <script type="text/javascript" src="../js/pagination.js"></script>
    <script type="text/javascript" src="../js/consultamain.js"></script>
    
    <script>
        
        
        
        
        
            var id;
            
            $(document).ready ( function () {
                //clique no botao excluir
                

                //clique no botao tentar novamente na popup
                $(document).on ("click", ".btnTentarNovamentePopup", function () {
                    $('.popupAll').addClass('deixarInvisivel');
                    deletarCorrida();
                });

                
                
                

                //clique no botao confirmar na popup
                $(document).on ("click", ".btnConfirmarPopup", function () {
                    $('.popupConfirmar').addClass('deixarInvisivel');
                    deletarCorrida();
                });
                
                //funcao para deletar corrida
                function deletarCorrida(){
                    $.ajax({
                        url: '../deletarcorrida',
                        type: 'POST',
                        data: {
                            id: id[1]
                        },
                        success: function(data){
                            if (data == "1"){
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