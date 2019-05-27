-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Maio-2019 às 23:07
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oficina`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios_lab`
--

CREATE TABLE `comentarios_lab` (
  `id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comentario` varchar(100) NOT NULL,
  `hora` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios_maq`
--

CREATE TABLE `comentarios_maq` (
  `id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comentario` varchar(200) NOT NULL,
  `hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario_pat`
--

CREATE TABLE `comentario_pat` (
  `id` int(11) NOT NULL,
  `pat` varchar(40) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comentario` varchar(200) DEFAULT NULL,
  `hora` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `descricao`
--

CREATE TABLE `descricao` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `evt_lab`
--

CREATE TABLE `evt_lab` (
  `id` int(11) NOT NULL,
  `lab` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `hora` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `evt_rotina`
--

CREATE TABLE `evt_rotina` (
  `id` int(11) NOT NULL,
  `id_us` int(11) NOT NULL,
  `hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `maq` int(11) NOT NULL,
  `hora` datetime DEFAULT CURRENT_TIMESTAMP,
  `situacao` varchar(50) NOT NULL DEFAULT 'Ativa'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorios`
--

CREATE TABLE `laboratorios` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `n_maquinas` int(11) NOT NULL,
  `problemas` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `maquinas`
--

CREATE TABLE `maquinas` (
  `id` int(11) NOT NULL,
  `lab` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `patrimonio` varchar(50) DEFAULT 'Indefinido',
  `n_serie` varchar(50) DEFAULT NULL,
  `w_serial` varchar(100) DEFAULT 'Sem Serial',
  `situacao` varchar(20) DEFAULT NULL,
  `maq` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Acionadores `maquinas`
--
DELIMITER $$
CREATE TRIGGER `addLab` AFTER INSERT ON `maquinas` FOR EACH ROW begin
	update laboratorios as l 
    set l.n_maquinas = l.n_maquinas + 1 
    where l.id = new.lab;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ctrlz` AFTER DELETE ON `maquinas` FOR EACH ROW update laboratorios as l set l.n_maquinas = l.n_maquinas -1 where old.lab = id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `patrimonio`
--

CREATE TABLE `patrimonio` (
  `pat` varchar(40) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `id_desc` int(11) NOT NULL,
  `localizacao` varchar(60) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `softwares`
--

CREATE TABLE `softwares` (
  `id` int(11) NOT NULL,
  `lab` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `instalacao` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `nivel` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios_lab`
--
ALTER TABLE `comentarios_lab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `comentarios_maq`
--
ALTER TABLE `comentarios_maq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `comentario_pat`
--
ALTER TABLE `comentario_pat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pat` (`pat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `descricao`
--
ALTER TABLE `descricao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evt_lab`
--
ALTER TABLE `evt_lab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab` (`lab`);

--
-- Indexes for table `evt_rotina`
--
ALTER TABLE `evt_rotina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_us` (`id_us`);

--
-- Indexes for table `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qulquernome` (`maq`);

--
-- Indexes for table `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab` (`lab`);

--
-- Indexes for table `patrimonio`
--
ALTER TABLE `patrimonio`
  ADD PRIMARY KEY (`pat`),
  ADD KEY `id_desc` (`id_desc`);

--
-- Indexes for table `softwares`
--
ALTER TABLE `softwares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab` (`lab`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios_lab`
--
ALTER TABLE `comentarios_lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comentarios_maq`
--
ALTER TABLE `comentarios_maq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comentario_pat`
--
ALTER TABLE `comentario_pat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `descricao`
--
ALTER TABLE `descricao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evt_lab`
--
ALTER TABLE `evt_lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evt_rotina`
--
ALTER TABLE `evt_rotina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laboratorios`
--
ALTER TABLE `laboratorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `softwares`
--
ALTER TABLE `softwares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `comentarios_lab`
--
ALTER TABLE `comentarios_lab`
  ADD CONSTRAINT `comentarios_lab_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evt_lab` (`id`),
  ADD CONSTRAINT `comentarios_lab_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `comentarios_maq`
--
ALTER TABLE `comentarios_maq`
  ADD CONSTRAINT `comentarios_maq_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `historico` (`id`),
  ADD CONSTRAINT `comentarios_maq_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `comentario_pat`
--
ALTER TABLE `comentario_pat`
  ADD CONSTRAINT `comentario_pat_ibfk_1` FOREIGN KEY (`pat`) REFERENCES `patrimonio` (`pat`),
  ADD CONSTRAINT `comentario_pat_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `evt_lab`
--
ALTER TABLE `evt_lab`
  ADD CONSTRAINT `evt_lab_ibfk_1` FOREIGN KEY (`lab`) REFERENCES `laboratorios` (`id`);

--
-- Limitadores para a tabela `evt_rotina`
--
ALTER TABLE `evt_rotina`
  ADD CONSTRAINT `evt_rotina_ibfk_1` FOREIGN KEY (`id_us`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `qulquernome` FOREIGN KEY (`maq`) REFERENCES `maquinas` (`id`);

--
-- Limitadores para a tabela `maquinas`
--
ALTER TABLE `maquinas`
  ADD CONSTRAINT `maquinas_ibfk_1` FOREIGN KEY (`lab`) REFERENCES `laboratorios` (`id`);

--
-- Limitadores para a tabela `patrimonio`
--
ALTER TABLE `patrimonio`
  ADD CONSTRAINT `patrimonio_ibfk_1` FOREIGN KEY (`id_desc`) REFERENCES `descricao` (`id`);

--
-- Limitadores para a tabela `softwares`
--
ALTER TABLE `softwares`
  ADD CONSTRAINT `softwares_ibfk_1` FOREIGN KEY (`lab`) REFERENCES `laboratorios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
