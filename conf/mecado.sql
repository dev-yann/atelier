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

create table Participants(
    id int not null AUTO_INCREMENT PRIMARY KEY,
    nom varchar(50),
    prenom varchar (50)
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

create table participant_item(
    id_item int not null,
    id_participant int not null,
    message varchar (300),
    PRIMARY KEY (id_item, id_participant),
    FOREIGN KEY (id_item) REFERENCES Item (id),
    FOREIGN KEY (id_participant) REFERENCES Participants (id)
);

create table message(
	id int not null AUTO_INCREMENT PRIMARY KEY,
	contenu text,
	id_list varchar (20) not null,
	FOREIGN KEY (id) REFERENCES Liste (id)
);






    

