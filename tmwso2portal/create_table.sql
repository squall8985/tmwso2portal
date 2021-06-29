-- -------------------------------------------------------------
-- TablePlus 4.0.0(370)
--
-- https://tableplus.com/
--
-- Database: tmportal
-- Generation Time: 2021-06-28 21:59:04.8270
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `SP_USERS` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role_dashboard` tinyint(1) NOT NULL DEFAULT '0',
  `role_business_event` tinyint(1) NOT NULL DEFAULT '0',
  `role_online` tinyint(1) NOT NULL DEFAULT '0',
  `role_batch` tinyint(1) NOT NULL DEFAULT '0',
  `role_sms` tinyint(1) NOT NULL DEFAULT '0',
  `role_query` tinyint(1) NOT NULL DEFAULT '0',
  `role_user_management` tinyint(1) NOT NULL DEFAULT '0',
  `created_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `last_login_timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `special` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

INSERT INTO `SP_USERS` (`id`, `username`, `password`, `name`, `role_dashboard`, `role_business_event`, `role_online`, `role_batch`, `role_sms`, `role_query`, `role_user_management`, `created_timestamp`, `updated_timestamp`, `status`, `last_login_timestamp`) VALUES
(1, 'mohd.hafifi@vtcholding.com', 'Def123456&', 'Hafidz', 1, 1, 1, 0, 1, 1, 1, '2021-06-11 21:04:05', '2021-06-17 22:58:42', 1, '2021-06-17 22:58:42');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
