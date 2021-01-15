<?php

/*
Vamos construir os cabeçalhos para trabalho com a api
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");

/*Para efetuar o cadastro de dados no banco é preciso
informar a api que essa ação  irá ocorrer
*/
header("Access-Control-Allow-Methods:POST");

include_once "../../config/database.php";

include_once "../../domain/cadastrocliente.php";

$database = new Database();
$db = $database->getConnection();

$cadastro = new Cadastro($db);

/*
O cliente irá enviar os dado no formato Json. Porém
 nós precisamos dos dados no formato php para cadstra em
 banco de dados. 
 Para realizar essa conversão iremos usar o comando json_decode
 Assi o cliente envia os dados e estes serão convertidos para php
*/
$data = json_decode(file_get_contents("php://input"));

#Verificar se os dados vindos do usuário estão preenchidos
if(!empty($data->nomeusuario) && !empty($data->senha)){

      $cadastro->nomecliente=$data->nomecliente;
      $cadastro->cpf=$data->cpf;
      $cadastro->sexo=$data->sexo;
      $cadastro->telefone=$data->telefone;
      $cadastro->tipo=$data->tipo;
      $cadastro->logradouro=$data->logradouro;
      $cadastro->numero=$data->numero;
      $cadastro->complemento=$data->complemento;
      $cadastro->bairro=$data->bairro;
      $cadastro->cep=$data->cep;
      $cadastro->nomeusuario=$data->nomeusuario;
      $cadastro->senha=$data->senha;
      $cadastro->perfil=$data->perfil;

    if($cadastro->cadastro()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"Cliente cadastrado com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível cadastrar"));
    }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa preencher todos os campos"));
}

?>