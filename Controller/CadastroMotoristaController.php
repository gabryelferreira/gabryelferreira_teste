<?php

class CadastroMotoristaController extends Controller {
    
    public static function CadastrarMotorista(){
        if (isset($_POST['nome'])){
            $usuario = new Motorista;
            $usuario->CadastrarMotorista();
        } else {
            header("Location: ".self::$baseurl);
        }
    }
    
    
}