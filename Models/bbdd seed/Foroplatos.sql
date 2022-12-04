drop database if exists foroplatos;
create database if not exists foroplatos;
use foroplatos;

create table if not exists usuario (
	 id int auto_increment primary key,
    username varchar(20) unique,
    pass VARCHAR(200),
    alias varchar(20),
    nombre varchar(20),
    apellidos varchar(50),
    edad int,
    telefono varchar(15) unique,
    email varchar(30) unique,
    alta tinyint(1) default 1,
    api_key varchar(100)
); 

create table if not exists receta (
	 id int auto_increment primary key,
    titulo varchar(50),
    ingredientes varchar(2000),
    pasos text,
    dificultad enum('facil', 'intermedio', 'dificil', 'maestro'),
    tipo enum ('Tradicional', 'SlowFood', 'Freidora sin aceite'),
	 foto longblob,
	formato varchar(20)
);
create table if not exists usuario_receta(
	 id_usuario int not null,
    id_receta int not null,
    valoracion enum('1','2','3','4','5'),
    comentario text,
    foreign key(id_usuario) references usuario(id),
    foreign key(id_receta) references receta(id)
);

create table if not exists administrador(
	 id int auto_increment primary key,
    username varchar(20) unique,
	 pass VARCHAR(200),
	 alta tinyint(1) default 1,
    api_key varchar(100)
);
create table if not exists mensaje(
	 id int auto_increment primary key,
    id_usuario int not null,
    texto text,
    estado enum('leido', 'no leido') default 'no leido',
    foreign key(id_usuario) references usuario(id)
);

select * from usuario;
select * from administrador;
select * from receta;
select * from mensaje;