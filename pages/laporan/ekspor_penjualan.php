<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=reportpenjualan.xls");
 
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
                                    <span style="font-size: 20px;font-weight: bold;"><center>Laporan Penjualan </center></span>
                                     <span style="font-size: 20px;font-weight: bold;"><center> Per Tgl <?php echo date('d-m-Y' , strtotime($_GET['tgl1']));echo ' s/d '; echo date('d-m-Y' , strtotime($_GET['tgl2'])); ?></center></span>
                                <br>
      <table id="tablepkb1" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No</th>
                          <th>Tgl Kwitansi</th>
                          <th>No. Invoice</th>
                          <th>No. PKB</th>
                          <th>No. Polisi</th>
                          <th>No. Chasis</th>
                          <th>Jenis Kendaraan</th>
                          <th>Kategori</th>
                          <th>Asuransi</th>
                          <th>Customer</th>
                          <th>Gatepass</th>
                          <th>Gross Panel</th>
                          <th>Discount Panel</th>
                          <th>Net Panel</th>
                          <th>Gross Part</th>
                          <th>Discount Part</th>
                          <th>Net Part</th>
                          <th>DPP</th>
                          <th>PPN</th>
                          <th>Jumlah</th>

                </tr>
                </thead>
                <tbody>
                <?php
                                   //WHERE p.tgl_batal='0000-00-00 00:00:00' AND p.status_pkb='' AND substring(tgl,1,10)>='$tgl1' AND  substring(tgl,1,10)<='$tgl2' 
                                   
                                    $tgl1=$_GET['tgl1'];
                                    $tgl2=$_GET['tgl2'];
                                    $j=1;
                                    $jml=0;
                                    $sqlcatat = " SELECT  k.tgl_kwitansi as tgl,k.no_kwitansi,k.fk_pkb as no_pkb,p.fk_no_polisi as no_polisi
                                      ,p.fk_no_chasis as no_chasis,t.nama as jenis_kendaraan,p.kategori as kategori, a.nama as asuransi,c.nama as customer,
                                      p.total_gross_harga_panel as gross_panel,
                                      p.total_diskon_rupiah_panel as discount_panel,
                                      p.total_netto_harga_panel as net_panel,
                                      p.total_gross_harga_part as gross_part,
                                      p.total_diskon_rupiah_part as discount_part,
                                      p.total_netto_harga_part as net_part,
                                      k.total_kwitansi as dpp,k.total_ppn_kwitansi as ppn,
                                      k.total_payment as jumlah,
                                      gt.no_gate_pass as nogate
                                    from t_kwitansi k 
                                    left join (select * from t_pkb where tgl_batal='0000-00-00 00:00:00') as p on k.fk_pkb=p.id_pkb 
                                    left join t_customer c on p.fk_customer=c.id_customer
                                    left join t_inventory_bengkel i on p.fk_no_chasis=i.no_chasis
                                    left join t_tipe_kendaraan t on i.fk_tipe_kendaraan=t.id_tipe_kendaraan
                                    left join t_asuransi a on p.fk_asuransi=a.id_asuransi
                                    left join (select * from t_gate_pass
                                     WHERE no_gate_pass IN (SELECT MAX(no_gate_pass)
                                        FROM t_gate_pass
                                        GROUP BY fk_pkb)) as gt on k.fk_pkb=gt.fk_pkb
                                    where k.tgl_batal='0000-00-00 00:00:00' AND substring(k.tgl_kwitansi,1,10)>='$tgl1' AND substring(k.tgl_kwitansi,1,10)<='$tgl2'
                                    ORDER BY tgl ASC";
                                   	$rescatat = mysql_query( $sqlcatat );
                                    //echo $sqlcatat;
                                    while($catat = mysql_fetch_array( $rescatat )){
                                        $jml=$jml+$catat['jumlah'];  
                                ?>
                        <tr>
                          <th><?php echo $j++;?></th>                 
                          <td><?php echo date('d-m-Y',str_replace('/', '-', strtotime($catat['tgl'])));?></td>
                          <td><?php echo $catat['no_kwitansi'];?></td>
                          <td><?php echo $catat['no_pkb'];?></td>                          
                          <td><?php echo $catat['no_polisi'];?></td>
                          <td><?php echo $catat['no_chasis'];?></td>
                          <td><?php echo $catat['jenis_kendaraan'];?></td>
                          <td><?php echo $catat['kategori'];?></td>
                          <td><?php echo $catat['asuransi'];?></td>
                          <td><?php echo $catat['customer'];?></td>
                          <td><?php echo $catat['nogate'];?></td>
                          <td><?php echo rupiah2($catat['gross_panel']);?></td>
                          <td><?php echo rupiah2($catat['discount_panel']);?></td>
                          <td><?php echo rupiah2($catat['net_panel']);?></td>
                          <td><?php echo rupiah2($catat['gross_part']);?></td>
                          <td><?php echo rupiah2($catat['discount_part']);?></td> 
                          <td><?php echo rupiah2($catat['net_part']);?></td>
                          <td><?php echo rupiah2($catat['dpp']);?></td>
                          <td><?php echo rupiah2($catat['ppn']);?></td>
                          <td><?php echo rupiah2($catat['jumlah']);?></td>   
                        </tr>
                    <?php }?>
                    <tr><td colspan="18" align="right">Total</td><td><?php echo rupiah2($jml);?></td></tr>
                </tfoot>
              </table>