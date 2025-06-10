-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2025 at 12:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bas_boodschappenservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `artId` int(11) NOT NULL,
  `artOmschrijving` varchar(12) NOT NULL,
  `artInkoop` decimal(5,2) DEFAULT NULL,
  `artVerkoop` decimal(5,2) DEFAULT NULL,
  `artVoorraad` int(11) NOT NULL,
  `artMinVoorraad` int(11) NOT NULL,
  `artMaxVoorraad` int(11) NOT NULL,
  `artLocatie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`artId`, `artOmschrijving`, `artInkoop`, `artVerkoop`, `artVoorraad`, `artMinVoorraad`, `artMaxVoorraad`, `artLocatie`) VALUES
(1, 'Stoel', 3.50, 11.99, 30, 5, 100, 2),
(2, 'Pen', 0.45, 1.25, 150, 10, 500, 1),
(3, 'Notitieblok', 2.10, 5.99, 80, 10, 200, 3),
(4, 'Laptophoes', 7.80, 19.95, 45, 5, 120, 4),
(5, 'USB-stick', 5.25, 12.49, 70, 8, 150, 6),
(6, 'Rugzak', 12.30, 29.99, 25, 3, 75, 7),
(7, 'Muis', 4.99, 14.95, 50, 5, 100, 8),
(8, 'Toetsenbord', 6.80, 17.50, 60, 6, 110, 9),
(9, 'Headset', 9.40, 24.99, 40, 4, 90, 5),
(10, 'Monitor', 20.00, 75.00, 15, 2, 30, 10),
(21, 'muismat', 1.00, 11.00, 111, 1, 11, 1),
(22, 'tas', 4.00, 55.00, 555, 5, 600, 1),
(23, 'aardappel', 5.00, 15.00, 50, 10, 100, 6),
(24, 'glazen beker', 10.00, 20.00, 50, 10, 100, 1),
(27, 'muismat', 1.00, 11.00, 1, 1, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(11) NOT NULL,
  `gebruikersnaam` varchar(50) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `gebruikersnaam`, `wachtwoord`, `rol`) VALUES
(1, 'bas_admin', '$2y$10$HxU1l1fdOEo2Vjps2jAfDutPNkyOQIlvxWYVqlD1ByfqT9iO.v9XG', 'Admin'),
(2, 'robert_Magmee', '$2y$10$pDZdSihw4CIFElz8.Gjk9OApPYrn9bWY37pfnqvX32EouUGptKlG2', 'Magazijnmeester'),
(3, 'jaap_verkoop', '$2y$10$dy4ZSLKjFkiymrycHtBHU.vJAjP/AjvHbIV/g7TQ749Kna.mGFvtu', 'Verkoper'),
(4, 'leonie_magmed', '$2y$10$3wsUST8fjTS9XoCNZrfFf.sHCJHfYnwHE2U1RI3NfsTwreIwSLVsC', 'Magazijnmedewerker'),
(5, 'redouan_bez', '$2y$10$mp6zCtVZ6V.OcFUct1USJekkwIS.3asiD..AH8T2VkX0QENrVUKa.', 'Bezorger'),
(6, 'fleur_inkoop', '$2y$10$v/5CPafIx1mXjOzKkjWBLOeF8yxqMu4Mk.wRQBSptc7MxL2fJSkOa', 'Inkoper'),
(7, 'mark', '$2y$10$jW6FLKakVkMZfBwBZt.f8.51hvVlo0hR3kdo2Z4KTr.mIQWAZ6j2C', 'Bezorger');

-- --------------------------------------------------------

--
-- Table structure for table `inkooporder`
--

CREATE TABLE `inkooporder` (
  `inkOrdId` int(11) NOT NULL,
  `levId` int(11) NOT NULL,
  `artId` int(11) NOT NULL,
  `inkOrdDatum` date DEFAULT NULL,
  `inkOrdBestAantal` int(11) DEFAULT NULL,
  `inkOrdStatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inkooporder`
--

INSERT INTO `inkooporder` (`inkOrdId`, `levId`, `artId`, `inkOrdDatum`, `inkOrdBestAantal`, `inkOrdStatus`) VALUES
(3, 3, 3, '2025-05-03', 150, 1),
(4, 4, 4, '2025-05-04', 120, 1),
(5, 5, 5, '2025-05-05', 80, 0),
(6, 6, 6, '2025-05-06', 60, 1),
(7, 7, 7, '2025-05-07', 90, 0),
(8, 8, 8, '2025-05-08', 50, 1),
(9, 9, 9, '2025-05-09', 70, 0),
(11, 1, 1, '2025-06-06', 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `klant`
--

CREATE TABLE `klant` (
  `klantId` int(11) NOT NULL,
  `klantNaam` varchar(20) DEFAULT NULL,
  `klantEmail` varchar(30) NOT NULL,
  `klantAdres` varchar(30) NOT NULL,
  `klantPostcode` varchar(6) DEFAULT NULL,
  `klantWoonplaats` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klant`
