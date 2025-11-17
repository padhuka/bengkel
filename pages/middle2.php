<!-- Modern Dashboard Content -->
<div class="modern-dashboard">
    <!-- Modern Page Header -->
    <section class="modern-page-header">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="page-title-section">
                    <h1 class="page-title">
                        <i class="fa fa-sitemap"></i>
                        Flow Chart Aplikasi
                    </h1>
                    <p class="page-subtitle">Visualisasi proses kerja sistem bengkel</p>
                </div>
            </div>
            <nav class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">Flow Chart</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Modern Main Content -->
    <section class="modern-content">
        <div class="container-fluid">
            <!-- Dashboard Overview -->
            <div class="dashboard-overview">
                <div class="overview-card">
                    <div class="overview-icon">
                        <i class="fa fa-tachometer"></i>
                    </div>
                    <div class="overview-content">
                        <h3>Selamat Datang</h3>
                        <p>Sistem Management Bengkel Gemilang</p>
                        <p class="overview-description">Sistem informasi lengkap untuk mengelola operasional bengkel Gemilang Repair</p>
                    </div>
                </div>
            </div>

            <!-- Modern Flowchart -->
            <div class="flowchart-container">
                <div class="flowchart-header">
                    <h2 class="flowchart-title">
                        <i class="fa fa-share-alt"></i>
                        Alur Kerja Sistem
                    </h2>
                    <p class="flowchart-description">Klik pada setiap proses untuk melihat detailnya</p>
                </div>

                <div class="modern-flowchart">
                    <!-- Level 1 - Starting Point -->
                    <div class="flowchart-level">
                        <div class="flowchart-node start-node" onclick="handleNodeClick('customer')">
                            <div class="node-icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="node-content">
                                <h4>Kartu Pelanggan</h4>
                                <p>Manajemen data customer</p>
                            </div>
                        </div>
                    </div>

                    <!-- Level 2 - Estimation & Receipt -->
                    <div class="flowchart-level">
                        <div class="flowchart-node process-node" onclick="handleNodeClick('estimasi')">
                            <div class="node-icon">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <div class="node-content">
                                <h4>Estimasi</h4>
                                <p>Perhitungan biaya perbaikan</p>
                            </div>
                        </div>

                        <div class="flowchart-node process-node" onclick="handleNodeClick('kwitansi-or')">
                            <div class="node-icon">
                                <i class="fa fa-file-invoice"></i>
                            </div>
                            <div class="node-content">
                                <h4>Kwitansi OR</h4>
                                <p>Kwitansi pemesanan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Level 3 - Payment Methods -->
                    <div class="flowchart-level">
                        <div class="flowchart-node payment-node" onclick="handleNodeClick('payment-cash')">
                            <div class="node-icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="node-content">
                                <h4>Pembayaran Cash</h4>
                                <p>Transaksi tunai</p>
                            </div>
                        </div>

                        <div class="flowchart-node payment-node" onclick="handleNodeClick('payment-bank')">
                            <div class="node-icon">
                                <i class="fa fa-credit-card"></i>
                            </div>
                            <div class="node-content">
                                <h4>Pembayaran Bank</h4>
                                <p>Transfer bank</p>
                            </div>
                        </div>
                    </div>

                    <!-- Level 4 - Main Process -->
                    <div class="flowchart-level">
                        <div class="flowchart-node main-process-node" onclick="handleNodeClick('pkb')">
                            <div class="node-icon">
                                <i class="fa fa-wrench"></i>
                            </div>
                            <div class="node-content">
                                <h4>PKB</h4>
                                <p>Pekerjaan Bengkel Kendaraan</p>
                                <span class="node-badge">Proses Utama</span>
                            </div>
                        </div>
                    </div>

                    <!-- Level 5 - PKB Completion -->
                    <div class="flowchart-level">
                        <div class="flowchart-node completion-node" onclick="handleNodeClick('close-pkb')">
                            <div class="node-icon">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div class="node-content">
                                <h4>Tutup PKB</h4>
                                <p>Penyelesaian pekerjaan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Level 6 - Final Receipt -->
                    <div class="flowchart-level">
                        <div class="flowchart-node receipt-node" onclick="handleNodeClick('kwitansi')">
                            <div class="node-icon">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <div class="node-content">
                                <h4>Cetak Kwitansi</h4>
                                <p>Dokumen penyelesaian</p>
                            </div>
                        </div>

                        <div class="flowchart-node receipt-node" onclick="handleNodeClick('final-payment-cash')">
                            <div class="node-icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="node-content">
                                <h4>Pembayaran Cash</h4>
                                <p>Pelunasan tunai</p>
                            </div>
                        </div>

                        <div class="flowchart-node receipt-node" onclick="handleNodeClick('final-payment-bank')">
                            <div class="node-icon">
                                <i class="fa fa-credit-card"></i>
                            </div>
                            <div class="node-content">
                                <h4>Pembayaran Bank</h4>
                                <p>Transfer final</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flowchart Info Panel -->
                <div class="flowchart-info" id="flowchartInfo">
                    <div class="info-content">
                        <h4><i class="fa fa-info-circle"></i> Informasi Flowchart</h4>
                        <p>Klik pada setiap node untuk melihat detail proses dan navigasi ke halaman terkait.</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <h3 class="section-title">
                    <i class="fa fa-rocket"></i>
                    Akses Cepat
                </h3>
                <div class="action-grid">
                    <div class="action-card" onclick="quickAction('customer')">
                        <div class="action-icon">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <div class="action-content">
                            <h4>Tambah Customer</h4>
                            <p>Registrasi pelanggan baru</p>
                        </div>
                    </div>

                    <div class="action-card" onclick="quickAction('estimasi')">
                        <div class="action-icon">
                            <i class="fa fa-calculator"></i>
                        </div>
                        <div class="action-content">
                            <h4>Buat Estimasi</h4>
                            <p>Hitung biaya perbaikan</p>
                        </div>
                    </div>

                    <div class="action-card" onclick="quickAction('pkb')">
                        <div class="action-icon">
                            <i class="fa fa-plus-circle"></i>
                        </div>
                        <div class="action-content">
                            <h4>Buat PKB Baru</h4>
                            <p>Mulai pekerjaan</p>
                        </div>
                    </div>

                    <div class="action-card" onclick="quickAction('laporan')">
                        <div class="action-icon">
                            <i class="fa fa-chart-bar"></i>
                        </div>
                        <div class="action-content">
                            <h4>Lihat Laporan</h4>
                            <p>Analisis data</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modern JavaScript -->
