<?php 
session_start();
include_once '../../lib/fungsi.php';
unset($_SESSION['sesiuidbpn']);
unset($_SESSION['lvl']);
session_destroy();
//session_destroy();
//message_url('ANDA TELAH KELUAR','../');
//exit();
?>
<script language="javascript">
    window.location.href = "../../"
</script>
