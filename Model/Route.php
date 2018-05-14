<?php

class Route {
    
    public static $rotasValidas = array();
    
    //faz a validação para ver se a url é válida
    public static function set($route, $function){
        
        self::$rotasValidas[] = $route;
        
        if ($_GET['url'] == $route)
            $function->__invoke();
        
    }
}

?>