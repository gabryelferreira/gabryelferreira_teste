<?php

class CadastroCorridaController extends Controller {
    
    public static function CadastrarCorrida(){
        if (isset($_POST['valorCorrida'])){
            $corrida = new Corrida;
            $corrida->CadastrarCorrida();
        } else {
            header("Location: ".self::$baseurl);
        }
    }//function
    
    public static function GetPassageiros(){
        $passageiros = new Passageiro;
        return $passageiros->GetPassageiros();
    }
    
    public static function GetMotoristasAtivos(){
        $motoristasAtivos = new Motorista;
        return $motoristasAtivos->GetMotoristasAtivos();
    }
    
    
}
