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
    tarif float,
    url varchar (100),
    status char (1)
);

create table liste_item(
    id_list int not null,
    id_item int not null,
    PRIMARY KEY (id_list, id_item),
    FOREIGN KEY (id_list) REFERENCES Liste (id),
    FOREIGN KEY (id_item) REFERENCES Item (id)  
);

create table participant_item(
    id_item int not null,
    id_participant int not null,
    message varchar (300),
    PRIMARY KEY (id_item, id_participant),
    FOREIGN KEY (id_item) REFERENCES Item (id),
    FOREIGN KEY (id_participant) REFERENCES Participants (id)
);






    

