<?php

class Admin extends Database {
    
    public static $id;
    public static $usuario;
    public static $senha;

    //funcao para logar usuario. A variável resultLogin determina se o usuário não existe (u), se a senha está incorreta (s) ou se o usuário e senha estão corretos (c), assim logando o usuário ou mostrando um erro na tela de login.
    public static function FazerLogin(){
        self::$usuario = $_POST['usuario'];
        self::$senha = $_POST['senha'];
        self::$results = self::query("SELECT usuario, senha FROM tbAdmin where usuario = '".self::$usuario."'");
        $resultLogin = 'u';
        foreach (self::$results as $result){
            if (password_verify(self::$senha, $result[1])){
                $resultLogin = 'c';
            } else {
                $resultLogin = 's';
            }
        }
        if ($resultLogin == 'c'){
            session_start();
            $_SESSION['usuario'] = self::$usuario;
            $_SESSION['senha'] = self::$senha;
            header("Location: ".self::$baseurl);
        } else 
        if ($resultLogin == 'u'){
            header("Location: ".self::$baseurl."?erro=usuario");
        } else {
            header("Location: ".self::$baseurl."?erro=senha");
        }
    }
    
    //funcao para deslogar o usuário
    public static function FazerLogout(){
        session_start();
        session_unset();
        session_destroy();
        header("Location: ".self::$baseurl."/");
    }
    
    
    //funcao para cadastrar um administrador no sistema
    public static function CadastrarAdmin(){
        self::$usuario = $_POST['usuario'];
        self::$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        try {
            self::query("INSERT INTO tbAdmin(usuario, senha) values('".self::$usuario."', '".self::$senha."')");
            self::FazerLogin();
        } catch(Exception $e){
            header("Location: ".self::$baseurl."/erro");
        }
                    
    }
    
    //funcao que retorna a quantidade de administradores do sistema.
    public static function GetCountAdmin(){
        return self::query("SELECT count(*) from tbAdmin");
    }
    
}