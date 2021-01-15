<?php

class HistoricoPedido{

    public $idcliente;
    public $idpedido;
    public $datapedido;
    public $nomeproduto;
    public $preco;
    public $quantidade;
    public $tipo;
    public $valor;
    public $parcelas;
    public $valorparcela;

   public function __construct($db){
        $this->conexao = $db;
    }


    
public function listar(){
        
        $query = "select 
        pe.idpedido,
        pe.idcliente,
        pe.datapedido,
        pr.nomeproduto,
        pr.preco,
        ip.quantidade,
        pg.tipo,
        pg.valor,
        pg.parcelas,
        pg.valorparcela
        
        from pedido pe inner join itenspedido ip on pe.idpedido = ip.idpedido 
        inner join produto pr on ip.idproduto=pr.idproduto 
        inner join pagamento pg on pg.idpedido = pe.idpedido
        
        where pe.idcliente=:n";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":n",$this->idcliente);

        $stmt->execute();

        return $stmt;
}
}

?>