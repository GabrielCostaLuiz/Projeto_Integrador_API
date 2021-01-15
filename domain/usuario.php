<?php

class Usuario{
    public $idusuario;
    public $nomeusuario;
    public $senha;
    public $perfil;

    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função para listar todos os usuários cadastrados no banco de dados
    */
    public function listar(){
        $query = "select * from usuario";
        /*
        Será criada a variável stmt(Statement - Sentença)
        para guardar a preparação da consulta select que será executada
        posteriormente
        */
        $stmt = $this->conexao->prepare($query);

        //executar a consulta e retornar seus dados
        $stmt->execute();

        return $stmt;

    }

    public function cadastro(){
        $query = "insert into usuario set nomeusuario=:n, senha=:s, perfil=:pf";

        $stmt = $this->conexao->prepare($query);

        //Encriptografar a senha com o uso de md5
        $this->senha = md5($this->senha);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
        $stmt->bindParam(":n",$this->nomeusuario);
        $stmt->bindParam(":s",$this->senha);
        $stmt->bindParam(":pf",$this->perfil);


        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

    public function alterarSenha(){
        $query = "update usuario set senha=:s where idusuario=:id";

        $stmt = $this->conexao->prepare($query);

        //Encriptografar a senha com o uso de md5
        $this->senha = md5($this->senha);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
        $stmt->bindParam(":s",$this->senha);
        $stmt->bindParam(":id",$this->idusuario);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    public function apagarUsuario(){
        $query = "delete from usuario where idusuario=:id";

        $stmt = $this->conexao->prepare($query);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
        $stmt->bindParam(":id",$this->idusuario);
      

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }


    

}


?>