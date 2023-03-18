CREATE TABLE `mariadb_execution_time` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `seconds` float DEFAULT NULL,
  `ts` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
