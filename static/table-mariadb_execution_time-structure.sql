CREATE TABLE IF NOT EXISTS `%%VAR_PREFIX%%mariadb_execution_time` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `seconds` float DEFAULT NULL,
  `ts` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) %%VAR_CHARACTER%%