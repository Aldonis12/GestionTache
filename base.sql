\c gestiontache projet

create table Admin(
  idAdmin Serial PRIMARY KEY,
  nom varchar(10),
  mdp varchar(10)
);
insert into Admin(nom, mdp) values ('admin','admin');

create table Utilisateur(
    id SERIAL primary key,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    mdp VARCHAR(50) NOT NULL
);

create table Statut(
    id integer primary key,
    nom VARCHAR(10) NOT NULL
);
insert into Statut values (1,'A faire'),(2,'En cours'),(3,'Termines');

create table Color(
    id Serial primary key,
    nom VARCHAR(10) NOT NULL,
    color VARCHAR(10) NOT NULL
);
insert into Color(nom,color) values ('white','#FFFFFF'),('grey','#b8bebf'),('yellow','#f2df91'),('orange','#f5cb82'),('green','#d8f59a'),('blue','#a8eaf7'),('purple','#bc85d4');

create table Priority(
    id integer primary key,
    nom VARCHAR(10) NOT NULL
);
insert into Priority values (1,'Haute'),(2,'Moyenne'),(3,'Faible');

create table Tache(
    id SERIAL primary key,
    idColor integer REFERENCES Color(id) default 1 NOT NULL,
    idUser integer REFERENCES Utilisateur(id) NOT NULL,
    tache VARCHAR(200),
    statut integer REFERENCES Statut(id) default 1 NOT NULL,
    isDeleted integer default 0,
    dateLimite TIMESTAMP,
    dateTerminer TIMESTAMP,
    idPriority integer REFERENCES Priority(id) NOT NULL,
    inserted TIMESTAMP default CURRENT_TIMESTAMP
);

create table SousTache(
    id SERIAL primary key,
    idTache integer REFERENCES Tache(id) ON DELETE CASCADE,
    soustache VARCHAR(200),
    dateLimite TIMESTAMP,
    idpriority integer REFERENCES Priority(id) default 3 NOT NULL,
    statut integer REFERENCES Statut(id) NOT NULL,
    inserted TIMESTAMP default CURRENT_TIMESTAMP
);

ALTER TABLE SousTache ADD CONSTRAINT fk_soustache_idtache FOREIGN KEY (idtache) REFERENCES Tache(id) ON DELETE CASCADE;

--GET MAX DATE
--select datelimite from soustache where datelimite = (select MAX(datelimite) from soustache) and idtache=;