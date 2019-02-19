      <?php
            include_once '../../lib/config.php';
            include_once '../../lib/fungsi.php';            
      ?>
      <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formcashacc">
        <table width="40%" class="table table-condensed table-bordered table-striped table-hover">
           <tr valign="middle" id="nbukti">
             <td width="15%">No Bukti :</td>
             <td width="35%"><label id="nobukti"></label></td>
             <td width="10%"></td>
             <td width="15%"></td>
             <td width="35%"></td>
          </tr>
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
                            <select id="transaction_type" name="transaction_type" onchange="reff();"><option value="D">Debet</option><option value="C">Kredit</option></select>
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
         
        </table>
<br>
        <table width="40%" class="table table-condensed table-bordered table-striped table-hover" id="reffacc">
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
        </table>
        <table width="40%" class="table table-condensed table-bordered table-striped table-hover">
          <tr valign="middle">
             <td width="15%">Nominal</td>
             <td width="35%"><input type="text" class="form-control" name="nominal" id="nominal" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"></td>
             <td width="10%"></td>
             <td width="15%"></td>
             <td width="35%"></td>
          </tr>
           <tr valign="middle">
             <td width="15%">Keterangan</td>
             <td width="75%" colspan="4"><input type="text" class="form-control" name="keterangan" id="keterangan" style="width: 95%"></td>
          </tr>
          <tr valign="middle">
            <td width="15%"></td>
            <td width="35%"></td>
           <td width="10%"></td>
           <td width="15%"></td>
           <td width="35%"></td>
          </tr>
          <tr valign="middle">
            <td width="15%"><button type="submit" class="btn btn-primary save_submit" name="Submit" id="saveadd" value="SIMPAN">Simpan</button>
              <button type="button" class="btn btn-primary" onclick="simpanubah()" id="saveedit">Simpan</button>
              <button type="button" class="btn btn-primary" onclick="batalubah()" id="canceledit">Batal Ubah</button>
            </td>
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
                          <th>No</th>
                          <th>No Bukti</th>
                          <th>Date</th>
                          <th>Type</th>
                          <th>Keterangan</th>
                          <th>Total</th>
                          <th>Status</th>
                          <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                                    $j=1;
                                    $sqlcatat = "SELECT A.*,A.description AS descrip, B.description AS nmakun,C.description AS nmref FROM t_acc_cash A
                                                LEFT JOIN t_akun B ON A.fk_akun=B.coa
                                                LEFT JOIN t_akun C ON A.ref_akun=C.coa
                                                ORDER BY A.urut DESC";
                                    $rescatat = mysql_query( $sqlcatat );
                                    //echo $sqlcatat;
                                    while($catat = mysql_fetch_array( $rescatat )){
                                ?>
                        <tr>
                          <td><?php echo $j++;?></td>
                          <td><?php echo $catat['no_bukti'];?></td>
                          <td ><?php echo $catat['tr_date'];?></td>
                          <td><?php echo $catat['transaction_type'];?></td>
                          <td><?php echo $catat['description'];?></td>
                          <td align="right"><?php echo rupiah2($catat['amount']);?></td>
                          <td><?php echo $catat['status'];?></td>
                          <td>
                            <?php if ($catat['status']<>'Batal'){?>
                              <?php if ($catat['status']<>'Approve'){?>
                            <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['no_bukti']; ?>"  onclick="ubahacc(
                                         '<?php echo $catat['no_bukti'];?>',
                                         '<?php echo $catat['tr_date'];?>',
                                         '<?php echo $catat['transaction_type'];?>',
                                         '<?php echo $catat['fk_akun'];?>',  
                                         '<?php echo $catat['nmakun'];?>', 
                                         '<?php echo $catat['ref_akun'];?>',  
                                         '<?php echo $catat['nmref'];?>',
                                         '<?php echo $catat['amount'];?>',
                                         '<?php echo $catat['descrip'];?>',
                                        );"><span>Ubah</span></button>
                             <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['no_bukti']; ?>" onclick="open_approve(nobukti='<?php echo $catat['no_bukti']; ?>');"><span>Approve</span></button>
                           <?php } ?>
                            <?php if ($catat['status']=='Approve'){
                            }else{?>
                             <button type="button" class="btn btn btn-default btn-circle" id="<?php echo $catat['no_bukti']; ?>" onclick="open_del(nobukti='<?php echo $catat['no_bukti']; ?>');"><span>Batal</span></button>
                            <?php }}?>

                          </td>
                        </tr>
                    <?php }?>
                </tfoot>
              </table>
              <script>
                //$('#nbukti').hide();
                //$('#saveedit').hide();
                reff();
                bersih();
              function bersih(){
                $('#nbukti').hide();
                $('#saveedit').hide();
                $('#nobukti').html('');
                $('#idacccash').val('');
                $('#nmacccash').html('');
                $('#idacc').val('');
                $('#nmacc').html('');
                $('#nominal').val('');
                $('#keterangan').val('');
                $('#saveadd').show();
                $('#canceledit').hide();
                $('#datecash').val('<?php echo $harinow;?>');
              }

              function reff(){
                var refaccne= $('#transaction_type').val();
                if (refaccne=='D'){
                  $('#reffacc').hide();
                }
                if (refaccne=='C'){
                  $('#reffacc').show();
                }
              }

              function batalubah(){
                  bersih();
              }
             $('#example1').DataTable({
              //"order": [[ 8, "asc" ]],
              "columnDefs": [
                  { "orderable": false, "targets": 7 }
                ],
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

              function ubahacc(a,b,c,d,e,f,g,h,i){                
                //no_bukti,tr_date,transaction_type,fk_akun,nmakun,ref_akun,nmref,amount
                $('#canceledit').show();
                $('#nbukti').show();
                $('#nobukti').html(a);
                var akun= c;//$('#transaction_type').val(b);
                $('#idacccash').val(d);
                $('#nmacccash').html(e);
                $('#idacc').val(f);
                $('#nmacc').html(g);
                var nom = tandaPemisahTitik(h)
                $('#nominal').val(nom);
                $('#keterangan').val(i);
                //alert(akun);
                if (akun=='D'){
                  var myobject = {
                      D : 'Debet',
                      C : 'Kredit'
                  };
                }
                if (akun=='C'){
                  var myobject = {
                      C : 'Kredit',
                      D : 'Debet',                     
                  };
                }
                  
                  $('#saveadd').hide()
                  $('#saveedit').show();

                  //var sel = document.getElementById("transaction_type");

                  

                  var select = document.getElementById("transaction_type");
                  select.options.length = 0;
                  for(index in myobject) {
                      select.options[select.options.length] = new Option(myobject[index], index);
                  }
                  reff();

              }

              function simpanubah(){
                  var nobkt = document.getElementById("nobukti").innerHTML;
                  var fk_akun = $('#idacccash').val();
                  var ref_akun = $('#idacc').val(); 
                  var amount = $('#nominal').val();  
                  var description = $('#keterangan').val(); 
                  var transaction_type= $('#transaction_type').val();
                  var tr_date = $('#datecash').val();
                  //alert('acccash/acccash_edit_save.php?no_bukti='+nobkt+'&fk_akun='+fk_akun+'&ref_akun='+ref_akun+'&amount='+amount+'&description='+description+'&transaction_type='+transaction_type+'&tr_date='+tr_date);
                   $.ajax({
                                url: 'acccash/acccash_edit_save.php?no_bukti='+nobkt+'&fk_akun='+fk_akun+'&ref_akun='+ref_akun+'&amount='+amount+'&description='+description+'&transaction_type='+transaction_type+'&tr_date='+tr_date,
                                type: 'GET',
                                success: function (response){               
                                  //var hsl=data.trim();       
                                  //alert(hsl);              
                                  alert('Data Berhasil Disimpan');  
                                  $('#nbukti').hide();
                                  $('#saveadd').show();
                                  $('#saveedit').hide();            
                                  $("#tableacccash").load('acccash/acccash_load.php');

                                }
                        });
              }
           
           $(document).ready(function (){
              

                      $("#formcashacc").on('submit', function(e){

                          var idacccash= $("#idacccash").val();
                          var idacc= $("#idacc").val();
                          var nominal= $("#nominal").val();
                          var keterangan= $("#keterangan").val();
                          if ($("#transaction_type").val()=='D'){
                            if (idacccash=='' || nominal=='' || keterangan==''){
                              alert('Data ada yang belum diisi');
                              return false;
                            }
                          }else{
                            if (idacccash=='' || idacc=='' || nominal=='' || keterangan==''){
                              alert('Data ada yang belum diisi');
                              return false;
                            }
                          }
                          e.preventDefault();
                            //alert(disposisine)                       ;
                                      $.ajax({
                                                  type: 'POST',
                                                  url: 'acccash/acccash_add_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){                  
                                                            //var hsl=data.trim();       
                                                            //alert(hsl);              
                                                            alert('Data Berhasil Disimpan');              
                                                            $("#tableacccash").load('acccash/acccash_load.php');

                                                  }
                                                      
                                                });

                                      
              
                      });
    });
           function open_del(x){
                                $.ajax({
                                    url: "acccash/acccash_del.php?nobukti="+x,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalBatal").html(ajaxData);
                                        $("#ModalBatal").modal({backdrop: 'static',keyboard: false});
                                    }
                                });
            };
            function open_approve(x){
                                $.ajax({
                                    url: "acccash/acccash_approve.php?nobukti="+x,
                                    type: "GET",
                                    success: function (ajaxData){
                                        $("#ModalApprove").html(ajaxData);
                                        $("#ModalApprove").modal({backdrop: 'static',keyboard: false});
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
</style>

<script type="text/javascript" src="../lib/ribuan.js"></script>