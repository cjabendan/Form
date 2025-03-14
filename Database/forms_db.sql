-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 03:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `formsdata`
--

CREATE TABLE `formsdata` (
  `id` int(11) NOT NULL,
  `fn` varchar(255) NOT NULL COMMENT 'Last Name',
  `ln` varchar(255) NOT NULL COMMENT 'First Name',
  `mn` varchar(50) DEFAULT NULL COMMENT 'Middle Initial',
  `dob` date NOT NULL COMMENT 'Date of Birth',
  `sex` enum('Male','Female','Other') NOT NULL COMMENT 'Sex',
  `cv` varchar(50) NOT NULL COMMENT 'Civil Status',
  `ocv` varchar(100) NOT NULL,
  `tin` varchar(20) DEFAULT NULL COMMENT 'Tax Identification Number',
  `nat` varchar(100) NOT NULL COMMENT 'Nationality',
  `reg` varchar(255) DEFAULT NULL COMMENT 'Region',
  `rfub` varchar(255) DEFAULT NULL COMMENT 'Residential Unit/Floor/Building',
  `hlb` varchar(255) DEFAULT NULL COMMENT 'House/Lot/Block',
  `strt` varchar(255) DEFAULT NULL COMMENT 'Street',
  `sub` varchar(255) DEFAULT NULL COMMENT 'Subdivision',
  `bdl` varchar(255) DEFAULT NULL COMMENT 'Barangay/District/Locality',
  `cm` varchar(255) DEFAULT NULL COMMENT 'City/Municipality',
  `prov` varchar(255) DEFAULT NULL COMMENT 'Province',
  `zip` varchar(10) DEFAULT NULL COMMENT 'Zip Code',
  `ctry` varchar(100) DEFAULT NULL COMMENT 'Country',
  `rfub2` varchar(255) DEFAULT NULL COMMENT 'Residential Unit/Floor/Building (Secondary)',
  `hlb2` varchar(255) DEFAULT NULL COMMENT 'House/Lot/Block (Secondary)',
  `strt2` varchar(255) DEFAULT NULL COMMENT 'Street (Secondary)',
  `sub2` varchar(255) DEFAULT NULL COMMENT 'Subdivision (Secondary)',
  `bdl2` varchar(255) DEFAULT NULL COMMENT 'Barangay/District/Locality (Secondary)',
  `cm2` varchar(255) DEFAULT NULL COMMENT 'City/Municipality (Secondary)',
  `prov2` varchar(255) DEFAULT NULL COMMENT 'Province (Secondary)',
  `zip2` varchar(10) DEFAULT NULL COMMENT 'Zip Code (Secondary)',
  `ctry2` varchar(100) DEFAULT NULL COMMENT 'Country (Secondary)',
  `num` varchar(20) DEFAULT NULL COMMENT 'Mobile Number',
  `mail` varchar(255) DEFAULT NULL COMMENT 'Email Address',
  `tele` varchar(20) DEFAULT NULL COMMENT 'Telephone Number',
  `fln` varchar(255) DEFAULT NULL COMMENT 'Father''s Last Name',
  `ffn` varchar(255) DEFAULT NULL COMMENT 'Father''s First Name',
  `fmn` varchar(255) DEFAULT NULL COMMENT 'Father''s Middle Name',
  `mln` varchar(255) DEFAULT NULL COMMENT 'Mother''s Last Name',
  `mfn` varchar(255) DEFAULT NULL COMMENT 'Mother''s First Name',
  `mmn` varchar(255) DEFAULT NULL COMMENT 'Mother''s Middle Name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formsdata`
--

INSERT INTO `formsdata` (`id`, `fn`, `ln`, `mn`, `dob`, `sex`, `cv`, `ocv`, `tin`, `nat`, `reg`, `rfub`, `hlb`, `strt`, `sub`, `bdl`, `cm`, `prov`, `zip`, `ctry`, `rfub2`, `hlb2`, `strt2`, `sub2`, `bdl2`, `cm2`, `prov2`, `zip2`, `ctry2`, `num`, `mail`, `tele`, `fln`, `ffn`, `fmn`, `mln`, `mfn`, `mmn`) VALUES
(40, 'Nathaniel', 'Magsalin', 'Kurt', '2001-10-05', 'Male', 'Other', 'Common law', '1', 'Temporibus fugit ex', 'Nihil quibusdam ad q', 'Aut odio tempora opt', 'Aut odio tempora opt', 'Ea velit illum est', 'Cillum ex sed aut de', 'Ipsum deserunt minus', 'Laboriosam et illo', 'Eveniet nulla at au', '43322', 'Rwanda', 'In sint velit numqua', 'Consequat Iusto dol', 'Sint molestias dolo', 'Placeat esse sit', 'Aliqua Quod incidid', 'Aliquid voluptatem a', 'Qui sint voluptatem', '54970', 'Oman', '+1 (241) 596-2704', 'kuxep@mailinator.com', '+1 (678) 759-9754', 'Est quis tenetur et', 'Commodo ipsam volupt', 'Totam consectetur v', 'In magna molestiae q', 'Ut ut nisi sunt sed', 'Suscipit id saepe no'),
(41, 'Vince Michael', 'Bacarisas', 'Ramirez', '2003-08-01', 'Male', 'Other', 'Common law', '', 'Consequatur velit e', '', 'Quisquam quia evenie', 'Quisquam quia evenie', 'Eaque atque et quide', '', '', '', '', '', '', 'Quo et non similique', 'Natus officia est do', 'Officia numquam dolo', 'Doloremque soluta na', 'Iure pariatur Aut t', 'Sit perspiciatis au', 'Dolorum mollit recus', '23020', 'Philippines', '+1 (902) 761-1556', NULL, NULL, 'Porro mollit harum s', 'Magnam quis nostrum', 'Commodi non perspici', 'Natus et voluptas re', 'Saepe ea necessitati', 'Quasi quis beatae er'),
(48, 'David Sailas', 'Villondo', 'Romano', '2003-02-10', 'Male', 'Single', '', '', 'filipino', 'born again', 'sample data', 'sample data', 'gimenez street', '', '', '', '', '', '', 'sample data', 'sample data', 'gimenez street', 'sample data', 'lipata', 'minglanilla', 'Cebu', '6046', 'Philippines', '0123456789', '', '', '', '', '', '', '', ''),
(49, 'JohnBert', 'Plameran', 'Decena', '2003-08-15', 'Male', 'Single', '', '', 'filipino', '', 'Odio lorem ut dolor', 'Odio lorem ut dolor', 'Quam repellendus Qu', '', '', '', '', '', '', 'Laboris sapiente occ', 'Sapiente dicta non a', 'Inventore cupidatat', 'Dolorem eos dolorem', 'Ad iusto quis et id', 'Libero accusamus sun', 'Quia et maiores Nam', '25106', 'El Salvador', '+1 (837) 774-3379', '', '', 'Quia veritatis est d', 'Et accusamus eiusmod', 'Necessitatibus atque', 'Minus obcaecati mole', 'Vel temporibus fugia', 'Quos sequi fugit en'),
(75, 'Christian James', 'Abendan', 'Arquilos', '2004-04-27', 'Male', 'Other', 'Common law', '', 'filipino', 'catholic', 'sample data', 'sample data', 'gimenez street', '', '', '', '', '', '', 'sample data', 'sample data', 'gimenez street', 'sample data', 'pob. ward 2', 'minglanilla', 'Cebu', '6046', 'Philippines', '0123456789', '', '', 'abendan', 'rommel', 'heramil', 'arquilos', 'rhovella', 'betio');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `formsdata`
--
ALTER TABLE `formsdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `formsdata`
--
ALTER TABLE `formsdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
