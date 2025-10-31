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
                                      Tanggal :                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php echo $tgle; ?><br>
                                      Jam :                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php echo $jame; ?>
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
                          <th>Total Invoice</th>
                          <th>Total Bayar</th>
                          <th>OR Cash</th>
                          <th>OR Bank</th>
                          <th>Piutang</th>
                          <th>Umur Piutang</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    //WHERE p.tgl_batal='0000-00-00 00:00:00' AND p.status_pkb='' AND substring(tgl,1,10)>='$tgl1' AND  substring(tgl,1,10)<='$tgl2'
                    //no pkb| tgl pkb | kategori | Asuransi | no kwitansi | tgl kwitansi | Nama customer | Piutang
                    // Hitung umur piutang (selisih hari dari tanggal kwitansi ke hari ini)
                    // $today        = new DateTime();
                    // $tgl_kwitansi = new DateTime($tglkw);
                    // $umur_piutang = $tgl_kwitansi->diff($today)->days;

                    $tgl1 = $_GET['tgl1'];
                    $tgl2 = $_GET['tgl2'];
                    $j    = 1;
                    // $jml=0;
                    // $sqlcatat = "SELECT * FROM (
                    //           SELECT p.id_pkb AS idpkb,p.tgl AS tglpkb, p.kategori AS kat, a.nama AS nmasuransi, k.no_kwitansi AS nokw, k.tgl_kwitansi AS tglkw, c.nama AS nmcus,
                    //                 k.total_payment AS total_bayar, titip_cash ,titip_bank,titip_bank2,or_cash, or_bank, k.total_payment-(ifnull(titip_cash,0)+ifnull(titip_bank,0)+ifnull(titip_bank2,0)+ifnull(or_cash,0)+ifnull(or_bank,0)) as piutang
                    //                 FROM t_pkb p
                    //                 LEFT JOIN t_customer c ON p.fk_customer=c.id_customer
                    //                 LEFT JOIN (SELECT * from t_kwitansi where tgl_batal='0000-00-00 00:00:00') as k ON p.id_pkb=k.fk_pkb
                    //                 LEFT JOIN (SELECT * from t_kwitansi_or where tgl_batal='0000-00-00 00:00:00') as kor ON p.fk_estimasi=kor.fk_estimasi
                    //                     LEFT JOIN (SELECT no_bukti, no_ref, sum(total) as titip_cash
                    //                     FROM t_cash  where tgl_batal='0000-00-00 00:00:00'
                    //                     GROUP BY no_ref) AS cash ON cash.no_ref=k.no_kwitansi
                    //                     LEFT JOIN (SELECT no_bukti, no_ref, sum(total) as titip_bank
                    //                        FROM t_bank  where tgl_batal='0000-00-00 00:00:00'
                    //                     GROUP BY no_ref)AS bank ON bank.no_ref=k.no_kwitansi
                    //                      LEFT JOIN (SELECT no_bukti, no_ref, sum(total) as titip_bank2
                    //                        FROM t_bank  where tgl_batal='0000-00-00 00:00:00'
                    //                     GROUP BY no_ref)AS bank2 ON bank2.no_ref=k.fk_pkb
                    //                     LEFT JOIN (SELECT no_bukti, no_ref, sum(total) as or_cash
                    //                     FROM t_cash  where tgl_batal='0000-00-00 00:00:00'
                    //                     GROUP BY no_ref) AS orcash ON orcash.no_ref=kor.no_kwitansi_or
                    //                     LEFT JOIN (SELECT no_bukti, no_ref, sum(total) as or_bank
                    //                        FROM t_bank    where tgl_batal='0000-00-00 00:00:00'
                    //                     GROUP BY no_ref)AS orbank ON orbank.no_ref=kor.no_kwitansi_or
                    //                     LEFT JOIN t_asuransi a ON p.fk_asuransi=a.id_asuransi
                    //                     WHERE p.tgl_batal='0000-00-00 00:00:00') as AR where AR.piutang > 0.9";
                    $sqlcatat ="SELECT
                        p.id_pkb AS idpkb,
                        p.tgl AS tglpkb,
                        p.kategori AS kat,
                        a.nama AS nmasuransi,
                        k.no_kwitansi AS nokw,
                        k.tgl_kwitansi AS tglkw,
                        c.nama AS nmcus,
                        k.total_payment AS total_bayar,
                        cash_sum.titip_cash,
                        bank_sum.titip_bank,
                        bank_sum2.titip_bank2,
                        or_cash_sum.or_cash,
                        or_bank_sum.or_bank,
                        k.total_payment - (
                            COALESCE(cash_sum.titip_cash,0)
                            + COALESCE(bank_sum.titip_bank,0)
                            + COALESCE(bank_sum2.titip_bank2,0)
                            + COALESCE(or_cash_sum.or_cash,0)
                            + COALESCE(or_bank_sum.or_bank,0)
                        ) AS piutang
                    FROM t_pkb p
                    LEFT JOIN t_customer c 
                        ON p.fk_customer = c.id_customer
                    LEFT JOIN t_kwitansi k 
                        ON p.id_pkb = k.fk_pkb 
                        AND k.tgl_batal = '0000-00-00 00:00:00'
                    LEFT JOIN t_kwitansi_or kor 
                        ON p.fk_estimasi = kor.fk_estimasi
                        AND kor.tgl_batal = '0000-00-00 00:00:00'
                    LEFT JOIN (
                        SELECT no_ref, SUM(total) AS titip_cash
                        FROM t_cash
                        WHERE tgl_batal = '0000-00-00 00:00:00'
                        GROUP BY no_ref
                    ) AS cash_sum ON cash_sum.no_ref = k.no_kwitansi
                    LEFT JOIN (
                        SELECT no_ref, SUM(total) AS titip_bank
                        FROM t_bank
                        WHERE tgl_batal = '0000-00-00 00:00:00'
                        GROUP BY no_ref
                    ) AS bank_sum ON bank_sum.no_ref = k.no_kwitansi
                    LEFT JOIN (
                        SELECT no_ref, SUM(total) AS titip_bank2
                        FROM t_bank
                        WHERE tgl_batal = '0000-00-00 00:00:00'
                        GROUP BY no_ref
                    ) AS bank_sum2 ON bank_sum2.no_ref = k.fk_pkb
                    LEFT JOIN (
                        SELECT no_ref, SUM(total) AS or_cash
                        FROM t_cash
                        WHERE tgl_batal = '0000-00-00 00:00:00'
                        GROUP BY no_ref
                    ) AS or_cash_sum ON or_cash_sum.no_ref = kor.no_kwitansi_or
                    LEFT JOIN (
                        SELECT no_ref, SUM(total) AS or_bank
                        FROM t_bank
                        WHERE tgl_batal = '0000-00-00 00:00:00'
                        GROUP BY no_ref
                    ) AS or_bank_sum ON or_bank_sum.no_ref = kor.no_kwitansi_or
                    LEFT JOIN t_asuransi a 
                        ON p.fk_asuransi = a.id_asuransi
                    WHERE 
                        p.tgl_batal = '0000-00-00 00:00:00'
                    HAVING 
                        piutang > 0.9
                    ORDER BY 
                        p.tgl DESC";
                    $rescatat = mysql_query($sqlcatat);
                    while ($catat = mysql_fetch_array($rescatat)) {

                    ?>
                        <tr>
                          <td><?php echo($catat['idpkb']); ?></td>
                          <td ><?php echo date('d-m-Y', strtotime($catat['tglpkb'])); ?></td>
                          <td ><?php echo $catat['kat']; ?></td>
                          <td ><?php echo $catat['nmasuransi']; ?></td>
                          <td ><?php echo $catat['nokw']; ?></td>
                          <td ><?php echo date('d-m-Y', strtotime($catat['tglkw'])); ?></td>
                          <td ><?php echo $catat['nmcus']; ?></td>
                          <td ><?php echo rupiah2($catat['total_bayar']); ?></td>
                          <td ><?php echo rupiah2($catat['titip_cash'] + $catat['titip_bank'] + $catat['titip_bank2']); ?></td>
                          <td ><?php echo rupiah2($catat['or_cash']); ?></td>
                          <td ><?php echo rupiah2($catat['or_bank']); ?></td>
                          <td ><?php echo rupiah2($catat['piutang']); ?></td>
                          <td ><?php
                                   $today        = new DateTime();
                                       $tgl_kwitansi = new DateTime($catat['tglkw']);
                                       // Hitung selisih
                                       $diff = $tgl_kwitansi->diff($today);
                                       // Format umur piutang
                                       $umur_piutang = $diff->y . ' tahun ' . $diff->m . ' bulan ' . $diff->d . ' hari';
                                   echo $umur_piutang;
                                   ?></td>
                        </tr>
                    <?php }
                    ?>
                </tfoot>
              </table>
              <table>

              </table>