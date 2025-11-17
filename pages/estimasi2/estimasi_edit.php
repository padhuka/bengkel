<?php
include_once '../../lib/config.php';
include_once '../../lib/fungsi.php';

$idestimasi = $_GET['idestimasi'];
$sqles = "SELECT * FROM t_estimasi WHERE id_estimasi='$idestimasi'";
$hes = mysqli_fetch_array(mysqli_query($objConn, $sqles));

$sqlcatat = "SELECT * FROM t_inventory_bengkel A, t_warna_kendaraan B
             WHERE A.no_chasis='$hes[fk_no_chasis]' AND A.fk_warna_kendaraan=B.id_warna_kendaraan";
$swrn = mysqli_fetch_array(mysqli_query($objConn, $sqlcatat));
$wrne = $swrn['nama'];
$kdwrne = $swrn['fk_warna_kendaraan'];

$sas = "SELECT * FROM t_asuransi WHERE id_asuransi='$hes[fk_asuransi]'";
$has = mysqli_fetch_array(mysqli_query($objConn, $sas));
$nmas = $has['nama'];
?>

<!-- Modern Edit Estimasi Modal -->
<div class="modal-dialog modern-modal-dialog modal-lg">
    <div class="modal-content modern-modal-content">
        <div class="modal-header modern-modal-header">
            <button type="button" class="close modern-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title modern-modal-title" id="myModalLabel">
                <i class="fa fa-edit"></i>
                Edit Data Estimasi
            </h4>
        </div>

        <form class="form-horizontal" id="formestimasie" enctype="multipart/form-data" novalidate>
            <div class="modal-body modern-modal-body">
                <!-- Vehicle Information Section -->
                <div class="vehicle-info-section">
                    <h5 class="section-title">
                        <i class="fa fa-car"></i>
                        Informasi Kendaraan
                    </h5>
                    <div class="info-grid">
                        <div class="info-item">
                            <label class="info-label">
                                <i class="fa fa-calendar"></i>
                                Tgl Masuk
                            </label>
                            <div class="info-value">
                                <div class="form-group-modern">
                                    <div class="input-group-modern">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control modern-input"
                                               id="tgl" name="tgl"
                                               value="<?php echo date('d-m-Y', strtotime($hes['tgl'])); ?>"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <label class="info-label">
                                <i class="fa fa-car"></i>
                                No Chasis
                            </label>
                            <div class="info-value">
                                <div class="chasis-input-group">
                                    <div class="form-group-modern">
                                        <div class="input-group-modern">
                                            <span class="input-group-addon">
                                                <i class="fa fa-car"></i>
                                            </span>
                                            <input type="text" class="form-control modern-input"
                                                   id="chasise" name="chasise"
                                                   value="<?php echo htmlspecialchars($hes['fk_no_chasis']); ?>"
                                                   readonly>
                                            <span class="input-group-addon-btn">
                                                <button type="button" class="btn btn-modern-primary"
                                                        onclick="editChasis()">
                                                    <i class="fa fa-search"></i>
                                                    Pilih
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <label class="info-label">
                                <i class="fa fa-cogs"></i>
                                No Mesin
                            </label>
                            <div class="info-value">
                                <div class="form-group-modern">
                                    <div class="input-group-modern">
                                        <span class="input-group-addon">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                        <input type="text" class="form-control modern-input"
                                               id="mesine" name="mesine"
                                               value="<?php echo htmlspecialchars($hes['fk_no_mesin']); ?>"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <label class="info-label">
                                <i class="fa fa-id-card"></i>
                                No Polisi
                            </label>
                            <div class="info-value">
                                <div class="form-group-modern">
                                    <div class="input-group-modern">
                                        <span class="input-group-addon">
                                            <i class="fa fa-id-card"></i>
                                        </span>
                                        <input type="text" class="form-control modern-input"
                                               id="polisie" name="polisie"
                                               value="<?php echo htmlspecialchars($hes['fk_no_polisi']); ?>"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <label class="info-label">
                                <i class="fa fa-palette"></i>
                                Warna
                            </label>
                            <div class="info-value">
                                <div class="form-group-modern">
                                    <div class="input-group-modern">
                                        <span class="input-group-addon">
                                            <i class="fa fa-palette"></i>
                                        </span>
                                        <input type="text" class="form-control modern-input"
                                               id="warnanme" name="warnanme"
                                               value="<?php echo htmlspecialchars($wrne); ?>"
                                               readonly>
                                        <input type="hidden" id="warnae" name="warnae"
                                               value="<?php echo htmlspecialchars($kdwrne); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="section-divider">

                <!-- Estimasi Details Section -->
                <div class="estimasi-details-section">
                    <h5 class="section-title">
                        <i class="fa fa-info-circle"></i>
                        Detail Estimasi
                    </h5>
                    <div class="details-grid">
                        <div class="detail-item">
                            <label class="info-label">
                                <i class="fa fa-tags"></i>
                                Kategori
                            </label>
                            <div class="info-value">
                                <div class="form-group-modern">
                                    <div class="input-group-modern">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tags"></i>
                                        </span>
                                        <select class="form-control modern-select"
                                                id="kategorie" name="kategorie"
                                                onchange="selectKategorie()">
                                            <option value="<?php echo htmlspecialchars($hes['kategori']); ?>">
                                                <?php echo htmlspecialchars($hes['kategori']); ?>
                                            </option>
                                            <option value="Pribadi">Pribadi</option>
                                            <option value="Asuransi">Asuransi</option>
                                        </select>
                                        <span class="input-group-addon-btn" id="buttonAsuransie">
                                            <button type="button" class="btn btn-modern-warning"
                                                    onclick="selectAsuransie()">
                                                <i class="fa fa-search"></i>
                                                Pilih Asuransi
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="detail-item" id="showAsuransie">
                            <label class="info-label">
                                <i class="fa fa-shield-alt"></i>
                                Nama Asuransi
                            </label>
                            <div class="info-value">
                                <div class="form-group-modern">
                                    <div class="input-group-modern">
                                        <span class="input-group-addon">
                                            <i class="fa fa-shield-alt"></i>
                                        </span>
                                        <input type="text" class="form-control modern-input"
                                               id="asuransinme" name="asuransinme"
                                               value="<?php echo htmlspecialchars($nmas); ?>"
                                               readonly>
                                        <input type="hidden" id="asuransie" name="asuransie"
                                               value="<?php echo htmlspecialchars($hes['fk_asuransi']); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="detail-item">
                            <label class="info-label">
                                <i class="fa fa-tachometer-alt"></i>
                                KM Masuk
                            </label>
                            <div class="info-value">
                                <div class="form-group-modern">
                                    <div class="input-group-modern">
                                        <span class="input-group-addon">
                                            <i class="fa fa-tachometer-alt"></i>
                                        </span>
                                        <input type="text" class="form-control modern-input"
                                               id="kmmasuke" name="kmmasuke"
                                               value="<?php echo htmlspecialchars($hes['km_masuk']); ?>"
                                               required>
                                        <span class="input-group-addon">KM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hidden Fields -->
                <input type="hidden" id="idestimasie" name="idestimasie"
                       value="<?php echo htmlspecialchars($idestimasi); ?>" readonly>
                <input type="hidden" id="customere" name="customere"
                       value="<?php echo htmlspecialchars($hes['fk_customer']); ?>" readonly>
            </div>

            <div class="modal-footer modern-modal-footer">
                <div class="form-actions">
                    <button type="button" class="btn btn-modern-secondary" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-modern-primary save_submit" name="Submit" value="SIMPAN">
                        <i class="fa fa-save"></i>
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Containers -->
<div id="ModalChasisEdit" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
<div id="ModalAsuransiEdit" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>