<script type="text/javascript">
$(document).ready(function(){
    // Initialize flowchart animations
    animateFlowchart();

    // Set active node based on current page
    setActiveNode();
});

function handleNodeClick(nodeType) {
    // Remove previous active states
    $('.flowchart-node').removeClass('active');

    // Add active state to clicked node
    event.currentTarget.classList.add('active');

    // Update info panel
    updateFlowchartInfo(nodeType);

    // Navigate to the appropriate page
    navigateToNode(nodeType);
}

function updateFlowchartInfo(nodeType) {
    const infoData = {
        'customer': {
            title: '<i class="fa fa-users"></i> Kartu Pelanggan',
            description: 'Mengelola data pelanggan, informasi kontak, dan histori servis kendaraan. Fitur ini memungkinkan tracking riwayat servis pelanggan.'
        },
        'estimasi': {
            title: '<i class="fa fa-file-text"></i> Estimasi',
            description: 'Membuat estimasi biaya perbaikan kendaraan. Termasuk perhitungan suku cadang, jasa, dan estimasi waktu pengerjaan.'
        },
        'kwitansi-or': {
            title: '<i class="fa fa-file-invoice"></i> Kwitansi OR',
            description: 'Mencetak kwitansi pemesanan atau uang muka. Dokumen resmi untuk transaksi dengan pelanggan.'
        },
        'payment-cash': {
            title: '<i class="fa fa-money"></i> Pembayaran Cash',
            description: 'Proses pembayaran tunai untuk estimasi atau layanan bengkel.'
        },
        'payment-bank': {
            title: '<i class="fa fa-credit-card"></i> Pembayaran Bank',
            description: 'Proses pembayaran melalui transfer bank atau metode pembayaran elektronik.'
        },
        'pkb': {
            title: '<i class="fa fa-wrench"></i> PKB',
            description: 'Pekerjaan Bengkel Kendaraan - Dokumen resmi yang mencatat semua detail perbaikan, suku cadang, dan biaya yang telah disepakati.'
        },
        'close-pkb': {
            title: '<i class="fa fa-check-circle"></i> Tutup PKB',
            description: 'Proses penyelesaian PKB setelah semua pekerjaan selesai dan pembayaran lunas.'
        },
        'kwitansi': {
            title: '<i class="fa fa-file-text"></i> Cetak Kwitansi',
            description: 'Mencetak kwitansi akhir sebagai bukti pembayaran dan penyelesaian layanan.'
        },
        'final-payment-cash': {
            title: '<i class="fa fa-money"></i> Pembayaran Cash',
            description: 'Pelunasan pembayaran akhir secara tunai.'
        },
        'final-payment-bank': {
            title: '<i class="fa fa-credit-card"></i> Pembayaran Bank',
            description: 'Pelunasan pembayaran akhir melalui transfer bank.'
        }
    };

    const info = infoData[nodeType];
    if (info) {
        $('#flowchartInfo .info-content').html(`
            <h4>${info.title}</h4>
            <p>${info.description}</p>
        `);
    }
}

