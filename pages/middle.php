<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <!--<small>Aplikasi Penggajian Karyawan .:: Rumah Sakit Islam Banyubening Boyolali ::.</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="../#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <?php if ($seskdlvl=='SuratMasuk' || $seskdlvl=='Admin'){?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php $tampil=mysql_query("select * from t_surat_masuk");
                        $total=mysql_num_rows($tampil);
                    ?>
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo "$total"; ?></h3>

              <p>Surat Masuk</p>
            </div>
            <div class="icon">
              <i class="fa fa-envelope-open-o"></i>
            </div>
            <a href="?p=suratmasuk" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <?php }?>
        <!-- ./col -->
        <?php if ($seskdlvl=='SuratKeluar' || $seskdlvl=='Admin'){?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
         <?php $tampil=mysql_query("select * from t_surat_keluar");
                        $total=mysql_num_rows($tampil);
                    ?>
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo "$total"; ?></h3>

              <p>Surat Keluar</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text"></i>
            </div>
            <a href="?p=suratkeluar" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <?php }?>
        <!-- ./col -->
        <?php if ($seskdlvl=='SuratKeputusan' || $seskdlvl=='Admin'){?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
           <?php $tampil=mysql_query("select * from t_surat_keputusan");
                        $total=mysql_num_rows($tampil);
                    ?>
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo "$total"; ?></h3>

              <p>Surat Keputusan</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text"></i>
            </div>
            <a href="?p=suratkeputusan" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <?php }?>
        <!-- ./col -->
        <?php if ($seskdlvl=='Arsip' || $seskdlvl=='Admin'){?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
         <?php $tampil=mysql_query("select * from t_arsip");
                        $total=mysql_num_rows($tampil);
                    ?>
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo "$total"; ?></h3>

              <p>Arsip Pertanahan</p>
            </div>
            <div class="icon">
              <i class="fa fa-list-alt"></i>
            </div>
            <a href="?p=arsip" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <?php }?>
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->