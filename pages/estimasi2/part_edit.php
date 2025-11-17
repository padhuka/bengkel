<?php
include_once '../../lib/config.php';
$idestimasi = $_GET['idestimasi'];
$id = $_GET['id'];

$sqlpan = "SELECT * FROM t_estimasi_part_detail WHERE id='$id'";
$hslpan = mysqli_fetch_array(mysqli_query($objConn, $sqlpan));

$snm = "SELECT * FROM t_part WHERE id_part='$hslpan[fk_part]'";
$hnm = mysqli_fetch_array(mysqli_query($objConn, $snm));
?>

<!-- Modern Edit Part Modal -->
<div class="modal-dialog modern-modal-dialog modal-lg">
    <div class="modal-content modern-modal-content">
        <div class="modal-header modern-modal-header">
            <button type="button" class="close modern-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title modern-modal-title" id="myModalLabel">
                <i class="fa fa-edit"></i>
                Edit Data Part
            </h4>
        </div>

        <form class="form-horizontal" id="formpartEdit" enctype="multipart/form-data" novalidate>
            <div class="modal-body modern-modal-body">
                <!-- Part Selection Section -->
                <div class="part-selection-section">
                    <h5 class="section-title">
                        <i class="fa fa-wrench"></i>
                        Informasi Part
                    </h5>
                    <div class="part-input-group">
                        <div class="form-group-modern">
                            <div class="input-group-modern">
                                <span class="input-group-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="hidden" id="parte" name="parte" value="<?php echo $hslpan['fk_part']; ?>" required>
                                <input type="text" class="form-control modern-input"
                                       id="partnme" name="partnme"
                                       value="<?php echo htmlspecialchars($hnm['nama']); ?>"
                                       readonly required>
                                <span class="input-group-addon-btn">
                                    <button type="button" class="btn btn-modern-primary"
                                            onclick="pilihpartep()">
                                        <i class="fa fa-edit"></i>
                                        Ubah Part
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
                        Informasi Harga & Kuantitas
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
                                               id="hargapokokep" name="hargapokokep"
                                               value="<?php echo $hslpan['harga_jual_part']; ?>"
                                               required onchange="kaliep();">
                                        <input type="hidden" id="hargapokoklmep" name="hargapokoklmep"
                                               value="<?php echo $hslpan['harga_jual_part']; ?>" readonly>
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
                                               id="diskonep" name="diskonep"
                                               value="<?php echo $hslpan['diskon_part']; ?>"
                                               required onchange="kaliep();">
                                        <input type="hidden" id="hargadiskonlmep" name="hargadiskonlmep"
                                               value="<?php echo $hslpan['harga_diskon_part']; ?>" readonly>
                                        <span class="input-group-addon">
                                            %
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pricing-item">
                            <label class="info-label">
                                <i class="fa fa-cubes"></i>
                                Kuantitas
                            </label>
                            <div class="info-value">
                                <div class="form-group-modern">
                                    <div class="input-group-modern">
                                        <input type="text" class="form-control modern-input"
                                               id="qtye" name="qtye"
                                               value="<?php echo $hslpan['qty_part']; ?>"
                                               required onchange="kaliep();">
                                        <span class="input-group-addon">
                                            <i class="fa fa-boxes"></i>
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
                                               id="hargatotalep" name="hargatotalep"
                                               value="<?php echo $hslpan['harga_total_estimasi_part']; ?>"
                                               readonly>
                                        <input type="hidden" id="hargatotallmp" name="hargatotallmp"
                                               value="<?php echo $hslpan['harga_total_estimasi_part']; ?>" readonly>
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
                                <input type="checkbox" id="cekep" name="cekep" onclick="cekbep();"
                                       <?php echo ($hslpan['mark_part'] == 1) ? 'checked' : ''; ?>>
                                <span class="checkbox-custom">
                                    <i class="fa fa-check"></i>
                                </span>
                                <span class="checkbox-text">
                                    <i class="fa fa-star"></i>
                                    Tandai part ini
                                </span>
                            </label>
                            <input type="hidden" id="markep" name="markep" readonly>
                        </div>
                    </div>
                </div>

                <!-- Hidden Fields -->
                <input type="hidden" id="idep" name="idep" value="<?php echo $id; ?>" required>
                <input type="hidden" id="idestimasiep" name="idestimasiep"
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
<div id="ModalPilihPartEdit" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>

<?php include_once 'part_pilih_edit.php'; ?>

<!-- Modern JavaScript -->
<script>
$(document).ready(function() {
    // Initialize mark value
    if (document.getElementById('cekep').checked) {
        $('#markep').val('1');
    } else {
        $('#markep').val('0');
    }

    // Form submission
    $("#formpartEdit").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'estimasi/part_edit_save.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.modal-body').css('opacity', '0.5');
            },
            success: function(data) {
                $("#estimasipart").load('estimasi/part_load.php?idestimasi=<?php echo $idestimasi; ?>');
                $("#tableestimasi").load('estimasi/estimasi_load.php');
                $('.modal-body').css('opacity', '');

                showNotification('Data Berhasil Disimpan', 'success');
                $('#ModalEditPart').modal('hide');
                $("#tableestimasidetail").load('estimasi/estimasi_detail_tab.php?idestimasi=<?php echo $idestimasi; ?>');
            },
            error: function() {
                $('.modal-body').css('opacity', '');
                showNotification('Gagal menyimpan data', 'error');
            }
        });
    });
});

