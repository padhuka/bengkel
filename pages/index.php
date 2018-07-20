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
                        case 'asuransi' : include_once 'asuransi/asuransi_tab.php'; break;
                        case 'supplier' : include_once 'supplier/supplier_tab.php'; break;
                        case 'satuan' : include_once 'satuan/satuan_tab.php'; break;
                        case 'warna' : include_once 'warna/warna_tab.php'; break;
                        case 'group' : include_once 'group/group_tab.php'; break;
                        // case 'backup' : include_once 'database/backup.php'; break;
                        // case 'restore' : include_once 'database/restore.php'; break;
                        // case 'backupfile' : include_once 'database/backupfile.php'; break;
                        // //LAPORAN
                        // case 'lapsuratmasuk' : include_once 'laporan/lapsuratmasuk_tab.php'; break;
                        // case 'lapsuratkeluar' : include_once 'laporan/lapsuratkeluar_tab.php'; break;
                        // case 'lapsuratkeputusan' : include_once 'laporan/lapsuratkeputusan_tab.php'; break;
                        // case 'laparsip' : include_once 'laporan/laparsip_tab.php'; break; 
                        
                   
                }
        ?>

<?php include_once 'footer.php';?>


