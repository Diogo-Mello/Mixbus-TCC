-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 27-Jun-2023 às 15:00
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mixbus`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

DROP TABLE IF EXISTS `cidade`;
CREATE TABLE IF NOT EXISTS `cidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  `fkEstado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkEstado` (`fkEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`id`, `nome`, `fkEstado`) VALUES
(1, 'Iperó', 1),
(2, 'Boituva', 1),
(3, 'Sorocaba', 1),
(4, 'Tatuí', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cnpj` char(14) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `senha` char(60) NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `logo` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id`, `nome`, `cnpj`, `telefone`, `email`, `senha`, `ativo`, `logo`) VALUES
(1, 'Rápido Luxo Campinas', '45992724002493', '1534598050', 'rapidoluxocampinas@mixbus.com', '$2y$10$R64idrDGI6u/XTj/xtO7LeGWwkokbQfN910KBSeqzV8pD1S9FVnLq', 1, 'https://burhstorage.blob.core.windows.net/burhcontainer/app/company/logo/dvwqXpoREXvafDsQFKh1ODJk6kx11tspcBAn60WoYJW6LaoUybme/200/8d372e633561190874a330d1c95f82d8.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `sigla` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`id`, `nome`, `sigla`) VALUES
(1, 'São Paulo', 'SP'),
(2, 'Rio de Janeiro', 'RJ'),
(3, 'Minas Gerais', 'MG'),
(4, 'Bahia', 'BA'),
(5, 'Paraná', 'PR'),
(6, 'Santa Catarina', 'SC'),
(7, 'Rio Grande do Sul', 'RS'),
(8, 'Pernambuco', 'PE'),
(9, 'Ceará', 'CE'),
(10, 'Pará', 'PA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE IF NOT EXISTS `horario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diaSemanal` varchar(20) NOT NULL,
  `horarioIda` time DEFAULT NULL,
  `fkObsIda` int(11) DEFAULT NULL,
  `horarioVolta` time DEFAULT NULL,
  `fkObsVolta` int(11) DEFAULT NULL,
  `fkLinha` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkObsIda` (`fkObsIda`),
  KEY `fkObsVolta` (`fkObsVolta`),
  KEY `fkLinha` (`fkLinha`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `horario`
--

INSERT INTO `horario` (`id`, `diaSemanal`, `horarioIda`, `fkObsIda`, `horarioVolta`, `fkObsVolta`, `fkLinha`) VALUES
(1, 'DIAS UTEIS', '05:00:00', 1, '05:30:00', 2, 1),
(2, 'DIAS UTEIS', '05:40:00', 1, '06:20:00', 3, 1),
(3, 'DIAS UTEIS', '06:10:00', 1, '06:40:00', 4, 1),
(4, 'DIAS UTEIS', '06:10:00', 5, '07:00:00', 6, 1),
(5, 'DIAS UTEIS', '07:00:00', 6, '07:30:00', 3, 1),
(6, 'DIAS UTEIS', '07:30:00', 6, '08:00:00', 6, 1),
(7, 'DIAS UTEIS', '08:00:00', 1, '08:30:00', 6, 1),
(8, 'DIAS UTEIS', '08:30:00', 6, '09:00:00', 6, 1),
(9, 'DIAS UTEIS', '09:15:00', 5, '10:00:00', 6, 1),
(10, 'DIAS UTEIS', '10:40:00', 6, '11:20:00', 6, 1),
(11, 'DIAS UTEIS', '12:00:00', 6, '12:30:00', 6, 1),
(12, 'DIAS UTEIS', '13:00:00', 6, '13:30:00', 5, 1),
(13, 'DIAS UTEIS', '14:15:00', 4, '15:00:00', 8, 1),
(14, 'DIAS UTEIS', '15:30:00', 6, '16:00:00', 6, 1),
(15, 'DIAS UTEIS', '16:30:00', 6, '17:00:00', 5, 1),
(16, 'DIAS UTEIS', '17:05:00', 7, '17:40:00', 1, 1),
(17, 'DIAS UTEIS', '17:50:00', 3, '18:20:00', 1, 1),
(18, 'DIAS UTEIS', '19:00:00', 1, '19:30:00', 5, 1),
(19, 'DIAS UTEIS', '20:30:00', 6, '21:00:00', 6, 1),
(20, 'DIAS UTEIS', '22:10:00', 6, '22:50:00', 6, 1),
(21, 'SÁBADOS', '05:20:00', 1, '06:00:00', 3, 1),
(22, 'SÁBADOS', '07:00:00', 6, '07:30:00', 6, 1),
(23, 'SÁBADOS', '08:00:00', 1, '08:30:00', 6, 1),
(24, 'SÁBADOS', '09:00:00', 6, '09:30:00', 6, 1),
(25, 'SÁBADOS', '10:00:00', 6, '10:30:00', 6, 1),
(26, 'SÁBADOS', '11:00:00', 6, '11:30:00', 1, 1),
(27, 'SÁBADOS', '12:30:00', 1, '13:15:00', 3, 1),
(28, 'SÁBADOS', '14:15:00', 3, '15:00:00', 6, 1),
(29, 'SÁBADOS', '15:30:00', 6, '16:00:00', 6, 1),
(30, 'SÁBADOS', '16:30:00', 6, '17:00:00', 6, 1),
(31, 'SÁBADOS', '18:00:00', 6, '19:00:00', 6, 1),
(32, 'SÁBADOS', '19:30:00', 6, '20:30:00', 6, 1),
(33, 'DOMINGOS E FERIADOS', '06:00:00', 6, '06:30:00', 6, 1),
(34, 'DOMINGOS E FERIADOS', '08:00:00', 6, '08:30:00', 6, 1),
(35, 'DOMINGOS E FERIADOS', '11:00:00', 6, '12:00:00', 6, 1),
(36, 'DOMINGOS E FERIADOS', '14:00:00', 6, '15:00:00', 6, 1),
(37, 'DOMINGOS E FERIADOS', '17:00:00', 6, '18:00:00', 6, 1),
(38, 'DOMINGOS E FERIADOS', '19:00:00', 6, '20:00:00', 6, 1),
(39, 'DIAS UTEIS', '04:30:00', 10, '05:35:00', 8, 2),
(40, 'DIAS UTEIS', '05:20:00', NULL, '06:30:00', 9, 2),
(41, 'DIAS UTEIS', '07:00:00', NULL, '06:50:00', NULL, 2),
(42, 'DIAS UTEIS', '09:00:00', NULL, '08:30:00', NULL, 2),
(43, 'DIAS UTEIS', '11:00:00', NULL, '10:30:00', NULL, 2),
(44, 'DIAS UTEIS', '12:00:00', NULL, '12:30:00', NULL, 2),
(45, 'DIAS UTEIS', '14:00:00', NULL, '13:30:00', NULL, 2),
(46, 'DIAS UTEIS', '15:00:00', NULL, '15:30:00', NULL, 2),
(47, 'DIAS UTEIS', '16:00:00', NULL, '16:30:00', NULL, 2),
(48, 'DIAS UTEIS', '16:40:00', NULL, '17:45:00', NULL, 2),
(49, 'DIAS UTEIS', '17:00:00', 9, '18:30:00', NULL, 2),
(50, 'DIAS UTEIS', '18:00:00', NULL, '19:30:00', NULL, 2),
(51, 'DIAS UTEIS', '22:00:00', NULL, '23:00:00', NULL, 2),
(52, 'SÁBADOS', '05:20:00', NULL, '06:30:00', NULL, 2),
(53, 'SÁBADOS', '07:00:00', NULL, '08:30:00', NULL, 2),
(54, 'SÁBADOS', '09:00:00', NULL, '10:30:00', NULL, 2),
(55, 'SÁBADOS', '11:00:00', NULL, '12:30:00', NULL, 2),
(56, 'SÁBADOS', '13:00:00', NULL, '14:30:00', NULL, 2),
(57, 'SÁBADOS', '17:00:00', NULL, '18:30:00', NULL, 2),
(58, 'SÁBADOS', '19:00:00', NULL, '20:30:00', NULL, 2),
(59, 'DOMINGOS E FERIADOS', '08:00:00', NULL, '09:30:00', NULL, 2),
(60, 'DOMINGOS E FERIADOS', '13:00:00', NULL, '14:30:00', NULL, 2),
(61, 'DOMINGOS E FERIADOS', '17:30:00', NULL, '19:00:00', NULL, 2),
(62, 'DIAS UTEIS', '04:20:00', NULL, '05:00:00', NULL, 3),
(63, 'DIAS UTEIS', '05:35:00', NULL, '06:10:00', NULL, 3),
(64, 'DIAS UTEIS', '06:50:00', NULL, '07:25:00', NULL, 3),
(65, 'DIAS UTEIS', '08:30:00', NULL, '09:30:00', NULL, 3),
(66, 'DIAS UTEIS', '12:00:00', NULL, '13:00:00', NULL, 3),
(67, 'DIAS UTEIS', '14:10:00', NULL, '15:00:00', NULL, 3),
(68, 'DIAS UTEIS', '17:15:00', NULL, '18:00:00', NULL, 3),
(69, 'DIAS UTEIS', '18:10:00', NULL, '19:00:00', NULL, 3),
(70, 'DIAS UTEIS', '22:10:00', NULL, '23:00:00', NULL, 3),
(71, 'SÁBADOS', '08:30:00', NULL, '09:30:00', NULL, 3),
(72, 'SÁBADOS', '12:00:00', NULL, '13:00:00', NULL, 3),
(73, 'DOMINGOS E FERIADOS', '08:30:00', NULL, '09:30:00', NULL, 3),
(74, 'DOMINGOS E FERIADOS', '12:00:00', NULL, '13:00:00', NULL, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `linha`
--

DROP TABLE IF EXISTS `linha`;
CREATE TABLE IF NOT EXISTS `linha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linha` decimal(10,0) NOT NULL,
  `preco` decimal(6,2) NOT NULL,
  `fkcidadeIda` int(11) NOT NULL,
  `fkCidadeVolta` int(11) NOT NULL,
  `fkEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkcidadeIda` (`fkcidadeIda`),
  KEY `fkCidadeVolta` (`fkCidadeVolta`),
  KEY `fkEmpresa` (`fkEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `linha`
--

INSERT INTO `linha` (`id`, `linha`, `preco`, `fkcidadeIda`, `fkCidadeVolta`, `fkEmpresa`) VALUES
(1, '6322', '3.90', 1, 2, 1),
(2, '6325', '6.65', 1, 3, 1),
(3, '6323', '4.90', 1, 4, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `localizacao`
--

DROP TABLE IF EXISTS `localizacao`;
CREATE TABLE IF NOT EXISTS `localizacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` varchar(20) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `fkLinha` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkLinha` (`fkLinha`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `localizacao`
--

INSERT INTO `localizacao` (`id`, `latitude`, `longitude`, `fkLinha`) VALUES
(1, '-23.321238', '-47.682452', 1),
(2, '-23.396181', '-47.594719', 2),
(3, '-23.3652391', '-47.7550781', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `motorista`
--

DROP TABLE IF EXISTS `motorista`;
CREATE TABLE IF NOT EXISTS `motorista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` char(6) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `cpf` char(11) NOT NULL,
  `senha` char(60) NOT NULL,
  `fkEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkEmpresa` (`fkEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `motorista`
--

INSERT INTO `motorista` (`id`, `matricula`, `nome`, `cpf`, `senha`, `fkEmpresa`) VALUES
(1, '00101', 'Diogo Mello da Crus', '12345678901', '$2y$10$8r9yX5VWg6UltoJNZpwZxeXPwEtNQedgQcjYAwdG22UEn6CvuNWkC', 1),
(2, '00102', 'Kevin de Melo Rezende', '12345678902', '$2y$10$Rku1vGNhgMHZp46iQzwOYeTfpjP0CIaYAOTntucf/Acf7UNEqbqhO', 1),
(3, '00103', 'Nicolas Eduardo Sandri da Silva', '12345678903', '$2y$10$8LqmPIpgoxgPN3acSO9MMebEMfu8JNdL7g81wxXhpAYSCu57V4Xve', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `observacao`
--

DROP TABLE IF EXISTS `observacao`;
CREATE TABLE IF NOT EXISTS `observacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(500) NOT NULL,
  `fkEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkEmpresa` (`fkEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `observacao`
--

INSERT INTO `observacao` (`id`, `descricao`, `fkEmpresa`) VALUES
(1, 'Corre via Vila do Depósito', 1),
(2, 'Corre via Distrito Industrial de Iperó, chegando até o Conjunto Habitacional e corre via Vila do Depósito', 1),
(3, 'Corre via Distrito Industrial de Iperó, chegando até Conjunto Habitacional', 1),
(4, 'Corre via Distrito Industrial de Iperó, chegando até Conjunto Habitacional e Nova Bacaetava', 1),
(5, 'Corre via Nova Bacaetava', 1),
(6, 'Corre via Conjunto Habitacional', 1),
(7, 'Corre via Presídio de Iperó e não passa no conjunto habitacional', 1),
(8, 'Corre via Distrito Industrial de Iperó', 1),
(9, 'Corre via Presídio de Iperó', 1),
(10, 'Não entra em Bacaetava', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `suporte`
--

DROP TABLE IF EXISTS `suporte`;
CREATE TABLE IF NOT EXISTS `suporte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(500) DEFAULT NULL,
  `resposta` varchar(500) DEFAULT NULL,
  `resolvido` tinyint(1) NOT NULL,
  `fkUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkUsuario` (`fkUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `suporte`
--

INSERT INTO `suporte` (`id`, `descricao`, `resposta`, `resolvido`, `fkUsuario`) VALUES
(1, 'Dúvida sobre o serviço', '', 0, 1),
(2, 'Dificuldade para realizar login', 'Verifique se todos os dados foram preenchidos corretamente', 1, 1),
(3, 'Reclamação sobre o atendimento', '', 0, 2),
(4, 'Sugestão para melhorias', '', 0, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(256) NOT NULL,
  `senha` char(60) NOT NULL,
  `dataNascimento` date DEFAULT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `dataNascimento`, `telefone`) VALUES
(1, 'Diogo Mello', 'diogomello@mixbus.com', '$2y$10$8r9yX5VWg6UltoJNZpwZxeXPwEtNQedgQcjYAwdG22UEn6CvuNWkC', '2003-08-11', '01123456789'),
(2, 'Kevin Rezende', 'kevinrezende@mixbus.com', '$2y$10$Rku1vGNhgMHZp46iQzwOYeTfpjP0CIaYAOTntucf/Acf7UNEqbqhO', '2005-02-15', '02123456789'),
(3, 'Nicolas Eduardo', 'nicolaseduardo@mixbus.com', '$2y$10$8LqmPIpgoxgPN3acSO9MMebEMfu8JNdL7g81wxXhpAYSCu57V4Xve', '2005-04-21', '03123456789');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `cidade_ibfk_1` FOREIGN KEY (`fkEstado`) REFERENCES `estado` (`id`);

--
-- Limitadores para a tabela `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`fkObsIda`) REFERENCES `observacao` (`id`),
  ADD CONSTRAINT `horario_ibfk_2` FOREIGN KEY (`fkObsVolta`) REFERENCES `observacao` (`id`),
  ADD CONSTRAINT `horario_ibfk_3` FOREIGN KEY (`fkLinha`) REFERENCES `linha` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `linha`
--
ALTER TABLE `linha`
  ADD CONSTRAINT `linha_ibfk_1` FOREIGN KEY (`fkcidadeIda`) REFERENCES `cidade` (`id`),
  ADD CONSTRAINT `linha_ibfk_2` FOREIGN KEY (`fkCidadeVolta`) REFERENCES `cidade` (`id`),
  ADD CONSTRAINT `linha_ibfk_3` FOREIGN KEY (`fkEmpresa`) REFERENCES `empresa` (`id`);

--
-- Limitadores para a tabela `localizacao`
--
ALTER TABLE `localizacao`
  ADD CONSTRAINT `localizacao_ibfk_1` FOREIGN KEY (`fkLinha`) REFERENCES `linha` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `motorista`
--
ALTER TABLE `motorista`
  ADD CONSTRAINT `motorista_ibfk_1` FOREIGN KEY (`fkEmpresa`) REFERENCES `empresa` (`id`);

--
-- Limitadores para a tabela `observacao`
--
ALTER TABLE `observacao`
  ADD CONSTRAINT `observacao_ibfk_1` FOREIGN KEY (`fkEmpresa`) REFERENCES `empresa` (`id`);

--
-- Limitadores para a tabela `suporte`
--
ALTER TABLE `suporte`
  ADD CONSTRAINT `suporte_ibfk_1` FOREIGN KEY (`fkUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
