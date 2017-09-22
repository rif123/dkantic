-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Sep 22, 2017 at 04:23 PM
-- Server version: 8.0.2-dmr
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dkantic`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id_config` int(11) NOT NULL,
  `logo_config` varchar(200) NOT NULL,
  `telp_config` varchar(14) NOT NULL,
  `logofile_config` varchar(100) NOT NULL,
  `fb_config` varchar(50) NOT NULL,
  `logo_fb_config` varchar(100) NOT NULL,
  `twit_config` varchar(50) NOT NULL,
  `logo_twit_config` varchar(100) NOT NULL,
  `gp_config` varchar(50) NOT NULL,
  `logo_gp_config` varchar(100) NOT NULL,
  `li_config` varchar(50) NOT NULL,
  `logo_li_config` varchar(100) NOT NULL,
  `skype_config` varchar(50) NOT NULL,
  `logo_skype_config` varchar(100) NOT NULL,
  `footer_tittle_config` varchar(100) NOT NULL,
  `cc_config` varchar(100) NOT NULL,
  `favicon_config` varchar(100) NOT NULL,
  `copy_right` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id_config`, `logo_config`, `telp_config`, `logofile_config`, `fb_config`, `logo_fb_config`, `twit_config`, `logo_twit_config`, `gp_config`, `logo_gp_config`, `li_config`, `logo_li_config`, `skype_config`, `logo_skype_config`, `footer_tittle_config`, `cc_config`, `favicon_config`, `copy_right`) VALUES
(5, '182857ss.jpeg', '2342342342', '', 'asdfas', '075447image1.jpeg', 'Twiiter', '075447image1.jpeg', 'asdfasdf', '075447images2.png', '', '', '', '', '', '', '075447image1.jpeg', 'Copy Right by Okwan');

-- --------------------------------------------------------

--
-- Table structure for table `favorite_kategori`
--

CREATE TABLE `favorite_kategori` (
  `id_favorite_kategori` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `editor` int(11) NOT NULL,
  `edited` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorite_kategori`
--

