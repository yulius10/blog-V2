<?php
    require_once("../gm-lib/function/funciones.php");
    require_once("../gm-lib/function/manejoSession.php");

    $funciones = new funciones();
    $manejoSession = new manejoSession();
    $manejoSession->iniciarSession();

    $link = $funciones->conectarA();

    $categorie = $funciones->correcion_html_utf8($_REQUEST["categorie"]);
    $fecha = date("Y-m-d H:i:s");

    $tabla = "categorias";
    $columnas = "nom_cat,fec_cre";
    $valores = "'$categorie','$fecha'";

    $resultado = $funciones->insertar($tabla,$columnas,$valores,$link);

    if($resultado){
        echo "1";
    }
    else{
        echo "0";
    }

    $funciones->desconectar($link);

?>
