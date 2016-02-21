-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2015 at 06:38 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_anggaran`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_penerimaan`
--

CREATE TABLE IF NOT EXISTS `tb_master_penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_parent` int(11) DEFAULT NULL,
  `kode` varchar(10) NOT NULL,
  `nama_program` text NOT NULL,
  `nominal` double NOT NULL,
  `id_tahun_anggaran` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tahun_anggaran` (`id_tahun_anggaran`),
  KEY `id_parent` (`id_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tb_master_penerimaan`
--

INSERT INTO `tb_master_penerimaan` (`id`, `tanggal`, `id_parent`, `kode`, `nama_program`, `nominal`, `id_tahun_anggaran`) VALUES
(1, '2015-12-16 08:02:08', NULL, '1', 'Saldo Tahun Lalu', 0, 1),
(2, '2015-12-01 08:02:08', 1, '1.1', 'Sisa Saldo', 2500000, 1),
(3, '2015-12-16 08:02:08', NULL, '2', 'BOS', 0, 1),
(4, '2015-12-16 08:02:08', 3, '2.1', 'BOS Pusat dan BSM', 531200000, 1),
(5, '2015-12-16 08:02:08', NULL, '3', 'Pendapatan Rutin', 0, 1),
(6, '2015-12-16 08:02:08', 5, '3.1', 'Gaji PNS', 120000000, 1),
(7, '2015-12-16 08:02:08', 5, '3.2', 'Gaji Pegawai Tidak Tetap', 50000000, 1),
(8, '2015-12-16 08:02:08', 5, '3.3', 'Belanja Barang dan Jasa', 25000000, 1),
(9, '2015-12-16 08:02:08', 3, '2.2', 'BOS Provinsi', 140000000, 1),
(10, '2015-12-16 08:02:08', 3, '2.3', 'BOS Kabupaten / Kota', 20000000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rka`
--

