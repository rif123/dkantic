/*
 Navicat Premium Data Transfer

 Source Server         : LocalAppache
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : dkantin

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 09/08/2017 06:58:31 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `config`
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id_config` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id_config`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `config`
-- ----------------------------
BEGIN;
INSERT INTO `config` VALUES ('5', '2342342342', '', 'asdfas', '075447image1.jpeg', 'Twiiter', '075447image1.jpeg', 'asdfasdf', '075447images2.png', '', '', '', '', '', '', '075447image1.jpeg');
COMMIT;

-- ----------------------------
--  Table structure for `m_kampus`
-- ----------------------------
DROP TABLE IF EXISTS `m_kampus`;
CREATE TABLE `m_kampus` (
  `id_kampus` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kampus` varchar(100) DEFAULT NULL,
  `id_kota` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kampus`),
  KEY `id_kota` (`id_kota`),
  KEY `id_kota_2` (`id_kota`),
  CONSTRAINT `kota_kampus` FOREIGN KEY (`id_kota`) REFERENCES `m_kota` (`id_kota`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `m_kampus`
-- ----------------------------
BEGIN;
INSERT INTO `m_kampus` VALUES ('2', 'STIMIK', '1', null, null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `m_kategori`
-- ----------------------------
DROP TABLE IF EXISTS `m_kategori`;
CREATE TABLE `m_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `m_kategori`
-- ----------------------------
BEGIN;
INSERT INTO `m_kategori` VALUES ('1', 'Fast Food', '2017-08-26 15:20:30', '1', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `m_kota`
-- ----------------------------
DROP TABLE IF EXISTS `m_kota`;
CREATE TABLE `m_kota` (
  `id_kota` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kota` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kota`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `m_kota`
-- ----------------------------
BEGIN;
INSERT INTO `m_kota` VALUES ('1', 'Bandung II', '2017-08-26 13:42:55', null, null, null), ('2', 'Jakarta', '2017-08-26 13:43:03', null, null, null), ('6', 'jakarta 1111', '2017-09-02 17:22:24', '1', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `order_detail`
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `id_order_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  PRIMARY KEY (`id_order_detail`),
  KEY `order_detail_fk0` (`id_produk`),
  KEY `order_detail_fk1` (`id_order`),
  CONSTRAINT `order_detail_fk0` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  CONSTRAINT `order_detail_fk1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `creator` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `editor` int(11) NOT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `outlate`
-- ----------------------------
DROP TABLE IF EXISTS `outlate`;
CREATE TABLE `outlate` (
  `id_outlate` int(11) NOT NULL AUTO_INCREMENT,
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
  `editor` int(11) NOT NULL,
  PRIMARY KEY (`id_outlate`),
  KEY `id_kota` (`id_kota`),
  KEY `id_kampus` (`id_kampus`),
  KEY `id_kategori` (`id_kategori`),
  KEY `id_merchant` (`id_merchant`),
  KEY `id_merchant_2` (`id_merchant`),
  CONSTRAINT `id_kageori` FOREIGN KEY (`id_kategori`) REFERENCES `m_kategori` (`id_kategori`),
  CONSTRAINT `id_merchant` FOREIGN KEY (`id_merchant`) REFERENCES `users_merchant` (`id_merchant`),
  CONSTRAINT `kota` FOREIGN KEY (`id_kota`) REFERENCES `m_kota` (`id_kota`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `outlate`
-- ----------------------------
BEGIN;
INSERT INTO `outlate` VALUES ('9', '1', '2', '1', '1', 'KFC', 'Okwan', 'Jalam Jurang', '085722894444', '1', '2017-08-27 11:57:03', '1', '0000-00-00 00:00:00', '0');
COMMIT;

-- ----------------------------
--  Table structure for `produk`
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `id_merchant` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` varchar(100) NOT NULL,
  `ket_produk` text NOT NULL,
  `img_produk` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `creator` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `editor` int(11) NOT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `produk_fk1` (`id_merchant`),
  CONSTRAINT `produk_fk1` FOREIGN KEY (`id_merchant`) REFERENCES `users_merchant` (`id_merchant`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `produk`
-- ----------------------------
BEGIN;
INSERT INTO `produk` VALUES ('49', '1', 'KFC 2', '80000', 'ASDFAS asdfasd fas df', '', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0'), ('51', '1', 'KFC 3', '90000', 'Huhuy', '', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0');
COMMIT;

-- ----------------------------
--  Table structure for `produk_feedback`
-- ----------------------------
DROP TABLE IF EXISTS `produk_feedback`;
CREATE TABLE `produk_feedback` (
  `id_feedback` int(11) NOT NULL AUTO_INCREMENT,
  `message_feedback` text,
  `feedFrom` int(11) DEFAULT NULL,
  `feedTo` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` varchar(200) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_feedback`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `KeyProdFeed` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `produk_image`
-- ----------------------------
DROP TABLE IF EXISTS `produk_image`;
CREATE TABLE `produk_image` (
  `id_image_produk` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) DEFAULT NULL,
  `name_image_produk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_image_produk`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `keyProdImage` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `produk_image`
-- ----------------------------
BEGIN;
INSERT INTO `produk_image` VALUES ('41', '49', '092338images.jpeg');
COMMIT;

-- ----------------------------
--  Table structure for `produk_rating`
-- ----------------------------
DROP TABLE IF EXISTS `produk_rating`;
CREATE TABLE `produk_rating` (
  `id_rating` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) DEFAULT NULL,
  `rating_start` int(11) DEFAULT NULL,
  `from_rating` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rating`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `keyRatProd` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `review`
-- ----------------------------
DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `id_review` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `name_review` int(100) NOT NULL,
  `rating_review` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `creator` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `editor` int(11) NOT NULL,
  PRIMARY KEY (`id_review`),
  KEY `review_fk0` (`id_produk`),
  CONSTRAINT `review_fk0` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `t_open_close_toko`
-- ----------------------------
DROP TABLE IF EXISTS `t_open_close_toko`;
CREATE TABLE `t_open_close_toko` (
  `id_openclose` int(11) NOT NULL AUTO_INCREMENT,
  `id_merchant` int(11) DEFAULT NULL,
  `id_outlate` int(11) DEFAULT NULL,
  `hari_open` varchar(255) DEFAULT NULL,
  `jam_open` varchar(255) DEFAULT NULL,
  `menit_open` varchar(255) DEFAULT NULL,
  `jam_close` varchar(255) DEFAULT NULL,
  `menit_close` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_openclose`),
  KEY `id_merchant` (`id_merchant`),
  CONSTRAINT `keyMerchant` FOREIGN KEY (`id_merchant`) REFERENCES `users_merchant` (`id_merchant`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `t_open_close_toko`
-- ----------------------------
BEGIN;
INSERT INTO `t_open_close_toko` VALUES ('15', '1', '8', 'Senin', '03', '04', '03', '04'), ('16', '1', '8', 'Selasa', '03', '04', '03', '04'), ('17', '1', '8', 'Jumat', '03', '04', '03', '04'), ('18', '1', '8', 'Sabtu', '03', '04', '03', '04'), ('19', '1', '8', 'Minggu', '03', '04', '03', '04');
COMMIT;

-- ----------------------------
--  Table structure for `user_admin`
-- ----------------------------
DROP TABLE IF EXISTS `user_admin`;
CREATE TABLE `user_admin` (
  `id_user_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username_admin` varchar(100) DEFAULT NULL,
  `password_admin` varchar(100) DEFAULT NULL,
  `name_admin` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `user_admin`
-- ----------------------------
BEGIN;
INSERT INTO `user_admin` VALUES ('1', 'rifkyadmin', '$2y$10$SbaO4qKayyKKuHZ1KcUG5ORhPmeIN.eO86rmY8bgaazaPgYhcLAli', 'Rifky rachman', '2017-09-02 00:29:56', '1', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `users_merchant`
-- ----------------------------
DROP TABLE IF EXISTS `users_merchant`;
CREATE TABLE `users_merchant` (
  `id_merchant` int(11) NOT NULL AUTO_INCREMENT,
  `username_merchant` varchar(100) NOT NULL,
  `pass_merchant` varchar(225) NOT NULL,
  `created` datetime NOT NULL,
  `creator` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `editor` int(11) NOT NULL,
  PRIMARY KEY (`id_merchant`),
  KEY `username_merchant` (`username_merchant`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `users_merchant`
-- ----------------------------
BEGIN;
INSERT INTO `users_merchant` VALUES ('1', 'rifky', '$2y$10$SbaO4qKayyKKuHZ1KcUG5ORhPmeIN.eO86rmY8bgaazaPgYhcLAli', '2017-08-26 03:03:19', '1', '0000-00-00 00:00:00', '0');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
