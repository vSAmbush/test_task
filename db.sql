create schema tasks;
use tasks;

create table user(id int primary key auto_increment,
 username varchar(40),
 email varchar(50),
 password_hash varchar(200),
 status bool)
engine = InnoDB;
 

create table task (id int primary key auto_increment,
 id_user int,
 task_body varchar(300),
 img_path varchar(100),
 status bool,
 foreign key (id_user) references user (id))
engine = InnoDB;

insert into user (username, email, password_hash, status) values
 ('admin', 'admin@admin.com', sha1('123'), 1),
 ('vovchai', 'vovan19977@gmail.com', sha1('12345'), 1);

insert into task (id_user, task_body, img_path, status) values
 (1, 'Вымыть посуду', null, true),
 (2, 'Помыть полы', '/test_task/resources/img/disaudio.png', false),
 (1, 'Выполнить тестовое задание', null, true),
 (2, 'Посмотреть сериал', null, false),
 (1, 'Выгулять собаку', null, false),
 (2, 'Собрать урожай и отвезти детей в школу', '/test_task/resources/img/Miner-Bob1.png', false);