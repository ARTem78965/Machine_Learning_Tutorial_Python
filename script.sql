drop database site;

create database site;
use site;

create table admin(
id int primary key auto_increment not null,
login varchar(25) not null,
password varchar(255) not null
);

insert into admin(login, password) values("Sally_W20", "b8c816cafbc0e15d9f168834a092c598");

create table users(
id int primary key auto_increment not null,
fio varchar(100) not null,
email varchar(255) not null,
login varchar(25) not null,
password varchar(255) not null
);

create table state(
id int primary key auto_increment not null,
title varchar(100) not null
);

create table comments(
id int primary key auto_increment not null,
state int not null,
user int not null,
comment varchar(255) not null,
foreign key (state) references state(id),
foreign key (user) references users(id)
);


insert into state (title) values('Урок№1 Загрузка, установка и запуск Python и SciPy');
insert into state (title) values('Урок№2 Загрузите данные');
insert into state (title) values('Урок№3 Анализ датасета');
insert into state (title) values('Урок№4 Визуализация данных');
insert into state (title) values('Урок№5 Оценка алгоритмов');
insert into state (title) values('Урок№6 Прогнозирование данных');
insert into state (title) values('Машинное обучение в Python это не сложно');


create view comments_S as select comments.id, comments.state, users.login, comments.comment from comments join users on comments.user = users.id;

