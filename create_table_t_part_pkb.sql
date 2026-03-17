-- Create table t_part_pkb
-- This table stores the relationship between spareparts and PKB (Work Orders)

CREATE TABLE IF NOT EXISTS `t_part_pkb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_part` varchar(50) NOT NULL COMMENT 'Foreign key to t_part.id_part',
  `id_pkb` varchar(50) NOT NULL COMMENT 'Foreign key to t_pkb.id_pkb',
  `tgl_pkb` date DEFAULT NULL COMMENT 'PKB date from t_pkb',
  `harga_beli` double DEFAULT NULL COMMENT 'Purchase price per transaction',
  `harga_jual` double DEFAULT NULL COMMENT 'Selling price per transaction',
  PRIMARY KEY (`id`),
  KEY `idx_id_part` (`id_part`),
  KEY `idx_id_pkb` (`id_pkb`),
  KEY `idx_tgl_pkb` (`tgl_pkb`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Add constraints (optional - uncomment if you want foreign key constraints)
-- ALTER TABLE `t_part_pkb`
--   ADD CONSTRAINT `fk_part_pkb_part` FOREIGN KEY (`id_part`) REFERENCES `t_part` (`id_part`) ON DELETE CASCADE ON UPDATE CASCADE,
--   ADD CONSTRAINT `fk_part_pkb_pkb` FOREIGN KEY (`id_pkb`) REFERENCES `t_pkb` (`id_pkb`) ON DELETE CASCADE ON UPDATE CASCADE;
