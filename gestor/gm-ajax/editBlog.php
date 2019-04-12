<?php
    require_once("../gm-lib/function/funciones.php");
    require_once("../gm-lib/function/manejoSession.php");

    $funciones = new funciones();
    $manejoSession = new manejoSession();
    $manejoSession->iniciarSession();

    $link = $funciones->conectarA();

    $fecha = date("Y-m-d H:i:s");
    $titulo = $funciones->correcion_html_utf8($_REQUEST["titulo"]);
    $descripcionPeg = $funciones->correcion_html_utf8($_REQUEST["descripcionPeg"]);
    $descripcion = $funciones->correcion_html_utf8($_REQUEST["descripcion"]);
    $tipoCategorie = $_REQUEST["tipoCategorie"];
    $idRegis = $funciones->decode_get2_base($_REQUEST["idRegis"]);

    $rutaConsulArchivos = "archivos/";
    $rutaConsulImagenes = "images/";
    $urlArchivos = "/blog/archivos/";
    $urlImagenes = "/blog/images/";
    $archivos = $funciones->subirArchivo($_FILES["Archivo"], $urlArchivos);
    $imagenes = $funciones->subirArchivo($_FILES["Portada"], $urlImagenes);

    $tabla = "blog";
    $colum = "cod_cat='$tipoCategorie',tit_blo='$titulo',ent_blo='$descripcionPeg',des_blo='$descripcion',ima_blo='$imagenes',fec_mod='$fecha'";
    $where = "reg_eli=0 and cod_blo='$idRegis'";

    $resultado = $funciones->editar($tabla,$colum,$where,$link);

    $tablaA = "galeria";
    $columnasA = "idBlog,nom_gal,rut_con_gal,rut_edi_gal,fec_cre";
    $valoresA = "'".$idRegis."','".$_FILES["Portada"]["name"]."','".$rutaConsulArchivos."','".$rutaConsulImagenes.$imagenes."','$fecha'";


    $tablaB = "archivos";
    $columnasB = "idBlog,nom_arc,rut_con_arc,rut_edi_arc,fec_cre";
    $valoresB = "'".$idRegis."','".$_FILES['Archivo']['name']."','".$rutaConsulArchivos."','".$rutaConsulArchivos.$archivos."','$fecha'";

    $funciones->insertar($tablaB,$columnasB,$valoresB,$link);
    

    if($resultado){
        echo "1";
    }
    else{
        echo "0";
    }

    $funciones->desconectarA($link);

?>