function navigateToNode(nodeType) {
    const routes = {
        'customer': '?p=inventory',
        'estimasi': '?p=estimasi',
        'kwitansi-or': '?p=kwitansior',
        'payment-cash': '?p=cash',
        'payment-bank': '?p=bank',
        'pkb': '?p=pkb',
        'close-pkb': '?p=pkbbukatutup',
        'kwitansi': '?p=kwitansi',
        'final-payment-cash': '?p=cash',
        'final-payment-bank': '?p=bank'
    };

    const route = routes[nodeType];
    if (route) {
        showNotification(`Menuju ke halaman ${infoData[nodeType].title.replace(/<[^>]*>/g, '')}`, 'info');
        setTimeout(() => {
            window.location.href = route;
        }, 500);
    }
}

function quickAction(action) {
    const quickRoutes = {
        'customer': '?p=inventory',
        'estimasi': '?p=estimasi',
        'pkb': '?p=pkb',
        'laporan': '?p=laporan'
    };

    const route = quickRoutes[action];
    if (route) {
        showNotification(`Menuju ke halaman ${getActionTitle(action)}`, 'info');
        setTimeout(() => {
            window.location.href = route;
        }, 500);
    }
}

function getActionTitle(action) {
    const titles = {
        'customer': 'Customer',
        'estimasi': 'Estimasi',
        'pkb': 'PKB',
        'laporan': 'Laporan'
    };
    return titles[action] || action;
}

function animateFlowchart() {
    $('.flowchart-level').each(function(index) {
        const level = $(this);
        setTimeout(function() {
            level.find('.flowchart-node').addClass('animate-in');
        }, index * 200);
    });
}

function setActiveNode() {
    // Determine current page and set active node
    const currentPath = window.location.pathname;
    const currentSearch = window.location.search;

    if (currentSearch.includes('p=inventory')) {
        $('.flowchart-node').removeClass('active');
        $('.flowchart-node').each(function() {
            if ($(this).attr('onclick').includes('customer')) {
                $(this).addClass('active');
            }
        });
    }
}

function showNotification(message, type) {
    const notification = $(`
        <div class="modern-notification notification-${type}">
            <i class="fa fa-${type === 'success' ? 'check-circle' : 'info-circle'}"></i>
            <span>${message}</span>
        </div>
    `);

    $('body').append(notification);
    notification.fadeIn(300);

    setTimeout(function(){
        notification.fadeOut(300, function(){
            $(this).remove();
        });
    }, 3000);
}
</script>

<!-- Modern Flowchart Styles -->
<style>
/* Modern Dashboard Styles */
.modern-dashboard {
    background: #f8f9fa;
    min-height: 100vh;
}