--

INSERT INTO `klant` (`klantId`, `klantNaam`, `klantEmail`, `klantAdres`, `klantPostcode`, `klantWoonplaats`) VALUES
(1, 'Pieter Janssen', 'pieter@mail.com', 'Hoofdstraat 10', '1234AB', 'Utrecht'),
(3, 'Anouk Smits', 'anouk@mail.com', 'Dorpstraat 3', '3456CD', 'Amsterdam'),
(4, 'Ruben Bakker', 'ruben@mail.com', 'Steegje 1', '4567DE', 'Eindhoven'),
(5, 'Nina Vermeer', 'nina@mail.com', 'Kerkstraat 7', '5678EF', 'Groningen'),
(6, 'Tom Willems', 'tom@mail.com', 'Plein 5', '6789FG', 'Maastricht'),
(7, 'Lisa Jansen', 'lisa@mail.com', 'Singel 12', '7890GH', 'Zwolle'),
(8, 'Koen Bos', 'koen@mail.com', 'Bomenlaan 6', '8901HI', 'Arnhem'),
(9, 'Mila de Groot', 'mila@mail.com', 'Bloemenweg 8', '9012IJ', 'Leiden'),
(10, 'Daan de Leeuw', 'daan@mail.com', 'Stadhuisstraat 4', '0123JK', 'Den Haag'),
(11, 'Anne de vries', 'Annedevries@gmail.com', '1234AB', 'Jan de', 'groningen');

-- --------------------------------------------------------

--
-- Table structure for table `leverancier`
--

