<?php
    require_once("../gm-lib/function/funciones.php");
    require_once("../gm-lib/function/manejoSession.php");

    $funciones = new funciones();
    $manejoSession = new manejoSession();
    $manejoSession->iniciarSession();

    $link = $funciones->conectarA();

    $fecha = date("Y-m-d H:i:s");
    $google = $funciones->correcion_html_utf8($_REQUEST["google"]);
    $descripcion = $funciones->correcion_html_utf8($_REQUEST["descripcion"]);
    $palabrasClave = $funciones->correcion_html_utf8($_REQUEST["palabrasClave"]);
    $idRegis = $funciones->decode_get2_base($_REQUEST["idRegis"]);

    $tabla = "SEO";
    $colum = "goo_ana_ceo='$google',des_ceo='$descripcion',pal_cla_ceo='$palabrasClave',fec_mod='$fecha'";
    $where = "reg_eli=0 and idCeo='$idRegis'";

    $resultado = $funciones->editar($tabla,$colum,$where,$link);

    if($resultado){
        echo "1";
    }
    else{
        echo "0";
    }

    $funciones->desconectarA($link);

?>
