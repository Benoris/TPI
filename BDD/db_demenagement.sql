-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 18 Mai 2017 à 16:35
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db_demenagement`
--

-- --------------------------------------------------------

--
-- Structure de la table `r_ajouter`
--

CREATE TABLE IF NOT EXISTS `r_ajouter` (
  `idDevis` int(11) NOT NULL,
  `idOption` int(11) NOT NULL,
  `M3` int(5) NOT NULL,
  PRIMARY KEY (`idDevis`,`idOption`),
  KEY `FK_R_AJOUTER_idOption` (`idOption`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `r_ajouter`
--

INSERT INTO `r_ajouter` (`idDevis`, `idOption`, `M3`) VALUES
(11, 1, 1),
(11, 2, 2),
(11, 3, 3),
(11, 4, 4),
(11, 5, 5),
(11, 6, 1),
(11, 7, 0),
(11, 8, 0),
(11, 9, 0),
(11, 10, 0),
(11, 11, 0),
(11, 12, 0),
(11, 13, 0),
(11, 14, 0),
(11, 15, 0),
(11, 16, 0),
(11, 17, 0),
(11, 18, 0),
(11, 19, 0),
(11, 20, 0),
(11, 21, 0),
(11, 22, 0),
(11, 23, 0),
(11, 24, 0),
(11, 25, 0),
(11, 26, 0),
(11, 27, 0),
(11, 28, 0),
(11, 29, 0),
(11, 30, 0),
(11, 31, 0),
(11, 32, 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_clients`
--

