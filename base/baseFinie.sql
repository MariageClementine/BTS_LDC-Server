DROP DATABASE `listeCourses`;
CREATE DATABASE `listeCourses` ;

USE `listeCourses`;

CREATE TABLE `contenuListe` (
  `listeId` int(11) NOT NULL DEFAULT '0',
  `produitId` int(11) NOT NULL DEFAULT '0',
  `listeQte` int(11) DEFAULT NULL,
  `dansCaddy` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`listeId`,`produitId`)
) ENGINE=InnoDB;

CREATE TABLE `famille` (
  `familleId` int(11) NOT NULL,
  `familleLibelle` varchar(25) NOT NULL,
  `familleCode` varchar(6) NOT NULL,
  PRIMARY KEY (`familleId`)
) ENGINE=InnoDB;

CREATE TABLE `liste` (
  `listeId` int(11) NOT NULL DEFAULT '0',
  `listeLib` varchar(10) DEFAULT NULL,
  `familleId` int(11) NOT NULL,
  `enCours` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`listeId`)
) ENGINE=InnoDB;

CREATE TABLE `ville` (
  `villeId` int,
  `villeLib` varchar(20),
  PRIMARY KEY (`villeId`)
) ENGINE=InnoDB;

CREATE TABLE `zone` (
  `zoneId` int,
  `zoneLib` varchar(20),
  `villeId` int NOT NULL,
  PRIMARY KEY (`zoneId`)
) ENGINE=InnoDB;

CREATE TABLE `magasin` (
  `magasinId` int(11) NOT NULL,
  `magasinLib` varchar(30) DEFAULT NULL,
  `zoneId` int NOT NULL,
  PRIMARY KEY (`magasinId`)
) ENGINE=InnoDB;

CREATE TABLE `membre` (
  `membreId` int(11) NOT NULL,
  `membreNom` varchar(15) DEFAULT NULL,
  `membrePrenom` varchar(15) DEFAULT NULL,
  `login` varchar(10) NOT NULL,
  `mdp` varchar(10) NOT NULL,
  `familleId` int(11) NOT NULL,
  PRIMARY KEY (`membreId`)
) ENGINE=InnoDB;

CREATE TABLE `organisation` (
  `magasinId` int(11) NOT NULL DEFAULT '0',
  `rayonId` int(11) NOT NULL DEFAULT '0',
  `organisationOrdre` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`magasinId`,`rayonId`,`organisationOrdre`)
) ENGINE=InnoDB;

CREATE TABLE `produit` (
  `produitId` int(11) NOT NULL,
  `produitLib` varchar(50) DEFAULT NULL,
  `rayonId` int(11) DEFAULT NULL,
  PRIMARY KEY (`produitId`)
) ENGINE=InnoDB;

CREATE TABLE `rayon` (
  `rayonId` int(11) NOT NULL,
  `rayonLib` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`rayonId`)
) ENGINE=InnoDB;

CREATE TABLE `admin` (
  `adminId` tinyint NOT NULL,
  `adminNom` varchar(10) NOT NULL,
  `adminPrenom` varchar(10) NOT NULL,
  `adminLogin` varchar(10) NOT NULL,
  `adminMdp` varchar(10) NOT NULL,
  `adminDateEntree` date,
  PRIMARY KEY (`adminId`)
  ) ENGINE=InnoDB;

ALTER TABLE membre add foreign key (familleId) references famille(familleId);
ALTER TABLE liste add foreign key (familleId) references famille(familleId);
ALTER TABLE organisation add foreign key (magasinId) references magasin(magasinId),
                         add foreign key (rayonId) references rayon(rayonId);
ALTER TABLE produit add foreign key (rayonId) references rayon(rayonId);
ALTER TABLE contenuListe add foreign key (produitId) references produit(produitId),
add foreign key (listeId) references liste(listeId);

ALTER TABLE zone add foreign key (villeId) references ville(villeId);
ALTER TABLE magasin add foreign key (zoneId) references zone(zoneId);



INSERT INTO `admin` VALUES (1,'mariage','clementine', 'cmariage', 'passwd', '2014-05-17');
INSERT INTO `famille` VALUES (1,'DUPONT','dup546'),(2,'CLERC','cle001');
INSERT INTO `membre` VALUES (1,'DUPONT','Catherine','cmar','1502',1),(2,'DUPONT','Clementine','mcle','0610',1),(3,'RIVIERE','Stephane','stifan','1980',1);

INSERT INTO `ville` VALUES (1,'Gap'),(2,'Croix');
INSERT INTO `zone` VALUES (1,'Tokoro',1),(2,'Pompidou',1),(3,'Centre',2);
INSERT INTO `magasin` VALUES (1,'Leclerc',1),(2,'Auchan',3),(3,'Carrefour',2);
INSERT INTO `rayon` VALUES (7,'Jardinerie'),(2,'Laiterie'),(3,'Legumes'),(1,'Viandes');
INSERT INTO `produit` VALUES (1,'pilon de poulet',1),(2,'cote de boeuf',1),(3,'flanby',2),(4,'yaourt nature',2),(5,'feuilles de chene blondes',3),(6,'carrote',3);
INSERT INTO `liste` VALUES (0,'liste0',1,1),(1,'liste1',1,0),(2,'liste2',1,0);
INSERT INTO `contenuListe` VALUES (0,1,12,0),(0,2,10,0),(0,3,5,0),(0,4,2,0),(0,5,2,0),(0,6,9,0),(1,3,5,0);
INSERT INTO `organisation` VALUES (1,7,1),(1,1,2),(1,3,3),(1,2,4);











