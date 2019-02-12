  <?php
          include_once '../lib/config.php';
          ?>
          <script src="../bower_components/jquery/dist/jquery.min.js"></script>
          <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Left side column. contains the logo and sidebar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="title-header">
    Report
    </div>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">Data Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title"></h3>
            </div>
             /.box-header -->
            <div class="box-body">
              <div id="tablepanel">
                <table width="100%" border="1">
                    <tr align="center" style="font-weight: bold; font-size: 16px;">
                        <td>Report</td><td>Field</td><td></td>
                    </tr>
                    <tr>
                        <td width="30%" >&nbsp;<label style="font-size: 16px;">Estimasi</label></td><td>
                              <table border="0"><tr><td>Periode :</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglestimasi1" name="tglestimasi1" required value="<?php echo $harinow;?>">
                            </div></td><td>-</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglestimasi2" name="tglestimasi2" required value="<?php echo $harinow;?>">
                            </div> </td></tr></table>
                            </td><td align="center" style="font-weight: bold; font-size: 14px;"><span style="cursor: pointer;" onclick="eksporestimasi()">Generate</span></strong></span></td>
                    </tr>
                    <tr>
                        <td width="30%" >&nbsp;<label style="font-size: 16px;">PKB</label></td><td>
                              <table border="0"><tr><td>Periode :</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglpkb1" name="tglpkb1" required value="<?php echo $harinow;?>">
                            </div></td><td>-</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglpkb2" name="tglpkb2" required value="<?php echo $harinow;?>">
                            </div> </td></tr></table>
                            </td><td align="center" style="font-weight: bold; font-size: 14px;"><span style="cursor: pointer;" onclick="eksporpkb()">Generate</span></strong></span></td>
                    </tr>
                    <tr>
                        <td width="30%" >&nbsp;<label style="font-size: 16px;">PKB Batal</label></td><td>
                              <table border="0"><tr><td>Periode :</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglpkb1a" name="tglpkb1a" required value="<?php echo $harinow;?>">
                            </div></td><td>-</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglpkb2a" name="tglpkb2a" required value="<?php echo $harinow;?>">
                            </div> </td></tr></table>
                            </td><td align="center" style="font-weight: bold; font-size: 14px;"><span style="cursor: pointer;" onclick="eksporpkbbatal()">Generate</span></strong></span></td>
                    </tr>
                    <tr>
                        <td width="30%" >&nbsp;<label style="font-size: 16px;">Kwitansi OR</label></td><td>
                              <table border="0"><tr><td>Periode :</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglkwor1" name="tglkwor1" required value="<?php echo $harinow;?>">
                            </div></td><td>-</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglkwor2" name="tglkwor2" required value="<?php echo $harinow;?>">
                            </div> </td></tr></table>
                            </td><td align="center" style="font-weight: bold; font-size: 14px;"><span style="cursor: pointer;" onclick="eksporkwor()">Generate</span></strong></span></td>
                    </tr>
                    <tr>
                        <td width="30%" >&nbsp;<label style="font-size: 16px;">Kwitansi OR Batal</label></td><td>
                              <table border="0"><tr><td>Periode :</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglkwor1a" name="tglkwor1a" required value="<?php echo $harinow;?>">
                            </div></td><td>-</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglkwor2a" name="tglkwor2a" required value="<?php echo $harinow;?>">
                            </div> </td></tr></table>
                            </td><td align="center" style="font-weight: bold; font-size: 14px;"><span style="cursor: pointer;" onclick="eksporkworbatal()">Generate</span></strong></span></td>
                    </tr>
                    <tr>
                        <td width="30%" >&nbsp;<label style="font-size: 16px;">GatePass</label></td><td>
                              <table border="0"><tr><td>Periode :</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglgetpas1" name="tglgetpas1" required value="<?php echo $harinow;?>">
                            </div></td><td>-</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglgetpas2" name="tglgetpas2" required value="<?php echo $harinow;?>">
                            </div> </td></tr></table>
                            </td><td align="center" style="font-weight: bold; font-size: 14px;"><span style="cursor: pointer;" onclick="eksporgetpas()">Generate</span></strong></span></td>
                    </tr>
                    <tr>
                        <td width="30%" >&nbsp;<label style="font-size: 16px;">Piutang</label></td><td>
                              
                            </td><td align="center" style="font-weight: bold; font-size: 14px;"><span style="cursor: pointer;" onclick="eksporpiutang()">Generate</span></strong></span></td>
                    </tr>
                    
                    <tr>
                        <td width="30%" >&nbsp;<label style="font-size: 16px;">Pembayaran Cash</label></td><td>
                              <table border="0"><tr><td>Periode :</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglcash1" name="tglcash1" required value="<?php echo $harinow;?>">
                            </div></td><td>-</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglcash2" name="tglcash2" required value="<?php echo $harinow;?>">
                            </div> </td></tr></table>
                            </td><td align="center" style="font-weight: bold; font-size: 14px;"><span style="cursor: pointer;" onclick="eksporcash()">Generate</span></strong></span></td>

                            
                    </tr>
                    <tr>

                            <td width="30%" >&nbsp;<label style="font-size: 16px;">Pembayaran Bank</label></td><td>
                              <table border="0"><tr><td>Periode :</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglbank1" name="tglbank1" required value="<?php echo $harinow;?>">
                            </div></td><td>-</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglbank2" name="tglbank2" required value="<?php echo $harinow;?>">
                            </div> </td></tr></table>
                            </td><td align="center" style="font-weight: bold; font-size: 14px;"><span style="cursor: pointer;" onclick="eksporbank()">Generate</span></strong></span></td>
                    </tr>

                     <tr>

                            <td width="30%" >&nbsp;<label style="font-size: 16px;">Penjualan </label></td><td>
                              <table border="0"><tr><td>Periode :</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglpenj1" name="tglpenj1" required value="<?php echo $harinow;?>">
                            </div></td><td>-</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglpenj2" name="tglpenj2" required value="<?php echo $harinow;?>">
                            </div> </td></tr></table>
                            </td><td align="center" style="font-weight: bold; font-size: 14px;"><span style="cursor: pointer;" onclick="eksporpenjualan()">Generate</span></strong></span></td>
                    </tr>
                    <tr>

                            <td width="30%" >&nbsp;<label style="font-size: 16px;">Buku Besar </label></td><td>
                              <table border="0"><tr><td>Periode :</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglbukebesar1" name="tglbukebesar1" required value="<?php echo $harinow;?>">
                            </div></td><td>-</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tglbukebesar2" name="tglbukebesar2" required value="<?php echo $harinow;?>">
                            </div> </td></tr></table>
                            </td><td align="center" style="font-weight: bold; font-size: 14px;"><span style="cursor: pointer;" onclick="eksporbukubesar()">Generate</span></strong></span></td>
                    </tr>
                    <tr>
                            <td width="30%" >&nbsp;<label style="font-size: 16px;">Report Biaya </label></td><td>
                              <table>
                                  <tr><td>Tahun :</td><td><input type="text" class="form-control pull-right" id="tglbiaya" name="tglbiaya" required value="<?php echo substr($harinow,0,4);?>"></td></tr>
                              </table>
                            </td><td align="center" style="font-weight: bold; font-size: 14px;"><span style="cursor: pointer;" onclick="eksporbiaya()">Generate</span></strong></span></td>
                    </tr>
                    <tr>

                            <td width="30%" >&nbsp;<label style="font-size: 16px;">Laba Rugi </label></td><td>
                              <table border="0"><tr><td>Periode :</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tgllabarugi1" name="tgllabarugi1" required value="<?php echo $harinow;?>">
                            </div></td><td>-</td><td><div class="input-group date">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="tgllabarugi2" name="tgllabarugi2" required value="<?php echo $harinow;?>">
                            </div> </td></tr></table>
                            </td><td align="center" style="font-weight: bold; font-size: 14px;"><span style="cursor: pointer;" onclick="eksporlabarugi()">Generate</span></strong></span></td>
                    </tr>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript">
    $('#tglestimasi1').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglestimasi2').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglcash1').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglcash2').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglbank1').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglbank2').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglpkb1').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglpkb2').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglpkb1a').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglpkb2a').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglkwor1').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglkwor2').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglkwor1a').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglkwor2a').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglgetpas1').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglgetpas2').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglpenj1').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglpenj2').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglbukebesar1').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tglbukebesar2').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tgllabarugi1').datepicker({format: 'yyyy-mm-dd',autoclose: true,});
    $('#tgllabarugi2').datepicker({format: 'yyyy-mm-dd',autoclose: true,});

    function eksporestimasi(){
      var x =$('#tglestimasi1').val(); var y= $('#tglestimasi2').val();      
      window.location = "laporan/ekspor_estimasi.php?tgl1="+x+"&tgl2="+y;
    }

    function eksporcash(){
      var x =$('#tglcash1').val(); var y= $('#tglcash2').val();
      //alert("laporan/ekspor_cash.php?tgl1="+x+"&tgl2="+y);
      window.location = "laporan/ekspor_cash.php?tgl1="+x+"&tgl2="+y;
    }
    function eksporbank(){
      var x =$('#tglbank1').val(); var y= $('#tglbank2').val();      
      window.location = "laporan/ekspor_bank.php?tgl1="+x+"&tgl2="+y;
    }
    function eksporpkb(){
      var x =$('#tglpkb1').val(); var y= $('#tglpkb2').val();      
      window.location = "laporan/ekspor_pkb.php?tgl1="+x+"&tgl2="+y;
    }
     function eksporpkbbatal(){
      var x =$('#tglpkb1a').val(); var y= $('#tglpkb2a').val();      
      window.location = "laporan/ekspor_pkb_batal.php?tgl1="+x+"&tgl2="+y;
    }
    //=====
    function eksporkwor(){
      var x =$('#tglkwor1').val(); var y= $('#tglkwor2').val();      
      window.location = "laporan/ekspor_kwitansior.php?tgl1="+x+"&tgl2="+y;
    }
    function eksporkworbatal(){
      var x =$('#tglkwor1a').val(); var y= $('#tglkwor2a').val();      
      window.location = "laporan/ekspor_kwitansior_batal.php?tgl1="+x+"&tgl2="+y;
    }
    //=====
    function eksporgetpas(){
      var x =$('#tglgetpas1').val(); var y= $('#tglgetpas2').val();      
      window.location = "laporan/ekspor_getpas.php?tgl1="+x+"&tgl2="+y;
    }
    //=====

     function eksporpiutang(){
      var x =$('#tglpiutang1').val(); var y= $('#tglpiutang2').val();      
      window.location = "laporan/ekspor_piutang.php?tgl1="+x+"&tgl2="+y;
    }
     function eksporpenjualan(){
      var x =$('#tglpenj1').val(); var y= $('#tglpenj2').val();      
      window.location = "laporan/ekspor_penjualan.php?tgl1="+x+"&tgl2="+y;
    }

    function eksporbukubesar(){
      var x =$('#tglbukebesar1').val(); var y= $('#tglbukebesar2').val();      
      window.location = "laporan/ekspor_bukubesar.php?tgl1="+x+"&tgl2="+y;
    }
     function eksporbiaya(){
      var x =$('#tglbiaya').val();      
      window.location = "laporan/ekspor_biaya.php?tgl1="+x;
    }
    function eksporlabarugi(){
      var x =$('#tgllabarugi1').val(); var y= $('#tgllabarugi2').val();      
      window.location = "laporan/ekspor_labarugi.php?tgl1="+x+"&tgl2="+y;
    }
    
  </script>
  <style type="text/css">
.btn {
    font-weight: bold;
    padding-bottom: 0px;
    padding-top: 3px;
    padding-left: 4px;
    padding-right: 4px;
  }
  .title-header {
    font-size: 20px;
    text-align: center;
    font-weight: bold;
    font-family: monospace;
  }
  .modal-title {
    text-align: center;
  }
  </style>
      