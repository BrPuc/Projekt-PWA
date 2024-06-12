-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 12, 2024 at 10:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devilmaycry_db`
--
CREATE DATABASE IF NOT EXISTS `devilmaycry_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `devilmaycry_db`;

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE IF NOT EXISTS `korisnici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnicko_ime` varchar(50) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `razina_dozvole` enum('korisnik','administrator') DEFAULT 'korisnik',
  PRIMARY KEY (`id`),
  UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `korisnicko_ime`, `lozinka`, `ime`, `prezime`, `razina_dozvole`) VALUES
(3, 'BrPuc', '$2y$10$PYZiD8cpOK5jm6c9d8dCM.2mftXJ9Gi0rLwIbUtel.3FUu5KXsAA2', 'Branimir', 'Pučar', 'korisnik'),
(4, 'admin', '$2y$10$vO2BG9w.AczaDEmdfSLwq.4xW03FcABLZW2p30TYnYjyvX42AzrMa', 'admin', 'admin', 'administrator'),
(5, '3', '$2y$10$R4rCzcLujPzekoBS5wte5ucxlWFZG.18WjeeKeomvfCjiqm9V150q', '1', '2', 'korisnik'),
(6, 'KarloK', '$2y$10$UeODdbUtnHRjkcvgE8QPDexpzMdEw1UYO8qnxEUwdXxZeYSzhp66e', 'Karlo', 'Karlic', 'korisnik'),
(8, 'bb', '$2y$10$fzty7hE1xILsR56kPh/druIbvmX.G92HzD2lDjWiBscg7lSW2h8k.', 'brane', 'buzin', 'korisnik'),
(9, 'threi', '$2y$10$feFxIld7inqyiaxniVxcP.YQ8OaH7sJWsENCq6oBB5WhhXg/breO6', 'eins', 'zwei', 'korisnik'),
(10, 'meo', '$2y$10$vbzh5jErxDmDPbmDg/IbU.KSEIv3XD7GzqG3iJUIDISD6zvSd7nFO', 'mat', 'eo', 'korisnik'),
(11, 'ez', '$2y$10$iFtZ4GdKrJF/8sS1vmotvO23aghqkAmR81.RReP6ZGmP1/Vj2Qcdq', 'ezikiel', 'surname', 'korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE IF NOT EXISTS `vijesti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(255) NOT NULL,
  `kratki_sadrzaj` text NOT NULL,
  `tekst` text NOT NULL,
  `slika` varchar(255) DEFAULT NULL,
  `datum` datetime NOT NULL DEFAULT current_timestamp(),
  `kategorija` varchar(255) NOT NULL,
  `arhiva` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `naslov`, `kratki_sadrzaj`, `tekst`, `slika`, `datum`, `kategorija`, `arhiva`) VALUES
(26, 'Local Homeless Man', 'Man stabs himself', 'Local homeless man stabs himself with his sword just so he could divide into 2 beings.', 'uploads/homeless_man.jpg', '2024-06-11 22:25:58', 'Local News', 0),
(27, 'Local wacky woohoo pizza man', 'Local wacky woohoo pizza man steals pizza again.', 'It was reported that he stole 10 pizzas today.', 'uploads/pizza_man.jpg', '2024-06-11 22:34:58', 'Local News', 0),
(28, 'Local doggo', 'Local doggo escapes hell', 'Local doggo rampages through the city killing millions and wounding thousands.', 'uploads/doggo.jpg', '2024-06-11 22:47:11', 'Local City News', 0),
(29, 'Balrog', 'Balrog for sale', 'Weapon: Balrog\r\nStrength: 50/100\r\nSpeed: 80/100\r\n\r\nPrice: 20000 Red Orbs', 'uploads/Balrog.jpg', '2024-06-11 23:15:23', 'Arms Dealing', 0),
(30, 'Yamato', 'Yamato for sale', 'Weapon: Yamato\r\nPower: 100/100\r\nSpeed: 100/100\r\n\r\nAbility: Opens portals to other parts of the worlds, in skilled hands it can also slash through reality\r\n\r\nPrice: Your hand', 'uploads/yamato.jpg', '2024-06-11 23:19:38', 'Arms Dealing', 0),
(31, 'Beowolf', 'Beowolf on sale', 'Weapon: Beowolf\r\n\r\nPower: ∞/100\r\nSpeed: 80/100\r\n\r\nAbility: The more light it consumes the stronger the weapon gets\r\n\r\nPrice: Your life', 'uploads/Beowolf.jpg', '2024-06-11 23:23:53', 'Arms Dealing', 0),
(32, 'Local deadweight', 'Local deadweight loses an arm', 'Local dead weight loses an arm, do to local homeless man simply ripping it off for it contained something the man wanted.', 'uploads/deadweight.jpg', '2024-06-11 23:25:25', 'Local City News', 0),
(33, 'Local lady', 'Local lady points rocket launcher', 'Local lady points rocket launcher at random citizens threating to shoot them', 'uploads/rocketlauncherwoman.jpg', '2024-06-11 23:30:58', 'Local News', 0),
(34, 'Local arms dealer', 'Local arms dealer open for business', 'Local arms dealer opens up shop in town, hoping to sell some arms and give the good folk a helping hand.', 'uploads/armsdealer.jpg', '2024-06-11 23:32:43', 'Local City News', 0),
(35, 'news1', 'news so good', 'news so good i blew up', 'uploads/background1.jpg', '2024-06-12 20:36:47', 'Local News', 1),
(36, 'vjesti', 'tako dober vjesti', 'o moj boze tako super dobre vjesti', 'uploads/DevilMayCryLogo.jpg', '2024-06-12 20:39:49', 'Local City News', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
