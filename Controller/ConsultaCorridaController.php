<?php

class ConsultaCorridaController extends Controller {
    
    //funcao que retorna as corridas cadastradas no sistema
    public static function GetCorridas(){
        $corridas = new Corrida;
        return $corridas->GetCorridas();
    }//function
    
    
    //funcao para deletar uma corrida
    public static function DeletarCorrida(){
        if (isset($_POST['id'])){
            $corrida = new Corrida;
            $corrida->DeletarCorrida();
        } else {
            header("Location: ".self::$baseurl);
        }
    }
    
    
}
