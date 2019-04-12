<?php
//echo $_REQUEST['cod'];
decode_get2_get($_REQUEST['borrado']);
decode_get2_get($_REQUEST['cod']);
$codigo_seguridad=intval($_REQUEST['int']);

if(!is_int ($codigo_seguridad)){
    //echo "uno";
    header('Location: ../index.php');
    exit;
}

if(!isset($_SESSION['global'][2])){
    header('Location: ../index.php');
    exit;
}



?>
