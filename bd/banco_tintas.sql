-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/06/2025 às 23:33
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco_tintas`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `clientes_adicionar` (IN `v_email` VARCHAR(80), IN `v_foto` VARCHAR(100), IN `v_telefone` CHAR(11), IN `v_senhaHash` VARCHAR(255), IN `v_nome` VARCHAR(70), IN `v_direcionamento` VARCHAR(20))   INSERT INTO clientes (email, foto, telefone, senhaHash, nome, direcionamento) VALUES (v_email, v_foto, v_telefone, v_senhaHash, v_nome, v_direcionamento)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `clientes_atualizar` (IN `v_id` INT, IN `v_email` VARCHAR(80), IN `v_foto` VARCHAR(100), IN `v_telefone` CHAR(11), IN `v_senhaHash` VARCHAR(255), IN `v_nome` VARCHAR(70), IN `v_direcionamento` VARCHAR(20))   UPDATE clientes SET email = v_email, foto = v_foto, telefone = v_telefone, senhaHash = v_senhaHash, nome = v_nome, direcionamento = v_direcionamento WHERE id = v_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `clientes_carregarPor_email` (IN `v_email` VARCHAR(80))   SELECT * FROM clientes WHERE email = v_email$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `clientes_carregarPor_id` (IN `v_id` INT)   SELECT * FROM clientes WHERE id = v_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `clientes_remover` (IN `v_id` INT)   DELETE FROM clientes WHERE id = v_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `gestor_adicionar` (IN `v_email` VARCHAR(80), IN `v_senhaHash` VARCHAR(255))   INSERT INTO gestor (email, senhaHash) VALUES (v_email, v_senhaHash)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `gestor_atualizar` (IN `v_id` INT, IN `v_email` VARCHAR(80), IN `v_senhaHash` VARCHAR(255))   UPDATE gestor SET email = v_email, senhaHash = v_senhaHash WHERE id = v_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `gestor_carregarPor_email` (IN `v_email` VARCHAR(80))   SELECT * FROM gestor WHERE email = v_email$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `gestor_remover` (IN `v_id` INT)   DELETE FROM gestor WHERE id = v_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listaDesejos_adicionar` (IN `v_data` DATE, IN `v_clienteId` INT, IN `v_tintasIdentificacao` VARCHAR(10), IN `v_cor` VARCHAR(15))   INSERT INTO listadesejos (data, clienteId, tintasIdentificacao, cor) VALUES (v_data, v_clienteId, v_tintasIdentificacao, v_cor)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listaDesejos_carregarPor_clienteId` (IN `v_clienteId` INT)   SELECT * FROM listadesejos WHERE clienteId = v_clienteId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listaDesejos_remover` (IN `v_cor` VARCHAR(15))   DELETE FROM listadesejos WHERE cor = v_cor$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pedidosStatus_remover` (IN `v_dataHora` DATETIME, IN `v_gestorId` INT, IN `v_pedidosDataHora` DATETIME, IN `v_tintasIdentificacao` VARCHAR(10), IN `v_clienteId` INT)   DELETE FROM pedidostatus WHERE dataHora = v_dataHora AND gestorId = v_gestorId AND pedidosDataHora = v_pedidosDataHora AND tintasIdentificacao = v_tintasIdentificacao AND clienteId = v_clienteId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pedidoStatus_adicionar` (IN `v_dataHoraRetirada` DATETIME, IN `v_status` VARCHAR(21), IN `v_observacoes` TEXT, IN `v_gestorId` INT, IN `v_pedidosDataHora` DATETIME, IN `v_dataHora` DATETIME, IN `v_tintasIdentificacao` VARCHAR(10), IN `v_clienteId` INT)   INSERT INTO pedidostatus (dataHoraRetirada, status, observacoes, gestorId, pedidosDataHora, dataHora, tintasIdentificacao, clienteId) VALUES (v_dataHoraRetirada, v_status, v_observacoes, v_gestorId, v_pedidosDataHora, v_dataHora, v_tintasIdentificacao, v_clienteId)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pedidoStatus_atualizar` (IN `v_dataHoraRetirada` DATETIME, IN `v_status` VARCHAR(21), IN `v_observacoes` TEXT, IN `v_gestorId` INT, IN `v_pedidosDataHora` DATETIME, IN `v_dataHora` DATETIME, IN `v_tintasIdentificacao` VARCHAR(10), IN `v_clienteId` INT)   UPDATE pedidostatus SET status = v_status, observacoes = v_observacoes, dataHoraRetirada = v_dataHoraRetirada WHERE gestorId = v_gestorId AND pedidosDataHora = v_pedidosDataHora AND tintasIdentificacao = v_tintasIdentificacao AND dataHora = v_dataHora AND clienteId = v_clienteId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pedidoStatus_carregarPor_pedidosIds` (IN `v_pedidosDataHora` DATETIME, IN `v_tintasIdentificacao` VARCHAR(10), IN `v_clienteId` INT)   SELECT * FROM pedidostatus WHERE pedidosDataHora = v_pedidosDataHora AND tintasIdentificacao = v_tintasIdentificacao AND clienteId = v_clienteId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pedidos_adicionar` (IN `v_dataHora` DATETIME, IN `v_volume` FLOAT, IN `v_clienteId` INT, IN `v_tintasIdentificacao` VARCHAR(10))   INSERT INTO pedidos (dataHora, volume, clienteId, tintasIdentificacao) VALUES (v_dataHora, v_volume, v_clienteId, v_tintasIdentificacao)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pedidos_atualizar` (IN `v_dataHora` DATETIME, IN `v_volume` FLOAT, IN `v_clienteId` INT, IN `v_tintasIdentificacao` VARCHAR(10))   UPDATE pedidos SET dataHora = v_dataHora, volume = v_volume,clienteId = v_clienteId, tintasIdentificacao = v_tintasIdentificacao WHERE dataHora = v_dataHora AND clienteId = v_clienteId AND tintasIdentificacao = v_tintasIdentificacao$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pedidos_carregar` ()   SELECT * FROM pedidos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pedidos_carregarPor_clienteId` (IN `v_clienteId` INT)   SELECT * FROM pedidos WHERE clienteId = v_clienteId ORDER BY dataHora DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pedidos_carregarPor_dataHora` (IN `v_dataHora` DATETIME)   SELECT * FROM pedidos WHERE dataHora = v_dataHora$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pedidos_carregarPor_tintasIdentificacao` (IN `v_tintasIdentificacao` VARCHAR(10))   SELECT * FROM pedidos WHERE tintasIdentificacao = v_tintasIdentificacao$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pedidos_remover` (IN `v_dataHora` DATETIME, IN `v_clienteId` INT, IN `v_tintasIdentificacao` INT)   DELETE FROM pedidos WHERE dataHora = v_dataHora AND clienteId = v_clienteId AND v_tintasIdentificacao = v_tintasIdentificacao$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pessoasFisicas_adicionar` (IN `v_cpf` CHAR(11), IN `v_clienteId` INT)   INSERT INTO pessoasfisicas (cpf, clienteId) VALUES (v_cpf, v_clienteId)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pessoasFisicas_atualizar` (IN `v_cpf` CHAR(11), IN `v_clienteId` INT)   UPDATE pessoasfisicas SET cpf = v_cpf WHERE clienteId = v_clienteId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pessoasFisicas_carregarPor_clienteId` (IN `v_clienteId` INT)   SELECT * FROM pessoasfisicas WHERE clienteId = v_clienteId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pessoasFisicas_carregarPor_cpf` (IN `v_cpf` CHAR(11))   SELECT * FROM pessoasfisicas WHERE cpf = v_cpf$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pessoasFisicas_remover` (IN `v_clienteId` INT)   DELETE FROM pessoasfisicas WHERE clienteId = v_clienteId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pessoasJuridicas_adicionar` (IN `v_cnpj` CHAR(14), IN `v_clienteId` INT)   INSERT INTO pessoasjuridicas (cnpj, clienteId) VALUES (v_cnpj, v_clienteId)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pessoasJuridicas_atualizar` (IN `v_cnpj` CHAR(14), IN `v_clienteId` INT)   UPDATE pessoasjuridicas SET cnpj = v_cnpj WHERE clienteId = v_clienteId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pessoasJuridicas_carregarPor_clienteId` (IN `v_clienteId` INT)   SELECT * FROM pessoasjuridicas WHERE clienteId = v_clienteId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pessoasJuridicas_carregarPor_cnpj` (IN `v_cnpj` CHAR(14))   SELECT * FROM pessoasjuridicas WHERE cnpj = v_cnpj$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pessoasJuridicas_remover` (IN `v_clienteId` INT)   DELETE FROM pessoasjuridicas WHERE clienteId = v_clienteId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `relacao_pedidos_estoque_por_cor` (IN `v_cor` VARCHAR(15))   BEGIN 
SELECT T.cor, T.volume AS volumeEstoque, SUM(P.volume) AS volumePedidos FROM tintas T INNER JOIN pedidos P
ON T.identificacao = P.tintasIdentificacao
WHERE T.cor = v_cor;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tintas_adicionar` (IN `v_identificacao` VARCHAR(10), IN `v_dataValidade` DATE, IN `v_marca` VARCHAR(20), IN `v_imagem` VARCHAR(100), IN `v_volume` FLOAT, IN `v_cor` VARCHAR(15), IN `v_dataRecebimento` DATE)   insert into tintas (identificacao, dataValidade, marca, imagem, volume, cor, dataRecebimento) VALUES (v_identificacao, v_dataValidade, v_marca, v_imagem, v_volume, v_cor, v_dataRecebimento)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tintas_atualizar` (IN `v_identificacao` VARCHAR(10), IN `v_dataValidade` DATE, IN `v_marca` VARCHAR(20), IN `v_imagem` VARCHAR(100), IN `v_volume` FLOAT, IN `v_cor` VARCHAR(15), IN `v_dataRecebimento` DATE)   UPDATE tintas SET dataValidade = v_dataValidade, marca = v_marca, imagem = v_imagem, volume = v_volume, cor = v_cor, dataRecebimento = v_dataRecebimento WHERE identificacao = v_identificacao$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tintas_carregar` ()   SELECT * FROM tintas$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tintas_carregarPor_cor` (IN `v_cor` VARCHAR(15))   SELECT * FROM tintas WHERE cor = v_cor$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tintas_carregarPor_dataRecebimento` (IN `v_dataRecebimento` DATE)   SELECT * FROM tintas WHERE dataRecebimento = v_dataRecebimento$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tintas_carregarPor_dataValidade` (IN `v_dataValidade` DATE)   SELECT * FROM tintas WHERE dataValidade = v_dataValidade$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tintas_carregarPor_identificacao` (IN `v_identificacao` VARCHAR(10))   SELECT * FROM tintas WHERE identificacao = v_identificacao$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tintas_carregarPor_marca` (IN `v_marca` VARCHAR(20))   SELECT * FROM tintas WHERE marca = v_marca$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tintas_remover` (IN `v_identificacao` VARCHAR(10))   DELETE FROM tintas WHERE identificacao = v_identificacao$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `telefone` char(11) NOT NULL,
  `senhaHash` varchar(255) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `direcionamento` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `email`, `foto`, `telefone`, `senhaHash`, `nome`, `direcionamento`) VALUES
