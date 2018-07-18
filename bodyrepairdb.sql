# Host: localhost:3356  (Version 5.5.5-10.1.28-MariaDB)
# Date: 2018-07-18 14:18:38
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "t_asuransi"
#

DROP TABLE IF EXISTS `t_asuransi`;
CREATE TABLE `t_asuransi` (
  `id_asuransi` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `npwp` varchar(50) NOT NULL,
  PRIMARY KEY (`id_asuransi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_asuransi"
#

INSERT INTO `t_asuransi` VALUES ('1','24','255','4w','556');

#
# Structure for table "t_customer"
#

DROP TABLE IF EXISTS `t_customer`;
CREATE TABLE `t_customer` (
  `id_customer` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_customer"
#


#
# Structure for table "t_estimasi"
#

DROP TABLE IF EXISTS `t_estimasi`;
CREATE TABLE `t_estimasi` (
  `id_estimasi` varchar(50) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kategori` varchar(10) NOT NULL,
  `fk_no_chasis` varchar(50) NOT NULL,
  `fk_no_mesin` varchar(50) NOT NULL,
  `fk_no_polisi` varchar(50) NOT NULL,
  `fk_customer` varchar(50) NOT NULL,
  `fk_asuransi` varchar(50) NOT NULL,
  `km_masuk` varchar(50) NOT NULL,
  `fk_user` varchar(50) NOT NULL,
  `total_gross_harga_panel` double NOT NULL,
  `total_diskon_rupiah_panel` double NOT NULL,
  `total_netto_harga_panel` double NOT NULL,
  `total_gross_harga_part` double NOT NULL,
  `total_diskon_rupiah_part` double NOT NULL,
  `total_netto_harga_part` double NOT NULL,
  `total_gross_harga_jasa` double NOT NULL,
  `total_diskon_rupiah_jasa` double NOT NULL,
  `total_netto_harga_jasa` double NOT NULL,
  PRIMARY KEY (`id_estimasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_estimasi"
#


#
# Structure for table "t_estimasi_detail"
#

DROP TABLE IF EXISTS `t_estimasi_detail`;
CREATE TABLE `t_estimasi_detail` (
  `id` int(10) NOT NULL,
  `fk_estimasi` varchar(50) NOT NULL,
  `fk_part` varchar(50) NOT NULL,
  `qty_part` varchar(50) NOT NULL,
  `diskon_part` float NOT NULL,
  `harga_satuan_part` double NOT NULL,
  `harga_estimasi_part` double NOT NULL,
  `fk_panel` varchar(50) NOT NULL,
  `diskon_panel` float NOT NULL,
  `harga_panel` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_estimasi_detail"
#


#
# Structure for table "t_group_kendaraan"
#

DROP TABLE IF EXISTS `t_group_kendaraan`;
CREATE TABLE `t_group_kendaraan` (
  `id_group_kendaraan` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id_group_kendaraan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_group_kendaraan"
#


#
# Structure for table "t_inventory_bengkel"
#

DROP TABLE IF EXISTS `t_inventory_bengkel`;
CREATE TABLE `t_inventory_bengkel` (
  `no_chasis` varchar(50) NOT NULL,
  `no_mesin` varchar(50) NOT NULL,
  `no_polisi` varchar(10) NOT NULL,
  `fk_tipe_kendaraan` varchar(50) NOT NULL,
  `fk_warna_kendaraan` varchar(50) NOT NULL,
  `fk_customer` varchar(50) NOT NULL,
  `nama_stnk` varchar(50) NOT NULL,
  `alamat_stnk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_inventory_bengkel"
#


#
# Structure for table "t_panel"
#

DROP TABLE IF EXISTS `t_panel`;
CREATE TABLE `t_panel` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `harga_pokok` double NOT NULL,
  `harga_jual` double NOT NULL,
  `diskon` float NOT NULL,
  `ppn` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_panel"
#


#
# Structure for table "t_part"
#

DROP TABLE IF EXISTS `t_part`;
CREATE TABLE `t_part` (
  `id_part` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `fk_satuan` varchar(50) NOT NULL,
  `harga_beli` double NOT NULL,
  `harga_jual` double NOT NULL,
  `diskon` float NOT NULL,
  `ppn` float NOT NULL,
  `stock` int(11) NOT NULL,
  `fk_supplier` varchar(50) NOT NULL,
  `tgl_masuk` datetime NOT NULL,
  PRIMARY KEY (`id_part`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_part"
#


#
# Structure for table "t_pkb"
#

DROP TABLE IF EXISTS `t_pkb`;
CREATE TABLE `t_pkb` (
  `id_pkb` varchar(50) NOT NULL,
  `tgl` datetime NOT NULL,
  `fk_estimasi` varchar(50) NOT NULL,
  `kategori` varchar(10) NOT NULL,
  `fk_no_chasis` varchar(50) NOT NULL,
  `fk_no_mesin` varchar(50) NOT NULL,
  `fk_no_polisi` varchar(50) NOT NULL,
  `fk_customer` varchar(50) NOT NULL,
  `fk_asuransi` varchar(50) NOT NULL,
  `total_harga_gross_part` double NOT NULL,
  `total_diskon_rupiah_part` double NOT NULL,
  `total_harga_netto_part` double NOT NULL,
  `total_harga_gross_panel` double NOT NULL,
  `total_diskon_rupiah_panel` double NOT NULL,
  `total_harga_netto_panel` double NOT NULL,
  `total_harga_gross_jasa` double NOT NULL,
  `total_diskon_rupiah_jasa` double NOT NULL,
  `total_harga_netto_jasa` double NOT NULL,
  PRIMARY KEY (`id_pkb`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_pkb"
#


#
# Structure for table "t_pkb_detail"
#

DROP TABLE IF EXISTS `t_pkb_detail`;
CREATE TABLE `t_pkb_detail` (
  `id` int(11) NOT NULL,
  `fk_pkb` varchar(50) NOT NULL,
  `fk_part` varchar(50) NOT NULL,
  `qty_part` int(11) NOT NULL,
  `diskon_part` float NOT NULL,
  `harga_satuan_part` double NOT NULL,
  `harga_estimasi_part` double NOT NULL,
  `fk_panel` varchar(50) NOT NULL,
  `diskon_panel` float NOT NULL,
  `harga_panel` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_pkb_detail"
#


#
# Structure for table "t_satuan"
#

DROP TABLE IF EXISTS `t_satuan`;
CREATE TABLE `t_satuan` (
  `id_satuan` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_satuan"
#


#
# Structure for table "t_status_pkb"
#

DROP TABLE IF EXISTS `t_status_pkb`;
CREATE TABLE `t_status_pkb` (
  `fk_pkb` varchar(50) NOT NULL,
  `tgl` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_status_pkb"
#


#
# Structure for table "t_supplier"
#

DROP TABLE IF EXISTS `t_supplier`;
CREATE TABLE `t_supplier` (
  `id_supplier` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `npwp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_supplier"
#


#
# Structure for table "t_tipe_kendaraan"
#

DROP TABLE IF EXISTS `t_tipe_kendaraan`;
CREATE TABLE `t_tipe_kendaraan` (
  `id_tipe_kendaraan` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `fk_group_kendaraan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipe_kendaraan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_tipe_kendaraan"
#


#
# Structure for table "t_user"
#

DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL DEFAULT '',
  `nama` varchar(50) NOT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `level` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "t_user"
#

INSERT INTO `t_user` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','danang','111','Admin');

#
# Structure for table "t_warna_kendaraan"
#

DROP TABLE IF EXISTS `t_warna_kendaraan`;
CREATE TABLE `t_warna_kendaraan` (
  `id_warna_kendaraan` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "t_warna_kendaraan"
#

