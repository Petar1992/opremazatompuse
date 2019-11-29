-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2018 at 06:23 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opremazatompuse`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id` int(11) NOT NULL,
  `naziv` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `info` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id`, `naziv`, `opis`, `info`) VALUES
(1, 'HUMIDORI', 'Humidor je kutija ili prostorija sa kontrolisanom količinom vlage koja se primarno koristi za skladištenje cigara, tompusa ili duvana za lule.\r\n\r\nPreviše ili premalo vlage može biti štetno za duvanske proizvode. Primarna funkcija humidora je održavanje stabilnog nivoa vlage.\r\nSekundarno, štiti njen sadržaj od fizičkog oštećenja kao i od izlaganja sunčevoj svetlosti.', 'humidori'),
(2, 'FUTROLE', 'Opis futrola', 'futrole'),
(3, 'SEKAČI I BUŠAČI', 'Opis', 'sekači'),
(4, 'UPALJAČI', 'Opis', 'upaljaci'),
(5, 'OSTALO', 'Opis', 'ostalo');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `ime` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `mobilni` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `proizvodi` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `poruka` varchar(1024) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ime`, `email`, `mobilni`, `adresa`, `proizvodi`, `poruka`) VALUES
(1, 'Petar', 'petarandroid1992@gmail.com', '0604804690', 'Despotovacka 29', '{\"1\":\"3\",\"19\":\"4\"}', 'Perica je kralj!'),
(2, 'Ivan Petronijevic', 'ivan.nbg@gmail.com', '0631067750', 'Bulevar Milutina Milankovica 60, Beograd', '{\"15\":\"1\"}', ''),
(3, 'Marina Ivankovic', 'marina.j.ivankovic@gmail.com', '0603364244', 'Patrijarha Pavla 4 , Šabac', '{\"1\":\"1\"}', ''),
(4, 'Djordje Dobardzijev', 'djordjesky@gmail.com', '0637016385', 'Kralja Petra I 30/7 17530 Surdulica', '{\"14\":\"1\"}', ''),
(5, 'Marija Mladenovic', 'Marija.mladenovic@live.com', '063460266', 'Uroša Martinovića 17/19, Beograd', '{\"1\":\"1\"}', ''),
(6, 'Vukadin Jovanovic', 'vukadin.jovanovic@live.com', '063266161', 'Stevana Dukica 53/5. 11060 Beograd', '{\"22\":\"1\"}', '');

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id` int(11) NOT NULL,
  `naziv` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `info` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `cena` decimal(6,0) NOT NULL,
  `akcija` tinyint(1) NOT NULL,
  `istaknut` tinyint(1) NOT NULL,
  `najnoviji` tinyint(1) NOT NULL,
  `kategorija` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `slikam1` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `slikam2` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `slikam3` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `stanje` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `naziv`, `info`, `opis`, `cena`, `akcija`, `istaknut`, `najnoviji`, `kategorija`, `thumb`, `slika`, `slikam1`, `slikam2`, `slikam3`, `stanje`) VALUES
(1, 'Cohiba futrola za 6 tompusa - svetlija', 'Cohiba futrola za 6 tompusa - svetlija', 'Definitivno najbolja futrola, a ujedno je i pokretni humidor. \r\nSpolja koža, unutra kedrovina sa ovlaživacem za idealno cuvanje 6 tompusa. \r\nNema veze da li ste u kolima ili u pokretu, ova futrola ostavlja pravi utisak. ', '130', 1, 0, 0, '2', 'themes\\images\\proizvodi\\BOB_5295.png', 'themes\\images\\proizvodi\\BOB_5295.jpg', 'themes\\images\\proizvodi\\BOB_5298.jpg', 'themes\\images\\proizvodi\\BOB_5300.jpg', '', NULL),
(2, 'Cohiba futrola za 6 tompusa - tamnija', 'Futrola za 6 tompusa', 'Definitivno najbolja futrola, a ujedno je i pokretni humidor. \r\nSpolja koža, unutra kedrovina sa ovlaživacem za idealno cuvanje 6 tompusa. \r\nNema veze da li ste u kolima ili u pokretu, ova futrola ostavlja pravi utisak.', '130', 1, 0, 0, '2', 'themes\\images\\proizvodi\\BOB_6929.png', 'themes\\images\\proizvodi\\BOB_6929.jpg', 'themes\\images\\proizvodi\\BOB_6933.jpg', 'themes\\images\\proizvodi\\BOB_6934.jpg', '', NULL),
(3, 'Cohiba Futrola Crno Zuta', 'Futrola Crno Zuta', 'Klasicni i najbolji model za nosenje, koza, za dva tompusa. ', '45', 1, 1, 0, '2', 'themes\\images\\proizvodi\\BOB_5285.png', 'themes\\images\\proizvodi\\BOB_5285.jpg', 'themes\\images\\proizvodi\\BOB_5286.jpg', '', '', NULL),
(4, 'Cohiba futrola za 3 tompusa', 'Futrola za 3 tompusa', 'Cohiba futrola za 3 tompusa, koža spolja, unutra vrhunsko drvo radi boljeg cuvanja vlažnosti. Vrlo atraktivnog izgleda. \r\nDolazi u zaštitnom plaštu i Cohiba kutiji. ', '65', 1, 0, 0, '2', 'themes\\images\\proizvodi\\BOB_5257.png', 'themes\\images\\proizvodi\\BOB_5257.jpg', 'themes\\images\\proizvodi\\BOB_5256.jpg', '', '', NULL),
(5, 'Futrola Krem - Nikl', 'Futrola Krem - Nikl', 'Kozna futrola, upadljivog izgleda, unutra oblozena kedrovinom, a spolja na krajevima niklovana. ', '45', 1, 0, 0, '2', 'themes\\images\\proizvodi\\BOB_8582.png', 'themes\\images\\proizvodi\\BOB_8582.jpg', 'themes\\images\\proizvodi\\BOB_8584.jpg', 'themes\\images\\proizvodi\\BOB_8585.jpg', '', NULL),
(6, 'Metalna dvocevka 2', '', 'Metalna dvocevka, jedinstvena, sa ulogom humidora, dolazi u paketu sa plastom i kutijom. ', '45', 1, 0, 0, '2', 'themes\\images\\proizvodi\\BOB_5270.png', 'themes\\images\\proizvodi\\BOB_5270.jpg', 'themes\\images\\proizvodi\\BOB_5272.jpg', '', '', NULL),
(7, 'Metalna jednocevka', '', 'Metalna futrola za tompus, mocnog izgleda ... Definitivno pravi, a pristupacan poklon', '25', 1, 0, 0, '2', 'themes\\images\\proizvodi\\BOB_5333.png', 'themes\\images\\proizvodi\\BOB_5333.jpg', 'themes\\images\\proizvodi\\BOB_5335.jpg', 'themes\\images\\proizvodi\\BOB_5335.jpg', '', NULL),
(8, 'Metalna dvocevka', 'Metalna dvocevka', 'Metalna dvocevka, jedinstvena, sa ulogom humidora, dolazi u paketu sa plastom i kutijom. ', '45', 1, 0, 0, '2', 'themes\\images\\proizvodi\\BOB_4676.png', 'themes\\images\\proizvodi\\BOB_4676.jpg', 'themes\\images\\proizvodiBOB_4679.jpg', 'themes\\images\\proizvodi\\BOB_4685.jpg', '', NULL),
(9, 'Che Humidor', 'Che Humidor', 'Vrlo atraktivan i unikatan humidor, preko celog je Che-ov lik\r\nVrhunski dizajn, dolazi u paketu sa ovlazivacem, drvenom pregradom, kapaljkom, vlagomerom. ', '185', 0, 1, 0, '1', 'themes\\images\\proizvodi\\thumb.png', 'themes\\images\\proizvodi\\BOB_5230.jpg', 'themes\\images\\proizvodi\\BOB_5208.jpg', 'themes\\images\\proizvodi\\BOB_5209.jpg', '', NULL),
(10, 'Kubanski humidor', 'Kubanski humidor', 'Kubanski humidor, rucni rad od vise vrsta drveta. \r\nOd najbolje Kubanske kedrovine. ', '130', 0, 0, 0, '1', 'themes\\images\\proizvodi\\BOB_4649.png', 'themes\\images\\proizvodi\\BOB_4649.jpg', 'themes\\images\\proizvodi\\BOB_4650.jpg', 'themes\\images\\proizvodi\\BOB_4651.jpg', '', NULL),
(11, 'Humidor na sprat', 'Humidor na sprat', 'Veliki humidor, na dva nivoa, sa kljucem za zakljucavanje. \r\nAtraktivnog izgleda, sa staklima i velikim vlagomerom. \r\nIdealno za svaku kancelariju ili dom. ', '290', 0, 1, 0, '1', 'themes\\images\\proizvodi\\BOB_9599.png', 'themes\\images\\proizvodi\\BOB_9599.JPG', 'themes\\images\\proizvodi\\BOB_9600.JPG', 'themes\\images\\proizvodi\\BOB_9604.JPG', '', NULL),
(12, 'Kesa za cuvanje', 'Kesa za cuvanje', 'Ako nemate humidor, ova kesa je idealna za cuvanje ili za transport tompusa do 90 dana.', '10', 0, 0, 0, '5', 'themes\\images\\proizvodi\\BOB_9559.png', 'themes\\images\\proizvodi\\BOB_9559.JPG', 'themes\\images\\proizvodi\\BOB_9566.JPG', '', '', NULL),
(13, 'Cohiba komplet', 'Cohiba komplet', 'Ako zelite da ostavite odlican utisak i date nekome pravi poklon, ovaj komplet je definitivno to. \r\n\r\nPiksla, sekac i metalna futrola za dva tompusa, sa Cohiba kutijom. ', '110', 0, 1, 0, '5', 'themes\\images\\proizvodi\\\\BOB_6550.png', 'themes\\images\\proizvodi\\BOB_6550.jpg', 'themes\\images\\proizvodi\\BOB_6548.jpg', 'themes\\images\\proizvodi\\BOB_6558.jpg', '', NULL),
(14, 'Keramicki nosac za tompuse', 'Keramicki nosac za tompuse', 'Keramicki nosac za tompus. ', '15', 0, 0, 0, '5', 'themes\\images\\proizvodi\\BOB_4709.png', 'themes\\images\\proizvodi\\BOB_4709.jpg', 'themes\\images\\proizvodiBOB_4704.jpg', 'themes\\images\\proizvodiBOB_4696.jpg', '', NULL),
(15, 'Bakarna pepeljara za tompuse', 'Bakarna pepeljara za tompuse', 'Bakarna pepeljara za tompuse, izuzetno atraktivnog izgleda. ', '30', 0, 0, 0, '5', 'themes\\images\\proizvodi\\BOB_4675.png', 'themes\\images\\proizvodi\\BOB_4675.jpg', 'themes\\images\\proizvodi\\BOB_4661.jpg', '', '', NULL),
(16, 'Pepeljara Cohiba Behike ', 'Pepeljara Cohiba Behike ', 'Pepeljara Cohiba Behike ', '20', 0, 0, 0, '5', 'themes\\images\\proizvodi\\BOB_6579.png', 'themes\\images\\proizvodi\\BOB_6579.JPG', 'themes\\images\\proizvodi\\BOB_6577.JPG', '', '', NULL),
(17, 'Zuta piksla', 'Zuta piksla', 'Piksla zuta, keramicka, za jedan tompus', '20', 0, 0, 0, '5', 'themes\\images\\proizvodi\\BOB_5345.png', 'themes\\images\\proizvodi\\BOB_5345.jpg', 'themes\\images\\proizvodi\\BOB_5344.jpg', 'themes\\images\\proizvodi\\BOB_5346.jpg', '', NULL),
(18, 'Cohiba Giljotina', 'Cohiba Giljotina', 'Mala džepna Cohiba giljotina. ', '15', 0, 0, 0, '3', 'themes\\images\\proizvodi\\BOB_6522.png', 'themes\\images\\proizvodiBOB_6522.jpg', 'themes\\images\\proizvodi\\BOB_6523.jpg', 'themes\\images\\proizvodi\\BOB_6524.jpg', '', NULL),
(19, 'Lepeza - Cohiba sekac sa kutijom', 'Cohiba sekac sa kutijom', 'Cohiba sekac sa kutijom, idealno za poklon. ', '20', 0, 0, 0, '3', 'themes\\images\\proizvodi\\BOB_5317.png', 'themes\\images\\proizvodi\\BOB_5317.jpg', 'themes\\images\\proizvodi\\BOB_5311.jpg', '', '', NULL),
(20, 'Makaze - Cohiba metalni sekac', 'Makaze - Cohiba metalni sekac.', 'Cohiba metalni sekac , sa kutijom.', '20', 0, 0, 0, '3', 'themes\\images\\proizvodi\\BOB_5310.png', 'themes\\images\\proizvodi\\BOB_5310.jpg', 'themes\\images\\proizvodi\\BOB_5307.jpg', '', '', NULL),
(22, 'Picosti - Cohiba kosi sekac', 'Picosti - Cohiba kosi sekac', 'Cohiba kosi sekac za elegantno nacinjanje cigare, cuveni picousti :)', '15', 0, 0, 0, '3', 'themes\\images\\proizvodi\\BOB_6532.png', 'themes\\images\\proizvodi\\BOB_6532.jpg', 'themes\\images\\proizvodi\\BOB_6534.jpg', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'petar', '$2y$12$IESMjKhWa8FwlpVUGkM1Ve0zx5cf3rDC1j4FV06h2WgCywDecHN46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
