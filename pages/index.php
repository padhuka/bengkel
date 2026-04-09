<?php include_once 'header.php';?>

<!-- Modern Responsive Container -->
<div class="modern-container">
    <!-- Mobile Header with Hamburger Menu -->
    <header class="mobile-header">
        <div class="mobile-header-content">
            <div class="logo">
                <h2 class="brand-title">GEMILANG REPAIR</h2>
            </div>
            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- Mobile Navigation Menu -->
        <nav class="mobile-nav" id="mobileNav">
            <ul class="mobile-nav-list">
                <li><a href="index.php" class="nav-item"><i class="fa fa-home"></i> Home</a></li>
                <?php if ($seskdlvl=='Umum' || $seskdlvl=='Admin'): ?>
                <li><a href="?p=inventory" class="nav-item"><i class="fa fa-user-plus"></i> Kartu Pelanggan</a></li>
                <?php endif; ?>
                <?php if ($seskdlvl=='Umum' || $seskdlvl=='Admin'): ?>
                <li><a href="?p=estimasi" class="nav-item"><i class="fa fa-file-text"></i> Estimasi</a></li>
                <?php endif; ?>
                <?php if ($seskdlvl=='Admin'): ?>
                <li class="mobile-dropdown">
                    <button class="dropdown-toggle" data-dropdown="pkb">
                        <i class="fa fa-file-text"></i> PKB
                    </button>
                    <ul class="dropdown-menu" id="pkb-dropdown">
                        <li><a href="?p=pkb">PKB</a></li>
                        <li><a href="?p=pkbbukatutup">Buka/Tutup PKB</a></li>
                        <!-- <li><a href="?p=sparepart">Sparepart</a></li> Hidden per request -->
                    </ul>
                </li>
                <?php endif; ?>
                <?php if ($seskdlvl=='Umum' || $seskdlvl=='Admin'): ?>
                <li><a href="?p=panel" class="nav-item"><i class="fa fa-window-restore"></i> Panel</a></li>
                <?php endif; ?>
                <?php if ($seskdlvl=='Umum' || $seskdlvl=='Admin'): ?>
                <li><a href="?p=part" class="nav-item"><i class="fa fa-wrench"></i> Part</a></li>
                <?php endif; ?>
                <?php if ($seskdlvl=='Admin'): ?>
                <li class="mobile-dropdown">
                    <button class="dropdown-toggle" data-dropdown="finance">
                        <i class="fa fa-usd"></i> Finance
                    </button>
                    <ul class="dropdown-menu" id="finance-dropdown">
                        <li><a href="?p=kwitansi">Kwitansi</a></li>
                        <li><a href="?p=kwitansior">Kwitansi OR</a></li>
                        <li><a href="?p=cash">Cash</a></li>
                        <li><a href="?p=bank">Bank</a></li>
                        <li><a href="?p=gatepass">Gate Pass</a></li>
                    </ul>
                </li>
                <?php endif; ?>
                <?php if ($seskdlvl=='Admin'): ?>
                <li class="mobile-dropdown">
                    <button class="dropdown-toggle" data-dropdown="accounting">
                        <i class="fa fa-usd"></i> Accounting
                    </button>
                    <ul class="dropdown-menu" id="accounting-dropdown">
                        <li><a href="?p=mcoa">Master COA</a></li>
                        <li><a href="?p=acccash">Cash</a></li>
                        <li><a href="?p=accbank">Bank</a></li>
                    </ul>
                </li>
                <?php endif; ?>
                <li><a href="?p=laporan" class="nav-item"><i class="fa fa-gears"></i> Laporan</a></li>
                <?php if ($seskdlvl=='Admin'): ?>
                <li class="mobile-dropdown">
                    <button class="dropdown-toggle" data-dropdown="master">
                        <i class="fa fa-gears"></i> Master
                    </button>
                    <ul class="dropdown-menu" id="master-dropdown">
                        <li><a href="?p=customer">Customer</a></li>
                        <li><a href="?p=asuransi">Asuransi</a></li>
                        <li><a href="?p=supplier">Supplier</a></li>
                        <li><a href="?p=partnerbank">Partner Bank</a></li>
                        <li><a href="?p=satuan">Satuan</a></li>
                        <li><a href="?p=part">Part</a></li>
                        <li><a href="?p=panel">Panel</a></li>
                        <li><a href="?p=group">Group Kendaraan</a></li>
                        <li><a href="?p=tipe">Tipe Kendaraan</a></li>
                        <li><a href="?p=warna">Warna Kendaraan</a></li>
                        <li class="divider"></li>
                        <li><a href="?p=backup">Backup Database</a></li>
                    </ul>
                </li>
                <?php endif; ?>
                <li><a href="login/logout.php" class="nav-item logout"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Desktop Header -->
    <header class="desktop-header">
        <nav class="navbar">
            <div class="container">
                <a class="navbar-brand" href="index.php">GEMILANG REPAIR</a>
                <div class="navbar-menu">
                    <ul class="nav-list">
                        <li><a href="index.php" class="nav-btn"><i class="fa fa-home"></i> Home</a></li>
                        <?php if ($seskdlvl=='Umum' || $seskdlvl=='Admin'): ?>
                        <li><a href="?p=inventory" class="nav-btn"><i class="fa fa-user-plus"></i> Kartu Pelanggan</a></li>
                        <?php endif; ?>
                        <?php if ($seskdlvl=='Umum' || $seskdlvl=='Admin'): ?>
                        <li><a href="?p=estimasi" class="nav-btn"><i class="fa fa-file-text"></i> Estimasi</a></li>
                        <?php endif; ?>
                        <?php if ($seskdlvl=='Admin'): ?>
                        <li class="dropdown">
                            <button class="nav-btn dropdown-toggle" data-dropdown="pkb-desktop">
                                <i class="fa fa-file-text"></i> PKB <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu" id="pkb-desktop-dropdown">
                                <li><a href="?p=pkb">PKB</a></li>
                                <li><a href="?p=pkbbukatutup">Buka/Tutup PKB</a></li>
                                <!-- <li><a href="?p=sparepart">Sparepart</a></li> Hidden per request -->
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php if ($seskdlvl=='Umum' || $seskdlvl=='Admin'): ?>
                        <li><a href="?p=panel" class="nav-btn"><i class="fa fa-window-restore"></i> Panel</a></li>
                        <?php endif; ?>
                        <?php if ($seskdlvl=='Umum' || $seskdlvl=='Admin'): ?>
                        <li><a href="?p=part" class="nav-btn"><i class="fa fa-wrench"></i> Part</a></li>
                        <?php endif; ?>
                        <?php if ($seskdlvl=='Admin'): ?>
                        <li class="dropdown">
                            <button class="nav-btn dropdown-toggle" data-dropdown="finance-desktop">
                                <i class="fa fa-usd"></i> Finance <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu" id="finance-desktop-dropdown">
                                <li><a href="?p=kwitansi">Kwitansi</a></li>
                                <li><a href="?p=kwitansior">Kwitansi OR</a></li>
                                <li><a href="?p=cash">Cash</a></li>
                                <li><a href="?p=bank">Bank</a></li>
                                <li><a href="?p=gatepass">Gate Pass</a></li>
                                   <li><a href="?p=uploaddms">Upload Data DMS</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php if ($seskdlvl=='Admin'): ?>
                        <li class="dropdown">
                            <button class="nav-btn dropdown-toggle" data-dropdown="accounting-desktop">
                                <i class="fa fa-usd"></i> Accounting <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu" id="accounting-desktop-dropdown">
                                <li><a href="?p=mcoa">Master COA</a></li>
                                <li><a href="?p=acccash">Cash</a></li>
                                <li><a href="?p=accbank">Bank</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <li><a href="?p=laporan" class="nav-btn"><i class="fa fa-gears"></i> Laporan</a></li>
                        <?php if ($seskdlvl=='Admin'): ?>
                        <li class="dropdown">
                            <button class="nav-btn dropdown-toggle" data-dropdown="master-desktop">
                                <i class="fa fa-gears"></i> Master <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu" id="master-desktop-dropdown">
                                <li><a href="?p=customer">Customer</a></li>
                                <li><a href="?p=asuransi">Asuransi</a></li>
                                <li><a href="?p=supplier">Supplier</a></li>
                                <li><a href="?p=partnerbank">Partner Bank</a></li>
                                <li><a href="?p=satuan">Satuan</a></li>
                                <li><a href="?p=part">Part</a></li>
                                <li><a href="?p=panel">Panel</a></li>
                                <li><a href="?p=group">Group Kendaraan</a></li>
                                <li><a href="?p=tipe">Tipe Kendaraan</a></li>
                                <li><a href="?p=warna">Warna Kendaraan</a></li>
                                <li class="divider"></li>
                                <li><a href="?p=backup">Backup Database</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <li><a href="login/logout.php" class="nav-btn logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content Area -->
    <main class="main-content">
        <?php
            if(!empty($_GET["p"])){
                $pag = $_GET["p"];
            } else {
                $pag = "";
            }

            // Route to appropriate page
            switch($pag){
                default : include_once 'middle.php'; break;
                ## AREA ##
                case 'asuransi' : include_once 'asuransi/asuransi_tab.php'; break;
                case 'supplier' : include_once 'supplier/supplier_tab.php'; break;
                case 'satuan' : include_once 'satuan/satuan_tab.php'; break;
                case 'warna' : include_once 'warna/warna_tab.php'; break;
                case 'group' : include_once 'group/group_tab.php'; break;
                case 'panel' : include_once 'panel/panel_tab.php'; break;
                case 'tipe' : include_once 'tipe/tipe_tab.php'; break;
                case 'part' : include_once 'part/part_tab.php'; break;
                case 'inventory' : include_once 'inventory/inventory_tab.php'; break;
                case 'customer' : include_once 'customer/customer_tab.php'; break;
                case 'estimasi' : include_once 'estimasi/estimasi_tab.php'; break;
                case 'partnerbank' : include_once 'partnerbank/partnerbank_tab.php'; break;
                case 'pkb' : include_once 'pkb/pkb_tab.php'; break;
                case 'kwitansior' : include_once 'kwitansior/kwitansior_tab.php'; break;
                case 'kwitansi' : include_once 'kwitansi/kwitansi_tab.php'; break;
                case 'pkbbukatutup' : include_once 'pkbstatus/pkb_tab.php'; break;
                case 'sparepart' : include_once 'sparepart/sparepart_tab.php'; break;
                case 'cash' : include_once 'cash/cash_tab.php'; break;
                case 'bank' : include_once 'bank/bank_tab.php'; break;
                case 'gatepass' : include_once 'gatepass/gatepass_tab.php'; break;
                case 'laporan' : include_once 'laporan/laporan_tab.php'; break;
                case 'backup' : include_once 'backup/backup_tab.php'; break;
                case 'mcoa' : include_once 'mcoa/mcoa_tab.php'; break;
                case 'acccash' : include_once 'acccash/acccash_tab.php'; break;
                case 'accbank' : include_once 'accbank/accbank_tab.php'; break;
                case 'uploaddms' : include_once 'uploaddms/page_index.php'; break;
            }
        ?>
    </main>

    <!-- Modern Footer -->
    <footer class="modern-footer">
        <div class="footer-content">
            <div class="footer-left">
                <p>&copy; <?php echo date('Y'); ?> <?php echo $titlefooter; ?></p>
            </div>
            <div class="footer-right">
                <p>Version 1.0</p>
            </div>
        </div>
    </footer>
