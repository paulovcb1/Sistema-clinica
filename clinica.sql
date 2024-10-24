-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/10/2024 às 20:51
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clinica`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acessos`
--

CREATE TABLE `acessos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `chave` varchar(50) NOT NULL,
  `grupo` int(11) NOT NULL,
  `pagina` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `acessos`
--

INSERT INTO `acessos` (`id`, `nome`, `chave`, `grupo`, `pagina`) VALUES
(1, 'Home', 'home', 0, 'Sim'),
(2, 'Configurações', 'configuracoes', 0, 'Não'),
(3, 'Usuários', 'usuarios', 1, 'Sim'),
(4, 'Acessos', 'acessos', 2, 'Sim'),
(5, 'Grupos Acessos', 'grupo_acessos', 2, 'Sim'),
(6, 'Cargos', 'cargos', 2, 'Sim'),
(7, 'Horarios', 'horarios', 0, 'Sim'),
(8, 'Procedimentos', 'procedimentos', 2, 'Sim'),
(9, 'Convênios', 'convenios', 2, 'Sim'),
(10, 'Pacientes', 'pacientes', 1, 'Sim'),
(11, 'Funcionário', 'funcionarios', 1, 'Sim'),
(12, 'Formas de Pagamento', 'formas_pgto', 2, 'Sim'),
(13, 'Frequências', 'frequencias', 2, 'Sim'),
(14, 'Recebimentos', 'receber', 4, 'Sim'),
(15, 'Despesas', 'pagar', 4, 'Sim'),
(16, 'Comissões ', 'comissoes', 4, 'Sim'),
(17, 'Demonstrativo de lucro', 'rel_lucro', 4, 'Não'),
(18, 'Relatórios Financeiros', 'rel_financeiro', 4, 'Não'),
(19, 'Minhas comissões', 'minhas_comissoes', 0, 'Sim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(25) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `icone` varchar(50) DEFAULT NULL,
  `logo_relatorio` varchar(50) DEFAULT NULL,
  `ativo` varchar(5) DEFAULT NULL,
  `comissao` int(11) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `instancia` varchar(50) DEFAULT NULL,
  `horas_confirmacao` int(11) DEFAULT NULL,
  `marca_dagua` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `config`
--

INSERT INTO `config` (`id`, `nome`, `email`, `telefone`, `endereco`, `logo`, `icone`, `logo_relatorio`, `ativo`, `comissao`, `token`, `instancia`, `horas_confirmacao`, `marca_dagua`) VALUES
(1, 'Isos Odontologia', 'paulovcb1@gmail.com', '(61) 99984-5086', '', 'foto.png', 'icone.png', 'foto.jpg', 'Sim', 15, '0U18P-Z2N-0493S', 'RZT070824071358OWN802', 24, 'Sim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupo_acessos`
--

CREATE TABLE `grupo_acessos` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `grupo_acessos`
--

INSERT INTO `grupo_acessos` (`id`, `nome`) VALUES
(1, 'Pessoas'),
(2, 'Cadastro'),
(4, 'Financeiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(80) NOT NULL,
  `senha_crip` varchar(150) NOT NULL,
  `nivel` varchar(25) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `token` varchar(150) DEFAULT NULL,
  `atendimento` varchar(5) DEFAULT NULL,
  `pagamento` varchar(50) DEFAULT NULL,
  `comissao` int(11) DEFAULT NULL,
  `cpf` varchar(25) DEFAULT NULL,
  `intervalo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `senha_crip`, `nivel`, `ativo`, `telefone`, `endereco`, `data`, `foto`, `token`, `atendimento`, `pagamento`, `comissao`, `cpf`, `intervalo`) VALUES
(6, 'Isos', 'paulovcb1@gmail.com', '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Administrador', 'Sim', '(61) 99984-5086', 'Rua 4 Chácara 7, 00', '2024-07-30', 'sem-foto.jpg', '6d98a0772ad04a0e06797d2826d8c02f4a8b5117eba47eb39c27d255798d365c', 'Sim', 'pix cpf: 2394872398', 50, '049.071.951-17', 15),
(14, 'marcela', 'marcela@gmail.com', '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Dentista', 'Sim', '(12) 31231-2312', 'Rua 4 Chácara 7, 00', '2024-08-02', 'sem-foto.jpg', NULL, 'Sim', '049071961773', 0, '123.231.213-21', 0),
(47, 'ana clara', 'anaclara@anaclara.com', '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Atendente', 'Sim', '(00) 00000-0000', 'Rua 4 Chácara 7, 00', '2024-08-09', 'sem-foto.jpg', '', 'Não', 'pix cpf: 2394872398', 15, '232.424.234-23', 60);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_permissoes`
--

CREATE TABLE `usuarios_permissoes` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `permissao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios_permissoes`
--

INSERT INTO `usuarios_permissoes` (`id`, `usuario`, `permissao`) VALUES
(235, 3, 3),
(236, 3, 1),
(239, 3, 2),
(241, 5, 3),
(253, 5, 2),
(256, 7, 1),
(257, 7, 2),
(261, 8, 3),
(262, 8, 2),
(263, 8, 1),
(264, 13, 1),
(266, 13, 3),
(267, 13, 10),
(268, 13, 7),
(275, 33, 1),
(276, 33, 11),
(277, 33, 3),
(278, 33, 7),
(279, 47, 1),
(280, 47, 2),
(281, 47, 3),
(282, 47, 4),
(283, 47, 5),
(284, 47, 6),
(285, 47, 7),
(286, 47, 8),
(287, 47, 9),
(288, 47, 10),
(289, 47, 11),
(290, 47, 12),
(291, 47, 13),
(306, 14, 3),
(307, 14, 10),
(308, 14, 11),
(309, 14, 8),
(310, 14, 4),
(311, 14, 9);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `acessos`
--
ALTER TABLE `acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `grupo_acessos`
--
ALTER TABLE `grupo_acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios_permissoes`
--
ALTER TABLE `usuarios_permissoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acessos`
--
ALTER TABLE `acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `grupo_acessos`
--
ALTER TABLE `grupo_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `usuarios_permissoes`
--
ALTER TABLE `usuarios_permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
