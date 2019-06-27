-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Jun-2019 às 00:34
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

--
-- Extraindo dados da tabela `comentarios_lab`
--

INSERT INTO `comentarios_lab` (`id`, `id_evento`, `id_user`, `comentario`, `hora`) VALUES
(1, 5, 11, 'Ar condicionado sÃ³ esquenta', '2018-10-19 10:40:55');

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

--
-- Extraindo dados da tabela `comentarios_maq`
--

INSERT INTO `comentarios_maq` (`id`, `id_evento`, `id_user`, `comentario`, `hora`) VALUES
(1, 22, 11, 'teste', '2018-10-17 10:33:50'),
(2, 24, 14, '', '2018-10-23 14:25:51'),
(3, 24, 11, '', '2018-10-24 07:03:27'),
(4, 25, 11, '', '2018-10-25 15:03:56'),
(5, 25, 11, '', '2018-10-26 10:48:31'),
(7, 25, 11, '', '2018-10-29 14:11:21');

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

--
-- Extraindo dados da tabela `descricao`
--

INSERT INTO `descricao` (`id`, `nome`, `descricao`) VALUES
(3, 'Optiplex 7010', 'Computador Desktop DELL modelo Optiplex 7010, com Monitor DELL 23pol.'),
(4, 'Estabilizador Enermax', 'Estabilizador Enermax 500W'),
(5, 'Teste', 'Teste de bugs'),
(6, 'OptiPlex 790', 'Core i3 RAM 8Gb.');

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

--
-- Extraindo dados da tabela `evt_lab`
--

INSERT INTO `evt_lab` (`id`, `lab`, `nome`, `hora`, `status`) VALUES
(4, 18, 'Imagens', '2018-09-28 09:02:40', 'Resolvido'),
(5, 5, 'Ar Condicionado', '2018-10-09 13:51:11', 'Em andamento');

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

--
-- Extraindo dados da tabela `historico`
--

INSERT INTO `historico` (`id`, `nome`, `maq`, `hora`, `situacao`) VALUES
(15, 'Sem dominio', 69, '2018-09-26 10:40:23', 'Resolvido'),
(16, 'Não sei tem que ver', 84, '2018-09-26 10:40:47', 'Resolvido'),
(17, 'NÃ£o liga', 103, '2018-10-01 16:55:52', 'Em andamento'),
(18, 'Em manutenÃ§Ã£o externa', 79, '2018-10-01 17:18:27', 'Em andamento'),
(19, 'Fora do domÃ­nio.', 184, '2018-10-02 19:30:01', 'Resolvido'),
(20, 'Reinstalar Xampp', 144, '2018-10-04 15:32:00', 'Resolvido'),
(21, 'Pilha da Bios', 140, '2018-10-09 13:50:43', 'Resolvido'),
(22, 'Trocar Pilha', 162, '2018-10-11 08:26:59', 'Resolvido'),
(23, 'Teste', 70, '2018-10-16 13:52:24', 'Resolvido'),
(24, 'Trocar pilha', 147, '2018-10-23 14:25:51', 'Resolvido'),
(25, 'Fora do dominio', 41, '2018-10-25 15:03:56', 'Resolvido');

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

--
-- Extraindo dados da tabela `laboratorios`
--

INSERT INTO `laboratorios` (`id`, `nome`, `n_maquinas`, `problemas`) VALUES
(2, 'Lab2', 36, 0),
(3, 'Lab3', 35, 0),
(4, 'Lab4', 36, 0),
(5, 'Lab5', 37, 0),
(8, 'Lab6', 0, 0),
(9, 'LabGeo', 34, 0),
(10, 'LabRobotica', 1, 0),
(18, 'LabRedes', 15, 0),
(19, 'LabEstudos', 10, 0),
(20, 'Oficina', 0, 0),
(22, 'Outro', 0, 0);

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
-- Extraindo dados da tabela `maquinas`
--