CREATE TABLE `leverancier` (
  `levId` int(11) NOT NULL,
  `levNaam` varchar(15) NOT NULL,
  `levContact` varchar(20) DEFAULT NULL,
  `levEmail` varchar(30) NOT NULL,
  `levAdres` varchar(30) DEFAULT NULL,
  `levPostcode` varchar(6) DEFAULT NULL,
  `levWoonplaats` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leverancier`
--

INSERT INTO `leverancier` (`levId`, `levNaam`, `levContact`, `levEmail`, `levAdres`, `levPostcode`, `levWoonplaats`) VALUES
(1, 'OfficePro', 'Jan Jansen', 'jan@officepro.nl', 'Kantoorstraat 12', '1234AB', 'Utrecht'),
(3, 'PapierEnZo', 'Mohammed Ali', 'm.ali@papierenzo.nl', 'Notitiepad 3', '3456EF', 'Rotterdam'),
(4, 'TechSupply', 'Kim van Dijk', 'kim@techsupply.nl', 'Computerweg 45', '7890GH', 'Eindhoven'),
(5, 'SchoolTools', 'Niels Peters', 'n.peters@schooltools.nl', 'Schoolplein 9', '9012IJ', 'Groningen'),
(6, 'WriteIt', 'Anna Smit', 'anna@writeit.nl', 'Penstraat 2', '1122KL', 'Leiden'),
(7, 'WorkSmart', 'Tim Bakker', 'tim@worksmart.nl', 'Slimweg 88', '3344MN', 'Zwolle'),
(8, 'DigitalDreams', 'Yara Noor', 'y.noor@digitaldreams.nl', 'Techpad 7', '5566OP', 'Nijmegen'),
(9, 'StorageKing', 'Koen Meijer', 'koen@storageking.nl', 'Opslaglaan 10', '7788QR', 'Haarlem');

-- --------------------------------------------------------

--
-- Table structure for table `verkooporder`
--

CREATE TABLE `verkooporder` (
  `verkOrdId` int(11) NOT NULL,
  `klantId` int(11) NOT NULL,
  `artId` int(11) NOT NULL,
  `verkOrdDatum` date DEFAULT NULL,
  `verkOrdBestAantal` int(11) DEFAULT NULL,
  `verkOrdStatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verkooporder`
--

INSERT INTO `verkooporder` (`verkOrdId`, `klantId`, `artId`, `verkOrdDatum`, `verkOrdBestAantal`, `verkOrdStatus`) VALUES
(3, 3, 3, '2025-05-13', 3, 1),
(4, 4, 4, '2025-05-14', 4, 4),
(5, 5, 5, '2025-05-15', 1, 2),
(6, 6, 6, '2025-05-16', 2, 3),
(8, 8, 8, '2025-05-18', 5, 2),
(9, 9, 9, '2025-05-19', 2, 3),
(10, 10, 10, '2025-05-20', 3, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`artId`);

--
-- Indexes for table `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gebruikersnaam` (`gebruikersnaam`);

--
-- Indexes for table `inkooporder`
--
ALTER TABLE `inkooporder`
  ADD PRIMARY KEY (`inkOrdId`),
  ADD KEY `fk_inkooporder_artikel` (`artId`),
  ADD KEY `fk_inkooporder_leverancier` (`levId`);

--
-- Indexes for table `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`klantId`);

--
-- Indexes for table `leverancier`
--
ALTER TABLE `leverancier`
  ADD PRIMARY KEY (`levId`);

--
-- Indexes for table `verkooporder`
--
ALTER TABLE `verkooporder`
  ADD PRIMARY KEY (`verkOrdId`),
  ADD UNIQUE KEY `klantId` (`klantId`,`artId`),
  ADD KEY `fk_verkooporder_artikel` (`artId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `artId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inkooporder`
--
ALTER TABLE `inkooporder`
  MODIFY `inkOrdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `klant`
--
ALTER TABLE `klant`
  MODIFY `klantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `leverancier`
--
ALTER TABLE `leverancier`
  MODIFY `levId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `verkooporder`
--
ALTER TABLE `verkooporder`
  MODIFY `verkOrdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inkooporder`
--
ALTER TABLE `inkooporder`
  ADD CONSTRAINT `fk_inkooporder_artikel` FOREIGN KEY (`artId`) REFERENCES `artikel` (`artId`),
  ADD CONSTRAINT `fk_inkooporder_leverancier` FOREIGN KEY (`levId`) REFERENCES `leverancier` (`levId`) ON DELETE CASCADE;

--
-- Constraints for table `verkooporder`
--
ALTER TABLE `verkooporder`
  ADD CONSTRAINT `fk_verkooporder_artikel` FOREIGN KEY (`artId`) REFERENCES `artikel` (`artId`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_verkooporder_klant` FOREIGN KEY (`klantId`) REFERENCES `klant` (`klantId`) ON DELETE CASCADE,
  ADD CONSTRAINT `verkooporder_ibfk_1` FOREIGN KEY (`klantId`) REFERENCES `klant` (`klantId`),
  ADD CONSTRAINT `verkooporder_ibfk_2` FOREIGN KEY (`artId`) REFERENCES `artikel` (`artId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
