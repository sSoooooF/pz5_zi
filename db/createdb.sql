-- Создаем базу данных
CREATE DATABASE auth;
USE auth;

-- Создаем таблицу с двумя полями: name и pass
CREATE TABLE auth (
    name VARCHAR(50) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    PRIMARY KEY (name)
);

-- Добавляем пользователей с простыми паролями
INSERT INTO auth (name, pass) VALUES
('user', 'pass'),
('test', 'test');