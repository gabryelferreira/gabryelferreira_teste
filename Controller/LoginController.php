<?php

class LoginController extends Controller {
    
    public static $idAdmin;
    public static $usuario;
    public static $senha;
    public static $numRows = 0;
    
    //funcao para logar usuário
    public static function FazerLogin(){
        if (isset($_POST['usuario'])){
            $usuario = new Admin;
            $usuario->FazerLogin();
        } else {
            header("Location: ".self::$baseurl);
        }
    }
    
    
    //funcao para finalizar a sessão do usuário
    public static function FazerLogout(){
        $usuario = new Admin;
        $usuario->FazerLogout();
    }
    
    
    
}

?>