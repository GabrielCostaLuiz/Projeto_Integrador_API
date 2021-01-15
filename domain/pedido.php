<?php

class Pedido{
    public $idpedido;
    public $idcliente;
    public $datapedido;

    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função para listar todos os usuários cadastrados no banco de dados
    */
    public function listar(){
        $query = "select * from pedido";
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
        $query = "insert into pedido set idcliente=:idcli";

        $stmt = $this->conexao->prepare($query);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
        $stmt->bindParam(":idcli",$this->idcliente);

        $stmt->execute();

        $this->idpedido = $this->conexao->lastInsertId();

        return $this->idpedido;
    }
}


?>