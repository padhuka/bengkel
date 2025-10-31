<?php
session_start();

// Cek apakah sesi sudah di-set
if (! isset($_SESSION['sesiuidbpn']) || ! isset($_SESSION['lvl']) ||
    empty($_SESSION['sesiuidbpn']) || empty($_SESSION['lvl'])) {
    echo "<script>self.location.href='login.php'</script>";
    exit;
}

// Ambil nilai session dengan aman
$seskdlvl = $_SESSION['lvl'];
$sesuname = $_SESSION['sesiuidbpn'];