(31, 'nicole@gmail.com', '', '11949023006', '$2y$10$9BZU/4dydG2Qw5nTJRhg5e.YCuGTZS.PCWW0qojHvdLP0Oi2HrleO', 'Nicole Okumura Charale', 'Fatec');

-- --------------------------------------------------------

--
-- Estrutura para tabela `gestor`
--

CREATE TABLE `gestor` (
  `id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `senhaHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `gestor`
--

INSERT INTO `gestor` (`id`, `email`, `senhaHash`) VALUES
(4, 'adm@fatec.com', '$2y$10$OMefV2Gle3bSX1W.AH2XOuFOIlnx9vgWmDl4LcaOU4RwI/e0lxuCa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `listadesejos`
--

CREATE TABLE `listadesejos` (
  `data` date NOT NULL,
  `clienteId` int(11) NOT NULL,
  `tintasIdentificacao` varchar(10) NOT NULL,
  `cor` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `dataHora` datetime NOT NULL,
  `volume` float NOT NULL,
  `clienteId` int(11) NOT NULL,
  `tintasIdentificacao` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidostatus`
--

CREATE TABLE `pedidostatus` (
  `dataHora` datetime NOT NULL,
  `status` varchar(21) NOT NULL,
  `observacoes` text DEFAULT NULL,
  `gestorId` int(11) NOT NULL,
  `pedidosDataHora` datetime NOT NULL,
  `tintasIdentificacao` varchar(10) NOT NULL,
  `clienteId` int(11) NOT NULL,
  `dataHoraRetirada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoasfisicas`
--

CREATE TABLE `pessoasfisicas` (
  `cpf` char(11) NOT NULL,
  `clienteId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pessoasfisicas`
--

INSERT INTO `pessoasfisicas` (`cpf`, `clienteId`) VALUES
('50652528821', 31);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoasjuridicas`
--

CREATE TABLE `pessoasjuridicas` (
  `cnpj` char(14) NOT NULL,
  `clienteId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `quantidade_pedidos_por_status`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `quantidade_pedidos_por_status` (
`QtdPedido` bigint(21)
,`status` varchar(21)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tintas`
--

CREATE TABLE `tintas` (
  `identificacao` varchar(10) NOT NULL,
  `dataValidade` date NOT NULL,
  `marca` varchar(20) DEFAULT NULL,
  `imagem` varchar(100) NOT NULL,
  `volume` float NOT NULL,
  `cor` varchar(15) NOT NULL,
  `dataRecebimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tintas`
--

INSERT INTO `tintas` (`identificacao`, `dataValidade`, `marca`, `imagem`, `volume`, `cor`, `dataRecebimento`) VALUES
('1', '2025-04-26', 'Saci', 'img-bd/67e1efab9f5e6.webp', 50, 'Vermelho', '2025-03-24'),
('2', '2025-05-23', 'Coral', 'img-bd/67e1efc7b3447.jfif', 35, 'Laranja', '2025-03-24'),
('3', '2025-05-23', 'Saci', 'img-bd/67e1eff4c9152.jpg', 67, 'Amarelo', '2025-03-24'),
('4', '2025-03-29', 'Coral', 'img-bd/67e1f01538fe5.webp', 25.5, 'Verde', '2025-03-06'),
('5', '2025-04-19', 'Coral', 'img-bd/67e1f039d1255.webp', 56.8, 'Azul', '2025-03-07'),
('6', '2025-03-28', 'Saci', 'img-bd/67e1f05739d9b.jfif', 0, 'Roxo', '2025-03-14'),
('7', '2025-04-05', 'Coral', 'img-bd/67e1f083344ed.webp', 32.7, 'Rosa', '2025-03-05'),
('8', '2025-04-05', 'Saci', 'img-bd/67e1f0c083fc7.webp', 30, 'Vermelho', '2025-02-23'),
('9', '2025-05-30', 'Coral', 'img-bd/67e1f0e3ae63a.webp', 10.8, 'Azul', '2025-03-24');

-- --------------------------------------------------------

--
-- Estrutura para view `quantidade_pedidos_por_status`
--
DROP TABLE IF EXISTS `quantidade_pedidos_por_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `quantidade_pedidos_por_status`  AS SELECT count(`p`.`dataHora`) AS `QtdPedido`, `s`.`status` AS `status` FROM (`pedidos` `p` join `pedidostatus` `s` on(`s`.`pedidosDataHora` = `p`.`dataHora`)) GROUP BY `s`.`status` ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`,`email`);

--
-- Índices de tabela `gestor`
--
ALTER TABLE `gestor`
  ADD PRIMARY KEY (`id`,`email`);

--
-- Índices de tabela `listadesejos`
--
ALTER TABLE `listadesejos`
  ADD PRIMARY KEY (`data`,`clienteId`,`tintasIdentificacao`),
  ADD KEY `clienteId` (`clienteId`),
  ADD KEY `tintasIdentificacao` (`tintasIdentificacao`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`dataHora`,`clienteId`,`tintasIdentificacao`),
  ADD KEY `clienteId` (`clienteId`),
  ADD KEY `tintasIdentificacao` (`tintasIdentificacao`);

--
-- Índices de tabela `pedidostatus`
--
ALTER TABLE `pedidostatus`
  ADD PRIMARY KEY (`dataHora`,`gestorId`,`pedidosDataHora`,`tintasIdentificacao`,`clienteId`) USING BTREE,
  ADD KEY `pedidosDataHora` (`pedidosDataHora`),
  ADD KEY `gestorId` (`gestorId`),
  ADD KEY `tintasIdentificacao` (`tintasIdentificacao`),
  ADD KEY `clienteId` (`clienteId`);

--
-- Índices de tabela `pessoasfisicas`
--
ALTER TABLE `pessoasfisicas`
  ADD PRIMARY KEY (`cpf`,`clienteId`),
  ADD KEY `clienteId` (`clienteId`);

--
-- Índices de tabela `pessoasjuridicas`
--
ALTER TABLE `pessoasjuridicas`
  ADD PRIMARY KEY (`cnpj`,`clienteId`),
  ADD KEY `clienteId` (`clienteId`);

--
-- Índices de tabela `tintas`
--
ALTER TABLE `tintas`
  ADD PRIMARY KEY (`identificacao`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `gestor`
--
ALTER TABLE `gestor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `listadesejos`
--
ALTER TABLE `listadesejos`
  ADD CONSTRAINT `listadesejos_ibfk_1` FOREIGN KEY (`clienteId`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `listadesejos_ibfk_2` FOREIGN KEY (`tintasIdentificacao`) REFERENCES `tintas` (`identificacao`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`clienteId`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`tintasIdentificacao`) REFERENCES `tintas` (`identificacao`);

--
-- Restrições para tabelas `pedidostatus`
--
ALTER TABLE `pedidostatus`
  ADD CONSTRAINT `pedidostatus_ibfk_1` FOREIGN KEY (`pedidosDataHora`) REFERENCES `pedidos` (`dataHora`),
  ADD CONSTRAINT `pedidostatus_ibfk_2` FOREIGN KEY (`gestorId`) REFERENCES `gestor` (`id`),
  ADD CONSTRAINT `pedidostatus_ibfk_3` FOREIGN KEY (`tintasIdentificacao`) REFERENCES `pedidos` (`tintasIdentificacao`),
  ADD CONSTRAINT `pedidostatus_ibfk_4` FOREIGN KEY (`clienteId`) REFERENCES `pedidos` (`clienteId`);

--
-- Restrições para tabelas `pessoasfisicas`
--
ALTER TABLE `pessoasfisicas`
  ADD CONSTRAINT `pessoasfisicas_ibfk_1` FOREIGN KEY (`clienteId`) REFERENCES `clientes` (`id`);

--
-- Restrições para tabelas `pessoasjuridicas`
--
ALTER TABLE `pessoasjuridicas`
  ADD CONSTRAINT `pessoasjuridicas_ibfk_1` FOREIGN KEY (`clienteId`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
