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
    $mail = $funciones->correcion_html_utf8($_REQUEST["mail"]);
    $password = $funciones->encode_this_get($_REQUEST["password"]);

    $tabla = "usuario";
    $columnas = "nom_usu,ape_usu,cor_usu,pas_usu,fec_cre";
    $valores = "'$name','$lastname','$mail','$password','$fecha'";

    $resultado = $funciones->insertar($tabla,$columnas,$valores,$link);
    
    if($resultado){
        echo "1";
    }
    else{
        echo "0";
    }
    

    $funciones->desconectarA($link);

?>