<?php include_once 'estimasi_chasis_edit_tab.php'; ?>
<?php include_once 'estimasi_asuransi_edit_tab.php'; ?>

<!-- Modern JavaScript -->
<script>
$(document).ready(function() {
    // Initialize category selection
    selectKategorie();

    // Form submission
    $("#formestimasie").on('submit', function(e) {
        var chs = $("#chasise").val();
        var km = $("#kmmasuke").val();

        if (chs === '') {
            showNotification('Data ada yang belum diisi', 'warning');
            return false;
        }

        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'estimasi/estimasi_edit_save.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.modal-body').css('opacity', '0.5');
            },
            success: function(data) {
                $("#tableestimasi").load('estimasi/estimasi_load.php');
                $('.modal-body').css('opacity', '');

                showNotification('Data Berhasil Disimpan', 'success');
                $('#ModalEdit').modal('hide');

                var hsl = data.trim();
                $.ajax({
                    url: "estimasi/estimasi_detail.php?idestimasi=" + hsl,
                    type: "GET",
                    success: function(ajaxData) {
                        $("#ModalEstimasiDet").html(ajaxData);
                        $("#ModalEstimasiDet").modal({backdrop: 'static', keyboard: false});
                    }
                });
            },
            error: function() {
                $('.modal-body').css('opacity', '');
                showNotification('Gagal menyimpan data', 'error');
            }
        });
    });
});

function selectKategorie() {
    var infor = $('#kategorie').val();
    if (infor === 'Asuransi') {
        $('#buttonAsuransie').show();
        $('#showAsuransie').show();
    } else if (infor === 'Pribadi') {
        $('#buttonAsuransie').hide();
        $('#showAsuransie').hide();
        $('#asuransie').val('');
        $('#asuransinme').val('');
    }
}

function selectAsuransie() {
    $("#ModalAsuransiEdit").modal('show', {backdrop: 'static', keyboard: false});
}

function editChasis() {
    $("#ModalChasisEdit").modal({backdrop: 'static', keyboard: false});
}

