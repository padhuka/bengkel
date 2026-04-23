<?php
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
?>
      <div class="panel panel-default" style="margin-bottom: 10px;">
        <div class="panel-body">
          <table class="table table-condensed" style="margin-bottom: 0;">
            <tr>
              <td width="15%"><strong>Filter Periode:</strong></td>
              <td width="30%">
                <div class="input-group date" style="width: 45%;">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="tglkwitansi1" name="tglkwitansi1"
                         value="<?php echo $tgl1; ?>" placeholder="Dari Tanggal">
                </div>
              </td>
              <td width="5%" align="center">s/d</td>
              <td width="30%">
                <div class="input-group date" style="width: 45%;">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="tglkwitansi2" name="tglkwitansi2"
                         value="<?php echo $tgl2; ?>" placeholder="Sampai Tanggal">
                </div>
              </td>
              <td width="20%">
                <button type="button" class="btn btn-primary" onclick="filterKwitansi()">
                  <i class="fa fa-filter"></i> Filter
                </button>
                <button type="button" class="btn btn-default" onclick="resetKwitansi()">
                  <i class="fa fa-refresh"></i> Reset
                </button>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <!-- Panel Pencarian No Polisi -->
      <div class="panel panel-default" style="margin-bottom: 10px;">
        <div class="panel-body">
          <table class="table table-condensed" style="margin-bottom: 0;">
            <tr>
              <td width="15%"><strong>Cari No Polisi:</strong></td>
              <td width="45%">
                <input type="text" class="form-control" id="searchNoPolisi"
                       placeholder="Masukkan No Polisi (contoh: H 1022 Y)">
              </td>
              <td width="10%">
                <button type="button" class="btn btn-success" onclick="searchByNoPolisi()">
                  <i class="fa fa-search"></i> Cari
                </button>
              </td>
              <td width="10%">
                <button type="button" class="btn btn-warning" onclick="clearNoPolisiSearch()">
                  <i class="fa fa-times"></i> Reset
                </button>
              </td>
              <td width="20%"></td>
            </tr>
          </table>
        </div>
      </div>
      <table id="tablekwitansi" class="table table-condensed table-bordered table-striped table-hover">
                <thead class="thead-light">
                <tr>
                          <th>No</th>
                          <th>No Kwitansi</th>
                          <th>Tanggal</th>
                          <th>No PKB</th>
                          <th>No Chasis</th>
                          <th>No Polisi</th>
                          <th>Nama Customer</th>
                          <th>Total</th>
                          <th>PPN</th>
                           <th>Total Bayar</th>

                          <th><button type="button" class="btn btn btn-default btn-circle" onclick="open_add();"><span>Tambah</span></button></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $j         = 1;
                    $current_year = date('Y');
                    $tgl1 = isset($_GET['tgl1']) ? $_GET['tgl1'] : $current_year . '-01-01';
                    $tgl2 = isset($_GET['tgl2']) ? $_GET['tgl2'] : $current_year . '-12-31';

                    $sqlcatat = "SELECT k.no_kwitansi, k.tgl_kwitansi,p.id_pkb,p.kategori,p.fk_no_chasis,p.fk_no_mesin,p.fk_no_polisi,c.nama,k.total_kwitansi,k.total_ppn_kwitansi,k.total_payment,k.tgl_batal FROM t_kwitansi k
                                      INNER JOIN t_pkb p ON k.fk_pkb=p.id_pkb
                                      INNER JOIN t_customer c ON p.fk_customer=c.id_customer
                                      WHERE k.tgl_batal='0000:00:00 00:00:00' AND k.tgl_kwitansi >= '$tgl1' AND k.tgl_kwitansi <= '$tgl2'
                                      ORDER BY k.tgl_kwitansi DESC ";
                    $rescatat = mysqli_query($objConn, $sqlcatat);
                    while ($catat = mysqli_fetch_array($rescatat)) {
                    ?>
                        <tr>
                          <td><?php echo $j++; ?></td>
                          <td><button type="button" class="btn btn-link" id="<?php echo $catat['no_kwitansi']; ?>" onclick="open_kwitansi(idkwitansi='<?php echo $catat['no_kwitansi']; ?>');"><span><?php echo($catat['no_kwitansi']); ?></span></button></td>

                          <td ><?php echo date('d-m-Y', strtotime($catat['tgl_kwitansi'])); ?></td>
<!--                           <td ><?php echo $catat['id_pkb']; ?></td> -->
                      <td><button type="button" class="btn btn-link" id="<?php echo $catat['id_pkb']; ?>" onclick="open_pkb(idpkb='<?php echo $catat['id_pkb']; ?>');"><span><?php echo($catat['id_pkb']); ?></span></button></td>

                          <td ><?php echo $catat['fk_no_chasis']; ?></td>
                          <td ><?php echo $catat['fk_no_polisi']; ?></td>
                          <td ><?php echo $catat['nama']; ?></td>
                          <td ><?php echo rupiah2($catat['total_kwitansi']); ?></td>
                          <td ><?php echo rupiah2($catat['total_ppn_kwitansi']); ?></td>
                          <td ><?php echo rupiah2($catat['total_payment']); ?></td>
                          <td >
                                        <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['no_kwitansi']; ?>" onclick="cetak_kw(idkwitansi='<?php echo $catat['no_kwitansi']; ?>');"><span>Cetak</span></button>
                                        <?php
                                            #CASH
                                                $sqlkwcash = "SELECT no_bukti FROM t_cash WHERE no_ref='$catat[no_kwitansi]' AND tipe_transaksi='Pelunasan' AND tgl_batal<>'0000-00-00 00:00:00'";
                                                $hkwcash   = mysqli_fetch_array(mysqli_query($objConn, $sqlkwcash));
                                                $lunas     = $hkwcash['no_bukti'];

                                                $sqllunas = "SELECT no_bukti FROM t_cash WHERE no_ref='$catat[no_kwitansi]'";
                                                $hcekcash = mysqli_fetch_array(mysqli_query($objConn, $sqllunas));
                                                $ada      = $hcekcash['no_bukti'];
                                                #BANK
                                                $sqlkwcash2 = "SELECT no_bukti FROM t_cash WHERE no_ref='$catat[no_kwitansi]' AND tipe_transaksi='Pelunasan' AND tgl_batal<>'0000-00-00 00:00:00'";
                                                $hkwcash2   = mysqli_fetch_array(mysqli_query($objConn, $sqlkwcash2));
                                                $lunas2     = $hkwcash2['no_bukti'];

                                                $sqllunas2 = "SELECT no_bukti FROM t_cash WHERE no_ref='$catat[no_kwitansi]'";
                                                $hcekcash2 = mysqli_fetch_array(mysqli_query($objConn, $sqllunas2));
                                                $ada2      = $hcekcash2['no_bukti'];

                                                if ($ada || $ada2) {if ($lunas || $lunas2) {
                                                ?>
                                         <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['no_kwitansi']; ?>" onclick="open_del(idkwitansi='<?php echo $catat['no_kwitansi']; ?>');"><span>Batal</span></button>
                                         <?php
                                         }} else {?>
                                          <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['no_kwitansi']; ?>" onclick="open_del(idkwitansi='<?php echo $catat['no_kwitansi']; ?>');"><span>Batal</span></button>
                                        <?php }?>

                                    </td>
                        </tr>
                    <?php
                    }?>
                </tfoot>
              </table>
              <script>
            var table = $('#tablekwitansi').DataTable({
              "destroy": true,
              "columnDefs": [
                  { "orderable": false, "targets": 10 }
                ],
               "language": {
                      "search": "Cari Semua Kolom:",
                      "lengthMenu": "Lihat _MENU_ baris per halaman",
                      "zeroRecords": "Maaf, Tidak di temukan - data",
                      "info": "Terlihat halaman _PAGE_ of _PAGES_",
                      "infoEmpty": "Tidak ada data di database"
                  }
            });

            // Fungsi mencari berdasarkan No Polisi (kolom index 5)
            function searchByNoPolisi() {
              var searchTerm = $('#searchNoPolisi').val();

              if (searchTerm.trim() === '') {
                alert('Harap masukkan No Polisi yang dicari');
                return false;
              }

              // Kosongkan pencarian global terlebih dahulu
              table.search('').draw();

              // Terapkan pencarian ke kolom 5 (No Polisi)
              table.column(5).search(searchTerm).draw();
            }

            // Fungsi membersihkan pencarian No Polisi
            function clearNoPolisiSearch() {
              $('#searchNoPolisi').val('');
              table.column(5).search('').draw();
            }

            // Enable Enter key untuk search input
            $('#searchNoPolisi').on('keyup', function(e) {
              if (e.key === 'Enter') {
                searchByNoPolisi();
              }
            });

            $('#tglkwitansi1').datepicker({
              format: 'yyyy-mm-dd',
              autoclose: true,
            });

            $('#tglkwitansi2').datepicker({
              format: 'yyyy-mm-dd',
              autoclose: true,
            });

            function filterKwitansi() {
              var tgl1 = $('#tglkwitansi1').val();
              var tgl2 = $('#tglkwitansi2').val();

              if (tgl1 === '' || tgl2 === '') {
                alert('Harap pilih tanggal awal dan tanggal akhir');
                return false;
              }

              if (tgl1 > tgl2) {
                alert('Tanggal awal tidak boleh lebih besar dari tanggal akhir');
                return false;
              }

              // Simpan nilai pencarian No Polisi jika ada
              var noPolisiSearch = $('#searchNoPolisi').val();

              $("#kwitansi").load('kwitansi/kwitansi_load.php?tgl1=' + tgl1 + '&tgl2=' + tgl2, function() {
                // Kembalikan nilai pencarian No Polisi setelah reload
                if (noPolisiSearch) {
                  $('#searchNoPolisi').val(noPolisiSearch);
                  // Terapkan kembali pencarian setelah tabel reload
                  setTimeout(function() {
                    searchByNoPolisi();
                  }, 500);
                }
              });
            }

            function resetKwitansi() {
              var currentYear = new Date().getFullYear();
              $('#tglkwitansi1').val(currentYear + '-01-01');
              $('#tglkwitansi2').val(currentYear + '-12-31');
              $('#searchNoPolisi').val('');
              $("#kwitansi").load('kwitansi/kwitansi_load.php');
            }

           function open_add(){
              $.ajax({
                    url: "kwitansi/kwitansi_add.php",
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAdd").html(ajaxData);
                        $("#ModalAdd").modal({backdrop: 'static',keyboard: false});
                      }
                    });
              }

             function open_del(x){
                                $.ajax({
                                    url: "kwitansi/kwitansi_del.php?idkwitansi="+x,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalDelete").html(ajaxData);
                                        $("#ModalDelete").modal({backdrop: 'static',keyboard: false});
                                    }
                                });
            };

            function open_pkb(z){
                              $.ajax({
                                  url: "pkb/pkb_show.php?idpkb="+z,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalShow").html(ajaxData);
                                      $("#ModalShow").modal({backdrop: 'static',keyboard: false});
                                  }
                              });
            };
            function cetak_kw(q){
                              $.ajax({
                                  url: "kwitansi/kwitansi_print.php?no_kwitansi="+q,
                                  type: "GET",
                                  success: function (ajaxData){
                                      $("#ModalKwPrint").html(ajaxData);
                                      $("#ModalKwPrint").modal({backdrop: 'static',keyboard: false});
                                  }
                              });
            };

      </script>

<style type="text/css">
  .table {
    border-spacing: 0;
    border-collapse: collapse;
    margin-bottom: 0px;
  }
  .thead-light{
    background-color: lightgrey;
  }
  .btn {
    font-weight: bold;
    padding-bottom: 0px;
    padding-top: 3px;
    padding-left: 4px;
    padding-right: 4px;
  }
  .panel {
    border: 1px solid #ddd;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
  }
  .panel-body {
    padding: 10px;
  }
  #searchNoPolisi {
    font-weight: bold;
    border-color: #5cb85c;
  }
  #searchNoPolisi:focus {
    border-color: #5cb85c;
    box-shadow: 0 0 5px rgba(92, 184, 92, 0.5);
  }
</style>