<?php

class Foto{
    public $idfoto;
    public $fotos;


    public function __construct($db){
        $this->conexao = $db;
    }

    public function listar(){
        $query = "select * from foto";

        $stmt = $this->conexao->prepare($query);

        $stmt->execute();
    
        return $stmt;
    }

    public function apagarfoto(){
        $query = "delete from foto where idfoto=:id";

        $stmt = $this->conexao->prepare($query);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
        $stmt->bindParam(":id",$this->idfoto);
      

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }
}