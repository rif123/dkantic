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

 Date: 08/26/2017 21:42:56 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `m_kampus`
-- ----------------------------
BEGIN;
INSERT INTO `m_kampus` VALUES ('1', 'UNIKOM', '1', '2017-08-26 14:47:23', '1', null, null);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `m_kota`
-- ----------------------------
BEGIN;
INSERT INTO `m_kota` VALUES ('1', 'Bandung', '2017-08-26 13:42:55', null, null, null), ('2', 'Jakarta', '2017-08-26 13:43:03', null, null, null);
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
  `day_open_outlate` date NOT NULL,
  `hours_open_outlate` time NOT NULL,
  `status_open_outlate` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `outlate`
-- ----------------------------
BEGIN;
INSERT INTO `outlate` VALUES ('5', '1', '1', '1', '1', 'KFC', 'NO NAME', 'jl jurang', '085722894444', '0000-00-00', '00:00:00', '0', '2017-08-26 09:49:22', '1', '0000-00-00 00:00:00', '0');
COMMIT;

-- ----------------------------
--  Table structure for `produk`
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `id_outlate` int(11) NOT NULL,
  `id_merchant` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` varchar(100) NOT NULL,
  `ket_produk` text NOT NULL,
  `simulai_serve_produk` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `creator` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `editor` int(11) NOT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `produk_fk0` (`id_outlate`),
  KEY `produk_fk1` (`id_merchant`),
  CONSTRAINT `produk_fk0` FOREIGN KEY (`id_outlate`) REFERENCES `outlate` (`id_outlate`),
  CONSTRAINT `produk_fk1` FOREIGN KEY (`id_merchant`) REFERENCES `users_merchant` (`id_merchant`)
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
