-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2018 at 09:21 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safalbhawisya`
--

-- --------------------------------------------------------

--
-- Table structure for table `aptitudetestmanagement`
--

CREATE TABLE `aptitudetestmanagement` (
  `Category` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aptitudetestmanagement`
--

INSERT INTO `aptitudetestmanagement` (`Category`) VALUES
('Account'),
('English'),
('GK');

-- --------------------------------------------------------

--
-- Table structure for table `aptitudetestscience`
--

CREATE TABLE `aptitudetestscience` (
  `Category` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aptitudetestscience`
--

INSERT INTO `aptitudetestscience` (`Category`) VALUES
('Biology'),
('Chemistry'),
('English'),
('Maths'),
('Physics');

-- --------------------------------------------------------

--
-- Table structure for table `googleusers`
--

CREATE TABLE `googleusers` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `googleusers`
--

INSERT INTO `googleusers` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `gender`, `locale`, `picture`, `link`, `created`, `modified`) VALUES
(8, 'google', '117743687307064549619', '', 'shakya', 'shakya.nadim12@gmail.com', '', 'en', 'https://lh3.googleusercontent.com/-J860rDGS3FY/AAAAAAAAAAI/AAAAAAAAABg/OEGuLr3NsjM/photo.jpg', 'https://plus.google.com/117743687307064549619', '2018-05-24 10:39:43', '2018-05-24 10:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `optionsmanagement`
--

CREATE TABLE `optionsmanagement` (
  `ID` int(11) NOT NULL,
  `questionID` varchar(256) DEFAULT NULL,
  `choice` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `optionsmanagement`
--

INSERT INTO `optionsmanagement` (`ID`, `questionID`, `choice`) VALUES
(1, 'ENG1', 'A'),
(2, 'ENG1', 'The'),
(3, 'ENG1', 'An'),
(4, 'ENG1', 'None'),
(5, 'GK1', 'Pushpa Kamal Dahal'),
(6, 'GK1', 'Khadga Prasad Oli'),
(7, 'GK1', 'Madhav Kumar Nepal'),
(8, 'GK1', 'Sher Bahadur Deuba'),
(9, 'ACC1', '1'),
(10, 'ACC1', '2'),
(11, 'ACC1', '3'),
(12, 'ACC1', '4'),
(13, 'GK2', 'School Education Examination'),
(14, 'GK2', 'Secondary Education Examination'),
(15, 'GK2', 'School Examination Education'),
(16, 'GK2', 'School Leaving Certificate');

-- --------------------------------------------------------

--
-- Table structure for table `optionsscience`
--

CREATE TABLE `optionsscience` (
  `ID` int(10) NOT NULL,
  `questionID` varchar(256) DEFAULT NULL,
  `choice` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `optionsscience`
--

INSERT INTO `optionsscience` (`ID`, `questionID`, `choice`) VALUES
(1, 'CHEM1', 'Na(OH)2'),
(2, 'CHEM1', 'Na2OH'),
(3, 'CHEM1', 'NaOH'),
(4, 'CHEM1', 'OHNa'),
(5, 'CHEM2', 'Ca(OH)2'),
(6, 'CHEM2', 'Ca(OH)2.SO4'),
(7, 'CHEM2', 'CaSO4.2H2O'),
(8, 'CHEM2', 'None'),
(17, 'MATH1', 'equal'),
(18, 'MATH1', 'rational'),
(19, 'MATH1', 'irrational'),
(20, 'MATH1', 'imaginary'),
(21, 'MATH2', '2pir+h'),
(22, 'MATH2', '2pir-h'),
(23, 'MATH2', '2pirh'),
(24, 'MATH2', '2pir'),
(25, 'BIOL1', 'Same species'),
(26, 'BIOL1', 'Two species'),
(27, 'BIOL1', 'Different species'),
(28, 'BIOL1', 'Equal species'),
(29, 'BIOL2', 'Nitrogen dioxide'),
(30, 'BIOL2', 'Ammonium dioxide'),
(31, 'BIOL2', 'Sulphur dioxide'),
(32, 'BIOL2', 'Carbon dioxide'),
(33, 'PHYS1', 'ohmic'),
(34, 'PHYS1', 'non ohmic'),
(35, 'PHYS1', 'resistive'),
(36, 'PHYS1', 'non resistive'),
(37, 'PHYS2', '3W'),
(38, 'PHYS2', '2W'),
(39, 'PHYS2', '5W'),
(40, 'PHYS2', '1W'),
(41, 'PHYS3', 'hollow sphere of glass'),
(42, 'PHYS3', 'solid sphere of plastic'),
(43, 'PHYS3', 'solid sphere of glass'),
(44, 'PHYS3', 'hollow sphere of metal'),
(45, 'PHYS4', 'anything between zero & infinity'),
(46, 'PHYS4', 'infinity'),
(47, 'PHYS4', 'f = 0'),
(48, 'PHYS4', 'f = R'),
(49, 'PHYS5', 'x'),
(50, 'PHYS5', '2x'),
(51, 'PHYS5', '4x'),
(52, 'PHYS5', '8x'),
(53, 'PHYS6', 'charge'),
(54, 'PHYS6', 'potential'),
(55, 'PHYS6', 'capacity'),
(56, 'PHYS6', 'energy stored'),
(57, 'PHYS7', '10cm'),
(58, 'PHYS7', '12cm'),
(59, 'PHYS7', '15cm'),
(60, 'PHYS7', '18cm'),
(61, 'PHYS8', 'Diffusion'),
(62, 'PHYS8', 'Transition'),
(63, 'PHYS8', 'Depletion'),
(64, 'PHYS8', 'None of the above'),
(65, 'PHYS9', 'Wind Power'),
(66, 'PHYS9', 'Tidal Power'),
(67, 'PHYS9', 'Nuclear energy'),
(68, 'PHYS9', 'Geo-thermal energy'),
(69, 'PHYS10', 'Power divider circuit'),
(70, 'PHYS10', 'Current divider circuit'),
(71, 'PHYS10', 'Charge divider circuit'),
(72, 'PHYS10', 'All of these'),
(73, 'CHEM3', 'on vaporization large increase in volume takes place'),
(74, 'CHEM3', 'increase in KE is large on boiling'),
(75, 'CHEM3', 'KE decreases on boiling'),
(76, 'CHEM3', 'volume decreases when ice melt'),
(77, 'CHEM4', '-1'),
(78, 'CHEM4', '-2'),
(79, 'CHEM4', '0'),
(80, 'CHEM4', '+2'),
(81, 'CHEM5', 'HCl'),
(82, 'CHEM5', 'NH3'),
(83, 'CHEM5', 'AlCl3'),
(84, 'CHEM5', 'HSO4'),
(85, 'CHEM6', 'MnO2'),
(86, 'CHEM6', 'KO2'),
(87, 'CHEM6', 'PbO'),
(88, 'CHEM6', 'Na2O2'),
(89, 'CHEM7', 'CoO'),
(90, 'CHEM7', 'ZnO'),
(91, 'CHEM7', 'CoZnO2'),
(92, 'CHEM7', 'CoMgO2'),
(93, 'CHEM8', 'C'),
(94, 'CHEM8', 'CO'),
(95, 'CHEM8', 'Al'),
(96, 'CHEM8', 'H2'),
(97, 'CHEM9', 'O'),
(98, 'CHEM9', 'N'),
(99, 'CHEM9', 'S'),
(100, 'CHEM9', 'P'),
(101, 'CHEM10', 'ethyne'),
(102, 'CHEM10', 'ethene'),
(103, 'CHEM10', 'ethane'),
(104, 'CHEM10', 'methane'),
(105, 'BIOL3', 'forth whorl'),
(106, 'BIOL3', 'third whorl'),
(107, 'BIOL3', 'second whorl'),
(108, 'BIOL3', 'first whorl'),
(109, 'BIOL4', '1'),
(110, 'BIOL4', '2'),
(111, 'BIOL4', '3'),
(112, 'BIOL4', '4'),
(113, 'BIOL5', 'Egg releasing'),
(114, 'BIOL5', 'Egg elimination'),
(115, 'BIOL5', 'Egg production'),
(116, 'BIOL5', 'Egg division'),
(117, 'BIOL6', 'Aspirin'),
(118, 'BIOL6', 'Morphine'),
(119, 'BIOL6', 'Streptomycin'),
(120, 'BIOL6', 'Digitalis'),
(121, 'BIOL7', 'Narcotics'),
(122, 'BIOL7', 'Sedatives'),
(123, 'BIOL7', 'Hallucinogens'),
(124, 'BIOL7', 'None of these'),
(125, 'BIOL8', 'Thymine'),
(126, 'BIOL8', 'Cytosine'),
(127, 'BIOL8', 'Guanine'),
(128, 'BIOL8', 'None'),
(129, 'BIOL9', 'Nikola Tesla'),
(130, 'BIOL9', 'Marie Curie'),
(131, 'BIOL9', 'Gregor Mendel\r\n'),
(132, 'BIOL9', 'Charles Darwin'),
(133, 'BIOL10', 'Biotechnology'),
(134, 'BIOL10', 'Social biology'),
(135, 'BIOL10', 'Human biology'),
(136, 'BIOL10', 'Service biology'),
(137, 'ENGL1', 'The fight did not give up by him even though he was badly bruised.'),
(138, 'ENGL1', 'The fight had not given up by him even though he was badly bruised.'),
(139, 'ENGL1', 'The fight was not given up by him even though he was badly bruised.'),
(140, 'ENGL1', 'The fight was not being given up by him even though he was badly bruised.'),
(141, 'ENGL2', 'Tranquilizer should avoided by us in order to have good health.'),
(142, 'ENGL2', 'Tranquilizer should been avoided by us in order to have a good health.'),
(143, 'ENGL2', 'Tranquilizer should be avoid by us in order to have a good health.'),
(144, 'ENGL2', 'Tranquilizer should be avoided by us in order to have a good health.'),
(145, 'ENGL3', 'Principal said that if the librarian was present that day.'),
(146, 'ENGL3', 'Principal asks if the librarian is present that day.'),
(147, 'ENGL3', 'Principal asks if the librarian was present that day.'),
(148, 'ENGL3', 'Principal is asked if the librarian present that day.'),
(149, 'ENGL4', 'My teacher advised if I work hard I could take good marks.'),
(150, 'ENGL4', 'My teacher advises if you work hard you will take good marks.'),
(151, 'ENGL4', 'My teacher advises if I work hard I will take good marks.'),
(152, 'ENGL4', 'My teacher advised that I worked hard I would take good marks.'),
(153, 'ENGL5', 'my'),
(154, 'ENGL5', 'I'),
(155, 'ENGL5', 'noone'),
(156, 'ENGL5', 'could'),
(157, 'ENGL6', 'they'),
(158, 'ENGL6', 'won''t'),
(159, 'ENGL6', 'their'),
(160, 'ENGL6', 'unless'),
(161, 'ENGL7', 'is be'),
(162, 'ENGL7', 'can be'),
(163, 'ENGL7', 'might been'),
(164, 'ENGL7', 'has been'),
(165, 'ENGL8', 'be'),
(166, 'ENGL8', 'been'),
(167, 'ENGL8', 'can'),
(168, 'ENGL8', 'being'),
(169, 'ENGL9', 'is being'),
(170, 'ENGL9', 'can be'),
(171, 'ENGL9', 'is been'),
(172, 'ENGL9', 'was been'),
(173, 'ENGL10', 'can'),
(174, 'ENGL10', 'was keep'),
(175, 'ENGL10', 'is keep'),
(176, 'ENGL10', 'keep'),
(177, 'MATH5', 'average frequency'),
(178, 'MATH5', 'cumulative frequency'),
(179, 'MATH5', 'frequency distribution'),
(180, 'MATH5', 'frequency polygon'),
(181, 'MATH4', 'primary limit'),
(182, 'MATH4', 'upper limit'),
(183, 'MATH4', 'lower limit'),
(184, 'MATH4', 'secondary limit'),
(185, 'MATH3', '3'),
(186, 'MATH3', '4'),
(187, 'MATH3', '5'),
(188, 'MATH3', '2'),
(189, 'MATH6', '(a - b)(a + c)'),
(190, 'MATH6', '(a - b)(a - c)'),
(191, 'MATH6', '(a + b)(a + c)'),
(192, 'MATH6', '(a - b)(a - c)'),
(193, 'MATH7', 'zero polynomial'),
(194, 'MATH7', 'cubic polynomial'),
(195, 'MATH7', 'linear polynomial'),
(196, 'MATH7', 'quadratic polynomial'),
(197, 'MATH8', 'not equal'),
(198, 'MATH8', 'opposite'),
(199, 'MATH8', 'scalene'),
(200, 'MATH8', 'equal'),
(201, 'MATH9', 'decagon'),
(202, 'MATH9', 'heptagon'),
(203, 'MATH9', 'quadrilateral'),
(204, 'MATH9', 'hexagon'),
(205, 'MATH10', 'distributive law'),
(206, 'MATH10', 'commutative law'),
(207, 'MATH10', 'associative law'),
(208, 'MATH10', 'cramer''s law');

-- --------------------------------------------------------

--
-- Table structure for table `pointstablemanagement`
--

CREATE TABLE `pointstablemanagement` (
  `email` varchar(100) DEFAULT NULL,
  `Category` varchar(256) DEFAULT NULL,
  `points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pointstablescience`
--

CREATE TABLE `pointstablescience` (
  `email` varchar(255) DEFAULT NULL,
  `Category` varchar(256) DEFAULT NULL,
  `points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `progressmanagement`
--

CREATE TABLE `progressmanagement` (
  `email` varchar(100) DEFAULT NULL,
  `Account` int(11) DEFAULT NULL,
  `GK` int(11) DEFAULT NULL,
  `English` int(11) DEFAULT NULL,
  `totalTest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progressmanagement`
--

INSERT INTO `progressmanagement` (`email`, `Account`, `GK`, `English`, `totalTest`) VALUES
('nadim@gmail.com', 3, 5, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `progressscience`
--

CREATE TABLE `progressscience` (
  `email` varchar(100) DEFAULT NULL,
  `Maths` int(11) DEFAULT NULL,
  `Chemistry` int(11) DEFAULT NULL,
  `Biology` int(11) DEFAULT NULL,
  `Physics` int(11) DEFAULT NULL,
  `English` int(11) DEFAULT NULL,
  `totalTest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progressscience`
--

INSERT INTO `progressscience` (`email`, `Maths`, `Chemistry`, `Biology`, `Physics`, `English`, `totalTest`) VALUES
('nadim@gmail.com', 2, 2, 1, 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `questionmanagement`
--

CREATE TABLE `questionmanagement` (
  `questionID` varchar(256) NOT NULL,
  `question` varchar(256) DEFAULT NULL,
  `answer` varchar(256) DEFAULT NULL,
  `Category` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questionmanagement`
--

INSERT INTO `questionmanagement` (`questionID`, `question`, `answer`, `Category`) VALUES
('ACC1', '2 + 2 = ?', '4', 'Account'),
('ENG1', 'Choose the correct preposition for ''Univeristy''.', 'The', 'English'),
('GK1', 'Who is the current Prime Minister of Nepal\r\n?', 'Khadga Prasad Oli', 'GK'),
('GK2', 'What is the full form of S.E.E.?', 'Secondary Education Examination', 'GK');

-- --------------------------------------------------------

--
-- Table structure for table `questionsscience`
--

CREATE TABLE `questionsscience` (
  `questionID` varchar(256) NOT NULL,
  `question` varchar(256) DEFAULT NULL,
  `answer` varchar(256) DEFAULT NULL,
  `Category` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questionsscience`
--

INSERT INTO `questionsscience` (`questionID`, `question`, `answer`, `Category`) VALUES
('BIOL1', 'Symbiosis is a relationship between the members of', 'Different species', 'Biology'),
('BIOL10', 'Use of living organisms to serve humans is', 'Biotechnology', 'Biology'),
('BIOL2', 'Burning of petroleum produces', 'Nitrogen dioxide', 'Biology'),
('BIOL3', 'Considering the whorls of plants, the androecium is classified as', 'third whorl', 'Biology'),
('BIOL4', 'The number of spermatids produced from primary spermatocytes is', '4', 'Biology'),
('BIOL5', 'Oogenesis is the process of', 'Egg production', 'Biology'),
('BIOL6', 'Which of the following drugs is used to stimulate the heart?', 'Digitalis', 'Biology'),
('BIOL7', 'Which of the following cause changes in perception, thought, emotion and consciousness?', 'Hallucinogens', 'Biology'),
('BIOL8', 'Nitrogenous base adenine of one nucleotide forms pair with', 'Thymine', 'Biology'),
('BIOL9', 'The organic evolution mechanism was proposed by', 'Charles Darwin', 'Biology'),
('CHEM1', 'What is the chemical formula for Sodium Hydroxide?', 'NaOH', 'Chemistry'),
('CHEM10', 'A gas formed by electrolysis of potassium fumerate is', 'ethyne', 'Chemistry'),
('CHEM2', 'What is the chemical formula of plaster of paris?', 'CaSO4.2H2O', 'Chemistry'),
('CHEM3', 'Latent heat of vaporization is greater than latent heat of fusion due to', 'on vaporization large increase in volume takes place', 'Chemistry'),
('CHEM4', 'The oxidation number of Sulphur in iron pyrite (FeS2) is', '-1', 'Chemistry'),
('CHEM5', 'Which of these is a lewis acid?', 'AlCl3', 'Chemistry'),
('CHEM6', 'Which of these gives 02 gas with dilute acid?', 'KO2', 'Chemistry'),
('CHEM7', 'Rinmann''s green is', 'CoZnO2', 'Chemistry'),
('CHEM8', 'The reducing agent in blast furnace during extraction of iron from haematite is', 'C', 'Chemistry'),
('CHEM9', 'The heteroelement in pyrole is', 'N', 'Chemistry'),
('ENGL1', 'He did not give up the fight even though he was badly bruised.', 'The fight was not given up by him even though he was badly bruised.', 'English'),
('ENGL10', 'You _____ maintain a healthy weight, if you keep exercising.', 'can', 'English'),
('ENGL2', 'We should avoid tranquilizer in order to have a good health.', 'Tranquilizer should be avoided by us in order to have a good health.', 'English'),
('ENGL3', 'Principal says, "Is the librarian present today?"', 'Principal asks if the librarian is present that day.', 'English'),
('ENGL4', 'She said, "If you work hard, you will take good marks."', 'My teacher advises if I work hard I will take good marks.', 'English'),
('ENGL5', 'Which is the singular subject pronoun in the sentences "I like to walk in the rain for a long time because no one could see my tears."', 'I', 'English'),
('ENGL6', 'Find the possessive pronoun in the sentence " Unless they do all of their homework, they won''t allow to play."', 'their', 'English'),
('ENGL7', 'A journalist who ___ ___ detained in a city for more than a year.', 'has been', 'English'),
('ENGL8', 'After him in my life, I _____ see things differently now.', 'can', 'English'),
('ENGL9', 'Complete shutdown _____ _____ observed today against new law.', 'is being', 'English'),
('MATH1', 'If b² - 4ac < 0, then roots of ax² + bx + c = 0 are', 'imaginary', 'Maths'),
('MATH10', ' If A and B matrices are of same order and A + B = B + A, this law is known as', 'commutative law', 'Maths'),
('MATH2', 'The surface area of hollow cylinder with radius ‘r’ and height ‘h’ is measured by', '2pirh', 'Maths'),
('MATH3', 'The types of frequency distribution are', '2', 'Maths'),
('MATH4', 'The minimum value in the class limit is called', 'lower limit', 'Maths'),
('MATH5', 'The total of frequency up to an upper class limit or boundary is known as', 'cumulative frequency', 'Maths'),
('MATH6', 'Factorization of a(a - b + c) - bc is equal to', '(a - b)(a + c)', 'Maths'),
('MATH7', 'A polynomial of degree ‘3’ is called', 'cubic polynomial', 'Maths'),
('MATH8', 'Vertical angles that are opposite to each other are also', 'equal', 'Maths'),
('MATH9', 'A polygon having 10 sides is called', 'decagon', 'Maths'),
('PHYS1', 'Substances that have constant resistance over wide range of voltages are', 'ohmic', 'Physics'),
('PHYS10', 'Parallel circuit is', 'Current divider circuit', 'Physics'),
('PHYS2', 'A resistor having resistance 6.2? is connected across a battery of 5 V by means of a wire of negotiable resistance. Current passes through the resistor is 0.4 A. The total power produced by the battery is', '2W', 'Physics'),
('PHYS3', 'A spherical mirror to be made from a cut portion of', 'hollow sphere of glass', 'Physics'),
('PHYS4', 'For a plane mirror, the value of focal length is', 'infinity', 'Physics'),
('PHYS5', 'A car can be stopped over a distance ''x'' when its momentum is ''P''. The stopping distance of a car while moving with momentum 2P is', '4x', 'Physics'),
('PHYS6', 'A capacitor is charged then dielectric slab is introduced between plates then the quantity that remain constant is', 'charge', 'Physics'),
('PHYS7', 'Air bubble in glass slab of refractive index 1.5 appear from one side 6cm & 4cm from opposite side then thickness of glass slab is', '15cm', 'Physics'),
('PHYS8', 'Which capacitance dominates in the forward-bias region?', 'Diffusion', 'Physics'),
('PHYS9', 'Which one is not a non-conventional source of Energy?', 'Nuclear Energy', 'Physics');

-- --------------------------------------------------------

--
-- Table structure for table `testmanagement`
--

CREATE TABLE `testmanagement` (
  `email` varchar(100) DEFAULT NULL,
  `questionID` varchar(256) DEFAULT NULL,
  `userAnswer` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testscience`
--

CREATE TABLE `testscience` (
  `email` varchar(100) DEFAULT NULL,
  `questionID` varchar(256) DEFAULT NULL,
  `userAnswer` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testscience`
--

INSERT INTO `testscience` (`email`, `questionID`, `userAnswer`) VALUES
('nadim@gmail.com', 'ENGL9', 'can be'),
('nadim@gmail.com', 'ENGL8', 'been'),
('nadim@gmail.com', 'ENGL10', 'is keep');

-- --------------------------------------------------------

--
-- Table structure for table `userregistration`
--

CREATE TABLE `userregistration` (
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(100) NOT NULL,
  `pictures` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userregistration`
--

INSERT INTO `userregistration` (`first_name`, `last_name`, `password`, `address`, `email`, `method`, `pictures`) VALUES
('Anjesh', 'Ojha', '$2y$10$UYQpIFoFXiSKApeav8TabevKHAVh4IjxY2DaGlrp6y/dV9XEfDtO6', 'Lokanthali, Bhaktapur', 'anjesh@gmail.com', 'SafalBhawishya', NULL),
('Anjesh', 'Ojha', NULL, NULL, 'anjeshojha67@gmail.com', 'Google', 'https://lh6.googleusercontent.com/-teu25p65Mos/AAAAAAAAAAI/AAAAAAAAADA/OkYzi-4RLzs/photo.jpg'),
('Nadeem', 'Shakya', NULL, NULL, 'nadeem.shakya@student.ku.edu.np', 'Google', 'https://lh6.googleusercontent.com/-iRcDdj7Luog/AAAAAAAAAAI/AAAAAAAAAAA/AB6qoq3is2GiOQ9ryaVoP8jQN6oIk-imLQ/mo/photo.jpg'),
('Nadeem', 'Shakya', '$2y$10$6Nz.g2FxGCopPoXu4Vk6degtJ3WY0omKadqczIHFlLeRsh6SegZpC', 'Gwarko, Lalitpur', 'nadim@gmail.com', 'SafalBhawishya', '5b30f54d7dd0a0.22301514.jpg'),
('Chandrachur', 'Chauhan', '$2y$10$sLdmEWXbAl6lsVgYOoU/1.Bw1kr6bB/1UNm2Dq0k8Ep/8Xc7Fxifa', 'Gwarko, Lalitpur', 'nadimboy@gmail.com', 'SafalBhawishya', '5b31a96f272395.80464659.jpg'),
('Nadim', 'shakya', NULL, NULL, 'shakya.nadim12@gmail.com', 'Google', 'https://lh3.googleusercontent.com/-J860rDGS3FY/AAAAAAAAAAI/AAAAAAAAABg/OEGuLr3NsjM/photo.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aptitudetestmanagement`
--
ALTER TABLE `aptitudetestmanagement`
  ADD PRIMARY KEY (`Category`);

--
-- Indexes for table `aptitudetestscience`
--
ALTER TABLE `aptitudetestscience`
  ADD PRIMARY KEY (`Category`);

--
-- Indexes for table `googleusers`
--
ALTER TABLE `googleusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `optionsmanagement`
--
ALTER TABLE `optionsmanagement`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `questionID` (`questionID`);

--
-- Indexes for table `optionsscience`
--
ALTER TABLE `optionsscience`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `questionID` (`questionID`);

--
-- Indexes for table `pointstablemanagement`
--
ALTER TABLE `pointstablemanagement`
  ADD KEY `Category` (`Category`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `pointstablescience`
--
ALTER TABLE `pointstablescience`
  ADD KEY `Category` (`Category`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `progressmanagement`
--
ALTER TABLE `progressmanagement`
  ADD KEY `email` (`email`);

--
-- Indexes for table `progressscience`
--
ALTER TABLE `progressscience`
  ADD KEY `email` (`email`);

--
-- Indexes for table `questionmanagement`
--
ALTER TABLE `questionmanagement`
  ADD PRIMARY KEY (`questionID`),
  ADD KEY `Category` (`Category`);

--
-- Indexes for table `questionsscience`
--
ALTER TABLE `questionsscience`
  ADD PRIMARY KEY (`questionID`),
  ADD KEY `Category` (`Category`);

--
-- Indexes for table `testmanagement`
--
ALTER TABLE `testmanagement`
  ADD KEY `questionID` (`questionID`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `testscience`
--
ALTER TABLE `testscience`
  ADD KEY `questionID` (`questionID`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `userregistration`
--
ALTER TABLE `userregistration`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `googleusers`
--
ALTER TABLE `googleusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `optionsmanagement`
--
ALTER TABLE `optionsmanagement`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `optionsscience`
--
ALTER TABLE `optionsscience`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `optionsmanagement`
--
ALTER TABLE `optionsmanagement`
  ADD CONSTRAINT `optionsmanagement_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `questionmanagement` (`questionID`);

--
-- Constraints for table `optionsscience`
--
ALTER TABLE `optionsscience`
  ADD CONSTRAINT `optionsscience_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `questionsscience` (`questionID`);

--
-- Constraints for table `pointstablemanagement`
--
ALTER TABLE `pointstablemanagement`
  ADD CONSTRAINT `pointstablemanagement_ibfk_1` FOREIGN KEY (`Category`) REFERENCES `aptitudetestmanagement` (`Category`),
  ADD CONSTRAINT `pointstablemanagement_ibfk_2` FOREIGN KEY (`email`) REFERENCES `userregistration` (`email`);

--
-- Constraints for table `pointstablescience`
--
ALTER TABLE `pointstablescience`
  ADD CONSTRAINT `pointstablescience_ibfk_1` FOREIGN KEY (`Category`) REFERENCES `aptitudetestscience` (`Category`),
  ADD CONSTRAINT `pointstablescience_ibfk_2` FOREIGN KEY (`email`) REFERENCES `userregistration` (`email`);

--
-- Constraints for table `progressmanagement`
--
ALTER TABLE `progressmanagement`
  ADD CONSTRAINT `progressmanagement_ibfk_1` FOREIGN KEY (`email`) REFERENCES `userregistration` (`email`);

--
-- Constraints for table `progressscience`
--
ALTER TABLE `progressscience`
  ADD CONSTRAINT `progressscience_ibfk_1` FOREIGN KEY (`email`) REFERENCES `userregistration` (`email`);

--
-- Constraints for table `questionmanagement`
--
ALTER TABLE `questionmanagement`
  ADD CONSTRAINT `questionmanagement_ibfk_1` FOREIGN KEY (`Category`) REFERENCES `aptitudetestmanagement` (`Category`);

--
-- Constraints for table `questionsscience`
--
ALTER TABLE `questionsscience`
  ADD CONSTRAINT `questionsscience_ibfk_1` FOREIGN KEY (`Category`) REFERENCES `aptitudetestscience` (`Category`);

--
-- Constraints for table `testmanagement`
--
ALTER TABLE `testmanagement`
  ADD CONSTRAINT `testmanagement_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `questionmanagement` (`questionID`),
  ADD CONSTRAINT `testmanagement_ibfk_2` FOREIGN KEY (`email`) REFERENCES `userregistration` (`email`);

--
-- Constraints for table `testscience`
--
ALTER TABLE `testscience`
  ADD CONSTRAINT `testscience_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `questionsscience` (`questionID`),
  ADD CONSTRAINT `testscience_ibfk_2` FOREIGN KEY (`email`) REFERENCES `userregistration` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
