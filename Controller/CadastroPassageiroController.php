<?php

class CadastroPassageiroController extends Controller {
    
    //funcao para cadastrar um passageiro
    public static function CadastrarPassageiro(){
        if (isset($_POST['nome'])){
            $usuario = new Passageiro;
            $usuario->CadastrarPassageiro();
        } else {
            header("Location: ".self::$baseurl);
        }
    }
    
    
    
}