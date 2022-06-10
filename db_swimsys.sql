-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 08. čen 2022, 19:29
-- Verze serveru: 10.4.24-MariaDB
-- Verze PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `db_swimsys`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `competition`
--

CREATE TABLE `competition` (
  `id_competition` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `street` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `building_number` int(11) NOT NULL,
  `zip` int(5) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `is_deleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `competition`
--

INSERT INTO `competition` (`id_competition`, `name`, `city`, `street`, `building_number`, `zip`, `start_time`, `end_time`, `is_deleted`) VALUES
(1, 'Pohár ČR', 'Litoměřice', 'Nová', 55, 45222, '2022-05-21 08:00:00', '2022-05-22 19:00:00', 0),
(2, 'Mistrovství ČR', 'Praha', 'Hood', 78, 10000, '2022-06-24 07:00:00', '2022-06-24 20:00:00', 0),
(9, 'PLS', 'grove', 'street', 33, 33322, '2022-05-20 20:56:00', '2022-05-26 13:54:00', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `competition_teams`
--

CREATE TABLE `competition_teams` (
  `id_competition` int(11) NOT NULL,
  `id_team` int(11) NOT NULL,
  `is_deleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `competition_teams`
--

INSERT INTO `competition_teams` (`id_competition`, `id_team`, `is_deleted`) VALUES
(2, 2, 0),
(2, 3, 0),
(1, 4, 0),
(1, 5, 0),
(9, 3, 0),
(9, 4, 0),
(9, 5, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `persons`
--

CREATE TABLE `persons` (
  `id_person` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `phone` int(9) NOT NULL,
  `password` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `is_coach` int(1) DEFAULT NULL,
  `team` int(11) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0,
  `discord_id` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `persons`
--

INSERT INTO `persons` (`id_person`, `name`, `surname`, `email`, `phone`, `password`, `is_coach`, `team`, `is_deleted`, `discord_id`) VALUES
(1, 'Petr', 'Klir', 'klir@mail.cz', 777888554, '$2y$10$oFsdntBf4rP9lxwhS/1LuuX3JAe9Ww9QucNI6J7lpgfYrwvDM72Yy', 0, 2, 0, NULL),
(3, 'Vláďa', 'Řez', 'rezy@mail.cz', 777888555, '$2y$10$oFsdntBf4rP9lxwhS/1LuuX3JAe9Ww9QucNI6J7lpgfYrwvDM72Yy', 0, 2, 0, NULL),
(4, 'Bambus', 'Tes', 'tes@mail.cz', 777888555, '$2y$10$oFsdntBf4rP9lxwhS/1LuuX3JAe9Ww9QucNI6J7lpgfYrwvDM72Yy', 0, 3, 0, NULL),
(5, 'Dominik', 'Kroufek', 'kroufekd@gmail.com', 777888555, '$2y$10$RfgK4oLIGfVUkpCPK6AirewF/9uae1e895rFkorYVyTFhbVywX1VG', 1, 2, 0, '268789016713756673'),
(6, 'Lukáš', 'Kril', 'kril@luky.cz', 777888555, '$2y$10$oFsdntBf4rP9lxwhS/1LuuX3JAe9Ww9QucNI6J7lpgfYrwvDM72Yy', 1, 3, 0, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `teams`
--

CREATE TABLE `teams` (
  `id_team` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `id_coach` int(11) NOT NULL,
  `is_deleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `teams`
--

INSERT INTO `teams` (`id_team`, `name`, `id_coach`, `is_deleted`) VALUES
(2, 'Závodní A', 5, 0),
(3, 'Závodní B', 5, 0),
(4, 'Zdokonalovací A', 6, 0),
(5, 'Zdokonalovací B', 5, 0),
(6, 'Nový tým', 5, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `used_passwords`
--

CREATE TABLE `used_passwords` (
  `id_password` int(11) NOT NULL,
  `password` text COLLATE utf8_czech_ci DEFAULT NULL,
  `id_person` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`id_competition`);

--
-- Indexy pro tabulku `competition_teams`
--
ALTER TABLE `competition_teams`
  ADD KEY `fk_Competition_teams_id_competition` (`id_competition`),
  ADD KEY `fk_Competition_teams_id_team` (`id_team`);

--
-- Indexy pro tabulku `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id_person`);

--
-- Indexy pro tabulku `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id_team`),
  ADD KEY `fk_Teams_id_coach` (`id_coach`);

--
-- Indexy pro tabulku `used_passwords`
--
ALTER TABLE `used_passwords`
  ADD PRIMARY KEY (`id_password`),
  ADD KEY `fk_passwords_person` (`id_person`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `competition`
--
ALTER TABLE `competition`
  MODIFY `id_competition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pro tabulku `persons`
--
ALTER TABLE `persons`
  MODIFY `id_person` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pro tabulku `teams`
--
ALTER TABLE `teams`
  MODIFY `id_team` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pro tabulku `used_passwords`
--
ALTER TABLE `used_passwords`
  MODIFY `id_password` int(11) NOT NULL AUTO_INCREMENT;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `competition_teams`
--
ALTER TABLE `competition_teams`
  ADD CONSTRAINT `fk_Competition_teams_id_competition` FOREIGN KEY (`id_competition`) REFERENCES `competition` (`id_competition`),
  ADD CONSTRAINT `fk_Competition_teams_id_team` FOREIGN KEY (`id_team`) REFERENCES `teams` (`id_team`);

--
-- Omezení pro tabulku `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `fk_Teams_id_coach` FOREIGN KEY (`id_coach`) REFERENCES `persons` (`id_person`);

--
-- Omezení pro tabulku `used_passwords`
--
ALTER TABLE `used_passwords`
  ADD CONSTRAINT `fk_passwords_person` FOREIGN KEY (`id_person`) REFERENCES `persons` (`id_person`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
