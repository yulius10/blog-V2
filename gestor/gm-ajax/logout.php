<?php
    require_once("../gm-lib/function/manejoSession.php");

    $manejoSession = new manejoSession();
    $manejoSession->iniciarSession();
    $manejoSession->destruirSession();
?>
<script>
    location.href="../index.php";
</script>
