<?php
    require_once("../gm-lib/function/funciones.php");
    require_once("../gm-lib/function/manejoSession.php");

    $funciones = new funciones();
    $manejoSession = new manejoSession();

    $link = $funciones->conectarA();

    $correo = $_REQUEST["correo"];
    $password = $funciones->encode_this_get_correo($_REQUEST["pass"]);

    $tabla = "usuario";
    $columnas = "cod_usu,cor_usu,pas_usu";
    $where = "and cor_usu='$correo' and pas_usu='$password'";
    $order = "";

    $resultado = $funciones->consultar($tabla,$columnas,$where,$order,$link);

    $column = "nom_usu";
    $whereA = "reg_eli=0 and cod_usu='$resultado'";
    $usuario = $funciones->consultaParametros($tabla,$column,$whereA,$link)." ".$funciones->consultaParametros($tabla,"ape_usu",$whereA,$link);

    $manejoSession->iniciarSession();
    $manejoSession->crearSession("codigo",$resultado);
    $manejoSession->crearSession("correo",$correo);
    $manejoSession->crearSession("usuario",$usuario);

    echo $resultado;

    //$funciones->desconectar($link);

?>
