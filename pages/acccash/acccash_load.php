      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';
      ?>
      <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formcash">
        <table width="40%" class="table table-condensed table-bordered table-striped table-hover">
          <tr valign="middle">
            <td width="15%">Date :</td><td width="35%">
                            <div class="input-group date" style="width: 60%;">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="datecash" name="datecash" required value="<?php echo $harinow;?>">
                            </div>
                          </td>
           <td width="10%"></td>
           <td width="15%">Type of transaction :</td><td width="35%">
                            <select>><option value="Debet">Debet</option><option value="Kredit">Kredit</option></select>
                          </td>
          </tr>
          <tr valign="middle">
            <td width="15%">Account :</td>
            <td width="35%">
              <table><tr><td><input type="text" class="form-control" id="idacccash" name="idacccash" readonly style="width: 95%"></td><td>
                                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" onclick="open_addcash();" id="buttonaddcash">Pilih</button></td></tr></table>
              </td>
           <td width="10%"></td>
           <td width="15%">Account Name :</td>
           <td width="35%"><label id="nmacccash"></label></td>
          </tr>
          <tr valign="middle">
             <td width="15%">Keterangan</td>
             <td width="35%"><input type="text" name=""></td>
             <td width="10%"></td>
             <td width="15%"></td>
             <td width="35%"></td>
          </tr>
        </table>
<br>
        <table width="40%" class="table table-condensed table-bordered table-striped table-hover">
          <tr valign="middle">
             <td width="15%"></td>
             <td width="35%"></td>
             <td width="10%"></td>
             <td width="15%"></td>
             <td width="35%"></td>
          </tr>
          <tr valign="middle">
            <td width="15%">Reff Account :</td>
            <td width="35%">
              <table><tr><td><input type="text" class="form-control" id="idacc" name="idacc" readonly style="width: 95%"></td><td>
                                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" onclick="open_addacc();" id="buttonaddacc">Pilih</button></td></tr></table>
              </td>
           <td width="10%"></td>
           <td width="15%">Reff Account Name :</td>
           <td width="35%"><label id="nmacc"></label></td>
          </tr>
          <tr valign="middle">
             <td width="15%">Nominal</td>
             <td width="35%"><input type="text" name=""></td>
             <td width="10%"></td>
             <td width="15%">Keterangan</td>
             <td width="35%"><input type="text" name=""></td>
          </tr>
          <tr valign="middle">
            <td width="15%"></td>
            <td width="35%"></td>
           <td width="10%"></td>
           <td width="15%"></td>
           <td width="35%"></td>
          </tr>
          <tr valign="middle">
            <td width="15%"><button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan</button></td>
            <td width="35%"></td>
           <td width="10%"></td>
           <td width="15%"></td>
           <td width="35%"></td>
          </tr>
        </table>

                      
      </form>
      <br><br>
      <table id="example1" class="table table-condensed table-bordered table-striped table-hover">
      
                <thead class="thead-light">
                <tr>
                          <th>COA</th>
                          <th>Type Transaction</th>
                          <th>Description</th>
                          
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT * FROM t_akun ORDER BY id ASC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td ><?php echo $catat['coa'];?></td>
                          <td ><?php echo $catat['transaction_type'];?></td>
                           <td ><?php echo $catat['description'];?></td>
                         
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script>
             $('#example1').DataTable({
              "language": {
                      "search": "Cari",
                      "lengthMenu": "Lihat _MENU_ baris per halaman",
                      "zeroRecords": "Maaf, Tidak di temukan - data",
                      "info": "Terlihat halaman _PAGE_ of _PAGES_",
                      "infoEmpty": "Tidak ada data di database"
                  }
             });

             $('#datecash').datepicker({       
                format: 'yyyy-mm-dd',
                autoclose: true,
              });

             function open_addcash(){
              $.ajax({
                    url: "acccash/acccash_add.php",
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalCashAdd").html(ajaxData);
                        $("#ModalCashAdd").modal({backdrop: 'static',keyboard: false});
                      }
                    });
              }
              function open_addacc(){
              $.ajax({
                    url: "acccash/acc_add.php",
                    type: "GET",
                      success: function (ajaxData){
                        $("#ModalAccAdd").html(ajaxData);
                        $("#ModalAccAdd").modal({backdrop: 'static',keyboard: false});
                      }
                    });
              }
           
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
</style>