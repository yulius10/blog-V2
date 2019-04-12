<!DOCTYPE html>
<html lang="es">
  <?php
    include("includes/head.inc");
    include("lib/function/function-acortar-url.php");
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

            $tabla = "blog";
            $columnas = "tit_blo,des_blo,ima_blo,fec_cre";
            $where = "and cod_blo='".$_REQUEST["id"]."'";
            $order = "";

            $link = $funciones->conectar();
            $api = new GoogleURL("AIzaSyDUcVtMFsf4CwZY8b53eEAVfdiPN2SI4_Q");
            
            $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $acortar_url=$api->encode($url);

            $resultado = $funciones->consultarRegistro($tabla,$columnas,$where,$order,$link);
            while($registro = mysqli_fetch_array($resultado)){
          ?>
              <!-- Blog Post -->
              <div class="card mb-4">
                <img class="card-img-top" src="images/<?=$registro["ima_blo"]?>" alt="<?=$registro["tit_blo"]?>" />
                <div class="card-body">
                  <h2 class="card-title">
                    <?=$registro["tit_blo"]?>
                  </h2>
                  <p class="card-text">
                    <?=$registro["des_blo"]?>
                  </p>
                  <!-- inicio de like - dislike -->
                  <!--
                  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
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
                    </div>
                  </div>-->
                  <!-- fin de like - dislike -->
                  <!-- inicio de comentarios -->
                  <!--
                  <br/>
                  <h4>
                    Comentarios
                  </h4>
                  <p class="card-text">
                  <?php
                    /*
                    $resultadoGaleria = $funciones->consultarRegistro("galeria","nom_gal","and idBlog='".$_REQUEST["id"]."'",$order,$link);
                    if($resultadoGaleria){
                      while($registroGaleria = mysqli_fetch_array($resultadoGaleria)){
                        ?>
                        <a href="archivos/<?=$registroGaleria["nom_gal"]?>" target="_blank">
                          <?=$registroGaleria["nom_gal"]?>
                        </a>
                        <br/>
                        <?php
                      }
                    }
                    */
                  ?>
                    <form>
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                              <i class="fas fa-user">
                              </i>
                            </span>
                          </div>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                      </div>
                    </form>
                  </p>-->
                  <!-- fin de comentarios -->
                </div>
                <div class="card-footer text-muted">
                <?php
                  $date = date_create($registro["fec_cre"]);
                  $new_fecha = date_format($date,'d/m/Y H:i:s');
                ?>
                Publicado el <?=$new_fecha?> <a href="http://www.facebook.com/sharer.php?u=<?=$acortar_url?>">Compartir en Facebook</a>
              </div>
              </div>
              <div class="card mb-4">
                <img class="card-img-top" src="images/banner.png" alt="Card image cap" />
              </div>
              <!-- /Blog Post -->
            <?php
            }
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
