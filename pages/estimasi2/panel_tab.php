
  <?php $idestimasi = $_GET['idestimasine']; ?>

<!-- Modern Panel Management Modal -->
<div class="modal-dialog modern-modal-dialog modal-xl">
    <div class="modal-content modern-modal-content">
        <div class="modal-header modern-modal-header">
            <button type="button" class="close modern-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title modern-modal-title" id="myModalLabel">
                <i class="fa fa-th-large"></i>
                Manajemen Panel Estimasi
            </h4>
        </div>

        <div class="modal-body modern-modal-body">
            <!-- Panel Table Section -->
            <div class="panel-table-section">
                <div class="table-header">
                    <div class="table-title">
                        <h5><i class="fa fa-list"></i> Daftar Panel</h5>
                    </div>
                    <div class="table-controls">
                        <button type="button" class="btn btn-modern-primary" onclick="addPanel()">
                            <i class="fa fa-plus"></i>
                            Tambah Panel
                        </button>
                    </div>
                </div>
                <div id="tablepanel" class="modern-table-container">
                    <!-- Table will be loaded here -->
                </div>
            </div>
        </div>

        <div class="modal-footer modern-modal-footer">
            <div class="form-actions">
                <button type="button" class="btn btn-modern-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Containers for Panel CRUD -->
<div id="ModalAddPanel" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
<div id="ModalEditPanel" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
<div id="ModalDeletePanel" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>

<!-- Modern JavaScript -->
<script type="text/javascript">
$(document).ready(function() {
    $("#tablepanel").load('estimasi/panel_load.php?idestimasi=<?php echo $idestimasi; ?>');
});

function addPanel() {
    $.ajax({
        url: "estimasi/panel_add.php?idestimasi=<?php echo $idestimasi; ?>",
        type: "GET",
        success: function(ajaxData) {
            $("#ModalAddPanel").html(ajaxData);
            $("#ModalAddPanel").modal({backdrop: 'static', keyboard: false});
        },
        error: function() {
            showNotification('Gagal memuat form tambah panel', 'error');
        }
    });
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
/* Panel Management Modal Styles */
.modern-modal-dialog.modal-xl {
    max-width: 1400px;
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
    max-height: 60vh;
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

/* Panel Table Section */
.panel-table-section {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e9ecef;
}

.table-title h5 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.table-title i {
    color: #6f42c1;
}

.table-controls {
    display: flex;
    gap: 0.5rem;
}

.modern-table-container {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

.btn-modern-primary {
    background: linear-gradient(135deg, #6f42c1, #5a32a3);
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

/* Responsive Design */
@media (max-width: 768px) {
    .modern-modal-dialog.modal-xl {
        margin: 1rem;
        width: calc(100% - 2rem);
    }

    .table-header {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }

    .table-controls {
        justify-content: center;
    }

    .form-actions {
        flex-direction: column;
    }

    .form-actions .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .modern-modal-body {
        padding: 1.5rem;
    }

    .panel-table-section {
        padding: 1rem;
    }

    .table-title h5 {
        font-size: 1rem;
    }
}
</style>