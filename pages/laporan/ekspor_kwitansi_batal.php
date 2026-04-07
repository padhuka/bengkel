<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=reportkwitansibatal.xls");

// Tambahkan table
//include 'data.php';

?>
									      <?php
	            include_once '../../lib/config.php';
	            include_once '../../lib/fungsi.php';
	      $tgle = date('d/m/Y');
	            $jame = date('H:i:s');
	      ?>
	      <table width="100%" align="center" border="0">
	                                  <tr>
	                                    <td width="50%"><u style="font-size: 20px;"><strong>GEMILANG BODY & PAINT</strong><br>
	                                    </u>
	                                    Jl. Setia Budi No.152 <br>
	                                    Srondol Kulon Semarang
	                                    </td>
	                                    <td align="right">
	                                      Tanggal : <?php echo $tgle;?><br>
	                                      Jam : <?php echo $jame;?>
	                                    </td>
	                                  </tr>
	                                </table>
	                                    <span style="font-size: 20px;font-weight: bold;"><center>Laporan KWITANSI BATAL</center></span>
	                                     <span style="font-size: 20px;font-weight: bold;"><center> Per Tgl <?php echo date('d-m-Y' , strtotime($_GET['tgl1']));echo ' s/d '; echo date('d-m-Y' , strtotime($_GET['tgl2'])); ?></center></span>
	                                <br>
	      <table id="tablepkb1" class="table table-condensed table-bordered table-striped table-hover" style="text-transform: capitalize;">
	                <thead class="thead-light">
	                <tr>
	                          <th>No</th>
	                          <th>Tgl Kwitansi</th>
	                          <th>No. Kwitansi</th>
	                          <th>No. PKB</th>
	                          <th>No. Polisi</th>
	                          <th>Jenis Kend</th>
	                          <th>Nama Customer</th>
	                          <th>Total Gross Panel</th>
	                          <th>Total Gross Part</th>
	                          <th>Total Diskon Panel</th>
	                          <th>Total Diskon Part</th>
	                          <th>Total Netto Panel</th>
	                          <th>Total Netto Part</th>
	                          <th>Total PPN</th>
	                          <th>Total Kwitansi</th>
	                          <th>Materai</th>
	                          <th>Total Payment</th>
	                          <th>Keterangan Batal</th>
	                          <th>Tgl Batal</th>
	                </tr>
	                </thead>
	                <tbody>
	                <?php

	                                    $tgl1=$_GET['tgl1'];
	                                    $tgl2=$_GET['tgl2'];
	                                    $j=1;
	                                    $sqlcatat = "SELECT k.no_kwitansi, k.tgl_kwitansi, k.total_gross_panel, k.total_gross_part, k.total_diskon_panel, k.total_diskon_part, k.total_netto_panel, k.total_netto_part, k.total_ppn_kwitansi, k.total_kwitansi, k.materai, k.total_payment, k.keterangan_batal, k.tgl_batal, d.fk_no_polisi, d.id_pkb AS nopkb, c.nama AS nama_customer, g.nama as nmkendaraan from t_kwitansi k
	                                      INNER JOIN t_pkb d ON k.fk_pkb=d.id_pkb
	                                      INNER JOIN t_customer c ON d.fk_customer=c.id_customer
	                                      INNER JOIN t_inventory_bengkel f ON d.fk_no_chasis=f.no_chasis
	                                      INNER JOIN t_tipe_kendaraan g ON f.fk_tipe_kendaraan=g.id_tipe_kendaraan
	                                      WHERE k.tgl_batal<>'0000-00-00 00:00:00' AND substring(k.tgl_kwitansi,1,10)>='$tgl1' AND  substring(k.tgl_kwitansi,1,10)<='$tgl2'
	                                    ORDER BY k.no_kwitansi DESC";
                                   	$rescatat = mysqli_query($objConn,  $sqlcatat );
	                                    while($catat = mysqli_fetch_array( $rescatat )){
	                                ?>
	                        <tr>
	                          <th><?php echo $j++;?></th>
	                          <td><?php echo date('d-m-Y',strtotime($catat['tgl_kwitansi']));?></td>
	                          <td><?php echo ($catat['no_kwitansi']);?></td>
	                          <td><?php echo ($catat['nopkb']);?></td>
	                          <td><?php echo $catat['fk_no_polisi'];?></td>
	                          <td><?php echo $catat['nmkendaraan'];?></td>
	                          <td><?php echo $catat['nama_customer'];?></td>
	                          <td><?php echo $catat['total_gross_panel'];?></td>
	                          <td><?php echo $catat['total_gross_part'];?></td>
	                          <td><?php echo $catat['total_diskon_panel'];?></td>
	                          <td><?php echo $catat['total_diskon_part'];?></td>
	                          <td><?php echo $catat['total_netto_panel'];?></td>
	                          <td><?php echo $catat['total_netto_part'];?></td>
	                          <td><?php echo $catat['total_ppn_kwitansi'];?></td>
	                          <td><?php echo $catat['total_kwitansi'];?></td>
	                          <td><?php echo $catat['materai'];?></td>
	                          <td><?php echo $catat['total_payment'];?></td>
	                          <td><?php echo $catat['keterangan_batal'];?></td>
	                          <td><?php echo $catat['tgl_batal'] != '0000-00-00 00:00:00' ? date('d-m-Y H:i:s',strtotime($catat['tgl_batal'])) : '-';?></td>
	                        </tr>
	                    <?php }?>
	                </tfoot>
	              </table>
