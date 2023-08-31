/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - db_presensi_puskesmas
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_presensi_puskesmas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `db_presensi_puskesmas`;

/*Table structure for table `data_pegawai` */

DROP TABLE IF EXISTS `data_pegawai`;

CREATE TABLE `data_pegawai` (
  `id_pegawai` varchar(10) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `qrcode` text NOT NULL,
  PRIMARY KEY (`id_pegawai`),
  KEY `tb_jabatan` (`id_jabatan`),
  CONSTRAINT `tb_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan_pegawai` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `info_waktu_presensi` */

DROP TABLE IF EXISTS `info_waktu_presensi`;

CREATE TABLE `info_waktu_presensi` (
  `id_info_presensi` int(11) NOT NULL AUTO_INCREMENT,
  `info_jam_masuk` time NOT NULL,
  `info_jam_pulang` time NOT NULL,
  `info_Tanggal_presensi` date NOT NULL,
  PRIMARY KEY (`id_info_presensi`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

/*Data for the table `info_waktu_presensi` */

/*Table structure for table `jabatan_pegawai` */

DROP TABLE IF EXISTS `jabatan_pegawai`;

CREATE TABLE `jabatan_pegawai` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(255) NOT NULL,
  `kode_jabatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jabatan`),
  KEY `id_jabatan` (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jabatan_pegawai` */

/*Table structure for table `keterangan_presensi` */

DROP TABLE IF EXISTS `keterangan_presensi`;

CREATE TABLE `keterangan_presensi` (
  `id_presensi` int(10) NOT NULL AUTO_INCREMENT,
  `id_pegawai` varchar(10) NOT NULL,
  `id_info_presensi` int(11) NOT NULL,
  `tanggal_presensi` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `status_kehadiran` varchar(255) NOT NULL,
  `status_kehadiran_pulang` varchar(255) NOT NULL,
  `ket_izin` text NOT NULL,
  PRIMARY KEY (`id_presensi`),
  KEY `tb_id_pegawai` (`id_pegawai`),
  KEY `tb_info_presensi` (`id_info_presensi`),
  CONSTRAINT `tb_id_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `data_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_info_presensi` FOREIGN KEY (`id_info_presensi`) REFERENCES `info_waktu_presensi` (`id_info_presensi`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
