<!DOCTYPE html>
<html lang="es">
  <?php
    $ruta="about.php";
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
            Acerca de
          </h1>
          <!-- Blog Post -->
          <div class="card mb-4">
            <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
            <div class="card-body">
              <h2 class="card-title">
                Acerca de
              </h2>
              <p class="card-text">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!
              </p>
            </div>
          </div>
          <!-- /Blog Post -->
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
