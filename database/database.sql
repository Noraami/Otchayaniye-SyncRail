CREATE DATABASE tsf;

USE tsf;

CREATE TABLE usuario(
    pk_user INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(90),
    user_mail VARCHAR(100),
    user_password VARCHAR(255),
    user_adm BOOLEAN DEFAULT FALSE NOT NULL
);

CREATE TABLE alertas(
    pk_alerta INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    fk_user INT,
    alerta_texto VARCHAR(255),
    alerta_data DATETIME DEFAULT CURRENT_TIMESTAMP,
    alerta_titulo VARCHAR(100),
    FOREIGN KEY (fk_user) REFERENCES usuario(pk_user)
)