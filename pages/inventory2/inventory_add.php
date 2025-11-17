<?php
    include_once '../../lib/config.php';
    include_once 'inventory_warna_tab.php';
    include_once 'inventory_tipe_tab.php';
    include_once 'inventory_customer_tab.php';
?>

<div class="modal-dialog modern-modal-dialog">
    <div class="modal-content modern-modal-content">
        <div class="modal-header modern-modal-header">
            <button type="button" class="close modern-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title modern-modal-title" id="myModalLabel">
                <i class="fa fa-plus-circle"></i>
                Tambah Data Inventory
            </h4>
        </div>

        <div class="modal-body modern-modal-body">
            <form class="modern-form" id="formInventory" enctype="multipart/form-data" novalidate>
                <div class="form-row">
                    <div class="form-group modern-form-group">
                        <label for="nochasis" class="modern-label">
                            <i class="fa fa-car"></i>
                            No Chasis
                        </label>
                        <input type="text" class="form-control modern-input" id="nochasis" name="nochasis"
                               placeholder="Masukkan nomor chasis" required>
                        <div class="input-feedback">
                            <i class="fa fa-check-circle"></i>
                        </div>
                    </div>

                    <div class="form-group modern-form-group">
                        <label for="nomesin" class="modern-label">
                            <i class="fa fa-cog"></i>
                            No Mesin
                        </label>
                        <input type="text" class="form-control modern-input" id="nomesin" name="nomesin"
                               placeholder="Masukkan nomor mesin" required>
                        <div class="input-feedback">
                            <i class="fa fa-check-circle"></i>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group modern-form-group">
                        <label for="nopolisi" class="modern-label">
                            <i class="fa fa-id-card"></i>
                            No Polisi
                        </label>
                        <input type="text" class="form-control modern-input" id="nopolisi" name="nopolisi"
                               placeholder="Masukkan nomor polisi" required>
                        <div class="input-feedback">
                            <i class="fa fa-check-circle"></i>
                        </div>
                    </div>

                    <div class="form-group modern-form-group">
                        <label for="namastnk" class="modern-label">
                            <i class="fa fa-user"></i>
                            Nama STNK
                        </label>
                        <input type="text" class="form-control modern-input" id="namastnk" name="namastnk"
                               placeholder="Masukkan nama sesuai STNK" required>
                        <div class="input-feedback">
                            <i class="fa fa-check-circle"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group modern-form-group full-width">
                    <label for="alamatstnk" class="modern-label">
                        <i class="fa fa-map-marker"></i>
                        Alamat STNK
                    </label>
                    <textarea class="form-control modern-textarea" id="alamatstnk" name="alamatstnk"
                              placeholder="Masukkan alamat sesuai STNK" rows="3" required></textarea>
                    <div class="input-feedback">
                        <i class="fa fa-check-circle"></i>
                    </div>
                </div>

                <div class="form-group modern-form-group full-width">
                    <label class="modern-label">
                        <i class="fa fa-car"></i>
                        Tipe Kendaraan
                    </label>
                    <div class="input-group modern-input-group">
                        <input type="hidden" class="form-control" id="tipe" name="tipe" readonly>
                        <input type="text" class="form-control modern-input" id="tipenm" name="tipenm"
                               placeholder="Pilih tipe kendaraan" readonly>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-modern-select" onclick="selecttipe();">
                                <i class="fa fa-search"></i>
                                Pilih
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group modern-form-group full-width">
                    <label class="modern-label">
                        <i class="fa fa-palette"></i>
                        Warna Kendaraan
                    </label>
                    <div class="input-group modern-input-group">
                        <input type="hidden" class="form-control" id="warna" name="warna" readonly>
                        <input type="text" class="form-control modern-input" id="warnanm" name="warnanm"
                               placeholder="Pilih warna kendaraan" readonly>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-modern-select" onclick="selectwarna();">
                                <i class="fa fa-search"></i>
                                Pilih
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group modern-form-group full-width">
                    <label class="modern-label">
                        <i class="fa fa-users"></i>
                        Customer
                    </label>
                    <div class="input-group modern-input-group">
                        <input type="hidden" class="form-control" id="customer" name="customer" readonly>
                        <input type="text" class="form-control modern-input" id="customernm" name="customernm"
                               placeholder="Pilih customer" readonly>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-modern-select" onclick="selectcustomer();">
                                <i class="fa fa-search"></i>
                                Pilih
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer modern-modal-footer">
            <div class="form-actions">
                <button type="button" class="btn btn-modern-secondary btn-cancel" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                    Batal
                </button>
                <button type="submit" form="formInventory" class="btn btn-modern-primary btn-save">
                    <i class="fa fa-save"></i>
                    Simpan Data
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modern Form Styles -->
<style>
.modern-modal-dialog {
    max-width: 800px;
    width: 90%;
    margin: 2rem auto;
}

