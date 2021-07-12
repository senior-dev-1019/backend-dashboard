/*
SQLyog Enterprise v12.5.1 (64 bit)
MySQL - 10.1.40-MariaDB : Database - lutz
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lutz` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `lutz`;

/*Table structure for table `coupons` */

DROP TABLE IF EXISTS `coupons`;

CREATE TABLE `coupons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `coupons` */

insert  into `coupons`(`id`,`code`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'123456',NULL,NULL,NULL);

/*Table structure for table `documents` */

DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) unsigned DEFAULT NULL,
  `coupon_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage_file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder_id` bigint(20) unsigned DEFAULT NULL,
  `is_provision` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_patient_id_foreign` (`patient_id`),
  KEY `documents_coupon_id_foreign` (`coupon_id`),
  KEY `documents_folder_id_foreign` (`folder_id`),
  CONSTRAINT `documents_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `documents_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `documents_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `documents` */

insert  into `documents`(`id`,`patient_id`,`coupon_id`,`title`,`file_name`,`storage_file_name`,`folder_id`,`is_provision`,`deleted_at`,`created_at`,`updated_at`) values 
(2,1,1,'document title','document file name 1','storage fiel name 1',1,0,NULL,NULL,NULL);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `folders` */

DROP TABLE IF EXISTS `folders`;

CREATE TABLE `folders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `folders` */

insert  into `folders`(`id`,`name`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'folder 1',NULL,NULL,NULL);

/*Table structure for table `institutions` */

DROP TABLE IF EXISTS `institutions`;

CREATE TABLE `institutions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `institutions` */

insert  into `institutions`(`id`,`name`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'institution 1',NULL,NULL,NULL),
(2,'institution 2',NULL,NULL,NULL);

/*Table structure for table `invoice_lines` */

DROP TABLE IF EXISTS `invoice_lines`;

CREATE TABLE `invoice_lines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) unsigned DEFAULT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_lines_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `invoice_lines_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `invoice_lines` */

insert  into `invoice_lines`(`id`,`invoice_id`,`text`,`amount`,`deleted_at`,`created_at`,`updated_at`) values 
(1,2,'invoice text',100.00,NULL,NULL,NULL);

/*Table structure for table `invoices` */

DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `payment_date` date NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `status` enum('open','paid','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_user_id_foreign` (`user_id`),
  CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `invoices` */

insert  into `invoices`(`id`,`user_id`,`invoice_date`,`payment_date`,`amount`,`status`,`deleted_at`,`created_at`,`updated_at`) values 
(2,3,'2020-04-23','2020-04-23',100.00,'open',NULL,NULL,NULL);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2019_08_19_000000_create_failed_jobs_table',1),
(3,'2020_04_22_104517_create_subscriptions_table',1),
(4,'2020_04_22_104831_create_patients_table',1),
(5,'2020_04_22_112306_create_user_patient_table',1),
(6,'2020_04_22_112435_create_institutions_table',1),
(7,'2020_04_22_112538_create_timeline_items_table',1),
(8,'2020_04_22_114906_create_folders_table',1),
(9,'2020_04_22_114942_create_documents_table',1),
(10,'2020_04_22_115116_create_coupons_table',1),
(11,'2020_04_22_115156_create_invoices_table',1),
(12,'2020_04_22_115219_create_invoice_lines_table',1),
(13,'2020_04_22_120128_change_foreignkey_users_table',1),
(14,'2020_04_22_120340_change_foreignkey_patients_table',1),
(15,'2020_04_22_120835_change_foreignkey_timeline_items_table',1),
(16,'2020_04_22_121022_change_foreignkey_documents_table',1),
(17,'2020_04_22_121859_change_foreignkey_invoices_table',1),
(18,'2020_04_22_122018_change_foreignkey_invoice_lines_table',1),
(19,'2020_04_22_122946_change_foreignkey_user_patient_table',1);

/*Table structure for table `patients` */

DROP TABLE IF EXISTS `patients`;

