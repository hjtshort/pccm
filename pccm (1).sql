-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Mer 28 Mars 2018 à 14:31
-- Version du serveur: 5.5.32
-- Version de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `pccm`
--
CREATE DATABASE IF NOT EXISTS `pccm` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `pccm`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `maAdmin` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `matKhau` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`maAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`maAdmin`, `matKhau`) VALUES
('admin', '25d55ad283aa400af464c76d713c07ad'),
('admin1', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Structure de la table `bomon`
--

CREATE TABLE IF NOT EXISTS `bomon` (
  `maBm` int(2) NOT NULL AUTO_INCREMENT,
  `tenBm` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `maKhoa` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`maBm`),
  UNIQUE KEY `tenBm` (`tenBm`),
  KEY `maKhoa` (`maKhoa`),
  KEY `maKhoa_2` (`maKhoa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Contenu de la table `bomon`
--

INSERT INTO `bomon` (`maBm`, `tenBm`, `maKhoa`) VALUES
(1, 'TIN HỌC', '1'),
(2, 'LÝ KỸ THUẬT', '1'),
(3, 'MÔI TRƯỜNG', '1'),
(5, 'TIẾNG', '3'),
(6, 'VIẾT', '3'),
(7, 'Toán', '4'),
(8, 'KẾ TOÁN', '2'),
(9, 'QUẢN TRỊ VĂN PHÒNG', '6'),
(10, 'Pháp luật', '7'),
(11, 'Việt Nam học', '6'),
(12, 'Du lịch', '6'),
(13, 'Mầm non', '4'),
(14, 'Tiểu học', '4'),
(15, 'Sử-Địa', '4'),
(16, 'SP Anh', '4'),
(17, 'Ngữ văn', '4'),
(18, 'Lý sinh', '4');

-- --------------------------------------------------------

--
-- Structure de la table `canbo`
--

