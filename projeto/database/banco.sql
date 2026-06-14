-- ====================================================================
-- banco.sql
-- --------------------------------------------------------------------
-- Banco de dados do Mini Sistema Web (Trabalho Acadêmico)
--
-- Como usar:
--   1. Abra o phpMyAdmin (http://localhost/phpmyadmin)
--   2. Clique em "Importar"
--   3. Selecione este arquivo (banco.sql) e clique em "Executar"
--
-- Este arquivo cria o banco, as tabelas e insere o usuário administrador.
-- ====================================================================

-- Cria o banco de dados (se ainda não existir)
CREATE DATABASE IF NOT EXISTS sistema_web
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

-- Seleciona o banco para usar nas instruções abaixo
USE sistema_web;

-- --------------------------------------------------------------------
-- Tabela: usuarios
-- Guarda os usuários que podem fazer login no sistema.
-- A senha é armazenada de forma criptografada (password_hash).
-- --------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
    id     INT AUTO_INCREMENT PRIMARY KEY,
    nome   VARCHAR(100) NOT NULL,
    email  VARCHAR(150) NOT NULL UNIQUE,
    senha  VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------------------
-- Tabela: clientes
-- Guarda os dados dos clientes cadastrados.
-- --------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS clientes (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    nome          VARCHAR(100) NOT NULL,
    cpf           VARCHAR(20),
    telefone      VARCHAR(20),
    email         VARCHAR(150),
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------------------
-- Tabela: produtos
-- Guarda os dados dos produtos cadastrados.
-- --------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS produtos (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    nome          VARCHAR(100) NOT NULL,
    categoria     VARCHAR(80),
    quantidade    INT DEFAULT 0,
    preco         DECIMAL(10,2) DEFAULT 0.00,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------------------
-- INSERT do usuário administrador
--
-- E-mail: admin@admin.com
-- Senha:  123456
--
-- A senha abaixo é o resultado de password_hash("123456").
-- Por isso o login com a senha "123456" funcionará normalmente,
-- pois o PHP usa password_verify() para comparar.
-- --------------------------------------------------------------------
INSERT INTO usuarios (nome, email, senha) VALUES
('Administrador', 'admin@admin.com', '$2b$10$oEPR/WNNf5vBYx9xyjQv7OL16oTeFXadMZncrHBkMRqX3dsVlCYWe');

-- --------------------------------------------------------------------
-- (Opcional) Alguns dados de exemplo para a apresentação
-- --------------------------------------------------------------------
INSERT INTO clientes (nome, cpf, telefone, email) VALUES
('Maria Silva',  '111.111.111-11', '(81) 99999-1111', 'maria@email.com'),
('João Souza',   '222.222.222-22', '(81) 99999-2222', 'joao@email.com'),
('Ana Oliveira', '333.333.333-33', '(81) 99999-3333', 'ana@email.com');

INSERT INTO produtos (nome, categoria, quantidade, preco) VALUES
('Notebook Dell',   'Informática', 10, 3500.00),
('Mouse Logitech',  'Periféricos', 50,  120.00),
('Cadeira Gamer',   'Móveis',       8,  899.90);
