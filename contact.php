<!DOCTYPE html>
<html lang="es">
  <?php
    $ruta="contact.php";
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
            Contáctenos
          </h1>
          <!-- Blog Post -->
          <div class="card mb-4">
            <div class="card-body">
              <p class="card-text">
                <form class="form-horizontal" id="formContact">
                  <div class="form-inline">
                    <label for="Nombre" class="col-sm-2 control-label">
                      Nombre
                    </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Nombre" />
                    </div>
                  </div>
                  <br/>
                  <div class="form-inline">
                    <label for="Apellido" class="col-sm-2 control-label">
                      Apellido
                    </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="Apellido" id="Apellido" placeholder="Apellido" />
                    </div>
                  </div>
                  <br/>
                  <div class="form-inline">
                    <label for="Correo" class="col-sm-2 control-label">
                      Correo
                    </label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="Correo" id="Correo" placeholder="Correo" />
                    </div>
                  </div>
                  <br/>
                  <div class="form-inline">
                    <label for="Asunto" class="col-sm-2 control-label">
                      Asunto
                    </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="Asunto" id="Asunto" placeholder="Asunto" />
                    </div>
                  </div>
                  <br/>
                  <div class="form-inline">
                    <label for="Texto" class="col-sm-2 control-label">
                      Mensaje
                    </label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="Texto" id="Texto" placeholder="Mensaje"></textarea>
                    </div>
                  </div>
                  <div class="form-inline">
                    <button type="submit">
                      Guardar
                    </button>
                  </div>
                </form>
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
