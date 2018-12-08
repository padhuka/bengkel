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
                        case 'panel' : include_once 'panel/panel_tab.php'; break;
                        case 'tipe' : include_once 'tipe/tipe_tab.php'; break;
                        case 'part' : include_once 'part/part_tab.php'; break;
                        case 'inventory' : include_once 'inventory/inventory_tab.php'; break;
                        case 'customer' : include_once 'customer/customer_tab.php'; break;
                        case 'estimasi' : include_once 'estimasi/estimasi_tab.php'; break;
                        case 'part' : include_once 'part/part_tab.php'; break;
                        case 'inventory' : include_once 'inventory/inventory_tab.php'; break;
                        case 'partnerbank' : include_once 'partnerbank/partnerbank_tab.php'; break;
                        case 'customer' : include_once 'customer/customer_tab.php'; break;
                        case 'estimasi' : include_once 'estimasi/estimasi_tab.php'; break;
                        case 'pkb' : include_once 'pkb/pkb_tab.php'; break;
                        case 'kwitansior' : include_once 'kwitansior/kwitansior_tab.php'; break;
                        case 'kwitansi' : include_once 'kwitansi/kwitansi_tab.php'; break;
                        case 'pkbbukatutup' : include_once 'pkbstatus/pkb_tab.php'; break;
                        case 'cash' : include_once 'cash/cash_tab.php'; break;
                        case 'bank' : include_once 'bank/bank_tab.php'; break;
                        case 'gatepass' : include_once 'gatepass/gatepass_tab.php'; break;
                        case 'laporan' : include_once 'laporan/laporan_tab.php'; break;
                        case 'backup' : include_once 'backup/backup_tab.php'; break;
                        case 'mcoa' : include_once 'mcoa/mcoa_tab.php'; break;
                        case 'acccash' : include_once 'acccash/acccash_tab.php'; break;
                        case 'accbank' : include_once 'accbank/accbank_tab.php'; break;
                      }
        ?>

<?php include_once 'footer.php';?>