INSERT INTO `maquinas` (`id`, `lab`, `nome`, `patrimonio`, `n_serie`, `w_serial`, `situacao`, `maq`) VALUES
(15, 19, 'maq01-pc', 'indefinido', '', 'Sem Serial', 'Funcionando', '00:23:54:9f:9a:1d'),
(16, 19, 'maq02-pc', 'indefinido', '', 'Sem Serial', 'Funcionando', '00:23:54:9f:9a:33'),
(17, 19, 'maq03-pc', 'indefinido', '', 'Sem Serial', 'Funcionando', '00:23:54:9f:9a:27'),
(18, 19, 'maq04-pc', 'indefinido', '', 'Sem Serial', 'Funcionando', 'c8:60:00:c0:a1:92'),
(19, 19, 'maq05-pc', 'indefinido', '', 'Sem Serial', 'Funcionando', '00:23:54:9f:98:80'),
(21, 19, 'maq06-pc', 'indefinido', '', 'Sem Serial', 'Funcionando', '00:23:54:9f:9a:13'),
(22, 19, 'maq07-pc', 'indefinido', '', 'Sem Serial', 'Funcionando', '00:23:54:9f:9b:a0'),
(23, 19, 'maq08-pc', 'indefinido', '', 'Sem Serial', 'Funcionando', '00:1e:8c:14:95:50'),
(24, 19, 'maq09-pc', 'indefinido', '', 'Sem Serial', 'Funcionando', '00:53:44:e6:0e:d9'),
(25, 19, 'maq10-pc', 'indefinido', '', 'Sem Serial', 'Funcionando', '00:23:54:9f:9c:67 '),
(26, 4, 'maq01-pc', '', '', 'ymhg3-8dtr2-mkcmh-r4tt7-9kgr7', 'Funcionando', 'f0:4d:a2:e6:1f:20'),
(27, 4, 'maq02-pc', '', '', 'gg7tg-kq4kt-krkbx-6hcgy-pyy7c', 'Funcionando', 'f0:4d:a2:e5:a5:03	'),
(28, 4, 'maq03-pc', '', '', '6pqtk-fr2tf-tghv4-2k9rt-kfwg6', 'Funcionando', 'f0:4d:a2:e5:a4:b1	'),
(29, 4, 'maq04-pc', '', '', '37wjf-w6hyv-v2yc8-qf44j-c6wc4', 'Funcionando', 'f0:4d:a2:e5:a5:1b'),
(31, 4, 'maq05-pc', '', '', 'p4h97-b9kc9-j2vvh-ct6r4-pyv2y', 'Funcionando', 'f0:4d:a2:e5:a5:1b'),
(32, 4, 'maq06-pc', '', '', 'hy9vr-t6fby-4b8j7-tbhrx-yc6qm', 'Funcionando', 'f0:4d:a2:e5:a4:b0'),
(33, 4, 'maq07-pc', '', '', '3wxpb-9cwy6-mf3mr-x2xfw-7ywyp', 'Funcionando', 'f0:4d:a2:e6:1d:92'),
(34, 4, 'maq08-pc', '', '', '3wxpb-9cwy6-mf3mr-x2xfw-7ywyp', 'Funcionando', 'f0:4d:a2:e5:a5:06'),
(35, 4, 'maq09-pc', '', '', 'bb39q-d9f98-4prgj-h33vk-yt3kh', 'Funcionando', 'f0:4d:a2:e6:1f:2b'),
(36, 4, 'maq10-pc', '', '', '6vq6m-bwtrr-74g3w-2t7bb-t27pq', 'Funcionando', 'f0:4d:a2:e6:1f:3f'),
(37, 4, 'maq11-pc', '', '', 'gdd64-cjyjx-q93tf-pd46q-rcwrx', 'Funcionando', 'f0:4d:a2:e5:a5:19'),
(38, 4, 'maq12-pc', '', '', 'gd99k-ktx8x-dryrg-gt2m7-dy9p2', 'Funcionando', 'f0:4d:a2:e6:1e:6e'),
(39, 4, 'maq13-pc', '', '', 'HPKPD-BQDBJ-RRHRT-PBWPT-BT6PD', 'Funcionando', 'f0:4d:a2:e6:1e:c5'),
(40, 4, 'maq14-pc', '', '', '6hq99-f4j88-hbx3c-tvqdq-3vwyw', 'Funcionando', 'f0:4d:a2:e5:a4:78'),
(41, 4, 'maqprof-pc', '', '', 'v8f9b-68qc9-xjjtp-6cgyd-4rbwd', 'Funcionando', 'f0:4d:a2:e5:a5:22'),
(42, 4, 'maq15-pc', '', '', 'x94k2-yvrkc-37k78-2pdh8-fvpwv', 'Funcionando', 'f0:4d:a2:e5:a4:8a'),
(43, 4, 'maq16-pc', '', '', 'yrw6f-y3jcd-pkqk7-grhq8-vdg9m', 'Funcionando', 'f0:4d:a2:e6:1f:30'),
(44, 4, 'maq17-pc', '', '', '', 'Funcionando', 'f0:4d:a2:e6:1e:1a'),
(45, 4, 'maq18-pc', '', '', 'px74c-36rkq-rjy2q-pvx2p-fc8j4', 'Funcionando', 'f0:4d:a2:e5:a4:a5'),
(46, 4, 'maq19-pc', '', '', 'wyvjt-4fr37-p3kfq-cgwfg-64yqx', 'Funcionando', 'f0:4d:a2:e6:1f:1f'),
(47, 4, 'maq20-pc', '', '', '89v88-7tjxh-ptwqy-8p28r-rt834', 'Funcionando', 'f0:4d:a2:e6:1f:2d'),
(48, 4, 'maq21-pc', '', '', 'cxchd-g8f8d-rxhqq-kdqbw-99tkr', 'Funcionando', 'f0:4d:a2:e6:1e:70'),
(49, 4, 'maq22-pc', '', '', '4fk67-trj6y-rf6vj-v3ycd-3h2q4', 'Funcionando', 'f0:4d:a2:e6:1f:42'),
(50, 4, 'maq23-pc', '', '', 'ydvk4-bgcjk-6y8mb-8cmrr-jmbkg', 'Funcionando', 'f0:4d:a2:e5:a5:25'),
(51, 4, 'maq24-pc', '', '', 'px67r-grqp4-h3tfg-hmr8k-8hxyx', 'Funcionando', 'f0:4d:a2:e5:a4:ae'),
(52, 4, 'maq25-pc', '', '', 'xh699-gy23d-vt4dm-qxj26-trw9g', 'Funcionando', 'f0:4d:a2:e5:a5:1f'),
(53, 4, 'maq26-pc', '', '', 'vpwxm-kgg39-pyqcc-dy7cg-7r7j3', 'Funcionando', 'f0:4d:a2:e5:a4:b4'),
(54, 4, 'maq27-pc', '', '', 'kch44-m6khh-299mq-h424v-tcd9g', 'Funcionando', 'f0:4d:a2:e6:1e:bd'),
(55, 4, 'maq28-pc', '', '', 'fb3d4-tyry2-v8cx6-7vt9f-8kjdc', 'Funcionando', 'f0:4d:a2:e6:1f:33'),
(56, 4, 'maq29-pc', '', '', 'pwbkt-vtt9j-fq832-8r9p9-9t9h9', 'Funcionando', 'f0:4d:a2:e6:1e:bf'),
(57, 4, 'maq30-pc', '', '', '6cr9m-bjwg6-2qk4j-q9pcm-x9bgc', 'Funcionando', 'f0:4d:a2:e6:1e:d2'),
(58, 4, 'maq31-pc', '', '', 'd3j7h-k7y6d-rbbtv-9ymyk-3jvmb', 'Funcionando', 'f0:4d:a2:e5:a5:15'),
(59, 4, 'maq32-pc', '', '', '2t3gk-qxptf-hv4yf-qv849-966yj', 'Funcionando', 'f0:4d:a2:e5:a4:b2'),
(60, 4, 'maq33-pc', '', '', 'q4j7r-rtqw9-jxcx3-mrbrf-q7j2t', 'Funcionando', '00:53:44:e6:0d:25'),
(61, 4, 'maq34-pc', '', '', 'jx44v-c97bb-r4jwh-hkghr-m3b83', 'Funcionando', 'f0:4d:a2:e6:1f:1d'),
(62, 4, 'maq35-pc', '', '', 'fgq2r-cy999-xqtg2-774xj-3gxjj', 'Funcionando', 'f0:4d:a2:e5:a4:c0'),
(63, 2, 'maqprof-pc', '', '', 'FJW2D-CK3M7-JXH8D-P34TK-27JPF', 'Funcionando', 'b4:b5:2f:50:c0:e7'),
(64, 2, 'maq01-pc', '', '', 'BKHMV-4JHVQ-3BY6J-MVFW4-989T4', 'Funcionando', 'b4:b5:2f:50:bd:df'),
(65, 2, 'maq02-pc', '', '', 'KFFGY-DFBT7-G37Q6-K83FG-T4WQB', 'Funcionando', 'b4:b5:2f:50:b5:a0'),
(66, 2, 'maq03-pc', '', '', 'PWQRX-94DH2-2KWY7-4JP87-WDPDX', 'Funcionando', 'b4:b5:2f:50:b4:6e'),
(67, 2, 'maq04-pc', '', '', '6G2MJ-VWJCD-QVWBY-JD323-D2PQP', 'Funcionando', 'b4:b5:2f:50:b5:91'),
(68, 2, 'maq05-pc', '', '', 'TFC7V-4H67B-8GKR6-MX94F-MH9BC', 'Funcionando', 'b4:b5:2f:50:b4:fa'),
(69, 2, 'maq06-pc', '', '', '4BFQ4-78KMR-H2C28-VM9BW-PPBCH', 'Funcionando', 'b4:b5:2f:50:c1:69'),
(70, 2, 'maq07-pc', '', '', 'P8BMX-7BGPW-Q9M2G-K646J-8FQ8Y', 'Funcionando', 'b4:b5:2f:50:b1:49'),
(71, 2, 'maq08-pc', '', '', 'P6CDY-QFKWH-FT3G9-V2T3H-MCR3D', 'Funcionando', 'b4:b5:2f:50:7e:81'),
(72, 2, 'maq09-pc', '', '', 'YFRC2-828W7-WVWRW-YQ3Q9-VYQWV', 'Funcionando', 'b4:b5:2f:50:c1:03'),
(73, 2, 'maq10-pc', '', '', '22VH8-R662M-QGK48-BT2J3-893RM', 'Funcionando', 'b4:b5:2f:50:c0:e1'),
(74, 2, 'maq11-pc', '', '', '742M2-4MMPV-GDJ32-DD622-YHK78', 'Funcionando', 'b4:b5:2f:50:7e:b1'),
(75, 2, 'maq12-pc', '', '', 'HVCJY-4TJ6R-JMR93-CJ6GQ-7JQMM', 'Funcionando', '64:31:50:48:fc:eb'),
(76, 2, 'maq13-pc', '', '', '7V283-FM6BC-WHTQQ-JXYRH-XK22K', 'Funcionando', 'b4:b5:2f:50:7f:7f'),
(77, 2, 'maq14-pc', '', '', 'VR3QQ-FH24T-KQF3M-V7JGT-CKGB4', 'Funcionando', 'b4:b5:2f:50:c0:e9'),
(78, 2, 'maq15-pc', '', '', 'D37VH-PJBGD-YPYWJ-VB7GD-26CK9', 'Funcionando', 'b4:b5:2f:50:7f:d8'),
(79, 2, 'maq16-pc', '', '', '', 'Problema!', ''),
(80, 2, 'maq17-pc', '', '', 'X867R-RJPV2-4BFBF-7T7M2-3XT84', 'Funcionando', 'b4:b5:2f:50:b4:aa'),
(81, 2, 'maq18-pc', '', '', '6JXC3-KYX6R-JCT4K-RHKTM-3CCRR', 'Funcionando', 'b4:b5:2f:50:c0:d9'),
(82, 2, 'maq19-pc', '', '', '4HD73-66XJK-Q6H99-T7P82-X87FJ', 'Funcionando', 'b4:b5:2f:50:c1:97'),
(83, 2, 'maq20-pc', '', '', '4HD73-66XJK-Q6H99-T7P82-X87FJ', 'Funcionando', '78:ac:c0:aa:2d:50'),
(84, 2, 'maq21-pc', '', '', 'GH6WX-46XH4-Y4KGF-G9T92-GCK26', 'Funcionando', '78:ac:c0:aa:2d:50	'),
(85, 2, 'maq22-pc', '', '', 'YGBYB-BGP7H-9XTCV-JFJXX-VRR4D', 'Funcionando', 'b4:b5:2f:50:c1:4e'),
(86, 2, 'maq23-pc', '', '', 'V728Y-3DBF6-7VP82-436TW-TPKVH', 'Funcionando', 'b4:b5:2f:50:b1:2e'),
(87, 2, 'maq24-pc', '', '', 'W8WM3-JCX29-RVDJY-GQ9G4-QYDHG', 'Funcionando', 'b4:b5:2f:50:b5:24'),
(88, 2, 'maq25-pc', '', '', '2KYP4-69JK4-TQYHW-BRW48-JV36C', 'Funcionando', 'b4:b5:2f:50:bd:cf'),
(89, 2, 'maq26-pc', '', '', 'CP9W4-GQ7BG-4X323-XBRW2-YV2X4', 'Funcionando', 'b4:b5:2f:50:b1:7b'),
(90, 2, 'maq27-pc', '', '', 'FJKMQ-3Y4W4-FBCYJ-FYJCG-GHPGK', 'Funcionando', 'b4:b5:2f:50:c2:3e'),
(91, 2, 'maq28-pc', '', '', 'YGBYB-BGP7H-9XTCV-JFJXX-VRR4D', 'Funcionando', 'b4:b5:2f:50:c1:77	'),
(92, 2, 'maq29-pc', '', '', 'C3KJW-RH99K-TJHHF-T7QJY-KCDMX', 'Funcionando', 'b4:b5:2f:50:79:24'),
(93, 2, 'maq30-pc', '', '', 'XBQVP-H29KQ-6MC46-894GB-CXJ7M', 'Funcionando', 'b4:b5:2f:50:c1:66'),
(94, 2, 'maq31-pc', '', '', 'BFF6T-J8Y6K-VYJ4R-Q8QX9-TK6MY', 'Funcionando', 'b4:b5:2f:50:b5:1f'),
(95, 2, 'maq32-pc', '', '', 'V44Y6-YWCTD-W6GVH-DMMHQ-GQK4H', 'Funcionando', 'b4:b5:2f:50:7f:6b'),
(96, 2, 'maq33-pc', '', '', 'GWWBB-6JXFM-8PGY8-TTRXK-BJF79', 'Funcionando', 'b4:b5:2f:50:7f:a0'),
(97, 2, 'maq34-pc', '', '', '3XDRV-K27HR-C2C8K-4G3KY-HX3KK', 'Funcionando', 'b4:b5:2f:50:c0:ce'),
(98, 2, 'maq35-pc', '', '', '3XDRV-K27HR-C2C8K-4G3KY-HX3KK', 'Funcionando', 'b4:b5:2f:50:c0:ce'),
(99, 3, 'maq01-pc', '', '', 'FHXCN-FXCFB-J7W33-HTTT9-CDKTP', 'Funcionando', ''),
(100, 3, 'maq02-pc', '', '', 'X23P6-HWNVQ-7B8GM-JWR6B-BBH22', 'Funcionando', ''),
(101, 3, 'maq03-pc', '', '', 'JQKNF-W3TRX-BPRM8-TH2PJ-QDBP2', 'Funcionando', ''),
(102, 3, 'maq04-pc', '', '', 'W7N6Q-JKHK7-RCRJP-RHP4W-D9MP2', 'Funcionando', ''),
(103, 3, 'maq05-pc', '', '', 'H972W-NPMRG-KDT74-GKK6K-M98XC', 'Funcionando', ''),
(104, 3, 'maq06-pc', '', '', '6NMG3-BGTC6-KF8X9-7MYCX-XKXTP', 'Funcionando', ''),
(105, 3, 'maq07-pc', '', '', 'XBNH7-8JBMX-KR2DG-KPRJD-49CKC', 'Funcionando', ''),
(106, 3, 'maq08-pc', '', '', 'QNYR2-GMRPJ-WW3X9-22F27-VT9TP', 'Funcionando', ''),
(107, 3, 'maq09-pc', '', '', 'KBFGN-J4R2T-PK9DJ-WGHHB-7MH22', 'Funcionando', ''),
(108, 3, 'maq10-pc', '', '', '4DP82-8N84Q-GYVD2-TBPK6-KTPKC', 'Funcionando', ''),
(109, 3, 'maq11-pc', '', '', '34H8Q-N7H7F-F3WGG-3T4MV-YY49C	', 'Funcionando', ''),
(110, 3, 'maq12-pc', '', '', '7KNPT-R2T7K-6QDYT-R49MB-8FG6P', 'Funcionando', ''),
(111, 3, 'maq13-pc', '', '', 'KRN36-Y6PRJ-TCHH7-DBD7T-RRG6P', 'Funcionando', ''),
(112, 3, 'maq14-pc', '', '', '36QVN-CY3FJ-D7VQ4-WKFHJ-F3KTP', 'Funcionando', ''),
(113, 3, 'maq15-pc', '', '', 'WB4H4-D7NTD-XXHMD-XBPMY-2PQGP', 'Funcionando', ''),
(114, 3, 'maq16-pc', '', '', 'D3MNP-9YMF6-9C4MB-F9H3H-94R9C', 'Funcionando', ''),
(115, 3, 'maq17-pc', '', '', 'NPDXX-HGDHD-MKTJT-B4D3T-6F4C2', 'Funcionando', ''),
(116, 3, 'maq18-pc', '', '', '6R3N6-KBXKQ-R7CCX-VYW9Y-3GPKC', 'Funcionando', ''),
(117, 3, 'maq19-pc', '', '', '9Y3J9-VNHJD-V79FR-C3WMQ-YBH22', 'Funcionando', ''),
(118, 3, 'maq20-pc', '', '', 'RNC2H-PBW67-XMCRR-W9HQT-6F4C2', 'Funcionando', ''),
(119, 3, 'maq21-pc', '', '', 'CNV2Q-82C6J-4QBF7-T8JJT-Y98XC', 'Funcionando', ''),
(120, 3, 'maq22-pc', '', '', '7KXFR-8N7HH-M7HFC-FVPVH-7QWXC', 'Funcionando', ''),
(121, 3, 'maq23-pc', '', '', 'CNV2J-34YMQ-6GR7C-6FHTR-GXXTP', 'Funcionando', ''),
(122, 3, 'maq24-pc', '', '', 'N3Q2J-W8GYB-3KJVB-6G7DC-76DGP', 'Funcionando', ''),
(123, 3, 'maq25-pc', '', '', 'QN6Y6-88GDB-CX23F-TTHFK-YDWXC', 'Funcionando', ''),
(124, 3, 'maq26-pc', '', '', 'VCR7R-MNR3M-XQMK3-CMB4K-8QKTP', 'Funcionando', ''),
(125, 3, 'maq27-pc', '', '', '76KN2-DBWYM-J43JM-CT74V-G6PKC', 'Funcionando', ''),
(126, 3, 'maq28-pc', '', '', '7RCYB-HNBHX-WRK3K-VD4Q8-GVJXC', 'Funcionando', ''),
(127, 3, 'maq29-pc', '', '', 'C9NX3-G8QV7-4WD6B-4PFH4-GXXTP', 'Funcionando', ''),
(128, 3, 'maq30-pc', '', '', 'NC9RK-Y8KGF-X43MF-6HRM6-BP2KC', 'Funcionando', ''),
(129, 3, 'maq31-pc', '', '', 'HN696-4PFF4-J4TTK-Y6KB3-B98XC', 'Funcionando', ''),
(130, 3, 'maq32-pc', '', '', 'NYDGQ-JD8FP-F3KJC-CCMRX-Y7V22', 'Funcionando', ''),
(131, 3, 'maq33-pc', '', '', 'QFNGD-96YDP-VF3JY-7GHCY-KD722', 'Funcionando', ''),
(132, 3, 'maq34-pc', '', '', 'BN2Q8-WPRVQ-4DB2M-2GCYP-MP2KC', 'Funcionando', ''),
(133, 3, 'maq35-pc', '', '', 'CM6JN-7CXD6-6G79C-2G4KG-D3WXC', 'Funcionando', ''),
(134, 5, 'maq01-pc', '', '', 'BPJC2-BKBK7-69CT3-GVKV3-JBVF3', 'Funcionando', ''),
(135, 5, 'maq02-pc', '', '', 'CVYW2-F6R93-F94MV-4T72Q-2Q86F', 'Funcionando', ''),
(136, 5, 'maq03-pc', '', '', 'TDR38-9B3GJ-QJW3G-6VTB6-3HRKG', 'Funcionando', ''),
(137, 5, 'maq04-pc', '', '', '6V37D-QCXFD-YYB63-MGTDH-QDMY9', 'Funcionando', ''),
(138, 5, 'maq05-pc', '', '', 'PQYX8-VWTKX-7G3XH-C8RDR-Y6XTR', 'Funcionando', ''),
(139, 5, 'maq06-pc', '', '', 'XFVTR-K88VJ-9DG9H-VHJCK-VX3YD', 'Funcionando', ''),
(140, 5, 'maq07-pc', '', '', 'YHQ36-C4KBG-4WDRQ-VTDV8-R4CJG', 'Funcionando', ''),
(141, 5, 'maq08-pc', '', '', '7W6CY-TBHYV-96BFV-B3BWX-Y7W4X', 'Funcionando', ''),
(142, 5, 'maq09-pc', '', '', 'MQP84-9J997-MWPCP-22HDD-GBFQB', 'Funcionando', ''),
(143, 5, 'maq10-pc', '', '', 'Q7K92-X9VFV-BGP2F-MKR8H-4G66F', 'Funcionando', ''),
(144, 5, 'maq11-pc', '', '', 'GQJ3B-33MVP-DGTY3-JCMTT-4V4PW', 'Funcionando', ''),
(145, 5, 'maq11-pc', '', '', 'GQJ3B-33MVP-DGTY3-JCMTT-4V4PW', 'Funcionando', ''),
(146, 5, 'maq12-pc', '', '', 'GM94V-FBJ7H-FXC3H-3MQ7R-Y6Y48', 'Funcionando', ''),
(147, 5, 'maq13-pc', '', '', '2PJW3-J4WB9-QPY3R-736BK-HG9QK', 'Funcionando', ''),
(148, 5, 'maq14-pc', '', '', '378W9-4FR26-8XTY7-W7M9V-K99YH', 'Funcionando', ''),
(149, 5, 'maq15-pc', '', '', '', 'Funcionando', ''),
(150, 5, 'maq16-pc', '', '', 'XH9X9-XHJC7-PRGY6-4BJVW-XKHQ2', 'Funcionando', ''),
(151, 5, 'maq17-pc', '', '', 'CM2CT-MT86Q-B327W-34DW4-GTRQG', 'Funcionando', ''),
(152, 5, 'maq18-pc', '', '', 'PTFH9-YR8CW-HW3GY-Y84TY-8F3DF', 'Funcionando', ''),
(153, 5, 'maq19-pc', '', '', 'H8Y3R-PKPFQ-J42M2-G4V79-VBVFJ', 'Funcionando', ''),
(154, 5, 'maq20-pc', '', '', '33BV4-8JGYM-PF7T4-6MGQC-X7YF8', 'Funcionando', ''),
(155, 5, 'maq21-pc', '', '', 'HQ3W8-H9B2T-G2Q9W-RHQ3B-2KYDF', 'Funcionando', ''),
(156, 5, 'maq22-pc', '', '', 'RF8J2-JQ4JQ-VWXXG-2BWGR-WRD2R', 'Funcionando', ''),
(157, 5, 'maq23-pc', '', '', 'C9RMX-7B8MR-BHQ83-8WQRB-FTHVG', 'Funcionando', ''),
(158, 5, 'maq24-pc', '', '', 'JYFCM-BDWBR-KT6KP-F4WK4-68DBB', 'Funcionando', ''),
(159, 5, 'maq25-pc', '', '', 'HVRVF-47XQ6-FHGV3-F7B22-BQPHM', 'Funcionando', ''),
(160, 5, 'maq26-pc', '', '', 'YG8P9-3GJTK-63M2P-MMCVH-K7KH3', 'Funcionando', ''),
(161, 5, 'maq27-pc', '', '', 'PPF6V-88DKQ-V6VD7-GWDMW-MQP7P', 'Funcionando', ''),
(162, 5, 'maq28-pc', '', '', 'BV7HH-F622P-B37RP-K6D7Y-98FBF', 'Funcionando', ''),
(163, 5, 'maq29-pc', '', '', 'D7CJM-8PPB6-W2WFC-4T2KJ-GJXM2', 'Funcionando', ''),
(164, 5, 'maq30-pc', '', '', 'VKVXY-JDTWP-RJ6DW-87BMY-RR9PM', 'Funcionando', ''),
(165, 5, 'maq31-pc', '', '', 'VKB7Y-B78V6-3GKPK-6X3TC-VD983', 'Funcionando', ''),
(166, 5, 'maq32-pc', '', '', 'TQDHX-9BQFT-DCVP3-T6F9B-9FD3W', 'Funcionando', ''),
(167, 5, 'maq33-pc', '', '', '4BRKC-HPWMQ-Q3JQX-PH8RJ-FQQBX', 'Funcionando', ''),
(168, 5, 'maq34-pc', '', '', 'X94MT-VRJWD-JVG23-K9X6W-3TCMD', 'Funcionando', ''),
(169, 5, 'maq35-pc', '', '', '6VBF9-8VX2P-C6VX3-2JRM6-3K4J6', 'Funcionando', ''),
(170, 5, 'maqprof-pc', '', '', 'GDBKX-DQG92-3FDVB-C27B9-9F7TB', 'Funcionando', ''),
(171, 10, '', '', '', '', 'Funcionando', ''),
(172, 18, 'maqprof-pc', '', '', 'KXNTH-KR8QD-QYXYH-JR2T2-D69TP', 'Funcionando', ''),
(173, 18, 'maq01-pc', '', '', 'H74ND-24WHW-KHQY8-28RJV-XD722', 'Funcionando', ''),
(174, 18, 'maq02-pc', '', '', 'NDY6J-3PHVW-3VRP8-3HDRJ-RX8XC', 'Funcionando', ''),
(175, 18, 'maq03-pc', '', '', 'PHRJ2-HRNJQ-7PJWH-39HW2-2DKTP', 'Funcionando', ''),
(176, 18, 'maq04-pc', '', '', 'QJ9NR-XJCVH-77KM7-6X4D2-Q3WXC', 'Funcionando', ''),
(177, 18, 'maq05-pc', '', '', 'D3TNG-KMBBG-MDD6B-KBX2P-Q3WXC', 'Funcionando', ''),
(178, 18, 'maq06-pc', '', '', 'CQMNJ-3TWYR-2DJ7G-WF2V6-3V66P', 'Funcionando', ''),
(179, 18, 'maq07-pc', '', '', 'QBTGN-VW22X-MFWHP-WWJFF-9W3GP', 'Funcionando', ''),
(180, 18, 'maq08-pc', '', '', 'TNMKF-VXRQP-R6PFT-MH4H8-29XTP', 'Funcionando', ''),
(181, 18, 'maq09-pc', '', '', 'RFGRK-NR3JM-4RDY3-V6GPC-8XCKC', 'Funcionando', ''),
(182, 18, 'maq10-pc', '', '', '2CXHV-NWHC7-3HDDC-WF4F8-QDBP2', 'Funcionando', ''),
(183, 18, 'maq11-pc', '', '', 'TP3CM-7NHPV-VPG64-MV9YT-XQBP2', 'Funcionando', ''),
(184, 18, 'maq12-pc', '', '', 'K9RQF-YNYQY-8342V-RJKMY-K766P', 'Funcionando', ''),
(185, 18, 'maq13-pc', '', '', '6DR9V-QN39V-6GJHC-JPXQ3-M7V22', 'Funcionando', ''),
(186, 18, 'maq14-pc', '', '', 'C48V8-3N3M9-P38CH-T2MJ6-C9XTP', 'Funcionando', ''),
(187, 9, 'maqprof-pc', '', '', '2X6HC-YJ7BV-442V3-26BYY-WXKK7', 'Funcionando', ''),
(188, 9, 'maq01-pc', '', '', '8xm43-3x8k8-qddx9-4wrhk-yygvx', 'Funcionando', ''),
(189, 9, 'maq02-pc', '', '', 'mkt38-xbkbj-3k8pf-d7878-dmwht', 'Funcionando', ''),
(190, 9, 'maq03-pc', '', '', 'FHG3Y-HBVJC-JKW3T-87DR8-RG3WV', 'Funcionando', ''),
(191, 9, 'maq04-pc', '', '', 'bmywk-pqr8d-3b2yg-p76b7-xt6jc', 'Funcionando', ''),
(192, 9, 'maq05-pc', '', '', 'yptdj-pf4mf-mqdh9-3jp8r-vrrgb', 'Funcionando', ''),
(193, 9, 'maq06-pc', '', '', '7XT93-V6G8R-GTYXB-Y2M8H-78F8F', 'Funcionando', ''),
(194, 9, 'maq07-pc', '', '', '6KRXT-HRX9K-DVJ9X-9DCM7-7QDTQ ', 'Funcionando', ''),
(195, 9, 'maq08-pc', '', '', 'H8QXF-RJGXX-XJK6J-F4V7C-7MKBJ', 'Funcionando', ''),
(196, 9, 'maq09-pc', '', '', '6fv2f-ky6q6-7w6gf-6y6wv-6k9kk', 'Funcionando', ''),
(197, 9, 'maq10-pc', '', '', '6R9HP-F422P-T8JD7-MK2HX-4VG2F', 'Funcionando', ''),
(198, 9, 'maq11-pc', '', '', 'MKBPM-7TRC7-M8F24-FF8Q3-GPWMP', 'Funcionando', ''),
(199, 9, 'maq12-pc', '', '', 'CPFWQ-DRHQH-2YVH9-H928C-H8MBJ', 'Funcionando', ''),
(200, 9, 'maq13-pc', '', '', 'FH6B7-CXTW4-Y3J44-J7RR7-VF64B', 'Funcionando', ''),
(201, 9, 'maq14-pc', '', '', '9CXYY-MFQQX-CP2T3-6KWV2-WX8PB', 'Funcionando', ''),
(202, 9, 'maq15-pc', '', '', 'RC2BP-PH7PD-T293Q-D644V-9G8YM', 'Funcionando', ''),
(203, 9, 'maq16-pc', '', '', 'J8JTX-HJVF8-F3WKW-BV798-PBR4F', 'Funcionando', ''),
(204, 9, 'maq17-pc', '', '', 'P2K32-3F2QC-DFHT4-KKKB7-YKTYM', 'Funcionando', ''),
(205, 9, 'maq18-pc', '', '', '6CQHW-TH3V6-427MY-74Q8Q-878RK', 'Funcionando', ''),
(206, 9, 'maq19-pc', '', '', 'MHQKX-4XVPV-XPRX3-8X9P8-8Q8VW', 'Funcionando', ''),
(207, 9, 'maq20-pc', '', '', '73WFF-JYW8P-K78HW-PJJ6T-B2W2W', 'Funcionando', ''),
(208, 9, 'maq21-pc', '', '', 'D88QD-M6BFX-82JXD-4RDTH-GMBD9', 'Funcionando', ''),
(209, 9, 'maq22-pc', '', '', '', 'Funcionando', ''),
(210, 9, 'maq23-pc', '', '', 'HV8KF-F83Q-R79WT-XQR8H-J3WWR', 'Funcionando', ''),
(211, 9, 'maq24-pc', '', '', 'W2BQG-FW3DJ-Q2GRT-WVR9P-78236', 'Funcionando', ''),
(212, 9, 'maq25-pc', '', '', 'Q89B7-CBJP7-F7VC2-G4Y9G-R97WY', 'Funcionando', ''),
(213, 9, 'maq26-pc', '', '', 'GFT63-BT62X-CDW6F-HKKFH-XF278', 'Funcionando', ''),
(214, 9, 'maq27-pc', '', '', 'KCVQG-XGYD2-D22WH-8YDKV-RGXFQ', 'Funcionando', ''),
(215, 9, 'maq28-pc', '', '', 'YDT66-94TBH-XPGH8-BVGM8-X7DDQ', 'Funcionando', ''),
(216, 9, 'maq29-pc', '', '', 'P9HVV-VDFBH-9RDGK-CHGBX-HDVBP', 'Funcionando', ''),
(217, 9, 'maq30-pc', '', '', 'k9yfy-24g3y-yxghm-d2rx7-9ghyp', 'Funcionando', ''),
(218, 9, 'maq31-pc', '', '', '2R3Q4-FXHYD-XVPXQ-DTKGH-DJVm4', 'Funcionando', ''),
(219, 9, 'maq32-pc', '', '', 'RB68V-848G6-M4RPK-KYH6H-G37MH', 'Funcionando', ''),
(220, 9, 'maq34-pc', '', '', 'KBJC7-W9V6T-X8HCB-3PCPG-K4RBC', 'Funcionando', '');

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

