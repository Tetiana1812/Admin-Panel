-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Sep 2021 um 16:30
-- Server-Version: 10.4.20-MariaDB
-- PHP-Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `auto`
--
CREATE DATABASE IF NOT EXISTS `auto` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `auto`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `karosserie`
--

DROP TABLE IF EXISTS `karosserie`;
CREATE TABLE `karosserie` (
  `karosserie_id` int(11) NOT NULL,
  `karosserie_bauform` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `karosserie_tueren` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `karosserie_sitzplaetze` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `karosserie`
--

INSERT INTO `karosserie` (`karosserie_id`, `karosserie_bauform`, `karosserie_tueren`, `karosserie_sitzplaetze`) VALUES
(1, 'Cabriolet', '2', '4'),
(2, 'Kombi', '4', '5'),
(3, 'Van', '4', '8'),
(4, 'Roadster', '2', '2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lkw`
--

DROP TABLE IF EXISTS `lkw`;
CREATE TABLE `lkw` (
  `lkw_id` int(11) NOT NULL,
  `lkw_gewicht` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lkw_achsen` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lkw_kabine` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lkw_aufbau` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `motor`
--

DROP TABLE IF EXISTS `motor`;
CREATE TABLE `motor` (
  `motor_id` int(11) NOT NULL,
  `motor_name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motor_hubraum` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motor_zylinder` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motor_leistung` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motor_kraftstoff` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `motor`
--

INSERT INTO `motor` (`motor_id`, `motor_name`, `motor_hubraum`, `motor_zylinder`, `motor_leistung`, `motor_kraftstoff`) VALUES
(1, 'standart Motor', '1100', '4', '110', 'Benzin'),
(2, 'grosser Motor', '5000', '8', '280', 'Diesel'),
(3, 'arbeitsMotor', '2500', '6', '125', 'Diesel'),
(4, 'reiseMotor', '2000', '4', '170', 'Diesel'),
(5, 'sportMotor', '3000', '6', '230', 'Benzin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pkw`
--

DROP TABLE IF EXISTS `pkw`;
CREATE TABLE `pkw` (
  `pkw_id` int(11) NOT NULL,
  `karosserie_id` int(11) NOT NULL,
  `motor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `karosserie`
--
ALTER TABLE `karosserie`
  ADD PRIMARY KEY (`karosserie_id`);

--
-- Indizes für die Tabelle `lkw`
--
ALTER TABLE `lkw`
  ADD PRIMARY KEY (`lkw_id`);

--
-- Indizes für die Tabelle `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`motor_id`);

--
-- Indizes für die Tabelle `pkw`
--
ALTER TABLE `pkw`
  ADD PRIMARY KEY (`pkw_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `karosserie`
--
ALTER TABLE `karosserie`
  MODIFY `karosserie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `lkw`
--
ALTER TABLE `lkw`
  MODIFY `lkw_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `motor`
--
ALTER TABLE `motor`
  MODIFY `motor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `pkw`
--
ALTER TABLE `pkw`
  MODIFY `pkw_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
