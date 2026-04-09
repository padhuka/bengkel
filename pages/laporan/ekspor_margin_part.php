<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=report_margin_part.xls");

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
                                    <span style="font-size: 20px;font-weight: bold;"><center>Laporan Margin Part</center></span>
                                     <span style="font-size: 20px;font-weight: bold;"><center> Per Tgl <?php echo date('d-m-Y' , strtotime($_GET['tgl1']));echo ' s/d '; echo date('d-m-Y' , strtotime($_GET['tgl2'])); ?></center></span>
                                <br>
      <table id="tablemarginpart" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No</th>
                          <th>No PKB</th>
                          <th>Tgl PKB</th>
                          <th>Unit</th>
                          <th>No Polisi</th>
                          <th>Total Harga Beli Part</th>
                          <th>Total Harga Jual Part Awal</th>
                          <th>Total Diskon Jual Part</th>
                          <th>Total Harga Jual Part Akhir</th>
                          <th>Margin</th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $tgl1=$_GET['tgl1'];
                                    $tgl2=$_GET['tgl2'];
                                    $j=1;
                                    $grand_harga_beli = 0;
                                    $grand_harga_jual_awal = 0;
                                    $grand_diskon = 0;
                                    $grand_harga_jual_akhir = 0;
                                    $grand_margin = 0;

                                    // Main query to get margin part data
                                    $sqlmargin = "SELECT
                                        pkb.id_pkb as no_pkb,
                                        pkb.tgl as tgl_pkb,
                                        tk.nama as unit,
                                        inv.no_polisi,
                                        COALESCE(SUM(part.harga_beli), 0) as total_harga_beli_part,
                                        COALESCE(pkb.total_gross_harga_part, 0) as total_harga_jual_part_awal,
                                        COALESCE(pkb.total_diskon_rupiah_part, 0) as total_diskon_jual_part,
                                        COALESCE(pkb.total_netto_harga_part, 0) as total_harga_jual_part_akhir,
                                        (COALESCE(pkb.total_netto_harga_part, 0) - COALESCE(SUM(part.harga_beli), 0)) as margin

                                    FROM t_pkb pkb

                                    -- Left join with inventory to get unit and police number
                                    LEFT JOIN t_inventory_bengkel inv ON pkb.fk_no_chasis = inv.no_chasis

                                    -- Left join with vehicle type to get unit name
                                    LEFT JOIN t_tipe_kendaraan tk ON inv.fk_tipe_kendaraan = tk.id_tipe_kendaraan

                                    -- Left join with estimasi to get estimasi connection
                                    LEFT JOIN t_estimasi e ON pkb.fk_estimasi = e.id_estimasi

                                    -- Left join with estimasi part detail to get parts
                                    LEFT JOIN t_estimasi_part_detail epd ON e.id_estimasi = epd.fk_estimasi

                                    -- Left join with part master to get buying price
                                    LEFT JOIN t_part part ON epd.fk_part = part.id_part

                                    WHERE pkb.tgl >= '$tgl1'
                                    AND pkb.tgl <= '$tgl2'

                                    GROUP BY pkb.id_pkb, pkb.tgl, tk.nama, inv.no_polisi, pkb.total_gross_harga_part, pkb.total_diskon_rupiah_part, pkb.total_netto_harga_part

                                    ORDER BY pkb.tgl ASC, pkb.id_pkb ASC";

                                    // Debugging - uncomment to see query and error
                                    // echo "<pre>Query: " . $sqlmargin . "</pre>";
                                    // echo "<pre>Tanggal: $tgl1 s/d $tgl2</pre>";

                                    $resmargin = mysqli_query($objConn, $sqlmargin);

                                    // Debugging - check for errors
                                    if (!$resmargin) {
                                        // echo "<pre>Query FAILED: " . mysqli_error($objConn) . "</pre>";
                                        die("Query error: " . mysqli_error($objConn));
                                    } else {
                                        // echo "<pre>Query SUCCESS</pre>";
                                    }

                                    // Initialize counter
                                    // $debug_counter = 0;

                                    while($margin = mysqli_fetch_array($resmargin)){
                                        // $debug_counter++;
                                        // Debug first row
                                        // if ($debug_counter == 1) {
                                        //     echo "<pre>FIRST ROW DATA:\n";
                                        //     echo "no_pkb: " . $margin['no_pkb'] . "\n";
                                        //     echo "tgl_pkb: " . $margin['tgl_pkb'] . "\n";
                                        //     echo "unit: " . $margin['unit'] . "\n";
                                        //     echo "no_polisi: " . $margin['no_polisi'] . "\n";
                                        //     echo "total_harga_beli_part: " . $margin['total_harga_beli_part'] . "\n";
                                        //     echo "total_harga_jual_part_awal: " . $margin['total_harga_jual_part_awal'] . "\n";
                                        //     echo "total_diskon_jual_part: " . $margin['total_diskon_jual_part'] . "\n";
                                        //     echo "total_harga_jual_part_akhir: " . $margin['total_harga_jual_part_akhir'] . "\n";
                                        //     echo "margin: " . $margin['margin'] . "\n";
                                        //     echo "</pre>";
                                        // }

                                        $harga_beli = $margin['total_harga_beli_part'];
                                        $harga_jual_awal = $margin['total_harga_jual_part_awal'];
                                        $diskon = $margin['total_diskon_jual_part'];
                                        $harga_jual_akhir = $margin['total_harga_jual_part_akhir'];
                                        $margin_value = $margin['margin'];

                                        $grand_harga_beli += $harga_beli;
                                        $grand_harga_jual_awal += $harga_jual_awal;
                                        $grand_diskon += $diskon;
                                        $grand_harga_jual_akhir += $harga_jual_akhir;
                                        $grand_margin += $margin_value;
                                ?>
                        <tr>
                          <th><?php echo $j++;?></th>
                          <td><?php echo $margin['no_pkb'];?></td>
                          <td><?php echo date('d-m-Y', strtotime($margin['tgl_pkb']));?></td>
                          <td><?php echo $margin['unit'];?></td>
                          <td><?php echo $margin['no_polisi'];?></td>
                          <td align="right"><?php echo rupiah2($harga_beli);?></td>
                          <td align="right"><?php echo rupiah2($harga_jual_awal);?></td>
                          <td align="right"><?php echo rupiah2($diskon);?></td>
                          <td align="right"><?php echo rupiah2($harga_jual_akhir);?></td>
                          <td align="right"><?php echo rupiah2($margin_value);?></td>
                        </tr>
                    <?php }
                    // Debugging - show actual loop count
                    // echo "<pre>Loop iterations: $debug_counter</pre>";
                    ?>
                    <tr style="font-weight: bold;">
                        <td colspan="5" align="right">GRAND TOTAL</td>
                        <td align="right"><?php echo rupiah2($grand_harga_beli);?></td>
                        <td align="right"><?php echo rupiah2($grand_harga_jual_awal);?></td>
                        <td align="right"><?php echo rupiah2($grand_diskon);?></td>
                        <td align="right"><?php echo rupiah2($grand_harga_jual_akhir);?></td>
                        <td align="right"><?php echo rupiah2($grand_margin);?></td>
                    </tr>
                </tbody>
              </table>
