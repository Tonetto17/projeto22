-- drop table clientes;
-- drop table usuarios;

create table usuarios (
  usu_id int(11) not null primary key auto_increment,
  usu_nome varchar(50),
  usu_senha varchar(20),
  usu_ativo varchar(1)
);

insert into usuarios (usu_id, usu_nome, usu_senha, usu_ativo) values
(1, 'giovanna', '123', 's'),
(2, 'rodrigo', '123', 's');

create table clientes (
  cli_id int(11) not null primary key auto_increment,
  cli_cpf varchar(20),
  cli_nome varchar(50),
  cli_senha varchar(20),
  cli_datanasc varchar(20),
  cli_telefone varchar(20),
  cli_logradouro varchar(50),
  cli_numero varchar(20),
  cli_cidade varchar(50),
  cli_ativo varchar(1)
);

insert into clientes (cli_id, cli_cpf, cli_nome, cli_senha, cli_datanasc, cli_telefone, cli_logradouro, cli_numero, cli_cidade, cli_ativo) values
(1, '31454042885', 'rodrigo schio', '123', '1982-11-14', '12991089886', 'rua dos cravos', '123', 'ubatuba', 's');
