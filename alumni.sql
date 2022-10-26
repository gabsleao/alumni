-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Out-2022 às 02:20
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `alumni`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `idavaliacao` int(50) NOT NULL,
  `iduser_avaliador` int(50) NOT NULL,
  `idinstituicao` int(50) NOT NULL,
  `avaliacao` int(1) DEFAULT NULL,
  `data_criado` int(50) NOT NULL,
  `data_modificado` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `idcomentario` int(50) NOT NULL,
  `comentario` varchar(250) NOT NULL,
  `iduser_criador` int(50) NOT NULL,
  `idinstituicao` int(50) NOT NULL,
  `data_criado` int(50) NOT NULL,
  `data_modificado` int(50) NOT NULL,
  `esta_deletado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `idcurso` int(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `data_criado` int(50) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `idinstituicao` int(50) NOT NULL,
  `esta_deletado` int(1) NOT NULL DEFAULT 0,
  `informacoes` varchar(250) NOT NULL,
  `iduser_criador` int(50) NOT NULL,
  `data_modificado` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicoes`
--

CREATE TABLE `instituicoes` (
  `idinstituicao` int(50) NOT NULL,
  `nome` varchar(250) DEFAULT NULL,
  `localizacao` varchar(250) DEFAULT NULL,
  `data_criado` int(50) NOT NULL,
  `data_modificado` int(50) NOT NULL,
  `iduser_criador` int(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `esta_deletado` int(1) NOT NULL DEFAULT 0,
  `informacoes` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `iduser` int(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `localizacao` varchar(250) DEFAULT NULL,
  `data_criado` int(50) NOT NULL,
  `data_modificado` int(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `esta_deletado` int(1) NOT NULL DEFAULT 0,
  `informacoes` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`idavaliacao`),
  ADD KEY `idinstituicao` (`idinstituicao`),
  ADD KEY `iduser_avaliador` (`iduser_avaliador`);

--
-- Índices para tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idcomentario`),
  ADD KEY `iduser_criador` (`iduser_criador`),
  ADD KEY `idinstituicao` (`idinstituicao`);

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`idcurso`),
  ADD KEY `iduser_criador` (`iduser_criador`),
  ADD KEY `idinstituicao` (`idinstituicao`) USING BTREE;

--
-- Índices para tabela `instituicoes`
--
ALTER TABLE `instituicoes`
  ADD PRIMARY KEY (`idinstituicao`),
  ADD KEY `iduser_criador` (`iduser_criador`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `idavaliacao` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idcomentario` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `idcurso` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `instituicoes`
--
ALTER TABLE `instituicoes`
  MODIFY `idinstituicao` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `iduser` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `avaliacoes_ibfk_1` FOREIGN KEY (`idinstituicao`) REFERENCES `instituicoes` (`idinstituicao`),
  ADD CONSTRAINT `avaliacoes_ibfk_2` FOREIGN KEY (`iduser_avaliador`) REFERENCES `usuarios` (`iduser`);

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`iduser_criador`) REFERENCES `usuarios` (`iduser`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`idinstituicao`) REFERENCES `instituicoes` (`idinstituicao`);

--
-- Limitadores para a tabela `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`idinstituicao`) REFERENCES `instituicoes` (`idinstituicao`),
  ADD CONSTRAINT `cursos_ibfk_2` FOREIGN KEY (`iduser_criador`) REFERENCES `usuarios` (`iduser`);

--
-- Limitadores para a tabela `instituicoes`
--
ALTER TABLE `instituicoes`
  ADD CONSTRAINT `instituicoes_ibfk_1` FOREIGN KEY (`iduser_criador`) REFERENCES `usuarios` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
