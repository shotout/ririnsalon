/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 5.7.31 : Database - salon
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`salon` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `salon`;

/*Table structure for table `absensi` */

DROP TABLE IF EXISTS `absensi`;

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT NULL,
  `bulan` varchar(50) DEFAULT NULL,
  `hadir` int(11) DEFAULT NULL,
  `absen` int(11) DEFAULT NULL,
  `lembur` int(11) DEFAULT NULL,
  `izin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `absensi_ibfk_1` (`id_karyawan`),
  CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `absensi` */

insert  into `absensi`(`id`,`id_karyawan`,`bulan`,`hadir`,`absen`,`lembur`,`izin`) values 
(6,7,'1',20,8,2,0),
(7,7,'2',20,6,0,0),
(8,8,'1',1,1,1,1),
(9,7,'3',10,1,1,1),
(10,8,'4',1,1,1,1),
(11,7,'10',4,3,6,1);

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nama` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `admin` */

insert  into `admin`(`id`,`nama`,`username`,`password`,`avatar`,`last_login`,`type`,`date_added`,`date_updated`) values 
(1,'Super Admin','superadmin','17c4520f6cfd1ab53d8745e84681eb49','uploads/avatar-1.png?v=1635556826',NULL,1,'2021-01-20 14:02:37','2022-05-19 12:06:22'),
(11,'Karyawan','karyawan','9e014682c94e0f2cc834bf7348bda428','uploads/avatar-11.png?v=1635920566',NULL,2,'2021-11-03 14:22:46','2022-05-19 12:05:12'),
(15,'Admin','admin','21232f297a57a5a743894a0e4a801fc3',NULL,NULL,1,'2022-05-19 12:06:33',NULL);

/*Table structure for table `karyawan` */

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `jabatan` int(11) DEFAULT NULL,
  `gajipokok` int(11) DEFAULT NULL,
  `tanggalmasuk` date DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `karyawan` */

insert  into `karyawan`(`id`,`nama`,`alamat`,`nohp`,`jabatan`,`gajipokok`,`tanggalmasuk`) values 
(7,'Karyawan','Riau','08110239232',2,2000000,'2022-05-19'),
(8,'Hevalo','Pekanbaru','123123132',2,2000000,'2022-05-19');

/*Table structure for table `pemasukan` */

DROP TABLE IF EXISTS `pemasukan`;

CREATE TABLE `pemasukan` (
  `idpemasukan` int(11) NOT NULL AUTO_INCREMENT,
  `noreferensi` varchar(50) DEFAULT NULL,
  `tanggalpemasukan` date DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `keteranganmasuk` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idpemasukan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `pemasukan` */

insert  into `pemasukan`(`idpemasukan`,`noreferensi`,`tanggalpemasukan`,`amount`,`keteranganmasuk`) values 
(6,'MREF0001','2022-05-17',100000,'555555');

/*Table structure for table `pengeluaran` */

DROP TABLE IF EXISTS `pengeluaran`;

CREATE TABLE `pengeluaran` (
  `idpengeluaran` int(11) NOT NULL AUTO_INCREMENT,
  `noreferensi_pengeluaran` varchar(50) DEFAULT NULL,
  `tanggal_pengeluaran` date DEFAULT NULL,
  `amount_pengeluaran` int(11) DEFAULT NULL,
  `keterangankeluar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idpengeluaran`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `pengeluaran` */

insert  into `pengeluaran`(`idpengeluaran`,`noreferensi_pengeluaran`,`tanggal_pengeluaran`,`amount_pengeluaran`,`keterangankeluar`) values 
(10,'KREF0001','2022-05-17',4000,'hhhhh'),
(11,'KREF0002','2022-05-17',6000,'ffff'),
(12,'KREF0003','2022-05-16',50000,'ddd');

/*Table structure for table `penggajian` */

DROP TABLE IF EXISTS `penggajian`;

CREATE TABLE `penggajian` (
  `id_penggajian` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_absensi` int(11) DEFAULT NULL,
  `id_tunjangan` int(11) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `bonus` int(11) DEFAULT NULL,
  `p_cashbon` int(11) DEFAULT NULL,
  `p_lain` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_penggajian`),
  KEY `id_karyawan` (`id_karyawan`),
  KEY `penggajian_ibfk_2` (`id_absensi`),
  KEY `penggajian_ibfk_3` (`id_tunjangan`),
  CONSTRAINT `penggajian_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `penggajian_ibfk_2` FOREIGN KEY (`id_absensi`) REFERENCES `absensi` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `penggajian_ibfk_3` FOREIGN KEY (`id_tunjangan`) REFERENCES `penggajian` (`id_penggajian`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penggajian` */

/*Table structure for table `system_info` */

DROP TABLE IF EXISTS `system_info`;

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `system_info` */

insert  into `system_info`(`id`,`meta_field`,`meta_value`) values 
(1,'name','Ririn Salon dan Spa'),
(6,'short_name','Ririn Salon dan Spa'),
(11,'logo','uploads/logo-1652865033.png'),
(13,'user_avatar','uploads/user_avatar.jpg'),
(14,'cover','uploads/cover-1652865745.png'),
(15,'content','Array');

/*Table structure for table `tunjangan` */

DROP TABLE IF EXISTS `tunjangan`;

CREATE TABLE `tunjangan` (
  `id_tunjangan` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT NULL,
  `t_kesehatan` int(11) DEFAULT NULL,
  `t_makan` int(11) DEFAULT NULL,
  `t_makeup` int(11) DEFAULT NULL,
  `t_transport` int(11) DEFAULT NULL,
  `t_kasir` int(11) DEFAULT NULL,
  `t_kerajinan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tunjangan`),
  KEY `id_karyawan` (`id_karyawan`),
  CONSTRAINT `tunjangan_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tunjangan` */

insert  into `tunjangan`(`id_tunjangan`,`id_karyawan`,`t_kesehatan`,`t_makan`,`t_makeup`,`t_transport`,`t_kasir`,`t_kerajinan`) values 
(3,8,123123,12312312,200,14141,123123,1414);

/*Table structure for table `user_meta` */

DROP TABLE IF EXISTS `user_meta`;

CREATE TABLE `user_meta` (
  `user_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_meta` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
