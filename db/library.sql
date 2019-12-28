-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Gegenereerd op: 28 dec 2019 om 10:30
-- Serverversie: 5.6.29
-- PHP-versie: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library`
--
CREATE DATABASE IF NOT EXISTS `library` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `library`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `idauthor` int(11) NOT NULL AUTO_INCREMENT,
  `idbook` int(11) NOT NULL,
  `idperson` int(11) NOT NULL,
  PRIMARY KEY (`idauthor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=255 ;

--
-- Gegevens worden geëxporteerd voor tabel `authors`
--

INSERT INTO `authors` (`idauthor`, `idbook`, `idperson`) VALUES
(128, 124, 1),
(129, 112, 2),
(130, 121, 3),
(131, 108, 4),
(132, 87, 4),
(133, 80, 5),
(134, 79, 5),
(135, 80, 6),
(136, 61, 7),
(137, 101, 8),
(138, 118, 8),
(139, 3, 9),
(140, 114, 10),
(141, 103, 11),
(142, 19, 12),
(143, 86, 13),
(144, 52, 14),
(145, 78, 15),
(146, 125, 16),
(147, 67, 17),
(148, 111, 18),
(149, 100, 19),
(150, 29, 20),
(151, 35, 21),
(152, 117, 22),
(153, 51, 23),
(154, 74, 24),
(155, 42, 24),
(156, 73, 24),
(157, 49, 25),
(158, 6, 26),
(159, 107, 26),
(160, 26, 27),
(161, 93, 28),
(162, 98, 29),
(163, 82, 30),
(164, 46, 31),
(165, 95, 31),
(166, 8, 32),
(167, 75, 33),
(168, 37, 34),
(169, 110, 35),
(170, 113, 35),
(171, 115, 35),
(172, 94, 36),
(173, 7, 37),
(174, 119, 38),
(175, 105, 39),
(176, 99, 40),
(177, 24, 41),
(178, 1, 42),
(179, 13, 42),
(180, 12, 43),
(181, 41, 44),
(182, 22, 45),
(183, 72, 46),
(184, 5, 47),
(185, 57, 48),
(186, 90, 49),
(187, 97, 50),
(188, 51, 51),
(189, 43, 51),
(190, 28, 52),
(191, 120, 53),
(192, 21, 54),
(193, 45, 55),
(194, 116, 56),
(195, 34, 57),
(196, 88, 58),
(197, 102, 59),
(198, 85, 60),
(199, 70, 61),
(200, 38, 62),
(201, 36, 63),
(202, 55, 64),
(203, 66, 65),
(204, 91, 66),
(205, 10, 67),
(206, 106, 68),
(207, 89, 69),
(208, 84, 70),
(209, 62, 71),
(210, 33, 72),
(211, 92, 73),
(212, 53, 74),
(213, 69, 75),
(214, 77, 76),
(215, 27, 77),
(216, 30, 78),
(217, 9, 79),
(218, 59, 80),
(219, 23, 81),
(220, 122, 81),
(221, 14, 81),
(222, 123, 81),
(223, 76, 82),
(224, 56, 83),
(225, 63, 84),
(226, 64, 84),
(227, 17, 85),
(228, 126, 86),
(229, 104, 87),
(230, 31, 88),
(231, 18, 88),
(232, 32, 88),
(233, 40, 88),
(234, 2, 89),
(235, 4, 90),
(236, 96, 91),
(237, 58, 92),
(238, 44, 93),
(239, 68, 94),
(240, 39, 95),
(241, 15, 96),
(242, 83, 97),
(243, 81, 98),
(244, 71, 99),
(245, 60, 100),
(246, 20, 101),
(247, 16, 102),
(248, 47, 102),
(249, 48, 102),
(250, 79, 103),
(251, 49, 104),
(252, 105, 105),
(253, 17, 106),
(254, 96, 107);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `idbook` int(11) NOT NULL AUTO_INCREMENT,
  `cdkeep` tinyint(4) NOT NULL DEFAULT '1',
  `nmtitle` varchar(250) NOT NULL,
  `nmsubtitle` text,
  `nmauthor` varchar(50) NOT NULL,
  `nrpages` int(11) NOT NULL,
  `nrisbn` bigint(11) NOT NULL,
  `cdlanguage` char(3) NOT NULL DEFAULT 'NL',
  `cdstatus` char(1) NOT NULL DEFAULT 'B',
  `dtstart` date DEFAULT NULL,
  `dtfinished` date DEFAULT NULL,
  `nrorderbol` bigint(20) NOT NULL,
  `ftreview` text,
  PRIMARY KEY (`idbook`),
  KEY `nmtitle` (`nmtitle`,`nmauthor`),
  KEY `cdlanguage` (`cdlanguage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Books in my library' AUTO_INCREMENT=140 ;

--
-- Gegevens worden geëxporteerd voor tabel `books`
--

INSERT INTO `books` (`idbook`, `cdkeep`, `nmtitle`, `nmsubtitle`, `nmauthor`, `nrpages`, `nrisbn`, `cdlanguage`, `cdstatus`, `dtstart`, `dtfinished`, `nrorderbol`, `ftreview`) VALUES
(1, 1, 'De moeder en het meisje', NULL, 'Inge Schouten', 244, 9789063053659, 'NL', 'D', '2016-01-01', '2016-01-01', 0, NULL),
(2, 1, 'The 3rd alternative', NULL, 'Stephen R. Covey', 443, 9780857205131, 'EN', 'B', '2018-11-15', NULL, 0, NULL),
(3, 1, 'Pygmalion', NULL, 'Bernard Shaw', 190, 9780141439501, 'EN', 'D', '2016-01-01', '2016-01-01', 0, NULL),
(4, 1, 'Javascript 2', NULL, 'Steve Suehring', 458, 9780735645523, 'EN', 'B', NULL, NULL, 0, NULL),
(5, 1, 'De wil en de weg ', NULL, 'Jan Brokken ', 249, 9789045700991, 'NL', 'D', '2016-01-01', '2016-01-01', 0, NULL),
(6, 1, 'Broer', NULL, 'Esther Gerritsen', 94, 978905653603, 'NL', 'D', '2016-01-01', '2016-01-01', 0, NULL),
(7, 1, 'The Miracle Morning', NULL, 'Hal Elrod', 189, 9781473632158, 'EN', 'D', '2016-01-01', '2016-01-01', 0, NULL),
(8, 1, 'Zelf schrijver worden', NULL, 'Gerard Reve', 89, 9068900447, 'NL', 'D', '2016-01-01', '2016-01-01', 0, NULL),
(9, 1, 'Weerzin', NULL, 'Rene Appel', 259, 1, 'NL', 'D', '2016-01-01', '2016-01-01', 0, NULL),
(10, 1, 'Echte barkeepers heten Henk', NULL, 'Marja West ', 269, 9789026334078, 'NL', 'D', '2016-01-01', '2016-01-01', 0, NULL),
(12, 1, 'Trainspotting', NULL, 'Irvine Welsh', 344, 9780749336509, 'NL', 'B', NULL, NULL, 0, NULL),
(13, 1, 'Van kort verhaal naar roman', NULL, 'Inge Schouten', 123, 9789045702643, 'NL', 'D', '2016-01-01', '2016-01-01', 0, NULL),
(14, 1, 'Going Solo', NULL, 'Roald Dahl', 210, 9780142417416, 'EN', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(15, 0, 'Gangsterland', NULL, 'Tod Goldberg', 397, 9789021400501, 'NL', 'D', '2016-07-22', '2016-07-22', 0, NULL),
(16, 0, 'Biochips', NULL, 'William Gibson', 272, 9029043164, 'NL', 'D', '2016-01-01', '2016-01-01', 0, NULL),
(17, 1, 'De marathon revolutie', NULL, 'Stans van der Poel, Koen de Jong', 167, 9789491729416, 'NL', 'D', '2016-01-01', '2016-01-01', 0, NULL),
(18, 1, 'End Of Watch', NULL, 'Stephen King', 429, 9781501129742, 'EN', 'D', '2016-08-14', '2016-08-14', 0, NULL),
(19, 1, 'American Psycho', NULL, 'Brett Easton Ellis', 384, 9780330536301, 'EN', 'D', '2016-08-10', '2016-08-10', 0, NULL),
(20, 1, 'Kaas', NULL, 'Willem Elsschot', 114, 9789025363758, 'NL', 'D', '2016-08-10', '2016-08-10', 0, NULL),
(21, 1, 'Luckiest Girl Alive', NULL, 'Jessica Knoll', 399, 9781447286219, 'EN', 'D', '2016-08-12', '2016-08-12', 0, NULL),
(22, 1, 'Willem van Oranje', NULL, 'Jaap Ter Haar', 169, 9789020528053, 'NL', 'D', '2016-08-17', '2016-08-17', 0, NULL),
(23, 1, 'Boy', NULL, 'Roald Dahl', 176, 9780142417416, 'EN', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(24, 1, 'De Onderkant Van Sneeuw', NULL, 'Ilse Ruijters', 303, 9789048822072, 'NL', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(26, 1, 'The Great Gatsby', NULL, 'F. Scott Fitzgerald', 122, 9781853260414, 'EN', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(27, 1, 'The Girl On The Train', NULL, 'Paula Hawkins', 316, 9780857522320, 'EN', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(28, 1, 'Annihilation', NULL, 'Jeff Vandermeer', 195, 9780374104092, 'EN', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(29, 1, 'The City', NULL, 'Dean Koontz', 482, 9780812999129, 'EN', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(30, 1, 'Taal Is Zeg Maar Echt Mijn Ding', NULL, 'Paulien Cornelisse', 230, 9789025438838, 'NL', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(31, 1, 'Achtbaan', NULL, 'Stephen King', 95, 9024539781, 'NL', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(32, 1, 'Finders Keepers', NULL, 'Stephen King', 434, 9781501100079, 'EN', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(33, 1, 'Life Or Death', NULL, 'Michael Robotham', 418, 9780316252058, 'EN', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(34, 1, 'We are all completely beside ourselves', NULL, 'Karen Joy Fowler', 314, 9781846689666, 'EN', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(35, 1, 'The Execution', NULL, 'Dick Wolf', 381, 9780751551167, 'EN', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(36, 1, 'Geronimo', NULL, 'Leon de Winter', 362, 9789023493860, 'NL', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(37, 1, 'The quiet american', NULL, 'Graham Greene', 180, 9780099478393, 'EN', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(38, 1, 'Broken monsters', NULL, 'Lauren Beukes', 517, 9780007464616, 'EN', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(39, 1, 'De Paardentekenaar', NULL, 'Tim Krabbe', 255, 9789044613544, 'NL', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(40, 1, 'Mr Mercedes', NULL, 'Stephen King', 527, 9781501114953, 'EN', 'D', '2015-01-01', '2015-01-01', 0, NULL),
(41, 1, 'Nine Stories', NULL, 'J.D. Salinger', 302, 9780316767729, 'EN', 'D', '2016-12-02', '2016-12-02', 0, NULL),
(42, 1, 'Men Without Women', NULL, 'Ernest Hemingway', 131, 9780099909309, 'EN', 'D', '2016-12-18', '2016-12-18', 0, NULL),
(43, 1, 'The Art of Doing Twice the Work in Half the Time', NULL, 'jeff sutherland', 238, 9781847941107, 'EN', 'B', NULL, NULL, 0, NULL),
(44, 1, 'Tweede Adem', NULL, 'Thomas Braun', 191, 978904681579, 'NL', 'D', '2018-07-15', '2018-07-15', 0, NULL),
(45, 1, 'Mijn Verhaal ', NULL, 'Johan Cruijff', 278, 9789046821244, 'NL', 'D', '2017-11-23', '2017-11-23', 0, NULL),
(46, 1, 'Animal Farm', NULL, 'George Orwell', 95, 9780141036137, 'EN', 'D', '2016-12-11', '2016-12-11', 0, NULL),
(47, 1, 'Count Zero', NULL, 'William Gibson', 246, 9780441117734, 'EN', 'B', NULL, NULL, 0, NULL),
(48, 1, 'Neuromancer', NULL, 'William Gibson', 271, 9780441569595, 'EN', 'B', NULL, NULL, 0, NULL),
(49, 1, 'Agile Retrospectives', 'Making Good Teams Great', 'Esther Derby, Diana Larsen', 152, 977616649, 'EN', 'B', '2018-12-25', NULL, 0, NULL),
(51, 1, 'SCRUM', 'A revolutionary approach to building teams, beating deadlines and boosting productivity', 'Dr. Jeff Sutherland', 238, 9781847941091, 'EN', 'D', '2016-12-22', '2016-12-22', 0, NULL),
(52, 1, 'A Christmas Carol and Other Christmas Writings', '', 'Charles Dickens', 272, 9780141195858, 'EN', 'I', '2017-12-20', NULL, 0, NULL),
(53, 1, 'The Picture of Dorian Gray', '', 'Oscar Wilde', 252, 9780141442464, 'NL', 'B', '2018-09-30', NULL, 0, NULL),
(55, 1, 'Alice''s Adventures in Wonderland and Through the Looking Glass', '', 'Lewis Caroll', 358, 9780141192468, 'EN', 'B', NULL, NULL, 0, NULL),
(56, 1, 'Het begin van iets', '', 'Siegfried Lenz', 127, 9789461640321, 'NL', 'D', '2017-01-05', '2017-01-05', 0, NULL),
(57, 1, 'Bevrijd door liefde', '', 'Jan Geurtz', 1, 9789026327926, 'NL', 'D', '2017-05-16', '2017-05-16', 0, NULL),
(58, 1, 'Thomas Dekker - Mijn Gevecht', '', 'Thijs Zonneveld', 224, 9789048835157, 'NL', 'D', '2017-01-15', '2017-01-15', 0, NULL),
(59, 1, 'The Secret', 'Daily Teachings', 'Rhonda Byrne', 365, 9781471130618, 'NL', 'B', NULL, NULL, 0, NULL),
(60, 1, 'The Stories of Vladimir Nabokov', '', 'Vladimir Nabokov', 682, 9780679729976, 'NL', 'I', '2018-08-07', NULL, 0, NULL),
(61, 1, 'Het schrijven van een roman', 'Levensechte personages, overtuigende decors en beeldend taalgebruik', 'Arie Storm ', 128, 978021456959, 'NL', 'D', '2017-04-06', '2017-04-06', 0, NULL),
(62, 1, '''t Jagthuys', '', 'Merijn de Boer', 237, 9789021400280, 'NL', 'D', '2018-02-01', '2018-02-08', 0, NULL),
(63, 1, 'De verlossing van Liesbeth Bede', '', 'Sophie Zijlstra', 384, 9789021403458, 'NL', 'D', '2017-05-16', '2017-05-16', 0, NULL),
(64, 1, 'Margot', '', 'Sophie Zijlstra', 243, 9789021404974, 'NL', 'B', NULL, NULL, 0, NULL),
(66, 1, 'Making a Good Script Great', 'A Guide For Writing and Rewriting by Hollywood Consultant', 'Linda Seger', 252, 9781935247012, 'EN', 'D', '2017-08-02', '2017-08-02', 0, NULL),
(67, 1, 'The Art Of Fiction', '', 'David Lodge', 235, 9780099554240, 'EN', 'D', '2017-05-16', '2017-05-16', 0, NULL),
(68, 1, 'Aanvallend Spel', '', 'Thomas Rosenboom', 96, 9789021406169, 'NL', 'D', '2017-08-02', '2017-08-02', 0, NULL),
(69, 1, 'Geluk is D.O.M.', 'De drie bouwstenen voor geluk', 'Patrick van Hees', 176, 9789022578971, 'NL', 'B', NULL, NULL, 0, NULL),
(70, 1, 'Slaughterhouse Five', '', 'Kurt Vonnegut', 215, 9780440180296, 'EN', 'D', '2017-09-13', '2017-09-13', 0, NULL),
(71, 1, 'In Cold Blood', '', 'Truman Capote', 352, 9780241956830, 'EN', 'D', '2017-10-10', '2017-10-10', 0, NULL),
(72, 1, 'How Fiction Works', '', 'James Wood', 208, 9781845950934, 'EN', 'D', '2017-10-10', '2017-10-10', 0, NULL),
(73, 1, 'The Old Man and the Sea', '', 'Ernest Hemingway', 112, 9780099908401, 'EN', 'D', '2017-08-02', '2017-08-02', 0, NULL),
(74, 1, 'For Whom The Bell Tolls', '', 'Ernest Hemingway', 496, 9780099908609, 'EN', 'D', '2017-08-22', '2017-08-22', 0, NULL),
(75, 1, 'Zijn bloedige plan', '', 'Graeme Macrae Burnet', 304, 9789048838158, 'NL', 'D', '2017-11-22', '2017-11-22', 0, NULL),
(76, 1, 'Kleine Zwarte Leugens', '', 'Sharon Bolton', 416, 9789400508064, 'NL', 'D', '2017-11-22', '2017-11-22', 0, NULL),
(77, 1, 'Alweer een Bestseller', 'schrijftips en belevenissen van twee literair agenten', 'Paul Sebes', 256, 9789021402970, 'NL', 'D', '2017-09-13', '2017-09-13', 0, NULL),
(78, 1, 'Ragdoll', '', 'Daniel Cole', 400, 9789024574988, 'NL', 'D', '2017-08-22', '2017-08-22', 0, NULL),
(79, 1, 'Drie Minuten', '', 'Anders Roslund, Borge Hellstrom', 540, 9789044535594, 'NL', 'D', '2017-11-03', '2017-11-03', 0, NULL),
(80, 1, 'Bloedbroers', '', 'Anders Roslund, Stefan Thunberg', 480, 9789044534030, 'NL', 'D', '2017-08-22', '2017-08-22', 0, NULL),
(81, 1, 'Tijden van duisternis', '', 'Tony Schumacher', 400, 9789022579268, 'NL', 'D', '2017-08-22', '2017-08-22', 0, NULL),
(82, 1, 'Dagboek uit de rivier', '', 'Frederik Baas', 214, 9789026337543, 'NL', 'D', '2017-10-17', '2017-10-17', 0, NULL),
(83, 1, 'Nooit meer te druk', 'een opgeruimd hoofd in een overvolle wereld', 'Tony Crabbe', 384, 9789024572687, 'NL', 'D', '2017-10-17', '2017-10-17', 0, NULL),
(84, 1, 'Laravel Up And Running', 'A framework for building modern PHP apps', 'Matt Stauffer', 454, 9781491936085, 'EN', 'B', NULL, NULL, 0, NULL),
(85, 1, 'Niks', '', 'Koen Goebbels', 278, 9789026335419, 'NL', 'D', '2017-11-03', '2017-11-03', 9200000059583332, NULL),
(86, 1, 'Eat that frog', 'dÃ© methode om te stoppen met uitstellen en superproductief te worden', 'Brian Tracy', 172, 9789492493071, 'NL', 'D', '2017-12-01', '2017-12-01', 9200000059295510, NULL),
(87, 1, 'Uitverkoren', '', 'A F Th van der Heijden', 224, 9789023486916, 'NL', 'D', '2017-12-01', '2017-12-01', 0, NULL),
(88, 1, 'Goede dochter', '', 'Karin Slaughter', 512, 9789402726800, 'NL', 'D', '2017-12-21', '2017-12-21', 0, NULL),
(89, 1, 'The Subtle Art of Not Giving a Fuck', 'A Counterintuitive Approach to Living a Good Life', 'Mark Manson', 212, 9780062641540, 'EN', 'D', '2017-12-22', '2017-12-22', 9200000063067905, NULL),
(90, 1, 'Oom Willibrord', '', 'Jan Terlouw', 173, 9020851993, 'NL', 'D', '2018-01-30', '2018-01-31', 0, NULL),
(91, 1, 'De kracht van ChiRunning', 'mindful, efficient en blessurevrij hardlopen', 'Marion Weesters', 192, 9789491729096, 'NL', 'D', '2018-01-02', '2018-01-04', 9200000027121733, NULL),
(92, 1, 'Fok', 'Nanda Huneman', 'Nanda Huneman', 307, 9789089546630, 'NL', 'D', '2018-01-04', '2018-01-12', 9200000031398002, NULL),
(93, 1, 'Ikigai', 'de Japanse geheimen voor een lang, gezond en gelukkig leven', 'Francesc Miralles', 192, 9789022578452, 'NL', 'D', '2018-01-16', '2018-01-27', 9200000060212722, NULL),
(94, 1, 'Dingen die je alleen ziet als je er de tijd voor neemt', 'Rust vinden in een drukke wereld', 'Haemin Sunim', 280, 9789022581124, 'NL', 'D', '2018-07-15', '2018-08-03', 9200000075963552, NULL),
(95, 1, 'Why I Write', '', 'George Orwell', 128, 9780141019000, 'EN', 'D', '2018-01-12', '2018-01-17', 1001004002115362, NULL),
(96, 1, 'Social Media for Writers', 'Marketing Strategies for Building Your Audience and Selling Books', 'Tee Morris, Pip Ballantine ', 288, 9781599639260, 'EN', 'D', '2018-01-23', '2018-02-12', 9200000040787904, NULL),
(97, 1, 'Gids voor de kantoorjungle', '', 'Japke-d. Bouma', 160, 9789041711717, 'NL', 'D', '2018-01-27', '2018-01-30', 9200000047087971, NULL),
(98, 1, 'De Gedaanteverwisseling', '', 'Franz Kafka', 61, 8710371001842, 'NL', 'D', '2018-02-08', '2018-02-12', 0, NULL),
(99, 1, 'De zwarte keizer', '', 'Hugo Claus', 201, 9789052406183, 'NL', 'D', '2018-02-13', '2018-08-31', 0, NULL),
(100, 1, 'Bruiloften en partijen', '', 'David Mulder', 230, 9789041414557, 'NL', 'D', '2018-03-23', '2018-03-23', 0, NULL),
(101, 1, 'Poetica', '', 'Aristoteles', 172, 9789065540096, 'NL', 'D', '2018-03-23', '2018-03-23', 0, NULL),
(102, 1, 'De Ring Gesloten ', '', 'Knut Hamsun', 316, 9789029518888, 'NL', 'D', '2018-03-23', '2018-03-26', 0, NULL),
(103, 1, 'The Churchill Factor', 'How One Man Made History', 'Boris Johnson', 416, 9781444783032, 'EN', 'D', '2018-03-27', '2018-04-29', 0, NULL),
(104, 1, 'A Brief History Of Time', 'From Big Bang To Black Holes', 'Stephen Hawking', 272, 9780857501004, 'EN', 'I', '2018-04-29', NULL, 0, NULL),
(105, 1, 'Go Set a Watchman', '', 'Harper Lee, Lee Smith ', 288, 9780062454812, 'EN', 'D', '2018-04-29', '2018-05-14', 0, NULL),
(106, 1, 'The Elements of Eloquence', 'How to Turn the Perfect English Phrase', 'Mark Forsyth', 208, 9781785781728, 'EN', 'D', '2018-07-15', '2018-07-15', 0, NULL),
(107, 1, 'Tussen een persoon', '', 'Esther Gerritsen', 144, 9789044504569, 'NL', 'D', '2018-05-14', '2018-07-15', 0, NULL),
(108, 1, 'Het Schervengericht', '', 'A F Th van der Heijden', 1051, 9789021434384, 'NL', 'D', '2018-07-15', '2018-07-15', 0, NULL),
(110, 1, 'Gezien de Feiten', '', 'Griet op de Beeck', 94, 9789059654334, 'NL', 'D', '2018-08-03', '2018-08-03', 0, NULL),
(111, 1, 'Mamet Plays', 'v.1: Duck Variations , Sexual Perversity in Chicago , Squirrels , American Buffalo , The Water Engine , Mr.Happiness', 'David Mamet', 352, 9780413645906, 'EN', 'D', '2018-08-03', '2018-08-07', 0, NULL),
(112, 1, 'De nachtploeg', 'Misdaad slaapt nooit. Net als detective RenÃ©e Ballard', ' Michael Connelly', 368, 9789022583500, 'NL', 'D', '2018-08-07', '2018-08-16', 0, NULL),
(113, 1, 'Het beste wat we hebben', '', 'Griet Op de Beeck', 320, 9789044629378, 'NL', 'D', '2018-08-11', '2018-08-23', 0, NULL),
(114, 1, 'Ja-maar... Omdenken', 'kijk - denk - creÃ«er', 'Berthold Gunster', 64, 9789022996973, 'NL', 'D', '2018-08-11', '2018-08-11', 0, NULL),
(115, 1, 'Kom hier dat ik u kus', '', 'Griet Op de Beeck', 336, 9789044623109, 'NL', 'D', '2018-10-25', '2018-11-15', 0, NULL),
(116, 1, 'De ontdekking van de literatuur', 'the Paris Review interviews', 'Joost Zwagerman', 539, 9789023425618, 'NL', 'B', NULL, NULL, 0, NULL),
(117, 1, 'De geheimen van de retorica', 'tien Groninger opstellen', 'diverse', 224, 9789460360497, 'NL', 'B', NULL, NULL, 0, NULL),
(118, 1, 'Retorica', '', 'Aristoteles', 276, 9789065540072, 'NL', 'B', NULL, NULL, 0, NULL),
(119, 1, 'Hier zet men thee en over de Eufraat', 'zeugma, stijlfiguur met een krulstaartje', 'Han van Gorkom', 165, 9789076982410, 'NL', 'B', NULL, NULL, 0, NULL),
(120, 1, 'Retorica', 'de kunst van het spreken', 'Jeroen Bons', 112, 9789492538284, 'NL', 'B', NULL, NULL, 0, NULL),
(121, 1, 'Verzameld werk', '', ' William Shakespeare', 3712, 9789085425588, 'NL', 'B', NULL, NULL, 0, NULL),
(122, 1, 'complete collected short stories', 'Volume One', 'Roald Dahl', 596, 9781405910101, 'EN', 'D', '2018-08-31', '2018-09-30', 0, NULL),
(123, 1, 'The Complete Short Stories 2', 'Volume Two', 'Roald Dahl', 802, 9781405910118, 'EN', 'D', '2018-09-30', '2018-10-25', 0, NULL),
(124, 1, 'TA elke dag', '', ' Marijke Arendsen Hein', 75, 9789088500633, 'NL', 'D', '2018-11-15', '2018-11-15', 0, NULL),
(125, 1, 'Millennium 4 - Wat ons niet zal doden', 'The Girl in the Spider''s Web', 'David Lagercrantz', 448, 9789056726171, 'NL', 'D', '2018-12-04', '2018-12-04', 0, NULL),
(126, 1, 'Mythos', 'De griekse mythen herverteld', 'Stephen Fry', 448, 9789400406254, 'NL', 'D', '2018-12-04', '2018-12-13', 0, NULL),
(127, 1, 'Let op mijn woorden', '', 'Griet op de Beeck', 415, 9789044636161, 'NL', 'D', '2019-12-26', '2019-12-26', 0, NULL),
(128, 1, 'Hoe overleef ik moeilijke mensen ', '', 'Jorg Bender', 176, 9789023954477, 'NL', 'D', '2019-12-26', '2019-12-26', 0, NULL),
(129, 1, 'Everything is fucked', 'a book about hope', 'Mark Manson', 273, 9780062888464, 'EN', 'D', '2019-12-26', '2019-12-26', 0, NULL),
(130, 1, 'The order of the day', '', 'Eric Vuillard', 129, 9781509889976, 'EN', 'D', '2019-12-26', '2019-12-26', 0, NULL),
(131, 1, 'The handmaid''s tale', '', 'Margaret Atwood', 320, 9781784874872, 'EN', 'D', '2019-12-26', '2019-12-26', 0, NULL),
(132, 1, 'Hoe schrijf ik zelf een waanzinnig boek', '', 'Andy Griffiths, Terry Denton', 205, 9789401438353, 'NL', 'D', '2019-12-26', '2019-12-26', 0, NULL),
(133, 1, 'Treasure Island and The Ebb-Tide', '', 'Robert Louis Stevenson', 400, 9780141199146, 'EN', 'D', '2019-12-26', '2019-12-26', 0, NULL),
(134, 1, 'One Good Deed', '', 'David Baldacci', 432, 9781529027525, 'EN', 'D', '2019-12-26', '2019-12-26', 0, NULL),
(135, 1, 'Van het westelijk front geen nieuws', '', 'Erich Maria Remarque', 203, 9789061317647, 'NL', 'D', '2019-12-26', '2019-12-26', 0, NULL),
(136, 1, 'Dare to Lead', '', 'BrenÃ© Brown', 320, 9781785042140, 'EN', 'D', '2019-12-26', '2019-12-26', 0, NULL),
(137, 1, 'The Comedy Bible', '', 'Judy Carter', 367, 9780743201254, 'EN', 'D', '2019-12-26', '2019-12-26', 0, NULL),
(138, 1, 'The Raven and the Philosophy of Composition', '', 'Edgar Allan Poe, Galen J Perrett ', 64, 9783337364670, 'EN', 'D', '2019-12-26', '2019-12-26', 0, NULL),
(139, 1, 'Perks of being a wallflower', '', 'Stephen Chbosky', 240, 9781471116148, 'EN', 'D', '2019-12-26', '2019-12-26', 0, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `cdlanguage` char(3) NOT NULL,
  `nmlanguage` varchar(50) NOT NULL,
  PRIMARY KEY (`cdlanguage`),
  UNIQUE KEY `nmlanguage` (`nmlanguage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `languages`
--

INSERT INTO `languages` (`cdlanguage`, `nmlanguage`) VALUES
('EN', 'Engels'),
('NL', 'Nederlands');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `persons`
--

DROP TABLE IF EXISTS `persons`;
CREATE TABLE IF NOT EXISTS `persons` (
  `idperson` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `gender` char(1) NOT NULL DEFAULT 'M',
  PRIMARY KEY (`idperson`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Gegevens worden geëxporteerd voor tabel `persons`
--

INSERT INTO `persons` (`idperson`, `name`, `gender`) VALUES
(1, 'Marijke Arendsen Hein', 'F'),
(2, 'Michael Connelly', 'M'),
(3, 'William Shakespeare', 'M'),
(4, 'A F Th van der Heijden', 'M'),
(5, 'Anders Roslund', 'M'),
(6, 'Stefan Thunberg', 'M'),
(7, 'Arie Storm', 'M'),
(8, 'Aristoteles', 'M'),
(9, 'Bernard Shaw', 'M'),
(10, 'Berthold Gunster', 'M'),
(11, 'Boris Johnson', 'M'),
(12, 'Brett Easton Ellis', 'M'),
(13, 'Brian Tracy', 'M'),
(14, 'Charles Dickens', 'M'),
(15, 'Daniel Cole', 'M'),
(16, 'David Lagercrantz', 'M'),
(17, 'David Lodge', 'M'),
(18, 'David Mamet', 'M'),
(19, 'David Mulder', 'M'),
(20, 'Dean Koontz', 'M'),
(21, 'Dick Wolf', 'M'),
(22, 'diverse', 'M'),
(23, 'Dr. Jeff Sutherland', 'M'),
(24, 'Ernest Hemingway', 'M'),
(25, 'Diana Larsen', 'F'),
(26, 'Esther Gerritsen', 'F'),
(27, 'F. Scott Fitzgerald', 'M'),
(28, 'Francesc Miralles', 'M'),
(29, 'Franz Kafka', 'M'),
(30, 'Frederik Baas', 'M'),
(31, 'George Orwell', 'M'),
(32, 'Gerard Reve', 'M'),
(33, 'Graeme Macrae Burnet', 'M'),
(34, 'Graham Greene', 'M'),
(35, 'Griet op de Beeck', 'F'),
(36, 'Haemin Sunim', 'M'),
(37, 'Hal Elrod', 'M'),
(38, 'Han van Gorkom', 'M'),
(39, 'Harper Lee', 'F'),
(40, 'Hugo Claus', 'M'),
(41, 'Ilse Ruijters', 'F'),
(42, 'Inge Schouten', 'F'),
(43, 'Irvine Welsh', 'M'),
(44, 'J.D. Salinger', 'M'),
(45, 'Jaap Ter Haar', 'M'),
(46, 'James Wood', 'M'),
(47, 'Jan Brokken', 'M'),
(48, 'Jan Geurtz', 'M'),
(49, 'Jan Terlouw', 'M'),
(50, 'Japke-d. Bouma', 'F'),
(51, 'Jeff sutherland', 'M'),
(52, 'Jeff Vandermeer', 'M'),
(53, 'Jeroen Bons', 'M'),
(54, 'Jessica Knoll', 'F'),
(55, 'Johan Cruijff', 'M'),
(56, 'Joost Zwagerman', 'M'),
(57, 'Karen Joy Fowler', 'F'),
(58, 'Karin Slaughter', 'F'),
(59, 'Knut Hamsun', 'M'),
(60, 'Koen Goebbels', 'M'),
(61, 'Kurt Vonnegut', 'M'),
(62, 'Lauren Beukes', 'F'),
(63, 'Leon de Winter', 'M'),
(64, 'Lewis Caroll', 'M'),
(65, 'Linda Seger', 'F'),
(66, 'Marion Weesters', 'F'),
(67, 'Marja West', 'F'),
(68, 'Mark Forsyth', 'M'),
(69, 'Mark Manson', 'M'),
(70, 'Matt Stauffer', 'M'),
(71, 'Merijn de Boer', 'M'),
(72, 'Michael Robotham', 'M'),
(73, 'Nanda Huneman', 'F'),
(74, 'Oscar Wilde', 'M'),
(75, 'Patrick van Hees', 'M'),
(76, 'Paul Sebes', 'M'),
(77, 'Paula Hawkins', 'F'),
(78, 'Paulien Cornelisse', 'F'),
(79, 'Rene Appel', 'M'),
(80, 'Rhonda Byrne', 'F'),
(81, 'Roald Dahl', 'M'),
(82, 'Sharon Bolton', 'M'),
(83, 'Siegfried Lenz', 'M'),
(84, 'Sophie Zijlstra', 'F'),
(85, 'Stans van der Poel', 'M'),
(86, 'Stephen Fry', 'M'),
(87, 'Stephen Hawking', 'M'),
(88, 'Stephen King', 'M'),
(89, 'Stephen R. Covey', 'M'),
(90, 'Steve Suehring', 'M'),
(91, 'Tee Morris', 'M'),
(92, 'Thijs Zonneveld', 'M'),
(93, 'Thomas Braun', 'M'),
(94, 'Thomas Rosenboom', 'M'),
(95, 'Tim Krabbe', 'M'),
(96, 'Tod Goldberg', 'M'),
(97, 'Tony Crabbe', 'M'),
(98, 'Tony Schumacher', 'M'),
(99, 'Truman Capote', 'M'),
(100, 'Vladimir Nabokov', 'M'),
(101, 'Willem Elsschot', 'M'),
(102, 'William Gibson', 'M'),
(103, 'Borge Hellstrom', 'M'),
(104, 'Diana Larsen', 'F'),
(105, 'Lee Smith', 'M'),
(106, 'Koen de Jong', 'M'),
(107, 'Pip Ballantine', 'F');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `userattempts`
--

DROP TABLE IF EXISTS `userattempts`;
CREATE TABLE IF NOT EXISTS `userattempts` (
  `iduserattempt` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `nmlogin` varchar(150) NOT NULL,
  `nmpassword` varchar(20) NOT NULL,
  `dtlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`iduserattempt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='User Attempts Table' AUTO_INCREMENT=18 ;

--
-- Gegevens worden geëxporteerd voor tabel `userattempts`
--

INSERT INTO `userattempts` (`iduserattempt`, `iduser`, `nmlogin`, `nmpassword`, `dtlogin`) VALUES
(1, NULL, 'ddd', 'ddd', '2016-05-13 12:08:21'),
(2, NULL, 'admin', 'Secret2016', '2016-05-13 12:09:31'),
(3, NULL, 'ioioioio', 'oipioipoipo', '2016-05-13 12:11:42'),
(4, NULL, 'admin', 'Secret2016', '2016-05-13 12:11:51'),
(5, NULL, 'admin', 'Secret2016', '2016-05-13 12:15:13'),
(6, NULL, 'admin', 'Secret2016', '2016-05-13 12:22:18'),
(7, NULL, 'admin', 'Secret2016', '2016-05-13 12:23:22'),
(8, NULL, 'admin', 'Secret2016', '2016-05-13 12:27:55'),
(9, NULL, 'admin', 'Secret2016', '2016-05-13 12:28:47'),
(10, NULL, 'info@localhost.nl', 'Secret', '2016-05-13 12:29:02'),
(11, NULL, 'info@localhost.nl', 'Secret', '2016-05-13 12:30:19'),
(12, NULL, 'info@localhost.nl', 'Secret', '2016-05-13 12:30:57'),
(13, NULL, 'info@localhost.nl', 'Secret', '2016-05-13 12:31:53'),
(14, NULL, 'info@localhost.nl', 'Secret2016', '2016-05-13 12:32:06'),
(15, NULL, 'info@localhost.nl', 'Secret2016', '2016-05-13 12:33:20'),
(16, NULL, 'info@localhost.nl', 'Secret2016', '2016-05-13 12:33:46'),
(17, NULL, 'admin', 'Museum2016', '2016-05-17 11:38:02');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `userpasswords`
--

DROP TABLE IF EXISTS `userpasswords`;
CREATE TABLE IF NOT EXISTS `userpasswords` (
  `iduserpassword` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `nmpassword` int(11) NOT NULL,
  PRIMARY KEY (`iduserpassword`),
  KEY `iduser` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User Passwords Table' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `nmuser` varchar(20) NOT NULL,
  `ftemail` varchar(150) NOT NULL,
  `nmpassword` varchar(20) NOT NULL,
  `cdstatus` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`iduser`),
  UNIQUE KEY `nmuser` (`nmuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='User table' AUTO_INCREMENT=12 ;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`iduser`, `nmuser`, `ftemail`, `nmpassword`, `cdstatus`) VALUES
(1, 'admin', 'info@localhost.nl', 'Secret2016', 'N'),
(11, 'dennis', 'dennis.vorst@ziggo.nl', 'dddd', 'A');

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`cdlanguage`) REFERENCES `languages` (`cdlanguage`);

--
-- Beperkingen voor tabel `userpasswords`
--
ALTER TABLE `userpasswords`
  ADD CONSTRAINT `userpasswords_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
