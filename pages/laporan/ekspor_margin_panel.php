<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=report_margin_panel.xls");

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
                                    <span style="font-size: 20px;font-weight: bold;"><center>Laporan Margin Panel</center></span>
                                     <span style="font-size: 20px;font-weight: bold;"><center> Per Tgl <?php echo date('d-m-Y' , strtotime($_GET['tgl1']));echo ' s/d '; echo date('d-m-Y' , strtotime($_GET['tgl2'])); ?></center></span>
                                <br>
      <table id="tablemarginpanel" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No</th>
                          <th>No PKB</th>
                          <th>Tgl PKB</th>
                          <th>Unit</th>
                          <th>No Polisi</th>
                          <th>Jml Panel</th>
                          <th>Harga Panel</th>
                          <th>Total (Jml x Harga)</th>
                          <th>DPP Jual</th>
                          <th>OR</th>
                          <th>Margin (DPP - (Total+OR))</th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $tgl1=$_GET['tgl1'];
                                    $tgl2=$_GET['tgl2'];
                                    $j=1;
                                    $grand_total = 0;
                                    $grand_dpp = 0;
                                    $grand_or = 0;
                                    $grand_margin = 0;

                                    // Main query to get DMS data with related penjualan and OR data
                                    $sqlmargin = "SELECT
                                        d.nopkb,
                                        d.tgl_pkb,
                                        d.unit,
                                        d.nopol,
                                        d.jml_panel,
                                        d.harga_panel,
                                        (d.jml_panel * d.harga_panel) as total_panel,

                                        -- Get DPP from penjualan (kwitansi)
                                        COALESCE(k.total_kwitansi, 0) as dpp_jual,

                                        -- Get OR from kwitansi OR
                                        COALESCE(kor.nilai_kwitansi, 0) as or_value,

                                        -- Calculate margin
                                        (COALESCE(k.total_kwitansi, 0) - ((d.jml_panel * d.harga_panel) + COALESCE(kor.nilai_kwitansi, 0))) as margin

                                    FROM t_dms d

                                    -- Left join with t_pkb to get PKB connection
                                    LEFT JOIN t_pkb p ON d.nopkb = p.id_pkb

                                    -- Left join with t_estimasi to get estimasi connection
                                    LEFT JOIN t_estimasi e ON p.fk_estimasi = e.id_estimasi

                                    -- Left join with penjualan (kwitansi) to get DPP
                                    LEFT JOIN t_kwitansi k ON p.id_pkb = k.fk_pkb
                                        AND k.tgl_batal = '0000-00-00 00:00:00'
                       

                                    -- Left join with kwitansi OR to get OR value
                                    LEFT JOIN t_kwitansi_or kor ON e.id_estimasi = kor.fk_estimasi
                                        AND kor.tgl_batal = '0000:00:00 00:00:00'
                               

                                    WHERE d.tgl_pkb >= '$tgl1'
                                    AND d.tgl_pkb <= '$tgl2'

                                    ORDER BY d.tgl_pkb ASC, d.nopkb ASC";

                                    $resmargin = mysqli_query($objConn, $sqlmargin);

                                    while($margin = mysqli_fetch_array($resmargin)){
                                        $total_panel = $margin['jml_panel'] * $margin['harga_panel'];
                                        $dpp_jual = $margin['dpp_jual'];
                                        $or_value = $margin['or_value'];
                                        $margin_value = $dpp_jual - ($total_panel + $or_value);

                                        $grand_total += $total_panel;
                                        $grand_dpp += $dpp_jual;
                                        $grand_or += $or_value;
                                        $grand_margin += $margin_value;
                                ?>
                        <tr>
                          <th><?php echo $j++;?></th>
                          <td><?php echo $margin['nopkb'];?></td>
                          <td><?php echo date('d-m-Y', strtotime($margin['tgl_pkb']));?></td>
                          <td><?php echo $margin['unit'];?></td>
                          <td><?php echo $margin['nopol'];?></td>
                          <td align="right"><?php echo number_format($margin['jml_panel'], 2, ',', '.');?></td>
                          <td align="right"><?php echo rupiah2($margin['harga_panel']);?></td>
                          <td align="right"><?php echo rupiah2($total_panel);?></td>
                          <td align="right"><?php echo rupiah2($dpp_jual);?></td>
                          <td align="right"><?php echo rupiah2($or_value);?></td>
                          <td align="right"><?php echo rupiah2($margin_value);?></td>
                        </tr>
                    <?php }?>
                    <tr style="font-weight: bold;">
                        <td colspan="7" align="right">GRAND TOTAL</td>
                        <td align="right"><?php echo rupiah2($grand_total);?></td>
                        <td align="right"><?php echo rupiah2($grand_dpp);?></td>
                        <td align="right"><?php echo rupiah2($grand_or);?></td>
                        <td align="right"><?php echo rupiah2($grand_margin);?></td>
                    </tr>
                </tbody>
              </table>

          