CREATE TABLE `patients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `patient_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institution_id` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patients_institution_id_foreign` (`institution_id`),
  CONSTRAINT `patients_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `patients` */

insert  into `patients`(`id`,`name`,`date_of_birth`,`patient_number`,`institution_id`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'patient 1','2020-04-23','1',1,NULL,NULL,NULL);

/*Table structure for table `subscriptions` */

DROP TABLE IF EXISTS `subscriptions`;

CREATE TABLE `subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `monthly_price` decimal(8,2) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(4000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_timeline` tinyint(1) NOT NULL,
  `has_documents` tinyint(1) NOT NULL,
  `has_institution` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `subscriptions` */

insert  into `subscriptions`(`id`,`monthly_price`,`title`,`description`,`has_timeline`,`has_documents`,`has_institution`,`deleted_at`,`created_at`,`updated_at`) values 
(1,111.55,'test subscription','test sub',0,0,0,NULL,NULL,NULL);

/*Table structure for table `timeline_items` */

DROP TABLE IF EXISTS `timeline_items`;

CREATE TABLE `timeline_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint(20) unsigned DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `timeline_items_patient_id_foreign` (`patient_id`),
  CONSTRAINT `timeline_items_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `timeline_items` */

insert  into `timeline_items`(`id`,`patient_id`,`type`,`data`,`deleted_at`,`created_at`,`updated_at`) values 
(1,1,'ttt','test',NULL,NULL,NULL);

/*Table structure for table `user_patient` */

DROP TABLE IF EXISTS `user_patient`;

CREATE TABLE `user_patient` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `patient_id` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_patient_user_id_foreign` (`user_id`),
  KEY `user_patient_patient_id_foreign` (`patient_id`),
  CONSTRAINT `user_patient_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_patient_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_patient` */

insert  into `user_patient`(`id`,`user_id`,`patient_id`,`deleted_at`,`created_at`,`updated_at`) values 
(1,3,1,NULL,NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_locked` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `subscription_id` bigint(20) unsigned DEFAULT NULL,
  `subscribed_until` date NOT NULL,
  `reminder_sent` date NOT NULL,
  `must_change_password` tinyint(1) NOT NULL,
  `institution_id` bigint(20) unsigned DEFAULT NULL,
  `may_edit_patients` tinyint(1) NOT NULL,
  `may_edit_employees` tinyint(1) NOT NULL,
  `is_institution_admin` tinyint(1) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_subscription_id_foreign` (`subscription_id`),
  KEY `users_institution_id_foreign` (`institution_id`),
  CONSTRAINT `users_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`password`,`email`,`address`,`postcode`,`city`,`mobile`,`is_locked`,`is_admin`,`subscription_id`,`subscribed_until`,`reminder_sent`,`must_change_password`,`institution_id`,`may_edit_patients`,`may_edit_employees`,`is_institution_admin`,`email_verified_at`,`remember_token`,`deleted_at`,`created_at`,`updated_at`) values 
(3,'admin','$2y$10$t4PuOcJpwC8Ae89Qk31HIu/VlFvr6AjInFXJeLh8AUNBnyOTb36w6','admin@admin.com','admin address','1234','city','123123123123',0,1,1,'2020-04-23','2020-04-23',0,1,0,0,0,NULL,'KdIqJsdly9VWcTzoEceTQrNTLJtlBcdVuyNnm4QuQ3a1hpcO7A8v9oK0KmOm',NULL,'2020-04-23 07:42:24','2020-04-23 07:42:24'),
(4,'user1','$2y$10$t4PuOcJpwC8Ae89Qk31HIu/VlFvr6AjInFXJeLh8AUNBnyOTb36w6','user1@gmail.com','user address','1234','user city','123123123123',0,0,1,'2020-04-23','2020-04-23',0,1,0,0,0,NULL,NULL,NULL,'2020-04-23 10:48:14','2020-04-23 10:48:14'),
(5,'user2','$2y$10$t4PuOcJpwC8Ae89Qk31HIu/VlFvr6AjInFXJeLh8AUNBnyOTb36w6','user2@gmail.com','user2 address','1234','user city 2','123123123123',0,0,1,'2020-04-23','2020-04-23',0,1,0,0,0,NULL,NULL,NULL,'2020-04-23 10:48:39','2020-04-23 10:48:39');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
