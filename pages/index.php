<?php include_once 'header.php';?>
<?php include_once 'header_menu.php';?>
        <?php
            if(!empty($_GET["p"])){
                $pag = $_GET["p"];}else{
                    $pag="";
                }
                //echo $h;
                switch($pag){
                        default : include_once 'middle.php'; break;
                        ## AREA ##
                        case 'suratmasuk' : include_once 'suratmasuk/suratmasuk_tab.php'; break;
                        case 'suratkeluar' : include_once 'suratkeluar/suratkeluar_tab.php'; break;
                        case 'suratkeputusan' : include_once 'suratkeputusan/suratkeputusan_tab.php'; break;
                        case 'arsip' : include_once 'arsip/arsip_tab.php'; break;
                        case 'pengirim' : include_once 'pengirim/pengirim_tab.php'; break;
                        case 'pejabat' : include_once 'pejabat/pejabat_tab.php'; break;
                        case 'klasifikasi' : include_once 'klasifikasi/klasifikasi_tab.php'; break;
                        case 'kodesurat' : include_once 'kodesurat/kodesurat_tab.php'; break;
                        case 'kodewilayah' : include_once 'kodewilayah/kodewilayah_tab.php'; break;
                        case 'tujuan' : include_once 'tujuan/tujuan_tab.php'; break;
                        case 'admin' : include_once 'admin/admin_tab.php'; break;
                        case 'backup' : include_once 'database/backup.php'; break;
                        case 'restore' : include_once 'database/restore.php'; break;
                        case 'backupfile' : include_once 'database/backupfile.php'; break;
                        //LAPORAN
                        case 'lapsuratmasuk' : include_once 'laporan/lapsuratmasuk_tab.php'; break;
                        case 'lapsuratkeluar' : include_once 'laporan/lapsuratkeluar_tab.php'; break;
                        case 'lapsuratkeputusan' : include_once 'laporan/lapsuratkeputusan_tab.php'; break;
                        case 'laparsip' : include_once 'laporan/laparsip_tab.php'; break; 
                        
                   
                }
        ?>

<?php include_once 'footer.php';?>


