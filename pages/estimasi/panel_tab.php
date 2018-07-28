
  <!-- Left side column. contains the logo and sidebar -->
  <?php $idestimasi=$_GET['idestimasine'];?>
  <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Data Estimasi Panel</h4></h4>
                    </div>
                    <!--<div class="box-header with-border">
                      <h3 class="box-title">Horizontal Form</h3>
                    </div>
                     /.box-header -->
                    <!-- form start -->
                    <div class="modal-body">
                      <!-- Content Wrapper. Contains page content -->
                      <div id="tablepanel"></div>
                    </div>
                </div>
</div>
      
        <div id="ModalAddPanel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
         <div id="ModalEditPanel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
         <div id="ModalDeletePanel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

        <script type="text/javascript">
            $(document).ready(function (){
                 $("#tablepanel").load('estimasi/panel_load.php?idestimasi=<?php echo $idestimasi;?>');
            });
        </script>


<style type="text/css">
  .title-header {
    font-size: 20px;
    text-align: center;
    font-weight: bold;
    font-family: monospace;
  }
</style>