<?php
include_once '../../lib/config.php';
$idestimasi = $_GET['idestimasi'];
$id = $_GET['id'];

$sqlpan = "SELECT * FROM t_estimasi_panel_detail WHERE id='$id'";
$hslpan = mysqli_fetch_array(mysqli_query($objConn, $sqlpan));

$snm = "SELECT * FROM t_panel WHERE id_panel='$hslpan[fk_panel]'";
$hnm = mysqli_fetch_array(mysqli_query($objConn, $snm));
?>

<!-- Modern Edit Panel Modal -->
<div class="modal-dialog modern-modal-dialog modal-lg">
    <div class="modal-content modern-modal-content">
        <div class="modal-header modern-modal-header">
            <button type="button" class="close modern-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title modern-modal-title" id="myModalLabel">
                <i class="fa fa-edit"></i>
                Edit Data Panel
            </h4>
        </div>

        <form class="form-horizontal" id="formPanelEdit" enctype="multipart/form-data" novalidate>
            <div class="modal-body modern-modal-body">
                <!-- Panel Selection Section -->
                <div class="panel-selection-section">
                    <h5 class="section-title">
                        <i class="fa fa-th-large"></i>
                        Informasi Panel
                    </h5>
                    <div class="panel-input-group">
                        <div class="form-group-modern">
                            <div class="input-group-modern">
                                <span class="input-group-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="hidden" id="panele" name="panele" value="<?php echo $hslpan['fk_panel']; ?>" required>
                                <input type="text" class="form-control modern-input"
                                       id="panelnme" name="panelnme"
                                       value="<?php echo htmlspecialchars($hnm['nama']); ?>"
                                       readonly required>
                                <span class="input-group-addon-btn">
                                    <button type="button" class="btn btn-modern-primary"
                                            onclick="pilihpanele()">
                                        <i class="fa fa-edit"></i>
                                        Ubah Panel
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="section-divider">

                <!-- Pricing Section -->
                <div class="pricing-section">
                    <h5 class="section-title">
                        <i class="fa fa-money-bill-wave"></i>
                        Informasi Harga
                    </h5>
                    <div class="pricing-grid">
                        <div class="pricing-item">
                            <label class="info-label">
                                <i class="fa fa-tag"></i>
                                Harga Pokok
                            </label>
                            <div class="info-value">
                                <div class="form-group-modern">
                                    <div class="input-group-modern">
                                        <span class="input-group-addon">
                                            Rp
                                        </span>
                                        <input type="text" class="form-control modern-input"
                                               id="hargapokoke" name="hargapokoke"
                                               value="<?php echo $hslpan['harga_jual_panel']; ?>"
                                               required onchange="kaliedit();">
                                        <input type="hidden" id="hargapokoklme" name="hargapokoklme"
                                               value="<?php echo $hslpan['harga_jual_panel']; ?>" readonly>
                                        <span class="input-group-addon">
                                            <i class="fa fa-calculator"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pricing-item">
                            <label class="info-label">
                                <i class="fa fa-percentage"></i>
                                Diskon
                            </label>
                            <div class="info-value">
                                <div class="form-group-modern">
                                    <div class="input-group-modern">
                                        <input type="text" class="form-control modern-input"
                                               id="diskone" name="diskone"
                                               value="<?php echo $hslpan['diskon_panel']; ?>"
                                               required onchange="kaliedit();">
                                        <input type="hidden" id="hargadiskonlme" name="hargadiskonlme"
                                               value="<?php echo $hslpan['harga_diskon_panel']; ?>" readonly>
                                        <span class="input-group-addon">
                                            %
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pricing-item">
                            <label class="info-label">
                                <i class="fa fa-calculator"></i>
                                Harga Total
                            </label>
                            <div class="info-value">
                                <div class="form-group-modern">
                                    <div class="input-group-modern">
                                        <span class="input-group-addon">
                                            Rp
                                        </span>
                                        <input type="text" class="form-control modern-input"
                                               id="hargatotale" name="hargatotale"
                                               value="<?php echo $hslpan['harga_total_estimasi_panel']; ?>"
                                               readonly>
                                        <input type="hidden" id="hargatotallm" name="hargatotallm"
                                               value="<?php echo $hslpan['harga_total_estimasi_panel']; ?>" readonly>
                                        <span class="input-group-addon">
                                            <i class="fa fa-check-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="section-divider">

                <!-- Options Section -->
                <div class="options-section">
                    <h5 class="section-title">
                        <i class="fa fa-cog"></i>
                        Opsi Tambahan
                    </h5>
                    <div class="options-grid">
                        <div class="option-item">
                            <label class="modern-checkbox-label">
                                <input type="checkbox" id="ceke" name="ceke" onclick="cekbe();"
                                       <?php echo ($hslpan['mark_panel'] == 1) ? 'checked' : ''; ?>>
                                <span class="checkbox-custom">
                                    <i class="fa fa-check"></i>
                                </span>
                                <span class="checkbox-text">
                                    <i class="fa fa-star"></i>
                                    Tandai panel ini
                                </span>
                            </label>
                            <input type="hidden" id="marke" name="marke" readonly>
                        </div>
                    </div>
                </div>

                <!-- Hidden Fields -->
                <input type="hidden" id="ide" name="ide" value="<?php echo $id; ?>" required>
                <input type="hidden" id="idestimasie" name="idestimasie"
                       value="<?php echo $idestimasi; ?>" required>
            </div>

            <div class="modal-footer modern-modal-footer">
                <div class="form-actions">
                    <button type="button" class="btn btn-modern-secondary" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-modern-primary save_submit" name="Submit" value="SIMPAN">
                        <i class="fa fa-save"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Container -->