CREATE TABLE IF NOT EXISTS `tb_rka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) DEFAULT NULL,
  `kode` varchar(15) NOT NULL,
  `nama_program` varchar(255) NOT NULL,
  `nominal` double DEFAULT NULL,
  `semester1` tinyint(1) DEFAULT NULL,
  `semester2` tinyint(1) DEFAULT NULL,
  `id_tahun_anggaran` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_parent` (`id_parent`),
  KEY `id_tahun_anggaran` (`id_tahun_anggaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tb_rka`
--

INSERT INTO `tb_rka` (`id`, `id_parent`, `kode`, `nama_program`, `nominal`, `semester1`, `semester2`, `id_tahun_anggaran`) VALUES
(12, NULL, '1', 'PROGRAM MADRASAH', 0, NULL, NULL, 1),
(13, 12, '1.1', 'PENGEMBANGAN STANDAR KOMPETENSI LULUSAN', 0, NULL, NULL, 1),
(14, 13, '1.1.1', 'Kompetensi Lulusan', 0, NULL, NULL, 1),
(15, 14, '1.1.1.1', 'Penyusunan KKM', 0, 1, 0, 1),
(16, 15, '5.2.1.2.1.1', 'ATK Kegiatan penyusunan Kriteria Ketuntasan Minimal (KKM)', 500000, NULL, NULL, 1),
(17, 15, '5.2.1.2.1.9', 'Biaya minimum snack sosialisasi KKM setiap mapel mencapai SNP kepada orang tua peserta didik (Panitia 5 orang + 210 Orang)', 645000, NULL, NULL, 1),
(18, 14, '1.1.1.2', 'Penyusunan Kriteria Kenaikan Kelas', 0, NULL, NULL, 1),
(19, 18, '5.2.2.1.1', 'ATK Kegiatan penyusunan Kriteria Kenaikan Kelas', 100000, NULL, NULL, 1),
(20, 18, '5.2.2.11.2', 'Biaya Minimum snack', 1290000, NULL, NULL, 1),
(21, 14, '1.1.1.3', 'Penajaman Materi UN', 0, NULL, NULL, 1),
(22, 21, '5.2.1.2.1.3', 'Honorarium Tim Pelaksana kegiatan penajaman materi UN (Ketua, 1 orang x 4 bulan)', 600000, NULL, NULL, 1),
(23, 21, '5.2.1.2.1.3', 'Honorarium Tim Pelaksana kegiatan penajaman materi UN (Sekretaris, 1 orang x 4 bulan)', 500000, NULL, NULL, 1),
(24, 21, '5.2.1.2.1.3', 'Honorarium Tim Pelaksana kegiatan penajaman materi UN (Anggota, 7 orang x 4 bulan)', 2800000, NULL, NULL, 1),
(25, 12, '1.2', 'PENGEMBANGAN STANDAR ISI', 0, NULL, NULL, 1),
(26, 25, '1.2.1', 'Dokumen Kurikulum', 0, NULL, NULL, 1),
(27, 26, '1.2.1.1', 'Pengembangan Buku KTSP', 0, NULL, NULL, 1),
(28, 27, '5.2.1.2.1.3', 'Honorarium tim pelaksana kegiatan pengembangan Kurikulum, silabus dan KKM (Ketua)', 400000, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sekolah`
--

CREATE TABLE IF NOT EXISTS `tb_sekolah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` text NOT NULL,
  `alamat` text NOT NULL,
  `provinsi` text NOT NULL,
  `kabupaten` text NOT NULL,
  `kecamatan` text NOT NULL,
  `kelurahan` text NOT NULL,
  `kepala` text NOT NULL,
  `nip_kepala` text NOT NULL,
  `ketua_komite` text NOT NULL,
  `bendahara` text NOT NULL,
  `nip_bendahara` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_sekolah`
--

INSERT INTO `tb_sekolah` (`id`, `nama`, `alamat`, `provinsi`, `kabupaten`, `kecamatan`, `kelurahan`, `kepala`, `nip_kepala`, `ketua_komite`, `bendahara`, `nip_bendahara`) VALUES
(1, 'Madrasah Aliyah Negeri', 'Jl. Samudra LR. Pelangi', 'Aceh', 'Lokseumawe', 'Banda Sakti', 'KP. Jawa Lama', 'Ahmad Asrofi M.Ag', '1379091928100122', 'Sofyan Hamid M.Ag', 'Sulistyowati S.Pd', '1379091928100666');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tahun_anggaran`
--

CREATE TABLE IF NOT EXISTS `tb_tahun_anggaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_anggaran` varchar(9) NOT NULL,
  `semester` tinyint(4) NOT NULL,
  `aktifasi` enum('Tidak','Ya') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_tahun_anggaran`
--

INSERT INTO `tb_tahun_anggaran` (`id`, `tahun_anggaran`, `semester`, `aktifasi`) VALUES
(1, '2015', 1, 'Ya'),
(2, '2015', 2, 'Tidak');

-- --------------------------------------------------------

--
-- Table structure for table `tb_trans_bank`
--

CREATE TABLE IF NOT EXISTS `tb_trans_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `waktu_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kode` varchar(10) NOT NULL,
  `nobukti` varchar(10) NOT NULL,
  `keterangan` text NOT NULL,
  `nominal` double NOT NULL,
  `jenis` enum('Penerimaan','Penarikan') NOT NULL,
  `id_tahun_anggaran` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode` (`kode`),
  KEY `id_tahun_anggaran` (`id_tahun_anggaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tb_trans_bank`
--

INSERT INTO `tb_trans_bank` (`id`, `tanggal`, `waktu_input`, `kode`, `nobukti`, `keterangan`, `nominal`, `jenis`, `id_tahun_anggaran`) VALUES
(1, '2015-12-06', '2015-12-06 09:27:44', '109100', 'YJM9019201', 'Penerimaan Hibah', 25000000, 'Penerimaan', 1),
(3, '2015-12-06', '2015-12-06 09:47:37', '667190', 'YJM9092819', 'Penerimaan Hibah', 15000000, 'Penerimaan', 1),
(4, '2015-12-15', '2015-12-15 09:11:30', 'FJOG-02910', 'YJM0928391', 'Bantuan Luar Negeri', 25000000, 'Penerimaan', 1),
(5, '2015-12-15', '2015-12-15 09:57:58', 'SCOR012930', '66619238CC', 'Pembayaran Untuk ', 1750000, 'Penarikan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_trans_pajak`
--

CREATE TABLE IF NOT EXISTS `tb_trans_pajak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `waktu_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kode_akun_pajak` varchar(8) NOT NULL,
  `uraian` text NOT NULL,
  `no_bukti` varchar(8) NOT NULL,
  `jenis_transaksi` enum('Penerimaan','Setoran') NOT NULL,
  `jenis_pajak` enum('PPN','PPh21','PPh22','PPh23') NOT NULL,
  `nominal` double NOT NULL,
  `hasil_pajak` double NOT NULL,
  `id_tahun_anggaran` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tahun_anggaran` (`id_tahun_anggaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_trans_pajak`
--

INSERT INTO `tb_trans_pajak` (`id`, `tanggal`, `waktu_input`, `kode_akun_pajak`, `uraian`, `no_bukti`, `jenis_transaksi`, `jenis_pajak`, `nominal`, `hasil_pajak`, `id_tahun_anggaran`) VALUES
(1, '2015-12-06', '2015-12-06 10:42:26', '1029010', 'Yngwie Johan Malmsteen', 'YJMX9281', 'Penerimaan', 'PPN', 2500000, 250000, 1),
(3, '2015-12-06', '2015-12-06 10:52:03', '1029010', 'Axel Fabianski', 'YJM90926', 'Penerimaan', 'PPh22', 2500000, 33750, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_trans_pencairan`
--

CREATE TABLE IF NOT EXISTS `tb_trans_pencairan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `waktu_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_rka` int(11) NOT NULL,
  `no_bukti` varchar(10) NOT NULL,
  `uraian` text NOT NULL,
  `satuan` text NOT NULL,
  `volume` double NOT NULL,
  `nominal` double NOT NULL,
  `penerima` varchar(200) NOT NULL,
  `id_tahun_anggaran` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rka` (`id_rka`),
  KEY `id_tahun_anggaran` (`id_tahun_anggaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_trans_pencairan`
--

INSERT INTO `tb_trans_pencairan` (`id`, `tanggal`, `tanggal_kegiatan`, `waktu_input`, `id_rka`, `no_bukti`, `uraian`, `satuan`, `volume`, `nominal`, `penerima`, `id_tahun_anggaran`) VALUES
(1, '2015-12-06', '2015-12-16', '2015-12-06 11:38:13', 16, 'YJM9092844', 'Pembelian / Pengadaan buku teks pelajaran', 'PCS', 100, 3000000, 'AXEL FABIANSKI', 1),
(2, '2015-12-16', '2015-12-16', '2015-12-16 00:55:01', 16, 'XX1231223', 'Pembelian alat tulis sekolah yang digunakan untuk kegiatan pembelajaran', 'PCS', 75, 450000, 'Sarwono Hadi', 1),
(3, '2015-12-16', '2015-12-16', '2015-12-16 06:38:50', 19, 'XXHASJD181', 'Pengadaan soal dan lembar jawaban siswa dalam kegiatan ujian', 'Lembar', 200, 2000000, 'Sukron Mastah', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE IF NOT EXISTS `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_user_group` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `username_2` (`username`),
  KEY `id_user_group` (`id_user_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `nama`, `username`, `password`, `id_user_group`) VALUES
(1, 'Axel Fabianski', 'axel', '202cb962ac59075b964b07152d234b70', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_master_penerimaan`
--
ALTER TABLE `tb_master_penerimaan`
  ADD CONSTRAINT `tb_master_penerimaan_ibfk_1` FOREIGN KEY (`id_parent`) REFERENCES `tb_master_penerimaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_master_penerimaan_ibfk_2` FOREIGN KEY (`id_tahun_anggaran`) REFERENCES `tb_tahun_anggaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_rka`
--
ALTER TABLE `tb_rka`
  ADD CONSTRAINT `tb_rka_ibfk_1` FOREIGN KEY (`id_parent`) REFERENCES `tb_rka` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_trans_bank`
--
ALTER TABLE `tb_trans_bank`
  ADD CONSTRAINT `tb_trans_bank_ibfk_2` FOREIGN KEY (`id_tahun_anggaran`) REFERENCES `tb_tahun_anggaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_trans_pajak`
--
ALTER TABLE `tb_trans_pajak`
  ADD CONSTRAINT `tb_trans_pajak_ibfk_1` FOREIGN KEY (`id_tahun_anggaran`) REFERENCES `tb_tahun_anggaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_trans_pencairan`
--
ALTER TABLE `tb_trans_pencairan`
  ADD CONSTRAINT `tb_trans_pencairan_ibfk_1` FOREIGN KEY (`id_rka`) REFERENCES `tb_rka` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_trans_pencairan_ibfk_2` FOREIGN KEY (`id_tahun_anggaran`) REFERENCES `tb_tahun_anggaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
