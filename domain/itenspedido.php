<?php

class ItensPedido{
    public $iditenspedido;
    public $idpedido;
    public $idproduto;
    public $quantidade;

    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função para listar todos os usuários cadastrados no banco de dados
    */
    public function listar(){
        $query = "select * from itenspedido";
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
        $query = "insert into itenspedido set idpedido=:ip, idproduto=:ipro, quantidade=:q";

        $stmt = $this->conexao->prepare($query);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
        $stmt->bindParam(":ip",$this->idpedido);
        $stmt->bindParam(":ipro",$this->idproduto);
        $stmt->bindParam(":q",$this->quantidade);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

    public function atualizaritenspedidos(){
        $query = "update itenspedido set idpedido=:ip, idproduto=:ipro, quantidade=:q where iditenspedido=:itens";

        $stmt = $this->conexao->prepare($query);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
        $stmt->bindParam(":ip",$this->idpedido);
        $stmt->bindParam(":ipro",$this->idproduto);
        $stmt->bindParam(":q",$this->quantidade);
        $stmt->bindParam(":itens",$this->iditenspedido);
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

}


?>