function showNotification(message, type = 'info') {
    const notification = $(`
        <div class="modern-notification notification-${type}">
            <i class="fa fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
            <span>${message}</span>
        </div>
    `);

    $('body').append(notification);
    notification.fadeIn(300);

    setTimeout(function() {
        notification.fadeOut(300, function() {
            $(this).remove();
        });
    }, 3000);
}
</script>

<!-- Modern CSS Styles -->
<style>
/* Edit Modal Styles */
.modern-modal-dialog.modal-lg {
    max-width: 1000px;
    width: 95%;
}

.modern-modal-header {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    color: white;
    border: none;
    padding: 1.5rem 2rem;
}

.modern-modal-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #17a2b8, #138496, #ffc107);
}

.modern-modal-title {
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: white;
}

.modern-close {
    color: white;
    opacity: 0.8;
    font-size: 1.5rem;
    transition: all 0.3s ease;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.modern-close:hover {
    opacity: 1;
    transform: rotate(90deg);
    background: rgba(255,255,255,0.1);
}

.modern-modal-content {
    border: none;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    overflow: hidden;
}

.modern-modal-body {
    padding: 2rem;
    background: #f8f9fa;
}

.modern-modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1.5rem 2rem;
    background: white;
}

/* Section Styles */
.vehicle-info-section,
.estimasi-details-section {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    margin-bottom: 1.5rem;
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.section-title i {
    color: #17a2b8;
}

/* Grid Layouts */
.info-grid,
.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1rem;
}

.info-item,
.detail-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.info-label {
    font-size: 0.85rem;
    font-weight: 500;
    color: #6c757d;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-label i {
    width: 16px;
    text-align: center;
    color: #17a2b8;
}

.info-value {
    font-size: 0.95rem;
    font-weight: 600;
    color: #2c3e50;
}

/* Form Styles */
.form-group-modern {
    margin-bottom: 0;
}

.input-group-modern {
    display: flex;
    align-items: stretch;
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid #e1e8ed;
    transition: all 0.3s ease;
}

.input-group-modern:focus-within {
    border-color: #17a2b8;
    box-shadow: 0 0 0 4px rgba(23, 162, 184, 0.1);
}

.input-group-addon {
    background: #f8f9fa;
    border: none;
    padding: 0.75rem 1rem;
    color: #17a2b8;
    border-right: 1px solid #e1e8ed;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 45px;
}

.input-group-addon-btn {
    background: transparent;
    border: none;
    padding: 0.25rem;
    display: flex;
    align-items: center;
}

.modern-input,
.modern-select {
    border: none;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    background: white;
    flex: 1;
    transition: all 0.3s ease;
}

.modern-input:focus,
.modern-select:focus {
    outline: none;
    box-shadow: none;
}

.chasis-input-group .input-group-modern {
    border-radius: 8px;
}

/* Button Styles */
.btn-modern-primary {
    background: linear-gradient(135deg, #17a2b8, #138496);
    color: white;
    border: none;
    padding: 0.75rem 1rem;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
}

.btn-modern-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
    color: white;
}

.btn-modern-warning {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    color: #212529;
    border: none;
    padding: 0.75rem 1rem;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
}

.btn-modern-warning:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
    color: #212529;
}

.btn-modern-secondary {
    background: #6c757d;
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-modern-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
    color: white;
}

.section-divider {
    border: none;
    height: 2px;
    background: linear-gradient(90deg, transparent, #e9ecef, transparent);
    margin: 2rem 0;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

/* Notification Styles */
.modern-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    z-index: 9999;
    min-width: 300px;
    transform: translateX(400px);
}

.notification-success {
    border-left: 4px solid #28a745;
    color: #28a745;
}

.notification-error {
    border-left: 4px solid #dc3545;
    color: #dc3545;
}

.notification-warning {
    border-left: 4px solid #ffc107;
    color: #ffc107;
}

.notification-info {
    border-left: 4px solid #17a2b8;
    color: #17a2b8;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-modal-dialog.modal-lg {
        margin: 1rem;
        width: calc(100% - 2rem);
    }

    .info-grid,
    .details-grid {
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }

    .form-actions {
        flex-direction: column;
    }

    .form-actions .btn {
        width: 100%;
        justify-content: center;
    }

    .modern-notification {
        right: 10px;
        left: 10px;
        min-width: auto;
        transform: translateY(-100px);
    }
}

@media (max-width: 576px) {
    .modern-modal-body {
        padding: 1.5rem;
    }

    .vehicle-info-section,
    .estimasi-details-section {
        padding: 1rem;
    }

    .section-title {
        font-size: 1rem;
    }

    .input-group-modern {
        flex-direction: column;
    }

    .input-group-addon,
    .input-group-addon-btn {
        border-right: none;
        border-bottom: 1px solid #e1e8ed;
        width: 100%;
    }
}
</style>