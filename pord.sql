drop database if exists dbProdutos;
create database dbProdutos;
use dbProdutos;

create table Produtos(
	 id_produto int auto_increment not null , 
   nome varchar(15) not null,
   descricao varchar(30) not null,
   marca varchar(15) not null,
   primary key (id_produto)
);

create table Comercializar(
  id_com integer auto_increment not null,
  local varchar(15) not null,
  responsavel varchar(12) not null,
  tipo varchar(9) not null,
  primary key (id_com)
);

create table Realizada(
    id_produto int not null,
    id_com int not null,
    preco decimal(10,2) not null,
    quantidade integer not null,
    constraint fk_produto foreign key (id_produto)
    references Produtos(id_produto),
    constraint fk_com foreign key (id_com)
    references Comercializar(id_com)
);



insert into Produtos values
(default,"camisa", "branca com detalhes azul", "adidas"),
(default,"blusa", "vermelha com listras", "D&G"),
(default,"cala", "laranja com detalhes preto ", "Lacoste"),
(default,"shorts", "preto e branco", "puma");

insert into Comercializar values
(1, "São Paulo", "Lucas", "venda"),
(2, "São Paulo", "Bianca", "compra"),
(3, "São Paulo", "Lucas", "venda"),
(4, "São Paulo", "Marcos", "compra");

insert into Realizada values 
(1, 4, "39,99", "20"),
(1, 1, "48,00", "19"),
(2, 3, "88,00", "05"),
(3, 2,"155,00", "10");

Select *
from Produtos;

Select *
from Comercializar;

Select *
from Realizada;
Select *, preco * quantidade as subtotal
from Realizada;



