-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: ian. 26, 2025 la 11:23 AM
-- Versiune server: 10.4.32-MariaDB
-- Versiune PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `echipa de fotbal`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `antrenori`
--

CREATE TABLE `antrenori` (
  `ID` int(11) NOT NULL,
  `Nume` text NOT NULL,
  `Prenume` text NOT NULL,
  `Ani de experienta` int(11) NOT NULL,
  `Specializarea` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `antrenori`
--

INSERT INTO `antrenori` (`ID`, `Nume`, `Prenume`, `Ani de experienta`, `Specializarea`) VALUES
(1, 'Ferguson', 'Alex', 25, 'Aparare'),
(2, 'Mourinho', 'Jose', 18, 'Atac'),
(3, 'Lucescu', 'Mircea', 30, 'Mijloc'),
(4, 'Lucescu', 'Razvan', 10, 'Atac'),
(5, 'Munteanu', 'Dorinel', 40, 'Atac'),
(6, 'Guardiola', 'Pep', 21, 'Aparare'),
(7, 'Ancelotti', 'Carlo', 33, 'Atac'),
(8, 'Simeone', 'Diego', 8, 'Aparare');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `atacanti`
--

CREATE TABLE `atacanti` (
  `ID` int(11) NOT NULL,
  `Nume` text NOT NULL,
  `Prenume` text NOT NULL,
  `Varsta` int(11) NOT NULL,
  `Inaltime` int(11) NOT NULL,
  `Goluri` int(11) NOT NULL,
  `ID_antrenor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `atacanti`
--

INSERT INTO `atacanti` (`ID`, `Nume`, `Prenume`, `Varsta`, `Inaltime`, `Goluri`, `ID_antrenor`) VALUES
(1, 'Morata', 'Alvaro', 40, 184, 24, NULL),
(2, 'Rusescu', 'Raul', 33, 177, 10, NULL),
(3, 'Mbappe', 'Kylian', 26, 180, 3, NULL),
(4, 'Lewandowski', 'Robert', 37, 188, 7, NULL),
(5, 'Yamal', 'Lamine', 17, 175, 11, NULL),
(6, 'Lionel', 'Messi', 45, 166, 44, NULL),
(7, 'Ronaldo', 'Cristiano', 48, 187, 31, NULL),
(8, 'Suarez', 'Luis', 40, 190, 20, NULL);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `bilete`
--

CREATE TABLE `bilete` (
  `id` int(11) NOT NULL,
  `numar_bilete_disponibile` int(11) NOT NULL,
  `numar_bilete_rezervate` int(11) DEFAULT 0,
  `data_rezervare` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_utilizator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `bilete`
--

INSERT INTO `bilete` (`id`, `numar_bilete_disponibile`, `numar_bilete_rezervate`, `data_rezervare`, `ID_utilizator`) VALUES
(1, 73, 27, '2025-01-25 09:41:20', NULL);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `formatii`
--

CREATE TABLE `formatii` (
  `ID` int(11) NOT NULL,
  `Tip` int(11) NOT NULL,
  `Stil` text NOT NULL,
  `ID_antrenor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `formatii`
--

INSERT INTO `formatii` (`ID`, `Tip`, `Stil`, `ID_antrenor`) VALUES
(1, 433, 'Ofensiv', NULL),
(2, 442, 'Neutru', NULL),
(3, 343, 'Ofensiv', NULL),
(4, 532, 'Defensiv', NULL),
(5, 451, 'Neutru', NULL),
(6, 4321, 'Neutru', NULL),
(7, 4132, 'Defensiv', NULL),
(8, 541, 'Defensiv', NULL),
(9, 41212, 'Neutru', NULL),
(10, 352, 'Neutru', NULL),
(11, 4231, 'Ofensiv', NULL),
(12, 235, 'Ofensiv', NULL);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `palmares echipa`
--

CREATE TABLE `palmares echipa` (
  `ID` int(11) NOT NULL,
  `Tipul trofeului` text NOT NULL,
  `Anul castigator` int(11) NOT NULL,
  `ID_antrenor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `palmares echipa`
--

INSERT INTO `palmares echipa` (`ID`, `Tipul trofeului`, `Anul castigator`, `ID_antrenor`) VALUES
(1, 'FA Cup', 2013, NULL),
(2, 'Carabao Cup', 1995, NULL),
(3, 'FA Cup', 2014, NULL),
(4, 'Premier League', 2000, NULL),
(5, 'Carabao Cup', 2000, NULL),
(6, 'Community Shield', 2001, NULL),
(7, 'Champions League', 2002, NULL),
(8, 'Premier League', 2021, NULL),
(9, 'Community Shield', 2022, NULL),
(10, 'Conference League', 2023, NULL),
(11, 'Carabao Cup', 2007, NULL);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `rezervari`
--

CREATE TABLE `rezervari` (
  `id` int(11) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `data_rezervare` datetime NOT NULL,
  `numar_bilete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `rezervari`
--

INSERT INTO `rezervari` (`id`, `nume`, `data_rezervare`, `numar_bilete`) VALUES
(1, 'Andrei', '2025-01-25 10:51:16', 12),
(2, 'Raul', '2025-01-25 10:53:29', 8),
(3, 'Roxana', '2025-01-26 10:00:46', 3),
(4, 'Paul', '2025-01-26 10:29:43', 2),
(5, 'Alexandru', '2025-01-26 10:30:07', 2);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `utilizatori`
--

CREATE TABLE `utilizatori` (
  `ID` int(11) NOT NULL,
  `Nume` text NOT NULL,
  `Email` text NOT NULL,
  `Parola` text NOT NULL,
  `tip-utilizator` text NOT NULL,
  `status` varchar(20) DEFAULT 'activ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `utilizatori`
--

INSERT INTO `utilizatori` (`ID`, `Nume`, `Email`, `Parola`, `tip-utilizator`, `status`) VALUES
(1, 'Mihai', 'mihai.albu@ulbsibiu.ro', '$2y$10$WgwvFFQlvAodJJML.L8Hne6FDDmdc3CFrUFLzbIDlvNm61N01FmZm', 'administrator', 'activ'),
(3, 'Laurentiu Marian', 'marian@laurentiu.com', '$2y$10$IAfCGakyd2uJuoHrEltJg.XJ3teTQE.NnmFn20ysIfSzi1p8OS82q', '', 'activ'),
(7, 'Andrei David', 'andrei.david@gmail.com', '$2y$10$o2em0W67qIbEiQgOBlMl2uCIW/jTZ6t3Eoa3bzQ048URthh1NLZNu', '', 'activ'),
(8, 'Raul Morar', 'raul.morar@gmail.com', '$2y$10$XQgL0.SJoLTS6cVPSAjWCeoVBbHuP0wcAuprl4XmEH2wrdcjvNNjG', '', 'activ'),
(9, 'Ioana', 'ioana@alexandra.com', '$2y$10$wMFKHrbTvhQKfdjvRlZ2JekxUQC02.eEQx4ch/quAvrO9nKDhsKa2', '', 'activ');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `antrenori`
--
ALTER TABLE `antrenori`
  ADD PRIMARY KEY (`ID`);

--
-- Indexuri pentru tabele `atacanti`
--
ALTER TABLE `atacanti`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_atacanti_antrenori` (`ID_antrenor`);

--
-- Indexuri pentru tabele `bilete`
--
ALTER TABLE `bilete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bilete_utilizatori` (`ID_utilizator`);

--
-- Indexuri pentru tabele `formatii`
--
ALTER TABLE `formatii`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_formatii_antrenori` (`ID_antrenor`);

--
-- Indexuri pentru tabele `palmares echipa`
--
ALTER TABLE `palmares echipa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_palmares_echipa_antrenori` (`ID_antrenor`);

--
-- Indexuri pentru tabele `rezervari`
--
ALTER TABLE `rezervari`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `antrenori`
--
ALTER TABLE `antrenori`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pentru tabele `atacanti`
--
ALTER TABLE `atacanti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pentru tabele `bilete`
--
ALTER TABLE `bilete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pentru tabele `formatii`
--
ALTER TABLE `formatii`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pentru tabele `palmares echipa`
--
ALTER TABLE `palmares echipa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pentru tabele `rezervari`
--
ALTER TABLE `rezervari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pentru tabele `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `atacanti`
--
ALTER TABLE `atacanti`
  ADD CONSTRAINT `fk_atacanti_antrenori` FOREIGN KEY (`ID_antrenor`) REFERENCES `antrenori` (`ID`);

--
-- Constrângeri pentru tabele `bilete`
--
ALTER TABLE `bilete`
  ADD CONSTRAINT `bilete_ibfk_1` FOREIGN KEY (`id`) REFERENCES `rezervari` (`id`),
  ADD CONSTRAINT `fk_bilete_utilizatori` FOREIGN KEY (`ID_utilizator`) REFERENCES `utilizatori` (`ID`);

--
-- Constrângeri pentru tabele `formatii`
--
ALTER TABLE `formatii`
  ADD CONSTRAINT `fk_formatii_antrenori` FOREIGN KEY (`ID_antrenor`) REFERENCES `antrenori` (`ID`);

--
-- Constrângeri pentru tabele `palmares echipa`
--
ALTER TABLE `palmares echipa`
  ADD CONSTRAINT `fk_palmares_echipa_antrenori` FOREIGN KEY (`ID_antrenor`) REFERENCES `antrenori` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
