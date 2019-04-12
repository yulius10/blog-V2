<?php
    require_once("../gm-lib/function/funciones.php");
    require_once("../gm-lib/function/manejoSession.php");

    $funciones = new funciones();
    $manejoSession = new manejoSession();
    $manejoSession->iniciarSession();

    $link = $funciones->conectarA();

    $fecha = date("Y-m-d H:i:s");

    $name = $funciones->correcion_html_utf8($_REQUEST["name"]);
    $lastname = $funciones->correcion_html_utf8($_REQUEST["lastname"]);
    $mail = $_REQUEST["mail"];
    $password = $funciones->encode_this_get($_REQUEST["password"]);
    $idRegis = $funciones->decode_get2_base($_REQUEST["idRegis"]);

    $tabla = "usuario";
    $colum = "nom_usu='$name',ape_usu='$lastname',cor_usu='$mail',pas_usu='$password',fec_mod='$fecha'";
    $where = "reg_eli=0 and cod_usu='$idRegis'";

    $resultado = $funciones->editar($tabla,$colum,$where,$link);

    if($resultado){
        echo "1";
    }
    else{
        echo "0";
    }

    $funciones->desconectarA($link);

?>
