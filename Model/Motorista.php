<?php

class Motorista extends Usuario {
    
    public static $modeloCarro;
    public static $status;
    
    public static function CadastrarMotorista(){
        self::$nome = $_POST['nome'];
        self::$dtNasc = $_POST['dtNasc'];
        self::$cpf = $_POST['cpf'];
        self::$modeloCarro = $_POST['modeloCarro'];
        self::$status = $_POST['status'];
        self::$sexo = $_POST['sexo'];
        try {
            self::query("INSERT INTO tbUsuario(nm_usuario, dt_nascimento, cpf, modelo_carro, ds_status, sexo, ds_funcao) values('".self::$nome."', '".self::$dtNasc."', '".self::$cpf."', '".self::$modeloCarro."',".self::$status.", '".self::$sexo."', 'M')");
            header("Location: ".self::$baseurl."/consulta/motorista");
        } catch(Exception $e) {
            header("Location: ".self::$baseurl."/erro");
        }
    }//function
    
    
    //funcao que retorna os motoristas do sistema.
    public static function GetMotoristas(){
        try {
            self::$results = self::query("SELECT id_usuario, nm_usuario, dt_nascimento, cpf, modelo_carro, ds_status, sexo FROM tbUsuario where ds_funcao = 'M' order by nm_usuario");
            if (is_array(self::$results) || is_object(self::$results)){
                foreach(self::$results as $result){
                    self::$dtNasc = explode('-', $result[2]);
                    $result[2] = self::$dtNasc[2] . "-". self::$dtNasc[1] . "-". self::$dtNasc[0];

                    if ($result[5] == "1")
                        $result[5] = "Ativo";
                    else
                        $result[5] = "Inativo";

                    if ($result[6] == 'M')
                        $result[6] = "Masculino";
                    else
                        $result[6] = "Feminino";
                    array_push(self::$resultRetorno, $result);

                }
            }
            return self::$resultRetorno;
        } catch (Exception $e){
            echo $e;
        }
    }//function
    
    //funcao que retorna apenas os motoristas ativos do sistema.
    public static function GetMotoristasAtivos(){
        try {
            return self::query("SELECT id_usuario, nm_usuario from tbUsuario where ds_status = true and ds_funcao = 'M' order by nm_usuario");
        } catch(Exception $e){
            echo $e;
        }
    }//function
    
    //funcao que atualiza o status de um motorista
    public static function AtualizarStatusMotorista(){
        self::$id = $_POST['id'];
        self::$status = $_POST['status'];
        try {
            self::query("UPDATE tbUsuario set ds_status = ".self::$status." where id_usuario = ".self::$id."");
            echo "1";
        } catch(Exception $e) {
            echo $e;
        }
    }//function
    
    
    
}