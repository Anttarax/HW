-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Jan 26. 03:44
-- Kiszolgáló verziója: 10.4.6-MariaDB
-- PHP verzió: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `hw`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `feladatok`
--

CREATE TABLE `feladatok` (
  `azonosito` int(11) NOT NULL,
  `ugy_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `leiras` text COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `feladatok`
--

INSERT INTO `feladatok` (`azonosito`, `ugy_id`, `datum`, `leiras`) VALUES
(2, 2, '2020-01-25', 'Adminisztráció elvégzése'),
(3, 3, '2020-01-25', 'Kávé lefőzése.'),
(4, 4, '2020-01-25', 'Interjú levezényelése.'),
(5, 1, '2020-01-25', 'Iratok rendezése.'),
(6, 2, '2020-01-25', 'Adminisztráció elvégzése.'),
(7, 3, '2020-01-25', 'Kávé lefőzése.'),
(8, 4, '2020-01-25', 'Interjú levezényelése.'),
(9, 1, '2020-01-25', 'Iratok rendezése.'),
(10, 2, '2020-01-25', 'Adminisztráció elvégzése.'),
(11, 3, '2020-01-25', 'Kávé lefőzése.'),
(12, 4, '2020-01-25', 'Interjú levezényelése.'),
(13, 3, '2020-01-25', 'Iratok rendezése.'),
(14, 2, '2020-01-25', 'Adminisztráció elvégzése.'),
(15, 3, '2020-01-25', 'Kávé lefőzése.'),
(16, 1, '2020-01-25', 'test'),
(17, 1, '2020-01-25', 'asd'),
(18, 2, '2020-01-25', 'Adminisztráció elvégzése2'),
(19, 1, '2020-01-26', 'asd'),
(20, 4, '2020-01-26', 'JÉÉÉÉÉÉ'),
(21, 1, '2020-01-26', 'asd'),
(22, 4, '2020-01-26', 'er'),
(23, 1, '2020-01-26', 'asd');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `feladatok`
--
ALTER TABLE `feladatok`
  ADD PRIMARY KEY (`azonosito`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `feladatok`
--
ALTER TABLE `feladatok`
  MODIFY `azonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