.modern-modal-content {
    border: none;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    overflow: hidden;
}

.modern-modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    border: none;
    position: relative;
}

.modern-modal-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
}

.modern-modal-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.modern-close {
    color: rgba(255,255,255,0.8);
    font-size: 2rem;
    line-height: 1;
    opacity: 1;
    transition: all 0.3s ease;
}

.modern-close:hover {
    color: white;
    opacity: 1;
    transform: rotate(90deg);
}

.modern-modal-body {
    padding: 2.5rem;
    background: #fafbfc;
}

.modern-form {
    max-width: 100%;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.modern-form-group {
    position: relative;
    margin-bottom: 1.5rem;
}

.modern-form-group.full-width {
    grid-column: 1 / -1;
}

.modern-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.modern-label i {
    color: #667eea;
    width: 16px;
    text-align: center;
}

.modern-input, .modern-textarea {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 10px;
    padding: 0.875rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}

.modern-input:focus, .modern-textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1), 0 4px 12px rgba(0,0,0,0.08);
    transform: translateY(-1px);
}

.modern-input::placeholder, .modern-textarea::placeholder {
    color: #8b949e;
}

.modern-textarea {
    resize: vertical;
    min-height: 80px;
}

.modern-input-group {
    display: flex;
    align-items: stretch;
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    transition: all 0.3s ease;
}

.modern-input-group:focus-within {
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1), 0 4px 12px rgba(0,0,0,0.08);
}

.modern-input-group .modern-input {
    border: none;
    border-radius: 0;
    box-shadow: none;
    flex: 1;
}

.modern-input-group .modern-input:focus {
    box-shadow: none;
    transform: none;
}

