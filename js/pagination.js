var campos = [];
var numeroDePaginas, numRows = 5, paginaAtual = 0, paginaClick = 0, maxPages = 7;
var firstPage, lastPage;
var paginationColor = null;
var pagination = ".pagination";
var paginationInput = ".pagination input";
var paginationData = ".pagination-data";
var paginationSelect = ".pagination-select";
var select = ".select-pagination-select";
createPagination();
createSelect();    

function createPagination(){
    calcularNumeroDePaginas(paginaAtual);    
}

function selectedPagina(){
    if (paginationColor == null){
        $('.selectedPagina').css('background-color', 'dodgerblue');
    } else {
        $('.selectedPagina').css('background-color', paginationColor);
    }
    $('.selectedPagina').css('color', 'white');
}

function displayFlex(){
    $('.displayFlex').css('display', 'flex');
}

function transparent(){
    $('.transparent').css('background', 'transparent');
}


function setPaginationColor(color){
    paginationColor = color;
    createPagination();
}

function setMaxPages(max){
    maxPages = max;
    calcularNumeroDePaginas(paginaAtual);
}


function styleForPagination(){
    $(pagination).css('margin', 'auto');
    $(pagination).css('margin-top', '20px');
    $(paginationInput).css('border', '0');
    $(paginationInput).css('border-radius', '5px');
    $(paginationInput).css('padding', '7px 14px');
    $(paginationInput).css('font-size', '16px');
    $(paginationInput).css('outline', 'none');
    $(paginationInput).css('cursor', 'pointer');
    $(paginationInput).css('margin', '0 2px');
    $(paginationInput).hover(function() {
        if (paginationColor == null){
            $(this).css("background-color","dodgerblue");
        } else {
            $(this).css("background-color", paginationColor);
        }
        $(this).css("color","white");
    }, function(){
        var id = $(this).attr('id').split('btnNumeroPagina');
        if (id[1] != paginaAtual){
            $(this).css("background-color","transparent");
            $(this).css("color","black");
        }
        
    });
}

function updatePagination(){
    calcularNumeroDePaginas(paginaAtual);
}

function createSelect(){
    $(paginationSelect).append('<select class="' + select.split(".")[1] + '"><option value="5">5</option><option value="10">10</option><option value="15">15</option></select>');
    styleForSelect();
}

function styleForSelect(){
    $(select).css('border-radius', '5px');
    $(select).css('width', '70px');
    $(select).css('height', '30px');
    $(select).css('margin-left', '30px');
    $(select).css('margin-bottom', '20px');
    $(select).css('font-size', '14px');
    $(select).css('outline', 'none');
    
    
    
    $(select).focusin(function(){
        $(select).css('border', '2px solid #3f7998');
        
    })
    $(select).focusout(function(){
        $(select).css('border', '1px solid lightgray');
    })
    
    
}

$(document).ready(function(){
    $(document).on('click', '.btnPagina',function(){
        var pagina = this.id.split("btnNumeroPagina");
        paginaClick = pagina[1];
        mostrarNumeroDePaginas(paginaClick);
    })
    $(document).on('click', '.btnPaginaAnterior',function(){
        if (parseInt(paginaAtual) - 1 >= 0){
            paginaClick = parseInt(paginaClick) - 1;
            mostrarNumeroDePaginas(paginaClick);
        }

    })
    $(document).on('click', '.btnPaginaSeguinte',function(){
        if (parseInt(paginaClick) + 1 < numeroDePaginas){
            paginaClick = parseInt(paginaClick) + 1;
            mostrarNumeroDePaginas(paginaClick);
        }

    })

    $(document).on('change', select,function(){
        numRows = $(select).val();
        paginaAtual = 0;
        paginaClick = 0;
        calcularNumeroDePaginas(paginaAtual);
    })

})

function mostrarContentPagina(pagina){

    var qtd = parseInt(campos.length);
    
    $(paginationData).map(function() {
        $(this).css('display', 'none');
    })
    
    
    if (qtd - pagina*numRows > numRows){
        qtd = parseInt(numRows);
    } else {
        qtd = parseInt(qtd) - parseInt(pagina*numRows);
    }
    var count = 0;
    $(paginationData).map(function() {
        if ((count >= parseInt(pagina*numRows)) && (count < parseInt(parseInt(pagina*numRows) + parseInt(qtd)))){
            $(this).css('display', 'flex');
        }
        count++;
    })


}//function

function mostrarNumeroDePaginas(pagina){

    showPagination(pagina);
    mostrarContentPagina(pagina);
    styleForPagination();

}//function

function calcularPaginas(){
    if (paginaAtual < parseInt(maxPages)/2){
        firstPage = 0;
        if (maxPages > numeroDePaginas){
            lastPage = numeroDePaginas;
        } else {
            lastPage = maxPages;
        }
    } else {
        
        if (parseInt(paginaAtual) + parseInt(maxPages)/2 < numeroDePaginas){
            
            if (parseInt(maxPages)%2 == 1){
                firstPage = parseInt(paginaAtual) - (parseInt(maxPages) - 1)/2;
                lastPage = parseInt(paginaAtual) + (parseInt(maxPages) - 1)/2 + 1;
            } else {
                firstPage = parseInt(paginaAtual) - (parseInt(maxPages))/2;
                lastPage = parseInt(paginaAtual) + (parseInt(maxPages))/2;
            }
        } else {
            lastPage = numeroDePaginas;
            firstPage = numeroDePaginas - maxPages;
        }
    }
}


function showPagination(pagina){
    $('#btnNumeroPagina' + paginaAtual).removeClass('selectedPagina');
    $('#btnNumeroPagina' + paginaAtual).addClass('transparent');
    paginaAtual = pagina;
    $(pagination).html('<input type="button" id="btnPagina-1" class="btnPaginaAnterior transparent" value="Anterior">');
    calcularPaginas();
    for (i = firstPage; i < lastPage; i++){
        $(pagination).append('<input type="button" class="btnPagina transparent" id="btnNumeroPagina' + (i) + '" value="' + (i+1) + '">');
    }
    $(pagination).append('<input type="button" id="btnPagina-1" class="btnPaginaSeguinte transparent" value="Próxima">');
    $('#btnNumeroPagina' + paginaAtual).removeClass('transparent');
    $('#btnNumeroPagina' + paginaAtual).addClass('selectedPagina');
    selectedPagina();
    transparent();
}

function calcularNumeroDePaginas(pagina){
    campos = [];
    var count = 0;
    $(paginationData).map(function() {
        count = parseInt(count) + 1;
        campos.push(count);
    })
    numeroDePaginas = campos.length/numRows;
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