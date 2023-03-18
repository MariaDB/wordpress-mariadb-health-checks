CREATE TABLE IF NOT EXISTS `%%VAR_PREFIX%%mariadb_versions` (
  `id` int(11) NOT NULL,
  `version` char(5) DEFAULT NULL,
  `eol` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) %%VAR_CHARACTER%%