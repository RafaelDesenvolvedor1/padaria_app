-- ============================================================
-- SISTEMA DE PADARIA
-- Categoria: Comércio
-- Objetivo: Controlar produtos, clientes, vendas,
--           funcionários e fornecedores.
-- ============================================================

CREATE DATABASE IF NOT EXISTS db_padaria
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE db_padaria;

-- ------------------------------------------------------------
-- Tabela: fornecedor
-- (criada antes de produto por causa da FK)
-- ------------------------------------------------------------
CREATE TABLE fornecedor (
  id_fornecedor INT          NOT NULL AUTO_INCREMENT,
  nome          VARCHAR(100) NOT NULL COMMENT 'Nome ou título de fornecedor',
  descricao     TEXT                  COMMENT 'Descrição de fornecedor',
  status        VARCHAR(30)           COMMENT 'Situação do registro',

  CONSTRAINT pk_fornecedor PRIMARY KEY (id_fornecedor)
) COMMENT = 'Fornecedores de produtos da padaria';

-- ------------------------------------------------------------
-- Tabela: produto
-- Relacionamento: fornecedor 1:N produto
-- ------------------------------------------------------------
CREATE TABLE produto (
  id_produto    INT          NOT NULL AUTO_INCREMENT,
  nome          VARCHAR(100) NOT NULL COMMENT 'Nome ou título de produto',
  descricao     TEXT                  COMMENT 'Descrição de produto',
  status        VARCHAR(30)           COMMENT 'Situação do registro',
  id_fornecedor INT                   COMMENT 'Fornecedor do produto',

  CONSTRAINT pk_produto        PRIMARY KEY (id_produto),
  CONSTRAINT fk_produto_fornecedor
    FOREIGN KEY (id_fornecedor)
    REFERENCES fornecedor (id_fornecedor)
    ON UPDATE CASCADE
    ON DELETE SET NULL
) COMMENT = 'Produtos comercializados pela padaria';

-- ------------------------------------------------------------
-- Tabela: cliente
-- ------------------------------------------------------------
CREATE TABLE cliente (
  id_cliente INT          NOT NULL AUTO_INCREMENT,
  nome       VARCHAR(100) NOT NULL COMMENT 'Nome ou título de cliente',
  telefone   VARCHAR(20)           COMMENT 'Telefone de contato',
  email      VARCHAR(100)          COMMENT 'E-mail de contato',

  CONSTRAINT pk_cliente PRIMARY KEY (id_cliente)
) COMMENT = 'Clientes da padaria';

-- ------------------------------------------------------------
-- Tabela: funcionario
-- ------------------------------------------------------------
CREATE TABLE funcionario (
  id_funcionario INT          NOT NULL AUTO_INCREMENT,
  nome           VARCHAR(100) NOT NULL COMMENT 'Nome ou título de funcionário',
  telefone       VARCHAR(20)           COMMENT 'Telefone de contato',
  email          VARCHAR(100)          COMMENT 'E-mail de contato',

  CONSTRAINT pk_funcionario PRIMARY KEY (id_funcionario)
) COMMENT = 'Funcionários da padaria';

-- ------------------------------------------------------------
-- Tabela: venda
-- Relacionamentos: cliente 1:N venda  |  funcionario 1:N venda
-- ------------------------------------------------------------
CREATE TABLE venda (
  id_venda       INT          NOT NULL AUTO_INCREMENT,
  nome           VARCHAR(100) NOT NULL COMMENT 'Nome ou título de venda',
  descricao      TEXT                  COMMENT 'Descrição de venda',
  status         VARCHAR(30)           COMMENT 'Situação do registro',
  id_cliente     INT                   COMMENT 'Cliente da venda',
  id_funcionario INT                   COMMENT 'Funcionário responsável',

  CONSTRAINT pk_venda PRIMARY KEY (id_venda),

  CONSTRAINT fk_venda_cliente
    FOREIGN KEY (id_cliente)
    REFERENCES cliente (id_cliente)
    ON UPDATE CASCADE
    ON DELETE SET NULL,

  CONSTRAINT fk_venda_funcionario
    FOREIGN KEY (id_funcionario)
    REFERENCES funcionario (id_funcionario)
    ON UPDATE CASCADE
    ON DELETE SET NULL
) COMMENT = 'Vendas realizadas pela padaria';

-- ------------------------------------------------------------
-- Tabela associativa: venda_produto
-- Relacionamento N:N entre venda e produto
-- ------------------------------------------------------------
CREATE TABLE venda_produto (
  id_venda   INT NOT NULL COMMENT 'Referência à venda',
  id_produto INT NOT NULL COMMENT 'Referência ao produto',

  CONSTRAINT pk_venda_produto
    PRIMARY KEY (id_venda, id_produto),

  CONSTRAINT fk_vp_venda
    FOREIGN KEY (id_venda)
    REFERENCES venda (id_venda)
    ON UPDATE CASCADE
    ON DELETE CASCADE,

  CONSTRAINT fk_vp_produto
    FOREIGN KEY (id_produto)
    REFERENCES produto (id_produto)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) COMMENT = 'Associação N:N entre vendas e produtos';
