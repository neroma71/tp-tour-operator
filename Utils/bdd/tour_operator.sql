-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 08 sep. 2023 à 12:38
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tour_operator`
--

-- --------------------------------------------------------

--
-- Structure de la table `destination`
--

DROP TABLE IF EXISTS `destination`;
CREATE TABLE IF NOT EXISTS `destination` (
  `id` int NOT NULL AUTO_INCREMENT,
  `location` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `tour_operator_id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `destination`
--

INSERT INTO `destination` (`id`, `location`, `price`, `tour_operator_id`, `image`) VALUES
(1, 'bresil', 1000, 1, 'uploads/rio.jpg'),
(2, 'venise', 550, 2, 'uploads/venise.jpg'),
(3, 'bresil', 2000, 2, 'uploads/rio.jpg'),
(4, 'venise', 400, 1, 'uploads/venise.jpg'),
(5, 'amsterdam', 550, 3, 'uploads/amsterdam.jpg'),
(6, 'amsterdam', 400, 4, 'uploads/amsterdam.jpg'),
(7, 'destinationTest', 600, 5, './uploads/profil.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `id` int NOT NULL,
  `message` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `tour_operator_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `review`
--

INSERT INTO `review` (`id`, `message`, `author`, `tour_operator_id`) VALUES
(0, 'sqfdsfqfdd', 'dd', 1),
(0, 'sqfdsfqfdd', 'dd', 1),
(0, 'sqfdsfqfdd', 'dd', 1),
(0, 'sqfdsfqfdd', 'dd', 1),
(0, 'sqfdsfqfdd', 'dd', 1),
(0, 'vcxwcvx', 'vxcvcx', 2),
(0, 'super agence', 'bob', 2),
(0, 'super voyage j\'ai fumé des petards', 'bob', 3),
(0, 'message de test', 'test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tour_operator`
--

DROP TABLE IF EXISTS `tour_operator`;
CREATE TABLE IF NOT EXISTS `tour_operator` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `grade_count` int NOT NULL DEFAULT '0',
  `grade_total` int NOT NULL DEFAULT '0',
  `is_premium` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tour_operator`
--

INSERT INTO `tour_operator` (`id`, `name`, `link`, `grade_count`, `grade_total`, `is_premium`, `image`) VALUES
(1, 'supervoyage', 'sp@gmail.com', 7, 26, 1, 'uploads/agence3.jpg'),
(2, 'jojo voyage', 'jojo@gmail.com', 3, 6, 1, 'uploads/agence1.jpg'),
(3, 'version voyage', 'vv@gmail.com', 2, 3, 1, 'uploads/agence2.jpg'),
(4, 'fsdfdsq', 'fsdfds@gmail.com', 1, 1, 1, 'uploads/rio.jpg'),
(5, 'test', 'test.com', 0, 0, 1, 'uploads/gogol.jpg'),
(6, 'test', 'test.com', 0, 0, 1, 'uploads/gogol.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