/* Modern Page Header */
.modern-page-header {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    padding: 2rem 0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.page-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.page-title-section h1 {
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.page-subtitle {
    margin: 0.5rem 0 0 0;
    opacity: 0.9;
    font-size: 1rem;
}

.breadcrumb-nav {
    background: rgba(255,255,255,0.1);
    padding: 0.75rem 0;
    border-radius: 8px;
}

.breadcrumb {
    margin: 0;
    background: none;
    padding: 0;
}

.breadcrumb li a {
    color: rgba(255,255,255,0.9);
    text-decoration: none;
}

.breadcrumb li a:hover {
    color: white;
}

.breadcrumb .active {
    color: white;
    font-weight: 500;
}

/* Modern Content */
.modern-content {
    padding: 2rem 0;
}

.container-fluid {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* Dashboard Overview */
.dashboard-overview {
    margin-bottom: 2rem;
}

.overview-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    gap: 2rem;
}

.overview-icon {
    width: 80px;
    height: 80px;
    border-radius: 16px;
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
}

.overview-content h3 {
    margin: 0 0 0.5rem 0;
    font-size: 1.5rem;
    color: #2c3e50;
}

.overview-content p:first-of-type {
    margin: 0 0 0.25rem 0;
    color: #4facfe;
    font-weight: 500;
}

.overview-description {
    margin: 0;
    color: #6c757d;
    font-size: 0.95rem;
}

/* Flowchart Container */
.flowchart-container {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    margin-bottom: 2rem;
}

.flowchart-header {
    text-align: center;
    margin-bottom: 3rem;
}

.flowchart-title {
    font-size: 1.75rem;
    color: #2c3e50;
    margin: 0 0 0.5rem 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

.flowchart-description {
    color: #6c757d;
    margin: 0;
}

/* Modern Flowchart */
.modern-flowchart {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    max-width: 800px;
    margin: 0 auto;
}

.flowchart-level {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.flowchart-node {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 180px;
    position: relative;
    overflow: hidden;
}

.flowchart-node::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #e1e8ed, #f8f9fa);
    transition: all 0.3s ease;
}

.flowchart-node:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: #4facfe;
}

.flowchart-node:hover::before {
    background: linear-gradient(90deg, #4facfe, #00f2fe);
}

.flowchart-node.active {
    border-color: #4facfe;
    background: linear-gradient(135deg, #f0f9ff, #e6f7ff);
}

.flowchart-node.active::before {
    background: linear-gradient(90deg, #4facfe, #00f2fe);
}

.node-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    margin: 0 auto 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
    transition: all 0.3s ease;
}

.node-content h4 {
    margin: 0 0 0.5rem 0;
    font-size: 1rem;
    color: #2c3e50;
    font-weight: 600;
}

.node-content p {
    margin: 0;
    color: #6c757d;
    font-size: 0.85rem;
    line-height: 1.4;
}

.node-badge {
    display: inline-block;
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
    margin-top: 0.5rem;
}

/* Node Type Specific Styles */
.start-node .node-icon {
    background: linear-gradient(135deg, #28a745, #20c997);
}

.process-node .node-icon {
    background: linear-gradient(135deg, #17a2b8, #138496);
}

.payment-node .node-icon {
    background: linear-gradient(135deg, #6f42c1, #5a32a3);
}

.main-process-node .node-icon {
    background: linear-gradient(135deg, #fd7e14, #e8590c);
    width: 60px;
    height: 60px;
    font-size: 1.5rem;
}

.completion-node .node-icon {
    background: linear-gradient(135deg, #28a745, #20c997);
}

.receipt-node .node-icon {
    background: linear-gradient(135deg, #6c757d, #5a6268);
}

/* Flowchart Info Panel */
.flowchart-info {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.5rem;
    margin-top: 2rem;
    border-left: 4px solid #4facfe;
}

.info-content h4 {
    margin: 0 0 1rem 0;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-content p {
    margin: 0;
    color: #6c757d;
    line-height: 1.6;
}

/* Quick Actions */
.quick-actions {
    margin-top: 2rem;
}

.section-title {
    font-size: 1.5rem;
    color: #2c3e50;
    margin: 0 0 1.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.action-card {
    background: white;
    border: 2px solid #e1e8ed;
    border-radius: 12px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.action-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border-color: #4facfe;
}

.action-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.action-content h4 {
    margin: 0 0 0.25rem 0;
    font-size: 1rem;
    color: #2c3e50;
    font-weight: 600;
}

.action-content p {
    margin: 0;
    color: #6c757d;
    font-size: 0.85rem;
}

/* Animations */
.flowchart-node.animate-in {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.6s ease forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
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

.notification-info {
    border-left: 4px solid #17a2b8;
    color: #17a2b8;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .page-title-section h1 {
        font-size: 1.5rem;
    }

    .overview-card {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }

    .flowchart-level {
        flex-direction: column;
        align-items: center;
    }

    .flowchart-node {
        width: 100%;
        max-width: 300px;
    }

    .action-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .modern-page-header {
        padding: 1.5rem 0;
    }

    .flowchart-container {
        padding: 1.5rem;
    }

    .flowchart-level {
        gap: 1rem;
    }

    .action-card {
        padding: 1rem;
    }

    .action-icon {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
}

/* Hide original AdminLTE elements */
.content-wrapper {
    display: none;
}
</style>