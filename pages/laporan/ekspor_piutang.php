<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=reportpiutang.xls");
 
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
                                    <span style="font-size: 20px;font-weight: bold;"><center>Laporan Piutang</center></span>
                                    
                                <br>
      <table id="tablepkb1" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No.PKB</th>
                          <th>Tgl.PKB</th>
                          <th>Kategori</th>
                          <th>Asuransi</th>
                          <th>No.Kwitansi</th>
                          <th>Tgl.Kwitansi</th>
                          <th>Nama Customer</th>
                          <th>Piutang</th>
                </tr>
                </thead>
                <tbody>
                <?php
                                   //WHERE p.tgl_batal='0000-00-00 00:00:00' AND p.status_pkb='' AND substring(tgl,1,10)>='$tgl1' AND  substring(tgl,1,10)<='$tgl2' 
                                   //no pkb| tgl pkb | kategori | Asuransi | no kwitansi | tgl kwitansi | Nama customer | Piutang
                                    $tgl1=$_GET['tgl1'];
                                    $tgl2=$_GET['tgl2'];
                                    $j=1;
                                   // $jml=0;
                                    $sqlcatat = "SELECT * FROM (
                              SELECT p.id_pkb AS idpkb,p.tgl AS tglpkb, p.kategori AS kat, a.nama AS nmasuransi, k.no_kwitansi AS nokw, k.tgl_kwitansi AS tglkw, c.nama AS nmcus,
                                    k.total_payment AS total_bayar, titip_cash ,titip_bank,or_cash, or_bank, k.total_payment-(ifnull(titip_cash,0)+ifnull(titip_bank,0)+ifnull(or_cash,0)+ifnull(or_bank,0)) as piutang
                                    FROM t_pkb p
                                    LEFT JOIN t_customer c ON p.fk_customer=c.id_customer
                                    LEFT JOIN (SELECT * from t_kwitansi where tgl_batal='0000-00-00 00:00:00') as k ON p.id_pkb=k.fk_pkb
                                    LEFT JOIN (SELECT * from t_kwitansi_or where tgl_batal='0000-00-00 00:00:00') as kor ON p.fk_estimasi=kor.fk_estimasi
                                        LEFT JOIN (SELECT no_bukti, no_ref, sum(total) as titip_cash
                                        FROM t_cash  where tgl_batal='0000-00-00 00:00:00'
                                        GROUP BY no_ref) AS cash ON cash.no_ref=k.no_kwitansi                                     
                                        LEFT JOIN (SELECT no_bukti, no_ref, sum(total) as titip_bank
                                           FROM t_bank  where tgl_batal='0000-00-00 00:00:00'
                                        GROUP BY no_ref)AS bank ON bank.no_ref=k.no_kwitansi                                            
                                        LEFT JOIN (SELECT no_bukti, no_ref, sum(total) as or_cash
                                        FROM t_cash  where tgl_batal='0000-00-00 00:00:00'
                                        GROUP BY no_ref) AS orcash ON orcash.no_ref=kor.no_kwitansi_or                                
                                        LEFT JOIN (SELECT no_bukti, no_ref, sum(total) as or_bank
                                           FROM t_bank    where tgl_batal='0000-00-00 00:00:00'
                                        GROUP BY no_ref)AS orbank ON orbank.no_ref=kor.no_kwitansi_or                                 
                                        LEFT JOIN t_asuransi a ON p.fk_asuransi=a.id_asuransi
                                        WHERE p.tgl_batal='0000-00-00 00:00:00'
                                        ) as AR where AR.piutang > 0.9";
                                   	$rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){  
                                                              
                                ?>
                        <tr>
                          <td><?php echo ($catat['idpkb']);?></td>     
                          <td ><?php echo date('d-m-Y' , strtotime($catat['tglpkb']));?></td>     
                          <td ><?php echo $catat['kat'];?></td>
                          <td ><?php echo $catat['nmasuransi'];?></td>
                          <td ><?php echo $catat['nokw'];?></td>
                          <td ><?php echo date('d-m-Y' , strtotime($catat['tglkw']));?></td>
                          <td ><?php echo $catat['nmcus'];?></td>
                          <td ><?php echo rupiah2($catat['piutang']);?></td>
                        </tr>
                    <?php }
                  ?>
                </tfoot>
              </table>
              <table>
                
              </table>