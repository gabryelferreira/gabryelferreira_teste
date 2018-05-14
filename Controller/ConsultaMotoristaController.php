<?php

class ConsultaMotoristaController extends Controller {
    
    //funcao que retorna os motoristas do sistema
    public static function GetMotoristas(){
        $motoristas = new Motorista();
        return $motoristas->GetMotoristas();
    }
    
    //funcao que retorna apenas os motoristas ativos do sistema
    public static function GetMotoristasAtivos(){
        $motoristasAtivos = new Motorista;
        return $motoristasAtivos->GetMotoristasAtivos();
    }
    
    //funcao para atualizar o status de um motorista
    public static function AtualizarStatusMotorista(){
        if (isset($_POST['status'])){
            $usuario = new Motorista;
            $usuario->AtualizarStatusMotorista();
        } else {
            header("Location: ".self::$baseurl);
        }
    }
    
    //funcao para deleta um usuário
    public static function DeletarUsuario(){
        if (isset($_POST['id'])){
            $usuario = new Usuario;
            $usuario->DeletarUsuario();
        } else {
            header("Location: ".self::$baseurl);
        }
    }
    
}