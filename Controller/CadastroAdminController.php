<?php

class CadastroAdminController extends Controller {
    
    //funcao para cadastrar um administrador
    public static function CadastrarAdmin(){
        if (isset($_POST['usuario'])){
            $admin = new Admin;
            $admin->CadastrarAdmin();
        } else {
            header("Location: ".self::$baseurl);
        }
    }
    
}