-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 07 sep 2021 om 10:16
-- Serverversie: 10.4.6-MariaDB
-- PHP-versie: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sunproject`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestemming`
--

CREATE TABLE `bestemming` (
  `Locatie` varchar(50) NOT NULL,
  `Prijs` decimal(2,0) NOT NULL,
  `Verblijftijd` int(3) NOT NULL,
  `Personen` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `boeking`
--

CREATE TABLE `boeking` (
  `KlantID` int(10) NOT NULL,
  `Bestemming` varchar(50) NOT NULL,
  `Prijs` decimal(2,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `KlantID` int(10) NOT NULL,
  `Voornaam` varchar(50) NOT NULL,
  `Achternaam` varchar(50) NOT NULL,
  `Tussenvoegsel` varchar(20) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `Wachtwoord` varchar(50) NOT NULL,
  `Telefoonnummer` int(10) NOT NULL,
  `Postcode` varchar(7) NOT NULL,
  `Straatnaam` varchar(60) NOT NULL,
  `Huisnummer` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `review`
--

CREATE TABLE `review` (
  `Naam` varchar(100) NOT NULL,
  `Score` int(2) NOT NULL,
  `Opmerking` tinytext NOT NULL,
  `Datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
