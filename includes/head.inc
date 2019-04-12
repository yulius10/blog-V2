<?php
  require_once("lib/function/funciones.php");
  $funciones = new funciones();
  $link = $funciones->conectar();

  $tablaSeo = "SEO";
  $columnasSeoPalabras = "pal_cla_ceo";
  $columnasSeoDesc = "des_ceo";
  $whereSeo = "";
  $orderSeo = "";
?>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="<?=$funciones->consultarColumna($tablaSeo,$columnasSeoPalabras,$whereSeo,$orderSeo,$link)?>"/><!-- palabras clave del sitio -->
  <meta name="description" content="<?=$funciones->consultarColumna($tablaSeo,$columnasSeoDesc,$whereSeo,$orderSeo,$link)?>" /><!-- descripcion del sitio maximo 170 -->
  <meta name="author" name="Yulius"/><!-- autor del sitio -->
  <title>
  <?php
    if(basename($_SERVER['PHP_SELF']) == "index.php"){
      echo "Inicio";
    }
    else if(basename($_SERVER['PHP_SELF']) == "contact.php"){
      echo "Contactenos";
    }
    else if(basename($_SERVER['PHP_SELF']) == "resultBusqueda.php"){
      echo "Resultados";
    }
    else if(basename($_SERVER['PHP_SELF']) == "resultCategoria.php"){
      echo "Categorias";
    }
    else if(basename($_SERVER['PHP_SELF']) == "about.php"){
      echo "Acerca de";
    }
    else if(basename($_SERVER['PHP_SELF']) == "detalleBlog.php"){
      $funciones->decode_get2_get($_REQUEST["sec"]);
      $tabla = "blog";
      $columnas = "tit_blo";
      $where = "and cod_blo='".$_REQUEST["id"]."'";
      $order = "";

      $linkA = $funciones->conectar();

      $resultado = $funciones->consultarRegistro($tabla,$columnas,$where,$order,$linkA);
      if($registro = mysqli_fetch_array($resultado)){
        echo $registro['tit_blo'];
      }
    }
  ?>
  </title>
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/blog-home.css" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/colorbox.css" />
  <link type="text/css" rel="stylesheet" href="css/jquery-ui.structure.min.css" />
  
  <link type="text/css" rel="stylesheet" href="css/styles-cg.css" />
  <link type="text/css" rel="stylesheet" href="css/styles.css" />
  <link type="text/css" rel="stylesheet" href="css/theme.min.css" />
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"/>
</head>