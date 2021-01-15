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

include_once "../../domain/pedido.php";

$database = new Database();
$db = $database->getConnection();

$pedido = new Pedido($db);

/*
O cliente irá enviar os dado no formato Json. Porém
 nós precisamos dos dados no formato php para cadstra em
 banco de dados. 
 Para realizar essa conversão iremos usar o comando json_decode
 Assi o cliente envia os dados e estes serão convertidos para php
*/
$data = json_decode(file_get_contents("php://input"));

#Verificar se os dados vindos do usuário estão preenchidos
if(!empty($data->idcliente)){

    $pedido->idcliente = $data->idcliente;

    $rs = $pedido->cadastro();
    if($rs != 0){
        header("HTTP/1.0 201");
        echo json_encode($rs);
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