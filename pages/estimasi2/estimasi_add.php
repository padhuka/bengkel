<?php
include_once '../../lib/sess.php';
include_once '../../lib/config.php';
include_once '../../lib/fungsi.php';
?>

<!-- Modern Modal Content for Adding Estimasi -->
<div class="modal-dialog modern-modal-dialog modal-xl">
    <div class="modal-content modern-modal-content">
            <div class="modal-header modern-modal-header">
                <button type="button" class="close modern-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title modern-modal-title" id="modalAddLabel">
                    <i class="fa fa-calculator"></i>
                    Tambah Data Estimasi
                </h4>
            </div>

            <div class="modal-body modern-modal-body">
                <form class="modern-form" id="formestimasi" enctype="multipart/form-data" novalidate>
                    <div class="form-grid">
                        <!-- Tanggal Masuk -->
                        <div class="form-group">
                            <label class="modern-label">
                                <i class="fa fa-calendar"></i>
                                Tanggal Masuk
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control modern-input" id="tgl" name="tgl"
                                       value="<?php echo tampilTanggal($harinow); ?>" readonly>
                            </div>
                        </div>

                        <!-- Pilih Kendaraan -->
                        <div class="form-group">
                            <label class="modern-label">
                                <i class="fa fa-car"></i>
                                Pilih Kendaraan
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control modern-input" id="chasis" name="chasis"
                                       placeholder="Klik tombol Pilih untuk memilih kendaraan" readonly>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-modern-primary" onclick="chasise()">
                                        <i class="fa fa-search"></i>
                                        Pilih
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Kendaraan -->
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="modern-label">
                                    <i class="fa fa-cogs"></i>
                                    No Mesin
                                </label>
                                <input type="text" class="form-control modern-input" id="mesin" name="mesin" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="modern-label">
                                    <i class="fa fa-id-card"></i>
                                    No Polisi
                                </label>
                                <input type="text" class="form-control modern-input" id="polisi" name="polisi" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="modern-label">
                                    <i class="fa fa-palette"></i>
                                    Warna
                                </label>
                                <input type="text" class="form-control modern-input" id="warnanm" name="warnanm" readonly>
                                <input type="hidden" id="warna" name="warna">
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div class="form-group">
                            <label class="modern-label">
                                <i class="fa fa-tags"></i>
                                Kategori
                            </label>
                            <div class="input-group">
                                <select id="kategori" name="kategori" class="form-control modern-select">
                                    <option value="Pribadi" data-insurance="false">Pribadi</option>
                                    <option value="Asuransi" data-insurance="true">Asuransi</option>
                                </select>
                                <div class="input-group-append" id="buttonAsuransi" style="display: none;">
                                    <button type="button" class="btn btn-modern-secondary" onclick="selectAsuransi()">
                                        <i class="fa fa-shield-alt"></i>
                                        Pilih Asuransi
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Asuransi -->
                        <div class="form-group" id="showAsuransi" style="display: none;">
                            <label class="modern-label">
                                <i class="fa fa-shield-alt"></i>
                                Informasi Asuransi
                            </label>
                            <input type="text" class="form-control modern-input" id="asuransinm" name="asuransinm"
                                   placeholder="Pilih asuransi terlebih dahulu" readonly>
                            <input type="hidden" id="asuransi" name="asuransi">
                        </div>

                        <!-- Detail Estimasi -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="modern-label">
                                    <i class="fa fa-tachometer-alt"></i>
                                    KM Masuk
                                </label>
                                <input type="number" class="form-control modern-input" id="kmmasuk" name="kmmasuk"
                                       placeholder="Masukkan kilometer" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="modern-label">
                                    <i class="fa fa-calendar-check"></i>
                                    Tgl. Estimasi Selesai
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control modern-input" id="tglselesai" name="tglselesai"
                                           value="<?php echo $harinow; ?>" required>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Fields -->
                        <input type="hidden" id="uname" name="uname" value="<?php echo $sesuname; ?>">
                        <input type="hidden" id="customer" name="customer">
                    </div>
                </form>
            </div>

            <div class="modal-footer modern-modal-footer">
                <div class="form-actions">
                    <button type="submit" form="formestimasi" class="btn btn-modern-primary save_submit">
                        <i class="fa fa-save"></i>
                        Simpan Estimasi
                    </button>
                    <button type="button" class="btn btn-modern-secondary" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Child modals will be loaded dynamically when needed -->

