-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 30-Nov-2018 às 22:07
-- Versão do servidor: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multipleauth`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@hotmail.com', '$2y$10$Lm/cWFx5dFyR738fnlc4Ou6v8f2HxcbFxrYbdDueoM6DJB4jswzVG', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricula` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inicioSemestre` date NOT NULL,
  `instituicao_id` int(10) UNSIGNED DEFAULT NULL,
  `turma_id` int(10) UNSIGNED DEFAULT NULL,
  `statusHorasComplementares` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `name`, `email`, `password`, `matricula`, `inicioSemestre`, `instituicao_id`, `turma_id`, `statusHorasComplementares`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Geovane Bezerra da Silva', 'geovane@hotmail.com', '$2y$10$s1aBDun0tthL19s.TKFFteWXZ6Si3uaYRwtfNc.ghvrBlsD7NUdES', '117234901901', '2016-02-11', 1, 1, 1, 'toto', '2018-10-12 23:43:46', '2018-10-12 23:43:46'),
(2, 'Bruno Weberty Silva Ribeiro', 'brunoweberty@hotmail.com', '$2y$10$qwMlqvl5K2MrPsxIsnxohu0.42FZH4Hci/hlNeX01En2/JsEWdtkS', '100100100101', '2016-02-11', 1, 1, 0, 'toto', '2018-10-13 22:33:06', '2018-10-13 22:33:06'),
(3, 'Paulo Henrique da Fonseca', 'paulo@hotmail.com', '$2y$10$eLarzZoecFzPgQ50e6AE/eK2Bq/mS.e9mU79..J0FZtBkjr9N3THS', '100100100101', '2018-07-26', 1, 1, 0, 'toto', '2018-10-24 19:42:44', '2018-10-24 19:42:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_certificado`
--

