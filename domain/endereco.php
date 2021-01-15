<?php

class Endereco{
    public $idendereco;
    public $tipo;
    public $logradouro;
    public $numero;
    public $complemento;
    public $bairro;
    public $cep;

    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função para listar todos os usuários cadastrados no banco de dados
    */
    public function listar(){
        $query = "select * from endereco";
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
        $query = "insert into endereco set tipo=:t,logradouro=:l,numero=:n,complemento=:c,bairro=:b,cep=:cep";

        $stmt = $this->conexao->prepare($query);
        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
        
        $stmt->bindParam(":t",$this->tipo);
        $stmt->bindParam(":l",$this->logradouro);
        $stmt->bindParam(":n",$this->numero);
        $stmt->bindParam(":c",$this->complemento);
        $stmt->bindParam(":b",$this->bairro);
        $stmt->bindParam(":cep",$this->cep);
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

public function alterarendereco(){
            $query = "update endereco set tipo=:t,logradouro=:l,numero=:n,complemento=:c,bairro=:b,cep=:cep where idendereco=:id";
    
            $stmt = $this->conexao->prepare($query);
            /*Vamos vincular os dados que veem do app ou navegador com os campos de
            banco de dados
            */
            
            $stmt->bindParam(":t",$this->tipo);
            $stmt->bindParam(":l",$this->logradouro);
            $stmt->bindParam(":n",$this->numero);
            $stmt->bindParam(":c",$this->complemento);
            $stmt->bindParam(":b",$this->bairro);
            $stmt->bindParam(":cep",$this->cep);
            $stmt->bindParam(":id",$this->id);
            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
    
        }
    
    public function apagarendereco(){
        $query = "delete from endereco where idendereco=:id";

        $stmt = $this->conexao->prepare($query);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
        $stmt->bindParam(":id",$this->idendereco);
      

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }


    

}


?>