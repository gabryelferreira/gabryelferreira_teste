create database dbCorrida;

use dbCorrida;

create table tbAdmin(
id_admin int not null auto_increment,
usuario varchar(50),
senha varchar(255),
primary key(id_admin));

create table tbUsuario(
id_usuario int not null auto_increment,
nm_usuario varchar(50),
dt_nascimento date,
cpf char(11),
modelo_carro varchar(30),
ds_status boolean,
sexo char(1),
ds_funcao char(1),
primary key(id_usuario));

create table tbCorrida(
id_corrida int not null auto_increment,
id_motorista int not null,
id_passageiro int not null,
vl_corrida decimal(6, 2) not null,
primary key(id_corrida),
foreign key(id_motorista) references tbUsuario(id_usuario),
foreign key(id_passageiro) references tbUsuario(id_usuario));