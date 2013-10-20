/*
SQLyog Ultimate v9.51 
MySQL - 5.1.41-community-log : Database - tonghoptruyen
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `cat_comic` */

DROP TABLE IF EXISTS `cat_comic`;

CREATE TABLE `cat_comic` (
  `cat_id` bigint(20) NOT NULL,
  `commic_id` bigint(20) NOT NULL,
  `is_main` int(1) DEFAULT '0',
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`cat_id`,`commic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `cat_comic` */

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `url` varchar(150) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `seo_name` varchar(200) DEFAULT NULL,
  `keywords` varchar(200) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `categories` */

insert  into `categories`(`id`,`url`,`name`,`seo_name`,`keywords`,`description`,`status`) values (1,'truyen-tranh-hanh-dong','Truyện Tranh Hành Động','Truyện tranh Hành Động - Truyện tranh Hành Động hay nhất, mới cập nhật mỗi ngày','truyen tranh Hành Động, truyen tranh Hành Động hay, doc truyen tranh Hành Động hay','Truyện tranh Hành Động hay nhất, các bộ truyện tranh Hành Động mới nhất, đọc truyện tranh Hành Động online hay tại Tổng Hợp Truyện',1),(3,'truyen-tranh-tinh-cam','Truyện Tranh Tình Cảm','Truyện tranh Tình Cảm - Truyện tranh Tình Cảm hay nhất, mới cập nhật mỗi ngày','truyen tranh Tình Cảm, truyen tranh Tình Cảm hay, doc truyen tranh Tình Cảm hay','Truyện tranh Tình Cảm hay nhất, các bộ truyện tranh Tình Cảm mới nhất, đọc truyện tranh Tình Cảm online hay tại Tổng Hợp Truyện',1),(4,'truyen-tranh-trinh-tham','Truyện Tranh Trinh Thám','Truyện tranh Trinh Thám - Truyện tranh Trinh Thám hay nhất, mới cập nhật mỗi ngày','truyen tranh Trinh Thám, truyen tranh Trinh Thám hay, doc truyen tranh Trinh Thám hay','Truyện tranh Trinh Thám hay nhất, các bộ truyện tranh Trinh Thám mới nhất, đọc truyện tranh Trinh Thám online hay tại Tổng Hợp Truyện',1),(5,'truyen-tranh-vien-tuong','Truyện Tranh Viễn Tưởng','Truyện tranh Viễn Tưởng - Truyện tranh Viễn Tưởng hay nhất, mới cập nhật mỗi ngày','truyen tranh Viễn Tưởng, truyen tranh Viễn Tưởng hay, doc truyen tranh Viễn Tưởng hay','ruyện tranh Viễn Tưởng hay nhất, các bộ truyện tranh Viễn Tưởng mới nhất, đọc truyện tranh Viễn Tưởng online hay tại Tổng Hợp Truyện',1),(6,'truyen-tranh-che','Truyện Tranh Chế','Truyện tranh Truyện Chế - Truyện tranh Truyện Chế hay nhất, mới cập nhật mỗi ngày','truyen tranh Truyện Chế, truyen tranh Truyện Chế hay, doc truyen tranh Truyện Chế hay','Truyện tranh Truyện Chế hay nhất, các bộ truyện tranh Truyện Chế mới nhất, đọc truyện tranh Truyện Chế online hay',1),(7,'truyen-tranh-the-thao','Truyện Tranh Thể Thao','Truyện tranh Thể Thao - Truyện tranh Thể Thao hay nhất, mới cập nhật mỗi ngày','truyen tranh Thể Thao, truyen tranh Thể Thao hay, doc truyen tranh Thể Thao hay','Truyện tranh Thể Thao hay nhất, các bộ truyện tranh Thể Thao mới nhất, đọc truyện tranh Thể Thao online hay',1),(8,'truyen-tranh-hoc-duong','Truyện Tranh Học Đường','Truyện tranh Học Đường - Truyện tranh Học Đường hay nhất, mới cập nhật mỗi ngày','truyen tranh Học Đường, truyen tranh Học Đường hay, doc truyen tranh Học Đường hay','truyen tranh Học Đường, truyen tranh Học Đường hay, doc truyen tranh Học Đường hay',1),(9,'truyen-tranh-kinh-di','Truyện Tranh Kinh Dị','Truyện tranh Kinh Dị - Truyện tranh Kinh Dị hay nhất, mới cập nhật mỗi ngày','truyen tranh Kinh Dị, truyen tranh Kinh Dị hay, doc truyen tranh Kinh Dị hay','truyen tranh Kinh Dị, truyen tranh Kinh Dị hay, doc truyen tranh Kinh Dị hay',1),(10,'truyen-tranh-cung-hoang-dao','Truyện Tranh Cung Hoàng Đạo','Truyện tranh Cung Hoàng Đạo - Truyện tranh Cung Hoàng Đạo hay nhất, mới cập nhật mỗi ngày','truyen tranh Cung Hoàng Đạo, truyen tranh Cung Hoàng Đạo hay, doc truyen tranh Cung Hoàng Đạo hay','truyen tranh Cung Hoàng Đạo, truyen tranh Cung Hoàng Đạo hay, doc truyen tranh Cung Hoàng Đạo hay',1),(11,'truyen-tranh-hai-huoc','Truyện Tranh Hài Hước','Truyện tranh Hài Hước - Truyện tranh Hài Hước hay nhất, mới cập nhật mỗi ngày','truyen tranh Hài Hước, truyen tranh Hài Hước hay, doc truyen tranh Hài Hước hay','Cuộc sống làm bạn phiền não, chán nản, lo âu? Bạn cần quên đi để tiếp tục vững bước hướng về tương lai tươi đẹp phía trước. Vậy hãy nhanh tay click vào những trang truyện hài hước và bạn sẽ có được những trận cười nghiêng ngả',1),(12,'truyen-tranh-18','Truyện Tranh 18+','Truyện Tranh 18+ hay nhất, mới cập nhật mỗi ngày','Truyện Tranh 18+, Truyện Tranh 18+ hay, doc Truyện Tranh 18+ hay','Truyện Tranh 18+, Truyện Tranh 18+ hay, doc Truyện Tranh 18+ hay',1),(13,'truyen-tranh-kiem-hiep','Truyện Tranh Kiếm Hiệp','Truyện Tranh Kiếm Hiệp hay cập nhật mỗi ngày','Truyện Tranh Kiếm Hiệp hay cập nhật mỗi ngày','Truyện Tranh Kiếm Hiệp hay cập nhật mỗi ngày',1);

/*Table structure for table `chaps` */

DROP TABLE IF EXISTS `chaps`;

CREATE TABLE `chaps` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chap_url` varchar(250) DEFAULT NULL,
  `seo_name` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `feature_image` varchar(200) DEFAULT NULL,
  `meta_keywords` varchar(250) DEFAULT NULL,
  `meta_description` varchar(250) DEFAULT NULL,
  `comic_id` bigint(20) DEFAULT NULL,
  `fetch_type` int(1) DEFAULT '1',
  `num_fetch` int(11) DEFAULT '0',
  `num_fetch_error` int(11) DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `last_grab_time` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`chap_url`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `chaps` */

/*Table structure for table `comics` */

DROP TABLE IF EXISTS `comics`;

CREATE TABLE `comics` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `comic_url` varchar(250) DEFAULT NULL,
  `source_id` bigint(20) DEFAULT NULL,
  `sid` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `seo_name` varchar(200) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `feature_image` varchar(200) DEFAULT NULL,
  `feature_image_src` varchar(250) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `description` text,
  `meta_keywords` varchar(250) DEFAULT NULL,
  `meta_description` varchar(250) DEFAULT NULL,
  `main_cat` bigint(20) DEFAULT NULL,
  `fetch_type` int(1) DEFAULT '1',
  `num_fetch` int(11) DEFAULT '0',
  `num_fetch_error` int(11) DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_chap_time` datetime DEFAULT NULL,
  `last_grab_time` datetime DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`comic_url`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `comics` */

/*Table structure for table `feed_comic` */

DROP TABLE IF EXISTS `feed_comic`;

CREATE TABLE `feed_comic` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `url` varchar(250) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `last_grab_time` datetime DEFAULT NULL,
  `type` int(1) DEFAULT '1',
  `num_fetch` int(11) DEFAULT '0',
  `num_fetch_error` int(11) DEFAULT '0',
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `feed_comic` */

insert  into `feed_comic`(`id`,`url`,`category_id`,`update_time`,`last_grab_time`,`type`,`num_fetch`,`num_fetch_error`,`status`) values (22,'http://truyen.vnsharing.net/TheLoai/Adult/MoiCapNhat',1,'2013-10-14 22:20:51','2013-10-20 04:23:24',1,1,0,1);

/*Table structure for table `history` */

DROP TABLE IF EXISTS `history`;

CREATE TABLE `history` (
  `url` varchar(250) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  `process_id` varchar(30) DEFAULT NULL,
  KEY `idx` (`url`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `history` */

/*Table structure for table `images` */

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chap_id` bigint(20) DEFAULT NULL,
  `alt` varchar(200) DEFAULT NULL,
  `src` varchar(300) DEFAULT NULL,
  `width` int(11) DEFAULT '0',
  `height` int(11) DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`src`,`chap_id`),
  KEY `idx` (`chap_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `images` */

/*Table structure for table `log` */

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `url` varchar(300) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  `err_type` int(2) DEFAULT NULL,
  `process_id` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `log` */

/*Table structure for table `sources` */

DROP TABLE IF EXISTS `sources`;

CREATE TABLE `sources` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `site_url` varchar(250) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `class_name` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `sources` */

insert  into `sources`(`id`,`name`,`url`,`site_url`,`description`,`class_name`,`status`) values (1,'Vui Truyện Tranh','vui-truyen-tranh','http://vuitruyentranh.vn',NULL,'Core_Content_VuiTruyenTranh',1),(2,'Truyện Tranh Hot','truyen-tranh-hot','http://truyentranhhot.net',NULL,'Core_Content_TruyenTranhHot',1),(3,'Truyện VnSharing','truyen-vnsharing','http://truyen.vnsharing.net',NULL,'Core_Content_VnSharing',1);

/*Table structure for table `test` */

DROP TABLE IF EXISTS `test`;

CREATE TABLE `test` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `data` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `test` */

insert  into `test`(`id`,`data`) values (4,'dddd'),(3,'dddd'),(5,'1212'),(6,'1212'),(7,'1212'),(8,'1212'),(9,'1212'),(10,'3456'),(11,'1212'),(12,'3456'),(13,'3456');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