--
-- Extraindo dados da tabela `patrimonio`
--

INSERT INTO `patrimonio` (`pat`, `nome`, `id_desc`, `localizacao`, `estado`) VALUES
('31339', 'LAB4MAQ02', 6, 'Lab4', 'Em uso'),
('31392', 'LAB4MAQ14', 6, 'Lab4', 'Em uso'),
('31394', 'LAB4MAQ05', 6, 'Lab4', 'Em uso'),
('31395', 'LAB4MAQ19', 6, 'Lab4', 'Em uso'),
('31396', 'LAB4MAQ10', 6, 'Lab4', 'Em uso'),
('31397', 'LAB4MAQ07', 6, 'Lab4', 'Em uso'),
('31398', 'LAB4MAQ20', 6, 'Lab4', 'Em uso'),
('31400', 'LAB4MAQ29', 6, 'Lab4', 'Em uso'),
('31401', 'LAB4MAQ06', 6, 'Lab4', 'Em uso'),
('31402', 'LAB4MAQ22', 6, 'Lab4', 'Em uso'),
('31403', 'LAB4MAQ12', 6, 'Lab4', 'Em uso'),
('31404', 'LAB4MAQ33', 6, 'Lab4', 'Em uso'),
('31405', 'LAB4MAQ09', 6, 'Lab4', 'Em uso'),
('31406', 'LAB4MAQ03', 6, 'Lab4', 'Em uso'),
('31407', 'LAB4MAQ18', 6, 'Lab4', 'Em uso'),
('31408', 'LAB4MAQ13', 6, 'Lab4', 'Em uso'),
('31409', 'LAB4MAQ24', 6, 'Lab4', 'Em uso'),
('31410', 'LAB4MAQ34', 6, 'Lab4', 'Em uso'),
('31411', 'LAB4MAQ25', 6, 'Lab4', 'Em uso'),
('31412', 'LAB4MAQ17', 6, 'Lab4', 'Em uso'),
('31414', 'LAB4MAQ26', 6, 'Lab4', 'Em uso'),
('31415', 'LAB4MAQ28', 6, 'Lab4', 'Em uso'),
('31416', 'LAB4MAQ31', 6, 'Lab4', 'Em uso'),
('31417', 'LAB4MAQ16', 6, 'Lab4', 'Em uso'),
('31418', 'LAB4MAQ27', 6, 'Lab4', 'Em uso'),
('31419', 'LAB4MAQ23', 6, 'Lab4', 'Em uso'),
('31420', 'LAB4MAQ08', 6, 'Lab4', 'Em uso'),
('31421', 'LAB4MAQ29', 6, 'Lab4', 'Em uso'),
('31422', 'LAB4MAQ01', 6, 'Lab4', 'Em uso'),
('31423', 'LAB4MAQ11', 6, 'Lab4', 'Em uso'),
('31424', 'LAB4MAQ21', 6, 'Lab4', 'Em uso'),
('31425', 'LAB4MAQ15', 6, 'Lab4', 'Em uso'),
('31426', 'LAB4MAQ32', 6, 'Lab4', 'Em uso'),
('31437', 'LAB4MAQ35', 6, 'Lab4', 'Em uso'),
('31440', 'LAB4MAQ04', 6, 'Lab4', 'Em uso'),
('31441', 'LAB4MAQPROF', 6, 'Lab4', 'Em uso');

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

