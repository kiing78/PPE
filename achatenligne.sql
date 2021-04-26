-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 26 avr. 2021 à 11:42
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `achatenligne`
--

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `Nom` varchar(20) COLLATE utf8_bin NOT NULL,
  `Prenom` varchar(20) COLLATE utf8_bin NOT NULL,
  `Email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`Nom`, `Prenom`, `Email`, `password`) VALUES
('lordinot', 'kevin', 'kev97250@hotmail.fr', 'azerty'),
('laka', 'zaera', 'zaza@hotmail.fr', 'azerty');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `Genre` varchar(20) NOT NULL,
  `TypeVet` varchar(20) NOT NULL,
  `Taille` varchar(20) NOT NULL,
  `Couleur` varchar(20) NOT NULL,
  `PrixUnite` int(11) NOT NULL,
  `QuantiteDispo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `Genre`, `TypeVet`, `Taille`, `Couleur`, `PrixUnite`, `QuantiteDispo`) VALUES
(1, 'Homme', 'Pantalon', '1an-6ans', 'Bleu', 20, 85),
(4, 'Femme', 'Robe', 'Adulte', 'Beige', 21, 9),
(5, 'Homme', 'Pantalon', '7ans-12ans', 'Beige', 10, 19),
(6, 'Homme', 'Chemise', '1an-6ans', 'Vert', 25, 100);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
