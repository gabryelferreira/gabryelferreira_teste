var camposUsuarios = [];
            var numeroDePaginas;
            var numRows = 5;
            var paginaAtual = 0;
            var paginaClick = 0;
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
        