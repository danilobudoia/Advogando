-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Dez-2017 às 19:42
-- Versão do servidor: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `advogando`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `processo_id` int(11) DEFAULT NULL,
  `evento` varchar(30) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `agenda`
--

INSERT INTO `agenda` (`id`, `cliente_id`, `processo_id`, `evento`, `data`, `hora`, `observacao`, `status`) VALUES
(6, NULL, 34, 'Despache dos documentos ', '2017-12-11', '10:00:00', 'Despachar os documentos do processo das industrias Wayne', 1),
(7, 18, 35, 'Tribunal / Adoção (Ana)', '2017-12-16', '09:00:00', 'Tribunal fechado da Adoção da Antonina', 1),
(8, 16, 35, 'Tribunal / Adoção (Mateus)', '2017-12-16', '11:00:00', 'Tribunal fechado da Adoção da Antonina', 1),
(9, NULL, NULL, 'Apresentação do TCC', '2017-12-13', '08:00:00', 'Apresentar o TCC ', 1),
(10, 15, 36, 'Tribunal / Demissão (Joana)', '2017-12-25', '14:58:00', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `repres_id` int(11) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `documento1` varchar(20) NOT NULL,
  `documento2` varchar(20) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `endereco` varchar(30) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(10) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `repres_id`, `tipo`, `nome`, `documento1`, `documento2`, `data_nasc`, `sexo`, `telefone`, `celular`, `email`, `endereco`, `numero`, `complemento`, `cidade`, `estado`, `cep`, `observacao`, `status`) VALUES
(15, 10, 'F', 'Joana Mark', '123.456.789-23', '11.111.111-1', '1984-06-13', 'F', '(11) 1111-1111', '(11) 11111-1111', 'joanamark@gmail.com', 'Rua dos lirios', '123', '', 'Americana', 'SP', '11111-111', 'Referente ao processo de demissão sem justa causa, alegando furto', 1),
(16, NULL, 'F', 'Mateus Henrique Ferreira ', '098.765.432-10', '22.222.222-2', '1990-06-12', 'M', '(19) 3458-9999', '', 'mhferreira@gmail.com', 'Av da Industria', '123', '', 'Santa Bárbara d\\\\\\\'Oeste', 'SP', '22222-222', 'Adoção da Antonina', 1),
(17, 11, 'J', 'Wayne Corp Prestação de Serviços Ltda - ME', '23.232.322/2323-23', '13445.2323.21-11S', '1989-05-16', '', '(21) 1212-1212', '(21) 12121-2121', 'waynecorp@waynecorp.com', 'Rua Roxburgh ', '6615 ', '', 'Gotham City', 'AC', '32323-223', 'Proprietários Thomas Wayne e Bruce Wayne, processados por desvio de verbas', 1),
(18, NULL, 'F', 'Ana Beatriz Antonieta Marcones', '333.333.333-33', '33.333.333-33', '1990-06-21', 'F', '(19) 3455-3434', '(19) 98843-4934', 'anabea.antonieta@outlook.com', 'Rua dos jabutis', '123', 'teste', 'Americana', 'SP', '34343-434', 'Processo de adoção da Antonina', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente_processo`
--

CREATE TABLE `cliente_processo` (
  `cliente_id` int(11) NOT NULL,
  `processo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente_processo`
--

INSERT INTO `cliente_processo` (`cliente_id`, `processo_id`) VALUES
(15, 36),
(16, 35),
(17, 34),
(18, 35);

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `processo_id` int(11) NOT NULL,
  `local` varchar(255) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `documentos`
--

INSERT INTO `documentos` (`id`, `processo_id`, `local`, `tipo`, `observacao`, `status`) VALUES
(50, 36, 'Petições/36/Reclamação trabalista (Joana).doc', 'Trabalhista/Despedid', 'Petição: Reclamação trabalista (Joana) | Tipo: Trabalhista/Despedida Sem Justa Causa | Cliente: Joana Mark | Data: 08-12-2017', 1),
(51, 37, 'Petições/37/Petição do Divorcio dos Santos.doc', 'Civil/Ação de Divórc', 'Petição: Petição do Divorcio dos Santos | Tipo: Civil/Ação de Divórcio | Cliente: Ana Beatriz Antonieta Marcones | Data: 08-12-2017', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `processos`
--

CREATE TABLE `processos` (
  `id` int(11) NOT NULL,
  `numero` varchar(30) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `natureza` varchar(30) NOT NULL,
  `data_inicio` date NOT NULL,
  `situacao` varchar(30) NOT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `processos`
--

INSERT INTO `processos` (`id`, `numero`, `nome`, `natureza`, `data_inicio`, `situacao`, `observacao`, `status`) VALUES
(34, 'DV127uI98a1A', 'Desvio de verbas Wayne', 'Direito Administrativo', '2017-11-24', 'Fase inicial', 'Processo de desvios de verbas contra a industrias Wayne, representado por Bruce Wayne (presidente)', 1),
(35, 'Ad123sS21', 'Adoção da Antonina', 'Direito Humanos', '2017-12-12', 'Em andamento', '', 1),
(36, 'DM213-33-Sa', 'Demissão', 'Direito do Trabalho', '2017-11-28', 'Aguardando perícia', 'Processo de demissão sem justa causa, alegando furto de objetos', 1),
(37, 'DVOR12-231jss232', 'Divorcio dos Santos', 'Direito de Família', '2015-06-17', 'Reaberto', '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `representantes`
--

CREATE TABLE `representantes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `documento` varchar(14) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `representantes`
--

INSERT INTO `representantes` (`id`, `nome`, `documento`, `telefone`, `celular`, `email`, `observacao`, `status`) VALUES
(10, 'Maria Joaquina', '123-123-123-12', '(19) 3458-9999', '', '', 'Representante do caso dos doces furtados', 1),
(11, 'Bruce Wayne', '234.343.431.23', '(21) 2345-2345', '(21) 2345-2345', 'brucewayne@hotmail.com', 'Proprietário da Wayne Enterprises', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Danilo', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ag_cliente_key` (`cliente_id`),
  ADD KEY `ag_processo_key` (`processo_id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cl_representante_key` (`repres_id`);

--
-- Indexes for table `cliente_processo`
--
ALTER TABLE `cliente_processo`
  ADD PRIMARY KEY (`cliente_id`,`processo_id`),
  ADD KEY `cp_processo_key` (`processo_id`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doc_processo_key` (`processo_id`);

--
-- Indexes for table `processos`
--
ALTER TABLE `processos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `representantes`
--
ALTER TABLE `representantes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `processos`
--
ALTER TABLE `processos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `ag_cliente_key` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `ag_processo_key` FOREIGN KEY (`processo_id`) REFERENCES `processos` (`id`);

--
-- Limitadores para a tabela `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `cl_representante_key` FOREIGN KEY (`repres_id`) REFERENCES `representantes` (`id`);

--
-- Limitadores para a tabela `cliente_processo`
--
ALTER TABLE `cliente_processo`
  ADD CONSTRAINT `cp_cliente_key` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `cp_processo_key` FOREIGN KEY (`processo_id`) REFERENCES `processos` (`id`);

--
-- Limitadores para a tabela `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `doc_processo_key` FOREIGN KEY (`processo_id`) REFERENCES `processos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
