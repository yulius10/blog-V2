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

    $rutaConsulArchivos = "archivos/";
    $rutaConsulImagenes = "images/";
    $urlArchivos = "/blog/archivos/";
    $urlImagenes = "/blog/images/";
    $archivo = $funciones->subirArchivo($_FILES["Archivo"], $urlArchivos);
    $imagen = $funciones->subirArchivo($_FILES["Portada"], $urlImagenes);

    $tabla = "blog";
    $columnas = "cod_cat,tit_blo,ent_blo,des_blo,ima_blo,fec_cre";
    $valores = "'$tipoCategorie','$titulo','$descripcionPeg','$descripcion','$imagen','$fecha'";

    $resultado = $funciones->insertar($tabla,$columnas,$valores,$link);


    $id = $funciones->consultarMax("blog","cod_blo","cod_blo",$link);

    $tablaA = "galeria";
    $columnasA = "idBlog,nom_gal,rut_con_gal,rut_edi_gal,fec_cre";
    $valoresA = "'".$id."','".$_FILES["Portada"]["name"]."','".$rutaConsulArchivos."','".$rutaConsulImagenes.$imagen."','$fecha'";

    $funciones->insertar($tablaA,$columnasA,$valoresA,$link);
    
    $tablaB = "archivos";
    $columnasB = "idBlog,nom_arc,rut_con_arc,rut_edi_arc,fec_cre";
    $valoresB = "'".$id."','".$_FILES['Archivo']['name']."','".$rutaConsulArchivos."','".$rutaConsulArchivos.$archivo."','$fecha'";

    $funciones->insertar($tablaB,$columnasB,$valoresB,$link);


    if($resultado){
        echo "1";
    }
    else{
        echo "0";
    }

    $funciones->desconectarA($link);

?>
