-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2016 at 10:44 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestcami`
--

-- --------------------------------------------------------

--
-- Table structure for table `camion`
--

CREATE TABLE IF NOT EXISTS `camion` (
  `ID_CAMION` int(11) NOT NULL,
  `MATRICULE` longtext NOT NULL,
  `TONNAGE` longtext,
  `DATE_MODIF_CAM` date DEFAULT NULL,
  `DATE_CREAT_CAM` date NOT NULL,
  `COULEUR` varchar(255) DEFAULT NULL,
  `MARQUE` varchar(255) DEFAULT NULL,
  `PHOTO` varchar(255) DEFAULT NULL,
  `ID_TRANSPORTEUR` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `camion`
--

INSERT INTO `camion` (`ID_CAMION`, `MATRICULE`, `TONNAGE`, `DATE_MODIF_CAM`, `DATE_CREAT_CAM`, `COULEUR`, `MARQUE`, `PHOTO`, `ID_TRANSPORTEUR`) VALUES
(12, 'ozjuihfizuh', 'uhfizuhgfz', '2016-10-02', '2016-09-20', '#000000', 'fopif', '', 2),
(14, 'ifurhgiu', 'iuhgirurgz', '2016-10-02', '2016-09-20', '#000000', 'aizuf', '', 7),
(18, 'iuhfziu', 'hifuhf', '2016-10-02', '2016-09-20', '#004080', 'roizfgz', '', 5),
(19, 'ofizjf', 'oijogirgz', '2016-10-02', '2016-09-20', '#008000', 'oaifoiz', '', 7),
(20, 'fghjkftgh', '5741', '2016-10-02', '2016-09-26', '#000000', 'kanfoai', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chauffeur`
--

CREATE TABLE IF NOT EXISTS `chauffeur` (
  `ID_CHAUFFEUR` int(11) NOT NULL,
  `ID_CAMION` int(11) NOT NULL,
  `NOM_CHAUFFEUR` longtext NOT NULL,
  `NUMEROCNI` varchar(255) NOT NULL,
  `STATUS_CHAUFFEUR` tinyint(1) DEFAULT NULL,
  `CONTACT` int(11) DEFAULT NULL,
  `DATE_MODIF_CHAUF` date DEFAULT NULL,
  `DATE_CREAT_CHAUF` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chauffeur`
--

INSERT INTO `chauffeur` (`ID_CHAUFFEUR`, `ID_CAMION`, `NOM_CHAUFFEUR`, `NUMEROCNI`, `STATUS_CHAUFFEUR`, `CONTACT`, `DATE_MODIF_CHAUF`, `DATE_CREAT_CHAUF`) VALUES
(13, 12, 'fzofhi', 'goijzr', 1, 552152122, '2016-10-02', '2016-09-20'),
(14, 18, 'vzivuh', 'ifuzhf', 1, 654987585, '2016-09-21', '2016-09-20'),
(15, 12, 'pfozgio', 'khjzvizu', 1, 649877899, '2016-09-21', '2016-09-21'),
(16, 12, 'ttfghj', 'gfhhjkl', 0, 654, '2016-09-27', '2016-09-27'),
(17, 14, 'ois', 'ZFZ6585985', 1, 695845888, '2016-10-02', '2016-10-02');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `ID_CLIENT` int(11) NOT NULL,
  `NOM` varchar(255) NOT NULL,
  `DATE_CREAT_CLIENT` date DEFAULT NULL,
  `DATE_MODIF_CLIENT` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ID_CLIENT`, `NOM`, `DATE_CREAT_CLIENT`, `DATE_MODIF_CLIENT`) VALUES
(1, 'fiuhf', '2016-09-27', '2016-09-27');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `ID_PRODUIT` int(11) NOT NULL,
  `NOM_PRODUIT` longtext,
  `DESCRIPTION` longtext,
  `DATE_MODIF_PRO` date DEFAULT NULL,
  `DATE_CREAT_PRO` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`ID_PRODUIT`, `NOM_PRODUIT`, `DESCRIPTION`, `DATE_MODIF_PRO`, `DATE_CREAT_PRO`) VALUES
