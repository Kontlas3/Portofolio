-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 03:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dukcapil`
--

-- --------------------------------------------------------

--
-- Table structure for table `akta`
--

CREATE TABLE `akta` (
  `id_akta` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `no_akta` varchar(50) NOT NULL,
  `nama_anak` varchar(50) NOT NULL,
  `tanggal_akta` date NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `jk` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akta`
--

INSERT INTO `akta` (`id_akta`, `nik`, `no_akta`, `nama_anak`, `tanggal_akta`, `nama_ayah`, `nama_ibu`, `jk`, `alamat`, `status`) VALUES
(23, '1010101', '1010101', 'Rajiv', '2022-06-12', 'Jumirin Suwardi', 'Syamsia', 'Laki-Laki', 'Jln. Jenderal Ahmad Yani , Kecamatan Seberang Ulu ', 'Selesai'),
(24, '8192883', '8192883', 'Rezki', '2022-07-27', 'Paijo', 'Nirmala', 'Laki-Laki', 'Jln. Jenderal Ahmad Yani , Kecamatan', 'Proses'),
(25, '34838493', '34838493', 'Peler', '2022-07-04', 'Peler', 'Peler', 'Laki-Laki', '4983949774666', 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `kematian`
--

CREATE TABLE `kematian` (
  `id_kematian` int(11) NOT NULL,
  `surat_kematian` varchar(50) NOT NULL,
  `nama_jenazah` varchar(50) NOT NULL,
  `surat_pernyataan` varchar(50) NOT NULL,
  `tanggal_kematian` date NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kematian`
--

INSERT INTO `kematian` (`id_kematian`, `surat_kematian`, `nama_jenazah`, `surat_pernyataan`, `tanggal_kematian`, `alamat`) VALUES
(1, '26554/SK-3477', 'Eril', 'Meninggal Karena Sakit', '2022-07-09', 'Jln. Jenderal Ahmad Yani'),
(2, '26554/SK-3478', 'Kurama', 'Sakit', '2022-07-07', 'Jln Bagus');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `jenis_pengeluaran` varchar(50) NOT NULL,
  `jumlah_pengeluaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `tanggal_pengeluaran`, `jenis_pengeluaran`, `jumlah_pengeluaran`) VALUES
(1, '2022-07-13', 'Biaya Perawatan Server', 3000000),
(2, '2022-07-13', 'Biaya Perawatan Bangunan', 2000000),
(3, '2022-07-13', 'Biaya Paket Anggota', 500000),
(4, '2022-07-13', 'Biaya Cathering', 1800000);

-- --------------------------------------------------------

--
-- Table structure for table `pernikahan`
--

CREATE TABLE `pernikahan` (
  `id_pernikahan` int(11) NOT NULL,
  `no_pernikahan` varchar(50) NOT NULL,
  `nama_pria` varchar(50) NOT NULL,
  `nama_wanita` varchar(50) NOT NULL,
  `tanggal_pernikahan` date NOT NULL,
  `tempat_pernikahan` varchar(50) NOT NULL,
  `nama_walip` varchar(50) NOT NULL,
  `nama_waliw` varchar(50) NOT NULL,
  `penghulu` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pernikahan`
--

INSERT INTO `pernikahan` (`id_pernikahan`, `no_pernikahan`, `nama_pria`, `nama_wanita`, `tanggal_pernikahan`, `tempat_pernikahan`, `nama_walip`, `nama_waliw`, `penghulu`, `keterangan`) VALUES
(3, '2387278', 'Naruto', 'Sakura', '2022-07-31', 'Aula', 'Jumirin Suwardi', 'Alias', 'Komang', 'Sangat Mantap'),
(5, '43423432423', '43423432423', '43423432423', '2022-07-04', '43423432423', '43423432423', '43423432423', '43423432423', '43423432423');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `email`, `password`, `level`) VALUES
(8, 'Rajiv Ganteng', 'admin', 'rajivgantenglur@gmail.com', '$2y$10$Y6bWH98PGKCWQgLMzs7rA.YNL7abnHhfzXsDAv9gET2HLmP/RWlP6', '1'),
(9, 'Nining Faradilla', 'operator', 'operator@gmail.com', '$2y$10$.FRUskQ7E.A0y1x8aMaKQuZr0HUNF4TZOTDoetmTs34/u3sDj7Vey', '2'),
(10, 'Arman', 'pengguna', 'pengguna@gmail.com', '$2y$10$kcCCq0t/jah.9425oqrJieEGlXHgynVJ972s0yGFfn38twqYddJpO', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akta`
--
ALTER TABLE `akta`
  ADD PRIMARY KEY (`id_akta`);

--
-- Indexes for table `kematian`
--
ALTER TABLE `kematian`
  ADD PRIMARY KEY (`id_kematian`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `pernikahan`
--
ALTER TABLE `pernikahan`
  ADD PRIMARY KEY (`id_pernikahan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akta`
--
ALTER TABLE `akta`
  MODIFY `id_akta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `kematian`
--
ALTER TABLE `kematian`
  MODIFY `id_kematian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pernikahan`
--
ALTER TABLE `pernikahan`
  MODIFY `id_pernikahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
