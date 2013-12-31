-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 31. Dez 2013 um 15:54
-- Server Version: 5.5.32
-- PHP-Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `veranstaltung`
--
CREATE DATABASE IF NOT EXISTS `veranstaltung` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `veranstaltung`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

DROP TABLE IF EXISTS `benutzer`;
CREATE TABLE IF NOT EXISTS `benutzer` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `passwort` varchar(64) NOT NULL,
  `vorname` varchar(10) NOT NULL,
  `nachname` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`user_id`, `username`, `passwort`, `vorname`, `nachname`, `email`) VALUES
(1, 'Lukas', '46d2b6723dacf6dec4be1101e3e25f615efaa5d3ce040f78e3ef3f89e971cb75', 'Lukas', 'Winkler', 'l.winkler23@me.com'),
(2, 'Max', '355bb2e8fa5fcc0cd58ca33b3d7973d8d47136541d615d93fc3a6c9172df89c8', 'Max', 'Mustermann', 'max@example.com'),
(4, 'Findus', 'b3de8eb37b9e1bbcb2e752eed12777354c0c34a380482b45d4441dcacf88c654', 'Findus', 'Nach', 'findus@example.com'),
(12, 'test', '46d2b6723dacf6dec4be1101e3e25f615efaa5d3ce040f78e3ef3f89e971cb75', 'test', 'test', 'test@example.com'),
(13, 'dsf', 'eb5c7ae6664be5f0c44600fbde016c4ae5126e56f58cc4f498ebb8fb14c8ab21', 'sdfs', 'dsf', 'sdfdsfsd@safdss');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orte`
--

DROP TABLE IF EXISTS `orte`;
CREATE TABLE IF NOT EXISTS `orte` (
  `ort_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ort_name` varchar(50) NOT NULL,
  `stadt` varchar(50) NOT NULL,
  `plz` varchar(5) NOT NULL,
  `strasse` varchar(50) DEFAULT NULL,
  `hausnummer` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`ort_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `orte`
--

INSERT INTO `orte` (`ort_id`, `ort_name`, `stadt`, `plz`, `strasse`, `hausnummer`) VALUES
(1, 'Bg Rechte Kremszeile', 'Krems an der Donau', '3500', 'Rechte Kremszeile', '54'),
(2, 'Stratzinger Kellergasse', 'Stratzing', '3500', 'Stratzinger Kellergasse', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teilnahmen`
--

DROP TABLE IF EXISTS `teilnahmen`;
CREATE TABLE IF NOT EXISTS `teilnahmen` (
  `teilnehmer_id` int(10) unsigned NOT NULL,
  `veranstaltungs_id` int(10) unsigned NOT NULL,
  KEY `veranstaltungs_id` (`veranstaltungs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `teilnahmen`
--

INSERT INTO `teilnahmen` (`teilnehmer_id`, `veranstaltungs_id`) VALUES
(1, 1),
(1, 3),
(1, 2),
(1, 3),
(1, 2),
(1, 1),
(1, 1),
(1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `veranstaltungen`
--

DROP TABLE IF EXISTS `veranstaltungen`;
CREATE TABLE IF NOT EXISTS `veranstaltungen` (
  `veranstaltungs_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `beschreibung` varchar(500) DEFAULT NULL,
  `zeit` datetime DEFAULT NULL,
  `ort_id` int(11) NOT NULL,
  PRIMARY KEY (`veranstaltungs_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Daten für Tabelle `veranstaltungen`
--

INSERT INTO `veranstaltungen` (`veranstaltungs_id`, `name`, `beschreibung`, `zeit`, `ort_id`) VALUES
(1, 'Kellergassenfest', 'Beschreibung des Kellergassenfestes', '2013-08-13 10:00:00', 2),
(2, 'Tag der Offenen Tür', 'Schule ist offen', '2013-11-22 07:45:00', 1),
(3, 'Schulschluss', 'endlich Ferien', '2014-06-27 07:45:00', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