(2, 'ofizjffiuzf', 'oijfozig', '2016-09-20', '2016-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `ID_SITE` int(11) NOT NULL,
  `NOM_SITE` longtext NOT NULL,
  `REGION_SITE` longtext,
  `DATE_MODIF_SITE` date DEFAULT NULL,
  `DATE_CREAT_SITE` date DEFAULT NULL,
  `PRIX_FACTURE` float DEFAULT NULL,
  `PRIX_TRANSPORT` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`ID_SITE`, `NOM_SITE`, `REGION_SITE`, `DATE_MODIF_SITE`, `DATE_CREAT_SITE`, `PRIX_FACTURE`, `PRIX_TRANSPORT`) VALUES
(1, 'fzij', 'oijfzoi', '2016-09-20', '2016-09-20', 33, 65),
(2, 'oizu', 'fozijf', '2016-09-28', '2016-09-28', 15, 25);

-- --------------------------------------------------------

--
-- Table structure for table `transporteur`
--

CREATE TABLE IF NOT EXISTS `transporteur` (
  `ID_TRANSPORTEUR` int(11) NOT NULL,
  `NOM_TRANSPORTEUR` char(255) NOT NULL,
  `DATE_CREAT_TRANSPORT` date DEFAULT NULL,
  `DATE_MODIF_TRANSPORT` date DEFAULT NULL,
  `CONTACT` varchar(100) DEFAULT NULL,
  `DOSSIER_FISCALE` varchar(255) DEFAULT NULL,
  `NAME_INTERNE` varchar(255) DEFAULT NULL,
  `NUMERO_INTERNE` varchar(255) DEFAULT NULL,
  `TMP` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transporteur`
--

INSERT INTO `transporteur` (`ID_TRANSPORTEUR`, `NOM_TRANSPORTEUR`, `DATE_CREAT_TRANSPORT`, `DATE_MODIF_TRANSPORT`, `CONTACT`, `DOSSIER_FISCALE`, `NAME_INTERNE`, `NUMERO_INTERNE`, `TMP`) VALUES
(1, 'fzaifh', '2016-09-20', '2016-09-22', '699669584', 'upload/01ad00e24e0589b14af7edc390eeb915.jpg', 'iufgzhfiu', '696996697/674574574/666958557', 'C:\\xampp2\\tmp\\php7B08.tmp'),
(2, 'ofzijfio', '2016-09-22', '2016-09-22', '695949558', 'upload/4e1b1c1d8d9ee27038d163e7fe2607b9.jpg', 'loioloi', '695984885/654989866/656565656', 'C:\\xampp2\\tmp\\php4DDB.tmp'),
(5, 'lfjhzoif', '2016-09-22', '2016-09-22', 'oijfroifj', 'upload/4e1b1c1d8d9ee27038d163e7fe2607b9.jpg', 'oiuzhfgoi', '651656984/984654984/95486548', NULL),
(6, 'gorigj', '2016-09-26', '2016-09-26', '6549898746', 'upload/fiscales/fisc_gorigj/d1327c22df251036a21ea388040dad16.jpg--upload/fiscales/fisc_gorigj/8fc2fa3c2cb4ca98d3995e151c8838eb.jpg', 'fzogijzoi', '956849866/979879879/487456565', NULL),
(7, 'igurh', '2016-09-26', '2016-09-26', '', 'upload/fiscales/fisc_igurh/e35cdc7d660be13670f6d3460e00c8fd.jpg--upload/fiscales/fisc_igurh/2c413f961caf36bc997ab4c88a1747eb.jpg', 'yghjkl', '959529487/982984959/98598598', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID_USER` int(11) NOT NULL,
  `NOM_USER` char(100) DEFAULT NULL,
  `PRENOM_USER` char(100) DEFAULT NULL,
  `PSEUDO_USER` char(100) NOT NULL,
  `PASSWORD_USER` char(100) NOT NULL,
  `POSTE` char(100) DEFAULT NULL,
  `DATE_CREAT_USER` date DEFAULT NULL,
  `DATE_MODIF_USER` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`ID_USER`, `NOM_USER`, `PRENOM_USER`, `PSEUDO_USER`, `PASSWORD_USER`, `POSTE`, `DATE_CREAT_USER`, `DATE_MODIF_USER`) VALUES
