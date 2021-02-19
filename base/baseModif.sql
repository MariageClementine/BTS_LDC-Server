create table contenuListe as select * from liste;
alter table contenuListe add dansCaddy boolean default false;
alter table contenuListe add constraint pk_contenuListe primary key(listeId,produitId);
alter table contenuListe add constraint fk_listeId foreign key (listeId) references liste(listeId);
alter table contenuListe add constraint fk_produitId foreign key (produitId) references produit(produitId);


alter table contenuListe drop foreign key fk_listeId;
alter table liste drop primary key;

delete from liste where produitId<>1;
alter table liste add constraint pk_liste primary key(listeId);
alter table contenuListe add constraint fk_listeId foreign key(listeId) references liste(listeId);
alter table liste drop foreign key liste_ibfk_1;
alter table liste change produitId familleId integer not null ;
alter table liste drop key produitId;

drop table if exists famille;
create table famille (
 	familleId integer not null primary key,
 	familleLibelle varchar(25) not null,
 	familleCode integer not null
 	)
engine=innodb;

 update liste set familleId = 1;
 insert into famille values(1,'Dupont',2546);
 alter table liste add constraint fk_famille foreign key(familleId) references famille(familleId);
 alter table liste add enCours boolean default true;
alter table liste drop listeQte;

 alter table contenuListe add foreign key (listeId) references liste(listeId);

 alter table liste add listeLib varchar(10);

 create table membre(
 	membreId integer not null primary key,
 	membreNom varchar(15),
 	membrePrenom varchar(15),
 	membreCp varchar(6),
 	login varchar(10) not null,
 	mdp varchar(10) not null,
 	familleId  integer not null)
 engine=innodb;

 alter table membre add foreign key (familleId) references famille(familleId);

 insert into membre values
 	(1,'DUPONT','Catherine','05000','cmar','1502',1),
 	(2,'DUPONT','Clementine','05000','mcle','0610',1),
 	(3,'RIVIERE','Stephane','05000','stifan','1980',1);