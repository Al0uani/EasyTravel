-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 06:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easytravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `USER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `USER`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `ZIP` int(11) NOT NULL,
  `NAME` varchar(30) DEFAULT NULL,
  `COUNTRY` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`ZIP`, `NAME`, `COUNTRY`) VALUES
(67, 'YAKUTSK', 9),
(2025, 'MALDIVES', 2),
(23000, 'PUNTA CANA', 1),
(23568, 'CAPPADOCIA', 4),
(30546, 'POPEYE VILLAGE', 3),
(65429, 'DUBROVNIK', 8),
(213787, 'PARIS', 6),
(967456, 'LONDON', 5),
(53005307, 'PALAWAN ISLAND', 7);

--
-- Triggers `cities`
--
DELIMITER $$
CREATE TRIGGER `UPPERCASE_CITIES_INSERT` BEFORE INSERT ON `cities` FOR EACH ROW BEGIN
    SET NEW.NAME = UPPER(NEW.NAME);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UPPERCASE_CITIES_UPDATE` BEFORE UPDATE ON `cities` FOR EACH ROW BEGIN
    SET NEW.NAME = UPPER(NEW.NAME);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`ID`, `NAME`, `ADDRESS`) VALUES
(1, 'X Corp', 'NONE');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`ID`, `NAME`) VALUES
(1, 'DOMINICAN REPUBLIC'),
(2, 'MALDIVES'),
(3, 'MALTA'),
(4, 'TURKEY'),
(5, 'UNITED KINGDOM'),
(6, 'FRANCE'),
(7, 'PHILIPPINES'),
(8, 'CROATIA'),
(9, 'RUSSIA');

--
-- Triggers `countries`
--
DELIMITER $$
CREATE TRIGGER `UPPERCASE_COUNTRIES_INSERT` BEFORE INSERT ON `countries` FOR EACH ROW BEGIN
    SET NEW.NAME = UPPER(NEW.NAME);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UPPERCASE_COUNTRIES_UPDATE` BEFORE UPDATE ON `countries` FOR EACH ROW BEGIN
    SET NEW.NAME = UPPER(NEW.NAME);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `CITY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`ID`, `NAME`, `CITY`) VALUES
(1, 'POLAR STAR', 67),
(2, 'ANANTARA DHIGU MALDIVES RESORT', 2025),
(3, 'PARADISUS PUNTA CANA RESORT', 23000),
(4, 'SULTAN CAVE SUITES', 23568),
(5, 'PARADISE BAY RESORT', 30546);

--
-- Triggers `hotel`
--
DELIMITER $$
CREATE TRIGGER `UPPERCASE_HOTEL_INSERT` BEFORE INSERT ON `hotel` FOR EACH ROW BEGIN
    SET NEW.NAME = UPPER(NEW.NAME);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UPPERCASE_HOTEL_UPDATE` BEFORE UPDATE ON `hotel` FOR EACH ROW BEGIN
    SET NEW.NAME = UPPER(NEW.NAME);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `PRICE` decimal(6,2) DEFAULT NULL,
  `DEPART` int(11) DEFAULT NULL,
  `ARRIVE` int(11) DEFAULT NULL,
  `HDEPART` time DEFAULT NULL,
  `HARRIVE` time DEFAULT NULL,
  `DateDEPART` date DEFAULT NULL,
  `DateARRIVE` date DEFAULT NULL,
  `HOTEL` int(11) DEFAULT NULL,
  `PLANE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`ID`, `DESCRIPTION`, `PRICE`, `DEPART`, `ARRIVE`, `HDEPART`, `HARRIVE`, `DateDEPART`, `DateARRIVE`, `HOTEL`, `PLANE`) VALUES
