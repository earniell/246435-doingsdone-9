CREATE DATABASE doingsdone
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE doingsdone;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(64) NOT NULL,
    email CHAR(128) NOT NULL UNIQUE,
    password CHAR(64) NOT NULL UNIQUE
);

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    name CHAR(128) NOT NULL
);

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    name CHAR(128) NOT NULL,
    dt_end CHAR(10),
    category CHAR(128) NOT NULL,
    status INT DEFAULT 0
);

CREATE UNIQUE INDEX users_email ON users(email);
CREATE INDEX projects_name ON projects(name);
CREATE INDEX tasks_category ON tasks(category);
CREATE INDEX tasks_dt_end ON tasks(dt_end);