</div>

<!-- Include necessary scripts from original footer -->
<!-- Bootstrap JS -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- bootstrap datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Modern Responsive CSS -->
<style>
/* Modern Responsive Design */
.modern-container {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Mobile Header Styles */
.mobile-header {
    display: block;
    background: linear-gradient(135deg, #1585c3 0%, #0f6fa0 100%);
    color: white;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.mobile-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
}

.brand-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.mobile-menu-toggle {
    background: none;
    border: none;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    padding: 0.5rem;
    width: 30px;
    height: 25px;
    justify-content: space-between;
}

.mobile-menu-toggle span {
    display: block;
    height: 3px;
    width: 100%;
    background-color: white;
    border-radius: 2px;
    transition: all 0.3s ease;
}

.mobile-menu-toggle.active span:nth-child(1) {
    transform: rotate(45deg) translate(5px, 5px);
}

.mobile-menu-toggle.active span:nth-child(2) {
    opacity: 0;
}

.mobile-menu-toggle.active span:nth-child(3) {
    transform: rotate(-45deg) translate(7px, -6px);
}

.mobile-nav {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    background: rgba(0,0,0,0.1);
}

.mobile-nav.active {
    max-height: 500px;
}

.mobile-nav-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.mobile-nav-list li {
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.mobile-nav-list .nav-item, .mobile-nav-list .dropdown-toggle {
    display: block;
    padding: 1rem 1.5rem;
    color: white;
    text-decoration: none;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

.mobile-nav-list .nav-item:hover, .mobile-nav-list .dropdown-toggle:hover {
    background-color: rgba(255,255,255,0.1);
}

.mobile-nav-list .nav-item.logout {
    background-color: rgba(255,0,0,0.2);
    color: #ffcccc;
}

.mobile-dropdown .dropdown-menu {
    display: none;
    background: rgba(0,0,0,0.2);
    list-style: none;
    padding: 0;
    margin: 0;
}

.mobile-dropdown.active .dropdown-menu {
    display: block;
}

.mobile-dropdown .dropdown-menu li {
    padding-left: 2rem;
}

.mobile-dropdown .dropdown-menu a {
    color: white;
    text-decoration: none;
    padding: 0.75rem 1.5rem;
    display: block;
    font-size: 0.9rem;
}

.mobile-dropdown .dropdown-menu a:hover {
    background-color: rgba(255,255,255,0.1);
}

.mobile-dropdown .divider {
    border-top: 1px solid rgba(255,255,255,0.2);
    margin: 0.5rem 0;
}

/* Desktop Header Styles */
.desktop-header {
    display: none;
    background: linear-gradient(135deg, #1585c3 0%, #0f6fa0 100%);
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.navbar {
    padding: 0;
}

.navbar .container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 60px;
}

.navbar-brand {
    color: white !important;
    font-size: 1.5rem;
    font-weight: 700;
    text-decoration: none;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.nav-list {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 0.5rem;
    align-items: center;
}

.nav-btn {
    background: rgba(255,255,255,0.1);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.nav-btn:hover {
    background: rgba(255,255,255,0.2);
    transform: translateY(-1px);
}

.nav-btn.logout {
    background: rgba(255,0,0,0.2);
}

.nav-btn.logout:hover {
    background: rgba(255,0,0,0.3);
}

.dropdown {
    position: relative;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    min-width: 200px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    border-radius: 4px;
    overflow: hidden;
    display: none;
    z-index: 1001;
}

.dropdown.active .dropdown-menu {
    display: block;
}

.dropdown-menu a {
    color: #333;
    padding: 0.75rem 1rem;
    text-decoration: none;
    display: block;
    transition: background-color 0.3s ease;
    font-size: 0.9rem;
}

.dropdown-menu a:hover {
    background-color: #f8f9fa;
}

.dropdown-menu .divider {
    border-top: 1px solid #dee2e6;
    margin: 0.5rem 0;
}

/* Main Content */
.main-content {
    flex: 1;
    background-color: #f8f9fa;
    min-height: calc(100vh - 120px);
}

/* Modern Footer */
.modern-footer {
    background: linear-gradient(135deg, #1585c3 0%, #0f6fa0 100%);
    color: white;
    padding: 1.5rem 1rem;
    box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
}

.footer-content {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.footer-left p, .footer-right p {
    margin: 0;
    font-size: 0.9rem;
}

/* Desktop Responsive Styles */
@media (min-width: 768px) {
    .mobile-header {
        display: none;
    }

    .desktop-header {
        display: block;
    }

    .modern-footer {
        padding: 1rem 0;
    }

    .footer-content {
        padding: 0 1rem;
    }
}

/* Large Screen Optimizations */
@media (min-width: 1200px) {
    .nav-btn {
        padding: 0.75rem 1.25rem;
        font-size: 1rem;
    }

    .navbar-brand {
        font-size: 1.75rem;
    }
}

/* Tablet Styles */
@media (min-width: 768px) and (max-width: 1199px) {
    .nav-btn {
        padding: 0.5rem 0.75rem;
        font-size: 0.85rem;
    }

    .navbar-brand {
        font-size: 1.25rem;
    }
}

/* Smooth Animations */
* {
    box-sizing: border-box;
}

/* Hide AdminLTE elements that conflict */
.layout-boxed .wrapper {
    max-width: none !important;
}

.skin-red-light .main-header .navbar {
    background: linear-gradient(135deg, #1585c3 0%, #0f6fa0 100%) !important;
}

/* Hide original AdminLTE footer to prevent duplication */
.main-footer {
    display: none !important;
}

.control-sidebar, .control-sidebar-bg {
    display: none !important;
}

/* Improved Accessibility */
.nav-btn:focus, .nav-item:focus, .dropdown-toggle:focus {
    outline: 2px solid rgba(255,255,255,0.5);
    outline-offset: 2px;
}

/* Touch-friendly targets for mobile */
@media (max-width: 767px) {
    .mobile-nav-list .nav-item, .mobile-nav-list .dropdown-toggle {
        min-height: 48px;
        display: flex;
        align-items: center;
    }

    .mobile-dropdown .dropdown-menu a {
        min-height: 44px;
        display: flex;
        align-items: center;
    }
}
</style>

<!-- Modern JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileNav = document.getElementById('mobileNav');

    if (mobileMenuToggle && mobileNav) {
        mobileMenuToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            mobileNav.classList.toggle('active');
        });
    }

    // Mobile dropdown toggles
    const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown .dropdown-toggle');
    mobileDropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.parentElement;
            const dropdownId = this.getAttribute('data-dropdown');

            // Close other dropdowns
            mobileDropdownToggles.forEach(function(otherToggle) {
                if (otherToggle !== toggle) {
                    otherToggle.parentElement.classList.remove('active');
                }
            });

            parent.classList.toggle('active');
        });
    });

    // Desktop dropdown toggles
    const desktopDropdownToggles = document.querySelectorAll('.dropdown .dropdown-toggle');
    desktopDropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.parentElement;
            const dropdownId = this.getAttribute('data-dropdown');

            // Close other dropdowns
            desktopDropdownToggles.forEach(function(otherToggle) {
                if (otherToggle !== toggle) {
                    otherToggle.parentElement.classList.remove('active');
                }
            });

            parent.classList.toggle('active');
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown').forEach(function(dropdown) {
                dropdown.classList.remove('active');
            });
        }

        if (!e.target.closest('.mobile-dropdown') && !e.target.closest('.mobile-nav-list')) {
            document.querySelectorAll('.mobile-dropdown').forEach(function(dropdown) {
                dropdown.classList.remove('active');
            });
        }
    });

    // Close mobile menu when clicking on a link
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-list .nav-item');
    mobileNavLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            if (mobileMenuToggle && mobileNav) {
                mobileMenuToggle.classList.remove('active');
                mobileNav.classList.remove('active');
            }
        });
    });

    // Add smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>

<!-- Close HTML tags -->
</body>
</html>


