<?php
    require_once("../gm-lib/function/funciones.php");
    require_once("../gm-lib/function/manejoSession.php");

    $funciones = new funciones();
    $manejoSession = new manejoSession();
    $manejoSession->iniciarSession();

    $link = $funciones->conectarA();

    $categorie = $funciones->correcion_html_utf8($_REQUEST["categorie"]);
    $idRegis = $funciones->decode_get2_base($_REQUEST["idRegis"]);
    $fecha = date("Y-m-d H:i:s");

    $tabla = "categorias";
    $colum = "nom_cat='$categorie',fec_mod='$fecha'";
    $where = "reg_eli=0 and cod_cat='$idRegis'";

    $resultado = $funciones->editar($tabla,$colum,$where,$link);

    if($resultado){
        echo "1";
    }
    else{
        echo "0";
    }

    $funciones->desconectarA($link);

?>