INSERT INTO `favorite_kategori` (`id_favorite_kategori`, `id_kategori`, `created`, `creator`, `editor`, `edited`) VALUES
(1, 1, 2017, 1, 0, '0000-00-00 00:00:00'),
(2, 2, 2017, 1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `m_kampus`
--

CREATE TABLE `m_kampus` (
  `id_kampus` int(11) NOT NULL,
  `nama_kampus` varchar(100) DEFAULT NULL,
  `id_kota` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kampus`
--

INSERT INTO `m_kampus` (`id_kampus`, `nama_kampus`, `id_kota`, `created`, `creator`, `edited`, `editor`) VALUES
(2, 'STIMIK', 1, NULL, NULL, NULL, NULL),
(3, 'Unikom', 1, '2017-09-21 00:00:00', NULL, NULL, NULL),
(4, 'Telkom', 1, '2017-09-20 00:00:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori`
--

CREATE TABLE `m_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kategori`
--

INSERT INTO `m_kategori` (`id_kategori`, `nama_kategori`, `created`, `creator`, `edited`, `editor`) VALUES
(1, 'Fast Food', '2017-08-26 15:20:30', 1, NULL, NULL),
(2, 'Makasan Sunda', '2017-09-20 17:07:49', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_kota`
--

CREATE TABLE `m_kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kota`
--

INSERT INTO `m_kota` (`id_kota`, `nama_kota`, `created`, `creator`, `edited`, `editor`) VALUES
(1, 'Bandung II', '2017-08-26 13:42:55', NULL, NULL, NULL),
(2, 'Jakarta', '2017-08-26 13:43:03', NULL, NULL, NULL),
(6, 'jakarta 1111', '2017-09-02 17:22:24', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `creator` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `editor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id_order_detail` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `outlate`
--

CREATE TABLE `outlate` (
  `id_outlate` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `id_kampus` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_merchant` int(11) DEFAULT NULL,
  `nama_outlate` varchar(100) NOT NULL,
  `nama_pemilik_outlate` varchar(100) NOT NULL,
  `alamat_outlate` text NOT NULL,
  `hp_outlate` varchar(100) NOT NULL,
  `status_open_outlate` int(11) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `creator` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `editor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlate`
--

INSERT INTO `outlate` (`id_outlate`, `id_kota`, `id_kampus`, `id_kategori`, `id_merchant`, `nama_outlate`, `nama_pemilik_outlate`, `alamat_outlate`, `hp_outlate`, `status_open_outlate`, `created`, `creator`, `edited`, `editor`) VALUES
(11, 1, 2, 1, 5, 'OUtlate', 'Pemilik OUtlate', 'alamat', '08572289444', 1, '2017-09-20 00:42:52', 1, '0000-00-00 00:00:00', 0),
(12, 1, 2, 1, 1, 'KFC', 'Okwan 1', 'Jalam Jurang', '085722894444', 1, '2017-09-20 01:22:22', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_merchant` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` varchar(100) NOT NULL,
  `ket_produk` text NOT NULL,
  `img_produk` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `creator` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `editor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_merchant`, `nama_produk`, `harga_produk`, `ket_produk`, `img_produk`, `created`, `creator`, `edited`, `editor`) VALUES
(51, 1, 'KFC 3', '90000', 'Huhuy . sadfasf', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `produk_feedback`
--

CREATE TABLE `produk_feedback` (
  `id_feedback` int(11) NOT NULL,
  `message_feedback` text,
  `feedFrom` int(11) DEFAULT NULL,
  `feedTo` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` varchar(200) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk_image`
--

CREATE TABLE `produk_image` (
  `id_image_produk` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `name_image_produk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_image`
--

INSERT INTO `produk_image` (`id_image_produk`, `id_produk`, `name_image_produk`) VALUES
(42, 51, '092338images.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `produk_rating`
--

CREATE TABLE `produk_rating` (
  `id_rating` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `rating_start` int(11) DEFAULT NULL,
  `from_rating` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id_promo` int(11) NOT NULL,
  `nama_promo` varchar(100) DEFAULT NULL,
  `desc_promo` varchar(200) NOT NULL,
  `image_promo` varchar(100) DEFAULT NULL,
  `date_start_promo` datetime DEFAULT NULL,
  `date_end_promo` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id_promo`, `nama_promo`, `desc_promo`, `image_promo`, `date_start_promo`, `date_end_promo`, `status`, `created`, `creator`, `edited`, `editor`) VALUES
(1, 'UP to 71%', 'Desc PRomo', '193212images.jpeg', '2017-09-09 00:00:00', '2017-09-16 00:00:00', 1, '2017-09-09 00:00:00', 1, NULL, NULL),
(8, 'Nama PRomo', 'Desc ddddd', '163430images.jpeg', '2017-09-20 00:00:00', '2017-09-20 00:00:00', NULL, '2017-09-20 16:34:30', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promo_role`
--

CREATE TABLE `promo_role` (
  `id_produk` int(11) DEFAULT NULL,
  `id_promo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo_role`
--

INSERT INTO `promo_role` (`id_produk`, `id_promo`) VALUES
(51, 1);

-- --------------------------------------------------------

--
-- Table structure for table `promo_slide`
--

CREATE TABLE `promo_slide` (
  `id_slide` int(11) NOT NULL,
  `nama_slide` varchar(255) DEFAULT NULL,
  `image_slide` varchar(255) DEFAULT NULL,
  `date_start_slide` datetime DEFAULT NULL,
  `date_end_slide` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo_slide`
--

INSERT INTO `promo_slide` (`id_slide`, `nama_slide`, `image_slide`, `date_start_slide`, `date_end_slide`, `created`, `creator`, `edited`, `editor`) VALUES
(1, 'Promo KFC3', '204542images.jpeg', '2017-09-10 00:00:00', '2017-09-30 00:00:00', '2017-09-10 00:00:00', 1, NULL, NULL),
(2, 'Promo MCD', 'image2.jpeg', '2017-09-10 00:00:00', '2017-09-30 00:00:00', '2017-09-10 00:00:00', 1, NULL, NULL),
(5, 'Rifky', '073112images.jpeg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2017-09-10 07:31:12', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promo_slide_role`
--

CREATE TABLE `promo_slide_role` (
  `id_produk` int(11) DEFAULT NULL,
  `id_slide` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo_slide_role`
--

INSERT INTO `promo_slide_role` (`id_produk`, `id_slide`) VALUES
(51, 2),
(51, 1);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id_review` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `name_review` int(100) NOT NULL,
  `rating_review` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `creator` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `editor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_open_close_toko`
--

CREATE TABLE `t_open_close_toko` (
  `id_openclose` int(11) NOT NULL,
  `id_merchant` int(11) DEFAULT NULL,
  `id_outlate` int(11) DEFAULT NULL,
  `hari_open` varchar(255) DEFAULT NULL,
  `jam_open` varchar(255) DEFAULT NULL,
  `menit_open` varchar(255) DEFAULT NULL,
  `jam_close` varchar(255) DEFAULT NULL,
  `menit_close` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_open_close_toko`
--

INSERT INTO `t_open_close_toko` (`id_openclose`, `id_merchant`, `id_outlate`, `hari_open`, `jam_open`, `menit_open`, `jam_close`, `menit_close`) VALUES
(15, 1, 8, 'Senin', '03', '04', '03', '04'),
(16, 1, 8, 'Selasa', '03', '04', '03', '04'),
(17, 1, 8, 'Jumat', '03', '04', '03', '04'),
(18, 1, 8, 'Sabtu', '03', '04', '03', '04'),
(19, 1, 8, 'Minggu', '03', '04', '03', '04'),
(20, 1, 9, 'Senin', '03', '04', '03', '04'),
(21, 1, 9, 'Selasa', '03', '04', '03', '04'),
(22, 1, 9, 'Jumat', '03', '04', '03', '04'),
(23, 1, 9, 'Sabtu', '03', '04', '03', '04'),
(24, 1, 9, 'Minggu', '03', '04', '03', '04');

-- --------------------------------------------------------

--
-- Table structure for table `users_merchant`
--

CREATE TABLE `users_merchant` (
  `id_merchant` int(11) NOT NULL,
  `username_merchant` varchar(100) NOT NULL,
  `pass_merchant` varchar(225) NOT NULL,
  `created` datetime NOT NULL,
  `creator` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `editor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_merchant`
--

INSERT INTO `users_merchant` (`id_merchant`, `username_merchant`, `pass_merchant`, `created`, `creator`, `edited`, `editor`) VALUES
(1, 'rifky', '$2y$10$SbaO4qKayyKKuHZ1KcUG5ORhPmeIN.eO86rmY8bgaazaPgYhcLAli', '2017-08-26 03:03:19', 1, '0000-00-00 00:00:00', 0),
(5, 'User merchant', '$2y$10$bWcnTLuN1Ga8LXSW17iO/OMtxEM9ZpPPRpPOukYDrwe1Hq8vDMqMS', '2017-09-20 00:42:52', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `id_user_admin` int(11) NOT NULL,
  `username_admin` varchar(100) DEFAULT NULL,
  `password_admin` varchar(100) DEFAULT NULL,
  `name_admin` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`id_user_admin`, `username_admin`, `password_admin`, `name_admin`, `created`, `creator`, `edited`, `editor`) VALUES
(1, 'rifkyadmin', '$2y$10$SbaO4qKayyKKuHZ1KcUG5ORhPmeIN.eO86rmY8bgaazaPgYhcLAli', 'Rifky rachman', '2017-09-02 00:29:56', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_customer`
--

CREATE TABLE `user_customer` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(100) DEFAULT NULL,
  `pass_customer` varchar(100) DEFAULT NULL,
  `alamat_customer` varchar(100) DEFAULT NULL,
  `email_customer` varchar(100) DEFAULT NULL,
  `hp_customer` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `editor` datetime DEFAULT NULL,
  `edited` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_customer`
--

INSERT INTO `user_customer` (`id_customer`, `nama_customer`, `pass_customer`, `alamat_customer`, `email_customer`, `hp_customer`, `created`, `creator`, `editor`, `edited`) VALUES
(1, 'rifky', '$2y$10$CDl8rWtHMa1cCx38KBNW0OF/fXBJlqjEiStwGbM25V46At.gMl8fi', 'alamat', 'rifky@kudo.co.id', '085722894444', '2017-09-13 09:45:11', NULL, NULL, NULL),
(2, 'rifkys', '$2y$10$p4L9AljeQ7B0/cs/JusBXeOdul9zLkXHKPSX1SNYu23IPZIdEB8ly', 'alamat', 'rifky@kudo.co.id', '085722894444', '2017-09-13 09:47:11', NULL, NULL, NULL),
(3, 'xx', '$2y$10$u59EdMXIMTt82zuuaB4H4.A5z0/7rYoLROOGDxzoAxP1xe665mGNy', 'rifky', 'rifky@kudo.co.id', '085722894444', '2017-09-13 16:58:37', NULL, NULL, NULL),
(4, 'rifkycustomer', '$2y$10$Y1YbnUh2u8LGrakmU/rb5eHgQ0i0uQIjU/CTYzpP9KhOXUi71lJxK', 'rifkycustomer', 'rifkycustomer@kudo.co.id', '085722894444', '2017-09-20 18:46:55', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id_config`);

--
-- Indexes for table `favorite_kategori`
--
ALTER TABLE `favorite_kategori`
  ADD PRIMARY KEY (`id_favorite_kategori`);

--
-- Indexes for table `m_kampus`
--
ALTER TABLE `m_kampus`
  ADD PRIMARY KEY (`id_kampus`),
  ADD KEY `id_kota` (`id_kota`),
  ADD KEY `id_kota_2` (`id_kota`);

--
-- Indexes for table `m_kategori`
--
ALTER TABLE `m_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `m_kota`
--
ALTER TABLE `m_kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_order_detail`),
  ADD KEY `order_detail_fk0` (`id_produk`),
  ADD KEY `order_detail_fk1` (`id_order`);

--
-- Indexes for table `outlate`
--
ALTER TABLE `outlate`
  ADD PRIMARY KEY (`id_outlate`),
  ADD KEY `id_kota` (`id_kota`),
  ADD KEY `id_kampus` (`id_kampus`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_merchant` (`id_merchant`),
  ADD KEY `id_merchant_2` (`id_merchant`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_fk1` (`id_merchant`);

--
-- Indexes for table `produk_feedback`
--
ALTER TABLE `produk_feedback`
  ADD PRIMARY KEY (`id_feedback`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk_image`
--
ALTER TABLE `produk_image`
  ADD PRIMARY KEY (`id_image_produk`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk_rating`
--
ALTER TABLE `produk_rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indexes for table `promo_role`
--
ALTER TABLE `promo_role`
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_promo` (`id_promo`);

--
-- Indexes for table `promo_slide`
--
ALTER TABLE `promo_slide`
  ADD PRIMARY KEY (`id_slide`);

--
-- Indexes for table `promo_slide_role`
--
ALTER TABLE `promo_slide_role`
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_slide` (`id_slide`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `review_fk0` (`id_produk`);

--
-- Indexes for table `t_open_close_toko`
--
ALTER TABLE `t_open_close_toko`
  ADD PRIMARY KEY (`id_openclose`),
  ADD KEY `id_merchant` (`id_merchant`);

--
-- Indexes for table `users_merchant`
--
ALTER TABLE `users_merchant`
  ADD PRIMARY KEY (`id_merchant`),
  ADD KEY `username_merchant` (`username_merchant`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id_user_admin`);

--
-- Indexes for table `user_customer`
--
ALTER TABLE `user_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `favorite_kategori`
--
ALTER TABLE `favorite_kategori`
  MODIFY `id_favorite_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_kampus`
--
ALTER TABLE `m_kampus`
  MODIFY `id_kampus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_kategori`
--
ALTER TABLE `m_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_kota`
--
ALTER TABLE `m_kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outlate`
--
ALTER TABLE `outlate`
  MODIFY `id_outlate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `produk_feedback`
--
ALTER TABLE `produk_feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk_image`
--
ALTER TABLE `produk_image`
  MODIFY `id_image_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `produk_rating`
--
ALTER TABLE `produk_rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `promo_slide`
--
ALTER TABLE `promo_slide`
  MODIFY `id_slide` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_open_close_toko`
--
ALTER TABLE `t_open_close_toko`
  MODIFY `id_openclose` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users_merchant`
--
ALTER TABLE `users_merchant`
  MODIFY `id_merchant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id_user_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_customer`
--
ALTER TABLE `user_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_kampus`
--
ALTER TABLE `m_kampus`
  ADD CONSTRAINT `kota_kampus` FOREIGN KEY (`id_kota`) REFERENCES `m_kota` (`id_kota`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_fk0` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `order_detail_fk1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`);

--
-- Constraints for table `outlate`
--
ALTER TABLE `outlate`
  ADD CONSTRAINT `id_kageori` FOREIGN KEY (`id_kategori`) REFERENCES `m_kategori` (`id_kategori`),
  ADD CONSTRAINT `id_merchant` FOREIGN KEY (`id_merchant`) REFERENCES `users_merchant` (`id_merchant`),
  ADD CONSTRAINT `kota` FOREIGN KEY (`id_kota`) REFERENCES `m_kota` (`id_kota`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_fk1` FOREIGN KEY (`id_merchant`) REFERENCES `users_merchant` (`id_merchant`);

--
-- Constraints for table `produk_feedback`
--
ALTER TABLE `produk_feedback`
  ADD CONSTRAINT `KeyProdFeed` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `produk_image`
--
ALTER TABLE `produk_image`
  ADD CONSTRAINT `keyProdImage` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `produk_rating`
--
ALTER TABLE `produk_rating`
  ADD CONSTRAINT `keyRatProd` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `promo_role`
--
ALTER TABLE `promo_role`
  ADD CONSTRAINT `keyProdPromo` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `keyPromo` FOREIGN KEY (`id_promo`) REFERENCES `promo` (`id_promo`);

--
-- Constraints for table `promo_slide_role`
--
ALTER TABLE `promo_slide_role`
  ADD CONSTRAINT `keyProd` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `keySlide` FOREIGN KEY (`id_slide`) REFERENCES `promo_slide` (`id_slide`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_fk0` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `t_open_close_toko`
--
ALTER TABLE `t_open_close_toko`
  ADD CONSTRAINT `keyMerchant` FOREIGN KEY (`id_merchant`) REFERENCES `users_merchant` (`id_merchant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
