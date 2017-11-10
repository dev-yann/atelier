create database mecado;

use mecado;

create table Createur(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom varchar(50) NOT NULL,
    prenom varchar(50),
    profession varchar(50),
    email varchar(50) not null,
    password varchar(255) not null,
    level int not null
);

create table Liste(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    nom varchar(50)not null,
    date_debut TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_final date,
    createur int not null,
    description varchar (150) not null,
    idPartage varchar (20) not null,
    constraint fk_liste FOREIGN KEY (createur) REFERENCES Createur (id)   
);

create table Item(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    nom varchar (50) not null,
    description varchar (50) not null,
    message varchar(255) default null,
    reservePart varchar(255) default null,
    urlImage text not null,
    tarif float not null,
    url text not null,
    status boolean not null default 0,
    id_list int not null
);

create table message(
	id int not null AUTO_INCREMENT PRIMARY KEY,
	contenu text,
	id_list VARCHAR (20) not null
);







    

