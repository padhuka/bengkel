<!-- general form elements disabled -->
   <?php

    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
    $nobukti= $_GET['nobukti'];
    $sqlcatat = "SELECT * FROM t_bank WHERE no_bukti='$nobukti'";
                                    $rescatat = mysql_query( $sqlcatat );
                                    $catat = mysql_fetch_array( $rescatat );
   ?>
<div class="modal-dialog">
           <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center;padding-right: 0px">No. Kwitansi : <?php echo $nobukti;?><button type="button" class="close" aria-label="Close" onclick="$('#ModalBankPrint').modal('hide');"><span>&times;</span></button></h4>                    
                    </div>
                  
                    <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formcash">
                      
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="tgltransaksi">Tgl Transaksi</label>
                          </div>
                          <div class="col-sm-8">
                            <?php echo date('d-m-Y' , strtotime($catat['tgl_transaksi']));?>
                          </div>
                        </div> 
                    
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="tipetransaksi">Tipe Transaksi</label>
                          </div>
                            <div class="col-sm-8">
                                <?php echo $catat['tipe_transaksi'];?>
                            </div>
                        </div>

                        <div class="form-group" id="showPkb">
                          <div class="col-sm-3">
                            <label for="namapkb">No Ref</label>
                          </div>
                            <div class="col-sm-8">
                                <?php echo $catat['no_ref'];?>
                            </div>
                              
                        </div>
                    
                       
                           <div class="form-group">
                            <div class="col-sm-3">
                          <label for="diterima">DiTerima Dari/Diberikan Kepada</label>
                        </div>
                          <div class="col-sm-8">
                              <?php echo $catat['diterima_dari'];?>
                          </div>
                        </div>
                          <div class="form-group">
                            <div class="col-sm-3">
                          <label for="total">Total</label>
                        </div>
                          <div class="col-sm-8">
                            <?php echo rupiah2($catat['total']);?>
                          </div>
                        </div>
                          <div class="form-group">
                            <div class="col-sm-3">
                          <label for="keterangan">Keterangan</label>
                        </div>
                          <div class="col-sm-8">
                            <?php echo $catat['keterangan'];?>
                          </div>
                        </div>
                                            
                        <div class="form-group">
                           <div class="modal-footer">
                          <div class="col-sm-8">
                           <a href="bank/bank_cetak.php?nobukti=<?php echo $nobukti;?>" target="blank"><button type="button" class="btn btn-primary" name="close" onclick="cetak();">Print</button></a>
                                    <button type="button" class="btn btn-primary" name="close" onclick="$('#ModalBankPrint').modal('hide');">Close</button>
                          </div>
                        </div>
                        </div>

                    </form>
              
        </div>
</div>
