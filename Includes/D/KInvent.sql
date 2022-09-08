CREATE TABLE users (
        id int(20) null PRIMARY KEY AUTO_INCREMENT,
        user_uid varchar(256) not null,
        first_name varchar(256) not null,
        last_name varchar(256) not null,
        suffix varchar(256) null,
        user_pwd varchar(256) not null,
        user_cpwd varchar(256) not null,
        user_level varchar(50) not null,
        email_address varchar(256) null,
        date datetime not null,
        section varchar(256) not null,
        department varchar(256) not null);

CREATE TABLE accounts (
         id INT(20) PRIMARY KEY NOT null AUTO_INCREMENT,
         date datetime not null,
         user_uid varchar(256) not null,
         first_name varchar(256) not null,
         last_name varchar(256) not null,
         user_pwd varchar(256) not null,
         user_cpwd varchar(256),
         user_level varchar(13) not null,
         email_address varchar(50) not null);