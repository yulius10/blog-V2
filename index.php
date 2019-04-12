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
            Últimos Blog
            <small>
              Publicados
            </small>
          </h1>
        <?php
          include("includes/paginacion_rutas.php");
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
                  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                      <a href="detalleBlog.php?sec=<?=$funciones->encode_this_get("id=".$registros["cod_blo"])?>" class="btn btn-primary" title="Read more">
                        Leer más &rarr;
                      </a>
                    </div>
                    <!-- inicio de like - dislike -->
                    <!--
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                      <button type="button" class="btn btn-secondary" title="like">
                        <i class="far fa-thumbs-up">
                        </i>
                      </button>
                      <button type="button" class="btn btn-secondary" title="like">
                        <i class="fas fa-thumbs-up">
                        </i>
                      </button>
                    </div>
                    <div class="btn-group mr-2" role="group" aria-label="Second group">
                      <button type="button" class="btn btn-secondary" title="dislike">
                        <i class="fas fa-thumbs-down">
                        </i>
                      </button>
                      <button type="button" class="btn btn-secondary" title="dislike">
                        <i class="far fa-thumbs-down">
                        </i>
                      </button>
                    </div>-->
                    <!-- fin de like - dislike -->
                  </div>
                </div>
                <div class="card-footer text-muted">
                  <?php
                    $date = date_create($registros["fec_cre"]);
                    $new_fecha = date_format($date,'d/m/Y H:i:s');
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
            echo "No hay datos";
          }
          include("includes/paginador.php");
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
