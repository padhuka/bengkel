<!-- general form elements disabled -->
   <?php
    include_once '../../lib/config.php';
    include_once '../../lib/fungsi.php';
   ?>
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Sparepart PKB</h4>
                    </div>
				            <!--<div class="box-header with-border">
				              <h3 class="box-title">Horizontal Form</h3>
				            </div>
				             /.box-header -->
				            <!-- form start -->
                    <div class="modal-body">
				            <form class="form-horizontal" enctype="multipart/form-data" novalidate id="formSparepart">

                        <!-- PKB Selection Header -->
                        <div class="form-group">
                          <div class="col-sm-3">
                            <label for="id_pkb">No PKB</label>
                          </div>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="id_pkb" name="id_pkb" readonly required>
                          </div>
                          <div class="col-sm-2">
                            <button type="button" class="btn btn-primary btn-sm" onclick="selectPkbModal();">Pilih</button>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-12">
                            <label id="pkb_info" style="color: blue; font-weight: bold;"></label>
                          </div>
                        </div>

                        <hr style="border: 1px solid #ccc;">

                        <!-- Part Grid Section -->
                        <div class="form-group">
                          <div class="col-sm-12">
                            <h4 style="text-align: center; margin-bottom: 10px;">Daftar Part</h4>
                            <button type="button" class="btn btn-success btn-sm" onclick="addPartRow();" style="margin-bottom: 10px;">
                              <i class="fa fa-plus"></i> Tambah Part
                            </button>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-12">
                            <table id="partGrid" class="table table-condensed table-bordered table-striped">
                              <thead class="thead-light">
                                <tr>
                                  <th style="width: 35%;">Part</th>
                                  <th style="width: 20%;">Harga Beli</th>
                                  <th style="width: 20%;">Harga Jual</th>
                                  <th style="width: 15%;">Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                <!-- Rows will be added dynamically -->
                              </tbody>
                            </table>
                          </div>
                        </div>

				                <div class="form-group">
                           <div class="modal-footer">
				                  <div class="col-sm-12" style="text-align: center;">
				                    <button type="submit" class="btn btn-primary save_submit" name="Submit" value="SIMPAN">Simpan Semua</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">&nbsp;Batal&nbsp;</button>
				                  </div>
                        </div>
				                </div>

				            </form>
				          </div>
				</div>
</div>

<?php include_once 'sparepart_pkb_tab.php';?>
<?php include_once 'sparepart_part_tab.php';?>

<script type="text/javascript">
	$(document).ready(function (){

                      $("#formSparepart").on('submit', function(e){
                          e.preventDefault();

                          // Validate PKB is selected
                          if($("#id_pkb").val() == ''){
                              alert('Silakan pilih PKB terlebih dahulu');
                              return false;
                          }

                          // Count rows and validate
                          var rowCount = $("#partGrid tbody tr").length;
                          if(rowCount == 0){
                              alert('Silakan tambahkan minimal satu part');
                              return false;
                          }

                          // Validate all rows have part selected
                          var hasEmpty = false;
                          var filledCount = 0;
                          $("input[name='id_part[]']").each(function(){
                              if($(this).val() != '' && $(this).val() != undefined){
                                  filledCount++;
                              } else {
                                  hasEmpty = true;
                              }
                          });

                          if(filledCount == 0){
                              alert('Silakan pilih part dengan mengklik tombol Pilih');
                              return false;
                          }

                          if(hasEmpty){
                              alert('Semua part harus dipilih. Silakan hapus baris yang tidak diperlukan.');
                              return false;
                          }

                           						$.ajax({
                                                  type: 'POST',
                                                  url: 'sparepart/sparepart_add_save.php',
                                                  data: new FormData(this),
                                                  contentType: false,
                                                  cache: false,
                                                  processData:false,
                                                  success: function(data){
                                                        var hsl=data.trim();
                                                        if (hsl=='y'){
			                                                alert('Ada part yang sudah ada untuk PKB ini');
			                                                return false;
			                                                exit();
			                                              }else{
			                                                $("#tablesparepartContainer").load('sparepart/sparepart_load.php');
                                                                      $('.modal-body').css('opacity', '');

                                                            alert('Data Berhasil Disimpan');
                                                            $('#ModalAdd').modal('hide');
			                                            }
                                                      }
                                                });
                      });
    });

    var rowCounter = 0;
    var currentRowId = 0;

    // Tambah row baru
    function addPartRow() {
        rowCounter++;
        const newRow = `
            <tr id="row-${rowCounter}">
                <td>
                    <input type="text" name="id_part[]" id="id_part_${rowCounter}" readonly required style="width: 70%;">
                    <button type="button" class="btn btn-sm btn-primary" onclick="selectPartModal(${rowCounter})">Pilih</button>
                    <br>
                    <small id="part_info_${rowCounter}" style="color: green; font-weight: bold;"></small>
                </td>
                <td>
                    <input type="number" name="harga_beli[]" id="harga_beli_${rowCounter}" required min="0" step="0.01" class="form-control">
                </td>
                <td>
                    <input type="number" name="harga_jual[]" id="harga_jual_${rowCounter}" required min="0" step="0.01" class="form-control">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(${rowCounter})">
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                </td>
            </tr>
        `;
        $("#partGrid tbody").append(newRow);
    }

    // Hapus row
    function removeRow(rowId) {
        $("#row-" + rowId).remove();
    }

    // Select PKB Modal
    function selectPkbModal() {
        $("#ModalPkb").modal({backdrop: 'static',keyboard:false});
    }

    // Dipanggil saat PKB dipilih dari modal
    function selectPKB(id_pkb, no_polisi, customer, tgl) {
        $("#id_pkb").val(id_pkb);
        $("#pkb_info").text("No Polisi: " + no_polisi + ", Customer: " + customer + ", Tgl: " + tgl);
        $("#ModalPkb").modal('hide');
    }

    // Select Part untuk row tertentu
    function selectPartModal(rowId) {
        currentRowId = rowId;
        $("#ModalPart").modal({backdrop: 'static',keyboard:false});
    }

    // Dipanggil saat Part dipilih dari modal
    function selectPart(id_part, nama_part, harga_beli, harga_jual) {
        $("#id_part_" + currentRowId).val(id_part);
        $("#part_info_" + currentRowId).text(nama_part);
        $("#harga_beli_" + currentRowId).val(harga_beli);
        $("#harga_jual_" + currentRowId).val(harga_jual);
        $("#ModalPart").modal('hide');
    }

    // Inisialisasi dengan 1 row
    $(document).ready(function() {
        addPartRow();
    });
</script>

<style type="text/css">
  .modal-footer {
    padding-top: 10px;
    padding-bottom: 0px;
    padding-left: 0px;
    padding-right: 0px;
  }
  .modal-title {
    font-style: italic;
    background-color: lightcoral;
    text-align: center;
    font-weight: bold;
  }
  .modal-dialog {
    margin-bottom: 0px;
    border: 3px;
    width: 900px;
  }
  #partGrid th {
    background-color: #f0f0f0;
    text-align: center;
    font-weight: bold;
  }
  #partGrid td {
    padding: 5px;
  }
</style>
