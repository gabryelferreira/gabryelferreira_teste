<?php

class Corrida extends Database {
    
    public static $id;
    public static $motorista;
    public static $passageiro;
    public static $valor;
    
    
    //funcao que retorna as corridas cadastradas.
    public static function GetCorridas(){
        try {
            self::$results = self::query("SELECT id_corrida, motorista.nm_usuario, passageiro.nm_usuario, vl_corrida from tbCorrida as corrida inner join tbUsuario as motorista on corrida.id_motorista = motorista.id_usuario inner join tbUsuario as passageiro on corrida.id_passageiro = passageiro.id_usuario order by id_corrida desc");
            foreach (self::$results as $result){
                $result[3] = str_replace(".", ",", $result[3]);
                array_push(self::$resultRetorno, $result);
            }
            return self::$resultRetorno;
        } catch (Exception $e){
            echo $e;
        }
        
    }
    
    //funcao para cadastrar uma nova corrida
    public static function CadastrarCorrida(){
        self::$motorista = $_POST['motorista'];
        self::$passageiro = $_POST['passageiro'];
        self::$valor = str_replace(',', '.', $_POST['valorCorrida']);
        try {
            self::query("INSERT INTO tbCorrida(id_motorista, id_passageiro, vl_corrida) values('".self::$motorista."', '".self::$passageiro."', ".self::$valor.")");
            header("Location: ".self::$baseurl."/consulta/corrida");
        } catch(Exception $e) {
            header("Location: ".self::$baseurl."/erro");
        }
    }
    
    
    //funcao para deletar uma corrida
    public static function DeletarCorrida(){
        self::$id = $_POST['id'];
        try {
            self::query("DELETE FROM tbCorrida where id_corrida = ".self::$id);
            echo "1";
        } catch(Exception $e){
            echo "0";
        }
    }
    
    
}