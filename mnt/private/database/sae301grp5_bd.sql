-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 08 jan. 2025 à 10:56
-- Version du serveur : 10.11.6-MariaDB-0+deb12u1
-- Version de PHP : 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae301grp5_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `APPRENDRE`
--

CREATE TABLE `APPRENDRE` (
  `FOR_ID` int(4) NOT NULL,
  `UTI_ID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `APTITUDE`
--

CREATE TABLE `APTITUDE` (
  `APT_ID` int(4) NOT NULL,
  `COM_ID` int(4) NOT NULL,
  `APT_LIBELLE` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `APTITUDE`
--

INSERT INTO `APTITUDE` (`APT_ID`, `COM_ID`, `APT_LIBELLE`) VALUES
(1, 1, 'Gréage et dégréage'),
(2, 1, 'Capelage et décapelage'),
(3, 1, 'Choix de son matériel personnel'),
(4, 2, 'Saut droit'),
(5, 2, 'Bascule arrière'),
(6, 2, 'Départ plage'),
(7, 2, 'Sortir de l’eau'),
(8, 3, 'Canard'),
(9, 3, 'Phoque'),
(10, 4, 'Palmage ventral en surface'),
(11, 4, 'Palmage dorsal'),
(12, 4, 'Palmage de sustentation'),
(13, 4, 'Palmage en immersion'),
(14, 4, 'Nage en capelé'),
(15, 5, 'Ventilation en immersion'),
(16, 5, 'Ventilation sur tuba et vidage du tuba'),
(17, 5, 'Vidage du masque'),
(18, 5, 'Lâcher et reprise d’embout'),
(19, 6, 'Gestion du gilet de stabilisation'),
(20, 6, 'Poumon ballast'),
(21, 7, 'Exécution des signes conventionnels'),
(22, 8, 'Application des procédures mises e œuvre par le GP'),
(23, 8, 'Intervention en relai'),
(24, 9, 'Aisance aquatique'),
(25, 10, 'Maîtrise de la vitesse de remontée'),
(30, 11, 'Ventilation en surface\r\net en immersion'),
(31, 11, 'Vidage du masque'),
(32, 11, 'Stabilisation'),
(33, 12, 'Connaissance de tous les signes\r\net codes'),
(34, 13, 'Gestion de la désaturation'),
(35, 13, 'Gestion d’une remontée isolée');

-- --------------------------------------------------------

--
-- Structure de la table `CLUB`
--

CREATE TABLE `CLUB` (
  `CLU_ID` int(4) NOT NULL,
  `UTI_ID` int(4) DEFAULT NULL,
  `CLU_NOM` char(32) NOT NULL,
  `CLU_VILLE` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CLUB`
--



-- --------------------------------------------------------

--
-- Structure de la table `COMPETENCE`
--

CREATE TABLE `COMPETENCE` (
  `COM_ID` int(4) NOT NULL,
  `NIV_ID` int(4) NOT NULL,
  `COM_LIBELLE` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `COMPETENCE`
--

INSERT INTO `COMPETENCE` (`COM_ID`, `NIV_ID`, `COM_LIBELLE`) VALUES
(1, 1, 'S\'équiper et se déséquiper'),
(2, 1, 'Se mettre à l\'eau et en sortir'),
(3, 1, 'Evoluer dans l\'eau et s\'immerger'),
(4, 1, 'Evoluer dans l\'eau se propulser'),
(5, 1, 'Evoluer dans l\'eau se ventiler'),
(6, 1, 'Évoluer dans l\'eau s\'équilibrer'),
(7, 1, 'Communiquer'),
(8, 1, 'Appliquer les conduites de sécurité'),
(9, 1, 'Respecter le milieu et l\'environnement'),
(10, 1, 'Retourner en surface'),
(11, 2, 'Ventiler et s’équilibrer'),
(12, 2, 'Communiquer avec le GP'),
(13, 2, 'Retourner en surface');

-- --------------------------------------------------------

--
-- Structure de la table `COURS`
--

CREATE TABLE `COURS` (
  `COU_ID` int(4) NOT NULL,
  `FOR_ID` int(4) NOT NULL,
  `COU_DATE` date DEFAULT NULL,
  `COU_LIEU` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `COURS`
--



-- --------------------------------------------------------

--
-- Structure de la table `FORMATION`
--

CREATE TABLE `FORMATION` (
  `FOR_ID` int(4) NOT NULL,
  `NIV_ID` int(4) NOT NULL,
  `UTI_ID` int(4) NOT NULL,
  `CLU_ID` int(4) NOT NULL,
  `FOR_ANNEE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `FORMATION`
--



-- --------------------------------------------------------

--
-- Structure de la table `GROUPE`
--

CREATE TABLE `GROUPE` (
  `COU_ID` int(4) NOT NULL,
  `UTI_ID_ELV2` int(4) DEFAULT NULL,
  `UTI_ID_ELV1` int(4) NOT NULL,
  `UTI_ID_INIT` int(4) NOT NULL,
  `GRO_ID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `GROUPE`
--



-- --------------------------------------------------------

--
-- Structure de la table `INITIER`
--

CREATE TABLE `INITIER` (
  `FOR_ID` int(4) NOT NULL,
  `UTI_ID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `MAITRISER`
--

CREATE TABLE `MAITRISER` (
  `COU_ID` int(4) NOT NULL,
  `UTI_ID` int(4) NOT NULL,
  `APT_ID` int(4) NOT NULL,
  `MAI_PROGRESS` char(32) DEFAULT 'non évaluée',
  `MAI_COMMENTAIRE` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `NIVEAU`
--

CREATE TABLE `NIVEAU` (
  `NIV_ID` int(4) NOT NULL,
  `NIV_DESCRIPTION` char(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `NIVEAU`
--

INSERT INTO `NIVEAU` (`NIV_ID`, `NIV_DESCRIPTION`) VALUES
(0, NULL),
(1, 'Plongeur encadré à 20 m'),
(2, 'Plongeur autonome à 20 m | Plongeur encadré à 40 m'),
(3, 'Plongeur autonome à 60 m'),
(4, NULL),
(5, NULL),
(6, 'Moniteur E1 (initiateur)'),
(7, 'Moniteur E2 (initiateur)'),
(8, 'Moniteur fédéral 1er degré (MF1)'),
(9, 'Moniteur fédéral 2ème degré (MF2)');

-- --------------------------------------------------------

--
-- Structure de la table `UTILISATEUR`
--

CREATE TABLE `UTILISATEUR` (
  `UTI_ID` int(4) NOT NULL,
  `NIV_ID` int(4) NOT NULL,
  `CLU_ID` int(4) NOT NULL,
  `UTI_NOM` char(32) NOT NULL,
  `UTI_PRENOM` char(32) NOT NULL,
  `UTI_MAIL` char(32) NOT NULL,
  `UTI_MDP` char(32) NOT NULL,
  `UTI_DATE_ARCHIVAGE` char(32) DEFAULT NULL,
  `UTI_EST_INIT` tinyint(1) DEFAULT NULL,
  `UTI_LICENCE` char(11) DEFAULT NULL,
  `UTI_DATE_NAISS` date DEFAULT NULL,
  `UTI_DATE_CERTIF` date DEFAULT NULL,
  `UTI_VILLE` char(32) DEFAULT NULL,
  `UTI_CP` text NOT NULL,
  `UTI_RUE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `UTILISATEUR`
--



-- --------------------------------------------------------

--
-- Structure de la table `VALIDER`
--

CREATE TABLE `VALIDER` (
  `UTI_ID` int(4) NOT NULL,
  `APT_ID` int(4) NOT NULL,
  `VAL_STATUT` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `APPRENDRE`
--
ALTER TABLE `APPRENDRE`
  ADD PRIMARY KEY (`FOR_ID`,`UTI_ID`),
  ADD KEY `I_FK_APPRENDRE_FORMATION` (`FOR_ID`),
  ADD KEY `I_FK_APPRENDRE_UTILISATEUR` (`UTI_ID`);

--
-- Index pour la table `APTITUDE`
--
ALTER TABLE `APTITUDE`
  ADD PRIMARY KEY (`APT_ID`),
  ADD KEY `I_FK_APTITUDE_COMPETENCE` (`COM_ID`);

--
-- Index pour la table `CLUB`
--
ALTER TABLE `CLUB`
  ADD PRIMARY KEY (`CLU_ID`),
  ADD UNIQUE KEY `I_FK_CLUB_UTILISATEUR` (`UTI_ID`);

--
-- Index pour la table `COMPETENCE`
--
ALTER TABLE `COMPETENCE`
  ADD PRIMARY KEY (`COM_ID`,`NIV_ID`),
  ADD KEY `I_FK_COMPETENCE_NIVEAU` (`NIV_ID`);

--
-- Index pour la table `COURS`
--
ALTER TABLE `COURS`
  ADD PRIMARY KEY (`COU_ID`),
  ADD KEY `I_FK_COURS_FORMATION` (`FOR_ID`);

--
-- Index pour la table `FORMATION`
--
ALTER TABLE `FORMATION`
  ADD PRIMARY KEY (`FOR_ID`),
  ADD KEY `I_FK_FORMATION_NIVEAU` (`NIV_ID`),
  ADD KEY `I_FK_FORMATION_UTILISATEUR` (`UTI_ID`),
  ADD KEY `I_FK_FORMATION_CLUB` (`CLU_ID`);

--
-- Index pour la table `GROUPE`
--
ALTER TABLE `GROUPE`
  ADD PRIMARY KEY (`GRO_ID`),
  ADD KEY `I_FK_GROUPE_COURS` (`COU_ID`),
  ADD KEY `I_FK_GROUPE_UTILISATEUR` (`UTI_ID_ELV2`),
  ADD KEY `I_FK_GROUPE_UTILISATEUR2` (`UTI_ID_ELV1`),
  ADD KEY `I_FK_GROUPE_UTILISATEUR3` (`UTI_ID_INIT`);

--
-- Index pour la table `INITIER`
--
ALTER TABLE `INITIER`
  ADD PRIMARY KEY (`FOR_ID`,`UTI_ID`),
  ADD KEY `I_FK_INITIER_FORMATION` (`FOR_ID`),
  ADD KEY `I_FK_INITIER_UTILISATEUR` (`UTI_ID`);

--
-- Index pour la table `MAITRISER`
--
ALTER TABLE `MAITRISER`
  ADD PRIMARY KEY (`COU_ID`,`UTI_ID`,`APT_ID`),
  ADD KEY `I_FK_MAITRISER_COURS` (`COU_ID`),
  ADD KEY `I_FK_MAITRISER_UTILISATEUR` (`UTI_ID`),
  ADD KEY `I_FK_MAITRISER_APTITUDE` (`APT_ID`);

--
-- Index pour la table `NIVEAU`
--
ALTER TABLE `NIVEAU`
  ADD PRIMARY KEY (`NIV_ID`);

--
-- Index pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  ADD PRIMARY KEY (`UTI_ID`),
  ADD KEY `I_FK_UTILISATEUR_NIVEAU` (`NIV_ID`),
  ADD KEY `I_FK_UTILISATEUR_CLUB` (`CLU_ID`);

--
-- Index pour la table `VALIDER`
--
ALTER TABLE `VALIDER`
  ADD PRIMARY KEY (`UTI_ID`,`APT_ID`),
  ADD KEY `I_FK_VALIDE_UTILISATEUR` (`UTI_ID`),
  ADD KEY `I_FK_VALIDE_APTITUDE` (`APT_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `APTITUDE`
--
ALTER TABLE `APTITUDE`
  MODIFY `APT_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `CLUB`
--
ALTER TABLE `CLUB`
  MODIFY `CLU_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `COMPETENCE`
--
ALTER TABLE `COMPETENCE`
  MODIFY `COM_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `COURS`
--
ALTER TABLE `COURS`
  MODIFY `COU_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `FORMATION`
--
ALTER TABLE `FORMATION`
  MODIFY `FOR_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `GROUPE`
--
ALTER TABLE `GROUPE`
  MODIFY `GRO_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  MODIFY `UTI_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `APPRENDRE`
--
ALTER TABLE `APPRENDRE`
  ADD CONSTRAINT `FK_APPRENDRE_FORMATION` FOREIGN KEY (`FOR_ID`) REFERENCES `FORMATION` (`FOR_ID`),
  ADD CONSTRAINT `FK_APPRENDRE_UTILISATEUR` FOREIGN KEY (`UTI_ID`) REFERENCES `UTILISATEUR` (`UTI_ID`);

--
-- Contraintes pour la table `APTITUDE`
--
ALTER TABLE `APTITUDE`
  ADD CONSTRAINT `FK_APTITUDE_COMPETENCE` FOREIGN KEY (`COM_ID`) REFERENCES `COMPETENCE` (`COM_ID`);

--
-- Contraintes pour la table `CLUB`
--
ALTER TABLE `CLUB`
  ADD CONSTRAINT `FK_CLUB_UTILISATEUR` FOREIGN KEY (`UTI_ID`) REFERENCES `UTILISATEUR` (`UTI_ID`);

--
-- Contraintes pour la table `COMPETENCE`
--
ALTER TABLE `COMPETENCE`
  ADD CONSTRAINT `FK_COMPETENCE_NIVEAU` FOREIGN KEY (`NIV_ID`) REFERENCES `NIVEAU` (`NIV_ID`);

--
-- Contraintes pour la table `COURS`
--
ALTER TABLE `COURS`
  ADD CONSTRAINT `FK_COURS_FORMATION` FOREIGN KEY (`FOR_ID`) REFERENCES `FORMATION` (`FOR_ID`);

--
-- Contraintes pour la table `FORMATION`
--
ALTER TABLE `FORMATION`
  ADD CONSTRAINT `FK_FORMATION_CLUB` FOREIGN KEY (`CLU_ID`) REFERENCES `CLUB` (`CLU_ID`),
  ADD CONSTRAINT `FK_FORMATION_NIVEAU` FOREIGN KEY (`NIV_ID`) REFERENCES `NIVEAU` (`NIV_ID`),
  ADD CONSTRAINT `FK_FORMATION_UTILISATEUR` FOREIGN KEY (`UTI_ID`) REFERENCES `UTILISATEUR` (`UTI_ID`);

--
-- Contraintes pour la table `GROUPE`
--
ALTER TABLE `GROUPE`
  ADD CONSTRAINT `FK_GROUPE_COURS` FOREIGN KEY (`COU_ID`) REFERENCES `COURS` (`COU_ID`),
  ADD CONSTRAINT `FK_GROUPE_UTILISATEUR` FOREIGN KEY (`UTI_ID_ELV2`) REFERENCES `UTILISATEUR` (`UTI_ID`),
  ADD CONSTRAINT `FK_GROUPE_UTILISATEUR2` FOREIGN KEY (`UTI_ID_ELV1`) REFERENCES `UTILISATEUR` (`UTI_ID`),
  ADD CONSTRAINT `FK_GROUPE_UTILISATEUR3` FOREIGN KEY (`UTI_ID_INIT`) REFERENCES `UTILISATEUR` (`UTI_ID`);

--
-- Contraintes pour la table `INITIER`
--
ALTER TABLE `INITIER`
  ADD CONSTRAINT `FK_INITIER_FORMATION` FOREIGN KEY (`FOR_ID`) REFERENCES `FORMATION` (`FOR_ID`),
  ADD CONSTRAINT `FK_INITIER_UTILISATEUR` FOREIGN KEY (`UTI_ID`) REFERENCES `UTILISATEUR` (`UTI_ID`);

--
-- Contraintes pour la table `MAITRISER`
--
ALTER TABLE `MAITRISER`
  ADD CONSTRAINT `FK_MAITRISER_APTITUDE` FOREIGN KEY (`APT_ID`) REFERENCES `APTITUDE` (`APT_ID`),
  ADD CONSTRAINT `FK_MAITRISER_COURS` FOREIGN KEY (`COU_ID`) REFERENCES `COURS` (`COU_ID`),
  ADD CONSTRAINT `FK_MAITRISER_UTILISATEUR` FOREIGN KEY (`UTI_ID`) REFERENCES `UTILISATEUR` (`UTI_ID`);

--
-- Contraintes pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  ADD CONSTRAINT `FK_UTILISATEUR_CLUB` FOREIGN KEY (`CLU_ID`) REFERENCES `CLUB` (`CLU_ID`),
  ADD CONSTRAINT `FK_UTILISATEUR_NIVEAU` FOREIGN KEY (`NIV_ID`) REFERENCES `NIVEAU` (`NIV_ID`);

--
-- Contraintes pour la table `VALIDER`
--
ALTER TABLE `VALIDER`
  ADD CONSTRAINT `FK_VALIDE_APTITUDE` FOREIGN KEY (`APT_ID`) REFERENCES `APTITUDE` (`APT_ID`),
  ADD CONSTRAINT `FK_VALIDE_UTILISATEUR` FOREIGN KEY (`UTI_ID`) REFERENCES `UTILISATEUR` (`UTI_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
