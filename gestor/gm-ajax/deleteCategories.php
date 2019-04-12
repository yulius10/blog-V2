<?php
    require_once("../gm-lib/function/funciones.php");
    require_once("../gm-lib/function/manejoSession.php");

    $funciones = new funciones();
    $manejoSession = new manejoSession();
    $manejoSession->iniciarSession();

    $link = $funciones->conectarA();

    $idUsu = $manejoSession->getSession("codigo");
    $idRegis = $funciones->decode_get2_base($_REQUEST["id"]);
    $idRegis = explode("=",$idRegis);
    $fecha = date("Y-m-d H:i:s");

    $tabla = "categorias";
    $colum = "reg_eli='1',fec_mod='$fecha'";
    $where = "cod_cat='".$idRegis[1]."'";

    $resultado = $funciones->editar($tabla,$colum,$where,$link);

    echo $resultado;

    $funciones->desconectarA($link);

?>
