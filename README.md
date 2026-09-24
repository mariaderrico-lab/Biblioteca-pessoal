# MyBibli

MyBibli é um sistema web acadêmico feito em PHP para organizar um catálogo pessoal de leitura.

O usuário pode cadastrar livros, editar informações, alterar status, avaliar, filtrar, visualizar detalhes e excluir registros.

## Status dos livros

- Quero ler
- Lendo
- Lido

## Tecnologias usadas

- PHP 8.2+
- POO básica
- MVC simples
- Composer
- Autoload PSR-4
- PDO
- MySQL
- HTML5
- CSS3
- Bootstrap
- JavaScript básico para confirmação de exclusão

## Banco de dados

CREATE DATABASE IF NOT EXISTS mybibli CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mybibli;

CREATE TABLE IF NOT EXISTS livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    autor VARCHAR(150) NOT NULL,
    genero VARCHAR(100) NOT NULL DEFAULT '',
    status VARCHAR(20) NOT NULL,
    nota TINYINT NULL
);

