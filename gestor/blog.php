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
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="dist/css/colorbox.css" />
  <link rel="stylesheet" href="dist/css/jquery-ui.structure.min.css" />
  <link rel="stylesheet" href="dist/css/reset.min.css" />
  <link rel="stylesheet" href="dist/css/styles-cg.css" />
  <link rel="stylesheet" href="dist/css/styles.css" />

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php
    include("includes/header.php");
  ?>
  <!-- Left side column. contains the logo and sidebar -->
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
    <?php
      $link = $funciones->conectar();

      $tabla = "blog";
      $columnas = "cod_blo,cod_cat,tit_blo,ent_blo";
      $where = "";
      $order = "";
      
      $resultados = $funciones->consultarRegistro($tabla,$columnas,$where,$order,$link);
      include("includes/contenidoBlog.php");

      $funciones->desconectar($link);
    ?>
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
<script src="bower_components/jquery/dist/jquery.min.js">
</script>
<script src="dist/js/jquery.validate.min.js">
</script>
<script src="dist/js/interface.js">
</script>
<script src="dist/js/jquery.colorbox-min.js">
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js">
</script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js">
</script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js">
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
<!-- page script -->
<script src="dist/js/pagination.js">
</script>

<script src="dist/js/eliminarBlog.js">
</script>
</body>
</html>
