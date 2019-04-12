<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    SEO
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
      SEO
    </li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>
                Titulo
              </th>
              <th>
                Palabras clave
              </th>
              <th>
                Descripcion pequeña
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
                  <?="SEO de la pagina principal"?>
                  <br/>
                  <small>
                    <a href="editarSeo.php?sec=<?=$funciones->encode_this_get("id=".$registros["idCeo"])?>">
                      Editar
                    </a>
                  </small>
                </td>
                <td>
                  <?=$registros["pal_cla_ceo"];?>
                </td>
                <td>
                  <?=$registros["des_ceo"];?>
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
