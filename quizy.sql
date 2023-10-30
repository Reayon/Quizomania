-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Paź 30, 2023 at 10:43 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `ID_kategorii` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`ID_kategorii`, `nazwa`) VALUES
(1, 'IT'),
(2, 'Historia'),
(3, 'Matematyka'),
(4, 'Biologia'),
(5, 'Geografia'),
(6, 'Piłka nożna'),
(37, 'Angielski');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `odpowiedzi`
--

CREATE TABLE `odpowiedzi` (
  `ID_odpowiedzi` int(11) NOT NULL,
  `ID_pytania` int(11) NOT NULL,
  `odp` varchar(255) NOT NULL,
  `czy_poprawna` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `odpowiedzi`
--

INSERT INTO `odpowiedzi` (`ID_odpowiedzi`, `ID_pytania`, `odp`, `czy_poprawna`) VALUES
(1, 1, 'Europa', 0),
(2, 1, 'Ameryka Południowa', 0),
(3, 1, 'Azja', 0),
(4, 1, 'Afryka', 1),
(9, 2, 'W Azji.', 0),
(10, 2, 'W Europie.', 1),
(11, 2, 'W Afryce.', 0),
(12, 2, 'W Ameryce Południowej.', 0),
(13, 4, 'Wireless Fidelity', 1),
(14, 4, 'Wireless Fast Internet', 0),
(15, 4, 'Wireless Internet Frequency Interface', 0),
(16, 4, 'World Information for Internet Facilities', 0),
(17, 5, 'sudo deluser student', 1),
(18, 5, 'net user student /del', 0),
(19, 5, 'net userdel student', 0),
(20, 5, 'user remove student', 0),
(21, 6, '1410', 0),
(22, 6, '1815', 1),
(23, 6, '1821', 0),
(24, 6, '1000', 0),
(25, 7, '100 lat', 0),
(26, 7, '58 dni', 0),
(27, 7, '116 lat', 1),
(28, 7, '190 lat', 0),
(29, 8, '10/4', 0),
(30, 8, '1/2', 0),
(31, 8, '3/5', 1),
(32, 8, '14/24', 0),
(33, 9, '68', 0),
(34, 9, '23', 0),
(35, 9, '14', 0),
(36, 9, '48', 1),
(37, 10, 'tętnica', 1),
(38, 10, 'żyła', 0),
(39, 10, 'kość', 0),
(40, 10, 'palec', 0),
(41, 11, 'DEA', 0),
(42, 11, 'DNA', 1),
(43, 11, 'RNA', 0),
(44, 11, 'DPD', 0),
(45, 12, 'Real Madryt CF', 0),
(46, 12, 'Juventus Turyn', 0),
(47, 12, 'Sporting Lisbona', 0),
(48, 12, 'Al-Nassr', 1),
(49, 13, 'Zbigniew Boniek', 0),
(50, 13, 'Łukasz Piszczek', 0),
(51, 13, 'Cezary Kulesza', 1),
(52, 13, 'Cezary Pazura', 0),
(113, 34, 'Dog', 1),
(114, 34, 'Cat', 0),
(115, 34, 'Fish', 0),
(116, 34, 'Cow', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania`
--

CREATE TABLE `pytania` (
  `ID_pytania` int(11) NOT NULL,
  `ID_kategorii` int(11) NOT NULL,
  `tresc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pytania`
--

INSERT INTO `pytania` (`ID_pytania`, `ID_kategorii`, `tresc`) VALUES
(1, 5, 'Gdzie leży państwo Niger?'),
(2, 5, 'Gdzie leży Polska?'),
(4, 1, 'Rozwiń skrót WI-FI?'),
(5, 1, 'W systemie operacyjnym Ubuntu konto użytkownika student można usunąć za pomocą polecenia?'),
(6, 2, 'W którym roku Napoleon Bonaparte został po raz pierwszy zesłany na wyspę Św. Heleny?'),
(7, 2, 'Ile trwała wojna stuletnia?'),
(8, 3, 'Ułamek 15/25 równa się?'),
(9, 3, '6*8=?'),
(10, 4, 'Aorta to największa w ciele człowieka:?'),
(11, 4, 'Kwas deoksyrybonukleinowy jaki jest jego skrót?'),
(12, 6, 'W jakim klubie obecnie gra Cristiano Ronaldo (Stan na 28.10.2023)?'),
(13, 6, 'Prezesem Polskiego Związku Piłki Nożnej (PZPN) jest (Stan na 28.10.2023)?'),
(34, 37, 'Jak po angielsku powiesz słowo pies?');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`ID_kategorii`);

--
-- Indeksy dla tabeli `odpowiedzi`
--
ALTER TABLE `odpowiedzi`
  ADD PRIMARY KEY (`ID_odpowiedzi`),
  ADD KEY `ID_pytania` (`ID_pytania`);

--
-- Indeksy dla tabeli `pytania`
--
ALTER TABLE `pytania`
  ADD PRIMARY KEY (`ID_pytania`),
  ADD KEY `ID_kategorii` (`ID_kategorii`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `ID_kategorii` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `odpowiedzi`
--
ALTER TABLE `odpowiedzi`
  MODIFY `ID_odpowiedzi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `pytania`
--
ALTER TABLE `pytania`
  MODIFY `ID_pytania` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `odpowiedzi`
--
ALTER TABLE `odpowiedzi`
  ADD CONSTRAINT `odpowiedzi_ibfk_1` FOREIGN KEY (`ID_pytania`) REFERENCES `pytania` (`ID_pytania`);

--
-- Constraints for table `pytania`
--
ALTER TABLE `pytania`
  ADD CONSTRAINT `pytania_ibfk_1` FOREIGN KEY (`ID_kategorii`) REFERENCES `kategorie` (`ID_kategorii`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
