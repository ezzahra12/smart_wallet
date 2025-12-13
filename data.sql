create database wallet;
use	wallet;
create table incomes(
 id int primary key auto_increment,
 amount DECIMAL(10,2) ,
 desp VARCHAR(255),
 date_income DATE,
 created_at date DEFAULT (CURRENT_DATE))
 
 alter table incomes
 change date_income date varchar(200);
 
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

 use wallet;
ALTER TABLE expenses
ADD COLUMN user_id INT NULL,
ADD CONSTRAINT user_id
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE SET NULL;

    alter table expenses
    drop COLUMN user_id;
     describe incomes;

     select * from information_schema.TABLE_CONSTRAINTS where `TABLE_NAME`='expenses';
     show create table incomes;

     SELECT * from expenses;
SELECT * from USERs;
update expenses
set user_id='4' where user_id is null;

describe expenses;

 alter table expenses
    drop Foreign Key  user_id;


