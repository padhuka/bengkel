
<div class="wrapper">

  <header class="main-header">
 
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar fixed-top" style="margin-left: 0px">
      <!-- Sidebar toggle button-->
    <div class="container">
      <a class="navbar-brand" href="index.php" style="color: #ccc">GEMILANG REPAIR
        </a>
      <div class="navbar-custom-menu" style="padding: 0 0 0 0;margin: 0 auto;">
        <ul class="nav navbar-nav" style="list-style: none;padding: 0;margin: 0 auto;font-size: 1px;margin-top: 8px;">
         
          <li style="display: block;margin:0;padding:0;float: left;"><a href="index.php" style="width: 100%;padding: 0.5em;"><button class="btn btn-default" style="color:red;padding: 5px 10px;">Home <i class="fa fa-home"></i></button></a></li>
          <?php if ($seskdlvl=='Umum' || $seskdlvl=='Admin'){?>
          <li style="display: block;margin:0;padding:0;float: left;"><a href="?p=inventory" style="width: 100%;padding: 0.5em;"><button class="btn btn-default" style="color:red;padding: 5px 10px;">Kartu Pelanggan <i class="fa fa-user-plus"></i></button></a></li>
          <?php } ?>
          <?php if ($seskdlvl=='Umum' || $seskdlvl=='Admin'){?>
          <li style="display: block;margin:0;padding:0;float: left;"><a href="?p=estimasi" style="width: 100%;padding: 0.5em;"><button class="btn btn-default" style="color:red;padding: 5px 10px;">Estimasi <i class="fa fa-file-text"></i></button></a></li>
          <?php }?>
          <?php if ($seskdlvl=='Admin'){?>
           <li class="dropdown" style="display: block;margin:0;padding:0;float: left;">
            <a href="#" data-toggle="dropdown" style="width: 100%;padding: 0.5em;"><button class="btn btn-default" style="color:red;padding: 5px 10px;">PKB <i class="fa fa-file-text dropdown-toggle"></i></button> </a>
            <ul class="dropdown-menu">
              <li class="header"><a href="?p=pkb">PKB</a></li> 
              <li class="header"><a href="?p=pkbbukatutup">Buka/Tutup PKB</a></li>   
               
                          </ul>
          </li><?php } ?>

          <?php if ($seskdlvl=='Umum' || $seskdlvl=='Admin'){?>
          <li style="display: block;margin:0;padding:0;float: left;"><a href="?p=panel" style="width: 100%;padding: 0.5em;"><button class="btn btn-default" style="color:red;padding: 5px 10px;">Panel <i class="fa fa-window-restore"></i></button></a></li>
          <?php }?>
            <?php if ($seskdlvl=='Umum' || $seskdlvl=='Admin'){?>
          <li style="display: block;margin:0;padding:0;float: left;"><a href="?p=part" style="width: 100%;padding: 0.5em;"><button class="btn btn-default" style="color:red;padding: 5px 10px;">Part <i class="fa fa-wrench"></i></button></a></li>
          <?php }?>
         <?php if ($seskdlvl=='Admin'){?>
           <li class="dropdown" style="display: block;margin:0;padding:0;float: left;">
            <a href="#" data-toggle="dropdown" style="width: 100%;padding: 0.5em;"><button class="btn btn-default" style="color:red;padding: 5px 10px;">Finance <i class="fa fa-usd dropdown-toggle"></i></button> </a>
            <ul class="dropdown-menu">
              <li class="header"><a href="?p=kwitansi">Kwitansi</a></li> 
              <li class="header"><a href="?p=kwitansior">Kwitansi OR</a></li>   
               <li class="header"><a href="?p=cash">Cash</a></li> 
               <li class="header"><a href="?p=bank">Bank</a></li> 
              <li class="header"><a href="?p=gatepass">Gate Pass</a></li> 
                          </ul>
          </li><?php } ?>
            <?php if ($seskdlvl=='Admin'){?>
           <li class="dropdown" style="display: block;margin:0;padding:0;float: left;">
            <a href="#" data-toggle="dropdown" style="width: 100%;padding: 0.5em;"><button class="btn btn-default" style="color:red;padding: 5px 10px;">Accounting <i class="fa fa-usd dropdown-toggle"></i></button> </a>
            <ul class="dropdown-menu">
              <li class="header"><a href="?p=mcoa">Master COA</a></li> 
              <li class="header"><a href="?p=acccash">Cash</a></li>  
              <li class="header"><a href="?p=accbank">Bank</a></li>   
               
                          </ul>
          </li><?php } ?>
          <li class="dropdown" style="display: block;margin:0;padding:0;float: left;">
            <a href="?p=laporan" style="width: 100%;padding: 0.5em;"><button class="btn btn-default" style="color:red;padding: 5px 10px;">Laporan <i class="fa fa-gears dropdown-toggle"></i></button> </a>
            <!--<ul class="dropdown-menu">
              <?php if ($seskdlvl=='SuratMasuk' || $seskdlvl=='Admin'){?>
              <li class="header"><a href="?p=lapsuratmasuk">Lap. PKB</a></li><?php }?>
              <?php if ($seskdlvl=='SuratKeluar' || $seskdlvl=='Admin'){?>
              <li class="header"><a href="?p=lapsuratkeluar">Lap. PKB Batal</a></li><?php }?>
              
            </ul>-->
          </li>
          <?php if ($seskdlvl=='Admin'){?>
           <li class="dropdown" style="display: block;margin:0;padding:0;float: left;">
            <a href="#" data-toggle="dropdown" style="width: 100%;padding: 0.5em;"><button class="btn btn-default" style="color:red;padding: 5px 10px;">Master <i class="fa fa-gears dropdown-toggle"></i></button> </a>
            <ul class="dropdown-menu">
              <li class="header"><a href="?p=customer">Customer</a></li> 
              <li class="header"><a href="?p=asuransi">Asuransi</a></li>   
              <li class="header"><a href="?p=supplier">Supplier</a></li>
              <li class="header"><a href="?p=partnerbank">Partner Bank</a></li>
              <li class="header"><a href="?p=satuan">Satuan</a></li>
              <li class="header"><a href="?p=part">Part</a></li>
              <li class="header"><a href="?p=panel">Panel</a></li>   
              <li class="header"><a href="?p=group">Group Kendaraan</a></li>   
              <li class="header"><a href="?p=tipe">Tipe Kendaraan</a></li>   
              <li class="header"><a href="?p=warna">Warna Kendaraan</a></li>   
              <li class="header">----------------------------------</li>
              <li class="header"><a href="?p=backup">Backup Database</a></li>
            <!--   <li class="header"><a href="?p=user">User</a></li>   
              <li class="header"><a href="?p=company">Company</a></li> 
              <li class="header"><a href="?p=backup">Backup Database</a></li>
              <li class="header"><a href="?p=restore">Restore Database</a></li>
              <li class="header"><a href="?p=backupfile">Backup File</a></li> -->
            </ul>
          </li><?php } ?>

          <li class="dropdown" style="display: block;margin:0;padding:0;float: left;" class="dropdown notifications-menu">
            <a href="login/logout.php" style="width: 100%;padding: 0.5em;"><button class="btn btn-default" style="color:red;padding: 5px 10px;">Logout <i class="fa fa-sign-out"></i></button></a></li>

          </li>

        </ul>
      </div>
    </div>
    </nav>
  </header>

  <style type="text/css">
    .navbar-brand {
     font-weight: bold;
     font-family: serif;

    }
    .container {
      width: 1250px;
    }
    .layout-boxed .wrapper {
      max-width: 1250px;
    }  
    .dropdown-menu {
    margin: 0;
    list-style: none;
    white-space: nowrap;
    border: 1px solid lightgrey;
    padding: 5px;
    background-color: #ecf0f5;
    font-family: sans-serif;
   }
   .skin-red-light .main-header .navbar {
    background-color:#1585c3;
   }


 </style>