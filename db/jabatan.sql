/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.27-MariaDB 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `jabatan` (
	`id_jabatan` int (10),
	`nama_jabatan` varchar (60)
); 
insert into `jabatan` (`id_jabatan`, `nama_jabatan`) values('0','Dokter Umum');
insert into `jabatan` (`id_jabatan`, `nama_jabatan`) values('1','Kepala Puskesmas');
