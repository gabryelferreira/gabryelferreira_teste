<?php

class Usuario extends Database {
    
    public static $id;
    public static $nome;
    public static $dtNasc;
    public static $cpf;
    public static $sexo;
    
    //funcao para deletar um usuário do sistema.
    public static function DeletarUsuario(){
        self::$id = $_POST['id'];
        try {
            self::query("DELETE tbCorrida FROM tbUsuario inner join tbCorrida on tbUsuario.id_usuario = tbCorrida.id_motorista or tbUsuario.id_usuario = tbCorrida.id_passageiro where id_usuario = ".self::$id);
            self::query("DELETE FROM tbUsuario where id_usuario = ".self::$id);
            echo "1";
        } catch(Exception $e){
            echo "0";
        }
    }
    
}