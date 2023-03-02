-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Mar-2023 às 13:28
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dummy_db.sql`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `calendario_de_aula`
--

CREATE TABLE `calendario_de_aula` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `id_uc` int(11) DEFAULT NULL,
  `horario_inicio` datetime DEFAULT NULL,
  `horario_fim` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `calendario_de_aula`
--

INSERT INTO `calendario_de_aula` (`id`, `usuario_id`, `id_uc`, `horario_inicio`, `horario_fim`) VALUES
(3, 1002, 1, '2023-03-03 00:00:00', '2023-03-03 04:00:00');

--
-- Acionadores `calendario_de_aula`
--
DELIMITER $$
CREATE TRIGGER `check_conflito_horario` BEFORE INSERT ON `calendario_de_aula` FOR EACH ROW BEGIN
IF EXISTS (
SELECT *
FROM calendario_de_aula
WHERE usuario_id = NEW.usuario_id
AND ((NEW.horario_inicio BETWEEN horario_inicio AND horario_fim)
OR (NEW.horario_fim BETWEEN horario_inicio AND horario_fim)
OR (NEW.horario_inicio < horario_inicio AND NEW.horario_fim > horario_fim))
) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Professor já está ocupado em outro horário no mesmo período.';
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_carga_horaria` AFTER INSERT ON `calendario_de_aula` FOR EACH ROW BEGIN
UPDATE uc
SET carga_horaria = carga_horaria - INTERVAL 4 HOUR
WHERE id = NEW.id_uc;

UPDATE turma
SET carga_horaria = carga_horaria - INTERVAL 4 HOUR
WHERE id = (SELECT num_turma FROM uc WHERE id = NEW.id_uc);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `docentes`
--

CREATE TABLE `docentes` (
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `docentes`
--

INSERT INTO `docentes` (`usuario_id`) VALUES
(1002);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `tipo` enum('trilhas','aprendizagem') DEFAULT NULL,
  `carga_horaria` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id`, `nome`, `tipo`, `carga_horaria`) VALUES
(1, 'web', 'trilhas', '-03:15:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `uc`
--

CREATE TABLE `uc` (
  `id` int(11) NOT NULL,
  `nome_uc` varchar(255) DEFAULT NULL,
  `num_turma` int(11) DEFAULT NULL,
  `carga_horaria` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `uc`
--

INSERT INTO `uc` (`id`, `nome_uc`, `num_turma`, `carga_horaria`) VALUES
(1, 'web', 1, '-03:15:00');

--
-- Acionadores `uc`
--
DELIMITER $$
CREATE TRIGGER `check_carga_horaria_uc` BEFORE INSERT ON `uc` FOR EACH ROW BEGIN
IF NEW.carga_horaria > (SELECT carga_horaria FROM turma WHERE id = NEW.num_turma) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Carga horária da UC não pode ser maior do que a da Turma.';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `ra` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`ra`, `nome`, `email`, `senha`) VALUES
(1002, 'samuel', 'slassist@gmail.com', '123123');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `calendario_de_aula`
--
ALTER TABLE `calendario_de_aula`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`,`horario_inicio`,`horario_fim`),
  ADD UNIQUE KEY `id_uc` (`id_uc`,`horario_inicio`,`horario_fim`);

--
-- Índices para tabela `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Índices para tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `uc`
--
ALTER TABLE `uc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `num_turma` (`num_turma`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ra`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `calendario_de_aula`
--
ALTER TABLE `calendario_de_aula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `uc`
--
ALTER TABLE `uc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `calendario_de_aula`
--
ALTER TABLE `calendario_de_aula`
  ADD CONSTRAINT `calendario_de_aula_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `docentes` (`usuario_id`),
  ADD CONSTRAINT `calendario_de_aula_ibfk_2` FOREIGN KEY (`id_uc`) REFERENCES `uc` (`id`);

--
-- Limitadores para a tabela `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `docentes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`ra`);

--
-- Limitadores para a tabela `uc`
--
ALTER TABLE `uc`
  ADD CONSTRAINT `uc_ibfk_1` FOREIGN KEY (`num_turma`) REFERENCES `turma` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