(1, 'Punta Cana, nestled in the Dominican Republic\'s eastern region, entices with its pristine beaches and azure waters. A sought-after destination, it boasts luxury resorts, water sports, golf courses, and lively nightlife. With stunning coral reefs, it\'s a h', 9999.99, 213787, 23000, '20:07:11', '22:26:11', '2024-05-03', '2024-05-03', 3, NULL),
(2, 'The Maldives, a tropical haven in the Indian Ocean, boasts 26 atolls with over 1,000 coral islands. Famous for its luxurious overwater bungalows and pristine beaches, it offers unparalleled snorkeling and diving experiences. A beloved honeymoon spot, it\'s', 8999.99, 67, 2025, '21:05:52', '01:05:52', '2024-05-04', '2024-05-05', 2, NULL),
(3, 'Popeye Village, once Sweethaven Village, stands in Anchor Bay, Malta, created for the 1980 film \"Popeye.\" Now a bustling tourist spot, it offers museums, rides, and live entertainment. With its vibrant buildings and scenic waterfront, it\'s a charming and ', 5699.98, 967456, 30546, '00:43:39', '04:43:39', '2024-05-15', '2024-05-15', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `packages_history`
--

CREATE TABLE `packages_history` (
  `ID` int(11) NOT NULL,
  `USER` int(11) NOT NULL,
  `PACKAGE` int(11) NOT NULL,
  `QTE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `planes`
--

CREATE TABLE `planes` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `SEATS` int(11) NOT NULL,
  `VOYAGE` int(11) DEFAULT NULL,
  `COMPANY` int(11) NOT NULL,
  `Available_Seats` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`ID`, `NAME`, `SEATS`, `VOYAGE`, `COMPANY`, `Available_Seats`) VALUES
(1, 'Boeing 717', 110, 1, 1, 0),
(2, 'Boeing 710', 115, NULL, 1, 115),
(3, 'Boeing 610', 55, NULL, 1, 55),
(4, 'Boeing 720', 105, NULL, 1, 105);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `USERNAME`, `EMAIL`, `PASSWORD`) VALUES
(1, 'JOSEPHALTAIR', 'testyoussef9@gmail.com', '$2y$10$YrByoMbnNjE2UfrMEGUKAeU58ZTHGm8q4jKS6hG3lv3QLQcsykv7.'),
(2, 'BADRBADORA', 'krofitoryoussef@gmail.com', '$2y$10$e8kVkMGR9jT6kvBWSgZomuOzMcKuQ05.aquRm3Hgf5qodkqYZ7Bfu'),
(4, 'ZINZYOUNAT', 'zin@gmail.com', '$2y$10$pWqVRW/KuuEH.l9yc46cWetJkYt77spus1Up95Yk2up5DaEdA0qY2'),
(5, 'DUMBASS', 'testyoussef69@gmail.com', '$2y$10$GSlVPTKva4V57UGmpPDdgOow/PA3aHx0Pfc4SC2CJoi7fGStwkbAm');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `UPPERCASE_USERS` BEFORE INSERT ON `users` FOR EACH ROW BEGIN 
    SET NEW.USERNAME=UPPER(NEW.USERNAME);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `voyage`
--

CREATE TABLE `voyage` (
  `ID` int(11) NOT NULL,
  `DEPART` int(50) NOT NULL,
  `ARRIVE` int(50) NOT NULL,
  `HDEPART` time NOT NULL,
  `HARRIVE` time NOT NULL,
  `DateDEPART` date NOT NULL,
  `DateARRIVE` date NOT NULL,
  `PRIX` decimal(8,2) NOT NULL,
  `COMPANY` int(11) DEFAULT NULL,
  `AVAILABILITY` varchar(10) DEFAULT NULL,
  `TYPE` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voyage`
--

INSERT INTO `voyage` (`ID`, `DEPART`, `ARRIVE`, `HDEPART`, `HARRIVE`, `DateDEPART`, `DateARRIVE`, `PRIX`, `COMPANY`, `AVAILABILITY`, `TYPE`) VALUES
(1, 213787, 967456, '12:00:00', '16:30:00', '2023-05-11', '2023-06-07', 5000.00, 1, 'NO', 'SIMPLE');

--
-- Triggers `voyage`
--
DELIMITER $$
CREATE TRIGGER `UPPERCASE_VOYAGE` BEFORE INSERT ON `voyage` FOR EACH ROW BEGIN
    SET NEW.DEPART = UPPER(NEW.DEPART);
    SET NEW.ARRIVE = UPPER(NEW.ARRIVE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `voyages_history`
--

CREATE TABLE `voyages_history` (
  `ID` int(11) NOT NULL,
  `USER` int(11) NOT NULL,
  `VOYAGE` int(11) NOT NULL,
  `QTE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voyages_history`
--

INSERT INTO `voyages_history` (`ID`, `USER`, `VOYAGE`, `QTE`) VALUES
(13, 1, 1, 1),
(14, 1, 1, 1),
(15, 1, 1, 1),
(16, 4, 1, 1),
(17, 4, 1, 100),
(18, 4, 1, 6);

--
-- Triggers `voyages_history`
--
DELIMITER $$
CREATE TRIGGER `TrigInsert` BEFORE INSERT ON `voyages_history` FOR EACH ROW BEGIN
    DECLARE QT INT;
    -- Select the available seats for the specific voyage
    SELECT Available_Seats INTO QT FROM planes WHERE VOYAGE = NEW.VOYAGE;
    IF QT >= NEW.QTE THEN
        -- Update the available seats
        UPDATE planes SET Available_Seats = QT - NEW.QTE WHERE VOYAGE = NEW.VOYAGE;
        IF (QT- NEW.QTE) = 0 THEN
        UPDATE voyage SET AVAILABILITY = "NO" WHERE ID = 		NEW.VOYAGE; 
        END IF;
    ELSE
        -- If not enough seats, signal an SQLSTATE error
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Not enough seats available';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `voyages_history_view`
-- (See below for the actual view)
--
CREATE TABLE `voyages_history_view` (
`USER` int(11)
,`USERNAME` varchar(50)
,`VOYAGE` int(11)
,`QTE` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `voyage_view`
-- (See below for the actual view)
--
CREATE TABLE `voyage_view` (
`ID` int(11)
,`DEPART` varchar(30)
,`ARRIVE` varchar(30)
,`HDEPART` time
,`HARRIVE` time
,`DateDEPART` date
,`DateARRIVE` date
,`PRIX` decimal(8,2)
,`PLANE` int(11)
,`AVAILABILITY` varchar(10)
);

-- --------------------------------------------------------

--
-- Structure for view `voyages_history_view`
--
DROP TABLE IF EXISTS `voyages_history_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `voyages_history_view`  AS SELECT `vh`.`USER` AS `USER`, `u`.`USERNAME` AS `USERNAME`, `vh`.`VOYAGE` AS `VOYAGE`, count(`vh`.`VOYAGE`) AS `QTE` FROM (`voyages_history` `vh` join `users` `u` on(`u`.`ID` = `vh`.`USER`)) GROUP BY `vh`.`USER`, `vh`.`VOYAGE` ;

-- --------------------------------------------------------

--
-- Structure for view `voyage_view`
--
DROP TABLE IF EXISTS `voyage_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `voyage_view`  AS SELECT `v`.`ID` AS `ID`, `c`.`NAME` AS `DEPART`, `c2`.`NAME` AS `ARRIVE`, `v`.`HDEPART` AS `HDEPART`, `v`.`HARRIVE` AS `HARRIVE`, `v`.`DateDEPART` AS `DateDEPART`, `v`.`DateARRIVE` AS `DateARRIVE`, `v`.`PRIX` AS `PRIX`, `p`.`ID` AS `PLANE`, `v`.`AVAILABILITY` AS `AVAILABILITY` FROM (((`voyage` `v` join `cities` `c` on(`c`.`ZIP` = `v`.`DEPART`)) join `cities` `c2` on(`c2`.`ZIP` = `v`.`ARRIVE`)) join `planes` `p` on(`p`.`VOYAGE` = `v`.`ID`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_USER_ADMIN` (`USER`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`ZIP`),
  ADD KEY `FK_PAYS` (`COUNTRY`) USING BTREE;

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CITY_HOTEL` (`CITY`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_CITY` (`ARRIVE`),
  ADD KEY `FK_HOTEL` (`HOTEL`),
  ADD KEY `FK_PLANEPACKAGE` (`PLANE`),
  ADD KEY `FK_DEPARTPACKAGE` (`DEPART`);

--
-- Indexes for table `packages_history`
--
ALTER TABLE `packages_history`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_USER` (`USER`),
  ADD KEY `FK_PKG` (`PACKAGE`);

--
-- Indexes for table `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_PlaneVoyage` (`VOYAGE`),
  ADD KEY `FK_PlanecOMAPNY` (`COMPANY`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `UNQ_EMAIL` (`EMAIL`);

--
-- Indexes for table `voyage`
--
ALTER TABLE `voyage`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_company` (`COMPANY`);

--
-- Indexes for table `voyages_history`
--
ALTER TABLE `voyages_history`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_USER_VH` (`USER`),
  ADD KEY `FK_VOYAGE_VH` (`VOYAGE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `packages_history`
--
ALTER TABLE `packages_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planes`
--
ALTER TABLE `planes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `voyages_history`
--
ALTER TABLE `voyages_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_USER_ADMIN` FOREIGN KEY (`USER`) REFERENCES `users` (`ID`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `FK_PAYS` FOREIGN KEY (`COUNTRY`) REFERENCES `countries` (`ID`);

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `FK_CITY_HOTEL` FOREIGN KEY (`CITY`) REFERENCES `cities` (`ZIP`);

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `FK_CITY` FOREIGN KEY (`ARRIVE`) REFERENCES `cities` (`ZIP`),
  ADD CONSTRAINT `FK_DEPARTPACKAGE` FOREIGN KEY (`DEPART`) REFERENCES `cities` (`ZIP`),
  ADD CONSTRAINT `FK_HOTEL` FOREIGN KEY (`HOTEL`) REFERENCES `hotel` (`ID`),
  ADD CONSTRAINT `FK_PLANEPACKAGE` FOREIGN KEY (`PLANE`) REFERENCES `planes` (`ID`);

--
-- Constraints for table `packages_history`
--
ALTER TABLE `packages_history`
  ADD CONSTRAINT `FK_PKG` FOREIGN KEY (`PACKAGE`) REFERENCES `packages` (`ID`);

--
-- Constraints for table `planes`
--
ALTER TABLE `planes`
  ADD CONSTRAINT `FK_PlaneVoyage` FOREIGN KEY (`VOYAGE`) REFERENCES `voyage` (`ID`),
  ADD CONSTRAINT `FK_PlanecOMAPNY` FOREIGN KEY (`COMPANY`) REFERENCES `companies` (`ID`);

--
-- Constraints for table `voyage`
--
ALTER TABLE `voyage`
  ADD CONSTRAINT `fk_company` FOREIGN KEY (`COMPANY`) REFERENCES `companies` (`ID`);

--
-- Constraints for table `voyages_history`
--
ALTER TABLE `voyages_history`
  ADD CONSTRAINT `FK_VOYAGE_VH` FOREIGN KEY (`VOYAGE`) REFERENCES `voyage` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
