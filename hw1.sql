use utenti_app;
select * from pagina;
select * from preferiti;

create table utenti(
username varchar(255),
Nome varchar(255),
Cognome varchar(255),
email varchar(255),
pw varchar(30),
primary key(username, email)
);

create table pagina(
usern varchar(255) references utenti(username),
titolo varchar(200),
img varchar(255),
tipo varchar(100),
anno varchar(100),
liked varchar(255),
primary key(usern, titolo)
);


select * from utenti;

create table preferiti(
usern varchar(255),
titolo varchar(200),
img varchar(255),
tipo varchar(100),
anno varchar(50),
liked varchar(255)
);
delete from preferiti where usern = 'massi';
drop table preferiti;

create table commenti(
usern varchar(255) references utenti(username),
titolo varchar(255),
commento varchar(255),
anno varchar(50),
giorno datetime
);

select * from commenti;

select usern from commenti;

create table immagine(
usern varchar(255) references utenti(username),
immagine varchar(255),
primary key(usern, immagine)
);


select * from immagine;
