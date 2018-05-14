<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../");
}


include("Layouts/head.php");
include("Layouts/header2.php");

?>
<body id="this-is-body-default">
    <div class="this-is-consulta configPadrao backgroundPages">
        <div class="consultaTituloPrincipal">
            <h1 class="tituloTelaMain">Corridas</h1>
            <select class="selectRowsSelect">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
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
                echo '<div id="consultaCampos'.$result[0].'" class="consultaCampos">
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
        <div class="paginasConsulta">
        
        </div>
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
    <script>
        
        
        
        var camposUsuarios = [];
            var numeroDePaginas;
            var numRows = 5;
            var paginaAtual = 0;
            var paginaClick = 0;
            var maxPaginas = 2;
            var ultimaPaginaShow;
            calcularNumeroDePaginas(paginaAtual);
            
            
            $(document).ready(function(){
                $(document).on('click', '.btnPagina',function(){
                    var pagina = this.id.split("btnNumeroPagina");
                    paginaClick = pagina[1];
                    mostrarNumeroDePaginas(paginaClick);
                })
                $(document).on('click', '.btnPaginaAnterior',function(){
                    if (paginaAtual - 1 >= 0){
                        paginaClick = parseInt(paginaClick) - 1;
                        mostrarNumeroDePaginas(paginaClick);
                    }
                        
                })
                $(document).on('click', '.btnPaginaSeguinte',function(){
                    if (paginaClick + 1 < numeroDePaginas){
                        paginaClick = parseInt(paginaClick) + 1;
                        mostrarNumeroDePaginas(paginaClick);
                    }
                        
                })
                
                $(document).on('change', '.selectRowsSelect',function(){
                    numRows = $('.selectRowsSelect').val();
                    paginaAtual = 0;
                    calcularNumeroDePaginas(paginaAtual);
                })
                
            })
            
            
            function mostrarContentPagina(pagina){
                
                var qtd = parseInt(camposUsuarios.length);
                for (i = 0; i < qtd; i++){
                    $('#' + camposUsuarios[i]).addClass('deixarInvisivel');
                    $('#' + camposUsuarios[i]).removeClass('displayFlex');
                    
                }
                
                if (qtd - pagina*numRows > numRows){
                    qtd = parseInt(numRows);
                } else {
                    qtd = parseInt(qtd) - parseInt(pagina*numRows);
                }
                for (i = parseInt(pagina*numRows); i < parseInt(parseInt(pagina*numRows) + parseInt(qtd)); i++){
                    $('#' + camposUsuarios[i]).addClass('displayFlex');
                    $('#' + camposUsuarios[i]).removeClass('deixarInvisivel');
                }
                
            }//function
            
            
            
            
            
            
            function mostrarNumeroDePaginas(pagina){
                
                mostrarPaginasDo0(pagina);
                mostrarContentPagina(pagina);
                
            }//function
            
            
            function mostrarPaginasDo0(pagina){
                $('#btnNumeroPagina' + paginaAtual).removeClass('azulh1');
                paginaAtual = pagina;
                $('.paginasConsulta').html('<input type="button" class="btnPaginaAnterior transparent" value="Anterior">');
                var paginas;
//                if (numeroDePaginas >= maxPaginas){
//                    paginas = maxPaginas;
//                } else {
//                    paginas = numeroDePaginas;
//                }
                for (i = 0; i < numeroDePaginas; i++){
                    $('.paginasConsulta').append('<input type="button" class="btnPagina transparent" id="btnNumeroPagina' + (i) + '" value="' + (i+1) + '">');
                    ultimaPaginaShow = i;
                }
                $('.paginasConsulta').append('<input type="button" class="btnPaginaSeguinte transparent" value="Próxima">');
                $('#btnNumeroPagina' + paginaAtual).addClass('azulh1');
            }
            
            
            function calcularNumeroDePaginas(pagina){
                camposUsuarios = [];
                $( ".consultaCampos").map(function() {
                    camposUsuarios.push(this.id);

                  })
                numeroDePaginas = camposUsuarios.length/numRows;
                numeroDePaginas = numeroDePaginas.toString();
                var virgula = false;
                for (i = 0; i  < numeroDePaginas.length; i++){
                    if (numeroDePaginas[i] == "."){
                        
                        virgula = true;
                        break;
                    }
                }
                if (virgula == true){
                    numeroDePaginas = numeroDePaginas.split(".");
                    numeroDePaginas = parseInt(numeroDePaginas[0]);
                    numeroDePaginas += 1;
                } else {
                    numeroDePaginas = parseInt(numeroDePaginas);
                }
                
                if (pagina >= numeroDePaginas){
                    pagina -= 1;
                }
                mostrarNumeroDePaginas(pagina);
                
            }//function
        
        
        
        
        
        
            var id;
            
            $(document).ready ( function () {
                //clique no botao excluir
                $(document).on ("click", ".btnExcluir", function () {
                    $('.popupConfirmar').removeClass('deixarInvisivel');
                    id = $(this).attr('id').split("btnExcluir");
                });

                //clique no botao tentar novamente na popup
                $(document).on ("click", ".btnTentarNovamentePopup", function () {
                    $('.popupAll').addClass('deixarInvisivel');
                    deletarCorrida();
                });

                //clique no botao cancelar na popu
                $(document).on ("click", ".btnCancelarPopup", function () {
                    $('.popupAll').addClass('deixarInvisivel');
                });

                //clique no fechar na popup
                $(document).on ("click", ".fecharPopup", function () {
                    $('.popupAll').addClass('deixarInvisivel');
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
                                calcularNumeroDePaginas(paginaAtual);
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