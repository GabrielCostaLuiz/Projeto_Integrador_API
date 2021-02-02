create database dbhamburgueria;
use dbhamburgueria;

create table usuario(
idusuario int auto_increment primary key,
nomeusuario varchar(20) not null unique,
senha varchar(200) not null,
perfil varchar(20) not null
)engine Innodb;

create table endereco(
idendereco int auto_increment primary key,
tipo varchar(10) not null,
logradouro varchar(100) not null,
numero varchar(10) not null,
complemento varchar(20) not null,
bairro varchar(50) not null,
cep varchar(10) not null
)engine Innodb;

create table cliente(
idcliente int auto_increment primary key,
nomecliente varchar(50) not null,
cpf varchar(13) not null unique,
telefone varchar(20) not null,
sexo char(10) not null,
idusuario int not null,
idendereco int not null
)engine Innodb;

create table produto(
idproduto int auto_increment primary key,
nomeproduto varchar(50) not null,
descricao text not null,
preco decimal(10,2) not null,
idfoto int not null
)engine InnoDB;

create table foto(
idfoto int auto_increment primary key,
fotos varchar(200) not null,
destaque varchar(5) not null
)engine InnoDB;

create table pagamento(
idpagamento int auto_increment primary key,
idpedido int not null,
tipo varchar(20) not null,
descricao varchar(200) not null,
valor decimal(10,2) not null,
parcelas int default 1 not null,
valorparcela decimal(10,2) not null
)engine InnoDB;
select* from pagamento;

create table pedido(
idpedido int auto_increment primary key,
idcliente int not null,
datapedido timestamp default current_timestamp()
)engine InnoDB;
select* from pedido;

create table itenspedido(
iditens int auto_increment primary key,
idpedido int not null,
idproduto int not null,
quantidade int default 1 not null 
)engine InnoDB;
select* from itenspedido;

ALTER TABLE `dbhamburgueria`.`cliente` 
ADD CONSTRAINT `fk_cliente_pk_endereco`
  FOREIGN KEY (`idendereco`)
  REFERENCES `dbhamburgueria`.`endereco` (`idendereco`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbhamburgueria`.`cliente` 
ADD CONSTRAINT `fk_cliente_pk_usuario`
  FOREIGN KEY (`idusuario`)
  REFERENCES `dbhamburgueria`.`usuario` (`idusuario`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
  
  ALTER TABLE `dbhamburgueria`.`produto` 
ADD CONSTRAINT `fk_produto_pk_foto`
  FOREIGN KEY (`idfoto`)
  REFERENCES `dbhamburgueria`.`foto` (`idfoto`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
ALTER TABLE `dbhamburgueria`.`pedido` 
ADD CONSTRAINT `fk_pedido_pk_cliente`
  FOREIGN KEY (`idcliente`)
  REFERENCES `dbhamburgueria`.`cliente` (`idcliente`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
   ALTER TABLE `dbhamburgueria`.`itenspedido` 
ADD CONSTRAINT `fk_itens_pk_pedido`
  FOREIGN KEY (`idpedido`)
  REFERENCES `dbhamburgueria`.`pedido` (`idpedido`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
  ALTER TABLE `dbhamburgueria`.`itenspedido` 
ADD CONSTRAINT `fk_itens_pk_produto`
  FOREIGN KEY (`idproduto`)
  REFERENCES `dbhamburgueria`.`produto` (`idproduto`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
  ALTER TABLE `dbhamburgueria`.`pagamento` 
ADD CONSTRAINT `fk_pagamento_pk_pedido`
  FOREIGN KEY (`idpedido`)
  REFERENCES `dbhamburgueria`.`pedido` (`idpedido`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

insert into usuario(nomeusuario, senha, perfil)values('admin',md5('123'),"admin");

insert into endereco(tipo, logradouro, numero, complemento,bairro,cep)values('Rua','Jardins','77','Apartamento','Nova Curuçá','08523100');

insert into cliente(nomecliente, cpf, telefone, sexo,idendereco,idusuario)values('Gabriel','201325254847','12345-5432','Masculino',1,1);

insert into foto(fotos,destaque) values ('hamburguer1.png',"nao");
insert into foto(fotos,destaque) values ('hamburguer2.png',"nao");
insert into foto(fotos,destaque) values ('hamburguer3.png',"sim");
insert into foto(fotos,destaque) values ('hamburguer4.png',"nao");
insert into foto(fotos,destaque) values ('hamburguer5.png',"nao");
insert into foto(fotos,destaque) values ('hamburguer6.png',"nao");
insert into foto(fotos,destaque) values ('hamburguer7.png',"nao");
insert into foto(fotos,destaque) values ('hamburguer8.png',"sim");
insert into foto(fotos,destaque) values ('hamburguer9.png',"sim");
insert into foto(fotos,destaque) values ('hamburguer10.png',"nao");
insert into foto(fotos,destaque) values ('hamburguer11.png',"sim");
insert into foto(fotos,destaque) values ('hamburguer12.png',"sim");
insert into foto(fotos,destaque) values ('hamburguer13.png',"nao");

insert into produto(nomeproduto, descricao, preco, idfoto)values('Calabria','Lanche com cheedar, calabresa e salada',17.99,1);
insert into produto(nomeproduto, descricao, preco, idfoto)values('Brazilian Steak','Lanche com queijo, hambúrguer, cheedar e bacon',19.50,2);
insert into produto(nomeproduto, descricao, preco, idfoto)values('Veggie Burguer','Lanche com molho verde, hambúrguer de soja e salada',19.99,3);
insert into produto(nomeproduto, descricao, preco, idfoto)values('Sidney Cheddar','Lanche com queijo, hambúrguer, bacon, cebola e salada',22.00,4);
insert into produto(nomeproduto, descricao, preco, idfoto)values('Premium Burguer','Lanche com queijo, hambúrguer, cebola e molho verde',20.99,5);
insert into produto(nomeproduto, descricao, preco, idfoto)values('Pestare','Lanche com hambúrguer, nuggget grande e salada',23.50,6);
insert into produto(nomeproduto, descricao, preco, idfoto)values('Monster Cheddar Melt','Lanche com bastante cheedar, 2 hambúrguers, bacon',22.99,7);
insert into produto(nomeproduto, descricao, preco, idfoto)values('Duplo Smash Burguer','Lanche com batata palha, 2 hambúrguers, bastante cheedar e bacon',24.00,8);
insert into produto(nomeproduto, descricao, preco, idfoto)values('Don Pepperoni','Lanche com peperoni, queijo e hambúrguer',22.00,9);
insert into produto(nomeproduto, descricao, preco, idfoto)values('Capital Veggie','Lanche com salada de beringela, queijo e hambúrguer de soja',21.00,10);
insert into produto(nomeproduto, descricao, preco, idfoto)values('Capital Ribs','Lanche com bastante salada de beringela, frango e molho',27.00,11);
insert into produto(nomeproduto, descricao, preco, idfoto)values('Capital Kids','Lanche com queijo, hamburguer e batatas smiles',15.00,12);
insert into produto(nomeproduto, descricao, preco, idfoto)values('Capital Burguer','Lanche com queijo, hambúrguer e bastante salada',24.00,13);

insert into pedido(idcliente) values(1);

insert into itenspedido(idpedido,idproduto,quantidade)values(1,4,2);

insert into pagamento(idpedido,tipo,descricao,valor,parcelas,valorparcela)values(1,'Débito','Nº 2235|Nome:Gabriel|Codigo: 756',22.00,2,11.00);
