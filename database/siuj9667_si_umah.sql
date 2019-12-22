-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 22 Des 2019 pada 15.40
-- Versi server: 10.2.30-MariaDB-cll-lve
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siuj9667_si_umah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aid`
--

CREATE TABLE `aid` (
  `id` int(10) UNSIGNED NOT NULL,
  `civilization_id` int(10) UNSIGNED NOT NULL,
  `type_of_aid` varchar(200) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `candidate`
--

CREATE TABLE `candidate` (
  `id` int(10) UNSIGNED NOT NULL,
  `civilization_id` int(10) UNSIGNED NOT NULL,
  `type_of_aid` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `candidate`
--

INSERT INTO `candidate` (`id`, `civilization_id`, `type_of_aid`) VALUES
(1, 42, 'PEMBELIAN SENG'),
(2, 44, 'UBIN/TEGEL'),
(3, 54, 'PENGADAAN LISTRIK'),
(4, 165, 'UBIN/TEGEL'),
(5, 43, 'PENGADAAN LISTRIK'),
(6, 69, 'PENGADAAN SUMUR'),
(7, 47, 'UBIN/TEGEL'),
(8, 70, 'PENGADAAN LISTRIK'),
(9, 158, 'PEMBELIAN SENG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `civilization`
--

CREATE TABLE `civilization` (
  `id` int(10) UNSIGNED NOT NULL,
  `village_id` int(10) UNSIGNED NOT NULL,
  `no_kk` varchar(100) NOT NULL,
  `chief_name` varchar(200) NOT NULL,
  `member_count` int(11) NOT NULL,
  `file_scan` text NOT NULL,
  `income` double NOT NULL,
  `age` int(5) NOT NULL,
  `job` varchar(200) NOT NULL,
  `study` varchar(200) NOT NULL,
  `civilization_card_scan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `civilization`
--

