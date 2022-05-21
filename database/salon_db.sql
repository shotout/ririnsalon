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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `absensi` */

insert  into `absensi`(`id`,`id_karyawan`,`bulan`,`hadir`,`absen`,`lembur`,`izin`) values 
(6,7,'1',20,6,0,0),
(7,7,'2',20,6,0,0),
(8,8,'1',1,1,1,1),
(9,7,'3',1,1,1,1),
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

/*Table structure for table `back_order_list` */

DROP TABLE IF EXISTS `back_order_list`;

CREATE TABLE `back_order_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `receiving_id` int(30) NOT NULL,
  `po_id` int(30) NOT NULL,
  `bo_code` varchar(50) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `amount` float NOT NULL,
  `discount_perc` float NOT NULL DEFAULT '0',
  `discount` float NOT NULL DEFAULT '0',
  `tax_perc` float NOT NULL DEFAULT '0',
  `tax` float NOT NULL DEFAULT '0',
  `remarks` text,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = pending, 1 = partially received, 2 =received',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `po_id` (`po_id`),
  KEY `receiving_id` (`receiving_id`),
  CONSTRAINT `back_order_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE,
  CONSTRAINT `back_order_list_ibfk_2` FOREIGN KEY (`po_id`) REFERENCES `purchase_order_list` (`id`) ON DELETE CASCADE,
  CONSTRAINT `back_order_list_ibfk_3` FOREIGN KEY (`receiving_id`) REFERENCES `receiving_list` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `back_order_list` */

insert  into `back_order_list`(`id`,`receiving_id`,`po_id`,`bo_code`,`supplier_id`,`amount`,`discount_perc`,`discount`,`tax_perc`,`tax`,`remarks`,`status`,`date_created`,`date_updated`) values 
(1,1,1,'BO-0001',1,40740,3,1125,12,4365,NULL,1,'2021-11-03 11:20:38','2021-11-03 11:20:51'),
(2,2,1,'BO-0002',1,20370,3,562.5,12,2182.5,NULL,2,'2021-11-03 11:20:51','2021-11-03 11:21:00'),
(3,4,2,'BO-0003',2,42826,5,2012.5,12,4588.5,NULL,1,'2021-11-03 11:51:41','2021-11-03 11:52:02'),
(4,5,2,'BO-0004',2,10640,5,500,12,1140,NULL,2,'2021-11-03 11:52:02','2021-11-03 11:52:15');

/*Table structure for table `bo_items` */

DROP TABLE IF EXISTS `bo_items`;

