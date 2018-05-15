var campos = [];
var numeroDePaginas, numRows, paginaAtual, paginaClick, where, what;
var paginationColor = null;

function createPagination(whereIt, whatIt){
    paginaClick = 0;
    paginaAtual = 0;
    numRows = 5;
    where = whereIt;
    what = whatIt;
    $(where).append('<div class="paginasConsulta"></div>');
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

function deixarInvisivel(){
    $('.invisivel').css('display', 'none');
}

function setPaginationColor(color){
    paginationColor = color;
}



function styleForPagination(){
    $('.paginasConsulta').css('margin', 'auto');
    $('.paginasConsulta').css('margin-top', '20px');
    $('.paginasConsulta input').css('border', '0');
    $('.paginasConsulta input').css('border-radius', '5px');
    $('.paginasConsulta input').css('padding', '7px 14px');
    $('.paginasConsulta input').css('font-size', '16px');
    $('.paginasConsulta input').css('outline', 'none');
    $('.paginasConsulta input').css('cursor', 'pointer');
    $('.paginasConsulta input').css('margin', '0 2px');
    $(".paginasConsulta input").hover(function() {
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

function createSelect(whereSelect){
    $(whereSelect).append('<select class="selectRowsSelect"><option class="foda" value="5">5</option><option value="10">10</option><option value="15">15</option></select>');
    styleForSelect();
}

function styleForSelect(){
    $('.selectRowsSelect').css('border-radius', '5px');
    $('.selectRowsSelect').css('width', '70px');
    $('.selectRowsSelect').css('height', '30px');
    $('.selectRowsSelect').css('margin-left', '30px');
    $('.selectRowsSelect').css('margin-bottom', '20px');
    $('.selectRowsSelect').css('font-size', '14px');
    $('.selectRowsSelect').css('outline', 'none');
    
    
    
    $('.selectRowsSelect').focusin(function(){
        $('.selectRowsSelect').css('border', '2px solid #3f7998');
        
    })
    $('.selectRowsSelect').focusout(function(){
        $('.selectRowsSelect').css('border', '1px solid lightgray');
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

    $(document).on('change', '.selectRowsSelect',function(){
        numRows = $('.selectRowsSelect').val();
        paginaAtual = 0;
        paginaClick = 0;
        calcularNumeroDePaginas(paginaAtual);
    })

})

function mostrarContentPagina(pagina){

    var qtd = parseInt(campos.length);

    
    $(what).map(function() {
        $(this).addClass('invisivel');
        $(this).removeClass('displayFlex');
    })
    
    
    if (qtd - pagina*numRows > numRows){
        qtd = parseInt(numRows);
    } else {
        qtd = parseInt(qtd) - parseInt(pagina*numRows);
    }
    var count = 0;
    $(what).map(function() {
        if ((count >= parseInt(pagina*numRows)) && (count < parseInt(parseInt(pagina*numRows) + parseInt(qtd)))){
            $(this).addClass('displayFlex');
            $(this).removeClass('invisivel');
        }
        count++;
    })

    deixarInvisivel();
    displayFlex();

}//function

function mostrarNumeroDePaginas(pagina){

    showPagination(pagina);
    mostrarContentPagina(pagina);
    styleForPagination();

}//function

function showPagination(pagina){
    $('#btnNumeroPagina' + paginaAtual).removeClass('selectedPagina');
    $('#btnNumeroPagina' + paginaAtual).addClass('transparent');
    paginaAtual = pagina;
    $('.paginasConsulta').html('<input type="button" id="btnPagina-1" class="btnPaginaAnterior transparent" value="Anterior">');
    for (i = 0; i < numeroDePaginas; i++){
        $('.paginasConsulta').append('<input type="button" class="btnPagina transparent" id="btnNumeroPagina' + (i) + '" value="' + (i+1) + '">');
    }
    $('.paginasConsulta').append('<input type="button" id="btnPagina-1" class="btnPaginaSeguinte transparent" value="Próximo">');
    $('#btnNumeroPagina' + paginaAtual).removeClass('transparent');
    $('#btnNumeroPagina' + paginaAtual).addClass('selectedPagina');
    selectedPagina();
    transparent();
}

function calcularNumeroDePaginas(pagina){
    campos = [];
    var count = 0;
    $(what).map(function() {
        count = parseInt(count) + 1;
        campos.push(count);
    })
    deixarInvisivel();
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