(1, 'niat', 'lee', 'mars007', '4a7d1ed414474e4033ac29ccb8653d9b', 'informaticien', '2016-09-17', '2016-09-19'),
(3, 'fzoif', 'oifjgz', 'oifjgz', '9208a20086ebfef780143c1fa4262e79', 'iuzanfoza', '2016-09-19', '2016-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `voyage`
--

CREATE TABLE IF NOT EXISTS `voyage` (
  `ID_VOYAGE` int(11) NOT NULL,
  `ID_SITE` int(11) NOT NULL,
  `ID_CHAUFFEUR` int(11) NOT NULL,
  `ID_PRODUIT` int(11) NOT NULL,
  `SIT_ID_SITE` int(11) NOT NULL,
  `TONNAGE_DEPART` float DEFAULT '0',
  `TONNAGE_ARRIVE` float DEFAULT '0',
  `PERMUTATION` int(11) DEFAULT NULL,
  `STATUS_VOYAGE` tinyint(4) DEFAULT '0',
  `DESCRIPTION_VOYAGE` longtext,
  `DIFFERENCE_POIDS` float DEFAULT '0',
  `NOMBRE_SAC` int(11) DEFAULT '0',
  `INCIDENT_SURVENU` longtext,
  `PAIEMENT` float DEFAULT '0',
  `COMMISSION` float DEFAULT '0',
  `DATE_MODIFICATION` date DEFAULT NULL,
  `DATE_CREATION` date DEFAULT NULL,
  `AVANCE_PAIEMENT` float DEFAULT '0',
  `DEPENSE_JUBENROS` float DEFAULT '0',
  `FACTURATION_TRANSPORTEUR` float DEFAULT '0',
  `FACTURATION_CHAUFFEUR` float DEFAULT '0',
  `REVENU_JUBENROS` float DEFAULT NULL,
  `DEPENSE_TOTAL` float DEFAULT '0',
  `REVENU_TOTAL` float DEFAULT '0',
  `ID_CLIENT` int(11) DEFAULT NULL,
  `ANNULATION` tinyint(4) DEFAULT '0',
  `AUTRE_DEPENSE` float DEFAULT '0',
  `TONNAGE_TRANS` float DEFAULT '0',
  `FRAIS_DEMARCHEUR` float DEFAULT '10000',
  `NUM_RECU` varchar(20) DEFAULT NULL,
  `NUM_BE` varchar(20) DEFAULT NULL,
  `FINAL` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voyage`
--

INSERT INTO `voyage` (`ID_VOYAGE`, `ID_SITE`, `ID_CHAUFFEUR`, `ID_PRODUIT`, `SIT_ID_SITE`, `TONNAGE_DEPART`, `TONNAGE_ARRIVE`, `PERMUTATION`, `STATUS_VOYAGE`, `DESCRIPTION_VOYAGE`, `DIFFERENCE_POIDS`, `NOMBRE_SAC`, `INCIDENT_SURVENU`, `PAIEMENT`, `COMMISSION`, `DATE_MODIFICATION`, `DATE_CREATION`, `AVANCE_PAIEMENT`, `DEPENSE_JUBENROS`, `FACTURATION_TRANSPORTEUR`, `FACTURATION_CHAUFFEUR`, `REVENU_JUBENROS`, `DEPENSE_TOTAL`, `REVENU_TOTAL`, `ID_CLIENT`, `ANNULATION`, `AUTRE_DEPENSE`, `TONNAGE_TRANS`, `FRAIS_DEMARCHEUR`, `NUM_RECU`, `NUM_BE`, `FINAL`) VALUES
(1, 1, 13, 2, 2, 58.25, 57.56, 14, 1, 'tyuiobgvfjhgfrugirjhgfuyikj', -0.69, 250, 'uyfsfuzy uyz fuzy uzyghuzg ', 0, 0, '2016-10-02', '2016-09-27', 15255, 1914000, 3640000, 65000, 0, 0, 3705000, 1, 0, 15000, 56, 10000, '400', 'fz656t', 1),
(3, 2, 14, 2, 1, 58.235, 57.152, 20, 1, 'kvrorob,robi,rori ,orih,orih,or i,ho ri,', -1.083, 235, 'kzifoizoviz,v', 0, 0, '2016-10-02', '2016-09-23', 4000, 855000, 1400000, 25000, 0, 0, 0, 1, 0, 0, 56, 10000, '401', '6QS55', 1),
(6, 1, 16, 2, 1, 57.362, 0, 14, 0, 'viuzhfizuhfiz ugozk,gosijvoisgrof', 0, 0, '', 0, 0, '2016-10-01', '2016-09-25', 14000, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 10000, '402', '', 0),
(8, 1, 14, 2, 1, 58.688, 0, NULL, 0, NULL, 0, 0, '', 0, 0, '2016-09-29', '2016-09-29', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 10000, '403', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `camion`
--
ALTER TABLE `camion`
  ADD PRIMARY KEY (`ID_CAMION`),
  ADD KEY `camion_transporteur__fk` (`ID_TRANSPORTEUR`);

--
-- Indexes for table `chauffeur`
--
ALTER TABLE `chauffeur`
  ADD PRIMARY KEY (`ID_CHAUFFEUR`),
  ADD KEY `FK_UTILISER` (`ID_CAMION`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_CLIENT`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`ID_PRODUIT`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`ID_SITE`);

--
-- Indexes for table `transporteur`
--
ALTER TABLE `transporteur`
  ADD PRIMARY KEY (`ID_TRANSPORTEUR`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indexes for table `voyage`
--
ALTER TABLE `voyage`
  ADD PRIMARY KEY (`ID_VOYAGE`),
  ADD KEY `FK_VOYAGE` (`SIT_ID_SITE`),
  ADD KEY `FK_VOYAGE2` (`ID_SITE`),
  ADD KEY `FK_VOYAGE3` (`ID_CHAUFFEUR`),
  ADD KEY `FK_VOYAGE4` (`ID_PRODUIT`),
  ADD KEY `voyage_camion__fk` (`PERMUTATION`),
  ADD KEY `voyage_client__fk` (`ID_CLIENT`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `camion`
--
ALTER TABLE `camion`
  MODIFY `ID_CAMION` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `chauffeur`
--
ALTER TABLE `chauffeur`
  MODIFY `ID_CHAUFFEUR` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `ID_PRODUIT` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `ID_SITE` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transporteur`
--
ALTER TABLE `transporteur`
  MODIFY `ID_TRANSPORTEUR` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `voyage`
--
ALTER TABLE `voyage`
  MODIFY `ID_VOYAGE` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `camion`
--
ALTER TABLE `camion`
  ADD CONSTRAINT `camion_transporteur__fk` FOREIGN KEY (`ID_TRANSPORTEUR`) REFERENCES `transporteur` (`ID_TRANSPORTEUR`);

--
-- Constraints for table `chauffeur`
--
ALTER TABLE `chauffeur`
  ADD CONSTRAINT `FK_UTILISER` FOREIGN KEY (`ID_CAMION`) REFERENCES `camion` (`ID_CAMION`);

--
-- Constraints for table `voyage`
--
ALTER TABLE `voyage`
  ADD CONSTRAINT `FK_VOYAGE` FOREIGN KEY (`SIT_ID_SITE`) REFERENCES `site` (`ID_SITE`),
  ADD CONSTRAINT `FK_VOYAGE2` FOREIGN KEY (`ID_SITE`) REFERENCES `site` (`ID_SITE`),
  ADD CONSTRAINT `FK_VOYAGE3` FOREIGN KEY (`ID_CHAUFFEUR`) REFERENCES `chauffeur` (`ID_CHAUFFEUR`),
  ADD CONSTRAINT `FK_VOYAGE4` FOREIGN KEY (`ID_PRODUIT`) REFERENCES `produit` (`ID_PRODUIT`),
  ADD CONSTRAINT `voyage_camion__fk` FOREIGN KEY (`PERMUTATION`) REFERENCES `camion` (`ID_CAMION`),
  ADD CONSTRAINT `voyage_client__fk` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
