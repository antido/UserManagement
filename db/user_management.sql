-- phpMyAdmin-compatible SQL export
-- Import this file in phpMyAdmin.
-- The script creates/selects the user_management database.
CREATE DATABASE IF NOT EXISTS `user_management`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE `user_management`;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `user_roles`;
DROP TABLE IF EXISTS `role_permissions`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `roles`;
DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,'index_user','2026-10-17 12:38:25','2026-10-17 12:38:25'),
(2,'view_user','2026-10-17 12:38:25','2026-10-17 12:38:25'),
(3,'create_user','2026-10-17 12:38:25','2026-10-17 12:38:25'),
(4,'edit_user','2026-10-17 12:38:25','2026-10-17 12:38:25'),
(5,'delete_user','2026-10-17 12:38:25','2026-10-17 12:38:25'),
(6,'index_role','2026-10-17 12:38:25','2026-10-17 12:38:25'),
(7,'view_role','2026-10-17 12:38:25','2026-10-17 12:38:25'),
(8,'create_role','2026-10-17 12:38:25','2026-10-17 12:38:25'),
(9,'edit_role','2026-10-17 12:38:25','2026-10-17 12:38:25'),
(10,'delete_role','2026-10-17 12:38:25','2026-10-17 12:38:25'),
(11,'index_permission','2026-10-17 12:38:25','2026-10-17 12:38:25'),
(12,'view_permission','2026-10-17 12:38:25','2026-10-17 12:38:25'),
(13,'create_permission','2026-10-17 12:38:25','2026-10-17 12:38:25'),
(14,'edit_permission','2026-10-17 12:38:25','2026-10-17 12:38:25'),
(15,'delete_permission','2026-10-17 12:38:25','2026-10-17 12:38:25');

CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,'Superadmin','2026-10-17 12:36:22','2026-10-17 12:36:22'),
(2,'Admin','2026-10-17 12:36:22','2026-10-17 12:36:22');

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `company` varchar(150) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `position` varchar(100) NOT NULL,
  `status` enum('Active','Deactivated') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email_address` (`email_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users`
(`id`, `username`, `email_address`, `password`, `first_name`, `middle_name`, `last_name`,
 `address`, `company`, `contact_no`, `position`, `status`, `created_at`, `updated_at`) VALUES
(1,'Superadmin','superadmin@example.com','$2y$12$fVAEgoSOPUh2jrywL7e5jOsnzlTCaiwNThXFeCqvW1UbeVvSANpau',
 'Juan','Santos','Cruz','Philippines','Test Company','09876543211','Super Admin','Active',
 '2026-10-17 12:32:27','2026-10-17 12:40:43');

CREATE TABLE `role_permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int DEFAULT NULL,
  `permission_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `permission_id` (`permission_id`),
  CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1,1,1,'2026-10-17 12:39:41','2026-10-17 12:39:41'),
(2,1,2,'2026-10-17 12:39:41','2026-10-17 12:39:41'),
(3,1,3,'2026-10-17 12:39:41','2026-10-17 12:39:41'),
(4,1,4,'2026-10-17 12:39:41','2026-10-17 12:39:41'),
(5,1,5,'2026-10-17 12:39:41','2026-10-17 12:39:41'),
(6,1,6,'2026-10-17 12:39:41','2026-10-17 12:39:41'),
(7,1,7,'2026-10-17 12:39:41','2026-10-17 12:39:41'),
(8,1,8,'2026-10-17 12:39:41','2026-10-17 12:39:41'),
(9,1,9,'2026-10-17 12:39:41','2026-10-17 12:39:41'),
(10,1,10,'2026-10-17 12:39:41','2026-10-17 12:39:41'),
(11,1,11,'2026-10-17 12:39:41','2026-10-17 12:39:41'),
(12,1,12,'2026-10-17 12:39:41','2026-10-17 12:39:41'),
(13,1,13,'2026-10-17 12:39:41','2026-10-17 12:39:41'),
(14,1,14,'2026-10-17 12:39:41','2026-10-17 12:39:41'),
(15,1,15,'2026-10-17 12:39:41','2026-10-17 12:39:41');

CREATE TABLE `user_roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `role_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_role` (`user_id`,`role_id`),
  KEY `fk_user_roles_role` (`role_id`),
  CONSTRAINT `fk_user_roles_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_user_roles_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1,1,1,'2026-10-17 12:39:49','2026-10-17 12:39:49');

SET FOREIGN_KEY_CHECKS = 1;