<div id="ModalPilihPanelEdit" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>

<?php include_once 'panel_pilih_edit.php'; ?>

<!-- Modern JavaScript -->
<script>
$(document).ready(function() {
    // Initialize mark value
    if (document.getElementById('ceke').checked) {
        $('#marke').val('1');
    } else {
        $('#marke').val('0');
    }

    // Form submission
    $("#formPanelEdit").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'estimasi/panel_edit_save.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.modal-body').css('opacity', '0.5');
            },
            success: function(data) {
                $("#tablepanel").load('estimasi/panel_load.php?idestimasi=<?php echo $idestimasi; ?>');
                $("#tableestimasi").load('estimasi/estimasi_load.php');
                $('.modal-body').css('opacity', '');

                showNotification('Data Berhasil Disimpan', 'success');
                $('#ModalEditPanel').modal('hide');
                $("#tableestimasidetail").load('estimasi/estimasi_detail_tab.php?idestimasi=<?php echo $idestimasi; ?>');
            },
            error: function() {
                $('.modal-body').css('opacity', '');
                showNotification('Gagal menyimpan data', 'error');
            }
        });
    });
});

function pilihpanele() {
    console.log('DEBUG: pilihpanele() called');
    console.log('DEBUG: ModalPilihPanelEdit element before modal load:', $('#ModalPilihPanelEdit'));
    console.log('DEBUG: ModalPilihPanelEdit length before modal load:', $('#ModalPilihPanelEdit').length);

    $.ajax({
        url: 'estimasi/panel_pilih_edit.php',
        type: 'GET',
        success: function(data) {
            console.log('DEBUG: AJAX success, loading modal content');
            console.log('DEBUG: Modal content received:', data.substring(0, 200) + '...');
            $('#ModalPilihPanelEdit').html(data);
            console.log('DEBUG: Modal content loaded, showing modal');

            // Check modal visibility before showing
            console.log('DEBUG: ModalEdit before show - display:', $('#ModalPilihPanelEdit').css('display'));
            console.log('DEBUG: ModalEdit before show - visibility:', $('#ModalPilihPanelEdit').css('visibility'));
            console.log('DEBUG: ModalEdit before show - z-index:', $('#ModalPilihPanelEdit').css('z-index'));

            $("#ModalPilihPanelEdit").modal({backdrop: 'static', keyboard: false});

            // Force modal to show properly
            setTimeout(function() {
                $('#ModalPilihPanelEdit').addClass('show').css('display', 'block');
                console.log('DEBUG: Forced ModalEdit to show with display: block and show class');

                // Check modal visibility after showing
                console.log('DEBUG: ModalEdit after show - display:', $('#ModalPilihPanelEdit').css('display'));
                console.log('DEBUG: ModalEdit after show - visibility:', $('#ModalPilihPanelEdit').css('visibility'));
                console.log('DEBUG: ModalEdit after show - z-index:', $('#ModalPilihPanelEdit').css('z-index'));
                console.log('DEBUG: ModalEdit has show class:', $('#ModalPilihPanelEdit').hasClass('show'));
                console.log('DEBUG: ModalEdit dialog display:', $('#ModalPilihPanelEdit .modal-dialog').css('display'));
                console.log('DEBUG: Backdrop exists:', $('.modal-backdrop').length > 0);
                console.log('DEBUG: Body has modal-open class:', $('body').hasClass('modal-open'));
            }, 100);
        },
        error: function(xhr, status, error) {
            console.log('DEBUG: AJAX error:', status, error);
            console.log('DEBUG: Response text:', xhr.responseText);
            showNotification('Gagal memuat data panel', 'error');
        }
    });
}

function cekbe() {
    if (document.getElementById('ceke').checked) {
        $('#marke').val('1');
    } else {
        $('#marke').val('0');
    }
}

function kaliedit() {
    var hargaPokok = parseFloat($("#hargapokoke").val()) || 0;
    var diskon = parseFloat($("#diskone").val()) || 0;
    var hasil = hargaPokok - (diskon * hargaPokok / 100);
    $("#hargatotale").val(hasil.toFixed(2));
}

