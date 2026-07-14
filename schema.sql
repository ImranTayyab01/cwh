-- Database schema for the "Hacker's Throne" signup form (index.php).
-- Run once in phpMyAdmin or the MySQL shell:
--     mysql -u root -p < schema.sql

CREATE DATABASE IF NOT EXISTS `trip_us`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `trip_us`;

CREATE TABLE IF NOT EXISTS `trip` (
    `id`     INT AUTO_INCREMENT PRIMARY KEY,
    `name`   VARCHAR(100) NOT NULL,
    `age`    INT          NOT NULL,
    `gender` VARCHAR(50)      NULL,
    `email`  VARCHAR(150) NOT NULL,
    `phone`  VARCHAR(30)      NULL,
    `other`  TEXT             NULL,
    `dt`     TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
