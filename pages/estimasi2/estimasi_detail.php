<?php
include_once '../../lib/sess.php';
include_once '../../lib/config.php';
include_once '../../lib/fungsi.php';

$idestimasi = explode('-', $_GET['idestimasi']);
$sqles = "SELECT * FROM t_estimasi WHERE id_estimasi='$idestimasi[0]'";
$hes = mysqli_fetch_array(mysqli_query($objConn, $sqles));
?>

<!-- Modern Estimasi Detail Modal -->
<div class="modal-dialog modern-modal-dialog modal-xl">
    <div class="modal-content modern-modal-content">
        <div class="modal-header modern-modal-header">
            <button type="button" class="close modern-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title modern-modal-title" id="myModalLabel">
                <i class="fa fa-calculator"></i>
                Detail Estimasi
            </h4>
        </div>

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
                        <div class="info-value"><?php echo tampilTanggal(substr($hes['tgl'], 0, 10)); ?></div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">
                            <i class="fa fa-car"></i>
                            No Chasis
                        </label>
                        <div class="info-value chasis-number"><?php echo htmlspecialchars($hes['fk_no_chasis']); ?></div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">
                            <i class="fa fa-cogs"></i>
                            No Mesin
                        </label>
                        <div class="info-value engine-number"><?php echo htmlspecialchars($hes['fk_no_mesin']); ?></div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">
                            <i class="fa fa-id-card"></i>
                            No Polisi
                        </label>
                        <div class="info-value police-number"><?php echo htmlspecialchars($hes['fk_no_polisi']); ?></div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">
                            <i class="fa fa-palette"></i>
                            Warna
                        </label>
                        <div class="info-value"><?php echo htmlspecialchars($idestimasi[1]); ?></div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">
                            <i class="fa fa-tags"></i>
                            Kategori
                        </label>
                        <div class="info-value">
                            <span class="badge badge-<?php echo $hes['kategori'] == 'Asuransi' ? 'warning' : 'primary'; ?>">
                                <?php echo htmlspecialchars($hes['kategori']); ?>
                            </span>
                        </div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">
                            <i class="fa fa-tachometer-alt"></i>
                            KM Masuk
                        </label>
                        <div class="info-value"><?php echo number_format($hes['km_masuk'], 0, ',', '.'); ?> KM</div>
                    </div>
                </div>
            </div>

            <hr class="section-divider">

            <!-- Estimasi Detail Table -->
            <div class="detail-table-section">
                <h5 class="section-title">
                    <i class="fa fa-list"></i>
                    Rincian Estimasi
                </h5>
                <div id="tableestimasidetail" class="modern-table-container">
                    <!-- Table will be loaded here -->
                </div>
            </div>
        </div>

        <div class="modal-footer modern-modal-footer">
            <div class="form-actions">
                <button type="button" class="btn btn-modern-success" onclick="parte('<?php echo $idestimasi[0]; ?>')">
                    <i class="fa fa-wrench"></i>
                    Kelola Part
                </button>
                <button type="button" class="btn btn-modern-primary" onclick="panele('<?php echo $idestimasi[0]; ?>')">
                    <i class="fa fa-th-large"></i>
                    Kelola Panel
                </button>
                <button type="button" class="btn btn-modern-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Containers for Part and Panel -->
<div id="ModalAddPanelx" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
<div id="ModalAddPartx" class="modal modern-modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>

<!-- Modern JavaScript -->
<script type="text/javascript">
$(document).ready(function() {
    var idestimasie = '<?php echo $idestimasi[0]; ?>';
    $("#tableestimasidetail").load('estimasi/estimasi_detail_tab.php?idestimasi=' + idestimasie);
});

function panele(x) {
    $.ajax({
        url: "estimasi/panel_tab.php?idestimasine=" + x,
        type: "GET",
        success: function(ajaxData) {
            $("#ModalAddPanelx").html(ajaxData);
            $("#ModalAddPanelx").modal({backdrop: 'static', keyboard: false});
        },
        error: function() {
            showNotification('Gagal memuat data panel', 'error');
        }
    });
}

function parte(y) {
    $.ajax({
        url: "estimasi/part_tab.php?idestimasine=" + y,
        type: "GET",
        success: function(ajaxData) {
            $("#ModalAddPartx").html(ajaxData);
            $("#ModalAddPartx").modal({backdrop: 'static', keyboard: false});
        },
        error: function() {
            showNotification('Gagal memuat data part', 'error');
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
/* Estimasi Detail Modal Styles */
.modern-modal-dialog.modal-xl {
    max-width: 1200px;
    width: 95%;
}

.modern-modal-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
    background: linear-gradient(90deg, #28a745, #20c997, #17a2b8);
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

/* Vehicle Information Section */
.vehicle-info-section {
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
    color: #28a745;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
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
    color: #28a745;
}

.info-value {
    font-size: 0.95rem;
    font-weight: 600;
    color: #2c3e50;
    padding: 0.25rem 0.5rem;
    background: #f8f9fa;
    border-radius: 6px;
}

.chasis-number, .engine-number {
    font-family: 'Courier New', monospace;
    background: #e9ecef;
}

.police-number {
    color: #dc3545;
    background: rgba(220, 53, 69, 0.1);
}

.badge {
    padding: 0.25rem 0.75rem;
    font-weight: 500;
    border-radius: 20px;
}

.badge-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
}

.badge-warning {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    color: #212529;
}

.section-divider {
    border: none;
    height: 2px;
    background: linear-gradient(90deg, transparent, #e9ecef, transparent);
    margin: 2rem 0;
}

.detail-table-section {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    flex-wrap: wrap;
}

.btn-modern-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
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
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
    color: white;
}

.btn-modern-success {
    background: linear-gradient(135deg, #28a745, #20c997);
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

.btn-modern-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
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

    .info-grid {
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
}

@media (max-width: 576px) {
    .modern-modal-body {
        padding: 1.5rem;
    }

    .vehicle-info-section, .detail-table-section {
        padding: 1rem;
    }

    .section-title {
        font-size: 1rem;
    }
}
</style>