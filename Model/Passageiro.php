<?php

class Passageiro extends Usuario {
    
    //funcao para cadastrar um passageiro.
    public static function CadastrarPassageiro(){
        self::$nome = $_POST['nome'];
        self::$dtNasc = $_POST['dtNasc'];
        self::$cpf = $_POST['cpf'];
        self::$sexo = $_POST['sexo'];
        try {
            self::query("INSERT INTO tbUsuario(nm_usuario, dt_nascimento, cpf, sexo, ds_funcao) values('".self::$nome."', '".self::$dtNasc."', '".self::$cpf."', '".self::$sexo."', 'P')");
            header("Location: ".self::$baseurl."/consulta/passageiro");
        } catch(Exception $e) {
            header("Location: ".self::$baseurl."/erro");
        }
    }
    
    //funcao que retorna os passageiros.
    public static function GetPassageiros(){
        try {
            self::$results = self::query("SELECT id_usuario, nm_usuario, dt_nascimento, cpf, sexo FROM tbUsuario where ds_funcao = 'P' order by nm_usuario");
            if (is_array(self::$results) || is_object(self::$results)){
                foreach(self::$results as $result){
                    self::$dtNasc = explode('-', $result[2]);
                    $result[2] = self::$dtNasc[2] . "-". self::$dtNasc[1] . "-". self::$dtNasc[0];
                    
                    if ($result[4] == 'M')
                        $result[4] = "Masculino";
                    else
                        $result[4] = "Feminino";
                    array_push(self::$resultRetorno, $result);

                }
            }
            return self::$resultRetorno;
        } catch (Exception $e){
            echo $e;
        }

    }
    
    
    

    
}