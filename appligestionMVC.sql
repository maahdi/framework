--lol
-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 03 Juin 2013 à 21:27
-- Version du serveur: 5.5.31-MariaDB-log
-- Version de PHP: 5.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `appligestionmvc`
--
CREATE DATABASE IF NOT EXISTS `appligestionmvc` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `appligestionmvc`;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `idArticle` int(5) NOT NULL,
  `refArticle` varchar(20) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `prixHT` float NOT NULL,
  `txTVA` float NOT NULL,
  `stock` int(3) NOT NULL,
  `stockTheorique` int(11) NOT NULL,
  `idFournisseur` int(5) NOT NULL,
  PRIMARY KEY (`idArticle`),
  KEY `idFournisseur` (`idFournisseur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `articles`
--

REPLACE INTO `articles` (`idArticle`, `refArticle`, `designation`, `prixHT`, `txTVA`, `stock`, `stockTheorique`, `idFournisseur`) VALUES
(4000, 'FXR79DNR7WV', 'salut a toi l\\''amiee', 65.52, 12.1, 8, 7, 3002),
(4001, 'UEW31OBE1KG', 'Hello world !!', 4520.58, 19.6, 10, 10, 3009),
(4002, 'YCT68RTJ3MG', 'eleifend nec, malesuada ut, sem.', 200.515, 19.6, 5, 4, 3009),
(4003, 'YVB82EKH3OR', 'cursus, diam at pretium aliquet,', 200.515, 19.6, 5, 5, 3005),
(4004, 'HZO05KRI7BV', 'erat semper rutrum. Fusce dolor', 800.959, 19.6, 4, 4, 3000),
(4005, 'CNX13EIT4RI', 'vulputate ullamcorper magna. Sed eu', 2000, 19.6, 7, 7, 3001),
(4006, 'UAC30RTS0OT', 'ac turpis egestas. Aliquam fringilla', 3614, 19.6, 9, 9, 3004),
(4007, 'RCY62ITP0EG', 'aliquet libero. Integer in magna.', 1856, 19.6, 6, 6, 3001),
(4008, 'KIE56FFM9FA', 'velit in aliquet lobortis, nisi', 499, 19.6, 6, 6, 3007),
(4009, 'MHU49BUR6WV', 'eget mollis lectus pede et', 1874, 19.6, 3, 3, 3004),
(4010, 'LOU60MWG9UM', 'mi. Aliquam gravida mauris ut', 2944, 19.6, 6, 4, 3006),
(4011, 'EBX94UAH4QE', 'Nunc mauris. Morbi non sapien', 3172, 19.6, 5, 5, 3004),
(4012, 'ZYZ75BGK3FF', 'eget, venenatis a, magna. Lorem', 1083, 19.6, 7, 7, 3003),
(4013, 'TWJ68WLV1WM', 'condimentum eget, volutpat ornare, facilisis', 988, 19.6, 7, 7, 3008),
(4014, 'OYS57HPZ7XE', 'vulputate, nisi sem semper erat,', 4061, 19.6, 4, 4, 3006),
(4015, 'ZCL37HFE1JA', 'hendrerit. Donec porttitor tellus non', 4091, 19.6, 2, 2, 3006),
(4016, 'MTN12GMW2ET', 'volutpat. Nulla dignissim. Maecenas ornare', 548, 19.6, 4, 4, 3007),
(4017, 'RLU17NJA6MJ', 'ac orci. Ut semper pretium', 449, 19.6, 4, 4, 3009),
(4018, 'QNQ16XJD7PI', 'non, dapibus rutrum, justo. Praesent', 5819, 19.6, 4, 4, 3010),
(4019, 'RBK41FAO1SA', 'magna. Duis dignissim tempor arcu.', 2489, 19.6, 3, 2, 3006),
(4020, 'HSC98UVG9PV', 'quam vel sapien imperdiet ornare.', 1003, 19.6, 7, 7, 3007),
(4021, 'DMS59XTZ4YR', 'amet orci. Ut sagittis lobortis', 3020, 19.6, 3, 3, 3006),
(4022, 'CJH22DAC3ZS', 'sit amet lorem semper auctor.', 1472, 19.6, 9, 9, 3010),
(4023, 'XZM65KNG3ZE', 'orci. Phasellus dapibus quam quis', 2724, 19.6, 7, 7, 3001),
(4024, 'AUM30TLA8VZ', 'hendrerit. Donec porttitor tellus non', 187, 19.6, 3, 3, 3004),
(4025, 'ACL47YXG2HF', 'faucibus lectus, a sollicitudin orci', 2085, 19.6, 7, 7, 3001),
(4026, 'MRW99XSL9PG', 'lectus pede et risus. Quisque', 1026, 19.6, 3, 3, 3001),
(4027, 'PHF07ZZQ2EX', 'porttitor interdum. Sed auctor odio', 3634, 19.6, 3, 3, 3001),
(4028, 'RSV56VLK2JZ', 'mus. Proin vel nisl. Quisque', 1590, 19.6, 2, 2, 3008),
(4029, 'JSC57VOS4TX', 'Vivamus molestie dapibus ligula. Aliquam', 1390, 19.6, 6, 6, 3006),
(4030, 'JFI17AZF4GP', 'Vivamus molestie dapibus ligula. Aliquam', 4654, 19.6, 9, 9, 3005),
(4031, 'OFF67ZMI6YC', 'suscipit, est ac facilisis facilisis,', 1990, 19.6, 4, 4, 3001),
(4032, 'YQH28CHU3RB', 'libero. Morbi accumsan laoreet ipsum.', 497, 19.6, 9, 9, 3008),
(4033, 'OKY80SUN0MM', 'Donec feugiat metus sit amet', 495, 19.6, 8, 8, 3004),
(4034, 'ETB40XOI6WA', 'Suspendisse ac metus vitae velit', 4601, 19.6, 2, 2, 3006),
(4035, 'NQY44AEG5FS', 'id, erat. Etiam vestibulum massa', 2072, 19.6, 8, 8, 3009),
(4036, 'TYO84PSZ9KW', 'Curabitur massa. Vestibulum accumsan neque', 1047, 19.6, 7, 7, 3010),
(4037, 'SDQ65CST3GY', 'Ut tincidunt vehicula risus. Nulla', 1623, 19.6, 3, 3, 3008),
(4038, 'CBT68EFP1DA', 'consectetuer adipiscing elit. Curabitur sed', 338, 19.6, 2, 2, 3006),
(4039, 'AXT65HTH0CN', 'aliquet nec, imperdiet nec, leo.', 826, 19.6, 8, 8, 3002),
(4040, 'XWH64EVS7ZW', 'dictum eu, placerat eget, venenatis', 5918, 19.6, 9, 9, 3010),
(4041, 'PXW35LQJ7RL', 'egestas rhoncus. Proin nisl sem,', 3873, 19.6, 6, 6, 3000),
(4042, 'XMW11JJZ0DZ', 'ac mattis velit justo nec', 5435, 19.6, 9, 9, 3008),
(4043, 'WOT78IDN6WE', 'egestas a, dui. Cras pellentesque.', 1200, 19.6, 9, 9, 3007),
(4044, 'DSE09IJG2LK', 'lobortis. Class aptent taciti sociosqu', 2340, 19.6, 3, 3, 3002),
(4045, 'FET98QGA1XX', 'lacus. Aliquam rutrum lorem ac', 251, 19.6, 1, 1, 3001),
(4046, 'SDX81UEM0LY', 'tellus eu augue porttitor interdum.', 4326, 19.6, 4, 4, 3008),
(4047, 'YNX64UJS7NQ', 'vel lectus. Cum sociis natoque', 5236, 19.6, 7, 7, 3007),
(4048, 'BJU92YSJ4UV', 'ligula. Nullam feugiat placerat velit.', 1459, 19.6, 6, 6, 3007),
(4049, 'ZMG81RQN3LA', 'malesuada id, erat. Etiam vestibulum', 40, 19.6, 10, 10, 3007),
(4050, 'UYA58FOP5ZJ', 'leo. Cras vehicula aliquet libero.', 2211, 19.6, 6, 6, 3010),
(4051, 'BOL34PZC1JO', 'Integer vitae nibh. Donec est', 2482, 19.6, 7, 7, 3000),
(4052, 'BLZ00WIP4XO', 'Quisque imperdiet, erat nonummy ultricies', 1955, 19.6, 10, 10, 3004),
(4053, 'HZZ62LHH5KR', 'amet risus. Donec egestas. Aliquam', 3204, 19.6, 1, 1, 3008),
(4054, 'ODF52HKO8VL', 'nulla. Cras eu tellus eu', 3934, 19.6, 8, 8, 3004),
(4055, 'BAJ07RMA9AK', 'Donec consectetuer mauris id sapien.', 721, 19.6, 10, 10, 3007),
(4056, 'WMW00CJL6GH', 'nibh. Quisque nonummy ipsum non', 4244, 19.6, 10, 10, 3009),
(4057, 'CZX40QDM6CM', 'quam, elementum at, egestas a,', 4426, 19.6, 6, 6, 3010),
(4058, 'LMM25NKY9AE', 'lobortis. Class aptent taciti sociosqu', 820, 19.6, 9, 9, 3002),
(4059, 'ZZF84FMO7DR', 'turpis. Aliquam adipiscing lobortis risus.', 1061, 19.6, 5, 5, 3008),
(4060, 'DVG51VCN7BO', 'vulputate, lacus. Cras interdum. Nunc', 2067, 19.6, 7, 7, 3009),
(4061, 'NRU75FZA7RD', 'sodales nisi magna sed dui.', 5233, 19.6, 4, 4, 3009),
(4062, 'RLS90WTD3NF', 'velit justo nec ante. Maecenas', 2774, 19.6, 6, 6, 3006),
(4063, 'HCG08UHU8CL', 'interdum. Nunc sollicitudin commodo ipsum.', 3421, 19.6, 4, 4, 3002),
(4064, 'LZR19SZR8JF', 'Pellentesque habitant morbi tristique senectus', 1897, 19.6, 7, 7, 3006),
(4065, 'XYS10NZH3UK', 'tellus id nunc interdum feugiat.', 4307, 19.6, 10, 10, 3000),
(4066, 'YKC65AIN6EX', 'et, euismod et, commodo at,', 1542, 19.6, 3, 3, 3006),
(4067, 'WDM53MBH7JB', 'malesuada ut, sem. Nulla interdum.', 961, 19.6, 8, 8, 3001),
(4068, 'GSO33CIR6AW', 'eu nibh vulputate mauris sagittis', 5542, 19.6, 2, 2, 3008),
(4069, 'MZW95ELP4FZ', 'vehicula et, rutrum eu, ultrices', 2425, 19.6, 2, 2, 3002),
(4070, 'OJZ06IEA0UA', 'ultrices. Duis volutpat nunc sit', 2020, 19.6, 10, 10, 3010),
(4071, 'BKY93LDU0PA', 'lacus. Quisque purus sapien, gravida', 663, 19.6, 4, 4, 3001),
(4072, 'JYM30ERF1RZ', 'augue ac ipsum. Phasellus vitae', 3290, 19.6, 4, 4, 3001),
(4073, 'NKO43YXM7YB', 'ultrices posuere cubilia Curae; Donec', 5847, 19.6, 2, 2, 3001),
(4074, 'CNB58CTN2XE', 'Morbi vehicula. Pellentesque tincidunt tempus', 679, 19.6, 8, 8, 3006),
(4075, 'GGZ87ITQ7MP', 'eu metus. In lorem. Donec', 1362, 19.6, 6, 6, 3010),
(4076, 'IRN42JNZ8UX', 'habitant morbi tristique senectus et', 467, 19.6, 10, 10, 3008),
(4077, 'QGB60TYV3SH', 'quis, pede. Suspendisse dui. Fusce', 3288, 19.6, 6, 6, 3005),
(4078, 'NWE02KKT4GO', 'enim, condimentum eget, volutpat ornare,', 1994, 19.6, 7, 7, 3003),
(4079, 'CGO18QXV4HN', 'dignissim pharetra. Nam ac nulla.', 1417, 19.6, 2, 2, 3002),
(4080, 'SPB86IIA0SG', 'at, iaculis quis, pede. Praesent', 362, 19.6, 6, 6, 3002),
(4081, 'JSN98KNT2YA', 'Vestibulum ante ipsum primis in', 4085, 19.6, 3, 3, 3008),
(4082, 'XZJ98ZHE9KX', 'Sed id risus quis diam', 276, 19.6, 10, 10, 3009),
(4083, 'HIN72JEU1KS', 'enim. Mauris quis turpis vitae', 812, 19.6, 5, 4, 3004),
(4084, 'XHJ22GHO4GZ', 'aliquet diam. Sed diam lorem,', 3187, 19.6, 10, 10, 3003),
(4085, 'JHQ80XHG6KQ', 'fringilla est. Mauris eu turpis.', 3432, 19.6, 8, 8, 3008),
(4086, 'ZRC39JPF9AM', 'nisi sem semper erat, in', 2444, 19.6, 2, 2, 3009),
(4087, 'SJE32GHO4YY', 'Aenean massa. Integer vitae nibh.', 2024, 19.6, 6, 6, 3009),
(4088, 'DMP28NPL7NL', 'diam luctus lobortis. Class aptent', 2706, 19.6, 10, 10, 3003),
(4089, 'IPR59YTG4GE', 'felis orci, adipiscing non, luctus', 2280, 19.6, 5, 5, 3010),
(4090, 'HPM88HJL7DZ', 'id ante dictum cursus. Nunc', 2480, 19.6, 5, 5, 3000),
(4091, 'RTP32OHA8TG', 'ut mi. Duis risus odio,', 1274, 19.6, 7, 7, 3005),
(4092, 'EWC67XYC3QG', 'ultrices a, auctor non, feugiat', 4952, 19.6, 7, 7, 3007),
(4093, 'WIM46SBY7WS', 'dui. Fusce diam nunc, ullamcorper', 4968, 19.6, 10, 10, 3006),
(4094, 'HBL37EHQ2QH', 'gravida molestie arcu. Sed eu', 5597, 19.6, 4, 4, 3002),
(4095, 'QYN14FVM1OI', 'blandit. Nam nulla magna, malesuada', 3061, 19.6, 2, 2, 3008),
(4096, 'BLV48ORC1YS', 'adipiscing non, luctus sit amet,', 2821, 19.6, 7, 7, 3005),
(4097, 'QHM13XKF3OU', 'neque. Morbi quis urna. Nunc', 2539, 19.6, 3, 3, 3009),
(4098, 'EIH08COM1SK', 'a ultricies adipiscing, enim mi', 1098, 19.6, 9, 9, 3005),
(4099, 'SNU27FDC4NR', 'amet lorem semper auctor. Mauris', 1457, 19.6, 1, 1, 3005);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `idClient` int(4) NOT NULL,
  `nomClient` varchar(20) DEFAULT NULL,
  `prenomClient` varchar(20) DEFAULT NULL,
  `emailClient` varchar(50) NOT NULL,
  `adresseClient` varchar(50) DEFAULT NULL,
  `cpClient` int(5) DEFAULT NULL,
  `idPays` int(4) DEFAULT NULL,
  PRIMARY KEY (`idClient`),
  KEY `idPays` (`idPays`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `clients`
--

REPLACE INTO `clients` (`idClient`, `nomClient`, `prenomClient`, `emailClient`, `adresseClient`, `cpClient`, `idPays`) VALUES
(2006, 'POULET', 'Bernard', 'eu@euaugueporttitor.ca', '12 rue de Marseille', 12000, 1),
(2007, 'Callie', 'French', '', 'P.O. Box 235, 2080 At St.', 0, 2),
(2010, 'Henry', 'Dudley', 'sem.eget.massa@Quisque.ca', '3631 Viverra. Ave', 72346, 3),
(2011, 'Ivana', 'Rocha', '', 'Ap #694-8733 Tincidunt Road', 0, 1),
(2012, 'Wynne', 'Farmer', '', 'Ap #805-1043 Sed, Road', 0, 1),
(2013, 'Lucius', 'York', 'mauris.Suspendisse.aliquet@amet.co.uk', '473-5503 Consequat, Av.', 40280, 2),
(2014, 'Cullen', 'Garrison', 'id.nunc.interdum@sitametdapibus.net', 'Ap #355-4383 Dui, Rd.', 65470, 2),
(2015, 'Farrah', 'Burch', 'Proin.dolor@sitamet.net', 'P.O. Box 927, 6904 Metus Street', 0, 2),
(2016, 'Sandra', 'Sanders', 'velit.eget.laoreet@dolor.com', 'Ap #364-8525 Penatibus St.', 76520, 2),
(2017, 'Emmanuel', 'Jacobs', 'Nullam@rutrum.co.uk', 'Ap #909-4379 Interdum Road', 0, 4),
(2018, 'Isabelle', 'Nunez', 'Cras.eget.nisi@ultrices.com', '979-8217 Sem. Street', 86341, 3),
(2019, 'Kalia', 'Howell', 'tincidunt@tellusjusto.co.uk', 'P.O. Box 422, 4852 Commodo Avenue', 79567, 1),
(2020, 'Plato', 'Bates', 'vulputate.lacus@eu.net', 'Ap #867-4621 Eu St.', 0, 1),
(2021, 'Brennan', 'Morrison', 'Nam@eu.org', 'Ap #650-6156 Cras Rd.', 5790, 2),
(2022, 'Raven', 'Burt', 'enim@ullamcorperviverra.ca', 'P.O. Box 410, 5642 Suspendisse Av.', 0, 1),
(2023, 'Dorothy', 'Middleton', 'sapien.molestie.orci@estacmattis.com', '745-5114 Suspendisse Avenue', 34981, 4),
(2024, 'Willa', 'Maxwell', 'velit.Aliquam@tempordiam.com', 'Ap #620-2454 Egestas St.', 0, 1),
(2025, 'Lesley', 'Wiggins', 'venenatis.a.magna@nonummy.org', 'P.O. Box 290, 4831 Auctor St.', 73113, 1),
(2026, 'Gillian', 'Everett', 'vel.sapien@blanditcongueIn.edu', 'P.O. Box 164, 6487 Laoreet Avenue', 37755, 2),
(2027, 'Mary', 'Landry', 'magna.a@luctus.ca', '812-4650 Sed Street', 9472, 3),
(2028, 'Tanek', 'Mcknight', 'ante@mauris.com', '6180 Eget Street', 0, 1),
(2029, 'Kitra', 'Brewer', 'magna.a@molestie.co.uk', 'Ap #296-4536 Nulla. St.', 0, 3),
(2030, 'Bruno', 'Parks', 'Proin@liberoProinmi.org', '884-6194 Malesuada Ave', 5680, 3),
(2031, 'Hayfa', 'Donaldson', 'Fusce.mollis.Duis@lacus.org', '3893 Ante Rd.', 0, 1),
(2032, 'Leigh', 'Ashley', 'Morbi@tinciduntneque.com', 'Ap #611-4607 Ipsum. Ave', 0, 2),
(2033, 'Lewis', 'Deleon', '', '306-8075 Scelerisque Av.', 39651, 2),
(2034, 'Isabella', 'Hardin', 'augue@adipiscing.edu', '701-1958 Pede. Rd.', 12312, 4),
(2035, 'Ralph', 'Shelton', 'ornare@fermentum.org', 'P.O. Box 918, 2253 Est, Road', 0, 1),
(2036, 'Chelsea', 'English', 'nec.imperdiet@Morbi.org', 'P.O. Box 930, 9052 Quis Rd.', 17031, 1),
(2037, 'Lance', 'Weeks', 'vel.quam@sempercursus.edu', 'P.O. Box 425, 4855 Ipsum Road', 0, 3),
(2038, 'Caldwell', 'Nichols', 'tincidunt.adipiscing.Mauris@lacus.net', 'P.O. Box 442, 6398 Erat Road', 0, 1),
(2039, 'Patience', 'Blankenship', 'Cras.eget.nisi@facilisis.org', '369-1006 Odio. Ave', 36952, 1),
(2040, 'Candace', 'Sutton', 'odio.Etiam.ligula@mipede.edu', 'Ap #761-9510 Donec Av.', 0, 2),
(2041, 'Melyssa', 'Neal', 'erat.vitae.risus@convallisconvallisdolor.com', '9068 Augue Ave', 0, 4),
(2042, 'Vivian', 'Foreman', 'mi.Aliquam@elementumloremut.edu', 'Ap #963-5241 Aenean Av.', 0, 1),
(2043, 'Hayfa', 'Beard', 'vehicula@Sedpharetra.ca', 'P.O. Box 530, 8884 Vitae St.', 0, 1),
(2044, 'Jasper', 'Pugh', 'nascetur@ultricesDuisvolutpat.co.uk', 'Ap #964-5678 Consectetuer Rd.', 0, 3),
(2045, 'Jack', 'Atkinson', 'velit.Aliquam@tempordiam.com', 'P.O. Box 955, 6681 Congue St.', 3922, 2),
(2046, 'Alexander', 'Gallagher', 'eu@velit.org', 'Ap #593-3505 Nibh Ave', 14951, 4),
(2047, 'Xavier', 'Ratliff', 'euismod.enim.Etiam@mi.edu', '3714 Et Road', 83284, 3),
(2048, 'Reed', 'Miles', 'Integer.sem@rutrum.ca', 'Ap #324-2203 Mattis Street', 0, 2),
(2049, 'Jamalia', 'Gamble', 'fames.ac.turpis@bibendumullamcorperDuis.net', 'P.O. Box 185, 8491 Cras Road', 44677, 3),
(2050, 'Chandler', 'Guerrero', 'eget@elitAliquamauctor.co.uk', '611-4657 Sit Av.', 78456, 4),
(2051, 'Hyacinth', 'Smith', 'congue.In@Etiamlaoreet.co.uk', 'P.O. Box 920, 3099 Ante Av.', 0, 1),
(2052, 'Frances', 'French', '', 'Ap #309-9949 Laoreet Ave', 0, 1),
(2053, 'Zeph', 'Vargas', 'bibendum@pede.com', '2688 Iaculis Rd.', 0, 4),
(2054, 'Imani', 'Bowen', 'mauris.Suspendisse.aliquet@amet.co.uk', 'Ap #889-3607 Mauris Ave', 85444, 1),
(2055, 'Hyatt', 'Acosta', 'mi.Aliquam@elementumloremut.edu', '3329 Nec, Road', 75281, 3),
(2056, 'Ariel', 'Pickett', '', 'P.O. Box 579, 1056 Sit Avenue', 9278, 4),
(2057, 'Cyrus', 'Durham', 'orci.luctus.et@laoreetlectus.ca', 'Ap #357-4919 Orci Street', 0, 3),
(2058, 'Justina', 'Rogers', 'mus.Donec.dignissim@tincidunt.net', 'P.O. Box 750, 3928 Ornare, Street', 82875, 3),
(2059, 'Margaret', 'Fuller', 'rhoncus.Donec.est@molestieSedid.net', 'Ap #166-5807 Feugiat Avenue', 56036, 1),
(2060, 'Rachel', 'Roth', '', 'Ap #616-5157 Facilisis Street', 28511, 2),
(2061, 'Tiger', 'Payne', 'Cras.eget.nisi@facilisis.org', 'P.O. Box 849, 4521 Adipiscing Rd.', 90546, 3),
(2062, 'Selma', 'Foreman', '', 'P.O. Box 472, 8943 Dis Rd.', 94523, 1),
(2063, 'Henry', 'Jordan', 'mus.Donec.dignissim@tincidunt.net', 'P.O. Box 546, 8557 Dui Street', 0, 3),
(2064, 'Adena', 'Adams', 'ullamcorper.eu.euismod@consectetueradipiscing.co.u', 'Ap #240-4170 Eleifend Street', 0, 4),
(2065, 'Nathan', 'Pope', 'libero.Morbi.accumsan@ametultricies.co.uk', 'P.O. Box 488, 6849 Diam St.', 60152, 3),
(2066, 'Tatum', 'Waters', 'vel.quam@sempercursus.edu', '857-5583 Molestie Avenue', 26636, 1),
(2067, 'Wang', 'Adams', 'vitae.sodales.nisi@Aenean.edu', 'Ap #228-8289 Erat, Rd.', 55625, 4),
(2068, 'Penelope', 'Richard', 'diam@justo.edu', 'Ap #920-5563 Nullam Rd.', 0, 2),
(2069, 'Hector', 'Osborne', 'ridiculus.mus.Donec@metusIn.co.uk', 'Ap #949-1400 Quisque Road', 79325, 3),
(2070, 'Rhoda', 'Hooper', 'arcu.Nunc.mauris@aliquetvel.net', '9455 Ornare Rd.', 0, 2),
(2071, 'Flynn', 'Stein', '', 'Ap #234-1232 Senectus Ave', 0, 1),
(2072, 'Omar', 'Richmond', 'Suspendisse@eu.com', 'P.O. Box 558, 9896 Nibh St.', 0, 3),
(2073, 'Nichole', 'Holman', '', 'P.O. Box 127, 7047 Sodales Rd.', 0, 2),
(2074, 'Rina', 'Hart', 'Integer.sem@rutrum.ca', 'Ap #237-2671 Eget Ave', 10263, 2),
(2075, 'Rajah', 'Travis', 'vitae@quamquis.edu', '768-3742 Nulla St.', 0, 4),
(2076, 'Roth', 'Alvarado', 'blandit.mattis@Infaucibus.com', 'P.O. Box 511, 7750 Ac St.', 0, 1),
(2077, 'Ayanna', 'Spencer', 'vitae.sodales.nisi@Aenean.edu', 'P.O. Box 415, 283 Non, Street', 0, 1),
(2078, 'Lionel', 'Bauer', 'Fusce.mollis.Duis@lacus.org', '239-7690 Mauris, Street', 0, 4),
(2079, 'Fiona', 'Barron', 'lorem@Suspendisse.com', '873-6549 A, Street', 0, 3),
(2080, 'Raymond', 'Brown', 'massa@tellusjusto.org', '943-9964 Lectus. Av.', 0, 2),
(2081, 'Callie', 'Delaney', '', 'Ap #685-7900 Mus. Avenue', 0, 2),
(2082, 'Blaze', 'Burton', '', '8175 Augue Av.', 99636, 1),
(2083, 'Linus', 'Mccall', 'Aenean.sed@faucibusorciluctus.com', '6461 Nec, Ave', 32452, 3),
(2084, 'Brent', 'Best', 'sed@sedconsequatauctor.co.uk', '239-5883 Pede. Rd.', 95565, 3),
(2085, 'Germaine', 'Strickland', '', '838-6878 Nisl Road', 0, 3),
(2086, 'Taylor', 'Washington', 'ullamcorper.eu.euismod@consectetueradipiscing.co.u', '1061 Lacinia Avenue', 0, 3),
(2087, 'Pascale', 'Dillon', 'lorem@Suspendisse.com', '523-1157 Amet Rd.', 0, 1),
(2088, 'Mariam', 'Holden', 'sapien.Cras@iaculis.ca', 'P.O. Box 976, 5834 Elit. Rd.', 0, 1),
(2089, 'Kylan', 'Sawyer', 'enim.Mauris.quis@nibh.org', '809-1357 Nunc Rd.', 2807, 1),
(2090, 'Wade', 'Stafford', '', '3837 Sem Road', 0, 3),
(2091, 'Joy', 'Livingston', 'fermentum@lectussit.com', '924-7177 Non St.', 78371, 2),
(2092, 'Rylee', 'Sweeney', 'enim.Nunc@Nuncpulvinararcu.com', '2020 Semper Ave', 0, 3),
(2093, 'Colby', 'Nash', 'Proin.dolor@sitamet.net', 'P.O. Box 799, 7713 Enim Ave', 64333, 3),
(2094, 'Cheyenne', 'Howe', 'quis.accumsan.convallis@semperet.org', '438-7883 Odio, St.', 0, 3),
(2095, 'Octavius', 'Salinas', 'nascetur@ultricesDuisvolutpat.co.uk', '5966 Ultricies Road', 73148, 2),
(2096, 'Shaeleigh', 'Christensen', 'enim.Nunc@Nuncpulvinararcu.com', 'Ap #274-672 Suscipit St.', 58017, 4),
(2097, 'Dustin', 'Fletcher', '', 'P.O. Box 792, 8324 Ut, Avenue', 0, 4),
(2098, 'Maisie', 'Mcmillan', 'velit.Aliquam.nisl@temporeratneque.org', '8328 Mollis Av.', 0, 3),
(2099, 'Kaden', 'Craft', 'massa.Vestibulum@Phasellusin.edu', 'P.O. Box 962, 8176 Nec Av.', 72621, 1),
(2100, 'Zia', 'Fitzpatrick', 'vel.sapien@blanditcongueIn.edu', '9218 Vitae Rd.', 0, 2),
(2101, 'Haley', 'Noble', 'tincidunt.dui@lectus.net', '882 Fusce Av.', 498, 3),
(2102, 'Merrill', 'Barnes', 'bibendum@pede.com', 'P.O. Box 265, 9810 Et, Av.', 9086, 4),
(2009, 'Bernard', 'Maurice', 'arcu.Nunc.mauris@non.ca', '12 rue msqdsqd', 50000, 2),
(2103, 'Raymond', 'Cuit', 'eu.odio.tristique@consectetuercursuset.org', '120 route de lorient', 12000, 3),
(2104, 'sandie', 'kilo', 'ligula.Nullam.enim@nostraperinceptos.net', '33 rue du chemin', 40280, 1),
(2105, 'sandie', '', 'dui@aptenttacitisociosqu.org', '33 rue du chemin', 40280, 1),
(2106, 'bernard', 'kilometre', 'vitae@quamquis.edu', '33 rue du chemin', 50000, 4),
(2000, 'bernard', 'minetter', 'alloLaTerre@laLune.be', '33 rue du cheminee', 40280, 0),
(2001, 'sandie', 'kilo', 'alloLaTerre@laLune.com', '33 rue du chemin', 40280, 1),
(2002, 'sandie', 'kilo', 'alloLaTerre@laLune.com', '33 rue du chemin', 50000, 1),
(2003, 'bernard', 'minet', 'alloLaTerre@laLune.com', '33 rue du chemin', 40280, 3),
(2004, 'bernard', 'kilo', 'alloLaTerre@laLune.com', '33 rue du chemin', 40280, 4),
(2005, 'sandie', 'minet', 'alloLaTerre@laLune.com', '33 rue du chemin', 40280, 1),
(2008, 'sandie', 'kilo', 'alloLaTerre@laLune.com', '33 rue du chemin', 50000, 1),
(2107, 'bernard', 'minet', 'alloLaTerre@laLune.com', '33 rue du chemin', 40280, 1),
(2108, 'bernard', 'kilo', 'alloLaTerre@laLune.com', '33 rue du chemin', 40280, 1),
(2109, 'bernard', 'kilo', 'alloLaTerre@laLune.com', '33 rue du chemin', 40280, 1),
(2110, 'sandie', 'minet', 'alloLaTerre@laLune.com', '33 rue du chemin', 50000, 1),
(2111, 'sandie', 'kilo', 'alloLaTerre@laLune.com', '33 rue du chemin', 40280, 1),
(2112, 'sandie', 'kilo', 'alloLaTerre@laLune.com', '33 rue du chemin', 40280, 1),
(2113, 'bernard', 'kilo', 'alloLaTerre@laLune.com', '33 rue du chemin', 40280, 1),
(2114, 'sandie', 'kilo', 'alloLaTerre@laLune.com', '33 rue du chemin', 40280, 4),
(2115, 'bernard', 'kilo', 'alloLaTerre@laLune.com', '33 rue du chemin', 40280, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `idCmd` int(4) NOT NULL,
  `idClient` int(4) NOT NULL,
  `dateCmd` datetime NOT NULL,
  `totalHT` float NOT NULL,
  `totalTVA` float NOT NULL,
  `totalTTC` float NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT '0',
  `acompte` float NOT NULL DEFAULT '0',
  `nbPaiement` int(11) NOT NULL DEFAULT '1',
  `sommePayed` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `commandes`
--

REPLACE INTO `commandes` (`id`, `idCmd`, `idClient`, `dateCmd`, `totalHT`, `totalTVA`, `totalTTC`, `valid`, `acompte`, `nbPaiement`, `sommePayed`) VALUES
(7, 5000, 2001, '0000-00-00 00:00:00', 6154.04, 1201.21, 7355.25, 0, 0, 1, 0),
(8, 5000, 2001, '0000-00-00 00:00:00', 6154.04, 1201.21, 7355.25, 0, 0, 1, 0),
(9, 5000, 2001, '0000-00-00 00:00:00', 6154.04, 1201.21, 7355.25, 0, 0, 1, 0),
(10, 5000, 2001, '0000-00-00 00:00:00', 6154.04, 1201.21, 7355.25, 0, 0, 1, 0),
(11, 5001, 2011, '0000-00-00 00:00:00', 3301, 646.996, 3948, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `idFournisseur` int(4) NOT NULL,
  `nomFournisseur` varchar(20) NOT NULL,
  `telFournisseur` varchar(14) NOT NULL,
  `adresseFournisseur` varchar(50) NOT NULL,
  PRIMARY KEY (`idFournisseur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `fournisseurs`
--

REPLACE INTO `fournisseurs` (`idFournisseur`, `nomFournisseur`, `telFournisseur`, `adresseFournisseur`) VALUES
(3000, 'Donec', '81-64-40-82-91', 'P.O. Box 338, 6046 Ornare, Ave'),
(3001, 'fringilla', '61-91-89-22-31', '376-8158 Sed Avenue'),
(3002, 'parturient', '11-97-64-85-78', 'Ap #850-2702 Magnis Avenue'),
(3003, 'malesuada', '15-41-62-08-54', '444-8407 Auctor, Rd.'),
(3004, 'adipiscing', '25-02-36-61-13', '543-6803 Commodo Av.'),
(3005, 'consequat', '66-10-78-38-68', '753-238 Arcu. Rd.'),
(3006, 'accumsan', '29-52-18-98-91', '4901 Aliquet, Avenue'),
(3007, 'hendrerit', '46-00-81-86-46', '9177 Adipiscing. Street'),
(3008, 'scelerisque', '67-99-64-18-31', '822-2761 Fermentum Road'),
(3009, 'sagittis', '22-69-37-74-64', 'Ap #264-2841 Curabitur Street'),
(3010, 'tortor', '68-95-76-09-53', 'Ap #473-9836 Sapien. St.');

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE IF NOT EXISTS `groupes` (
  `idgroup` int(4) NOT NULL,
  `groupname` text NOT NULL,
  PRIMARY KEY (`idgroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `groupes`
--

REPLACE INTO `groupes` (`idgroup`, `groupname`) VALUES
(1, 'administrateur'),
(2, 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE IF NOT EXISTS `pays` (
  `idPays` int(4) NOT NULL,
  `nomPays` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idPays`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `pays`
--

REPLACE INTO `pays` (`idPays`, `nomPays`) VALUES
(1, 'France'),
(2, 'Espagne'),
(3, 'Maroc'),
(4, 'Italie');

-- --------------------------------------------------------

--
-- Structure de la table `produitcmd`
--

CREATE TABLE IF NOT EXISTS `produitcmd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idArticle` int(5) NOT NULL,
  `idCmd` int(4) NOT NULL,
  `qteCmd` int(4) NOT NULL,
  `totalHT` float NOT NULL,
  `remise` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produitcmd_ibfk_1` (`idArticle`),
  KEY `produitcmd_ibfk_2` (`idCmd`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `produitcmd`
--

REPLACE INTO `produitcmd` (`id`, `idArticle`, `idCmd`, `qteCmd`, `totalHT`, `remise`) VALUES
(26, 4000, 5000, 1, 65.52, NULL),
(27, 4010, 5000, 2, 5888, NULL),
(28, 4000, 5000, 1, 65.52, NULL),
(29, 4002, 5000, 1, 200.515, NULL),
(30, 4083, 5001, 1, 812, NULL),
(31, 4019, 5001, 1, 2489, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `iduser` int(4) NOT NULL AUTO_INCREMENT,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `idgroup` int(4) NOT NULL,
  PRIMARY KEY (`iduser`),
  KEY `idgroup` (`idgroup`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `utilisateurs`
--

REPLACE INTO `utilisateurs` (`iduser`, `login`, `password`, `idgroup`) VALUES
(4, 'yoshi', 'da8c6d4dceb03eb882b305ad305289128920b6de', 1),
(5, 'Hamid', '13ee159b307d27d8be2c355221a1f3a23ab434be', 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`idFournisseur`) REFERENCES `fournisseurs` (`idFournisseur`);

--
-- Contraintes pour la table `produitcmd`
--
ALTER TABLE `produitcmd`
  ADD CONSTRAINT `produitcmd_ibfk_1` FOREIGN KEY (`idArticle`) REFERENCES `articles` (`idArticle`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `Utilisateurs_ibfk_1` FOREIGN KEY (`idgroup`) REFERENCES `groupes` (`idgroup`);
