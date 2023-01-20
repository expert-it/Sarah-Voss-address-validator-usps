-- Adminer 4.8.1 MySQL 8.0.31-0ubuntu0.20.04.2 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;

SET NAMES utf8mb4;

CREATE DATABASE `address_validator` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `address_validator`;

CREATE TABLE `validated_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `address1` varchar(299) NOT NULL,
  `address2` varchar(299) NOT NULL,
  `city` varchar(99) NOT NULL,
  `state` varchar(199) NOT NULL,
  `zipcode` varchar(99) NOT NULL,
  `address_type` enum('original','formatted') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `response` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- 2023-01-20 07:24:08