CREATE TABLE `aluno_certificado` (
  `id` int(10) UNSIGNED NOT NULL,
  `aluno_id` int(10) UNSIGNED DEFAULT NULL,
  `certificado_id` int(10) UNSIGNED DEFAULT NULL,
  `status` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `aluno_certificado`
--

INSERT INTO `aluno_certificado` (`id`, `aluno_id`, `certificado_id`, `status`, `created_at`, `updated_at`) VALUES
(18, 3, 13, 0, '2018-11-03 17:37:48', '2018-11-03 17:37:48'),
(19, 3, 14, 0, '2018-11-03 17:39:50', '2018-11-03 17:39:50'),
(30, 2, 26, 1, '2018-11-30 01:26:52', '2018-11-30 01:26:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `limiteChs` double(8,2) NOT NULL,
  `limiteCertificados` int(11) NOT NULL,
  `observacoes` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modalidade_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `descricao`, `limiteChs`, `limiteCertificados`, `observacoes`, `modalidade_id`, `created_at`, `updated_at`) VALUES
(1, 'Monitoria', 'Participação em atividade de\r\nmonitoria remunerada ou voluntária\r\nem unidades curriculares ou\r\nlaboratórios.', 50.00, 100, 'Serão consideradas atividades de\r\nmonitoria aquelas desenvolvidas em\r\nconsonância com o regulamento\r\nespecífico, aprovado pelos órgãos\r\nsuperiores competentes.', 6, '2018-10-13 00:28:25', '2018-10-13 00:28:25'),
(2, 'Disciplinas extracurriculares', 'Realização de disciplinas em outros\r\ncursos, em outras instituições ou na\r\ninstituição de origem (somente em\r\náreas afins), com aprovação.', 40.00, 100, 'Realização de disciplinas em outros\r\ncursos, em outras instituições ou na\r\ninstituição de origem (somente em\r\náreas afins), com aprovação.', 6, '2018-10-13 00:29:38', '2018-10-13 00:29:38'),
(3, 'Participação em órgãos colegiados / conselhos', 'Membro de órgãos colegiados:\r\nColegiado de Curso – Conselhos /\r\nórgãos colegiados existentes na\r\ninstituição - Diretório Acadêmico.', 20.00, 1, 'Serão consideradas participações em\r\nconselhos/comissões/órgãos colegiados\r\nem que a representação discente faça\r\nparte de sua composição. Será\r\nconsiderada, no máximo, 1 (uma)\r\natividade por semestre.', 6, '2018-10-13 00:30:42', '2018-10-13 01:00:58'),
(4, 'Integrante de Núcleo ou Grupo de Estudo', 'Participação em núcleos ou grupos de\r\nestudos criados na instituição em áreas\r\nafins.', 20.00, 100, 'Serão consideradas as participações em\r\nnúcleos ou grupos de estudos, desde\r\nconste de regulamento próprio\r\naprovado pelo campus.', 6, '2018-10-13 00:32:32', '2018-10-13 00:32:32'),
(5, 'Cursos e mini-cursos', 'Participação em cursos e mini-cursos\r\nnas áreas correlatas.', 40.00, 2, 'Serão consideradas no máximo 2 (duas)\r\natividades, sendo que cada\r\nparticipação corresponderá a 50% da\r\ncarga horária semestral correspondente\r\na esta atividade.', 6, '2018-10-13 00:33:38', '2018-10-13 00:33:38'),
(6, 'Cursos de Idiomas', 'Participação em cursos de língua\r\nestrangeira.', 20.00, 2, 'Serão considerados até dois cursos\r\noferecidos por instituições devidamente\r\nautorizadas.', 6, '2018-10-13 00:35:36', '2018-10-13 00:35:36'),
(7, 'Palestras', 'Organização ou participação\r\n(ouvinte) em palestras nas áreas de\r\natuação do curso.', 20.00, 2, 'Serão consideradas no máximo 2\r\n(duas) palestras, sendo que cada\r\npalestra corresponderá a 50% da\r\ncarga horária semestral destinada a esta\r\natividade.', 6, '2018-10-13 00:36:31', '2018-10-13 00:36:31'),
(8, 'Projetos de ensino', 'Participação em projetos\r\nvinculados aos programas de\r\nincentivo às licenciaturas (PIBID e\r\noutros)\r\n- Programa de educação tutorial (PET).', 60.00, 100, 'Serão consideradas as participações,\r\nremunerada ou voluntária, em projetos,\r\ndesde que os mesmos constem de\r\nedital próprio.', 6, '2018-10-13 00:40:34', '2018-10-13 00:40:34'),
(9, 'Atividades técnico-científicas', 'Participação em: simpósio, congresso,\r\nsemana de curso, workshop, dia de campo,\r\nseminário, encontro, visita\r\ntécnica, ciclo de debate, ciclo de\r\npalestra e similares, sem\r\napresentação de trabalhos.', 40.00, 2, 'Serão consideradas as participações em\r\neventos na área do curso.\r\nSerão consideradas, no máximo, 2\r\n(duas) atividades, sendo que cada\r\natividade corresponderá a 50% da carga\r\nhorária semestral destinada a esta\r\natividade.', 7, '2018-10-13 00:42:46', '2018-10-13 00:42:46'),
(10, 'Projetos de pesquisa e/ou inovação (iniciação científica)', 'Participação em projetos de pesquisa\r\ne/ou com bolsa de Iniciação Científica\r\nou em desenvolvimento de projeto\r\nde pesquisa no Programa voluntário\r\nde iniciação científica.', 60.00, 100, 'Serão consideradas participações em\r\nprojetos que constem de cadastros e\r\naprovação na coordenação de pesquisa\r\ndo campus.', 7, '2018-10-13 00:46:13', '2018-10-13 00:46:13'),
(11, 'Publicação de artigos', 'Publicação de artigo em: simpósio,\r\ncongresso, revista científica ou jornais na área de atuação.', 40.00, 2, 'Serão consideradas, no máximo, 2\r\n(duas) publicações, sendo que cada publicação corresponderá a 50% da\r\ncarga horária semestral destinada a\r\nesta atividade.', 7, '2018-10-13 00:48:02', '2018-10-13 00:48:02'),
(12, 'Publicação de livros ou capítulo de livro', 'Publicação de livros ou capítulo de\r\nlivros na área de atuação.', 40.00, 2, 'Serão consideradas, no máximo, 2\r\n(duas) publicações, sendo que cada\r\npublicação corresponderá a 50% da\r\ncarga horária semestral destinada a\r\nesta atividade.', 7, '2018-10-13 00:50:25', '2018-10-13 00:50:25'),
(13, 'Publicação em boletins técnicos', 'Publicação em boletins técnicos ou\r\nsimilares na área de atuação.', 30.00, 2, 'Serão consideradas, no máximo, 2\r\n(duas) publicações, sendo que cada\r\npublicação corresponderá a 50% da\r\ncarga horária semestral destinada a\r\nesta atividade.', 7, '2018-10-13 00:52:09', '2018-10-13 00:52:09'),
(14, 'Atividades de extensão', 'Participação em projetos de extensão,\r\nou em assistência a projetos e\r\nprogramas sociais (sem bolsa).', 50.00, 100, 'Serão considerados projetos cadastrados\r\nna instituição responsável pelo mesmo e\r\nque atendam a regulamento próprio.', 8, '2018-10-13 00:54:35', '2018-10-13 00:54:35'),
(15, 'Programas de bolsas institucionais', 'Bolsista Institucional: bolsas de\r\ndemanda social ou complementação\r\neducacional.', 40.00, 100, 'Serão considerados os programas\r\ncadastrados em órgão responsável no\r\ncampus e que atendam a regulamento\r\npróprio.', 8, '2018-10-13 00:55:37', '2018-10-13 00:55:37'),
(16, 'Programa bolsas de extensão', 'Participação em projetos com bolsa\r\nde extensão.', 40.00, 100, 'Serão consideradas participações em\r\nprojetos cadastrados na instituição\r\nresponsável pelo mesmo e que atendam\r\na regulamento próprio.', 8, '2018-10-13 01:09:05', '2018-10-13 01:09:05'),
(17, 'Estágios extracurriculares', 'Realização de estágios\r\nextracurriculares na instituição de\r\norigem ou em Instituições/empresas\r\npúblicas e privadas.', 40.00, 100, 'Serão considerados estágios\r\nextracurriculares que atendam ao\r\nregulamento próprio. Excetua-se o\r\nestágio supervisionado obrigatório.\r\nSerá considerado como Atividade\r\nComplementar o estágio com carga\r\nhorária mínima de 60 horas.', 8, '2018-10-13 01:13:27', '2018-10-13 01:14:17'),
(18, 'Atuação profissional', 'Exercício de atividade profissional.', 50.00, 100, 'Serão consideradas as atividades\r\nprofissionais na área do curso\r\ndevidamente comprovadas por carteira\r\nde trabalho assinada pelo empregador\r\nou declaração emitida por órgão\r\ncompetente no caso de servidor público\r\nque não for do regime CLT\r\n(Consolidação das Leis do Trabalho).', 8, '2018-10-13 01:19:47', '2018-10-13 01:19:47'),
(19, 'Palestras proferidas', 'Palestrante em eventos', 20.00, 100, 'Serão consideradas palestras que não\r\nsejam vinculadas às disciplinas\r\nregulares do curso, realizadas no\r\npróprio campus ou em outra\r\ninstituição.\r\nSerão consideradas, no máximo, 2\r\n(duas) palestras, sendo que cada\r\npalestra corresponderá a 50% da\r\ncarga horária semestral destinada a esta\r\natividade.', 8, '2018-10-13 01:24:37', '2018-10-13 01:24:37'),
(20, 'Expositor em eventos', 'Participação como expositor em\r\ncongressos, seminários e outros.', 20.00, 100, 'Serão consideradas as participações que\r\nconstarem de acompanhamento /\r\norientação de professor(es) da\r\ninstituição.', 8, '2018-10-13 01:26:12', '2018-10-13 01:26:12'),
(21, 'Apresentação de trabalhos', 'Apresentação de trabalhos em\r\ncongressos, seminários e outros', 20.00, 100, 'Serão consideradas as participações que\r\nconstarem de acompanhamento /\r\norientação de professor(es) da\r\ninstituição.', 8, '2018-10-13 01:27:03', '2018-10-13 01:27:03'),
(22, 'Empresa Júnior e incubadoras', '- Participação em empresa júnior na\r\nárea do curso.\r\n- Participação em incubadora de\r\nempresa', 30.00, 100, 'Serão consideradas as participações\r\nna área do curso e que constarem de acompanhamento e orientação de\r\nprofessor(es) da instituição.', 8, '2018-10-13 01:28:25', '2018-10-13 01:28:25'),
(23, 'Organização de eventos', 'Organização de eventos de pesquisa,\r\nextensão ou artístico-culturais.', 20.00, 100, 'Serão consideradas as participações\r\nque constarem de acompanhamento e\r\norientação de professor(es) da\r\ninstituição.', 8, '2018-10-13 01:29:13', '2018-10-13 01:29:13'),
(24, 'Participação em visitas técnicas', '- Participação em visitas técnicas\r\nrelacionadas ao curso', 20.00, 2, 'Serão consideradas visitas técnicas\r\nregulares do curso, realizadas fora da\r\ninstituição.\r\nSerão consideradas, no máximo, 2\r\n(duas) visitas por semestre', 8, '2018-10-13 01:30:09', '2018-10-13 01:30:09'),
(25, 'Atividades artístico- cultural', 'Participação nas diversas atividades e\r\nmanifestações artísticas e culturais\r\noficiais.', 50.00, 2, 'Serão consideradas atividades que\r\ndifundam, valorizam e enriqueçam a\r\ncultura. As atividades deverão estar\r\noficializadas junto aos órgãos\r\ncompetentes do campus.\r\nSerão consideradas, no máximo, 2\r\n(duas) atividades, sendo que cada\r\ncorresponderá a 50% da carga horária\r\nsemestral destinada a esta atividade.', 9, '2018-10-13 01:35:13', '2018-10-13 01:35:13'),
(26, 'Atividades esportivas', 'Participação em atividades e/ou\r\nmodalidades esportivas oficiais.', 20.00, 2, 'Serão consideradas atividades que\r\nfavoreçam a integração das diversas\r\ndimensões e agentes do processo\r\neducativo. As atividades deverão\r\nestar oficializadas junto aos órgãos\r\ncompetentes do campus.\r\nSerão consideradas, no máximo, 2\r\n(duas) atividades, sendo que cada corresponderá a 50% da carga horária\r\nsemestral destinada a esta atividade.', 10, '2018-10-13 01:36:10', '2018-10-13 01:36:10'),
(27, 'Atividades sociais e ambientais', 'Participação em atividades sociais\r\ne/ou ambientais oficiais.', 20.00, 2, 'Serão consideradas atividades que\r\nfavoreçam a integração das diversas\r\ndimensões e agentes do processo\r\neducativo. As atividades deverão estar\r\noficializadas junto aos órgãos\r\ncompetentes do campus.\r\nSerão consideradas, no máximo, 2\r\n(duas) atividades, sendo que cada\r\ncorresponderá a 50% da carga horária\r\nsemestral destinada a esta atividade.', 11, '2018-10-13 01:38:18', '2018-10-13 01:38:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `certificado`
--

CREATE TABLE `certificado` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomeC` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instituicao` int(10) UNSIGNED NOT NULL,
  `entidadePromotora` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataConclusao` date NOT NULL,
  `cargaHoraria` double(8,2) NOT NULL,
  `horaAceita` double(8,2) NOT NULL,
  `arquivo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relatorio` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria_id` int(10) UNSIGNED DEFAULT NULL,
  `semestre_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `certificado`
--

INSERT INTO `certificado` (`id`, `nomeC`, `instituicao`, `entidadePromotora`, `dataConclusao`, `cargaHoraria`, `horaAceita`, `arquivo`, `relatorio`, `categoria_id`, `semestre_id`, `created_at`, `updated_at`) VALUES
(13, 'Atividade artístico-cultural/Festa Junina', 2, 'IFTM - Instituto Federal do Triângulo Mineiro Campus Patrocínio', '2018-11-01', 4.00, 2.00, 'Atividade-artístico-cultural-Festa-Junina.pdf', 'Dancei quadrilha.', 25, 6, '2018-11-03 17:37:48', '2018-11-03 17:37:48'),
(14, 'Desafios e tendências na gestão de negócios cases Ipiranga e Bobs', 2, 'IFTM - Instituto Federal do Triângulo Mineiro Campus Patrocínio', '2018-10-09', 4.00, 1.60, 'Desafios-e-tendências-na-gestão-de-negócios-cases-Ipiranga-e-Bobs.pdf', 'Feira', 9, 6, '2018-11-03 17:39:50', '2018-11-03 17:39:50'),
(22, 'Cidadania', 2, 'IFTM - Instituto Federal do Triângulo Mineiro Campus Patrocínio', '2018-11-28', 67.00, 33.50, 'Certificado-de-Cidadania.pdf', 'Aprendi cidadania', 1, 5, '2018-11-27 18:39:27', '2018-11-27 18:39:27'),
(26, 'Curso de Java', 1, 'CursoemVideo.com', '2017-03-02', 40.00, 16.00, '232651201811295c0075bbdb8cd.pdf', 'Aprendi Java.', 5, 3, '2018-11-30 01:26:52', '2018-11-30 01:26:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

CREATE TABLE `instituicao` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localidade` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `instituicao`
--

INSERT INTO `instituicao` (`id`, `nome`, `localidade`, `created_at`, `updated_at`) VALUES
(1, 'Instituto Federal do Triângulo Mineiro', 'Patrocínio - MG', '2018-10-12 23:33:47', '2018-10-12 23:33:47');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_07_09_183200_create_instituicaos_table', 1),
(4, '2018_07_09_184311_create_modelos_table', 1),
(5, '2018_07_10_134639_create_admins_table', 1),
(6, '2018_07_18_130320_create_supervisores_table', 1),
(7, '2018_07_20_194737_create_turmas_table', 1),
(8, '2018_07_21_115232_create_alunos_table', 1),
(9, '2018_08_03_134509_create_modalidades_table', 1),
(10, '2018_09_09_185029_create_semestres_table', 1),
(11, '2018_09_09_185708_create_categorias_table', 1),
(12, '2018_09_09_192047_create_certificados_table', 1),
(14, '2018_09_09_214108_create_aluno_certificados_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modalidades`
--

CREATE TABLE `modalidades` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `modalidades`
--

INSERT INTO `modalidades` (`id`, `name`, `modelo_id`, `created_at`, `updated_at`) VALUES
(6, 'Atividades de Ensino', 1, '2018-10-13 00:20:44', '2018-10-13 00:20:44'),
(7, 'Atividades de Pesquisa', 1, '2018-10-13 00:23:36', '2018-10-13 00:23:36'),
(8, 'Atividades de Extensão', 1, '2018-10-13 00:24:08', '2018-10-13 00:24:20'),
(9, 'Atividades Artístico-Cultural', 1, '2018-10-13 00:25:05', '2018-10-13 00:25:05'),
(10, 'Atividades Esportivas', 1, '2018-10-13 00:25:26', '2018-10-13 00:25:26'),
(11, 'Atividades Sociais e Ambientais', 1, '2018-10-13 01:37:14', '2018-10-13 01:37:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo`
--

CREATE TABLE `modelo` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomeM` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataCriacao` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `modelo`
--

INSERT INTO `modelo` (`id`, `nomeM`, `dataCriacao`, `created_at`, `updated_at`) VALUES
(1, 'ADS - IFTM', '2018-10-12', '2018-10-12 20:41:02', '2018-10-12 20:41:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo_modalidade`
--

CREATE TABLE `modelo_modalidade` (
  `id` int(10) UNSIGNED NOT NULL,
  `modelo_id` int(10) UNSIGNED DEFAULT NULL,
  `modalidade_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `modelo_modalidade`
--

INSERT INTO `modelo_modalidade` (`id`, `modelo_id`, `modalidade_id`, `created_at`, `updated_at`) VALUES
(4, 1, 6, '2018-10-13 00:20:44', '2018-10-13 00:20:44'),
(5, 1, 7, '2018-10-13 00:23:37', '2018-10-13 00:23:37'),
(6, 1, 8, '2018-10-13 00:24:08', '2018-10-13 00:24:08'),
(7, 1, 8, '2018-10-13 00:24:20', '2018-10-13 00:24:20'),
(8, 1, 9, '2018-10-13 00:25:06', '2018-10-13 00:25:06'),
(9, 1, 10, '2018-10-13 00:25:26', '2018-10-13 00:25:26'),
(10, 1, 11, '2018-10-13 01:37:14', '2018-10-13 01:37:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('brunoweberty@hotmail.com', '$2y$10$bntBrqS3k.wu6r7hgh9IBOG6fQEXo80YtRMTXFf.UHjVV6ueCSgD2', '2018-11-03 20:55:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `semestre`
--

CREATE TABLE `semestre` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomeS` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inicioSemestre` date NOT NULL,
  `fimSemestre` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `semestre`
--

INSERT INTO `semestre` (`id`, `nomeS`, `inicioSemestre`, `fimSemestre`, `created_at`, `updated_at`) VALUES
(1, '1° Semestre de 2016', '2016-02-11', '2016-06-17', '2018-10-13 01:58:40', '2018-10-13 01:58:40'),
(2, '2° Semestre de 2016', '2016-07-26', '2016-11-27', '2018-10-13 01:59:59', '2018-10-13 01:59:59'),
(3, '1° Semestre de 2017', '2017-02-06', '2017-06-14', '2018-10-13 02:01:26', '2018-10-13 02:01:26'),
(4, '2° Semestre de 2017', '2017-07-26', '2017-12-01', '2018-10-13 02:02:17', '2018-10-13 02:02:17'),
(5, '1° Semestre de 2018', '2018-02-05', '2018-06-15', '2018-10-13 02:05:45', '2018-10-13 02:05:45'),
(6, '2° Semestre de 2018', '2018-07-25', '2018-11-30', '2018-10-13 02:06:49', '2018-10-13 02:06:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `supervisores`
--

CREATE TABLE `supervisores` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricula` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instituicao_id` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `supervisores`
--

INSERT INTO `supervisores` (`id`, `name`, `email`, `password`, `matricula`, `instituicao_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Marcos de Albuquerque Lacerda', 'marcos@hotmail.com', '$2y$10$bALXfyPYHB19H8sCDDuuA.w00jEQcTH9p3GGttg8jlD7IkvNO/71C', '100100100101', 1, 'toto', '2018-10-12 23:39:22', '2018-10-12 23:39:22'),
(5, 'Gilberto', 'gilberto@hotmail.com', '$2y$10$wnjZxMw80grGp2k9nBekXeLf1vyI/5Mg1BnvUJ.Ul9AIkUd2Zmvha', '516236215', 1, 'toto', '2018-11-28 21:57:42', '2018-11-28 21:57:42');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `id` int(10) UNSIGNED NOT NULL,
  `nameT` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `curso` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalHora` double(8,2) NOT NULL,
  `supervisor_id` int(10) UNSIGNED DEFAULT NULL,
  `instituicao_id` int(10) UNSIGNED DEFAULT NULL,
  `modelo_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id`, `nameT`, `curso`, `codigo`, `totalHora`, `supervisor_id`, `instituicao_id`, `modelo_id`, `created_at`, `updated_at`) VALUES
(1, 'ADS', 'Análise e Desenvolvimento de Sistemas', 'ashuHAjlKJJl64m', 75.00, 1, 1, 1, '2018-10-12 23:41:16', '2018-10-12 23:41:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alunos_email_unique` (`email`),
  ADD KEY `alunos_instituicao_id_foreign` (`instituicao_id`),
  ADD KEY `alunos_turma_id_foreign` (`turma_id`);

--
-- Indexes for table `aluno_certificado`
--
ALTER TABLE `aluno_certificado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_certificado_aluno_id_foreign` (`aluno_id`),
  ADD KEY `aluno_certificado_certificado_id_foreign` (`certificado_id`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_modalidade_id_foreign` (`modalidade_id`);

--
-- Indexes for table `certificado`
--
ALTER TABLE `certificado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certificado_categoria_id_foreign` (`categoria_id`),
  ADD KEY `certificado_semestre_id_foreign` (`semestre_id`);

--
-- Indexes for table `instituicao`
--
ALTER TABLE `instituicao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modalidades`
--
ALTER TABLE `modalidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modalidades_modelo_id_foreign` (`modelo_id`);

--
-- Indexes for table `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modelo_modalidade`
--
ALTER TABLE `modelo_modalidade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modelo_modalidade_modelo_id_foreign` (`modelo_id`),
  ADD KEY `modelo_modalidade_modalidade_id_foreign` (`modalidade_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisores`
--
ALTER TABLE `supervisores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supervisores_email_unique` (`email`),
  ADD KEY `supervisores_instituicao_id_foreign` (`instituicao_id`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `turma_supervisor_id_foreign` (`supervisor_id`),
  ADD KEY `turma_instituicao_id_foreign` (`instituicao_id`),
  ADD KEY `turma_modelo_id_foreign` (`modelo_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `aluno_certificado`
--
ALTER TABLE `aluno_certificado`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `certificado`
--
ALTER TABLE `certificado`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `instituicao`
--
ALTER TABLE `instituicao`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `modalidades`
--
ALTER TABLE `modalidades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `modelo_modalidade`
--
ALTER TABLE `modelo_modalidade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `semestre`
--
ALTER TABLE `semestre`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `supervisores`
--
ALTER TABLE `supervisores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_instituicao_id_foreign` FOREIGN KEY (`instituicao_id`) REFERENCES `instituicao` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alunos_turma_id_foreign` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `aluno_certificado`
--
ALTER TABLE `aluno_certificado`
  ADD CONSTRAINT `aluno_certificado_aluno_id_foreign` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aluno_certificado_certificado_id_foreign` FOREIGN KEY (`certificado_id`) REFERENCES `certificado` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_modalidade_id_foreign` FOREIGN KEY (`modalidade_id`) REFERENCES `modalidades` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `certificado`
--
ALTER TABLE `certificado`
  ADD CONSTRAINT `certificado_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `certificado_semestre_id_foreign` FOREIGN KEY (`semestre_id`) REFERENCES `semestre` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `modalidades`
--
ALTER TABLE `modalidades`
  ADD CONSTRAINT `modalidades_modelo_id_foreign` FOREIGN KEY (`modelo_id`) REFERENCES `modelo` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `modelo_modalidade`
--
ALTER TABLE `modelo_modalidade`
  ADD CONSTRAINT `modelo_modalidade_modalidade_id_foreign` FOREIGN KEY (`modalidade_id`) REFERENCES `modalidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `modelo_modalidade_modelo_id_foreign` FOREIGN KEY (`modelo_id`) REFERENCES `modelo` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `supervisores`
--
ALTER TABLE `supervisores`
  ADD CONSTRAINT `supervisores_instituicao_id_foreign` FOREIGN KEY (`instituicao_id`) REFERENCES `instituicao` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `turma_instituicao_id_foreign` FOREIGN KEY (`instituicao_id`) REFERENCES `instituicao` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `turma_modelo_id_foreign` FOREIGN KEY (`modelo_id`) REFERENCES `modelo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `turma_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisores` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
