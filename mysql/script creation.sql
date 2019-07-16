Efr3iRep0rt
UPDATE `Admin` SET `login` = 'admin', `mdp` = '$2y$10$JFknvDULhhMdj/v6C3NlX.aGemY6D2bkLRyeFNyes58G1szNJ2WpG', `email` = 'admin' WHERE `Admin`.`login` = '';
INSERT INTO `Utilisateur`(`USER_NOM`, `USER_PRENOM`, `USER_LOGIN`, `USER_MDP`, `USER_EMAIL`, `USER_ROLE`) VALUES ('Admin','istrateur','admin','$2y$10$JFknvDULhhMdj/v6C3NlX.aGemY6D2bkLRyeFNyes58G1szNJ2WpG','admin@admin','0');

INSERT INTO Utilisateur (USER_NOM, USER_PRENOM, USER_LOGIN, USER_MDP, USER_EMAIL, USER_ROLE) VALUES ('John', 'Doe', 'test', 'test', 'test_admin', 0) ;
INSERT INTO Utilisateur (USER_NOM, USER_PRENOM, USER_LOGIN, USER_MDP, USER_EMAIL, USER_ROLE) VALUES ('Thomas', 'OS', 'test', 'test2', 'test_reporter', 1) ;
ALTER TABLE `Utilisateur` ADD UNIQUE (`user_login`);

INSERT INTO Client (CLI_NOM,`CLI_PRENOM`,`CLI_EMAIL`) VALUES  ("OLIVIER-SEGUY","Thomas","thomas.olivier-seguy@efrei.net");
INSERT INTO Client (CLI_NOM,`CLI_PRENOM`,`CLI_EMAIL`) VALUES  ("CAPILLON","Léonard","leonard.capillon@efrei.net");
INSERT INTO Client (CLI_NOM,`CLI_PRENOM`,`CLI_EMAIL`) VALUES  ("JANET","Lucas","lucas.janet@efrei.net");
INSERT INTO Client (CLI_NOM,`CLI_PRENOM`,`CLI_EMAIL`) VALUES  ("FLAMENT","Kelly","flament.kelllyclara@gmail.com");


INSERT INTO Projet (PRJ_NOM,`PRJ_CLI_ID`) VALUES  ("Synapse","2");
INSERT INTO Projet (PRJ_NOM,`PRJ_CLI_ID`) VALUES  ("Steam","1");
INSERT INTO Projet (PRJ_NOM,`PRJ_CLI_ID`) VALUES  ("Steam","3");
INSERT INTO Projet (PRJ_NOM,`PRJ_CLI_ID`) VALUES  ("EpicGames","2");

INSERT INTO Ticket (TCK_CLI_ID, TCK_TITRE, TCK_DESC) VALUES  ("1","Probleme reseau","Souci");
INSERT INTO Ticket (TCK_CLI_ID, TCK_TITRE, TCK_DESC) VALUES  ("2","Ordi demarre pas","Probleme d'alim");
INSERT INTO Ticket (TCK_CLI_ID, TCK_TITRE, TCK_DESC) VALUES  ("1","Prise malfonction","Electric");


INSERT INTO Etat (STA_TCK_ID,`STA_USR_ID`,`STA_COM`,`STA_STATUT`) VALUES  ("1","2","KAPOUT","Démarée");
INSERT INTO Etat (STA_TCK_ID,`STA_USR_ID`,`STA_COM`,`STA_STATUT`) VALUES  ("3","2","On attend Gilbert","Démarée");
INSERT INTO Etat (STA_TCK_ID,`STA_USR_ID`,`STA_COM`,`STA_STATUT`) VALUES  ("2","2","Martine s'occupe de ca","En Cours");
INSERT INTO Etat (STA_TCK_ID,`STA_USR_ID`,`STA_COM`,`STA_STATUT`) VALUES  ("2","1","Finito","Cloturé");

Logiciels et clients identifiables

CREATE TABLE Utilisateur (
	USER_ID int NOT NULL AUTO_INCREMENT,
	USER_NOM varchar(255) NOT NULL,
	USER_PRENOM varchar(255) NOT NULL,
	USER_LOGIN varchar(255) NOT NULL,
	USER_MDP varchar(255) NOT NULL,
	USER_EMAIL varchar(255) NOT NULL,
	USER_ROLE int NOT NULL,
	PRIMARY KEY (USER_ID)
);

CREATE TABLE Client (
	CLI_ID int NOT NULL AUTO_INCREMENT,
	CLI_NOM varchar(255) NOT NULL,
	CLI_PRENOM varchar(255) NOT NULL,
	CLI_EMAIL varchar(255) NOT NULL,
	PRIMARY KEY (CLI_ID)
);

CREATE TABLE Projet (
	PRJ_ID int NOT NULL AUTO_INCREMENT,
	PRJ_NOM varchar(255) NOT NULL,
	PRJ_CLI_ID int NOT NULL,
	PRIMARY KEY (PRJ_ID)
);

CREATE TABLE Ticket (
	TCK_ID int NOT NULL AUTO_INCREMENT,
	TCK_CLI_ID int NOT NULL,
	PRIMARY KEY (TCK_ID)
);

CREATE TABLE Etat (
	STA_USR_DATETIME int NOT NULL AUTO_INCREMENT,
    STA_TCK_ID int NOT NULL,
	STA_USR_ID int NOT NULL,
	STA_COM varchar(255) NOT NULL,
	STA_STATUT varchar(255) NOT NULL,
	PRIMARY KEY (`STA_USR_DATETIME`,`STA_TCK_ID`,`STA_USR_ID`)
);

ALTER TABLE Projet ADD CONSTRAINT Projet_fk0 FOREIGN KEY (PRJ_CLI_ID) REFERENCES Client(`CLI_ID`);

ALTER TABLE Ticket ADD CONSTRAINT Ticket_fk0 FOREIGN KEY (TCK_CLI_ID) REFERENCES Client(`CLI_ID`);

ALTER TABLE Etat ADD CONSTRAINT Etat_fk0 FOREIGN KEY (STA_TCK_ID) REFERENCES Ticket(`TCK_ID`);

ALTER TABLE Etat ADD CONSTRAINT Etat_fk1 FOREIGN KEY (STA_USR_ID) REFERENCES Utilisateur(`USER_ID`);



POUR LA SELECTION UNIQUE
select Etat.*, Ticket.* from Etat
left outer join Ticket on (Ticket.TCK_ID=Etat.STA_TCK_ID)
order by Etat.STA_USR_DATETIME DESC