--
-- Extraindo dados da tabela `softwares`
--

INSERT INTO `softwares` (`id`, `lab`, `nome`, `descricao`, `instalacao`) VALUES
(1, 2, 'Office 2013', '', 'false'),
(2, 2, 'Google Chrome', '', 'false'),
(3, 2, 'Arduino', '', 'false'),
(4, 2, 'Portugol Studio', '', 'false'),
(5, 9, 'Teste', 'sdhjdsgfjdgksdhjdsgfjdgksdhjdsgfjdgksdhjdsgfjdgksdhjdsgfjdgksdhjdsgfjdgksdhjdsgfjdgksdhjdsgfjdgksdhj', 'false');

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
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `nome`, `nivel`) VALUES
(7, 'jsomavilla', 'f8bd2ef42a2e889c855b7b84e79829f3', 'Julia Somavilla', 'Bolsista'),
(8, 'rlorensi', '054c58bd74b98ae04dfcea6bd8156626', 'Rui Lorensi', 'Rui'),
(9, 'Garcez', '70a3026ce8346acaa2ad0cd9eecc7226', 'Garcez', 'Bolsista'),
(10, 'Xavier', 'bfffba2e77eee6e57c601cc55371e5f7', 'Victor Xavier', 'Bolsista'),
(11, 'dcastro', '3c2031ac53dea3dacb733041d55e322d', 'Daniel Zanini de Castro', 'Bolsista'),
(12, 'lsilva', 'ab25e6788c93130181acd382b7b3fcee', 'Lucas de Lima Silva', 'Bolsista'),
(14, 'sergio', '2cbedc973050c7051897910c2b62e288', 'SÃ©rgio Almeida', 'Bolsista');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comentarios_maq`
--
ALTER TABLE `comentarios_maq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comentario_pat`
--
ALTER TABLE `comentario_pat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `descricao`
--
ALTER TABLE `descricao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `evt_lab`
--
ALTER TABLE `evt_lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `evt_rotina`
--
ALTER TABLE `evt_rotina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `laboratorios`
--
ALTER TABLE `laboratorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `softwares`
--
ALTER TABLE `softwares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
