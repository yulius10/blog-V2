<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Categorias
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
      Blog
    </li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <a href="agregarCategories.php">
            <button class="btn btn-link">
              Agregar Registro
            </button>
          </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>
                Categoria
              </th>
            </tr>
            </thead>
            <tbody>
              <?php
              if($resultados){
                while($registros = mysqli_fetch_array($resultados)){
              ?>
              <tr>
                <td>
                  <?=$registros["nom_cat"]?>
                  <br/>
                  <small>
                    <a href="editarCategories.php?sec=<?=$funciones->encode_this_get("id=".$registros["cod_cat"])?>">
                      Editar
                    </a>
                  </small>
                  <small>
                    <div class="delete" data="<?=$funciones->encode_this_get("id=".$registros["cod_cat"])?>">
                      <a>Eliminar</a>
                    </div>
                  </small>
                </td>
              </tr>
              <?php
                }
              }
              else{
                echo "No existen registros.";
              }
            ?>
          </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