CREATE TABLE IF NOT EXISTS `canbo` (
  `maCb` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `hoCb` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tenCb` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `maBm` int(2) NOT NULL,
  `matKhau` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`maCb`),
  KEY `maBm` (`maBm`),
  KEY `maBm_2` (`maBm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `canbo`
--

INSERT INTO `canbo` (`maCb`, `hoCb`, `tenCb`, `maBm`, `matKhau`) VALUES
('4300S282', 'Lê Ngọc ', 'Chân', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4300S315', 'Nguyễn Thị Như ', 'Mai', 2, 'bfee4202fd857e05649343815eb8b6ec'),
('4300S330', 'Lê Quốc ', 'Khương', 2, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B106', 'Nguyễn Anh ', 'Thư', 2, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B107', 'Nguyễn Đăng ', 'Duy', 2, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B108', 'Trần Văn ', 'Vũ', 2, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B110', 'Nguyễn Thị Kim ', 'Oanh', 2, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B112', 'Trần Hữu ', 'Tính', 2, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B113', 'Trần Thị Thanh ', 'Thanh', 2, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B118', 'Nguyễn Hồng ', 'Ngọc', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B119', 'Bùi Thị Ngọc ', 'Dung', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B120', 'Tần Duy ', 'Khánh', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B121', 'Nguyễn Thị Phương ', 'Hằng', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B122', 'Ngô Thị Lan ', 'Hương', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B123', 'Lê Thị Phương ', 'Nhung', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B282', 'Đặng Phúc ', 'Đảm', 2, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B289', 'Hồ Thị Kiều ', 'Trân', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B294', 'Mai Hoàng Thảo ', 'Nguyên', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B295', 'Lê Trung ', 'Nhân', 2, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B299', 'Huỳnh Quốc ', 'Kha', 2, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B300', 'Ngô Nguyễn Ngọc ', 'Thơ', 2, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B302', 'Dương Ngọc ', 'Trân', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B303', 'Lê Ngọc Diệu ', 'Hồng', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B304', 'Phạm Chí ', 'Linh', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B306', 'Nguyễn Thị Huyền ', 'Trang', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B324', 'Đỗ Thùy ', 'Lam', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B325', 'Phan Thị Ngọc ', 'Thuận', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B326', 'Lưu Ngọc ', 'Cường', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600B331', 'Võ Thúy ', 'Oanh', 2, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S188', 'Bùi Huy ', 'Trang', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S203', 'Nguyễn Lê Tố ', 'Như', 2, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S204', 'Trần Lan ', 'Chi', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S205', 'Nguyễn Thụy Bảo ', 'Uyên', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S206', 'Nguyễn Thị Kiều P', 'hương', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S207', 'Tiêu Tuấn ', 'Phong', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S208', 'Nguyễn Thị Mỹ ', 'Linh', 3, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S209', 'Lâm Thanh ', 'Ngọc', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S211', 'Thái Thị Ngọc ', 'Thúy', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S212', 'Nguyễn Việt Huỳnh ', 'Mai', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S215', 'Nguyễn Đình ', 'Ngọc', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S216', 'Nguyễn Thị Hồng ', 'Yến', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S218', 'Trần Thị Bích ', 'Liên', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S286', 'Hùynh Bá ', 'Lộc', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S295', 'Trương Hùng ', 'Chen', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S337', 'Trần Huỳnh ', 'Anh', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S338', 'Nguyễn Minh', 'Trang', 1, 'd352661d26428912c46e7c0ff164acee'),
('4600S339', 'Trần Duy ', 'Quang', 1, 'bfee4202fd857e05649343815eb8b6ec'),
('4600S341', 'Trần Văn ', 'Sơn', 2, 'bfee4202fd857e05649343815eb8b6ec');

-- --------------------------------------------------------

--
-- Structure de la table `canbogiam`
--

CREATE TABLE IF NOT EXISTS `canbogiam` (
  `maCb` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `maDt` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `namHoc` int(4) NOT NULL,
  PRIMARY KEY (`maCb`,`maDt`,`namHoc`),
  UNIQUE KEY `maCb_2` (`maCb`),
  KEY `maCb` (`maCb`,`maDt`),
  KEY `maDt` (`maDt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `canbogiam`
--

INSERT INTO `canbogiam` (`maCb`, `maDt`, `namHoc`) VALUES
('4600B118', '5', 2017),
('4600B121', '5', 2017);

-- --------------------------------------------------------

--
-- Structure de la table `chucvu`
--

CREATE TABLE IF NOT EXISTS `chucvu` (
  `maCv` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `tenCv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `soTiet` float NOT NULL,
  PRIMARY KEY (`maCv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `chucvu`
--

INSERT INTO `chucvu` (`maCv`, `tenCv`, `soTiet`) VALUES
('1', 'Trưởng bộ môn', 83.2),
('2', 'Phó trưởng khoa', 83.2),
('3', 'Phó trưởng khoa phụ trách', 124.8),
('4', 'Trưởng khoa', 124.8),
('5', 'Phó trưởng bộ môn', 0),
('6', 'Tổ trưởng công đoàn', 22),
('7', 'Tổ phó công đoàn', 22);

-- --------------------------------------------------------

--
-- Structure de la table `chucvugiangvien`
--

CREATE TABLE IF NOT EXISTS `chucvugiangvien` (
  `maCb` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `maCv` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`maCb`,`maCv`),
  KEY `maCb` (`maCb`,`maCv`),
  KEY `maCv` (`maCv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `chucvugiangvien`
--

INSERT INTO `chucvugiangvien` (`maCb`, `maCv`) VALUES
('4600B113', '1'),
('4600S204', '1'),
('4600S209', '1'),
('4600B118', '2'),
('4600S208', '2'),
('4600S212', '3'),
('4600B107', '5'),
('4600B112', '5'),
('4600B119', '5'),
('4600S286', '6'),
('4600B119', '7');

-- --------------------------------------------------------

--
-- Structure de la table `chuongtrinhhoc`
--

CREATE TABLE IF NOT EXISTS `chuongtrinhhoc` (
  `maNganh` int(2) NOT NULL,
  `maMon` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `he` int(11) NOT NULL,
  `sttKhoa` int(2) NOT NULL,
  `hocKi` tinyint(4) NOT NULL,
  `namHoc` int(4) NOT NULL,
  PRIMARY KEY (`maNganh`,`maMon`,`he`,`sttKhoa`,`hocKi`,`namHoc`),
  KEY `maNganh` (`maNganh`,`maMon`),
  KEY `maMon` (`maMon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `chuongtrinhhoc`
--

INSERT INTO `chuongtrinhhoc` (`maNganh`, `maMon`, `he`, `sttKhoa`, `hocKi`, `namHoc`) VALUES
(14, '65', 1, 40, 1, 2017),
(1, 'DC015', 1, 41, 1, 2017),
(2, 'DC015', 1, 41, 1, 2017),
(1, 'DC025', 1, 41, 1, 2017),
(2, 'DC025', 1, 41, 1, 2017),
(1, 'DC041', 1, 41, 1, 2017),
(2, 'DC041', 1, 41, 1, 2017),
(1, 'DC051', 1, 41, 2, 2017),
(2, 'DC051', 1, 41, 2, 2017),
(16, 'KD01', 1, 41, 1, 2017),
(12, 'KL403', 1, 40, 2, 2017),
(12, 'KL404', 1, 40, 2, 2017),
(2, 'KL405', 1, 40, 2, 2017),
(13, 'KL405', 1, 40, 2, 2017),
(2, 'KL406', 1, 40, 2, 2017),
(13, 'KL406', 1, 40, 2, 2017),
(15, 'KT01', 1, 40, 1, 2016),
(15, 'KT01', 1, 40, 1, 2017),
(15, 'KT01', 1, 41, 1, 2017),
(21, 'MH05', 2, 42, 2, 2017),
(23, 'MH05', 2, 42, 2, 2017),
(14, 'SP01', 1, 40, 1, 2017),
(14, 'SP02', 1, 40, 1, 2017),
(14, 'SP03', 1, 40, 1, 2017),
(14, 'SP04', 1, 40, 2, 2017),
(4, 'SP05', 1, 42, 2, 2017),
(8, 'SP05', 1, 42, 2, 2017),
(14, 'SP05', 1, 42, 2, 2017),
(22, 'SP05', 1, 42, 2, 2017),
(24, 'SP05', 1, 42, 2, 2017),
(25, 'SP05', 1, 42, 2, 2017),
(26, 'SP05', 1, 42, 2, 2017),
(27, 'SP05', 1, 42, 2, 2017),
(28, 'SP05', 1, 42, 2, 2017),
(1, 'TH020', 1, 41, 2, 2017),
(2, 'TH020', 1, 41, 2, 2017),
(2, 'TH030', 1, 41, 1, 2017),
(1, 'TH031', 1, 41, 2, 2017),
(1, 'TH040', 1, 41, 2, 2017),
(2, 'TH040', 1, 41, 2, 2017),
(12, 'TH050', 1, 40, 1, 2017),
(13, 'TH050', 1, 40, 1, 2017),
(1, 'TH060', 1, 41, 2, 2017),
(2, 'TH060', 1, 41, 2, 2017),
(1, 'TH070', 1, 41, 1, 2017),
(2, 'TH071', 1, 41, 1, 2017),
(2, 'TH080', 1, 40, 1, 2017),
(2, 'TH080', 1, 41, 2, 2017),
(13, 'TH080', 1, 40, 1, 2017),
(12, 'TH082', 1, 40, 1, 2017),
(13, 'TH082', 1, 40, 1, 2017),
(1, 'TH091', 1, 41, 2, 2017),
(1, 'TH100', 1, 41, 2, 2017),
(2, 'TH101', 1, 41, 1, 2017),
(1, 'TH110', 1, 41, 1, 2017),
(2, 'TH110', 1, 41, 1, 2017),
(2, 'TH121', 1, 41, 2, 2017),
(12, 'TH121', 1, 40, 1, 2017),
(13, 'TH121', 1, 40, 1, 2017),
(2, 'TH130', 1, 40, 1, 2017),
(12, 'TH130', 1, 40, 1, 2017),
(13, 'TH130', 1, 40, 1, 2017),
(12, 'TH140', 1, 40, 1, 2017),
(13, 'TH140', 1, 40, 1, 2017),
(2, 'TH141', 1, 40, 1, 2017),
(1, 'TH153', 1, 41, 1, 2017),
(1, 'TH160', 1, 41, 1, 2017),
(2, 'TH160', 1, 41, 1, 2017),
(13, 'TH182', 1, 40, 2, 2017),
(2, 'TH185', 1, 41, 2, 2017),
(13, 'TH190', 1, 40, 2, 2017),
(2, 'TH192', 1, 40, 2, 2017),
(12, 'TH201', 1, 40, 1, 2017),
(12, 'TH211', 1, 40, 2, 2017),
(12, 'TH220', 1, 40, 2, 2017),
(1, 'TH310', 1, 41, 1, 2017),
(2, 'TH320', 1, 40, 1, 2017),
(2, 'TH331', 1, 40, 2, 2017),
(2, 'TH341', 1, 40, 1, 2017),
(2, 'TH350', 1, 40, 1, 2017),
(2, 'TH371', 1, 40, 2, 2017),
(2, 'TH400', 1, 40, 2, 2017),
(2, 'TQ010', 1, 42, 1, 2017),
(2, 'TQ030', 1, 42, 1, 2017),
(2, 'TQ040', 1, 42, 2, 2017),
(2, 'TQ050', 1, 42, 1, 2017),
(2, 'TQ080', 1, 42, 2, 2017),
(2, 'TQ090', 1, 42, 2, 2017),
(6, 'TU01', 1, 42, 1, 2017),
(7, 'TU01', 1, 42, 1, 2017),
(9, 'TU01', 1, 42, 1, 2017),
(11, 'TU01', 1, 42, 1, 2017),
(15, 'TU01', 1, 42, 1, 2017),
(16, 'TU01', 1, 42, 1, 2017),
(17, 'TU01', 1, 42, 2, 2017),
(18, 'TU01', 1, 42, 2, 2017),
(19, 'TU01', 1, 42, 2, 2017),
(20, 'TU01', 1, 42, 2, 2017),
(27, 'TU01', 1, 42, 2, 2017),
(1, 'TU020', 1, 42, 1, 2017),
(1, 'TU030', 1, 42, 1, 2017),
(1, 'TU040', 1, 42, 2, 2017),
(1, 'TU050', 1, 42, 2, 2017),
(1, 'TU060', 1, 42, 1, 2017),
(1, 'TU080', 1, 42, 2, 2017),
(1, 'TU100', 1, 42, 1, 2017),
(1, 'TU310', 1, 42, 2, 2017),
(2, 'TU310', 1, 42, 2, 2017),
(17, 'VP01', 1, 40, 1, 2017),
(17, 'VP02', 1, 40, 1, 2017),
(17, 'VP03', 1, 40, 2, 2017);

-- --------------------------------------------------------

--
-- Structure de la table `cvht`
--

CREATE TABLE IF NOT EXISTS `cvht` (
  `maCb` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `maLop` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `namHoc` int(4) NOT NULL,
  PRIMARY KEY (`maCb`,`maLop`,`namHoc`),
  KEY `maCb` (`maCb`,`maLop`),
  KEY `maLop` (`maLop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `cvht`
--

INSERT INTO `cvht` (`maCb`, `maLop`, `namHoc`) VALUES
('4600S337', '1', 2017),
('4600S216', '13', 2017),
('4600B121', '14', 2017),
('4600S338', '15', 2017),
('4600S286', '2', 2017),
('4600S215', '3', 2017),
('4600B120', '40', 2017),
('4600B122', '41', 2016),
('4600B122', '41', 2017),
('4300S282', '43', 2016),
('4300S282', '64', 2017);

-- --------------------------------------------------------

--
-- Structure de la table `doituonggiam`
--

CREATE TABLE IF NOT EXISTS `doituonggiam` (
  `maDt` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `tenDt` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `soTietGiam` tinyint(4) NOT NULL,
  PRIMARY KEY (`maDt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `doituonggiam`
--

INSERT INTO `doituonggiam` (`maDt`, `tenDt`, `soTietGiam`) VALUES
('2', 'Làm luận văn cao học', 120),
('3', 'Nghỉ hậu sản', 100),
('4', 'Nghỉ phép', 30),
('5', 'Miễn NCKH', 104);

-- --------------------------------------------------------

--
-- Structure de la table `khoa`
--

CREATE TABLE IF NOT EXISTS `khoa` (
  `maKhoa` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `tenKhoa` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`maKhoa`),
  UNIQUE KEY `tenKhoa` (`tenKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `khoa`
--

INSERT INTO `khoa` (`maKhoa`, `tenKhoa`) VALUES
('7', 'KHOA GIÁO DỤC CHÍNH TRỊ-PHÁP LUẬT'),
('8', 'KHOA GIÁO DỤC THỂ CHẤT-QUỐC PHÒNG'),
('6', 'KHOA KHOA HỌC XÃ HỘI - NHÂN VĂN'),
('2', 'KHOA KINH TẾ-QUẢN TRỊ KINH DOANH'),
('1', 'KHOA KỸ THUẬT CÔNG NGHỆ-MÔI TRƯỜNG'),
('3', 'KHOA NGOẠI NGỮ'),
('4', 'KHOA SƯ PHẠM');

-- --------------------------------------------------------

--
-- Structure de la table `lop`
--

CREATE TABLE IF NOT EXISTS `lop` (
  `maLop` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tenLop` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `siSo` int(2) NOT NULL,
  `maNganh` int(2) NOT NULL,
  `sttKhoa` int(2) NOT NULL,
  `he` tinyint(8) NOT NULL,
  PRIMARY KEY (`maLop`),
  KEY `maNganh` (`maNganh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `lop`
--

INSERT INTO `lop` (`maLop`, `tenLop`, `siSo`, `maNganh`, `sttKhoa`, `he`) VALUES
('1', 'QTM', 41, 12, 40, 1),
('10', 'QLTN Môi trường C', 50, 11, 40, 1),
('11', 'QLTN Môi trường D', 53, 11, 40, 1),
('12', 'CNKT Môi trường', 56, 3, 40, 1),
('13', 'Tin học A', 61, 1, 41, 1),
('14', 'Tin học B', 63, 1, 41, 1),
('15', 'HTTT', 30, 2, 41, 1),
('16', 'QLTN Môi trường A', 81, 11, 41, 1),
('17', 'QLTN Môi trường B', 83, 11, 41, 1),
('18', 'CNKT Môi trường', 48, 3, 41, 1),
('19', 'CNKT Xây dựng A', 82, 6, 41, 1),
('2', 'CNPM', 39, 13, 40, 1),
('20', 'CNKT Xây dựng B', 82, 6, 41, 1),
('21', 'CĐSP Vật lý', 28, 4, 41, 1),
('22', 'CN May', 85, 9, 41, 1),
('23', 'CĐSP Toán học', 40, 14, 40, 1),
('24', 'QTVP A', 55, 17, 40, 1),
('25', 'QTVP B', 54, 17, 40, 1),
('26', 'QTVP C', 48, 17, 40, 1),
('27', 'QTKD A', 47, 16, 41, 1),
('28', 'QTKD B', 49, 16, 41, 1),
('29', 'QTKD C', 58, 16, 41, 1),
('3', 'HTTT', 29, 2, 40, 1),
('30', 'Kế toán A', 61, 15, 40, 1),
('31', 'QTKD D', 44, 16, 41, 1),
('32', 'Kế Toán B', 56, 15, 40, 1),
('33', 'Kế toán C', 55, 15, 40, 1),
('34', 'Kế toán D', 47, 15, 40, 1),
('35', 'Tiếng Anh A', 56, 7, 42, 1),
('36', 'Tiếng Anh B', 52, 7, 42, 1),
('37', 'Tiếng Anh C', 50, 7, 42, 1),
('38', 'QLTN Môi trường', 36, 11, 42, 1),
('39', 'CN May', 33, 9, 42, 1),
('4', 'CNKT Xây dựng A', 57, 6, 40, 1),
('40', 'Tin học UD A', 40, 1, 42, 1),
('41', 'Tin học UD B', 40, 1, 42, 1),
('42', 'CNKT Xây dựng A', 51, 6, 42, 1),
('43', 'CNKT Xây dựng B', 53, 6, 42, 1),
('44', 'Kế toán A', 67, 15, 42, 1),
('45', 'Kế toán B', 65, 15, 42, 1),
('46', 'Kế toán C', 55, 15, 42, 1),
('47', 'QTKD A', 58, 16, 42, 1),
('48', 'QTKD B', 59, 16, 42, 1),
('49', 'QTKD C', 57, 16, 42, 1),
('5', 'CNKT Xây dựng B', 51, 6, 40, 1),
('50', 'QTKD D', 42, 16, 42, 1),
('51', 'Dịch vụ pháp lý A', 55, 18, 42, 1),
('52', 'Dịch vụ pháp lý B', 55, 18, 42, 1),
('53', 'Dịch vụ pháp lý C', 55, 18, 42, 1),
('54', 'Việt Nam học A', 72, 19, 42, 1),
('55', 'Việt Nam học B', 72, 19, 42, 1),
('56', 'QT DVDL & LH A', 65, 20, 42, 1),
('57', 'QT DVDL & LH B', 65, 20, 42, 1),
('58', 'QT DVDL & LH C', 65, 20, 42, 1),
('59', 'Quản trị văn phòng', 74, 17, 42, 1),
('6', 'CNKT Xây dựng C', 52, 6, 40, 1),
('60', 'SP Tiểu học', 31, 23, 42, 2),
('61', 'SP Mầm non', 41, 21, 42, 2),
('62', 'GD Mầm non', 30, 22, 42, 1),
('63', 'GD Tiểu học', 29, 24, 42, 1),
('64', 'HTTT', 30, 2, 42, 1),
('65', 'SP Toán học', 35, 14, 42, 1),
('66', 'SP Ngữ văn', 38, 27, 42, 1),
('67', 'SP Sử - Địa', 36, 25, 42, 1),
('68', 'SP Tiếng Anh', 32, 26, 42, 1),
('69', 'SP Khoa học tự nhiên', 15, 28, 42, 1),
('7', 'CN May', 64, 9, 40, 1),
('8', 'QLTN Môi trường A', 56, 11, 40, 1),
('9', 'QLTN Môi trường B', 47, 11, 40, 1);

-- --------------------------------------------------------

--
-- Structure de la table `monhoc`
--

CREATE TABLE IF NOT EXISTS `monhoc` (
  `maMon` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `tenMon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `soTc` tinyint(4) NOT NULL,
  `soTietLt` tinyint(4) NOT NULL,
  `soTietBT` int(100) NOT NULL,
  `soTietTh` tinyint(4) NOT NULL,
  `soTietKt` int(4) NOT NULL,
  PRIMARY KEY (`maMon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `monhoc`
--

INSERT INTO `monhoc` (`maMon`, `tenMon`, `soTc`, `soTietLt`, `soTietBT`, `soTietTh`, `soTietKt`) VALUES
('65', 'Tập giảng', 1, 27, 0, 0, 0),
('DC015', 'GDQP-AN (hp.3)', 3, 30, 0, 45, 0),
('DC025', 'GD.Thể chất (hp.3)', 2, 4, 0, 26, 0),
('DC041', 'Tư tưởng HCM', 2, 30, 0, 0, 0),
('DC051', 'Đường lối CM của Đẳng CSVN', 3, 45, 0, 0, 0),
('KD01', 'Tin học UD trong KD', 2, 15, 0, 30, 0),
('KL403', 'Thương mại điện tử', 2, 15, 0, 30, 0),
('KL404', 'An toàn HT và An ninh mạng', 3, 45, 0, 0, 0),
('KL405', 'Quản lý dự án phần mềm', 3, 45, 0, 0, 0),
('KL406', 'Giao diện người máy', 2, 15, 0, 30, 0),
('KT01', 'Tin học nâng cao (Access)', 2, 15, 0, 30, 0),
('MH05', 'Tin học căn bản', 3, 30, 0, 30, 0),
('SP01', 'PPDH nội dung môn Tin', 2, 30, 0, 0, 0),
('SP02', 'Cấu trúc dữ liệu và thuật ngữ', 3, 30, 0, 30, 0),
('SP03', 'Cơ sở dữ liệu', 3, 45, 0, 0, 0),
('SP04', 'Quản lý hệ thống máy tính', 2, 30, 0, 0, 0),
('SP05', 'Tin học', 2, 15, 0, 30, 0),
('TH020', 'Kiến trúc máy tính', 2, 30, 0, 0, 0),
('TH030', 'Đồ họa ứng dụng ', 2, 15, 0, 30, 0),
('TH031', 'Đồ họa ứng dụng', 3, 30, 0, 30, 0),
('TH040', 'Mạng máy tính', 2, 30, 0, 0, 0),
('TH050', 'Bảo trì sửa chữa máy tính', 2, 30, 0, 0, 0),
('TH060', 'Cấu trúc dữ liệu và Giải thuật', 3, 30, 0, 30, 0),
('TH070', 'Hệ điều hành', 2, 30, 0, 0, 0),
('TH071', 'Hệ điều hành', 2, 30, 0, 0, 0),
('TH080', 'Lập trình trong Windows', 3, 30, 0, 30, 0),
('TH082', 'Lập trình PHP & MySQL', 3, 30, 0, 30, 0),
('TH091', 'Chuyên đề web 2', 3, 30, 0, 30, 0),
('TH100', 'Cơ sở dữ liệu', 3, 45, 0, 0, 0),
('TH101', 'Cơ sở dữ liệu', 3, 30, 0, 30, 0),
('TH110', 'Lập trình hướng đối tượng C++', 3, 30, 0, 30, 0),
('TH121', 'Hệ quản trị cơ sở dữ liệu', 3, 30, 0, 30, 0),
('TH130', 'Phân tích thiết kế hệ thống', 3, 45, 0, 0, 0),
('TH140', 'Niên luận', 2, 30, 0, 0, 0),
('TH141', 'Niên luận ', 2, 30, 0, 0, 0),
('TH153', 'Chuyên đề tự chọn', 3, 30, 0, 30, 0),
('TH160', 'Anh văn chuyên ngành tin học', 2, 30, 0, 0, 0),
('TH182', 'Lập trình truyền thông', 3, 30, 0, 30, 0),
('TH183', 'Lập trình Java căn bản', 3, 30, 0, 30, 0),
('TH184', 'Lập trình mạng', 3, 30, 0, 30, 0),
('TH185', 'Phát triển phần mềm mã nguồn mở', 3, 30, 0, 30, 0),
('TH190', 'NM công nghệ phần mềm', 2, 30, 0, 0, 0),
('TH192', 'Nhập môn công nghệ phần mềm', 2, 30, 0, 0, 0),
('TH201', 'Cài đặt và quản trị mạng', 3, 30, 0, 30, 0),
('TH211', 'Chuyên đề mạng (Linux)', 3, 30, 0, 30, 0),
('TH220', 'Triển khai hệ thống mạng', 2, 15, 0, 30, 0),
('TH310', 'Chuyên đề web 1', 3, 30, 0, 30, 0),
('TH320', 'An toàn bảo mật thông tin và an ninh mạng', 3, 45, 0, 0, 0),
('TH331', 'Phân tích thiết kế hướng đối tượng', 3, 30, 0, 30, 0),
('TH341', 'Chuyên đề (Chuyên Đề ASP.NET & XML)', 3, 30, 0, 30, 0),
('TH350', 'Lập trình cơ sở dữ liệu', 3, 30, 0, 30, 0),
('TH360', 'Lập trình mô phỏng thế giới th', 3, 30, 0, 30, 0),
('TH371', 'Khai phá dữ liệu', 3, 30, 0, 30, 0),
('TH400', 'Chuyên đề  (Phát triển ứng dụng Smartphone trên nền tảng Android)', 3, 30, 0, 30, 0),
('TQ010', 'Tin học căn bản', 3, 17, 0, 58, 0),
('TQ030', 'Thuật toán ứng dụng trong tin học', 2, 17, 0, 28, 0),
('TQ040', 'Lập trình căn bản', 3, 20, 0, 55, 0),
('TQ050', 'Mạng máy tính', 3, 20, 0, 55, 0),
('TQ060', 'Cấu trúc dữ liệu và giải thuật', 3, 20, 0, 55, 0),
('TQ080', 'Cơ sở dữ liệu', 3, 20, 0, 55, 0),
('TQ090', 'Lập trình Web', 3, 20, 0, 55, 0),
('TU01', 'Tin học', 3, 17, 0, 58, 0),
('TU020', 'Tin học căn bản', 3, 17, 0, 58, 0),
('TU030', 'Thuật toán UD trong Tin học', 2, 45, 0, 0, 0),
('TU040', 'Tin học văn phòng', 3, 20, 0, 55, 0),
('TU050', 'Cơ sở dữ liệu', 3, 20, 0, 55, 0),
('TU060', 'Mạng máy tính', 3, 20, 0, 55, 0),
('TU080', 'Lập trình căn bản', 3, 20, 0, 55, 0),
('TU100', 'Bảo trì sửa chữa máy tính', 3, 20, 0, 55, 0),
('TU310', 'Thực tập thực tế 1 (5 ngày)', 1, 15, 0, 0, 0),
('VP01', 'Soạn thảo văn bản trên máy tính', 2, 15, 0, 15, 0),
('VP02', 'Tin học ứng dụng trong văn phòng', 2, 15, 0, 30, 0),
('VP03', 'Sử dụng trang thiết bị văn phòng', 2, 30, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `monhocmoi`
--

CREATE TABLE IF NOT EXISTS `monhocmoi` (
  `maMon` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `tenMon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `soTc` tinyint(4) NOT NULL,
  `soTietLt` tinyint(4) NOT NULL,
  `soTietBt` int(11) NOT NULL,
  `soTietTh` tinyint(4) NOT NULL,
  PRIMARY KEY (`maMon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `monhocmoi`
--

INSERT INTO `monhocmoi` (`maMon`, `tenMon`, `soTc`, `soTietLt`, `soTietBt`, `soTietTh`) VALUES
('65', 'Tập giảng', 1, 27, 0, 0),
('DC015', 'GDQP-AN (hp.3)', 3, 30, 0, 45),
('DC025', 'GD.Thể chất (hp.3)', 2, 4, 0, 26),
('DC041', 'Tư tưởng HCM', 2, 30, 0, 0),
('DC051', 'Đường lối CM của Đẳng CSVN', 3, 45, 0, 0),
('KD01', 'Tin học UD trong KD', 2, 15, 0, 30),
('KL403', 'Thương mại điện tử', 2, 15, 0, 30),
('KL404', 'An toàn HT và An ninh mạng', 3, 45, 0, 0),
('KL405', 'Quản lý dự án phần mềm', 3, 45, 0, 0),
('KL406', 'Giao diện người máy', 2, 15, 0, 30),
('KT01', 'Tin học nâng cao (Access)', 2, 15, 0, 30),
('MH05', 'Tin học căn bản', 3, 30, 0, 30),
('SP01', 'PPDH nội dung môn Tin', 2, 30, 0, 0),
('SP02', 'Cấu trúc dữ liệu và thuật ngữ', 3, 30, 0, 30),
('SP03', 'Cơ sở dữ liệu', 3, 45, 0, 0),
('SP04', 'Quản lý hệ thống máy tính', 2, 30, 0, 0),
('SP05', 'Tin học', 2, 15, 0, 30),
('TH020', 'Kiến trúc máy tính', 2, 30, 0, 0),
('TH030', 'Đồ họa ứng dụng ', 2, 15, 0, 30),
('TH031', 'Đồ họa ứng dụng', 3, 30, 0, 30),
('TH040', 'Mạng máy tính', 2, 30, 0, 0),
('TH050', 'Bảo trì sửa chữa máy tính', 2, 30, 0, 0),
('TH060', 'Cấu trúc dữ liệu và Giải thuật', 3, 30, 0, 30),
('TH070', 'Hệ điều hành', 2, 30, 0, 0),
('TH071', 'Hệ điều hành', 2, 30, 0, 0),
('TH080', 'Lập trình trong Windows', 3, 30, 0, 30),
('TH082', 'Lập trình PHP & MySQL', 3, 30, 0, 30),
('TH091', 'Chuyên đề web 2', 3, 30, 0, 30),
('TH100', 'Cơ sở dữ liệu', 3, 45, 0, 0),
('TH101', 'Cơ sở dữ liệu', 3, 30, 0, 30),
('TH110', 'Lập trình hướng đối tượng C++', 3, 30, 0, 30),
('TH121', 'Hệ quản trị cơ sở dữ liệu', 3, 30, 0, 30),
('TH130', 'Phân tích thiết kế hệ thống', 3, 45, 0, 0),
('TH140', 'Niên luận', 2, 30, 0, 0),
('TH141', 'Niên luận ', 2, 30, 0, 0),
('TH153', 'Chuyên đề tự chọn', 3, 30, 0, 30),
('TH160', 'Anh văn chuyên ngành tin học', 2, 30, 0, 0),
('TH182', 'Lập trình truyền thông', 3, 30, 0, 30),
('TH183', 'Lập trình Java căn bản', 3, 30, 0, 30),
('TH184', 'Lập trình mạng', 3, 30, 0, 30),
('TH185', 'Phát triển phần mềm mã nguồn mở', 3, 30, 0, 30),
('TH190', 'NM công nghệ phần mềm', 2, 30, 0, 0),
('TH192', 'Nhập môn công nghệ phần mềm', 2, 30, 0, 0),
('TH201', 'Cài đặt và quản trị mạng', 3, 30, 0, 30),
('TH211', 'Chuyên đề mạng (Linux)', 3, 30, 0, 30),
('TH220', 'Triển khai hệ thống mạng', 2, 15, 0, 30),
('TH310', 'Chuyên đề web 1', 3, 30, 0, 30),
('TH320', 'An toàn bảo mật thông tin và an ninh mạng', 3, 45, 0, 0),
('TH331', 'Phân tích thiết kế hướng đối tượng', 3, 30, 0, 30),
('TH341', 'Chuyên đề (Chuyên Đề ASP.NET & XML)', 3, 30, 0, 30),
('TH350', 'Lập trình cơ sở dữ liệu', 3, 30, 0, 30),
('TH360', 'Lập trình mô phỏng thế giới th', 3, 30, 0, 30),
('TH371', 'Khai phá dữ liệu', 3, 30, 0, 30),
('TH400', 'Chuyên đề  (Phát triển ứng dụng Smartphone trên nền tảng Android)', 3, 30, 0, 30),
('TQ010', 'Tin học căn bản', 3, 17, 0, 58),
('TQ030', 'Thuật toán ứng dụng trong tin học', 2, 17, 0, 28),
('TQ040', 'Lập trình căn bản', 3, 20, 0, 55),
('TQ050', 'Mạng máy tính', 3, 20, 0, 55),
('TQ060', 'Cấu trúc dữ liệu và giải thuật', 3, 20, 0, 55),
('TQ080', 'Cơ sở dữ liệu', 3, 20, 0, 55),
('TQ090', 'Lập trình Web', 3, 20, 0, 55),
('TU01', 'Tin học', 3, 17, 0, 58),
('TU020', 'Tin học căn bản', 3, 17, 0, 58),
('TU030', 'Thuật toán UD trong Tin học', 2, 45, 0, 0),
('TU040', 'Tin học văn phòng', 3, 20, 0, 55),
('TU050', 'Cơ sở dữ liệu', 3, 20, 0, 55),
('TU060', 'Mạng máy tính', 3, 20, 0, 55),
('TU080', 'Lập trình căn bản', 3, 20, 0, 55),
('TU100', 'Bảo trì sửa chữa máy tính', 3, 20, 0, 55),
('TU310', 'Thực tập thực tế 1 (5 ngày)', 1, 15, 0, 0),
('VP01', 'Soạn thảo văn bản trên máy tính', 2, 15, 0, 15),
('VP02', 'Tin học ứng dụng trong văn phòng', 2, 15, 0, 30),
('VP03', 'Sử dụng trang thiết bị văn phòng', 2, 30, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `monhocnganh`
--

CREATE TABLE IF NOT EXISTS `monhocnganh` (
  `maNganh` int(2) NOT NULL,
  `maMon` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `he` int(11) NOT NULL,
  PRIMARY KEY (`maNganh`,`maMon`,`he`),
  KEY `maMon` (`maMon`),
  KEY `maMon_2` (`maMon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `montienquyet`
--

CREATE TABLE IF NOT EXISTS `montienquyet` (
  `maMon` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `maMonTq` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`maMon`,`maMonTq`),
  KEY `maMonTq` (`maMonTq`),
  KEY `maMon` (`maMon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `nckh`
--

CREATE TABLE IF NOT EXISTS `nckh` (
  `maCb` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `namHoc` int(11) NOT NULL,
  `soTiet` int(11) NOT NULL DEFAULT '120',
  PRIMARY KEY (`maCb`,`namHoc`),
  KEY `maCb` (`maCb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `nganh`
--

CREATE TABLE IF NOT EXISTS `nganh` (
  `maNganh` int(2) NOT NULL,
  `tenNganh` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `maBm` int(2) NOT NULL,
  PRIMARY KEY (`maNganh`),
  UNIQUE KEY `tenNganh` (`tenNganh`),
  KEY `maBm` (`maBm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `nganh`
--

INSERT INTO `nganh` (`maNganh`, `tenNganh`, `maBm`) VALUES
(1, 'Tin học ứng dụng', 1),
(2, 'Hệ thống thông tin', 1),
(3, 'KTCN Môi trường', 3),
(4, 'SP vật lý', 2),
(5, 'Kỹ Thuật điện', 2),
(6, 'CNKT Xây dựng', 2),
(7, 'CĐ Anh Văn', 5),
(8, 'CĐ SP Anh', 5),
(9, 'CN May', 2),
(10, 'Thiết kế Web', 1),
(11, 'Tài nguyên môi trường', 3),
(12, 'Quản trị mạng', 1),
(13, 'Công nghệ phần mềm', 1),
(14, 'SP Toán', 7),
(15, 'Kế toán', 8),
(16, 'Quản trị kinh doanh', 8),
(17, 'Quản trị văn phòng', 9),
(18, 'Dịch vụ pháp lý', 10),
(19, 'Việt Nam học', 11),
(20, 'QTDV du lịch & LH', 12),
(21, 'TCSP Mầm non', 13),
(22, 'GD Mầm non', 13),
(23, 'TCSP Tiểu học', 14),
(24, 'GD Tiểu học', 14),
(25, 'Sử - Địa', 15),
(26, 'SP Anh', 16),
(27, 'SP Ngữ văn', 17),
(28, 'Lý sinh', 18);

-- --------------------------------------------------------

--
-- Structure de la table `pcday`
--

CREATE TABLE IF NOT EXISTS `pcday` (
  `maCb` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `maLop` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `maMon` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `hocKi` tinyint(4) NOT NULL,
  `namHoc` int(4) NOT NULL,
  PRIMARY KEY (`maCb`,`maLop`,`maMon`,`hocKi`,`namHoc`),
  KEY `maCb` (`maCb`,`maLop`,`maMon`),
  KEY `maLop` (`maLop`),
  KEY `maMon` (`maMon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `pcday`
--

INSERT INTO `pcday` (`maCb`, `maLop`, `maMon`, `hocKi`, `namHoc`) VALUES
('4600B122', '23', '65', 1, 2017),
('4300S282', '28', 'KD01', 1, 2017),
('4300S282', '29', 'KD01', 1, 2017),
('4600B123', '27', 'KD01', 1, 2017),
('4600B123', '31', 'KD01', 1, 2017),
('4600S339', '1', 'KL403', 2, 2017),
('4600S215', '1', 'KL404', 2, 2017),
('4600B119', '2', 'KL405', 2, 2017),
('4600S286', '3', 'KL405', 2, 2017),
('4600B120', '3', 'KL406', 2, 2017),
('4600S337', '2', 'KL406', 2, 2017),
('4600B121', '30', 'KT01', 1, 2017),
('4600B121', '32', 'KT01', 1, 2017),
('4600S218', '34', 'KT01', 1, 2017),
('4600S339', '33', 'KT01', 1, 2017),
('4600S286', '61', 'MH05', 2, 2017),
('4600S339', '60', 'MH05', 2, 2017),
('4600B122', '23', 'SP01', 1, 2017),
('4600S295', '23', 'SP02', 1, 2017),
('4600S338', '23', 'SP03', 1, 2017),
('4600S337', '23', 'SP04', 2, 2017),
('4600B123', '67', 'SP05', 2, 2017),
('4600B123', '68', 'SP05', 2, 2017),
('4600S216', '66', 'SP05', 2, 2017),
('4600S286', '62', 'SP05', 2, 2017),
('4600S286', '63', 'SP05', 2, 2017),
('4600S295', '69', 'SP05', 2, 2017),
('4600B122', '13', 'TH020', 2, 2017),
('4600B122', '14', 'TH020', 2, 2017),
('4600B123', '15', 'TH020', 2, 2017),
('4600S295', '15', 'TH030', 1, 2017),
('4600S338', '13', 'TH031', 2, 2017),
('4600S338', '14', 'TH031', 2, 2017),
('4600B118', '13', 'TH040', 2, 2017),
('4600S215', '15', 'TH040', 2, 2017),
('4600S337', '14', 'TH040', 2, 2017),
('4600S215', '1', 'TH050', 1, 2017),
('4600S215', '2', 'TH050', 1, 2017),
('4600S216', '15', 'TH060', 2, 2017),
('4600S295', '13', 'TH060', 2, 2017),
('4600S295', '14', 'TH060', 2, 2017),
('4600S337', '13', 'TH070', 1, 2017),
('4600S337', '14', 'TH070', 1, 2017),
('4600B120', '15', 'TH071', 1, 2017),
('4600B119', '2', 'TH080', 1, 2017),
('4600B119', '3', 'TH080', 1, 2017),
('4600S339', '15', 'TH080', 2, 2017),
('4600S212', '1', 'TH082', 1, 2017),
('4600S212', '2', 'TH082', 1, 2017),
('4600S216', '13', 'TH091', 2, 2017),
('4600S216', '14', 'TH091', 2, 2017),
('4600B121', '13', 'TH100', 2, 2017),
('4600B121', '14', 'TH100', 2, 2017),
('4600S218', '15', 'TH101', 1, 2017),
('4600S286', '13', 'TH110', 1, 2017),
('4600S286', '14', 'TH110', 1, 2017),
('4600S337', '15', 'TH110', 1, 2017),
('4600B121', '2', 'TH121', 1, 2017),
('4600B122', '15', 'TH121', 2, 2017),
('4600S212', '1', 'TH121', 1, 2017),
('4600S209', '1', 'TH130', 1, 2017),
('4600S209', '2', 'TH130', 1, 2017),
('4600S295', '3', 'TH130', 1, 2017),
('4600S209', '1', 'TH140', 1, 2017),
('4600S209', '2', 'TH140', 1, 2017),
('4600B123', '3', 'TH141', 1, 2017),
('4600B119', '13', 'TH153', 1, 2017),
('4600B119', '14', 'TH153', 1, 2017),
('4600B120', '2', 'TH182', 2, 2017),
('4300S282', '15', 'TH185', 2, 2017),
('4600B122', '2', 'TH190', 2, 2017),
('4600B121', '3', 'TH192', 2, 2017),
('4600S339', '1', 'TH201', 1, 2017),
('4600B118', '1', 'TH211', 2, 2017),
('4600B118', '1', 'TH220', 2, 2017),
('4600S216', '13', 'TH310', 1, 2017),
('4600S216', '14', 'TH310', 1, 2017),
('4600S215', '3', 'TH320', 1, 2017),
('4600S212', '3', 'TH331', 2, 2017),
('4600B120', '3', 'TH341', 1, 2017),
('4300S282', '3', 'TH350', 1, 2017),
('4600S209', '3', 'TH371', 2, 2017),
('4600S339', '3', 'TH400', 2, 2017),
('4600S339', '64', 'TQ010', 1, 2017),
('4600B118', '64', 'TQ030', 1, 2017),
('4600S295', '64', 'TQ040', 2, 2017),
('4600S337', '64', 'TQ050', 1, 2017),
('4600S338', '64', 'TQ080', 2, 2017),
('4600B119', '64', 'TQ090', 2, 2017),
('4300S282', '35', 'TU01', 1, 2017),
('4300S282', '43', 'TU01', 1, 2017),
('4300S282', '52', 'TU01', 2, 2017),
('4600B119', '44', 'TU01', 1, 2017),
('4600B120', '39', 'TU01', 1, 2017),
('4600B120', '51', 'TU01', 2, 2017),
('4600B121', '58', 'TU01', 2, 2017),
('4600B122', '36', 'TU01', 1, 2017),
('4600B122', '37', 'TU01', 1, 2017),
('4600B123', '45', 'TU01', 1, 2017),
('4600S209', '50', 'TU01', 1, 2017),
('4600S209', '59', 'TU01', 2, 2017),
('4600S212', '42', 'TU01', 1, 2017),
('4600S212', '55', 'TU01', 2, 2017),
('4600S215', '54', 'TU01', 2, 2017),
('4600S216', '49', 'TU01', 1, 2017),
('4600S286', '46', 'TU01', 1, 2017),
('4600S295', '38', 'TU01', 1, 2017),
('4600S337', '53', 'TU01', 2, 2017),
('4600S338', '47', 'TU01', 1, 2017),
('4600S338', '48', 'TU01', 1, 2017),
('4600S339', '57', 'TU01', 2, 2017),
('4600B120', '40', 'TU020', 1, 2017),
('4600B122', '41', 'TU020', 1, 2017),
('4600B118', '40', 'TU030', 1, 2017),
('4600B118', '41', 'TU030', 1, 2017),
('4600B123', '41', 'TU040', 2, 2017),
('4600S295', '40', 'TU040', 2, 2017),
('4600S209', '40', 'TU050', 2, 2017),
('4600S338', '41', 'TU050', 2, 2017),
('4600B118', '40', 'TU060', 1, 2017),
('4600S339', '41', 'TU060', 1, 2017),
('4600B118', '41', 'TU080', 2, 2017),
('4600S337', '40', 'TU080', 2, 2017),
('4600S215', '40', 'TU100', 1, 2017),
('4600S215', '41', 'TU100', 1, 2017),
('4600B120', '40', 'TU310', 2, 2017),
('4600B122', '41', 'TU310', 2, 2017),
('4600S215', '64', 'TU310', 2, 2017),
('4600B123', '24', 'VP01', 1, 2017),
('4600S218', '25', 'VP01', 1, 2017),
('4600S218', '26', 'VP01', 1, 2017),
('4600B123', '25', 'VP02', 1, 2017),
('4600S286', '24', 'VP02', 1, 2017),
('4600S286', '26', 'VP02', 1, 2017),
('4600B119', '25', 'VP03', 2, 2017),
('4600B123', '24', 'VP03', 2, 2017),
('4600S215', '26', 'VP03', 2, 2017);

-- --------------------------------------------------------

--
-- Structure de la table `tapbaigiang`
--

CREATE TABLE IF NOT EXISTS `tapbaigiang` (
  `maCb` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `namHoc` int(11) NOT NULL,
  `soTc` int(11) NOT NULL,
  PRIMARY KEY (`maCb`,`namHoc`),
  KEY `maCb` (`maCb`),
  KEY `maCb_2` (`maCb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `bomon`
--
ALTER TABLE `bomon`
  ADD CONSTRAINT `bomon_ibfk_1` FOREIGN KEY (`maKhoa`) REFERENCES `khoa` (`maKhoa`);

--
-- Contraintes pour la table `canbo`
--
ALTER TABLE `canbo`
  ADD CONSTRAINT `canbo_ibfk_1` FOREIGN KEY (`maBm`) REFERENCES `bomon` (`maBm`);

--
-- Contraintes pour la table `canbogiam`
--
ALTER TABLE `canbogiam`
  ADD CONSTRAINT `canbogiam_ibfk_1` FOREIGN KEY (`maCb`) REFERENCES `canbo` (`maCb`),
  ADD CONSTRAINT `canbogiam_ibfk_2` FOREIGN KEY (`maDt`) REFERENCES `doituonggiam` (`maDt`);

--
-- Contraintes pour la table `chucvugiangvien`
--
ALTER TABLE `chucvugiangvien`
  ADD CONSTRAINT `chucvugiangvien_ibfk_1` FOREIGN KEY (`maCb`) REFERENCES `canbo` (`maCb`),
  ADD CONSTRAINT `chucvugiangvien_ibfk_2` FOREIGN KEY (`maCv`) REFERENCES `chucvu` (`maCv`);

--
-- Contraintes pour la table `chuongtrinhhoc`
--
ALTER TABLE `chuongtrinhhoc`
  ADD CONSTRAINT `chuongtrinhhoc_ibfk_1` FOREIGN KEY (`maNganh`) REFERENCES `nganh` (`maNganh`),
  ADD CONSTRAINT `chuongtrinhhoc_ibfk_2` FOREIGN KEY (`maMon`) REFERENCES `monhoc` (`maMon`);

--
-- Contraintes pour la table `cvht`
--
ALTER TABLE `cvht`
  ADD CONSTRAINT `cvht_ibfk_1` FOREIGN KEY (`maCb`) REFERENCES `canbo` (`maCb`),
  ADD CONSTRAINT `cvht_ibfk_2` FOREIGN KEY (`maLop`) REFERENCES `lop` (`maLop`);

--
-- Contraintes pour la table `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lop_ibfk_1` FOREIGN KEY (`maNganh`) REFERENCES `nganh` (`maNganh`);

--
-- Contraintes pour la table `monhocnganh`
--
ALTER TABLE `monhocnganh`
  ADD CONSTRAINT `monhocnganh_ibfk_1` FOREIGN KEY (`maNganh`) REFERENCES `nganh` (`maNganh`),
  ADD CONSTRAINT `monhocnganh_ibfk_2` FOREIGN KEY (`maMon`) REFERENCES `monhoc` (`maMon`);

--
-- Contraintes pour la table `montienquyet`
--
ALTER TABLE `montienquyet`
  ADD CONSTRAINT `montienquyet_ibfk_1` FOREIGN KEY (`maMon`) REFERENCES `monhoc` (`maMon`),
  ADD CONSTRAINT `montienquyet_ibfk_2` FOREIGN KEY (`maMonTq`) REFERENCES `monhoc` (`maMon`);

--
-- Contraintes pour la table `nckh`
--
ALTER TABLE `nckh`
  ADD CONSTRAINT `nckh_ibfk_1` FOREIGN KEY (`maCb`) REFERENCES `canbo` (`maCb`);

--
-- Contraintes pour la table `nganh`
--
ALTER TABLE `nganh`
  ADD CONSTRAINT `nganh_ibfk_1` FOREIGN KEY (`maBm`) REFERENCES `bomon` (`maBm`);

--
-- Contraintes pour la table `pcday`
--
ALTER TABLE `pcday`
  ADD CONSTRAINT `pcday_ibfk_1` FOREIGN KEY (`maCb`) REFERENCES `canbo` (`maCb`),
  ADD CONSTRAINT `pcday_ibfk_2` FOREIGN KEY (`maLop`) REFERENCES `lop` (`maLop`),
  ADD CONSTRAINT `pcday_ibfk_3` FOREIGN KEY (`maMon`) REFERENCES `monhoc` (`maMon`);

--
-- Contraintes pour la table `tapbaigiang`
--
ALTER TABLE `tapbaigiang`
  ADD CONSTRAINT `tapbaigiang_ibfk_1` FOREIGN KEY (`maCb`) REFERENCES `canbo` (`maCb`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