INSERT INTO `civilization` (`id`, `village_id`, `no_kk`, `chief_name`, `member_count`, `file_scan`, `income`, `age`, `job`, `study`, `civilization_card_scan`) VALUES
(40, 8, '7409010704140001', 'Jumardin', 4, 'Civilization_7409010704140001_1576977776.jpeg', 500000, 30, 'Wiraswasta', 'SLTA', 'Civilization_KTP_7409010704140001_1576977776.jpeg'),
(41, 8, '7409012703140004', 'Sumarlin', 1, 'Civilization_7409012703140004_1576978026.jpeg', 500000, 29, 'Wiraswasta', 'SLTA', 'default.jpg'),
(42, 9, '7409010802100002', 'ANSAR M.', 5, 'Civilization_7409010802100002_1576991041.jpeg', 1100000, 47, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'default.jpg'),
(43, 9, '7409011011170001', 'Hasrun', 3, 'Civilization_7409011011170001_1576984386.jpeg', 1200000, 32, 'Petani', 'SLTA/Sederajat', 'Civilization_KTP_7409011011170001_1576984386.jpeg'),
(44, 8, '7409010702100018', 'Sardin L', 5, 'Civilization_7409010702100018_1576978227.jpeg', 399999, 47, 'Petani', 'SLTP', 'default.jpg'),
(45, 8, '7409012806180003', 'Muh. Arif Kadir', 2, 'Civilization_7409012806180003_1576978394.jpeg', 450000, 24, 'Wiraswasta', 'SLTA', 'default.jpg'),
(46, 9, '7409010903180003', 'SURMAN', 4, 'Civilization_7409010903180003_1576984629.jpeg', 1100000, 55, 'WIRASWASTA', 'SLTA/Sederajat', 'Civilization_KTP_7409010903180003_1576984629.jpeg'),
(47, 8, '7409011505120001', 'Arif', 3, 'Civilization_7409011505120001_1576978653.jpeg', 500000, 35, 'Wiraswasta', 'SLTA', 'Civilization_KTP_7409011505120001_1576978653.jpeg'),
(48, 10, '74090102809120008', 'SYAMSUDIN', 4, 'Civilization_74090102809120008_1576983870.jpg', 1300000, 49, 'WIRASWASTA', 'SLTP/SEDERAJAT', 'Civilization_KTP_74090102809120008_1576983870.jpg'),
(49, 10, '7409012709120004', 'YOKENG', 4, 'Civilization_7409012709120004_1576979282.jpeg', 1300000, 64, 'PENSIUNAN', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409012709120004_1576979598.jpeg'),
(50, 9, '7409011806120005', 'SAKRIN', 3, 'Civilization_7409011806120005_1576982712.jpeg', 1200000, 47, 'PETANI/PEKEBUN', 'SLTA/Sederajat', 'Civilization_KTP_7409011806120005_1576982712.jpeg'),
(51, 10, '7409012809120009', 'POTIRI', 1, 'Civilization_7409012809120009_1576983959.jpg', 1000000, 50, 'PETANI/PEKEBUN', 'TAMAT SD/SEDERAJAT', 'Civilization_KTP_7409012809120009_1576983959.jpg'),
(52, 10, '7409012009120001', 'SAINAL', 6, 'Civilization_7409012009120001_1576984033.jpg', 1400000, 60, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409012009120001_1576984033.jpg'),
(53, 12, '7409011803100011', 'Harwan', 5, 'Civilization_7409011803100011_1576987442.jpeg', 1000000, 35, 'Petani/Berkebun', 'Tamat SD/Sederajat', 'Civilization_KTP_7409011803100011_1576987442.jpeg'),
(54, 8, '7409011002140001', 'Muis', 4, 'Civilization_7409011002140001_1576979151.jpeg', 300000, 67, 'Petani', 'SD', 'default.jpg'),
(55, 9, '7409010403140002', 'LUKMAN', 4, 'Civilization_7409010403140002_1576983734.jpeg', 1100000, 29, 'WIRASWASTA1`', 'SLTA/Sederajat', 'Civilization_KTP_7409010403140002_1576983734.jpeg'),
(56, 10, '7409012710140001', 'ASHAR', 3, 'Civilization_7409012710140001_1576984099.jpg', 1250000, 34, 'WIRASWASTA', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409012710140001_1576984099.jpg'),
(57, 12, '7409010404180001', 'Yenti', 2, 'Civilization_7409010404180001_1576987548.jpeg', 1000000, 24, 'Mengurus Rumah Tangga', 'SLTP/Sederajat', 'Civilization_KTP_7409010404180001_1576987548.jpeg'),
(58, 8, '7409011409120016', 'Dawi', 4, 'Civilization_7409011409120016_1576979392.jpeg', 400000, 45, 'Petani', 'SLTP', 'Civilization_KTP_7409011409120016_1576979392.jpeg'),
(59, 9, '7409013004120001', 'MAMBO', 5, 'Civilization_7409013004120001_1576984085.jpeg', 1200000, 42, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409013004120001_1576984085.jpeg'),
(60, 10, '7409012001150004', 'MUHAMMAD KURNIAWAN AMIN', 3, 'Civilization_7409012001150004_1576984142.jpg', 1500000, 26, 'KARYAWAN HONORER', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409012001150004_1576984143.jpg'),
(61, 12, '74090118811130015', 'Tamodo', 6, 'Civilization_74090118811130015_1576987681.jpeg', 1000000, 62, 'Petani/Berkebun', 'SD/Sederajat', 'Civilization_KTP_74090118811130015_1576987681.jpeg'),
(62, 12, '7409011409120010', 'Amrin', 7, 'Civilization_7409011409120010_1576980189.jpeg', 1000000, 54, 'PETANI/PEKEBUN', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409011409120010_1576979582.jpeg'),
(63, 8, '7409010702100038', 'Basti', 2, 'Civilization_7409010702100038_1576979588.jpeg', 300000, 45, 'Petani', 'SD', 'Civilization_KTP_7409010702100038_1576979588.jpeg'),
(64, 9, '7409011508840001', 'ASLAN', 3, 'default.jpg', 1000000, 35, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409011508840001_1576990824.jpeg'),
(65, 9, '7409012404120003', 'PINI', 4, 'Civilization_7409012404120003_1576983100.jpeg', 1100000, 59, 'PETANI/PEKEBUN', 'SD/SEDERAJAT', 'Civilization_KTP_7409012404120003_1576983100.jpeg'),
(66, 10, '7409012009120009', 'NASRUN', 6, 'Civilization_7409012009120009_1576984228.jpg', 1350000, 35, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409012009120009_1576984228.jpg'),
(67, 12, '7409010702100027', 'Madinu', 6, 'Civilization_7409010702100027_1576987822.jpeg', 1000000, 66, 'Petani/Pekebun', 'SLTP/Sederajat', 'Civilization_KTP_7409010702100027_1576987822.jpeg'),
(68, 10, '7409012009120032', 'ARMAN', 5, 'Civilization_7409012009120032_1576984276.jpg', 1150000, 34, 'PETANI/PEKEBUN', 'TAMAT SD/SEDERAJAT', 'Civilization_KTP_7409012009120032_1576984276.jpg'),
(69, 9, '7409010304140005', 'IDIL ADHA', 3, 'Civilization_7409010304140005_1576983417.jpeg', 1100000, 24, 'WIRASWASTA', 'SLTA/Sederajat', 'Civilization_KTP_7409010304140005_1576983417.jpeg'),
(70, 8, '7409011103100005', 'Abukaisi', 4, 'Civilization_7409011103100005_1576979820.jpeg', 340000, 52, 'Petani', 'SD', 'Civilization_KTP_7409011103100005_1576979820.jpeg'),
(71, 9, '7409011901160002', 'SAHANAA', 3, 'Civilization_7409011901160002_1576990557.jpeg', 1000000, 82, 'PETANI/PEKEBUN', 'SD/SEDERAJAT', 'Civilization_KTP_7409011901160002_1576990557.jpeg'),
(72, 12, '7409013005160001', 'Irman', 3, 'Civilization_7409013005160001_1576988053.jpeg', 1500000, 35, 'Karyawan/Swasta', 'SLTA/Sederajat', 'Civilization_KTP_7409013005160001_1576988053.jpeg'),
(73, 10, '7409012809120014', 'HAIRUDIN,S.Kom', 3, 'Civilization_7409012809120014_1576980282.jpeg', 1400000, 32, 'WIRASWASTA', 'DIPLOMA/SATRATA I', 'Civilization_KTP_7409012809120014_1576980282.jpeg'),
(74, 10, '7409012009120024', 'SARIFUDDIN PALARI', 8, 'Civilization_7409012009120024_1576984339.jpg', 1200000, 46, 'PETANI/PEKEBUN', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409012009120024_1576984339.jpg'),
(76, 9, '7409012709160002', 'RUSLAN', 3, 'Civilization_7409012709160002_1576990302.jpeg', 1200000, 35, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409012709160002_1576990302.jpeg'),
(77, 9, '7409010702100040', 'BURHAN', 5, 'Civilization_7409010702100040_1576981409.jpeg', 1100000, 40, 'PETANI/PEKEBUN', 'SD/SEDERAJAT', 'Civilization_KTP_7409010702100040_1576981409.jpeg'),
(78, 10, '7409011803140002', 'WARIS', 7, 'Civilization_7409011803140002_1576984399.jpg', 1200000, 38, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409011803140002_1576984399.jpg'),
(79, 8, '7409040409130001', 'Diman', 3, 'Civilization_7409040409130001_1576980053.jpeg', 700000, 37, 'Wiraswasta', 'SLTA', 'Civilization_KTP_7409040409130001_1576980053.jpeg'),
(80, 12, '7409010602100001', 'Tamin. K', 3, 'Civilization_7409010602100001_1576980056.jpeg', 1000000, 52, 'Petani/Pekebun', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409010602100001_1576980056.jpeg'),
(81, 11, '7409091309120009', 'MARTINI', 5, 'Civilization_7409091309120009_1576990409.jpg', 1000000, 40, 'PETANI', 'SMA', 'default.jpg'),
(82, 12, '740901070210011', 'Nurlian', 3, 'Civilization_740901070210011_1576988212.jpeg', 1000000, 52, 'Petani/Pekebun', 'SD/Sederajat', 'Civilization_KTP_740901070210011_1576988212.jpeg'),
(83, 10, '7409012009120019', 'TINA S', 5, 'Civilization_7409012009120019_1576984442.jpg', 500000, 69, 'MENGURUS RUMAH TANGGA', 'TAMAT SD/SEDERAJAT', 'Civilization_KTP_7409012009120019_1576984442.jpg'),
(84, 9, '7409011703100007', 'PADIR', 5, 'Civilization_7409011703100007_1576981787.jpeg', 1200000, 44, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409011703100007_1576981787.jpeg'),
(85, 9, '7409010503760001', 'MASRIN M.', 3, 'default.jpg', 1200000, 43, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409010503760001_1576989974.jpeg'),
(86, 8, '7409010609120029', 'Alwi. B', 1, 'Civilization_7409010609120029_1576980361.jpeg', 300000, 66, 'Petani', 'SD', 'Civilization_KTP_7409010609120029_1576980361.jpeg'),
(87, 10, '7409071010160001', 'SARIPUDIN T', 3, 'Civilization_7409071010160001_1576984499.jpg', 400000, 45, 'BELUM/TIDAK BEKERJA', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409071010160001_1576984499.jpg'),
(88, 9, '7409010802100008', 'SAPRIN', 4, 'Civilization_7409010802100008_1576982119.jpeg', 1000000, 36, 'TIDAK BEKERJA', 'DIPLOMA', 'Civilization_KTP_7409010802100008_1576982119.jpeg'),
(89, 12, '7409010602100003', 'Hendar', 4, 'Civilization_7409010602100003_1576980478.jpeg', 1000000, 39, 'Karyawan Swasta', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409010602100003_1576980478.jpeg'),
(90, 12, '7409011103100035', 'Ato', 5, 'Civilization_7409011103100035_1576988402.jpeg', 1000000, 68, 'Petani/Pekebun', 'SLTP/Sederajat', 'Civilization_KTP_7409011103100035_1576988402.jpeg'),
(91, 10, '7409011102700001', 'RASID', 1, 'default.jpg', 1200000, 49, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409011102700001_1576984556.jpg'),
(92, 9, '7409010702100043', 'ARWIN', 4, 'Civilization_7409010702100043_1576982393.jpeg', 1200000, 47, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409010702100043_1576982393.jpeg'),
(93, 9, '7409010802100006', 'HARDIN S.', 6, 'Civilization_7409010802100006_1576989718.jpeg', 1100000, 68, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409010802100006_1576989718.jpeg'),
(94, 8, '7409011911130007', 'Edison', 3, 'Civilization_7409011911130007_1576980596.jpeg', 450000, 32, 'karyawan Honorer', 'SLTA', 'default.jpg'),
(95, 12, '7409010702100026', 'Saifun Marahia', 5, 'Civilization_7409010702100026_1576988538.jpeg', 1500000, 41, 'Wiraswasta', 'SLTA/Sederajat', 'Civilization_KTP_7409010702100026_1576988538.jpeg'),
(96, 10, '740901120215001', 'SARDIN,A.Md.Com', 4, 'Civilization_740901120215001_1576980980.jpeg', 1500000, 35, 'WIRASWASTA', 'AKADEMI DIPLOMA III/SARJANA MUDA', 'Civilization_KTP_740901120215001_1576980980.jpeg'),
(97, 10, '7409010708140001', 'EMILIA', 3, 'Civilization_7409010708140001_1576984605.jpg', 1300000, 30, 'KARYAWAN HONORER', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409010708140001_1576984605.jpg'),
(98, 12, '7409011103100009', 'Abdul Razak', 4, 'Civilization_7409011103100009_1576988692.jpeg', 1000000, 59, 'Petani/Pekebun', 'SLTA/Sederajat', 'Civilization_KTP_7409011103100009_1576988692.jpeg'),
(99, 9, '7409011206670001', 'MASRI L.', 3, 'default.jpg', 1200000, 52, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409011206670001_1576989439.jpeg'),
(100, 11, '7409090405160002', 'YUSRIN', 3, 'Civilization_7409090405160002_1576990569.jpg', 1200000, 38, 'PETANI', 'SMA', 'Civilization_KTP_7409090405160002_1576990569.jpg'),
(101, 10, '7409011201650001', 'SAMIR', 1, 'default.jpg', 1400000, 54, 'KARYAWAN HONORER', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409011201650001_1576984648.jpg'),
(102, 12, '7409011703100013', 'Sey', 6, 'Civilization_7409011703100013_1576980806.jpeg', 1200000, 69, 'Petani/Pekebun', 'TAMAT SD/SEDERAJAT', 'Civilization_KTP_7409011703100013_1576980806.jpeg'),
(103, 12, '7409013005160004', 'Muhammad Arif', 7, 'Civilization_7409013005160004_1576988791.jpeg', 1200000, 30, 'Petani/Pekebun', 'SLTP/Sederajat', 'Civilization_KTP_7409013005160004_1576988791.jpeg'),
(104, 12, '7409012507160001', 'Helianti', 2, 'Civilization_7409012507160001_1576988946.jpeg', 1500000, 35, 'Karyawan/Swasta', 'SLTA/Sederajat', 'Civilization_KTP_7409012507160001_1576988946.jpeg'),
(105, 9, '7409010304140007', 'UCOK', 6, 'Civilization_7409010304140007_1576989129.jpeg', 1300000, 57, 'PETANI/PEKEBUN', 'SD/SEDERAJAT', 'Civilization_KTP_7409010304140007_1576989129.jpeg'),
(106, 12, '7409011405120023', 'Muh. Amir', 6, 'Civilization_7409011405120023_1576981050.jpeg', 1000000, 49, 'Petani/Pekebun', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409011405120023_1576981050.jpeg'),
(107, 8, '7409012607110003', 'Wainggi', 3, 'Civilization_7409012607110003_1576981067.jpeg', 250000, 76, 'Petani', 'SD', 'default.jpg'),
(108, 11, '7409012502080447', 'HAMASA', 5, 'Civilization_7409012502080447_1576990738.jpg', 1000000, 77, 'NELAYAN', 'SD', 'Civilization_KTP_7409012502080447_1576990738.jpg'),
(109, 9, '7409010405730001', 'HADRIN', 5, 'Civilization_7409010405730001_1576988829.jpeg', 1200000, 46, 'PETANI/PEKEBUN', 'SD/SEDERAJAT', 'Civilization_KTP_7409010405730001_1576988829.jpeg'),
(110, 12, '7409010908160001', 'Ernia Riani', 4, 'Civilization_7409010908160001_1576989073.jpeg', 1000000, 45, 'Mengurus Rumah Tangga', 'SLTA/Sederajat', 'Civilization_KTP_7409010908160001_1576989073.jpeg'),
(111, 8, '7409011103100010', 'Aswadin', 3, 'Civilization_7409011103100010_1576981258.jpeg', 590000, 33, 'Wiraswasta', 'SLTA', 'default.jpg'),
(112, 12, '7409011103100032', 'Sege Konangia', 6, 'Civilization_7409011103100032_1576981275.jpeg', 1500000, 41, 'Wiraswasta', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409011103100032_1576981275.jpeg'),
(113, 10, '740904110912024', 'DEDIN', 3, 'Civilization_740904110912024_1576981537.jpeg', 1300000, 32, 'KARYAWAN SWASTA', 'SLTA/SEDERAJAT', 'Civilization_KTP_740904110912024_1576981537.jpeg'),
(114, 12, '7409010702100012', 'Nuksun', 3, 'Civilization_7409010702100012_1576989227.jpeg', 1200000, 51, 'Petani/Pekebun', 'SLTA/Sederajat', 'Civilization_KTP_7409010702100012_1576989227.jpeg'),
(115, 9, '7409010602100010', 'ARSAN', 4, 'Civilization_7409010602100010_1576988499.jpeg', 1300000, 34, 'PETANI/PEKEBUN', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409010602100010_1576988499.jpeg'),
(116, 12, '7409010602100008', 'Ebu', 5, 'Civilization_7409010602100008_1576981498.jpeg', 1500000, 46, 'Wiraswasta', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409010602100008_1576981498.jpeg'),
(117, 12, '7409011203180002', 'Angkas', 6, 'Civilization_7409011203180002_1576989364.jpeg', 1500000, 38, 'Pegawai Negeri Sipil', 'SLTA/Sederajat', 'Civilization_KTP_7409011203180002_1576989364.jpeg'),
(118, 8, '7409012002140001', 'Bunga', 1, 'Civilization_7409012002140001_1576981608.jpeg', 250000, 60, 'Petani', 'SD', 'Civilization_KTP_7409012002140001_1576981608.jpeg'),
(119, 12, '7409010702100010', 'Tamsir', 5, 'Civilization_7409010702100010_1576989469.jpeg', 1000000, 45, 'Petani/Pekebun', 'SLTP/Sederajat', 'Civilization_KTP_7409010702100010_1576989469.jpeg'),
(120, 9, '7409010911170001', 'ARDINAL', 4, 'Civilization_7409010911170001_1576988201.jpeg', 1000000, 28, 'PETANI/PEKEBUN', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409010911170001_1576988201.jpeg'),
(121, 11, '7409092009120004', 'HERMAN H', 5, 'Civilization_7409092009120004_1576990835.jpg', 1300000, 29, 'NELAYAN', 'SMA', 'Civilization_KTP_7409092009120004_1576990835.jpg'),
(122, 12, '7409010602100011', 'Sahardin', 5, 'Civilization_7409010602100011_1576981737.jpeg', 1000000, 48, 'Petani/Pekebun', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409010602100011_1576981737.jpeg'),
(123, 12, '7409010303160002', 'Sisilia S.sos', 3, 'Civilization_7409010303160002_1576989586.jpeg', 1500000, 39, 'Pegawai Negeri Sipil', 'Diploma IV/Strata I', 'Civilization_KTP_7409010303160002_1576989586.jpeg'),
(124, 9, '7409010702100042', 'BESE', 3, 'Civilization_7409010702100042_1576987853.jpeg', 800000, 69, 'MENGURUS RUMAH TANGGA', 'BELUM TAMAT SD/SEDERAJAT', 'Civilization_KTP_7409010702100042_1576987853.jpeg'),
(125, 12, '7409010308160001', 'Rusdiamin', 2, 'Civilization_7409010308160001_1576989692.jpeg', 1000000, 44, 'Petani/Pekebun', 'SLTA/Sederajat', 'Civilization_KTP_7409010308160001_1576989692.jpeg'),
(126, 8, '7409011103100007', 'Amiluddin', 4, 'Civilization_7409011103100007_1576981934.jpeg', 900000, 59, 'Wiraswasta', 'SLTA', 'default.jpg'),
(127, 12, '7409011712130008', 'Ajis', 4, 'Civilization_7409011712130008_1576981952.jpeg', 1200000, 33, 'Wiraswasta', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409011712130008_1576981952.jpeg'),
(128, 10, '7409051510120002', 'NAWIR.S', 4, 'Civilization_7409051510120002_1576982123.jpeg', 1200000, 30, 'WIRASWASTA', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409051510120002_1576982123.jpeg'),
(129, 9, '7409010802100005', 'PITNUR', 8, 'Civilization_7409010802100005_1576987486.jpeg', 1300000, 48, 'BELUM/TIDAK BEKERJA', 'SD/SEDERAJAT', 'Civilization_KTP_7409010802100005_1576987486.jpeg'),
(130, 12, '7409011402180001', 'Muhammad Budu Latongara', 3, 'Civilization_7409011402180001_1576990605.jpeg', 1000000, 88, 'Petani/Pekebun', 'SD/Sederajat', 'default.jpg'),
(131, 11, '7409012502080454', 'MASBUL', 6, 'Civilization_7409012502080454_1576990891.jpg', 1000000, 74, 'PETANI', 'SMA', 'Civilization_KTP_7409012502080454_1576990893.jpg'),
(132, 9, '7409010802100017', 'HASRIN', 5, 'Civilization_7409010802100017_1576987116.jpeg', 1100000, 44, 'BURUH HARIAN LEPAS', 'SD/SEDERAJAT', 'Civilization_KTP_7409010802100017_1576987116.jpeg'),
(133, 12, '7409012910120002', 'Darman', 4, 'Civilization_7409012910120002_1576982151.jpeg', 1500000, 29, 'Wiraswasta', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409012910120002_1576982151.jpeg'),
(134, 12, '7409011203100003', 'Tiga', 3, 'Civilization_7409011203100003_1576990038.jpeg', 1000000, 43, 'Petani/Pekebun', 'SLTP/Sederajat', 'Civilization_KTP_7409011203100003_1576990038.jpeg'),
(135, 9, '7409010802100015', 'DARMA', 5, 'Civilization_7409010802100015_1576986779.jpeg', 1200000, 37, 'WIRASWASTA', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409010802100015_1576986779.jpeg'),
(136, 12, '7409010602100019', 'Laigi', 5, 'Civilization_7409010602100019_1576990267.jpeg', 1200000, 60, 'Karyawan/Swasta', 'SLTP/Sederajat', 'default.jpg'),
(137, 8, '7409010208110004', 'Abd. Kadir', 4, 'Civilization_7409010208110004_1576982291.jpeg', 340000, 47, 'Petani', 'SLTP', 'Civilization_KTP_7409010208110004_1576982291.jpeg'),
(138, 12, '7409012910120003', 'Dirman', 3, 'Civilization_7409012910120003_1576982362.jpeg', 1300000, 31, 'Wiraswasta', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409012910120003_1576982362.jpeg'),
(139, 9, '7409010802100018', 'RASDIN MALAKA', 5, 'Civilization_7409010802100018_1576986445.jpeg', 1000000, 40, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409010802100018_1576986445.jpeg'),
(140, 12, '7409010602100006', 'WeriBanggi', 2, 'Civilization_7409010602100006_1576990389.jpeg', 1000000, 67, 'Petani/Pekebun', 'SD/Sederajat', 'Civilization_KTP_7409010602100006_1576990389.jpeg'),
(141, 12, '7409010602100021', 'Darisman', 7, 'Civilization_7409010602100021_1576989897.jpeg', 1200000, 48, 'Petani/Pekebun', 'SLTA/Sederajat', 'Civilization_KTP_7409010602100021_1576989897.jpeg'),
(142, 10, '7409012803110001', 'RAMADHAN', 2, 'Civilization_7409012803110001_1576982712.jpeg', 1200000, 37, 'WIRASWASTA', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409012803110001_1576982712.jpeg'),
(143, 9, '7409012906150001', 'AMIR', 4, 'Civilization_7409012906150001_1576985895.jpeg', 1200000, 29, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409012906150001_1576985895.jpeg'),
(144, 12, '7409010602100022', 'Simin', 6, 'Civilization_7409010602100022_1576982548.jpeg', 1000000, 42, 'Petani/Pekebun', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409010602100022_1576982548.jpeg'),
(145, 8, '7409011103100023', 'Amiruddin', 5, 'Civilization_7409011103100023_1576982573.jpeg', 390000, 50, 'Petani', 'SLTP', 'Civilization_KTP_7409011103100023_1576982573.jpeg'),
(146, 11, '7409091403110011', 'AWALUDIN', 3, 'Civilization_7409091403110011_1576991002.jpg', 1500000, 53, 'PETANI', 'SMA', 'Civilization_KTP_7409091403110011_1576991002.jpg'),
(147, 9, '7409011308720002', 'ANSAR M.', 3, 'default.jpg', 900000, 47, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409011308720002_1576985329.jpeg'),
(148, 12, '7409011910150001', 'Makia', 3, 'Civilization_7409011910150001_1576990514.jpeg', 1000000, 70, 'Petani/Pekebun', 'SD/Sederajat', 'Civilization_KTP_7409011910150001_1576990514.jpeg'),
(149, 12, '7409010602100004', 'Asnur', 6, 'Civilization_7409010602100004_1576982727.jpeg', 1200000, 43, 'Petani/Pekebun', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409010602100004_1576982727.jpeg'),
(150, 8, '7409012607110001', 'Rudi Warno', 4, 'Civilization_7409012607110001_1576982743.jpeg', 360000, 36, 'Petani', 'SLTP', 'default.jpg'),
(151, 12, '7409010602100028', 'safruddin', 6, 'Civilization_7409010602100028_1576990167.jpeg', 1200000, 44, 'Wiraswasta', 'SLTP/Sederajat', 'Civilization_KTP_7409010602100028_1576990167.jpeg'),
(152, 12, '7409010602100014', 'Tamiri', 3, 'Civilization_7409010602100014_1576982913.jpeg', 1000000, 58, 'Petani/Pekebun', 'TAMAT SD/SEDERAJAT', 'Civilization_KTP_7409010602100014_1576982913.jpeg'),
(153, 12, '7409010602100027', 'Dirman', 6, 'Civilization_7409010602100027_1576986510.jpeg', 1000000, 45, 'Petani/Pekebun', 'SLTP/Sederajat', 'Civilization_KTP_7409010602100027_1576986510.jpeg'),
(154, 8, '7409013107180002', 'Mira', 2, 'Civilization_7409013107180002_1576982950.jpeg', 150000, 50, 'Mengurus Rumah Tangga', 'SD', 'Civilization_KTP_7409013107180002_1576982950.jpeg'),
(155, 12, '7409010602100012', 'Saimun', 2, 'Civilization_7409010602100012_1576986319.jpeg', 1000000, 63, 'Petani/Pekebun', 'SLTP/Sederajat', 'Civilization_KTP_7409010602100012_1576986319.jpeg'),
(156, 10, '7409012809120016', 'TASJUDIN', 1, 'Civilization_7409012809120016_1576983235.jpeg', 1000000, 38, 'PETANI/PEKEBUN', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409012809120016_1576983235.jpeg'),
(157, 12, '7409010602100026', 'M. Yasir', 6, 'Civilization_7409010602100026_1576983099.jpeg', 1000000, 51, 'Wiraswasta', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409010602100026_1576983099.jpeg'),
(158, 8, '7409012009160004', 'Heni', 4, 'Civilization_7409012009160004_1576983116.jpeg', 200000, 31, 'Mengurus Rumah Tangga', 'SD', 'default.jpg'),
(159, 12, '7409011103100034', 'Ambo', 4, 'Civilization_7409011103100034_1576985996.jpeg', 1200000, 53, 'Petani/Pekebun', 'SLTA/Sederajat', 'Civilization_KTP_7409011103100034_1576985996.jpeg'),
(160, 11, '7409091709120009', 'MINARNI SARANANI', 3, 'Civilization_7409091709120009_1576991058.jpg', 1500000, 35, 'KARYAWAN HONORER', 'SMA', 'Civilization_KTP_7409091709120009_1576991058.jpg'),
(161, 12, '7409010602100029', 'Abd LAtif', 3, 'Civilization_7409010602100029_1576983299.jpeg', 1000000, 59, 'Pensiunan', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409010602100029_1576983299.jpeg'),
(162, 8, '7409010602100009', 'Ober', 3, 'Civilization_7409010602100009_1576983355.jpeg', 350000, 34, 'Wiraswasta', 'SLTP', 'Civilization_KTP_7409010602100009_1576983355.jpeg'),
(163, 8, '7409012806180002', 'Irpan', 2, 'Civilization_7409012806180002_1576983576.jpeg', 340000, 25, 'Petani', 'SLTA', 'Civilization_KTP_7409012806180002_1576983576.jpeg'),
(164, 8, '7409011103100022', 'Usman L', 1, 'Civilization_7409011103100022_1576983821.jpeg', 350000, 57, 'Petani', 'SD', 'Civilization_KTP_7409011103100022_1576983821.jpeg'),
(165, 10, '74009012809120004', 'TASJUNI', 4, 'Civilization_74009012809120004_1576984686.jpeg', 1300000, 39, 'KARYAWAN HONORER', 'SLTA/SEDERAJAT', 'Civilization_KTP_74009012809120004_1576984686.jpeg'),
(166, 10, '7409010901180002', 'RIMBA', 1, 'Civilization_7409010901180002_1576985229.jpeg', 1400000, 51, 'KARYAWAN HONORER', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409010901180002_1576985229.jpeg'),
(167, 11, '7409090507720001', 'Rudin', 4, 'default.jpg', 1000000, 47, 'Petani kebun', 'Slta', 'Civilization_KTP_7409090507720001_1576985350.jpg'),
(168, 10, '7409012809120007', 'SALMIA', 4, 'Civilization_7409012809120007_1576985993.jpeg', 1200000, 46, 'MENGURUS RUMAH TANGGA', 'SD/SEDERAJAT', 'Civilization_KTP_7409012809120007_1576985993.jpeg'),
(169, 11, '7409095505840001', 'Hastuti', 3, 'default.jpg', 1000000, 55, 'Karyawan honorer', 'Slta', 'Civilization_KTP_7409095505840001_1576985722.jpg'),
(170, 11, '7409011003820003', 'Darwin', 2, 'default.jpg', 500000, 57, 'Petani kebun', 'Slta', 'Civilization_KTP_7409011003820003_1576985921.jpg'),
(171, 11, '7409090307480001', 'Aponga', 4, 'default.jpg', 500000, 71, 'Petani kebun', 'Slta', 'Civilization_KTP_7409090307480001_1576986074.jpg'),
(172, 10, '7409010211110001', 'IKLIM,S.Pd', 7, 'Civilization_7409010211110001_1576986547.jpeg', 2100000, 62, 'PEGAWAI NEGERI SIPIL (PNS)', 'DIPLOMA IV/STRATA 1', 'Civilization_KTP_7409010211110001_1576986547.jpeg'),
(173, 11, '7409090702820001', 'Padir', 2, 'default.jpg', 500000, 37, 'Petani kebun', 'Slta', 'Civilization_KTP_7409090702820001_1576986445.jpg'),
(174, 10, '7409012809120017', 'ABU BAKAR', 4, 'Civilization_7409012809120017_1576986889.jpeg', 1200000, 53, 'PETANI/PEKEBUN', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409012809120017_1576986889.jpeg'),
(175, 11, '7409091805790001', 'Sapri', 4, 'default.jpg', 1000000, 40, 'Petani kebun', 'Slta', 'Civilization_KTP_7409091805790001_1576986743.jpg'),
(176, 11, '7409091508880001', 'Irwan', 2, 'default.jpg', 1000000, 31, 'Karyawan honorer', 'Slta', 'Civilization_KTP_7409091508880001_1576986917.jpg'),
(177, 10, '7409012809120011', 'SADAR', 2, 'Civilization_7409012809120011_15769872691.jpeg', 1100000, 61, 'PETANI/PEKERJA', 'SD/SEDERAJAT', 'Civilization_KTP_7409012809120011_15769872691.jpeg'),
(178, 10, '7409012009120003', 'RISAL', 5, 'Civilization_7409012009120003_1576987700.jpeg', 1200000, 37, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAR', 'Civilization_KTP_7409012009120003_1576987700.jpeg'),
(179, 10, '7409011308120001', 'YOTEN', 5, 'Civilization_7409011308120001_1576988138.jpeg', 1300000, 43, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409011308120001_1576988138.jpeg'),
(180, 10, '7409010201680001', 'TASMAN', 3, 'default.jpg', 1100000, 51, 'PETANI/PEKEBUN', 'SLTA/SEDERAJAT', 'Civilization_KTP_7409010201680001_1576988523.jpeg'),
(181, 10, '740901200091120022', 'HASRIN', 6, 'Civilization_740901200091120022_1576988889.jpeg', 1200000, 38, 'PETANI/PEKEBUN', 'SLTA/SEDERAJAT', 'Civilization_KTP_740901200091120022_1576988889.jpeg'),
(182, 10, '7409012809120020', 'SAKIR', 4, 'Civilization_7409012809120020_1576989373.jpeg', 1300000, 40, 'WIRASWASTA', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409012809120020_1576989373.jpeg'),
(183, 10, '7409012609120005', 'ABD.MUIS A.', 3, 'default.jpg', 1200000, 54, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'default.jpg'),
(184, 10, '7409012609120005', 'ABD.MUIS A.', 3, 'Civilization_7409012609120005_1576989751.jpeg', 1200000, 54, 'PETANI/PEKEBUN', 'SLTP/SEDERAJAT', 'Civilization_KTP_7409012609120005_1576989751.jpeg'),
(185, 11, '7409092105770002', 'ANWAR DJAMALUDDIN', 3, 'default.jpg', 1000000, 47, 'PETANI', 'SMP', 'Civilization_KTP_7409092105770002_1576994157.jpg'),
(186, 11, '7409095002480001', 'SITI NORMA', 5, 'default.jpg', 1000000, 71, 'PETANI', 'SD', 'Civilization_KTP_7409095002480001_1576994204.jpg'),
(187, 11, '7409050207770002', 'SAIPUL S', 4, 'default.jpg', 1200000, 42, 'WIRASWASTA', 'SMA', 'Civilization_KTP_7409050207770002_1576994240.jpg'),
(188, 11, '7409090307750001', 'SAENUDIN', 3, 'default.jpg', 1000000, 44, 'PETANI', 'SMA', 'Civilization_KTP_7409090307750001_1576994291.jpg'),
(189, 11, '7409012701580001', 'RAMALA', 4, 'default.jpg', 1100000, 64, 'PETANI', 'SMA', 'Civilization_KTP_7409012701580001_1576994374.jpg'),
(190, 11, '7409090610700001', 'HARMUDIN', 5, 'default.jpg', 1000000, 49, 'PETANI', 'SMP', 'Civilization_KTP_7409090610700001_1576994427.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'uadmin', 'user admin'),
(3, 'village_officer', 'Aparatur Desa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `house`
--

CREATE TABLE `house` (
  `id` int(10) UNSIGNED NOT NULL,
  `civilization_id` int(10) UNSIGNED NOT NULL,
  `category` int(11) NOT NULL,
  `certificate_status` int(11) NOT NULL,
  `rt` varchar(20) NOT NULL,
  `dusun` varchar(100) NOT NULL,
  `images` text NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `file_scan` text NOT NULL,
  `floor_material` int(3) NOT NULL,
  `wall_material` int(3) NOT NULL,
  `roof_material` int(3) NOT NULL,
  `light_source` int(3) NOT NULL,
  `water_source` int(3) NOT NULL,
  `land_status` int(3) NOT NULL,
  `length` float DEFAULT NULL,
  `width` float DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `house`
--

INSERT INTO `house` (`id`, `civilization_id`, `category`, `certificate_status`, `rt`, `dusun`, `images`, `latitude`, `longitude`, `file_scan`, `floor_material`, `wall_material`, `roof_material`, `light_source`, `water_source`, `land_status`, `length`, `width`, `description`) VALUES
(21, 40, 0, 0, '2', '3', 'front_1576985642.jpeg;back_1576985669.jpeg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 0, 0, ''),
(22, 41, 0, 0, '2', '3', 'front_1576985727.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 0, 0, ''),
(23, 42, 0, 0, '001', '-', 'front_1576991051.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 7, 8, 'Korban Banjir'),
(24, 43, 0, 1, '001', '001', 'front_1576984398.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 8, 6, 'Hancur'),
(25, 44, 0, 0, '2', '3', 'front_1576985780.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 0, 0, ''),
(26, 45, 0, 0, '2', '3', 'front_1576985822.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 0, 0, ''),
(27, 46, 0, 1, '002', '002', 'front_1576984645.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 9, 5, 'HANCUR'),
(28, 47, 0, 0, '2', '3', 'front_1576985864.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 0, 0, 'Korban banjir'),
(29, 48, 0, 1, '001', '001', 'front_1576982533.jpg;back_1576982545.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 0, 0, 0, 1, 0, 7, 8, 'KORBAN BANJIR RUSAK SEDANG'),
(30, 49, 0, 1, '001', '001', 'front_1576979102.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 0, 0, 0, 0, 0, 8, 6, 'KORBAN BANJIR'),
(31, 50, 0, 1, '2', '3', 'front_1576982742.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 0, 0, 'HANCUR'),
(32, 51, 1, 1, '001', '001', 'front_1576983977.jpg;default.jpg;left_1576983996.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 8, 5, 'KORBAN BANJIR RUSAK SEDANG'),
(33, 52, 0, 0, '002', '002', 'front_1576984054.jpg;back_1576984065.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 8, 6, 'KORBAN BANJIR RUSAK SEDANG'),
(34, 53, 0, 1, '002', '001', 'front_1576987456.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 8, 6, 'Korban Banjir dan Hancur'),
(35, 54, 0, 0, '2', '3', 'front_1576985920.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 0, 0, 'Korban Banjir'),
(36, 55, 0, 1, '001', '001', 'front_1576983750.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 8, 6, 'HANCUR'),
(37, 56, 1, 1, '002', '002', 'front_1576984109.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 7, 6, 'KORBAN BANJIR RUSAK SEDANG'),
(38, 57, 0, 1, '006', '003', 'front_1576987569.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 8, 6, 'Hancur\r\n'),
(39, 58, 0, 0, '2', '3', 'default.jpg;default.jpg;left_1576985962.jpeg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 0, 0, 'Korban Banjir'),
(40, 59, 0, 1, '001', '001', 'front_1576984100.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 8, 5, '-'),
(41, 60, 0, 2, '002', '002', 'front_1576984163.jpg;default.jpg;default.jpg;right_1576984179.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 9, 6, 'KORBAN BANJIR RUSAK SEDANG'),
(42, 61, 0, 1, '001', '001', 'front_1576987691.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 8, 6, 'Hancur\r\n'),
(43, 62, 0, 1, '0', '0', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 2, 0, 6, 6, 'Korban Banjir dan Rumah Hancur'),
(44, 63, 0, 0, '2', '3', 'front_1576986009.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 8, 7, 'Korban Banjir'),
(45, 64, 0, 0, '001', '3', 'front_1576990835.jpeg;back_1576990844.jpeg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 5, 6, 'KORBAN BANJIR'),
(46, 65, 0, 1, '002', '003', 'front_1576983111.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 4, 8, '-'),
(47, 66, 0, 1, '002', '002', 'front_1576984247.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 0, 0, 0, 0, 0, 7, 5, 'KORBAN BANJIR RUSAK RINGAN'),
(48, 67, 0, 1, '001', '002', 'front_1576987833.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 6, 5, 'Hancur'),
(49, 68, 0, 2, '002', '002', 'front_1576984285.jpg;default.jpg;left_1576984295.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 7, 5, 'KORBAN BANJIR RUSAK SEDANG'),
(50, 69, 0, 1, '001', '001', 'front_1576983430.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 8, 4, '-'),
(51, 70, 0, 0, '2', '3', 'front_1576986044.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 8, 5, 'Korban Banjir'),
(52, 71, 0, 0, '002', '2', 'default.jpg;default.jpg;default.jpg;right_1576990568.jpeg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 5, 6, 'HANYUT'),
(53, 72, 0, 1, '001', '001', 'front_1576988066.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 0, 0, 0, 0, 0, 6, 5, 'Hancur\r\n'),
(54, 73, 0, 1, '001', '001', 'front_1576980260.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 1, 0, 8, 7, 'KORBAN BANJIR'),
(55, 74, 0, 0, '001', '002', 'front_1576984355.jpg;default.jpg;left_1576984369.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 8, 6, 'KORBAN BANJIR RUSAK BERAT'),
(57, 76, 0, 0, '001', '1', 'front_1576990311.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 7, 8, 'KORBAN BANJIR'),
(58, 77, 0, 0, '001', '003', 'front_1576980961.jpeg;back_1576980998.jpeg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 7, 5, '-'),
(59, 78, 0, 2, '002', '002', 'front_1576984410.jpg;back_1576984421.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 6, 4, 'KORBAN BANJIR RUSAK SEDANG'),
(60, 79, 0, 0, '2', '3', 'front_1576986089.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 8, 7, 'Korban banjir'),
(61, 80, 0, 0, '2', '0', 'front_1576980125.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 6, 6, 'Rumah Hancur'),
(62, 81, 0, 2, '1', '1', 'front_1576990434.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 5, 4, 'KORBAN BANJIR'),
(63, 82, 0, 0, '001', '0', 'front_1576988222.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 6, 5, 'Hancur'),
(64, 83, 0, 2, '002', '002', 'front_1576984457.jpg;default.jpg;default.jpg;right_1576984466.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 0, 0, 0, 0, 0, 8, 5, 'KORBAN BANJIR RUSAK BERAT'),
(65, 84, 0, 1, '001', '001', 'front_1576981806.jpeg;back_1576981819.jpeg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 8, 5, 'HANCUR'),
(66, 85, 0, 0, '001', '1', 'front_1576989982.jpeg;default.jpg;left_1576989997.jpeg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 7, 8, 'KORBAN BANJIR'),
(67, 86, 0, 0, '2', '3', 'front_1576986129.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 10, 8, 'Korban Banjir'),
(68, 87, 0, 0, '001', '001', 'front_1576984515.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 6, 4, 'KORBAN BANJIR RUSAK BERAT'),
(69, 88, 0, 1, '001', '001', 'front_1576982131.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 9, 4, '-'),
(70, 89, 0, 1, '2', '2', 'front_1576980493.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 0, 0, 'Rumah Hancur'),
(71, 90, 0, 1, '2', '3', 'front_1576988414.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 0, 0, 'Hancur'),
(72, 91, 0, 0, '002', '002', 'front_1576984569.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 7, 5, 'HANCUR'),
(73, 92, 0, 1, '003', '003', 'front_1576982405.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 1, 7, 5, '-'),
(74, 93, 0, 0, '001', '1', 'front_1576989727.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 6, 10, 'KORBAN BANJIR'),
(75, 94, 0, 0, '2', '3', 'front_1576986190.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 7, 5, 'Korban Banjir'),
(76, 95, 0, 1, '003', '003', 'front_1576988549.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 7, 6, 'Hancur'),
(77, 96, 0, 1, '001', '001', 'front_1576981017.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 1, 0, 8, 9, 'KORBAN BANJIR'),
(78, 97, 0, 2, '001', '001', 'front_1576984617.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 1, 5, 8, 'KORBAN BANJIR RUSAK BERAT'),
(79, 98, 0, 1, '2', '3', 'front_1576988702.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 0, 0, 'Hancur'),
(80, 99, 0, 0, '002', '2', 'default.jpg;default.jpg;left_1576989449.jpeg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 6, 8, 'KORBAN BANJIR'),
(81, 100, 1, 2, '1', '1', 'front_1576990603.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 1, 0, 0, 0, 6, 4, 'KORBAN BANJIR'),
(82, 101, 0, 1, '002', '002', 'front_1576984659.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 6, 4, 'HANCUR'),
(83, 102, 0, 1, '1', '1', 'front_1576980819.jpeg;back_1576980830.jpeg;left_1576980839.jpeg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 1, 1, 6, 8, 'Rumah Hancur'),
(84, 103, 0, 1, '2', '3', 'front_1576988807.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 6, 5, 'Hancur'),
(85, 104, 0, 1, '001', '001', 'front_1576988957.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 7, 6, 'Hancur'),
(86, 105, 0, 0, '001', '1', 'front_1576989139.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 5, 7, 'KORBAN BANJIR'),
(87, 106, 0, 1, '1', '3', 'front_1576981061.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 1, 8, 7, 'Rumah Hancur'),
(88, 107, 0, 0, '2', '3', 'front_1576986354.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 11, 8, 'Korban Banjir'),
(89, 108, 0, 2, '1', '1', 'front_1576990750.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 1, 0, 0, 0, 7, 5, 'KORBAN BANJIR, DENGAN RUMAH HANCUR'),
(90, 109, 0, 0, '001', '1', 'default.jpg;default.jpg;left_1576988840.jpeg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 5, 8, 'KORBAN BANJIR'),
(91, 110, 0, 1, '001', '001', 'front_1576989085.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 0, 0, 0, 0, 0, 6, 5, 'Hancur'),
(92, 111, 0, 0, '2', '3', 'front_1576986314.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 6, 6, 'Korban Banjir'),
(93, 112, 0, 1, '1', '1', 'front_1576981287.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 1, 0, 7, 6, 'Rumah Hancur'),
(94, 113, 0, 1, '001', '001', 'front_1576981560.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 1, 0, 9, 7, 'KORBAN BANJIR'),
(95, 114, 0, 1, '001', '0', 'front_1576989239.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 6, 5, 'Korban banjir'),
(96, 115, 0, 0, '002', '1', 'default.jpg;default.jpg;left_1576988510.jpeg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 5, 6, 'KORBAN BANJIR'),
(97, 116, 0, 1, '5', '5', 'front_1576981522.jpeg;default.jpg;default.jpg;right_1576981533.jpeg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 0, 0, 0, 1, 0, 9, 7, 'Rumah Hancur'),
(98, 117, 0, 1, '001', '001', 'front_1576989374.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 7, 6, 'Korban Banjir'),
(99, 118, 0, 0, '2', '3', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 7, 5, 'KOrban Banjir'),
(100, 119, 0, 1, '002', '001', 'front_1576989479.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 0, 0, 0, 0, 0, 6, 5, 'Korban banjir'),
(101, 120, 0, 0, '001', '1', 'default.jpg;default.jpg;left_1576988211.jpeg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 5, 6, 'KORBAN BANJIR'),
(102, 121, 0, 2, '1', '1', 'front_1576990849.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 8, 4, 'KORBAN BANJIR'),
(103, 122, 0, 0, '1', '5', 'front_1576981748.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 8, 5, 'Rumah Hancur'),
(104, 123, 0, 1, '001', '0', 'front_1576989594.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 6, 5, 'Hancur'),
(105, 124, 0, 0, '001', '1', 'front_1576987863.jpeg;default.jpg;default.jpg;right_1576987877.jpeg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 6, 7, 'KORBAN BANJIR'),
(106, 125, 0, 1, '001', '001', 'front_1576989702.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 6, 5, 'Korban Banjir'),
(107, 126, 0, 0, '2', '3', 'front_1576986422.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 10, 8, 'Korban Banjir'),
(108, 127, 0, 1, '2', '1', 'front_1576981964.jpeg;default.jpg;left_1576981977.jpeg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 1, 0, 7, 8, 'Rumah Hancur'),
(109, 128, 0, 1, '001', '001', 'front_1576982149.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 1, 0, 7, 8, 'KORBAN BANJIR'),
(110, 129, 0, 0, '002', '2', 'default.jpg;default.jpg;left_1576987506.jpeg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 6, 12, 'KORBAN BANJIR'),
(111, 130, 0, 1, '003', '003', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 6, 5, 'Hancur'),
(112, 131, 1, 2, '1', '1', 'front_1576990965.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 0, 0, 0, 0, 0, 6, 6, 'KORBAN BANJIR'),
(113, 132, 0, 0, '001', '2', 'front_1576987127.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 5, 6, 'KORBAN BANJIR'),
(114, 133, 0, 0, '6', '1', 'front_1576982163.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 9, 6, 'Rumah Hancur'),
(115, 134, 0, 1, '003', '003', 'front_1576990047.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 6, 5, 'Korban Banjir'),
(116, 135, 0, 0, '001', '4', 'front_1576986789.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 5, 6, 'KORBAN BANJIR'),
(117, 136, 0, 1, '005', '003', 'front_1576990278.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 6, 5, 'Korban Banjir'),
(118, 137, 0, 0, '2', '3', 'default.jpg;default.jpg;left_1576986465.jpeg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 12, 6, 'Korban banjir'),
(119, 138, 0, 0, '3', '3', 'front_1576982377.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 0, 0, 0, 0, 1, 9, 8, 'Rumah Hancur'),
(120, 139, 0, 0, '001', '1', 'front_1576986469.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 1, 0, 0, 0, 6, 7, 'KORBAN BANJIR'),
(121, 140, 0, 1, '002', '0', 'front_1576990399.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 5, 4, 'Korban banjir'),
(122, 141, 1, 1, '001', '003', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 8, 6, 'Korban Banjir'),
(123, 142, 0, 1, '001', '001', 'front_1576982732.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 1, 0, 7, 8, 'KORBAN BANJIR'),
(124, 143, 0, 0, '001', '2', 'default.jpg;default.jpg;default.jpg;right_1576985930.jpeg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 1, 0, 0, 0, 6, 5, 'KORBAN BANJIR'),
(125, 144, 0, 0, '1', '1', 'front_1576982560.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 0, 0, 0, 0, 1, 5, 5, 'Rumah Hancur'),
(126, 145, 0, 0, '2', '3', 'front_1576986514.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 8, 5, 'Korban Banjir'),
(127, 146, 0, 2, '1', '1', 'front_1576991014.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 8, 4, 'KORBAN BANJIR'),
(128, 147, 0, 0, '001', '1', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 5, 6, 'KORBAN BANJIR'),
(129, 148, 0, 1, '001', '003', 'front_1576990525.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 5, 4, 'Korban Banjir'),
(130, 149, 0, 0, '2', '0', 'front_1576982741.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 2, 1, 5, 5, 'Rumah Hancur'),
(131, 150, 0, 0, '2', '3', 'front_1576986589.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 9, 6, 'Korban Banjir'),
(132, 151, 0, 1, '002', '0', 'front_1576990181.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 5, 4, 'Korban Banjir'),
(133, 152, 0, 0, '2', '3', 'front_1576982926.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 0, 0, 0, 0, 0, 8, 5, 'Rumah Hancur'),
(134, 153, 0, 1, '002', '0', 'front_1576986529.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 7, 6, 'Hancur'),
(135, 154, 0, 0, '2', '3', 'front_1576986644.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 6, 8, 'Korban Banjir'),
(136, 155, 0, 1, '002', '0', 'front_1576986334.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 5, 4, 'Hancur'),
(137, 156, 0, 1, '001', '001', 'front_1576983218.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 1, 0, 7, 8, 'KORBAN BANJIR'),
(138, 157, 0, 0, '6', '3', 'front_15769831111.jpeg;default.jpg;left_1576983122.jpeg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 7, 9, 'Rumah Hancur'),
(139, 158, 0, 0, '2', '3', 'front_1576986679.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 0, 0, 'Korban Banjir'),
(140, 159, 0, 1, '002', '002', 'front_1576985869.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 7, 6, 'Korban Banjir'),
(141, 160, 0, 2, '1', '1', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 7, 5, 'KORBAN BANJIR'),
(142, 161, 0, 0, '3', '1', 'front_1576983310.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 0, 0, 'Rumah Hancur'),
(143, 162, 0, 0, '2', '3', 'front_1576986730.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 7, 8, 'Korban Banjir'),
(144, 163, 0, 0, '2', '3', 'default.jpg;default.jpg;left_1576986774.jpeg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 8, 4, 'kORBAN BANJIR'),
(145, 164, 0, 0, '2', '3', 'front_1576986869.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 7, 8, 'Korban Banjir'),
(146, 165, 0, 1, '001', '001', 'front_1576984655.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 1, 0, 8, 9, 'KORBAN BANJIR'),
(147, 166, 0, 1, '001', '001', 'front_1576985207.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 0, 0, 0, 1, 0, 8, 7, 'KORBAN BANJIR'),
(148, 167, 0, 1, '2', '2', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 1, 0, 1, 0, 4, 5, 'Korban banjir'),
(149, 168, 0, 1, '001', '00', 'front_1576986011.jpeg;back_1576986048.jpeg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 7, 9, 'KORBAN BANJIR'),
(150, 169, 0, 0, '2', '2', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 5, 5, 'Korban banjir'),
(151, 170, 0, 1, '1', '1', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 1, 0, 6, 5, 'Kornan banjir'),
(152, 171, 1, 1, '', '', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 1, 0, 7, 5, 'Korban banjir'),
(153, 172, 0, 1, '001', '001', 'front_1576986530.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 1, 0, 9, 10, 'KORBAN BANJIR'),
(154, 173, 1, 1, '1', '1', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 0, 0, 0, 0, 0, 3, 4, 'Korban banjir'),
(155, 174, 0, 1, '001', '001', 'front_1576986906.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 7, 8, 'KORBAN BAJIR'),
(156, 175, 1, 1, '1', '1', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 1, 0, 0, 0, 0, 5, 5, 'Korban banjir'),
(157, 176, 0, 1, '1', '1', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 4, 3, 'Korban banjir'),
(158, 177, 0, 1, '001', '001', 'front_1576987250.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 7, 8, 'KORBAN BANJIR'),
(159, 178, 0, 1, '001', '001', 'front_1576987711.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 8, 8, 'KORBAN BANJIR'),
(160, 179, 0, 1, '001', '001', 'front_1576988156.jpeg;back_15769881661.jpeg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 7, 8, 'KORBAN BANJIR'),
(161, 180, 0, 1, '002', '002', 'front_1576988509.jpeg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 6, 7, 'KOBAN BANJIR'),
(162, 181, 0, 1, '001', '001', 'front_1576988904.jpeg;back_1576988916.jpeg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 2, 0, 8, 7, 'KORBAN BANJIR'),
(163, 182, 0, 1, '001', '001', 'front_1576989385.jpeg;back_1576989398.jpeg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 1, 0, 8, 9, 'KORBAN BANJIR'),
(164, 183, 0, 1, '001', '001', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 7, 9, 'KORBAN BANJIR\r\n'),
(165, 184, 0, 1, '001', '001', 'default.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 7, 9, 'KORBAN BANJIR\r\n'),
(166, 185, 0, 2, '1', '1', 'front_1576994174.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 4, 2, 'KORBAN BANJIR'),
(167, 186, 0, 2, '1', '1', 'front_1576994214.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 0, 0, 0, 0, 0, 7, 7, 'KORBAN BANJIR'),
(168, 187, 1, 2, '1', '1', 'front_1576994250.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 0, 0, 0, 0, 0, 0, 8, 6, 'KORBAN BANJIR'),
(169, 188, 1, 2, '1', '1', 'front_1576994343.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 6, 5, 'KORBAN BANJIR'),
(170, 189, 0, 2, '1', '1', 'front_1576994385.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 2, 1, 0, 0, 0, 0, 5, 4, 'KORBAN BANJIR'),
(171, 190, 1, 2, '1', '1', 'front_1576994443.jpg;default.jpg;default.jpg;default.jpg', '-3.5014330835094682', '122.10348308181318', 'default.jpg', 1, 1, 0, 0, 0, 0, 5, 3, 'KORBAN BANJIR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(1, '114.125.170.148', 'Dinas gmail@xom', 1576943319),
(2, '222.124.222.58', 'desa_puuwanggudu@gmail.com', 1576977616),
(3, '222.124.222.58', 'desa_wangguduraya@gmail.com', 1576978746),
(4, '222.124.222.58', 'Desa_Wanggudu_Jaya@gmail.com', 1576979497),
(5, '222.124.222.58', 'Desa_Lambungga@gmail.com', 1576984575);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(50) NOT NULL,
  `list_id` varchar(200) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `position` int(4) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `menu_id`, `name`, `link`, `list_id`, `icon`, `status`, `position`, `description`) VALUES
(101, 1, 'Beranda', 'admin/', 'home_index', 'home', 1, 1, '-'),
(102, 1, 'Group', 'admin/group', 'group_index', 'home', 1, 2, '-'),
(103, 1, 'Setting', 'admin/menus', '-', 'cogs', 1, 3, '-'),
(104, 1, 'User', 'admin/user_management', 'user_management_index', 'users', 1, 4, '-'),
(106, 103, 'Menu', 'admin/menus', 'menus_index', 'circle', 1, 1, '-'),
(107, 2, 'Beranda', 'uadmin/home', 'home_index', 'home', 1, 1, '-'),
(108, 2, 'Pengguna', 'uadmin/users', 'users_index', 'home', 1, 2, '-'),
(109, 2, 'Desa', 'uadmin/village', 'village_index', 'home', 1, 1, '-'),
(110, 2, 'Olah Kartu Keluarga', 'uadmin/civilization', 'civilization_index', 'home', 0, 1, '-'),
(111, 2, 'Olah Perumahan', 'uadmin/housing', 'housing_index', 'home', 0, 1, '-'),
(112, 2, 'Penerima Bantuan', 'uadmin/aid', '_aid_index', 'home', 1, 1, '-'),
(113, 3, 'Beranda', 'officer/home', 'home_index', 'home', 1, 1, '-'),
(114, 3, 'Tentang Desa', 'officer/village', 'village_index', 'home', 1, 1, '-'),
(115, 3, 'Olah Data', 'officer/civilization', 'civilization_index', 'home', 1, 1, '-'),
(116, 3, 'Olah Perumahan', 'officer/housing', 'housing_index', 'home', 0, 1, '-'),
(117, 112, 'Cari Calon Penerima Bantuan', 'uadmin/candidate', 'candidate_index', 'home', 1, 1, '-'),
(119, 112, 'Data Bantuan', 'uadmin/aid', 'aid_index', 'home', 1, 3, '-'),
(120, 112, 'Kandidat Penerima Bantuan', 'uadmin/candidate/candidates', 'candidate_candidates', 'home', 1, 2, '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` text NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `image`, `address`) VALUES
(1, '127.0.0.1', 'admin@fixl.com', '$2y$12$XpBgMvQ5JzfvN3PTgf/tA.XwxbCOs3mO0a10oP9/11qi1NUpv46.u', 'admin@fixl.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1575824004, 1, 'Admin', 'istrator', '081342989185', 'USER_1_1569750691.PNG', 'admin'),
(13, '::1', 'dinas@gmail.com', '$2y$10$xbDFfxFWEv2vFuxytqXIOuBX3bIFzRXZRbvrc9DCiaNJsl34gTvOi', 'dinas@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1568678256, 1577003901, 1, 'admin', 'Dinas', '00', 'USER_13_1576949614.png', 'jln mutiara no 8'),
(24, '222.124.222.58', 'Desa_Puuwanggudu@gmail.com', '$2y$10$nGx65tOUaSQFZZISz/leX.4827AkpC9jCV8bWPIAvfKswcZag97ya', 'Desa_Puuwanggudu@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1576976337, 1576977431, 1, 'admin', 'Desa Puuwanggudu', '0', 'default.jpg', 'Alamat'),
(25, '222.124.222.58', 'Desa_Ala_Wanggudu@gmail.com', '$2y$10$Ib5tIteosb2S0ztTEUFX2.jNMX1zP9rz7UMBEldnbHsFddc2tGnAG', 'Desa_Ala_Wanggudu@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1576977289, 1576977684, 1, 'admin', 'Desa Ala Wanggudu', '0', 'default.jpg', 'Alamat'),
(26, '222.124.222.58', 'Desa_Walalindu@gmail.com', '$2y$10$BIGuyfSiiwFtylZ.TvSCVuI0QJ32syHiTe9nnD66QhIXkNzCmS8a2', 'Desa_Walalindu@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1576977327, 1576978417, 1, 'admin', 'Desa Walalindu', '0', 'default.jpg', 'Alamat'),
(27, '222.124.222.58', 'Desa_Labungga@gmail.com', '$2y$10$zwEICJUplFcmPKz5BqDNe.VbDcOEajVj6.eVT1zmisWDhABFBCGMq', 'Desa_Labungga@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1576977350, 1576987060, 1, 'admin', 'Desa Labungga', '0', 'default.jpg', 'Alamat'),
(28, '222.124.222.58', 'Desa_Wanggudu_Raya@gmail.com', '$2y$10$3bYcQH6jvo/kX8nZp9cyHugQ2ai6EAe57H.o.kwWA91djGO1qxc/e', 'Desa_Wanggudu_Raya@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1576977374, 1576985613, 1, 'admin', 'Desa Wanggudu Raya', '0', 'default.jpg', 'Alamat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(29, 13, 2),
(38, 24, 3),
(39, 25, 3),
(40, 26, 3),
(41, 27, 3),
(42, 28, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `village`
--

CREATE TABLE `village` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `polygon` text NOT NULL,
  `kk_count` int(4) NOT NULL,
  `house_count` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `village`
--

INSERT INTO `village` (`id`, `user_id`, `name`, `description`, `polygon`, `kk_count`, `house_count`) VALUES
(8, 24, 'Desa Puuwanggudu', '-', '', 0, 0),
(9, 25, 'Desa Ala Wanggudu', '-', '', 0, 0),
(10, 26, 'Desa Walalindu', '-', '', 0, 0),
(11, 27, 'Desa Labungga', '-', '', 0, 0),
(12, 28, 'Desa Wanggudu Raya', '-', '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aid`
--
ALTER TABLE `aid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `civilization_id` (`civilization_id`);

--
-- Indeks untuk tabel `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `civilization_id` (`civilization_id`);

--
-- Indeks untuk tabel `civilization`
--
ALTER TABLE `civilization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `village_id` (`village_id`);

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`id`),
  ADD KEY `civilization_id` (`civilization_id`);

--
-- Indeks untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indeks untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indeks untuk tabel `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aid`
--
ALTER TABLE `aid`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `civilization`
--
ALTER TABLE `civilization`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `house`
--
ALTER TABLE `house`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `village`
--
ALTER TABLE `village`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `aid`
--
ALTER TABLE `aid`
  ADD CONSTRAINT `aid_ibfk_1` FOREIGN KEY (`civilization_id`) REFERENCES `civilization` (`id`);

--
-- Ketidakleluasaan untuk tabel `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`civilization_id`) REFERENCES `civilization` (`id`);

--
-- Ketidakleluasaan untuk tabel `civilization`
--
ALTER TABLE `civilization`
  ADD CONSTRAINT `civilization_ibfk_1` FOREIGN KEY (`village_id`) REFERENCES `village` (`id`);

--
-- Ketidakleluasaan untuk tabel `house`
--
ALTER TABLE `house`
  ADD CONSTRAINT `house_ibfk_1` FOREIGN KEY (`civilization_id`) REFERENCES `civilization` (`id`);

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `village`
--
ALTER TABLE `village`
  ADD CONSTRAINT `village_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