.modern-select {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    padding: 0.875rem 1.5rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modern-select:hover {
    background: linear-gradient(135deg, #5a6fd8, #6a4190);
    transform: translateY(-1px);
}

.modern-select:active {
    transform: translateY(0);
}

.input-feedback {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #28a745;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.modern-input:valid ~ .input-feedback {
    opacity: 1;
}

.modern-modal-footer {
    background: white;
    padding: 1.5rem 2.5rem;
    border-top: 1px solid #e9ecef;
    position: relative;
    z-index: 1;
}

/* Ensure modal footer stays at bottom */
.modal-content {
    display: flex;
    flex-direction: column;
    height: auto;
}

.modal-body {
    flex: 1;
    overflow-y: auto;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    width: 100%;
    position: relative;
    z-index: 10;
}

.form-actions button {
    position: relative;
    z-index: 10;
}

.btn-modern-secondary {
    background: #6c757d;
    color: white;
    border: none;
    padding: 0.875rem 2rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-modern-secondary:hover {
    background: #5a6268;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
}

.btn-modern-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    padding: 0.875rem 2rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-modern-primary:hover {
    background: linear-gradient(135deg, #5a6fd8, #6a4190);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-modal-dialog {
        margin: 1rem;
        width: calc(100% - 2rem);
    }

    .form-row {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .modern-modal-body {
        padding: 1.5rem;
    }

    .modern-modal-header {
        padding: 1.5rem;
    }

    .modern-modal-title {
        font-size: 1.25rem;
    }

    .modern-input-group {
        flex-direction: column;
    }

    .modern-input-group .modern-input {
        border-bottom: 1px solid #e1e8ed;
    }

    .modern-select {
        border-radius: 0 0 8px 8px;
        justify-content: center;
    }

    .form-actions {
        flex-direction: column;
        gap: 0.75rem;
    }

    .btn-modern-secondary, .btn-modern-primary {
        justify-content: center;
        width: 100%;
        padding: 1rem;
    }

    .modal-footer {
        padding: 1rem;
    }
}

@media (max-width: 480px) {
    .modern-modal-body {
        padding: 1rem;
    }

    .modern-modal-header {
        padding: 1rem;
    }

    .modern-label {
        font-size: 0.9rem;
    }

    .modern-input, .modern-textarea {
        padding: 0.75rem;
        font-size: 0.95rem;
    }
}

/* Override AdminLTE modal styles and ensure proper display */
.modal {
    z-index: 1050;
}

.modal .modal-dialog {
    margin: 2rem auto;
    position: relative;
}

.modal .modal-content {
    border: none;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    display: flex;
    flex-direction: column;
    max-height: 90vh;
}

.modal .modal-header {
    border: none;
    flex-shrink: 0;
}

.modal .modal-body {
    flex: 1;
    overflow-y: auto;
    padding: 2.5rem;
}

.modal .modal-footer {
    border-top: 1px solid #e9ecef;
    flex-shrink: 0;
    padding: 1.5rem 2.5rem;
    background: white;
}

/* Ensure proper modal structure */
.modern-modal-dialog .modal-content {
    display: flex;
    flex-direction: column;
}

.modern-modal-dialog .modal-body {
    flex: 1;
    max-height: 70vh;
    overflow-y: auto;
}

.modern-modal-dialog .modal-footer {
    flex-shrink: 0;
    margin: 0;
    padding: 1.5rem 2.5rem;
}

/* Loading states */
.btn-modern-primary.loading {
    position: relative;
    color: transparent;
}

.btn-modern-primary.loading::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    top: 50%;
    left: 50%;
    margin-left: -10px;
    margin-top: -10px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script type="text/javascript">
$(document).ready(function (){
    // Form submission with modern handling
    $("#formInventory").on('submit', function(e){
        e.preventDefault();

        var submitBtn = $(this).find('.btn-save');
        submitBtn.addClass('loading');

        $.ajax({
            type: 'POST',
            url: 'inventory/inventory_add_save.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                submitBtn.removeClass('loading');
                var hsl = data.trim();

                if (hsl === 'y'){
                    showNotification('Data sudah ada dalam sistem', 'warning');
                    return false;
                } else {
                    $("#tableinventory").load('inventory/inventory_load.php');
                    showNotification('Data berhasil disimpan', 'success');
                    $('#ModalAdd').modal('hide');

                    // Reset form
                    $('#formInventory')[0].reset();
                    $('.modern-input').removeClass('is-valid');
                }
            },
            error: function(){
                submitBtn.removeClass('loading');
                showNotification('Terjadi kesalahan saat menyimpan data', 'error');
            }
        });
    });

    // Input validation feedback
    $('.modern-input').on('input', function(){
        if ($(this).val().length > 0) {
            $(this).addClass('is-valid');
        } else {
            $(this).removeClass('is-valid');
        }
    });
});

function selecttipe(){
    $("#ModalTipe").modal({backdrop: 'static', keyboard: false});
}

function selectwarna(){
    $("#ModalWarna").modal({backdrop: 'static', keyboard: false});
}

function selectcustomer(){
    $("#ModalCustomer").modal({backdrop: 'static', keyboard: false});
}

// Modern notification function
function showNotification(message, type){
    var iconMap = {
        'success': 'fa-check-circle',
        'warning': 'fa-exclamation-triangle',
        'error': 'fa-times-circle'
    };

    var notification = $('<div class="modern-notification notification-' + type + '">' +
        '<i class="fa ' + iconMap[type] + '"></i>' +
        '<span>' + message + '</span>' +
        '</div>');

    $('body').append(notification);
    notification.fadeIn(300);

    setTimeout(function(){
        notification.fadeOut(300, function(){
            $(this).remove();
        });
    }, 4000);
}
</script>