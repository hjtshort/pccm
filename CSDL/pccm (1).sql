-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2017 at 09:20 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pccm`
--
CREATE DATABASE IF NOT EXISTS `pccm` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `pccm`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `maAdmin` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `matKhau` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`maAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`maAdmin`, `matKhau`) VALUES
('admin', '25d55ad283aa400af464c76d713c07ad'),
('admin1', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `bomon`
--

CREATE TABLE IF NOT EXISTS `bomon` (
  `maBm` int(2) NOT NULL AUTO_INCREMENT,
  `tenBm` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `maKhoa` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`maBm`),
  UNIQUE KEY `tenBm` (`tenBm`),
  KEY `maKhoa` (`maKhoa`),
  KEY `maKhoa_2` (`maKhoa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bomon`
--

INSERT INTO `bomon` (`maBm`, `tenBm`, `maKhoa`) VALUES
(1, 'TIN HỌC', '1'),
(2, 'LÝ KỸ THUẬT', '1'),
(3, 'MÔI TRƯỜNG', '1'),
(5, 'TIẾNG', '3'),
(6, 'VIẾT', '3');

-- --------------------------------------------------------

--
-- Table structure for table `canbo`
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
-- Dumping data for table `canbo`
--

INSERT INTO `canbo` (`maCb`, `hoCb`, `tenCb`, `maBm`, `matKhau`) VALUES
('4600S1', 'Trần Thị', 'Hồng', 5, '25d55ad283aa400af464c76d713c07ad'),
('4600S203', 'Nguyễn Thị Mỹ', 'Linh', 3, '25d55ad283aa400af464c76d713c07ad'),
('4600S205', 'Lê Ngọc', 'Chân', 1, '25d55ad283aa400af464c76d713c07ad'),
('4600s207', 'Tần Duy', 'Khánh', 1, '25d55ad283aa400af464c76d713c07ad'),
('4600S208', 'Nguyễn', ' Minh Trang', 1, '25d55ad283aa400af464c76d713c07ad'),
('4600s209', 'Lâm', 'Thanh Ngọc', 1, '25d55ad283aa400af464c76d713c07ad'),
('4600S300', 'Trần Duy', 'Quang', 1, '25d55ad283aa400af464c76d713c07ad'),
('4600S301', 'Bùi Thị Ngọc', 'Dung', 1, '25d55ad283aa400af464c76d713c07ad'),
('4600S302', 'Nguyễn Việt Huỳnh', 'Mai', 1, '25d55ad283aa400af464c76d713c07ad'),
('4600S303', 'Nguyễn Hồng', 'Ngọc', 1, '25d55ad283aa400af464c76d713c07ad'),
('4600S304', 'Trần Lan', 'Chi', 3, '25d55ad283aa400af464c76d713c07ad'),
('4600S305', 'Trần Thị Thanh', 'Thanh', 2, '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `canbogiam`
--

CREATE TABLE IF NOT EXISTS `canbogiam` (
  `maCb` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `maDt` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `namHoc` int(4) NOT NULL,
  PRIMARY KEY (`maCb`,`maDt`,`namHoc`),
  KEY `maCb` (`maCb`,`maDt`),
  KEY `maDt` (`maDt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `canbogiam`
--

INSERT INTO `canbogiam` (`maCb`, `maDt`, `namHoc`) VALUES
('4600s207', '2', 2016),
('4600S301', '3', 2016);

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE IF NOT EXISTS `chucvu` (
  `maCv` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `tenCv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `soTiet` float NOT NULL,
  PRIMARY KEY (`maCv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`maCv`, `tenCv`, `soTiet`) VALUES
('1', 'Trưởng bộ môn', 54),
('2', 'Phó trưởng khoa', 67.5),
('3', 'Phó trưởng khoa phụ trách', 81),
('4', 'Trưởng khoa', 81),
('5', 'Phó trưởng bộ môn', 40.5),
('6', 'Tổ trưởng công đoàn', 54),
('7', 'Tổ phó công đoàn', 22);

-- --------------------------------------------------------

--
-- Table structure for table `chucvugiangvien`
--

CREATE TABLE IF NOT EXISTS `chucvugiangvien` (
  `maCb` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `maCv` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`maCb`,`maCv`),
  KEY `maCb` (`maCb`,`maCv`),
  KEY `maCv` (`maCv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chucvugiangvien`
--

INSERT INTO `chucvugiangvien` (`maCb`, `maCv`) VALUES
('4600s209', '1'),
('4600S304', '1'),
('4600S305', '1'),
('4600S303', '2'),
('4600S302', '3'),
('4600S203', '5'),
('4600S301', '5'),
('4600S301', '7');

-- --------------------------------------------------------

--
-- Table structure for table `chuongtrinhhoc`
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
-- Dumping data for table `chuongtrinhhoc`
--

INSERT INTO `chuongtrinhhoc` (`maNganh`, `maMon`, `he`, `sttKhoa`, `hocKi`, `namHoc`) VALUES
(3, 'MT1', 1, 41, 1, 2016),
(1, 'TH010', 1, 41, 1, 2016),
(1, 'TH010', 1, 41, 2, 2016),
(1, 'TH011', 1, 41, 2, 2016),
(2, 'TH011', 1, 39, 1, 2016),
(1, 'TH012', 1, 40, 1, 2016),
(1, 'TH012', 1, 40, 2, 2016),
(1, 'TH012', 1, 41, 1, 2016),
(1, 'TH012', 2, 41, 1, 2016),
(2, 'TH012', 1, 41, 1, 2016),
(5, 'TH012', 2, 41, 1, 2016),
(1, 'TH013', 1, 41, 1, 2016),
(2, 'TH013', 1, 41, 1, 2016),
(3, 'TH013', 1, 41, 1, 2016),
(1, 'TH014', 1, 40, 1, 2016),
(1, 'TH014', 1, 40, 2, 2016),
(1, 'TH014', 1, 41, 1, 2016),
(1, 'TH015', 1, 40, 1, 2016),
(2, 'TH015', 1, 41, 2, 2016),
(1, 'TH016', 1, 40, 1, 2015),
(1, 'TH016', 1, 40, 2, 2016),
(1, 'TH016', 1, 41, 1, 2016),
(1, 'TH016', 2, 41, 2, 2016),
(2, 'TH016', 1, 41, 2, 2016),
(5, 'TH016', 1, 41, 1, 2016),
(5, 'TH016', 2, 41, 1, 2016),
(10, 'TH016', 1, 41, 1, 2016),
(1, 'TH017', 1, 40, 1, 2016),
(2, 'TH017', 1, 39, 1, 2016),
(1, 'TH018', 1, 41, 1, 2016),
(1, 'TH018', 2, 41, 2, 2016),
(10, 'TH018', 1, 41, 2, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `cvht`
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
-- Dumping data for table `cvht`
--

INSERT INTO `cvht` (`maCb`, `maLop`, `namHoc`) VALUES
('4600S302', 'A1', 2016),
('4600S300', 'Đ1', 2016),
('4600S303', 'Đ11', 2016),
('4600S305', 'Đ22', 2016),
('4600S301', 'HTTT2', 2016),
('4600S203', 'MT1', 2016),
('4600S208', 'MT40', 2016),
('4600S302', 'SPAV2', 2016),
('4600s207', 'UD1', 2016),
('4600s209', 'UD2B', 2016);

-- --------------------------------------------------------

--
-- Table structure for table `doituonggiam`
--

CREATE TABLE IF NOT EXISTS `doituonggiam` (
  `maDt` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `tenDt` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `soTietGiam` tinyint(4) NOT NULL,
  PRIMARY KEY (`maDt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doituonggiam`
--

INSERT INTO `doituonggiam` (`maDt`, `tenDt`, `soTietGiam`) VALUES
('2', 'Làm luận văn cao học', 120),
('3', 'Nghỉ hậu sản', 100),
('4', 'Nghỉ phép', 30);

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE IF NOT EXISTS `khoa` (
  `maKhoa` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `tenKhoa` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`maKhoa`),
  UNIQUE KEY `tenKhoa` (`tenKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khoa`
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
-- Table structure for table `lop`
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
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`maLop`, `tenLop`, `siSo`, `maNganh`, `sttKhoa`, `he`) VALUES
('123', 'Tin ứng dụng', 53, 1, 38, 0),
('A1', 'Tin học C', 20, 1, 41, 1),
('Đ1', 'Trung cấp điện k41', 57, 1, 41, 2),
('Đ11', 'Cao Đẳng Điện', 77, 5, 41, 1),
('Đ22', 'CĐ Điện B', 80, 5, 41, 1),
('HT1', 'Hệ thống thông tin k41', 56, 2, 41, 1),
('HTTT2', 'Hệ thống thông tin', 39, 2, 39, 1),
('MT1', 'CĐ Kỹ Thuật Môi trường B', 66, 11, 41, 1),
('MT40', 'Tin học A', 69, 1, 41, 1),
('mt41', 'Tài nguyên môi trường A', 66, 11, 41, 1),
('Mt41A', 'CĐ Kỹ Thuật Môi trường A', 66, 11, 41, 1),
('mt43', 'Tài nguyên môi trường B', 45, 3, 41, 1),
('SPAV2', 'Tin học B', 90, 1, 41, 1),
('UD1', 'Tin ứng dụng', 50, 1, 40, 1),
('UD2', 'Tin ứng dụng k41  A', 90, 1, 41, 1),
('UD2B', 'Tin học ứng dụng B', 45, 1, 41, 1);

-- --------------------------------------------------------

--
-- Table structure for table `monhoc`
--

CREATE TABLE IF NOT EXISTS `monhoc` (
  `maMon` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `tenMon` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `soTc` tinyint(4) NOT NULL,
  `soTietLt` tinyint(4) NOT NULL,
  `soTietTh` tinyint(4) NOT NULL,
  PRIMARY KEY (`maMon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `monhoc`
--

INSERT INTO `monhoc` (`maMon`, `tenMon`, `soTc`, `soTietLt`, `soTietTh`) VALUES
('CS322', 'Tin học căn bản', 3, 30, 30),
('MT1', 'Tổng quan Môi trường', 3, 45, 0),
('TH010', 'Lập trình căn bản', 3, 30, 30),
('TH011', 'Tin Học Văn Phòng', 3, 30, 30),
('TH012', 'Cấu Trúc Dữ Liệu Và Giải Thuật', 3, 30, 30),
('TH013', 'Lập Trình Hướng đối Tượng', 3, 30, 30),
('TH014', 'Kiến Trúc Máy Tính', 3, 30, 30),
('TH015', 'Lập Trình C', 3, 30, 30),
('TH016', 'Đồ Họa ứng Dụng', 2, 30, 30),
('TH017', 'Photoshop', 2, 15, 30),
('TH018', 'Lập Trình Web1', 3, 30, 30);

-- --------------------------------------------------------

--
-- Table structure for table `nckh`
--

CREATE TABLE IF NOT EXISTS `nckh` (
  `maCb` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `namHoc` int(11) NOT NULL,
  PRIMARY KEY (`maCb`,`namHoc`),
  KEY `maCb` (`maCb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nckh`
--

INSERT INTO `nckh` (`maCb`, `namHoc`) VALUES
('4600s207', 2016),
('4600S208', 2016),
('4600s209', 2015),
('4600s209', 2016),
('4600S300', 2016);

-- --------------------------------------------------------

--
-- Table structure for table `nganh`
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
-- Dumping data for table `nganh`
--

INSERT INTO `nganh` (`maNganh`, `tenNganh`, `maBm`) VALUES
(1, 'Tin học ứng dụng', 1),
(2, 'Hệ thống thông tin', 1),
(3, 'KTCN Môi trường', 3),
(5, 'Kỹ Thuật điện', 2),
(7, 'CĐ Anh Văn', 5),
(8, 'CĐ SP Anh', 5),
(10, 'Thiết kế Web', 1),
(11, 'Tài nguyên môi trường', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pcday`
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
-- Dumping data for table `pcday`
--

INSERT INTO `pcday` (`maCb`, `maLop`, `maMon`, `hocKi`, `namHoc`) VALUES
('4600S301', 'UD2B', 'TH010', 1, 2016),
('4600S205', 'MT40', 'TH011', 2, 2016),
('4600S301', 'UD2', 'TH011', 2, 2016),
('4600S303', 'UD1', 'TH012', 2, 2016),
('4600s209', 'UD1', 'TH014', 2, 2016),
('4600s209', 'HT1', 'TH015', 2, 2016),
('4600s209', 'UD1', 'TH015', 1, 2016),
('4600s207', 'HT1', 'TH016', 2, 2016),
('4600s209', 'UD1', 'TH016', 2, 2016),
('4600s209', 'UD2B', 'TH016', 1, 2016),
('4600s209', 'UD1', 'TH017', 1, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `tapbaigiang`
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
-- Dumping data for table `tapbaigiang`
--

INSERT INTO `tapbaigiang` (`maCb`, `namHoc`, `soTc`) VALUES
('4600s207', 2016, 2),
('4600S208', 2016, 3),
('4600s209', 2016, 3),
('4600S300', 2016, 3),
('4600S302', 2016, 2),
('4600S304', 2016, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bomon`
--
ALTER TABLE `bomon`
  ADD CONSTRAINT `bomon_ibfk_1` FOREIGN KEY (`maKhoa`) REFERENCES `khoa` (`maKhoa`);

--
-- Constraints for table `canbo`
--
ALTER TABLE `canbo`
  ADD CONSTRAINT `canbo_ibfk_1` FOREIGN KEY (`maBm`) REFERENCES `bomon` (`maBm`);

--
-- Constraints for table `canbogiam`
--
ALTER TABLE `canbogiam`
  ADD CONSTRAINT `canbogiam_ibfk_1` FOREIGN KEY (`maCb`) REFERENCES `canbo` (`maCb`),
  ADD CONSTRAINT `canbogiam_ibfk_2` FOREIGN KEY (`maDt`) REFERENCES `doituonggiam` (`maDt`);

--
-- Constraints for table `chucvugiangvien`
--
ALTER TABLE `chucvugiangvien`
  ADD CONSTRAINT `chucvugiangvien_ibfk_1` FOREIGN KEY (`maCb`) REFERENCES `canbo` (`maCb`),
  ADD CONSTRAINT `chucvugiangvien_ibfk_2` FOREIGN KEY (`maCv`) REFERENCES `chucvu` (`maCv`);

--
-- Constraints for table `chuongtrinhhoc`
--
ALTER TABLE `chuongtrinhhoc`
  ADD CONSTRAINT `chuongtrinhhoc_ibfk_1` FOREIGN KEY (`maNganh`) REFERENCES `nganh` (`maNganh`),
  ADD CONSTRAINT `chuongtrinhhoc_ibfk_2` FOREIGN KEY (`maMon`) REFERENCES `monhoc` (`maMon`);

--
-- Constraints for table `cvht`
--
ALTER TABLE `cvht`
  ADD CONSTRAINT `cvht_ibfk_1` FOREIGN KEY (`maCb`) REFERENCES `canbo` (`maCb`),
  ADD CONSTRAINT `cvht_ibfk_2` FOREIGN KEY (`maLop`) REFERENCES `lop` (`maLop`);

--
-- Constraints for table `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lop_ibfk_1` FOREIGN KEY (`maNganh`) REFERENCES `nganh` (`maNganh`);

--
-- Constraints for table `nckh`
--
ALTER TABLE `nckh`
  ADD CONSTRAINT `nckh_ibfk_1` FOREIGN KEY (`maCb`) REFERENCES `canbo` (`maCb`);

--
-- Constraints for table `nganh`
--
ALTER TABLE `nganh`
  ADD CONSTRAINT `nganh_ibfk_1` FOREIGN KEY (`maBm`) REFERENCES `bomon` (`maBm`);

--
-- Constraints for table `pcday`
--
ALTER TABLE `pcday`
  ADD CONSTRAINT `pcday_ibfk_1` FOREIGN KEY (`maCb`) REFERENCES `canbo` (`maCb`),
  ADD CONSTRAINT `pcday_ibfk_2` FOREIGN KEY (`maLop`) REFERENCES `lop` (`maLop`),
  ADD CONSTRAINT `pcday_ibfk_3` FOREIGN KEY (`maMon`) REFERENCES `monhoc` (`maMon`);

--
-- Constraints for table `tapbaigiang`
--
ALTER TABLE `tapbaigiang`
  ADD CONSTRAINT `tapbaigiang_ibfk_1` FOREIGN KEY (`maCb`) REFERENCES `canbo` (`maCb`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
