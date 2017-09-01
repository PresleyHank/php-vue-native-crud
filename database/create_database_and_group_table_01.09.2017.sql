CREATE DATABASE IF NOT EXISTS `php_vuejs2_native_crud`;
USE `php_vuejs2_native_crud`;

CREATE TABLE IF NOT EXISTS `user` (
  `id`       BIGINT(20)   NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `email`    VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `active`   TINYINT(1)   NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `group` (
  `id`        BIGINT(20)   NOT NULL AUTO_INCREMENT,
  `id_user`   BIGINT(20)   NOT NULL,
  `title`     VARCHAR(255) NOT NULL,
  `imageLink` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
