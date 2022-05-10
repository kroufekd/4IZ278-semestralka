-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2022 at 09:38 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_swimsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `competition`
--

CREATE TABLE `competition` (
  `id_competition` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `street` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `building_number` int(11) NOT NULL,
  `zip` int(5) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `competition`
--

INSERT INTO `competition` (`id_competition`, `name`, `city`, `street`, `building_number`, `zip`, `start_time`, `end_time`) VALUES
(1, 'Pohár ČR', 'Litoměřice', 'Nová', 55, 45222, '2022-05-21 08:00:00', '2022-05-22 19:00:00'),
(2, 'Mistrovství ČR', 'Praha', 'Hood', 78, 10000, '2022-06-24 07:00:00', '2022-06-24 20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `competition_teams`
--

CREATE TABLE `competition_teams` (
  `id_competition` int(11) NOT NULL,
  `id_team` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `competition_teams`
--

INSERT INTO `competition_teams` (`id_competition`, `id_team`) VALUES
(2, 2),
(2, 3),
(1, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `id_person` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `phone` int(9) NOT NULL,
  `password` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `is_coach` int(1) DEFAULT NULL,
  `team` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`id_person`, `name`, `surname`, `email`, `phone`, `password`, `is_coach`, `team`) VALUES
(1, 'Petr', 'Klir', 'klir@mail.cz', 777888555, '$2y$10$oFsdntBf4rP9lxwhS/1LuuX3JAe9Ww9QucNI6J7lpgfYrwvDM72Yy', 0, 1),
(2, 'Adéla', 'Křik', 'ad@mail.cz', 777888555, '$2y$10$oFsdntBf4rP9lxwhS/1LuuX3JAe9Ww9QucNI6J7lpgfYrwvDM72Yy', 0, 1),
(3, 'Vláďa', 'Řez', 'rezy@mail.cz', 777888555, '$2y$10$oFsdntBf4rP9lxwhS/1LuuX3JAe9Ww9QucNI6J7lpgfYrwvDM72Yy', 0, 1),
(4, 'Bambus', 'Tes', 'tes@mail.cz', 777888555, '$2y$10$oFsdntBf4rP9lxwhS/1LuuX3JAe9Ww9QucNI6J7lpgfYrwvDM72Yy', 0, 2),
(5, 'Dominik', 'Kroufek', 'kroufekd@gmail.com', 777888555, '$2y$10$oFsdntBf4rP9lxwhS/1LuuX3JAe9Ww9QucNI6J7lpgfYrwvDM72Yy', 1, 1),
(6, 'Lukáš', 'Kril', 'kril@luky.cz', 777888555, '$2y$10$oFsdntBf4rP9lxwhS/1LuuX3JAe9Ww9QucNI6J7lpgfYrwvDM72Yy', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id_team` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `id_coach` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id_team`, `name`, `id_coach`) VALUES
(2, 'Závodní A', 5),
(3, 'Závodní B', 5),
(4, 'Zdokonalovací A', 6),
(5, 'Zdokonalovací B', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`id_competition`);

--
-- Indexes for table `competition_teams`
--
ALTER TABLE `competition_teams`
  ADD KEY `fk_Competition_teams_id_competition` (`id_competition`),
  ADD KEY `fk_Competition_teams_id_team` (`id_team`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id_person`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id_team`),
  ADD KEY `fk_Teams_id_coach` (`id_coach`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `competition`
--
ALTER TABLE `competition`
  MODIFY `id_competition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `id_person` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id_team` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `competition_teams`
--
ALTER TABLE `competition_teams`
  ADD CONSTRAINT `fk_Competition_teams_id_competition` FOREIGN KEY (`id_competition`) REFERENCES `competition` (`id_competition`),
  ADD CONSTRAINT `fk_Competition_teams_id_team` FOREIGN KEY (`id_team`) REFERENCES `teams` (`id_team`);

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `fk_Teams_id_coach` FOREIGN KEY (`id_coach`) REFERENCES `persons` (`id_person`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
