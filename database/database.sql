CREATE DATABASE tsf;

USE tsf;

CREATE TABLE usuario(
    pk_user INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(90),
    user_mail VARCHAR(100),
    user_password VARCHAR(255),
    user_adm BOOLEAN DEFAULT FALSE NOT NULL
);

