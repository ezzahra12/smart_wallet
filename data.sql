create database wallet;
use	wallet;
create table incomes(
 id int primary key auto_increment,
 amount DECIMAL(10,2) ,
 desp VARCHAR(255),
 date_income DATE,
 created_at date DEFAULT (CURRENT_DATE))
 
 
 show tables;
 describe incomes;
 
 create table expenses(
 id int primary key auto_increment,
 amount decimal(10,2),
 desp varchar(215),
 date_expense Date,
 created_at date default (current_date))
 show tables;
 describe incomes;
 
 create table categories(
 id int primary key auto_increment,
 name varchar(215),
 type enum('income','expense'),
 created_at date default (current_date));
 
 

 describe incomes;
 
 alter table incomes
 add column category_id int;
 
  alter table incomes
 add constraint category_id 
 foreign key (category_id) references categories(id);
 
 
 alter table expenses
 add column category_id int;
 
  alter table expenses
 add constraint category_id 
 foreign key (category_id) references categories(id);
 
 
 describe expenses;
 use wallet;
 create table users(
    id int primary key AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL,
    email varchar(200) UNIQUE NOT NULL,
    password varchar(200) not NULL
 )

 insert into users (username,email,password) values ("salma","salma@gmail.com","234KH");



 describe users;
 select * from users;