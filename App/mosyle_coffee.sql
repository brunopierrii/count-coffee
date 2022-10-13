-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 19-Set-2022 às 11:02
-- Versão do servidor: 8.0.30-0ubuntu0.20.04.2
-- versão do PHP: 7.4.30
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
  AUTOCOMMIT = 0;

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Banco de dados: `mosyle_coffee`
--
-- --------------------------------------------------------
--
-- Estrutura da tabela `coffee`
--
CREATE TABLE `coffee` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `drank_coffee` int NOT NULL,
  `date_time` datetime(6) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `coffee`
--
INSERT INTO
  `coffee` (`id`, `id_user`, `drank_coffee`, `date_time`)
VALUES
  (5, 6, 8, '2022-09-14 09:49:52.000000'),
  (7, 13, 14, '2022-09-14 04:41:49.000000');

-- --------------------------------------------------------
--
-- Estrutura da tabela `user`
--
CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(99) NOT NULL,
  `name` varchar(99) NOT NULL,
  `password` varchar(155) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `user`
--
INSERT INTO
  `user` (`id`, `email`, `name`, `password`)
VALUES
  (
    6,
    'testando@user.com',
    'Moreira',
    '$argon2id$v=19$m=65536,t=4,p=1$Tmg2WEkzQ3RLVWhINVJtUg$sWSqHqmrZ4d1yMEVoUOfxfeNrsv/+bNjsMzj34ohddE'
  ),
  (
    12,
    'nol@mail.com',
    'João',
    '$argon2id$v=19$m=65536,t=4,p=1$MDJJZmhEWVZwVFQ0cmcxYw$shf2lvtzrZrBbxb5Dow/cecV8jQTt3Efeb3pjkRGVpk'
  ),
  (
    13,
    'teste2@teste.com',
    'José',
    '$argon2id$v=19$m=65536,t=4,p=1$VjRjckZULkgwVkRXNzJUbw$D+xCAewjTtyyfsRAJS2q8oTX8NHWOZsa3pHq8ryuj9Y'
  );

--
-- Índices para tabelas despejadas
--
--
-- Índices para tabela `coffee`
--
ALTER TABLE
  `coffee`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `fk_id_pai` (`id_user`);

--
-- Índices para tabela `user`
--
ALTER TABLE
  `user`
ADD
  PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--
--
-- AUTO_INCREMENT de tabela `coffee`
--
ALTER TABLE
  `coffee`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE
  `user`
MODIFY
  `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 14;

--
-- Restrições para despejos de tabelas
--
--
-- Limitadores para a tabela `coffee`
--
ALTER TABLE
  `coffee`
ADD
  CONSTRAINT `fk_id_pai` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;