<!-- Modern JavaScript -->
<script>
$(document).ready(function() {
    // Initialize date picker
    $('#tglselesai').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });

    // Handle kategori change
    $('#kategori').on('change', function() {
        const selectedOption = $(this).find('option:selected');
        const isInsurance = selectedOption.data('insurance');

        if (isInsurance) {
            $('#buttonAsuransi, #showAsuransi').slideDown(300);
        } else {
            $('#buttonAsuransi, #showAsuransi').slideUp(300);
            $('#asuransi, #asuransinm').val('');
        }
    });

    // Form submission
    $("#formestimasi").on('submit', function(e) {
        e.preventDefault();

        const chasis = $("#chasis").val();
        const km = $("#kmmasuk").val();

        if (chasis === '') {
            showNotification('Silakan pilih kendaraan terlebih dahulu', 'warning');
            return false;
        }

        if (km === '') {
            showNotification('KM masuk harus diisi', 'warning');
            return false;
        }

        // Show loading
        const submitBtn = $('.save_submit');
        const originalText = submitBtn.html();
        submitBtn.html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...').prop('disabled', true);

        $.ajax({
            type: 'POST',
            url: 'estimasi/estimasi_add_save.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#tableestimasi").load('estimasi/estimasi_load.php');

                // Use force close method instead of jQuery modal
                if (typeof window.closeEstimasiModal === 'function') {
                    window.closeEstimasiModal();
                } else {
                    $('#ModalAdd').modal('hide');
                }

                showNotification('Data estimasi berhasil disimpan', 'success');

                const hsl = data.trim();
                if (hsl) {
                    $.ajax({
                        url: "estimasi/estimasi_detail.php?idestimasi=" + hsl,
                        type: "GET",
                        success: function(ajaxData) {
                            $("#ModalEstimasiDet").html(ajaxData);
                            $("#ModalEstimasiDet").modal({backdrop: 'static', keyboard: false});
                        }
                    });
                }
            },
            error: function() {
                showNotification('Terjadi kesalahan saat menyimpan data', 'error');
            },
            complete: function() {
                submitBtn.html(originalText).prop('disabled', false);
            }
        });
    });
});

function selectAsuransi() {
    $.ajax({
        url: 'estimasi/estimasi_asuransi_tab.php',
        type: 'GET',
        success: function(data) {
            $("#ModalAsuransi").html(data);
            $("#ModalAsuransi").modal({backdrop: 'static', keyboard: false});
        },
        error: function() {
            showNotification('Gagal memuat data asuransi', 'error');
        }
    });
}

function chasise() {
    $.ajax({
        url: 'estimasi/estimasi_chasis_tab.php',
        type: 'GET',
        success: function(data) {
            $("#ModalChasis").html(data);
            $("#ModalChasis").modal({backdrop: 'static', keyboard: false});
        },
        error: function() {
            showNotification('Gagal memuat data kendaraan', 'error');
        }
    });
}

function showNotification(message, type = 'info') {
    const notification = $(`
        <div class="modern-notification notification-${type}">
            <i class="fa fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
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

<!-- Modern Modal Styles -->
<style>
/* Modern Modal Base Styles */
.modern-modal {
    z-index: 1050;
}

.modern-modal-dialog {
    margin: 2rem auto;
    max-width: 900px;
    position: relative;
}

.modern-modal-content {
    border: none;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    display: flex;
    flex-direction: column;
    max-height: 100vh;
    overflow: hidden;
}

.modern-modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 2rem;
    border-radius: 16px 16px 0 0;
}

.modern-modal-title {
    font-weight: 600;
    margin: 0;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.modern-close {
    color: white;
    opacity: 0.8;
    font-size: 1.5rem;
    transition: all 0.3s ease;
}

.modern-close:hover {
    opacity: 1;
    transform: rotate(90deg);
}

.modern-modal-body {
    flex: 1;
    overflow-y: auto;
    padding: 2.5rem;
    background: #f8f9fa;
}

.modern-modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1.5rem 2.5rem;
    background: white;
    border-radius: 0 0 16px 16px;
}

/* Modern Form Styles */
.modern-form {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.form-grid {
    display: grid;
    gap: 1.5rem;
}

.form-group {
    margin-bottom: 0;
}

.modern-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.modern-label i {
    width: 20px;
    text-align: center;
    color: #667eea;
}

.modern-input, .modern-select {
    border: 2px solid #e1e8ed;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: white;
}

.modern-input:focus, .modern-select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.modern-input:read-only {
    background: #f8f9fa;
    color: #6c757d;
}

.input-group {
    display: flex;
    align-items: stretch;
}

.input-group-text {
    border: 2px solid #e1e8ed;
    border-right: none;
    background: #f8f9fa;
    color: #667eea;
    border-radius: 8px 0 0 8px;
}

.input-group-append .btn, .input-group-prepend .btn {
    border-radius: 0 8px 8px 0;
}

/* Modern Buttons */
.btn-modern-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
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

.btn-modern-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
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
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
    color: white;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    width: 100%;
}

/* Modern Notifications */
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
    max-width: 300px;
}

.notification-success {
    border-left: 4px solid #28a745;
    color: #28a745;
}

.notification-warning {
    border-left: 4px solid #ffc107;
    color: #856404;
}

.notification-error {
    border-left: 4px solid #dc3545;
    color: #dc3545;
}

.notification-info {
    border-left: 4px solid #17a2b8;
    color: #17a2b8;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-modal-dialog {
        margin: 1rem;
        max-width: calc(100% - 2rem);
    }

    .modern-modal-body {
        padding: 1.5rem;
    }

    .modern-form {
        padding: 1.5rem;
    }

    .form-actions {
        flex-direction: column;
    }

    .btn-modern-primary, .btn-modern-secondary {
        width: 100%;
        justify-content: center;
    }
}

/* Bootstrap Overrides */
.modal-backdrop {
    z-index: 1040;
}

.modal-open .modal {
    overflow-x: hidden;
    overflow-y: auto;
}
</style>