CREATE TABLE IF NOT EXISTS `t_clients` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(40) COLLATE utf8_bin NOT NULL,
  `Email` varchar(50) COLLATE utf8_bin NOT NULL,
  `Password` varchar(70) COLLATE utf8_bin NOT NULL,
  `UserMode` tinyint(1) NOT NULL,
  PRIMARY KEY (`idClient`),
  UNIQUE KEY `Login` (`Login`,`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `t_clients`
--

INSERT INTO `t_clients` (`idClient`, `Login`, `Email`, `Password`, `UserMode`) VALUES
(1, 'admin', 'admin@furnigo.com', 'f6889fc97e14b42dec11a8c183ea791c5465b658', 1),
(2, 'Tony', 'maurice.dinh@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_detail`
--

CREATE TABLE IF NOT EXISTS `t_detail` (
  `idDetail` int(11) NOT NULL AUTO_INCREMENT,
  `DescriptionObjetOuLieu` text COLLATE utf8_bin NOT NULL,
  `VolumeApproxM3` int(11) NOT NULL,
  `SurfaceApproxM2` int(11) NOT NULL,
  `PoidsKg` int(11) NOT NULL,
  `idDevis` int(11) NOT NULL,
  PRIMARY KEY (`idDetail`),
  KEY `FK_T_DETAIL_idDevis_T_DEVIS` (`idDevis`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;

--
-- Contenu de la table `t_detail`
--

INSERT INTO `t_detail` (`idDetail`, `DescriptionObjetOuLieu`, `VolumeApproxM3`, `SurfaceApproxM2`, `PoidsKg`, `idDevis`) VALUES
(11, 'Manoir Van Holten', 7000, 1000, 40000, 11);

-- --------------------------------------------------------

--
-- Structure de la table `t_devis`
--

CREATE TABLE IF NOT EXISTS `t_devis` (
  `idDevis` int(11) NOT NULL AUTO_INCREMENT,
  `Montant` int(11) NOT NULL,
  `DateDevis` date NOT NULL,
  `TotalM3` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  PRIMARY KEY (`idDevis`),
  KEY `FK_T_DEVIS_idClient` (`idClient`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;

--
-- Contenu de la table `t_devis`
--

INSERT INTO `t_devis` (`idDevis`, `Montant`, `DateDevis`, `TotalM3`, `idClient`) VALUES
(11, 3045, '2017-05-18', 16, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_forfait`
--

CREATE TABLE IF NOT EXISTS `t_forfait` (
  `idForfait` int(11) NOT NULL AUTO_INCREMENT,
  `Forfait` text COLLATE utf8_bin NOT NULL,
  `Description` text COLLATE utf8_bin NOT NULL,
  `Prix` int(15) NOT NULL,
  PRIMARY KEY (`idForfait`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Contenu de la table `t_forfait`
--

INSERT INTO `t_forfait` (`idForfait`, `Forfait`, `Description`, `Prix`) VALUES
(1, 'Grand confort', 'Emballage complet par l''entreprise', 1500),
(2, 'Confort', 'Emballage des éléments fragiles', 1000),
(3, 'Dynamic', 'Déménagement seul sans emballage', 750),
(4, 'Mobilier seuls', 'Déménagement des meubles vides seulement', 500);

-- --------------------------------------------------------

--
-- Structure de la table `t_options`
--

CREATE TABLE IF NOT EXISTS `t_options` (
  `idOption` int(11) NOT NULL AUTO_INCREMENT,
  `DescriptionDetaillee` text CHARACTER SET utf8 NOT NULL,
  `PrixSupplementDeBase` float NOT NULL,
  `PrixAuM3` float NOT NULL,
  PRIMARY KEY (`idOption`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=33 ;

--
-- Contenu de la table `t_options`
--

INSERT INTO `t_options` (`idOption`, `DescriptionDetaillee`, `PrixSupplementDeBase`, `PrixAuM3`) VALUES
(1, 'Emballage du petit linge (effets personnels)', 60, 15),
(2, 'Emballage du linge de maison (cartons)', 100, 25),
(3, 'Emballage des livres', 50, 50),
(4, 'Emballage divers, matériels et objets non fragiles', 150, 60),
(5, 'Emballage de la vaisselle et objets fragiles en caisses et/ou valises "demécrin"', 150, 100),
(6, 'Emballage des vêtements sur cintres en penderie portable ', 50, 40),
(7, 'Emballage télévision, hi-fi, vidéo, laser, informatique ', 200, 60),
(8, 'Démontage des meubles, si nécessaire ', 100, 40),
(9, 'Protection des meubles ', 150, 80),
(10, 'Protection des matelas, sommiers... (sous housses) ', 60, 30),
(11, 'Nettoyage', 300, 40),
(12, 'Déménagement de charges lourdes (piano, aquarium, billard, coffre-fort, etc...)', 300, 50),
(13, 'Fourniture d''emballages avant le déménagement (enlèvement par les soins du client)', 40, 20),
(14, 'Manutention au départ pour chargement', 200, 10),
(15, 'Calage, arrimage et transport en fourgon ou caisse mobile capitonné', 150, 30),
(16, 'Manutention à l''arrivée pour déchargement', 150, 10),
(17, 'Emballage de la cave, du garage ', 150, 40),
(18, 'Déménagement de la cave, du garage ', 100, 10),
(19, 'Mise en place du mobilier (selon vos directives) ', 150, 40),
(20, 'Remontage des meubles démontés par nos soins ', 120, 50),
(21, 'Déballage de la vaisselle et objets fragiles en caisses et/ou valise, "demécrin"', 50, 30),
(22, 'Déballage des vêtements sur cintres en penderie portable', 50, 10),
(23, 'Déballage télévision, hi-fi, magnétoscope laser, micro-informatique emballés par nos soins ', 50, 30),
(24, 'Déballage des cartons "linge"', 40, 10),
(25, 'Déballage des cartons "livres"', 40, 20),
(26, 'Déballage des cartons "divers", matériels et objets non fragiles conditionnés par nos soins ', 50, 30),
(27, 'Transport des plantes (sans garantie de l''état phytosanitaire des plantes à l''arrivée) ', 70, 50),
(28, 'Décrochage des rideaux et tentures ', 40, 20),
(29, 'Décrochage des lustres et glaces', 100, 70),
(30, 'Démontage des éléments de cuisine', 100, 50),
(31, 'Déconnexion et reconnexion électriques des appareils électroménagers, hi-fi, informatique, vidéo, \r\ntélévision, etc.', 80, 10),
(32, 'Déconnexion et reconnexion des alimentations en eaux et des appareils électroménagers (Les contrôles \r\nde sécurité des installations après le départ des déménageurs sont à la charge exclusive du client)', 150, 80);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `r_ajouter`
--
ALTER TABLE `r_ajouter`
  ADD CONSTRAINT `FK_R_AJOUTER_idDevis` FOREIGN KEY (`idDevis`) REFERENCES `t_devis` (`idDevis`);

--
-- Contraintes pour la table `t_detail`
--
ALTER TABLE `t_detail`
  ADD CONSTRAINT `FK_T_DETAIL_idDevis_T_DEVIS` FOREIGN KEY (`idDevis`) REFERENCES `t_devis` (`idDevis`);

--
-- Contraintes pour la table `t_devis`
--
ALTER TABLE `t_devis`
  ADD CONSTRAINT `FK_T_DEVIS_idClient` FOREIGN KEY (`idClient`) REFERENCES `t_clients` (`idClient`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
