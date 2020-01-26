CREATE TABLE `cities` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `lat` DECIMAL(10,8) NOT NULL,
  `lon` DECIMAL(11,8) NOT NULL,
  `create_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`));