function pilihpartep() {
    console.log('DEBUG: pilihpartep() called');
    console.log('DEBUG: ModalPilihPartEdit element before modal load:', $('#ModalPilihPartEdit'));
    console.log('DEBUG: ModalPilihPartEdit length before modal load:', $('#ModalPilihPartEdit').length);

    $.ajax({
        url: 'estimasi/part_pilih_edit.php',
        type: 'GET',
        success: function(data) {
            console.log('DEBUG: AJAX success, loading modal content');
            console.log('DEBUG: Modal content received:', data.substring(0, 200) + '...');
            $('#ModalPilihPartEdit').html(data);
            console.log('DEBUG: Modal content loaded, showing modal');

            // Check modal visibility before showing
            console.log('DEBUG: ModalEdit before show - display:', $('#ModalPilihPartEdit').css('display'));
            console.log('DEBUG: ModalEdit before show - visibility:', $('#ModalPilihPartEdit').css('visibility'));
            console.log('DEBUG: ModalEdit before show - z-index:', $('#ModalPilihPartEdit').css('z-index'));

            $("#ModalPilihPartEdit").modal({backdrop: 'static', keyboard: false});

            // Force modal to show properly
            setTimeout(function() {
                $('#ModalPilihPartEdit').addClass('show').css('display', 'block');
                console.log('DEBUG: Forced ModalEdit to show with display: block and show class');

                // Check modal visibility after showing
                console.log('DEBUG: ModalEdit after show - display:', $('#ModalPilihPartEdit').css('display'));
                console.log('DEBUG: ModalEdit after show - visibility:', $('#ModalPilihPartEdit').css('visibility'));
                console.log('DEBUG: ModalEdit after show - z-index:', $('#ModalPilihPartEdit').css('z-index'));
                console.log('DEBUG: ModalEdit has show class:', $('#ModalPilihPartEdit').hasClass('show'));
                console.log('DEBUG: ModalEdit dialog display:', $('#ModalPilihPartEdit .modal-dialog').css('display'));
                console.log('DEBUG: Backdrop exists:', $('.modal-backdrop').length > 0);
                console.log('DEBUG: Body has modal-open class:', $('body').hasClass('modal-open'));
            }, 100);
        },
        error: function(xhr, status, error) {
            console.log('DEBUG: AJAX error:', status, error);
            console.log('DEBUG: Response text:', xhr.responseText);
            showNotification('Gagal memuat data part', 'error');
        }
    });
}

function cekbep() {
    if (document.getElementById('cekep').checked) {
        $('#markep').val('1');
    } else {
        $('#markep').val('0');
    }
}

function kaliep() {
    var hargaPokok = parseFloat($("#hargapokokep").val()) || 0;
    var diskon = parseFloat($("#diskonep").val()) || 0;
    var qty = parseFloat($("#qtye").val()) || 0;
    var hargaSetelahDiskon = hargaPokok - (diskon * hargaPokok / 100);
    var hasil = hargaSetelahDiskon * qty;
    $("#hargatotalep").val(hasil.toFixed(2));
}

// Global function to handle part selection from AJAX-loaded content for edit modal
window.pilihpartepx = function(a, b, c, d, e) {
    console.log('DEBUG: Global pilihpartepx called with params:', a, b, c, d, e);

    try {
        $("#parte").val(a);
        console.log('DEBUG: Set parte value to:', a);

        $("#partnme").val(b);
        console.log('DEBUG: Set partnme value to:', b);

        $("#hargapokokep").val(c);
        console.log('DEBUG: Set hargapokokep value to:', c);

        $("#hargatotalep").val(d);
        console.log('DEBUG: Set hargatotalep value to:', d);

        $("#diskonep").val(e);
        console.log('DEBUG: Set diskonep value to:', e);

        $("#qtye").val('1');
        console.log('DEBUG: Set qtye value to: 1');

        // Trigger calculation
        kaliep();
        console.log('DEBUG: Triggered kaliep() calculation');

        // Hide the selection modal
        $("#ModalPilihPartEdit").modal('hide');
        console.log('DEBUG: Hidden ModalPilihPartEdit');

        // Show success notification
        showNotification('Part berhasil dipilih', 'success');

    } catch (error) {
        console.error('DEBUG: Error in global pilihpartepx function:', error);
        showNotification('Terjadi kesalahan saat memilih part', 'error');
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
/* Edit Part Modal Styles */
.modern-modal-dialog.modal-lg {
    max-width: 900px;
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
.part-selection-section,
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
    color: #17a2b8;
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
    color: #17a2b8;
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
    color: #17a2b8;
}

.modern-checkbox-label input[type="checkbox"] {
    display: none;
}

.checkbox-custom {
    width: 20px;
    height: 20px;
    border: 2px solid #17a2b8;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    transition: all 0.3s ease;
}

.modern-checkbox-label input[type="checkbox"]:checked + .checkbox-custom {
    background: #17a2b8;
    border-color: #17a2b8;
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

    .part-selection-section,
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