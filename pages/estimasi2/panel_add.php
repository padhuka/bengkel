<?php
include_once '../../lib/config.php';
$idestimasi = $_GET['idestimasi'];
?>

<!-- Modern Add Panel Modal -->
<div class="modal-dialog modern-modal-dialog modal-lg">
    <div class="modal-content modern-modal-content">
        <div class="modal-header modern-modal-header">
            <button type="button" class="close modern-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title modern-modal-title" id="myModalLabel">
                <i class="fa fa-plus-circle"></i>
                Tambah Estimasi Panel
            </h4>
        </div>

        <form class="form-horizontal" id="formPanel" enctype="multipart/form-data" novalidate>
            <div class="modal-body modern-modal-body">
                <!-- Panel Selection Section -->
                <div class="panel-selection-section">
                    <h5 class="section-title">
                        <i class="fa fa-th-large"></i>
                        Pilih Panel
                    </h5>
                    <div class="panel-input-group">
                        <div class="form-group-modern">
                            <div class="input-group-modern">
                                <span class="input-group-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="hidden" id="panel" name="panel" required>
                                <input type="text" class="form-control modern-input"
                                       id="panelnm" name="panelnm"
                                       placeholder="Klik tombol Pilih untuk memilih panel"
                                       readonly required>
                                <span class="input-group-addon-btn">
                                    <button type="button" class="btn btn-modern-primary"
                                            onclick="pilihpanel()">
                                        <i class="fa fa-search"></i>
                                        Pilih Panel
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
                                               id="hargapokok" name="hargapokok"
                                               placeholder="0"
                                               required onchange="kali();">
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
                                               id="diskon" name="diskon"
                                               placeholder="0"
                                               required onchange="kali();">
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
                                               id="hargatotal" name="hargatotal"
                                               placeholder="0"
                                               readonly>
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
                                <input type="checkbox" id="cek" name="cek" onclick="cekb();">
                                <span class="checkbox-custom">
                                    <i class="fa fa-check"></i>
                                </span>
                                <span class="checkbox-text">
                                    <i class="fa fa-star"></i>
                                    Tandai panel ini
                                </span>
                            </label>
                            <input type="hidden" id="mark" name="mark" readonly>
                        </div>
                    </div>
                </div>

                <!-- Hidden Fields -->
                <input type="hidden" id="idestimasi" name="idestimasi"
                       value="<?php echo isset($idestimasi) ? htmlspecialchars($idestimasi) : ''; ?>" required>
            </div>

            <div class="modal-footer modern-modal-footer">
                <div class="form-actions">
                    <button type="button" class="btn btn-modern-secondary" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-modern-primary save_submit" name="Submit" value="SIMPAN">
                        <i class="fa fa-save"></i>
                        Simpan Panel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Container -->
<div id="ModalPilihPanel" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>

<!-- Modern JavaScript -->
<script>
$(document).ready(function() {
    $('#mark').val('0');

    // Form submission
    $("#formPanel").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'estimasi/panel_add_save.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.modal-body').css('opacity', '0.5');
            },
            success: function(data) {
                var idestimasi = '<?php echo isset($idestimasi) ? addslashes($idestimasi) : ''; ?>';
                $("#tablepanel").load('estimasi/panel_load.php?idestimasi=' + idestimasi);
                $("#tableestimasi").load('estimasi/estimasi_load.php');
                $('.modal-body').css('opacity', '');

                showNotification('Data Berhasil Disimpan', 'success');
                $('#ModalAddPanel').modal('hide');
                $("#tableestimasidetail").load('estimasi/estimasi_detail_tab.php?idestimasi=' + idestimasi);
            },
            error: function() {
                $('.modal-body').css('opacity', '');
                showNotification('Gagal menyimpan data', 'error');
            }
        });
    });
});