CREATE TABLE `bo_items` (
  `bo_id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `unit` varchar(50) NOT NULL,
  `total` float NOT NULL DEFAULT '0',
  KEY `item_id` (`item_id`),
  KEY `bo_id` (`bo_id`),
  CONSTRAINT `bo_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item_list` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bo_items_ibfk_2` FOREIGN KEY (`bo_id`) REFERENCES `back_order_list` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `bo_items` */

insert  into `bo_items`(`bo_id`,`item_id`,`quantity`,`price`,`unit`,`total`) values 
(1,1,250,150,'pcs',37500),
(2,1,125,150,'pcs',18750),
(3,2,150,200,'Boxes',30000),
(3,4,50,205,'pcs',10250),
(4,2,50,200,'Boxes',10000);

/*Table structure for table `item_list` */

DROP TABLE IF EXISTS `item_list`;

CREATE TABLE `item_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `cost` float NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `item_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `item_list` */

insert  into `item_list`(`id`,`name`,`description`,`supplier_id`,`cost`,`status`,`date_created`,`date_updated`) values 
(1,'Item 101','Sample Only',1,150,1,'2021-11-02 10:01:55','2021-11-02 10:01:55'),
(2,'Item 102','Sample only',2,200,1,'2021-11-02 10:02:12','2021-11-02 10:02:12'),
(3,'Item 103','Sample',1,185,1,'2021-11-02 10:02:27','2021-11-02 10:02:27'),
(4,'Item 104','Sample only',2,205,1,'2021-11-02 10:02:47','2021-11-02 10:02:47');

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

/*Table structure for table `po_items` */

DROP TABLE IF EXISTS `po_items`;

CREATE TABLE `po_items` (
  `po_id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `unit` varchar(50) NOT NULL,
  `total` float NOT NULL DEFAULT '0',
  KEY `po_id` (`po_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `po_items_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_order_list` (`id`) ON DELETE CASCADE,
  CONSTRAINT `po_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item_list` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `po_items` */

insert  into `po_items`(`po_id`,`item_id`,`quantity`,`price`,`unit`,`total`) values 
(1,1,500,150,'pcs',75000),
(2,2,300,200,'Boxes',60000),
(2,4,200,205,'pcs',41000);

/*Table structure for table `purchase_order_list` */

DROP TABLE IF EXISTS `purchase_order_list`;

CREATE TABLE `purchase_order_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `po_code` varchar(50) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `amount` float NOT NULL,
  `discount_perc` float NOT NULL DEFAULT '0',
  `discount` float NOT NULL DEFAULT '0',
  `tax_perc` float NOT NULL DEFAULT '0',
  `tax` float NOT NULL DEFAULT '0',
  `remarks` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = pending, 1 = partially received, 2 =received',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `purchase_order_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `purchase_order_list` */

insert  into `purchase_order_list`(`id`,`po_code`,`supplier_id`,`amount`,`discount_perc`,`discount`,`tax_perc`,`tax`,`remarks`,`status`,`date_created`,`date_updated`) values 
(1,'PO-0001',1,81480,3,2250,12,8730,'Sample',2,'2021-11-03 11:20:22','2021-11-03 11:21:00'),
(2,'PO-0002',2,107464,5,5050,12,11514,'Sample PO Only',2,'2021-11-03 11:50:50','2021-11-03 11:52:15');

/*Table structure for table `receiving_list` */

DROP TABLE IF EXISTS `receiving_list`;

CREATE TABLE `receiving_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `form_id` int(30) NOT NULL,
  `from_order` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=PO ,2 = BO',
  `amount` float NOT NULL DEFAULT '0',
  `discount_perc` float NOT NULL DEFAULT '0',
  `discount` float NOT NULL DEFAULT '0',
  `tax_perc` float NOT NULL DEFAULT '0',
  `tax` float NOT NULL DEFAULT '0',
  `stock_ids` text,
  `remarks` text,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `receiving_list` */

insert  into `receiving_list`(`id`,`form_id`,`from_order`,`amount`,`discount_perc`,`discount`,`tax_perc`,`tax`,`stock_ids`,`remarks`,`date_created`,`date_updated`) values 
(1,1,1,40740,3,1125,12,4365,'1','Sample','2021-11-03 11:20:38','2021-11-03 11:20:38'),
(2,1,2,20370,3,562.5,12,2182.5,'2','','2021-11-03 11:20:51','2021-11-03 11:20:51'),
(3,2,2,20370,3,562.5,12,2182.5,'3','Success','2021-11-03 11:21:00','2021-11-03 11:21:00'),
(4,2,1,64638,5,3037.5,12,6925.5,'4,5','Sample Receiving (Partial)','2021-11-03 11:51:41','2021-11-03 11:51:41'),
(5,3,2,32186,5,1512.5,12,3448.5,'6,7','BO Receive (Partial)','2021-11-03 11:52:02','2021-11-03 11:52:02'),
(6,4,2,10640,5,500,12,1140,'8','Sample Success','2021-11-03 11:52:15','2021-11-03 11:52:15');

/*Table structure for table `return_list` */

DROP TABLE IF EXISTS `return_list`;

CREATE TABLE `return_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `return_code` varchar(50) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `remarks` text,
  `stock_ids` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `return_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `return_list` */

insert  into `return_list`(`id`,`return_code`,`supplier_id`,`amount`,`remarks`,`stock_ids`,`date_created`,`date_updated`) values 
(1,'R-0001',2,3025,'Sample Issue','16,17','2021-11-03 13:45:53','2021-11-03 13:45:53');

/*Table structure for table `sales_list` */

DROP TABLE IF EXISTS `sales_list`;

CREATE TABLE `sales_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `sales_code` varchar(50) NOT NULL,
  `client` text,
  `amount` float NOT NULL DEFAULT '0',
  `remarks` text,
  `stock_ids` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `sales_list` */

insert  into `sales_list`(`id`,`sales_code`,`client`,`amount`,`remarks`,`stock_ids`,`date_created`,`date_updated`) values 
(1,'SALE-0001','John Smith',7625,'Sample Remarks','24,25,26','2021-11-03 14:03:30','2021-11-03 14:08:27');

/*Table structure for table `supplier_list` */

DROP TABLE IF EXISTS `supplier_list`;

CREATE TABLE `supplier_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `cperson` text NOT NULL,
  `contact` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `supplier_list` */

insert  into `supplier_list`(`id`,`name`,`address`,`cperson`,`contact`,`status`,`date_created`,`date_updated`) values 
(1,'Supplier 101','Sample Supplier Address 101','Supplier Staff 101','09123456789',1,'2021-11-02 09:36:19','2021-11-02 09:36:19'),
(2,'Supplier 102','Sample Address 102','Supplier Staff 102','0987654332',1,'2021-11-02 09:36:54','2021-11-02 09:36:54');

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
