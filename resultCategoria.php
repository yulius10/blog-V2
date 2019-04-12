<!DOCTYPE html>
<html lang="es">
  <?php
  $ruta="index.php";
  include("includes/head.inc");
  ?>
  <body>
  <?php
    include("includes/header.inc");
  ?>
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
          <h1 class="my-4">
            Resultados
          </h1>
        <?php
          $funciones->decode_get2_get($_REQUEST["sec"]);
          $where = "and cod_cat='".$_REQUEST["id"]."'";

          include("includes/paginacion_rutasCategorias.php");

          $resultados = $funciones->consultarRegistroSql($sqlP,$link);
          if($resultados){
            while($registros = mysqli_fetch_array($resultados)){
              ?>
              <!-- Blog Post -->
              <div class="card mb-4">
                <img class="card-img-top" src="<?="images/".$registros["ima_blo"]?>" alt="<?=$registros["tit_blo"]?>" />
                <div class="card-body">
                  <h2 class="card-title">
                    <?=$registros["tit_blo"]?>
                  </h2>
                  <p class="card-text">
                    <?=$registros["ent_blo"]?>
                  </p>
                  <a href="detalleBlog.php?sec=<?=$funciones->encode_this_get("id=".$registros["cod_blo"])?>" class="btn btn-primary">
                    Read More &rarr;
                  </a>
                </div>
                <div class="card-footer text-muted">
                  <?php
                    $date = date_create($registros["fec_cre"]);
                    $new_fecha = date_format($date,'D/M/Y');
                  ?>
                  Publicado el <?=$new_fecha?>
                </div>
              </div>
              <div class="card mb-4">
                <img class="card-img-top" src="images/banner.png" alt="Card image cap" />
              </div>
              <!-- /Blog Post -->
            <?php
            }
          }
          else{
            echo "No hay blog relacionados a esta categoria";
          }
          include("includes/paginadorCategorias.php");
        ?>
        </div>
        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
        <?php
          include("includes/buscador.inc");
          include("includes/categories.inc");
          include("includes/widgetPublicidad.inc");
        ?>
        </div>
        <!-- /Sidebar Widgets Column -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
    <?php
      include("includes/foot.inc");
    ?>
  </body>
</html>
