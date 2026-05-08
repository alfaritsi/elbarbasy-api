-- Adminer 5.4.2 MariaDB 10.4.28-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

-- Cannot proceed, because event scheduler is disabled
SET NAMES utf8mb4;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `products` (`id`, `name`, `price`, `created_at`, `deleted_at`, `photo`) VALUES
(2,	'laptop update',	99,	'2026-04-29 13:46:43',	'2026-04-30 06:05:50',	'41036e5836014ddd8c11104f13c9cefa.jpg'),
(3,	'laptop update',	99999,	'2026-04-29 14:01:06',	NULL,	'553920e5e841c32f8150df2ed0db82ae.jpg'),
(9,	'laptop',	3000,	'2026-04-30 09:40:56',	NULL,	'd604f917516bf416cbcfc73680e9c0a2.jpg'),
(10,	'laptop',	3000,	'2026-04-30 10:04:45',	NULL,	'861e5216e5ba9e3711f004b000cb0f9c.jpg'),
(11,	'laptop',	3000,	'2026-04-30 10:04:47',	NULL,	'29f60da6c4edb5af35faecf526a7a8cd.jpg'),
(12,	'laptop',	3000,	'2026-04-30 10:04:49',	NULL,	'6307dbd439907431aa447b140d9b75fb.jpg'),
(13,	'laptop2',	3000,	'2026-04-30 10:12:40',	NULL,	'7002ef579d18403330135fe3a6fc6bdc.jpg'),
(14,	'laptop2',	3000,	'2026-04-30 12:15:18',	NULL,	'c04bd896e079e6453a1e8f46dbeb0099.jpg'),
(15,	'laptop2',	3000,	'2026-04-30 12:15:20',	NULL,	'c25bcd6f426f9f5358d557c25d52bd78.jpg'),
(16,	'laptop2',	3000,	'2026-04-30 12:15:21',	NULL,	'e22000d7acc7592e65f5e6763fcb4fa6.jpg'),
(17,	'laptop2',	3000,	'2026-04-30 12:15:22',	NULL,	'76233a5e2d6c36755a82f495e979296c.jpg'),
(18,	'laptop2',	3000,	'2026-04-30 12:15:23',	NULL,	'5969e35841b1a33329577bf718f304f3.jpg'),
(19,	'laptop2',	3000,	'2026-04-30 12:15:24',	NULL,	'1cde0f167fe30886f1c7eab4f44f007b.jpg'),
(20,	'laptop2',	3000,	'2026-04-30 12:15:25',	NULL,	'4fdc0a43e7d0fe40f7664b4f533a6966.jpg'),
(21,	'laptop2',	3000,	'2026-04-30 12:15:26',	'2026-04-30 08:21:31',	'3d296d5faa2f05078a51420aac2d43eb.jpg'),
(22,	'laptop2',	3000,	'2026-04-30 12:15:27',	'2026-04-30 08:21:30',	'bed50ef567847722ee383b87114b2362.jpg'),
(23,	'laptop2',	3000,	'2026-04-30 12:15:28',	'2026-04-30 08:21:25',	'0e17cb77c0fb7db1f536405c5915b52f.jpg');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1,	'Lukman',	'lukman@mail.com',	'$2y$10$jrwj.f8Ih5N213eimPzQieBygearN1eWtwoN4c2xfhvDXTb7.lt2e',	'2026-04-29 13:10:21'),
(2,	'Lukman',	'lukmann@mail.com',	'$2y$10$ipoVkzbpm5rmR9.xSpiUx.tzFkcNHSqRgx4BN2rTob/mI20aZdnYa',	'2026-04-29 14:14:10'),
(4,	'Lukman',	'lukmannn@mail.com',	'$2y$10$XtlnGR84FcKVMF3H5gsNxejoOZDTS7pRd92HfyhfTxUxqvTKO2YG.',	'2026-04-30 05:51:27'),
(5,	'Lukman',	'lukman1@mail.com',	'$2y$10$IV/4/FExcamYI2G1Ktx7yusUzPD0BnHvEdik5ExAU6/L5j2o03Ht6',	'2026-04-30 08:09:32'),
(6,	'Lukman',	'lukman11@mail.com',	'$2y$10$jvy4l3iAaytPqfQcUeV6jeoWWxXIxFhP26pgCJKkehx.riAbo36Iq',	'2026-04-30 08:44:52'),
(7,	'Lukman',	'lukman11l@mail.com',	'$2y$10$H2niYrRN5aA1BEBIb7gRT.8UizApA3PduMxCKIjMlQlqGe3QqOZbS',	'2026-04-30 09:23:24'),
(8,	'test',	'test@test.test',	'$2y$10$z.mfjPemrJUEZLCAsBRukeFUN2sec34fAeb8JvKUEyQWS5BwplGyK',	'2026-04-30 11:50:37');

-- 2026-05-05 21:35:23 UTC
