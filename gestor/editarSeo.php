<?php
  require_once("gm-lib/function/manejoSession.php");
  require_once("gm-lib/function/funciones.php");

  $session = new manejoSession();
  $funciones = new funciones();

  $session->iniciarSession();
  $correo = $session->getSession("correo");
  $usuario = $session->getSession("usuario");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>
    AdminLTE
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link type="text/css" rel="stylesheet" href="dist/css/colorbox.css" />
  <link type="text/css" rel="stylesheet" href="dist/css/jquery-ui.structure.min.css" />
  <link type="text/css" rel="stylesheet" href="dist/css/reset.min.css" />
  <link type="text/css" rel="stylesheet" href="dist/css/styles-cg.css" />
  <link type="text/css" rel="stylesheet" href="dist/css/styles.css" />
  <link type="text/css" rel="stylesheet" href="dist/css/fileinput.min.css" />
  <link type="text/css" rel="stylesheet" href="dist/css/theme.min.css" />

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php
    include("includes/header.php");
  ?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <?php
        include("includes/search.php");
        include("includes/main.php");
      ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        General Form Elements
        <small>
          Preview
        </small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="#">
            <i class="fa fa-desktop">
            </i>
            Panel
          </a>
        </li>
        <li class="active">
          Editar blog
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        $funciones->decode_get2_get($_REQUEST["sec"]);
        $id = $_REQUEST["id"];

        $link = $funciones->conectar();

        $tabla = "Seo";
        $columnas = "idCeo,goo_ana_ceo,pal_cla_ceo,des_ceo";
        $where = "and idCeo='$id'";
        $order = "";

        $resultados = $funciones->consultarRegistro($tabla,$columnas,$where,$order,$link);



        if($registro = mysqli_fetch_array($resultados)){
          $idCeo = $registro["idCeo"];
          $googleAnalitics = $registro["goo_ana_ceo"];
          $palabrasClave = $registro["pal_cla_ceo"];
          $descripcion = $registro["des_ceo"];
        }

        //$resultadosGale = $funciones->consultarRegistro("galeria","nom_gal","and idBlog='$id'",$order,$link);

        include("includes/formEditarSeo.php");

        //$funciones->desconectar($link);
      ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
    include("includes/footer.php");
  ?>
  <div class="control-sidebar-bg">
  </div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js">
</script>
<script type="text/javascript" src="dist/js/jquery.validate.min.js">
</script>
<script type="text/javascript" src="dist/js/interface.js">
</script>
<script type="text/javascript" src="dist/js/jquery.colorbox-min.js">
</script>
<script type="text/javascript" src="dist/js/forms.js">
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js">
</script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js">
</script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js">
</script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js">
</script>
<script type="text/javascript" src="dist/js/fileinput.min.js">
</script>
<script type="text/javascript" src="dist/js/es.js">
</script>
<script type="text/javascript" src="dist/js/sortable.min.js">
</script>
<script type="text/javascript" src="dist/js/theme.min.js">
</script>
<script type="text/javascript" src="dist/js/theme.minn.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js">
</script>
</body>
</html>
