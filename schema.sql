CREATE DATABASE doingsdone
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE doingsdone;

CREATE TABLE users (
   id INT AUTO_INCREMENT PRIMARY KEY,
   dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   name CHAR(64) NOT NULL,
   email CHAR(128) NOT NULL UNIQUE,
   password CHAR(64) NOT NULL UNIQUE
);

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL DEFAULT 0,
    name CHAR(250) NOT NULL
);

CREATE TABLE tasks (
     id INT AUTO_INCREMENT PRIMARY KEY,
     id_project INT DEFAULT 0,
     file CHAR DEFAULT 0,
     dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     name CHAR(250) NOT NULL,
     dt_end CHAR(10) DEFAULT 0,
     status BOOLEAN DEFAULT FALSE
);

CREATE UNIQUE INDEX users_email ON users(email);
CREATE INDEX tasks_category ON tasks(id_project);
CREATE INDEX tasks_dt_end ON tasks(dt_end);
