<?php

class Controller {
    
    public static $results;
    public static $resultRetorno = array();
    public static $dtNascFormat;
    
    //funcao para criar a view especificada no parametro
    public static function CreateView($viewName){
        require_once("./View/$viewName.php");
    }
    
    
    
}

?>