<?php
    require_once("../lib/function/funciones.php");

    $funciones = new funciones();

    $link = $funciones->conectarA();

    $fecha = date("Y-m-d H:i:s");
    $Nombre = $funciones->html_conversion_caracter($_REQUEST["Nombre"]);
    $Apellido = $funciones->html_conversion_caracter($_REQUEST["Apellido"]);
    $Correo = $funciones->html_conversion_caracter($_REQUEST["Correo"]);
    $Asunto = $funciones->html_conversion_caracter($_REQUEST["Asunto"]);
    $Texto = $funciones->html_conversion_caracter($_REQUEST["Texto"]);

    $tabla = "contactenos";
    $columnas = "nom_con,ape_con,cor_con,asu_con,men_con,fec_cre";
    $valores = "'$Nombre', '$Apellido', '$Correo', '$Asunto', '$Texto', '$fecha'";

    $resultado = $funciones->insertar($tabla,$columnas,$valores,$link);

    echo $resultado;

    $funciones->desconectarA($link);

?>
