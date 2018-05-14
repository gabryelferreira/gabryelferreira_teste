<?php

//setando rotas/url válidas


Route::set('index.php', function(){
    LoginController::CreateView('login');
});

Route::set('login', function(){
    LoginController::CreateView('login');
});

Route::set('fazerlogin', function(){
    LoginController::FazerLogin();
});

Route::set('fazerlogout', function(){
    LoginController::FazerLogout();
});

Route::set('erro', function(){
    ErroController::CreateView('erro');
});

Route::set('cadastro', function(){
    CadastroController::CreateView('cadastro');
});

Route::set('consulta', function(){
    ConsultaController::CreateView('consulta');
});

Route::set('cadastro/admin', function(){
    CadastroAdminController::CreateView('cadastroadmin');
});

Route::set('cadastro/motorista', function(){
    CadastroMotoristaController::CreateView('cadastromotorista');
});

Route::set('cadastro/passageiro', function(){
    CadastroPassageiroController::CreateView('cadastropassageiro'); 
});

Route::set('cadastro/corrida', function(){
    CadastroCorridaController::CreateView('cadastrocorrida');
});

Route::set('cadastro/cadastrarmotorista', function(){
    CadastroMotoristaController::CadastrarMotorista();
});

Route::set('cadastro/cadastrarpassageiro', function(){
    CadastroPassageiroController::CadastrarPassageiro();
});

Route::set('cadastro/cadastrarcorrida', function(){
    CadastroCorridaController::CadastrarCorrida();
});

Route::set('cadastro/cadastraradmin', function(){
    CadastroAdminController::CadastrarAdmin();
});

Route::set('consulta/motorista', function(){
    ConsultaMotoristaController::CreateView('consultamotorista');
});

Route::set('consulta/passageiro', function(){
    ConsultaPassageiroController::CreateView('consultapassageiro');
});

Route::set('consulta/corrida', function(){
    ConsultaCorridaController::CreateView('consultacorrida');
});

Route::set('deletarpassageiro', function(){
    ConsultaPassageiroController::DeletarUsuario();
});

Route::set('deletarmotorista', function(){
    ConsultaMotoristaController::DeletarUsuario();
});

Route::set('deletarcorrida', function(){
    ConsultaCorridaController::DeletarCorrida();
});

Route::set('atualizarstatusmotorista', function(){
    ConsultaMotoristaController::AtualizarStatusMotorista();
});

?>