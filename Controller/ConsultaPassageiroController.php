<?php

class ConsultaPassageiroController extends Controller {
    
    //funcao para retornar os passageiros cadastrados
    public static function GetPassageiros(){
        $passageiros = new Passageiro;
        return $passageiros->GetPassageiros();
    }
    
    
    
    //funcao para deletar um usuário
    public static function DeletarUsuario(){
        if (isset($_POST['id'])){
            $usuario = new Usuario;
            $usuario->DeletarUsuario();
        } else {
            header("Location: ".self::$baseurl);
        }
    }
    
    
}