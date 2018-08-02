<!-- Content Wrapper. Contains page content -->
<?php
      include_once '../lib/config.php';
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 align="center">
        Flow Chart Aplikasi
        <!--<small>Aplikasi Penggajian Karyawan .:: Rumah Sakit Islam Banyubening Boyolali ::.</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="../#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
     
        <tr>
    <td width="20"></td>
    <td valign="top">
      <table id="flowchart" align="center">
              <tbody><tr>
                  <td onclick="location='#'" colspan="2">
                      <div><!--bercabang, set sendiri left nya -->
                          <div class="bawah" style="left:0px"><img style="height:20px" src="../file/panahbawah.png"></div>
              Kartu Pelanggan
            </div>
          </td>
                </tr>
              <tr>
                  
                  <td colspan="2" onclick="location='#'">
                      <div>
                          <div class="kanan" style="top:8px"><img style="height:20px" src="../file/panahkanan.png"></div>
                          <div class="bawah"><img style="height:20px" src="../file/panahbawah.png"></div>
              Estimasi
            </div>
          </td>
                  <td onclick="location='#'">
                      <div>
                          <div class="kanan" style="top:8px"><img style="height:20px" src="../file/panahkanan.png"></div>
              Cetak Kwitansi OR
            </div>
          </td>
                    <td>
                      <table height="100%" cellspacing="0" cellpadding="0">
                          <tbody><tr>
                              <td onclick="location='#'">Cash</td>
                              <td onclick="location='#'">Bank</td>
                            </tr>
                        </tbody></table>
          </td>
                </tr>
              <tr>
                  <td colspan="2" onclick="location='#'" rowspan="3">
                      <div>

                          <div class="kanan" style="top:0px"><img style="height:20px" src="../file/panahkanan.png"></div>
                          PKB
                        </div>
          </td>
       
                </tr>
              <tr>
                  
               
          </td>
                  
                </tr>
              <tr>
                  <td colspan="2" onclick="location='#'">
                      <div>
                         <div class="kanan"><img style="height:20px;padding-left:100px" src="../file/panahkanan.png"></div>
              Tutup PKB
            </div>
          </td>

                  <td onclick="location='#'">
                      <div>
                          <div class="kanan"><img style="height:20px" src="../file/panahkanan.png"></div>
              Biaya Servis
            </div>
          </td>
                  <td style="height:55px" onclick="location='#'">
                      <div>
                          <div class="kanan"><img style="height:20px" src="../file/panahkanan.png"></div>
                  Cetak Kwitansi
            </div>
          </td>
                    <td>
                      <table height="100%" cellspacing="0" cellpadding="0">
                          <tbody><tr>
                              <td onclick="location='#'">Cash</td>
                              <td onclick="location='#'">Bank</td>
                            </tr>
                        </tbody></table>
          </td>
                </tr>
            </tbody></table>
    </td>
    <td width="20"></td>
  </tr>
      
      </div>
    </section>
 
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <style type="text/css">
    
#flowchart td:not(:empty){
  font-size:12px;
  letter-spacing:1px;
  border:inset;
  width:120px;
  height:55px;
  text-align:center;
  padding:5px;
  cursor:pointer;
  background-color:#CCC;
}

#flowchart td:hover:not(:empty){
  background-color:#AAA;
}

#flowchart td table tr td:not(:empty){
  background-color:#CCC;
  border:none;
  height:0px;
}

#flowchart td table tr td:hover:not(:empty){
  background-color:#EEE;
}

#flowchart td.no-access:hover:not(:empty){
  background-color:#FF5333;
  cursor:default;
}

#flowchart td div {
  position:relative;
}

#flowchart td div div.bawah{ /* tanda panah :not(:empty)*/
  position:relative;
  height:0px;
  top:28px;
}

#flowchart td div div.kanan{ /* tanda panah :not(:empty)*/
  position:relative;
  height:0px;
  left:68px;
  top:-3px
}

#flowchart td div div.atas{ /* tanda panah :not(:empty)*/
  position:relative;
  height:0px;
  top: -21px;
}

#flowchart td div div.kiri{ /* tanda panah :not(:empty)*/
  position:relative;
  height:0px;
  left:-56px;
}
  </style>