-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/10/2024 às 22:33
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
-- Estrutura para tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `id` int(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `arquivo` varchar(100) NOT NULL,
  `data_cad` date NOT NULL,
  `registro` varchar(50) NOT NULL,
  `id_reg` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `arquivos`
--

INSERT INTO `arquivos` (`id`, `nome`, `descricao`, `arquivo`, `data_cad`, `registro`, `id_reg`, `usuario`) VALUES
(11, 'asda', NULL, '14-08-2024-18-16-28-Paulo-Barbosa.pdf', '2024-08-14', 'convenio', 5, 6),
(12, 'asd', NULL, '14-08-2024-18-20-10-certificado.pdf', '2024-08-14', 'Conta à Receber', 17, 6),
(14, 'asd', NULL, '14-08-2024-18-22-42-certificado.pdf', '2024-08-14', 'Conta à Receber', 18, 6),
(15, 'asd', NULL, '14-08-2024-18-22-42-certificado.pdf', '2024-08-14', 'convenio', 5, 6),
(16, 'comprovante', NULL, '22-08-2024-20-07-34-0CA90E95-D604-403D-846E-1CF45517FFE3.jpg', '2024-08-22', 'Conta à Receber', 22, 6),
(17, 'comprovante', NULL, '22-08-2024-20-07-34-0CA90E95-D604-403D-846E-1CF45517FFE3.jpg', '2024-08-22', 'Cliente', 1, 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `cargos`
--

INSERT INTO `cargos` (`id`, `nome`) VALUES
(1, 'Administrador'),
(2, 'Gerente'),
(3, 'Dentista'),
(6, 'Atendente');

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
-- Estrutura para tabela `convenios`
--

CREATE TABLE `convenios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `comissao` int(11) DEFAULT NULL,
  `telefone` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `convenios`
--

INSERT INTO `convenios` (`id`, `nome`, `comissao`, `telefone`) VALUES
(3, 'Unimed', 25, ''),
(5, 'Bradesco', 15, '(00) 00000-0000');

-- --------------------------------------------------------

--
-- Estrutura para tabela `dias`
--

CREATE TABLE `dias` (
  `id` int(11) NOT NULL,
  `dia` varchar(25) NOT NULL,
  `funcionario` int(11) NOT NULL,
  `inicio` time NOT NULL,
  `final` time NOT NULL,
  `inicio_almoco` time DEFAULT NULL,
  `final_almoco` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `dias`
--

INSERT INTO `dias` (`id`, `dia`, `funcionario`, `inicio`, `final`, `inicio_almoco`, `final_almoco`) VALUES
(6, 'Quarta-Feira', 6, '12:00:00', '12:00:00', '00:00:00', '00:00:00'),
(13, 'Terça-Feira', 6, '08:00:00', '18:00:00', '00:00:00', '00:00:00'),
(14, 'Quarta-Feira', 6, '08:00:00', '18:00:00', '00:00:00', '00:00:00'),
(15, 'Quinta-Feira', 6, '08:00:00', '18:00:00', '00:00:00', '00:00:00'),
(16, 'Sexta-Feira', 6, '08:00:00', '18:00:00', '00:00:00', '00:00:00'),
(17, 'Sábado', 6, '08:00:00', '18:00:00', '00:00:00', '00:00:00'),
(18, 'Segunda-Feira', 14, '08:00:00', '18:00:00', '00:00:00', '00:00:00'),
(19, 'Terça-Feira', 14, '08:00:00', '18:00:00', '00:00:00', '00:00:00'),
(20, 'Quarta-Feira', 14, '08:00:00', '18:00:00', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `formas_pgto`
--

CREATE TABLE `formas_pgto` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `formas_pgto`
--

INSERT INTO `formas_pgto` (`id`, `nome`) VALUES
(1, 'pix'),
(2, 'Cartao de credito'),
(3, 'cartao de debito'),
(4, 'dinheiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `frequencias`
--

CREATE TABLE `frequencias` (
  `id` int(11) NOT NULL,
  `frequencia` varchar(25) NOT NULL,
  `dias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `frequencias`
--

INSERT INTO `frequencias` (`id`, `frequencia`, `dias`) VALUES
(2, 'Diaria', 1),
(3, 'Semanal ', 7),
(4, 'Mensal ', 30),
(5, 'Bimestral ', 60),
(6, 'Trimestral ', 90),
(7, 'Anual ', 365);

-- --------------------------------------------------------

--
-- Estrutura para tabela `func_proc`
--

CREATE TABLE `func_proc` (
  `id` int(11) NOT NULL,
  `funcionario` int(11) NOT NULL,
  `procedimento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `func_proc`
--

INSERT INTO `func_proc` (`id`, `funcionario`, `procedimento`) VALUES
(3, 13, 2),
(4, 13, 3),
(5, 13, 4),
(6, 13, 1),
(7, 14, 2),
(8, 14, 3),
(9, 14, 4),
(10, 14, 5);

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
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(25) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `data_nasc` date NOT NULL,
  `data_cad` date NOT NULL,
  `cpf` varchar(25) DEFAULT NULL,
  `convenio` int(25) DEFAULT NULL,
  `profissao` varchar(25) NOT NULL,
  `obs` varchar(2000) DEFAULT NULL,
  `sexo` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `nome`, `telefone`, `endereco`, `data_nasc`, `data_cad`, `cpf`, `convenio`, `profissao`, `obs`, `sexo`) VALUES
(1, 'paulo barbosa', '(61) 99984-5086', 'Rua 4 Chácara 7, 00', '2005-10-19', '2024-07-31', '141.241.241-24', 3, 'dentista', 'fumante', 'Masculino'),
(3, 'usuario', '(12) 31231-2313', 'Rua 4 Chácara 7, 00', '2005-10-19', '2024-08-02', '345.345.453-3', 3, 'dentista', '', 'Feminino'),
(4, 'joao da silve', '(12) 31231-2313', '', '2024-08-20', '2024-08-20', '123.456.677-88', 0, '', '', 'Masculino'),
(5, 'cleber', '(51) 51515-1515', '', '2005-10-19', '2024-10-08', '049.071.951-17', 5, '', '', ''),
(6, 'Joao da silva ', '(25) 32532-5235', '', '0000-00-00', '2024-10-08', '235.252.352-35', 5, '', '', ''),
(7, 'paulo barbosa', '(32) 32423-4234', '', '2024-10-08', '2024-10-08', '345.345.453-3', 5, '', '', 'Feminino'),
(8, 'usuario', '(23) 42342-4234', '', '2024-10-08', '2024-10-08', '123.456.677-88', 0, '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagar`
--

CREATE TABLE `pagar` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `funcionario` int(11) DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data_lanc` date NOT NULL,
  `data_venc` date NOT NULL,
  `data_pgto` date DEFAULT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `usuario_pgto` int(11) DEFAULT NULL,
  `frequencia` int(11) NOT NULL,
  `saida` varchar(50) DEFAULT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `pago` varchar(5) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `referencia` varchar(40) DEFAULT NULL,
  `id_ref` int(11) DEFAULT NULL,
  `desconto` decimal(8,2) DEFAULT NULL,
  `troco` decimal(8,2) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `cancelada` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `pagar`
--

INSERT INTO `pagar` (`id`, `descricao`, `funcionario`, `valor`, `data_lanc`, `data_venc`, `data_pgto`, `usuario_lanc`, `usuario_pgto`, `frequencia`, `saida`, `arquivo`, `pago`, `obs`, `referencia`, `id_ref`, `desconto`, `troco`, `hora`, `cancelada`) VALUES
(4, 'salario ana', 47, 2500.00, '2024-08-15', '2024-08-15', '2024-08-20', 6, 6, 0, 'pix', 'sem-foto.png', 'Sim', '', 'Comissão', NULL, NULL, NULL, NULL, NULL),
(5, 'salario marcela ', 14, 1000.00, '2024-08-15', '2024-08-16', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Comissão', NULL, NULL, NULL, NULL, NULL),
(6, 'Comissaoão', 14, 250.00, '2024-08-15', '2024-08-15', '2024-08-15', 6, 6, 0, 'pix', 'sem-foto.png', 'Sim', '', 'Comissão', NULL, NULL, NULL, NULL, NULL),
(7, 'Comissao', 14, 250.00, '2024-08-20', '2024-08-20', '2024-08-20', 6, 6, 0, 'pix', 'sem-foto.png', 'Sim', '', 'Conta', NULL, NULL, NULL, NULL, NULL),
(8, 'Comissaoão', 14, 180.00, '2024-08-20', '2024-08-20', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Conta', NULL, NULL, NULL, NULL, NULL),
(9, 'comissao', 47, 300.00, '2024-08-20', '2024-08-22', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Conta', NULL, NULL, NULL, NULL, NULL),
(11, 'marcela', 14, 1000.00, '2024-08-20', '2024-08-20', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Pagamento', NULL, NULL, NULL, NULL, NULL),
(12, 'comissao ', 14, 2000.00, '2024-08-22', '2024-08-22', '2024-08-22', 6, 6, 0, 'pix', 'sem-foto.png', 'Sim', '', 'Pagamento', NULL, NULL, NULL, NULL, NULL),
(13, 'COMISSAO', 14, 1000.00, '2024-08-22', '2024-08-22', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Pagamento', NULL, NULL, NULL, NULL, NULL),
(14, 'Teste', 0, 250.00, '2024-10-08', '2024-10-08', '2024-10-08', 6, 6, 0, 'pix', 'sem-foto.png', 'Sim', '', 'Conta', NULL, NULL, NULL, NULL, NULL),
(15, 'alguelk', 0, 255.00, '2024-10-08', '2024-10-07', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Conta', NULL, NULL, NULL, NULL, NULL),
(16, 'Teste', 0, 180.00, '2024-10-08', '2024-10-08', '2024-10-08', 6, 6, 0, 'pix', 'sem-foto.png', 'Sim', '', 'Conta', NULL, NULL, NULL, NULL, NULL),
(17, 'aluguel', 0, 14234.00, '2024-10-08', '2024-10-08', '2024-10-08', 6, 6, 0, 'pix', 'sem-foto.png', 'Sim', '', 'Conta', NULL, NULL, NULL, NULL, NULL),
(18, 'Comissaoão', 47, 23.00, '2024-10-08', '2024-10-08', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Pagamento', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `procedimentos`
--

CREATE TABLE `procedimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `tempo` int(11) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `convenio` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `procedimentos`
--

INSERT INTO `procedimentos` (`id`, `nome`, `valor`, `tempo`, `ativo`, `convenio`) VALUES
(1, 'Limpeza', 40.00, 15, 'Sim', 'Sim'),
(2, 'Clinico Geral', 180.00, 30, 'Sim', 'Não'),
(3, 'Canal', 250.00, 60, 'Sim', 'Sim'),
(4, 'Sisu', 349.99, 15, 'Sim', 'Sim'),
(5, 'gegivectomia', 1999.00, 120, 'Sim', 'Não');

-- --------------------------------------------------------

--
-- Estrutura para tabela `receber`
--

CREATE TABLE `receber` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `cliente` int(11) DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data_lanc` date NOT NULL,
  `data_venc` date NOT NULL,
  `data_pgto` date DEFAULT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `usuario_pgto` int(11) DEFAULT NULL,
  `frequencia` int(11) NOT NULL,
  `saida` varchar(50) DEFAULT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `pago` varchar(5) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `referencia` varchar(40) DEFAULT NULL,
  `id_ref` int(11) DEFAULT NULL,
  `desconto` decimal(8,2) DEFAULT NULL,
  `troco` decimal(8,2) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `cancelada` varchar(5) DEFAULT NULL,
  `convenio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `receber`
--

INSERT INTO `receber` (`id`, `descricao`, `cliente`, `valor`, `data_lanc`, `data_venc`, `data_pgto`, `usuario_lanc`, `usuario_pgto`, `frequencia`, `saida`, `arquivo`, `pago`, `obs`, `referencia`, `id_ref`, `desconto`, `troco`, `hora`, `cancelada`, `convenio`) VALUES
(1, 'Teste', 0, 230.00, '2024-08-09', '2024-08-09', '2024-08-09', 6, 6, 0, 'pix', 'sem-foto.png', 'Sim', '', 'Conta', NULL, NULL, NULL, NULL, NULL, 5),
(2, 'teste 2', 0, 250.00, '2024-08-09', '2024-08-09', '2024-08-09', 6, 6, 0, 'pix', 'sem-foto.png', 'Sim', '', 'Conta', NULL, NULL, NULL, NULL, NULL, 0),
(3, 'Faceta', 1, 2500.00, '2024-08-09', '2024-08-09', '2024-08-09', 6, 6, 0, 'pix', '09-08-2024-18-16-21-Paulo-Barbosa.pdf', 'Sim', '', 'Conta', NULL, NULL, NULL, NULL, NULL, 0),
(8, 'Bradesco', 0, 2500.00, '2024-08-12', '2024-08-12', '2024-08-12', 6, 6, 0, 'pix', 'sem-foto.png', 'Sim', '', 'Conta', NULL, NULL, NULL, NULL, NULL, 0),
(11, 'Unimed', 0, 245.00, '2024-08-12', '2024-08-12', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Conta', NULL, NULL, NULL, NULL, NULL, 3),
(13, 'paulo barbosa - Parcela 1', 1, 12.00, '2024-08-12', '2024-08-12', NULL, 6, NULL, 0, 'pix', '12-08-2024-21-00-55-certificado.pdf', 'Não', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'paulo barbosa - Parcela 2', 1, 12.00, '2024-08-12', '2024-09-12', NULL, 6, NULL, 0, 'pix', '12-08-2024-21-00-55-certificado.pdf', 'Não', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Limpeza', 1, 180.00, '2024-08-14', '2024-08-14', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Conta', NULL, NULL, NULL, NULL, NULL, 0),
(17, 'Teste', 1, 40.00, '2024-08-14', '2024-08-14', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Conta', NULL, NULL, NULL, NULL, NULL, 0),
(18, 'Faceta', 0, 40.00, '2024-08-14', '2024-08-14', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Conta', NULL, NULL, NULL, NULL, NULL, 5),
(19, 'Teste', 4, 250.00, '2024-08-20', '2024-08-20', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Conta', NULL, NULL, NULL, NULL, NULL, 0),
(20, 'joao da silve', 4, 180.00, '2024-08-20', '2024-08-20', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Conta', NULL, NULL, NULL, NULL, NULL, 0),
(21, 'Unimed', 0, 1922.34, '2024-08-20', '2024-08-20', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Conta', NULL, NULL, NULL, NULL, NULL, 3),
(22, 'Limpeza', 1, 250.00, '2024-08-22', '2024-08-22', '2024-08-22', 6, 6, 0, 'pix', '22-08-2024-20-06-41-7c755f64-4d61-44e2-9f9d-db992452c0b6.jpg', 'Sim', 'conta recebida do pagamento referente a limpeza do paciente tal', 'Conta', NULL, NULL, NULL, NULL, NULL, 0),
(23, 'salario', 0, 250.00, '2024-10-08', '2024-10-08', '0000-00-00', 6, 0, 0, 'pix', 'sem-foto.png', 'Não', '', 'Conta', NULL, NULL, NULL, NULL, NULL, 0);

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
(47, 'ana clara', 'anaclara@anaclara.com', '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Atendente', 'Sim', '(00) 00000-0000', 'Rua 4 Chácara 7, 00', '2024-08-09', 'sem-foto.jpg', '', 'Não', 'pix cpf: 2394872398', 15, '232.424.234-23', 60),
(48, 'Paulo Victor de Campos Barbosa', 'spetaovitao@gmail.com', '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Administrador', 'Sim', '(61) 99845-0867', '', '2024-10-24', 'sem-foto.jpg', NULL, 'Não', '', 0, NULL, 0);

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
-- Índices de tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `convenios`
--
ALTER TABLE `convenios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `formas_pgto`
--
ALTER TABLE `formas_pgto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `frequencias`
--
ALTER TABLE `frequencias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `func_proc`
--
ALTER TABLE `func_proc`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `grupo_acessos`
--
ALTER TABLE `grupo_acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pagar`
--
ALTER TABLE `pagar`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `procedimentos`
--
ALTER TABLE `procedimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `receber`
--
ALTER TABLE `receber`
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
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `convenios`
--
ALTER TABLE `convenios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `dias`
--
ALTER TABLE `dias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `formas_pgto`
--
ALTER TABLE `formas_pgto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `frequencias`
--
ALTER TABLE `frequencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `func_proc`
--
ALTER TABLE `func_proc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `grupo_acessos`
--
ALTER TABLE `grupo_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `pagar`
--
ALTER TABLE `pagar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `procedimentos`
--
ALTER TABLE `procedimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `receber`
--
ALTER TABLE `receber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `usuarios_permissoes`
--
ALTER TABLE `usuarios_permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;