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
            <h1 class="tituloTelaMain">Motoristas</h1>
            <div class="pagination-select"></div>
        </div>
        <div class="consulta">
            <div class="consultaTitulo">
                <div class="width20 campoTitulo">
                    <h1>Nome</h1>
                </div>
                <div class="width15 campoTitulo">
                    <h1>Data de Nascimento</h1>
                </div>
                <div class="width15 campoTitulo">
                    <h1>CPF</h1>
                </div>
                <div class="width20 campoTitulo">
                    <h1>Modelo do Carro</h1>
                </div>
                <div class="width10 campoTitulo">
                    <h1>Status</h1>
                </div>
                <div class="width10 campoTitulo">
                    <h1>Sexo</h1>
                </div>
                <div class="width10 campoTitulo">
                    <h1>Ações</h1>
                </div>
            </div>
            <div class="camposConsultaDinamico">
            <?php
                $results = ConsultaMotoristaController::GetMotoristas();
                foreach($results as $result){
                    echo '<div id="consultaCampos'.$result[0].'" class="consultaCampos pagination-data deixarInvisivel">
                    <div class="width20 campoConsulta">
                        <h1>'.$result[1].'</h1>
                    </div>
                    <div class="width15 campoConsulta">
                        <h1 class="backImageGreen colorWhite">'.$result[2].'</h1>
                    </div>
                    <div class="width15 campoConsulta">
                        <h1 class="azulh1">'.$result[3].'</h1>
                    </div>
                    <div class="width20 campoConsulta">
                        <h1>'.$result[4].'</h1>
                    </div>
                    <div class="width10 campoConsulta">
                        <h1 id="'.$result[5].'" class="h1Status'.$result[0].'">'.$result[5].'</h1>
                        <select name="status" id="status" class="selectStatus'.$result[0].' deixarInvisivel">
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                    </div>
                    <div class="width10 campoConsulta">
                        <h1>'.$result[6].'</h1>
                    </div>
                    <div class="width10 campoConsulta">
                        <input id="btnEditar'.$result[0].'" class="btnEditar backImageLinearBlue" type="button" value="&#9998;">
                        <input id="btnExcluir'.$result[0].'" class="btnExcluir backImageLinearRed" type="button" value="&#10006;">
                        <input id="btnConfirmarEdicao'.$result[0].'" class="btnConfirmarEdicao backImageLinearGreen deixarInvisivel" type="button" value="&#10003;">
                    </div>
                </div>';
                }
                ?>
            </div>
            
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
                <h1>Tem certeza que deseja excluir o motorista?</h1>
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
    
    <script type="text/javascript" src="../js/pagination.js"></script>
    <script type="text/javascript" src="../js/consultamain.js"></script>
        
    <script>
        
        
        
        var id, status, statusSelecionado, funcao;
            
        
        
        $(document).ready ( function () {
            //clique no botao excluir
            
            
            
            //clique no botao tentar novamente na popup de erro
            $(document).on ("click", ".btnTentarNovamentePopup", function () {
                $('.popupAll').addClass('deixarInvisivel');
                if (funcao == 1){
                    deletarMotorista();
                } else {
                    alterarStatusMotorista();
                }
            });
            
            
            //clique no botao cancelar na popup
            
            
            

            
            
            //clique no botao de confirmar na popup
            $(document).on ("click", ".btnConfirmarPopup", function () {
                $('.popupAll').addClass('deixarInvisivel');
                funcao = 1;
                deletarMotorista();
            });
            
            //clique no botao de editar
            $(document).on ("click", ".btnEditar", function () {
                id = $(this).attr('id').split("btnEditar");
                $('.selectStatus' + id[1]).removeClass('deixarInvisivel');
                status = $('.h1Status' + id[1]).attr('id');
                $('.selectStatus' + id[1]).val(status);
                $('.selectStatus' + id[1]).removeClass('deixarInvisivel');
                $('.h1Status' + id[1]).addClass('deixarInvisivel');
                $('#btnEditar' + id[1]).addClass('deixarInvisivel');
                $('#btnExcluir' + id[1]).addClass('deixarInvisivel');
                $('#btnConfirmarEdicao' + id[1]).removeClass('deixarInvisivel');

            });
            
            
            //clique no botao de confirmar edicao
            $(document).on ("click", ".btnConfirmarEdicao", function () {
                id = $(this).attr('id').split('btnConfirmarEdicao');
                status = $('.h1Status' + id[1]).attr('id');
                statusSelecionado = $('.selectStatus' + id[1]).val();
                funcao = 2;
                alterarStatusMotorista();
                
                /**/
            });
            
            
            //funcao para alterar status do motorista
            function alterarStatusMotorista(){
                if (status != statusSelecionado){
                    if (statusSelecionado == "Inativo"){
                        status = "false";
                    } else {
                        status = "true";
                    }
                    $.ajax({
                    url: '../atualizarstatusmotorista',
                    type: 'POST',
                    data: {
                        status: status,
                        id: id[1]
                    },
                    success: function(data){
                        if (data == "1"){
                            $('.h1Status' + id[1]).text(statusSelecionado);
                            $('.h1Status' + id[1]).attr('id', statusSelecionado);
                            $('.selectStatus' + id[1]).addClass('deixarInvisivel');
                            $('.h1Status' + id[1]).removeClass('deixarInvisivel');
                            $('#btnEditar' + id[1]).removeClass('deixarInvisivel');
                            $('#btnExcluir' + id[1]).removeClass('deixarInvisivel');
                            $('#btnConfirmarEdicao' + id[1]).addClass('deixarInvisivel');
                        } else {
                            $('.selectStatus' + id[1]).addClass('deixarInvisivel');
                            $('.h1Status' + id[1]).removeClass('deixarInvisivel');
                            $('#btnEditar' + id[1]).removeClass('deixarInvisivel');
                            $('#btnExcluir' + id[1]).removeClass('deixarInvisivel');
                            $('#btnConfirmarEdicao' + id[1]).addClass('deixarInvisivel');
                            $('.popupErro').removeClass('deixarInvisivel');
                        }
                        
                    },
                    error: function(data){
                        $('.popupErro').removeClass('deixarInvisivel');
                    }
                })
                } else {
                    $('.selectStatus' + id[1]).addClass('deixarInvisivel');
                    $('.h1Status' + id[1]).removeClass('deixarInvisivel');
                    $('#btnEditar' + id[1]).removeClass('deixarInvisivel');
                    $('#btnExcluir' + id[1]).removeClass('deixarInvisivel');
                    $('#btnConfirmarEdicao' + id[1]).addClass('deixarInvisivel');
                }
                
                
            }//function
            
            //funcao para deletar motorista
            function deletarMotorista(){
                $.ajax({
                    url: '../deletarmotorista',
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
                        
                    },
                    error: function(){
                        $('.popupErro').removeClass('deixarInvisivel');
                    }
                })
            }
            
            
        });
    </script>
    
<?php
    
include("Layouts/footer2.php");
    
?>