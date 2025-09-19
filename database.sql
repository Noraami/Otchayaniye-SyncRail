CREATE DATABASE tsf;

USE tsf;

CREATE TABLE user(
    pk_user INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(50),
    user_mail VARCHAR(50),
    user_password VARCHAR(50),
    user_admlevel VARCHAR(15) DEFAULT "viewer"
);