// Global function to handle panel selection from AJAX-loaded content for edit modal
window.pilihpaneledit = function(a, b, c, d, e) {
    console.log('DEBUG: Global pilihpaneledit called with params:', a, b, c, d, e);

    try {
        $("#panele").val(a);
        console.log('DEBUG: Set panele value to:', a);

        $("#panelnme").val(b);
        console.log('DEBUG: Set panelnme value to:', b);

        $("#hargapokoke").val(c);
        console.log('DEBUG: Set hargapokoke value to:', c);

        $("#hargatotale").val(d);
        console.log('DEBUG: Set hargatotale value to:', d);

        $("#diskone").val(e);
        console.log('DEBUG: Set diskone value to:', e);

        // Trigger calculation
        kaliedit();
        console.log('DEBUG: Triggered kaliedit() calculation');

        // Hide the selection modal
        $("#ModalPilihPanelEdit").modal('hide');
        console.log('DEBUG: Hidden ModalPilihPanelEdit');

        // Show success notification
        showNotification('Panel berhasil dipilih', 'success');

    } catch (error) {
        console.error('DEBUG: Error in global pilihpaneledit function:', error);
        showNotification('Terjadi kesalahan saat memilih panel', 'error');
    }
};

function showNotification(message, type) {
    type = type || 'info';
    var iconClass = 'info-circle';
    if (type === 'success') iconClass = 'check-circle';
    else if (type === 'error') iconClass = 'exclamation-circle';
    else if (type === 'warning') iconClass = 'exclamation-triangle';

    var notification = $('<div class="modern-notification notification-' + type + '">' +
        '<i class="fa fa-' + iconClass + '"></i>' +
        '<span>' + message + '</span>' +
        '</div>');

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
/* Edit Panel Modal Styles */
.modern-modal-dialog.modal-lg {
    max-width: 800px;
    width: 95%;
}

.modern-modal-header {
    background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
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
    background: linear-gradient(90deg, #6f42c1, #5a32a3, #e83e8c);
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
    max-height: 70vh;
    overflow-y: auto;
}

.modern-modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1.5rem 2rem;
    background: white;
    position: sticky;
    bottom: 0;
    z-index: 10;
}

/* Section Styles */
.panel-selection-section,
.pricing-section,
.options-section {
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
    color: #6f42c1;
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
    border-color: #6f42c1;
    box-shadow: 0 0 0 4px rgba(111, 66, 193, 0.1);
}

.input-group-addon {
    background: #f8f9fa;
    border: none;
    padding: 0.75rem 1rem;
    color: #6f42c1;
    border-right: 1px solid #e1e8ed;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 45px;
    font-weight: 600;
}

.input-group-addon-btn {
    background: transparent;
    border: none;
    padding: 0.25rem;
    display: flex;
    align-items: center;
}

.modern-input {
    border: none;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    background: white;
    flex: 1;
    transition: all 0.3s ease;
}

.modern-input:focus {
    outline: none;
    box-shadow: none;
}

.modern-input::placeholder {
    color: #adb5bd;
}

/* Pricing Grid */
.pricing-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1rem;
}

.pricing-item {
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
    color: #6f42c1;
}

.info-value {
    font-size: 0.95rem;
    font-weight: 600;
    color: #2c3e50;
}

/* Options Grid */
.options-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.option-item {
    display: flex;
    align-items: center;
}

/* Modern Checkbox */
.modern-checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    font-size: 0.95rem;
    font-weight: 500;
    color: #2c3e50;
    transition: all 0.3s ease;
}

.modern-checkbox-label:hover {
    color: #6f42c1;
}

.modern-checkbox-label input[type="checkbox"] {
    display: none;
}

.checkbox-custom {
    width: 20px;
    height: 20px;
    border: 2px solid #6f42c1;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    transition: all 0.3s ease;
}

.modern-checkbox-label input[type="checkbox"]:checked + .checkbox-custom {
    background: #6f42c1;
    border-color: #6f42c1;
}

.checkbox-custom i {
    color: white;
    font-size: 0.75rem;
    opacity: 0;
    transition: all 0.3s ease;
}

.modern-checkbox-label input[type="checkbox"]:checked + .checkbox-custom i {
    opacity: 1;
}

.checkbox-text {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.checkbox-text i {
    color: #ffc107;
}

/* Button Styles */
.btn-modern-primary {
    background: linear-gradient(135deg, #6f42c1, #5a32a3);
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
    box-shadow: 0 4px 15px rgba(111, 66, 193, 0.3);
    color: white;
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
    border-left: 4px solid #6f42c1;
    color: #6f42c1;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-modal-dialog.modal-lg {
        margin: 1rem;
        width: calc(100% - 2rem);
    }

    .pricing-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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

    .panel-selection-section,
    .pricing-section,
    .options-section {
        padding: 1rem;
    }

    .section-title {
        font-size: 1rem;
    }

    .pricing-grid {
        grid-template-columns: 1fr;
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