function pilihpanel() {
    console.log('DEBUG: panel_add.php pilihpanel() called');
    console.log('DEBUG: ModalPilihPanel element before modal load:', $('#ModalPilihPanel'));
    console.log('DEBUG: ModalPilihPanel length before modal load:', $('#ModalPilihPanel').length);

    $.ajax({
        url: 'estimasi/panel_pilih.php',
        type: 'GET',
        success: function(data) {
            console.log('DEBUG: AJAX success, loading panel modal content');
            console.log('DEBUG: Modal content received:', data.substring(0, 200) + '...');
            $('#ModalPilihPanel').html(data);
            console.log('DEBUG: Modal content loaded, showing modal');

            // Check modal visibility before showing
            console.log('DEBUG: Modal before show - display:', $('#ModalPilihPanel').css('display'));
            console.log('DEBUG: Modal before show - visibility:', $('#ModalPilihPanel').css('visibility'));
            console.log('DEBUG: Modal before show - z-index:', $('#ModalPilihPanel').css('z-index'));

            $("#ModalPilihPanel").modal({backdrop: 'static', keyboard: false});

            // Add event listener to track modal hidden events
            $('#ModalPilihPanel').on('hidden.bs.modal', function () {
                console.log('DEBUG: ModalPilihPanel hidden event fired');
                console.log('DEBUG: Checking parent modal status after selection modal hidden');

                // Check parent modal (ModalAddPanel) status
                var parentModal = $('#ModalAddPanel');
                console.log('DEBUG: Parent modal exists:', parentModal.length > 0);
                console.log('DEBUG: Parent modal display:', parentModal.css('display'));
                console.log('DEBUG: Parent modal visibility:', parentModal.css('visibility'));
                console.log('DEBUG: Parent modal has show class:', parentModal.hasClass('show'));
                console.log('DEBUG: Parent modal z-index:', parentModal.css('z-index'));

                // Check backdrop status
                console.log('DEBUG: Backdrop count:', $('.modal-backdrop').length);
                console.log('DEBUG: Body has modal-open class:', $('body').hasClass('modal-open'));

                // Check if body scroll is disabled
                console.log('DEBUG: Body overflow:', $('body').css('overflow'));
                console.log('DEBUG: Body padding-right:', $('body').css('padding-right'));

                // Force parent modal to be visible and interactive
                setTimeout(function() {
                    console.log('DEBUG: Forcing parent modal visibility');

                    // Clean up all modal state completely
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open').css({
                        'overflow': '',
                        'padding-right': ''
                    });

                    // Reset all modal states
                    $('.modal').removeClass('show').css('display', 'none');

                    // Reinitialize parent modal properly
                    setTimeout(function() {
                        console.log('DEBUG: Reinitializing parent modal state');

                        // Force show modal using direct DOM manipulation
                        parentModal.addClass('show').css('display', 'block');

                        // Create and show backdrop manually
                        var backdrop = $('<div></div>').addClass('modal-backdrop fade show');
                        $('body').append(backdrop);

                        // Add body modal-open class
                        $('body').addClass('modal-open');

                        console.log('DEBUG: Parent modal reinitialized');

                        // Verify modal state after reinitialization
                        setTimeout(function() {
                            console.log('DEBUG: Verifying parent modal state after reinitialization');
                            console.log('DEBUG: Parent modal display after reinit:', parentModal.css('display'));
                            console.log('DEBUG: Parent modal has show class after reinit:', parentModal.hasClass('show'));
                            console.log('DEBUG: Body has modal-open after reinit:', $('body').hasClass('modal-open'));
                            console.log('DEBUG: Backdrop count after reinit:', $('.modal-backdrop').length);
                            console.log('DEBUG: Final parent modal z-index:', parentModal.css('z-index'));

                            // Test form interactivity
                            var formField = $('#panelnm');
                            console.log('DEBUG: Form field exists and is visible:', formField.length > 0 && formField.is(':visible'));
                            console.log('DEBUG: Form field is focusable:', !formField.prop('disabled'));

                            // Ensure modal is on top
                            parentModal.css('z-index', '1050');
                        }, 150);
                    }, 100);
                }, 50);
            });

            // Force modal to show properly
            setTimeout(function() {
                $('#ModalPilihPanel').addClass('show').css('display', 'block');
                console.log('DEBUG: Forced modal to show with display: block and show class');

                // Check modal visibility after showing
                console.log('DEBUG: Modal after show - display:', $('#ModalPilihPanel').css('display'));
                console.log('DEBUG: Modal after show - visibility:', $('#ModalPilihPanel').css('visibility'));
                console.log('DEBUG: Modal after show - z-index:', $('#ModalPilihPanel').css('z-index'));
                console.log('DEBUG: Modal has show class:', $('#ModalPilihPanel').hasClass('show'));
                console.log('DEBUG: Modal dialog display:', $('#ModalPilihPanel .modal-dialog').css('display'));
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

function cekb() {
    if (document.getElementById('cek').checked) {
        $('#mark').val('1');
    } else {
        $('#mark').val('0');
    }
}

function kali() {
    var hargaPokok = parseFloat($("#hargapokok").val()) || 0;
    var diskon = parseFloat($("#diskon").val()) || 0;
    var hasil = hargaPokok - (diskon * hargaPokok / 100);
    $("#hargatotal").val(hasil.toFixed(2));
}

// Global function to handle panel selection from AJAX-loaded content
window.pilihpanel = function(a, b, c, d, e) {
    console.log('DEBUG: Global pilihpanel called with params:', a, b, c, d, e);

    try {
        $("#panel").val(a);
        console.log('DEBUG: Set panel value to:', a);

        $("#panelnm").val(b);
        console.log('DEBUG: Set panelnm value to:', b);

        $("#hargapokok").val(c);
        console.log('DEBUG: Set hargapokok value to:', c);

        $("#hargatotal").val(d);
        console.log('DEBUG: Set hargatotal value to:', d);

        $("#diskon").val(e);
        console.log('DEBUG: Set diskon value to:', e);

        // Trigger calculation
        kali();
        console.log('DEBUG: Triggered kali() calculation');

        // Hide the selection modal
        $("#ModalPilihPanel").modal('hide');
        console.log('DEBUG: Hidden ModalPilihPanel');

        // Show success notification
        showNotification('Panel berhasil dipilih', 'success');

    } catch (error) {
        console.error('DEBUG: Error in global pilihpanel function:', error);
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
/* Add Panel Modal Styles */
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
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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

    .panel-selection-section,
    .pricing-section,
    .options-section {
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