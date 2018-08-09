  <?php
            include_once '../lib/config.php';
          ?>
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
                    <tr align="center" style="font-weight: bold;">
                        <td>Report</td><td>Field</td><td></td>
                    </tr>
                    <tr>
                        <td width="30%"> Cash</td><td>
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
                            </td><td><span onclick="eksporcash()"> Generate</span></strong></span></td>
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
    $('#tglcash1').datepicker({       
        format: 'yyyy-mm-dd',
        autoclose: true,
      });
    $('#tglcash2').datepicker({       
        format: 'yyyy-mm-dd',
        autoclose: true,
      });
    function eksporcash(){
      var x =$('#tglcash1').val(); var y= $('#tglcash2').val();
      alert("laporan/ekspor_cash.php?tgl1="+x+"&tgl2="+y);
      window.location = "laporan/ekspor_cash.php?tgl1="+x+"&tgl2="+y;
    }
    
  </script>
       